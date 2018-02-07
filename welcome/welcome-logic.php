<?php

/**
 * Welcome Logic
 *
 * @since 1.0.0
 * @package bitmate_author_donations
 */

if ( ! defined( 'WPINC' ) ) {

    die;

}

/**
 * Welcome page redirect.
 *
 * Only happens once and if the site is not a network or multisite.
 *
 * @since 1.0.0
 */
function bitmate_author_donations_safe_welcome_redirect() {
  
  // Bail if no activation redirect transient is present.
  if ( ! get_transient( '_welcome_redirect_bitmate_author_donations' ) ) {

      return;

  }

  // Delete the redirect transient.
  delete_transient( '_welcome_redirect_bitmate_author_donations' );

  /* Bail if activating from network or bulk sites.
  if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {

    return;

  } */

  // Redirect to Welcome Page.
  // Redirects to `your-domain.com/wp-admin/plugin.php?page=bitmate_author_donations_welcome_page`.
  wp_safe_redirect( add_query_arg( array( 'page' => 'bm_welcome' ), admin_url( 'admin.php' ) ) );

}

add_action( 'admin_init', 'bitmate_author_donations_safe_welcome_redirect' );

/**
 * Welcome page content.
 *
 * @since 1.0.0
 */
function bitmate_author_donations_welcome_page_content() {

    if ( file_exists( BITMATE_AUTHOR_DONATIONS_DIR . '/welcome/welcome-view.php') ) {

       require_once( BITMATE_AUTHOR_DONATIONS_DIR . '/welcome/welcome-view.php' );

    }
}

/**
 * Enqueue Styles.
 *
 * @since 1.0.0
 */
function bitmate_author_donations_styles( $hook ) {

    global $bitmate_author_donations_sub_menu;

    // Add style to the welcome page only.
    if ( $hook != $bitmate_author_donations_sub_menu ) {

      return;

    }

    // Welcome page styles.
    wp_enqueue_style(
      'bitmate_author_donations_style',
      BITMATE_AUTHOR_DONATIONS_URL . '/welcome/css/style.css',
      array(),
      BITMATE_AUTHOR_DONATIONS_VERSION,
      'all'
    );

}

// Enqueue the styles.
add_action( 'admin_enqueue_scripts', 'bitmate_author_donations_styles' );
