<?php

/**
 * User Profile Functionality
 *
 * @since 2.0.0
 * @package BITMATE_AUTHOR_DONATIONS
 */

if ( ! defined( 'WPINC' ) ) {

    die;

}

/* Add Bitcoin Meta Field to User Profiles */
add_action( 'show_user_profile', 'bm_profile_bitcoin_field' );
add_action( 'edit_user_profile', 'bm_profile_bitcoin_field' );

function bm_profile_bitcoin_field( $user ) { ?>
    <h3>BitMate Donation Information</h3>
    <p>Please enter an address for each cryptocurrency you would like to accept donations in.</p>
    <table class="form-table">
        <tr>
            <th><label for="bitcoin">Bitcoin</label></th>
            <td>
                <input type="text" name="bitcoin" id="bitcoin" value="<?php echo esc_attr( get_the_author_meta( 'bitcoin', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your Bitcoin address.</span>
            </td>
        </tr>
        <tr>
            <th><label for="bitcoin">Bitcoin Cash</label></th>
            <td>
                <input type="text" name="bitcoincash" id="bitcoincash" value="<?php echo esc_attr( get_the_author_meta( 'bitcoincash', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your Bitcoin Cash address.</span>
            </td>
        </tr>
        <tr>
            <th><label for="ethereum">Ethereum</label></th>
            <td>
                <input type="text" name="ethereum" id="ethereum" value="<?php echo esc_attr( get_the_author_meta( 'ethereum', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your Ethereum address.</span>
            </td>
        </tr>
        <tr>
            <th><label for="litecoin">Litecoin</label></th>
            <td>
                <input type="text" name="litecoin" id="litecoin" value="<?php echo esc_attr( get_the_author_meta( 'litecoin', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your Litecoin address.</span>
            </td>
        </tr>
        <tr>
            <th><label for="monero">Monero</label></th>
            <td>
                <input type="text" name="monero" id="monero" value="<?php echo esc_attr( get_the_author_meta( 'monero', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your Monero address.</span>
            </td>
        </tr>
        <tr>
            <th><label for="zcash">ZCash</label></th>
            <td>
                <input type="text" name="zcash" id="zcash" value="<?php echo esc_attr( get_the_author_meta( 'zcash', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your ZCash address.</span>
            </td>
        </tr>
    </table>
<?php }

/* Save BitMate Meta Data on User Profiles */
add_action( 'personal_options_update', 'bm_save_profile_bitcoin_field' );
add_action( 'edit_user_profile_update', 'bm_save_profile_bitcoin_field' );

function bm_save_profile_bitcoin_field( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    update_user_meta( $user_id, 'bitcoin', $_POST['bitcoin'] );
    update_user_meta( $user_id, 'bitcoincash', $_POST['bitcoincash'] );
    update_user_meta( $user_id, 'litecoin', $_POST['litecoin'] );
    update_user_meta( $user_id, 'ethereum', $_POST['ethereum'] );
    update_user_meta( $user_id, 'monero', $_POST['monero'] );
    update_user_meta( $user_id, 'zcash', $_POST['zcash'] );
}