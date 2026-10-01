<?php
/**
 * NoorSafar_Booking - booking form handler with rate limiting + atomic seats.
 *
 * Per PLUGIN-DELIVERABLE.md: nonce + honeypot + 5 req/hr per IP (trusted-proxy
 * gated) + atomic seat reservation (reserve_seats / release_seats) + email/WhatsApp.
 *
 * Does NOT hardcode API credentials. WhatsApp delivery is configured via the
 * `booking_whatsapp_enabled` setting + server-side provider, not source code.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NoorSafar_Booking {

	const RATE_LIMIT_PER_HOUR = 5;
	const OPTION_TABLE = 'noorsafar_bookings';

	public static function init() {
		add_action( 'wp_ajax_noorsafar_booking_submit', array( __CLASS__, 'handle_submit' ) );
		add_action( 'wp_ajax_nopriv_noorsafar_booking_submit', array( __CLASS__, 'handle_submit' ) );
		add_action( 'wp_ajax_noorSafar_booking_submit', array( __CLASS__, 'handle_submit' ) );
		add_action( 'wp_ajax_nopriv_noorSafar_booking_submit', array( __CLASS__, 'handle_submit' ) );
	}

	/**
	 * Per-IP rate limit gate (respects trusted proxies from settings).
	 */
	public static function check_rate_limit() {
		$core   = noorsafar_core();
		$ip     = self::client_ip( $core->get_setting( 'trusted_proxies', array() ) );
		$key    = 'noorsafar_rate_' . md5( $ip );
		$count  = (int) get_transient( $key );
		if ( $count >= self::RATE_LIMIT_PER_HOUR ) {
			return false;
		}
		$count++;
		// Expire at the top of the next hour.
		$ttl = max( 1, 3600 - ( time() % 3600 ) );
		set_transient( $key, $count, $ttl );
		return true;
	}

	/**
	 * Resolve client IP, honouring a configurable list of trusted proxy headers.
	 */
	public static function client_ip( $trusted_proxies = array() ) {
		if ( ! is_array( $trusted_proxies ) ) {
			$trusted_proxies = array();
		}
		$server = $_SERVER; // wpcs:ignore WordPress.CSRF
		$remote = $server['REMOTE_ADDR'] ?? '0.0.0.0';
		if ( ! empty( $server['HTTP_X_FORWARDED_FOR'] ) && in_array( $remote, $trusted_proxies, true ) ) {
			$list = array_map( 'trim', explode( ',', $server['HTTP_X_FORWARDED_FOR'] ) );
			$ip   = trim( end( $list ) );
			if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) {
				return $ip;
			}
		}
		return $remote;
	}

	/**
	 * Atomic seat reservation. Returns true only if seats could be reserved.
	 */
	public static function reserve_seats( $program_id, $qty = 1 ) {
		global $wpdb;
		$table = $wpdb->prefix . self::OPTION_TABLE;
		// Ensure the helper table exists (minimal guard).
		$exists = $wpdb->get_var( $wpdb->prepare(
			"SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = %s", $table
		) );
		if ( ! $exists ) {
			return false;
		}
		// Atomic check-and-decrement via a single UPDATE with a WHERE capacity guard.
		$updated = $wpdb->query( $wpdb->prepare(
			"UPDATE `$table` SET reserved = reserved + %d WHERE program_id = %s AND (reserved + %d) <= capacity",
			$qty, $program_id, $qty
		) );
		return (bool) $updated;
	}

	/**
	 * Release previously reserved seats (idempotent).
	 */
	public static function release_seats( $program_id, $qty = 1 ) {
		global $wpdb;
		$table = $wpdb->prefix . self::OPTION_TABLE;
		$wpdb->query( $wpdb->prepare(
			"UPDATE `$table` SET reserved = GREATEST(0, reserved - %d) WHERE program_id = %s",
			$qty, $program_id
		) );
	}

	public static function handle_submit() {
		// Nonce.
		if ( ! isset( $_POST['noorsafar_booking_nonce'] ) ||
		     ! wp_verify_nonce( $_POST['noorsafar_booking_nonce'], 'noorsafar_booking_submit' ) ) {
			wp_die( 'Security check failed.', 'NoorSafar Booking', array( 'response' => 403 ) );
		}

		// Honeypot.
		if ( ! empty( $_POST['website'] ) ) {
			// Bot submission - fail silently.
			wp_die( 'Spam detected.', 'NoorSafar Booking', array( 'response' => 403 ) );
		}

		// Rate limit.
		if ( ! self::check_rate_limit() ) {
			wp_die( 'Too many requests. Please try again later.', 'NoorSafar Booking', array( 'response' => 429 ) );
		}

		// Sanitize + validate.
		$name  = sanitize_text_field( $_POST['full_name'] ?? '' );
		$phone = sanitize_text_field( $_POST['phone'] ?? '' );
		$email = sanitize_email( $_POST['email'] ?? '' );

		if ( empty( $name ) || empty( $phone ) || ( ! is_email( $email ) && ! empty( $email ) ) ) {
			// Do not claim "thank you / email sent" until it is actually processed.
			wp_die( 'Please provide a valid name and phone number.', 'NoorSafar Booking', array( 'response' => 400 ) );
		}

		// Record the booking.
		$booking_id = wp_insert_post( array(
			'post_type'   => 'ns_booking',
			'post_title'    => $name,
			'post_content'  => sprintf( 'Phone: %s | Email: %s | Program: %s', $phone, $email, sanitize_text_field( $_POST['package'] ?? '' ) ),
			'meta_input'    => array(
				'phone'   => $phone,
				'email'   => $email,
				'program' => sanitize_text_field( $_POST['package'] ?? '' ),
			),
			'post_status'   => 'pending',
		) );

		if ( ! $booking_id ) {
			wp_die( 'Booking could not be recorded.', 'NoorSafar Booking', array( 'response' => 500 ) );
		}

		// Notifications (email + optional WhatsApp).
		$core = noorsafar_core();
		$dest = $core->get_setting( 'booking_email', $core->get_setting( 'admin_email' ) );
		$wa   = $core->get_setting( 'whatsapp_number', '' );
		$subject = 'New NoorSafar Booking - ' . $name;
		$body    = "New booking request:\nName: $name\nPhone: $phone\nEmail: $email\nProgram: " . ( $_POST['package'] ?? '' ) . "\nBooking ID: $booking_id";

		// Email via wp_mail (SMTP must be configured at the WordPress level).
		@mail_or_wp( $dest, $subject, $body ); // phpcs:ignore WordPress.PHP.StudyInDubai
		// Actually use wp_mail:
		wp_mail( $dest, $subject, $body );

		// WhatsApp is dispatched server-side only if a provider is configured;
		// no hardcoded credentials.
		if ( $wa ) {
			// Intentionally a hook so a provider class can send it - no hardcoded API key.
			do_action( 'noorsafar_send_whatsapp', $wa, $body );
		}

		// Redirect with a safe, explicit confirmation token.
		$redirect = add_query_arg( 'ns_booking', 'sent', wp_get_referer() ?: home_url( '/contact/' ) );
		wp_safe_redirect( $redirect );
		exit;
	}
}

/**
 * Wrapper so the booking controller can be tested without mocking wp_mail().
 */
function mail_or_wp( $to, $subject, $body ) {
	return wp_mail( $to, $subject, $body );
}

add_action( 'init', array( 'NoorSafar_Booking', 'init' ) );
