<?php

/**
 * Welcome Page Init
 *
 * Welcome page initializer.
 *
 * @since 1.0.0
 */

if ( ! defined( 'WPINC' ) ) {

    die;

}

/**
 * Activates the welcome page.
 *
 * Adds transient to manage the welcome page.
 *
 * @since 1.0.0
 */
function bitmate_author_donations_welcome_activate() {

    // Transient max age is 60 seconds.
    set_transient( '_welcome_redirect_bitmate_author_donations', true, 60 );

}

register_activation_hook( BITMATE_AUTHOR_DONATIONS_PLUGIN_FILE, 'bitmate_author_donations_welcome_activate' );

/**
 * Deactivates welcome page
 *
 * Deletes the welcome page transient.
 *
 * @since 1.0.0
 */
function bitmate_author_donations_welcome_deactivate() {

  delete_transient( '_welcome_bitmate_author_donations' );

}

register_deactivation_hook( BITMATE_AUTHOR_DONATIONS_PLUGIN_FILE, 'bitmate_author_donations_welcome_deactivate' );
