<?php

/**
 * Admin Functionality
 *
 * @since 2.0.0
 * @package BITMATE_AUTHOR_DONATIONS
 */

if ( ! defined( 'WPINC' ) ) {

    die;

}

/* Add BitMate Author Donations Settings Page */
function bm_author_donations_menu() {
    add_menu_page(
        'BitMate Author Donations Settings',
        'BitMate',
        'administrator',            
        'bm_settings',
        'bm_author_donations_settings_display',
        plugins_url( '../images/bitmate-icon.jpeg' , __FILE__ )
    );
    add_submenu_page(
        'bm_settings',
        'BitMate Author Donations Settings',
        'Display Settings',
        'administrator',            
        'bm_settings',
        'bm_author_donations_settings_display'
    );
    add_submenu_page(
        'bm_settings',
        'BitMate Author Donations Settings',
        'Getting Started',
        'administrator',            
        'bm_welcome',
        'bitmate_author_donations_welcome_page_content'
    );
} 
add_action('admin_menu', 'bm_author_donations_menu');

/* Provides default values for the Display Options */
function bitmate_author_donations_default_display_options() {

    $defaults = array(
        'display_bm_post_box'       =>  '1',
        'display_bm_author_credit'  =>  '',
        'display_bm_show_names'     =>  '1'
    );

    return apply_filters( 'bitmate_author_donations_default_display_options', $defaults );
}

function bm_author_donations_options() { 

    if( false == get_option( 'bitmate_author_donations_display_options' ) ) {   
        add_option( 'bitmate_author_donations_display_options', apply_filters( 'bitmate_author_donations_default_display_options', bitmate_author_donations_default_display_options() ) );
    }
 
    add_settings_section( 
        'bitmate_author_donations', 
        'Display Settings',  
        'bm_author_donations_options_callback', 
        'bitmate_author_donations_display_options'  
    ); 
     
    add_settings_field(   
        'display_bm_post_box', 
        'Display after posts',  
        'bm_toggle_author_donations_posts_callback',  
        'bitmate_author_donations_display_options',   
        'bitmate_author_donations',          
        array(                                
            '&nbsp;&nbsp;Enable this to automatically display the BitMate Author Donations box after all posts.'  
        )  
    );  
      
    add_settings_field(   
        'display_bm_show_names',                       
        'Show Asset Names',                
        'bm_toggle_author_donations_show_names_callback',    
        'bitmate_author_donations_display_options',                            
        'bitmate_author_donations',           
        array(                                
            '&nbsp;&nbsp; This displays the name of the cryptocurrency next to the icon.'  
        )  
    );  

    add_settings_field(   
        'display_bm_author_credit',                       
        'Display Credit Link',                
        'bm_toggle_author_donations_credit_callback',    
        'bitmate_author_donations_display_options',                            
        'bitmate_author_donations',           
        array(                                
            '&nbsp;&nbsp;This adds a simple "Powered By..." link. We really appreciate this but it is not required!'  
        )  
    );   
      
    register_setting(
        'bitmate_author_donations_display_options',
        'bitmate_author_donations_display_options'
    );
  
      
}   
add_action('admin_init', 'bm_author_donations_options'); 
  
/* Generate Section and Field Callbacks */
function bm_author_donations_options_callback() {  
    echo '<p>Configure the display options below. You can also manually use the <strong>[bitmate-author-donate]</strong> shortcode anywhere on your site.</p>';  
} 

function bm_toggle_author_donations_posts_callback($args) {
    
    $options = get_option('bitmate_author_donations_display_options');
    
    $html = '<input type="checkbox" id="display_bm_post_box" name="bitmate_author_donations_display_options[display_bm_post_box]" value="1" ' . checked( 1, isset( $options['display_bm_post_box'] ) ? $options['display_bm_post_box'] : 0, false ) . '/>'; 
    
    $html .= '<label for="display_bm_post_box">'  . $args[0] . '</label>'; 
    
    echo $html;
    
} 

function bm_toggle_author_donations_credit_callback($args) {
    
    $options = get_option('bitmate_author_donations_display_options');
    
    $html = '<input type="checkbox" id="display_bm_author_credit" name="bitmate_author_donations_display_options[display_bm_author_credit]" value="1" ' . checked( 1, isset( $options['display_bm_author_credit'] ) ? $options['display_bm_author_credit'] : 0, false ) . '/>'; 
    
    $html .= '<label for="display_bm_author_credit">'  . $args[0] . '</label>'; 
    
    echo $html;
    
} 

function bm_toggle_author_donations_show_names_callback($args) {
    
    $options = get_option('bitmate_author_donations_display_options');
    
    $html = '<input type="checkbox" id="display_bm_show_names" name="bitmate_author_donations_display_options[display_bm_show_names]" value="1" ' . checked( 1, isset( $options['display_bm_show_names'] ) ? $options['display_bm_show_names'] : 0, false ) . '/>'; 
    
    $html .= '<label for="display_bm_show_names">'  . $args[0] . '</label>'; 
    
    echo $html;
    
} 

/* Renders BitMate Author Donations Settings Page */
function bm_author_donations_settings_display() {
?>
    <div class="wrap">
        <div id="icon-themes" class="icon32"></div>
        <h2>BitMate Author Donations Settings</h2>

        <?php settings_errors(); ?> 
        <?php add_thickbox(); ?>
    
        <form method="post" action="options.php">
            <?php settings_fields( 'bitmate_author_donations_display_options' ); ?>
            <?php do_settings_sections( 'bitmate_author_donations_display_options' ); ?>
            <?php submit_button(); ?>
        </form>
        
        <?php bm_author_donations_admin_donations(); ?>
    </div>
<?php
} 

/* Generate BitMate Author Donation Admin Donation Box */
function bm_author_donations_admin_donations() {
    ?>
        <div class="bitmate-author-donation" id="bitmate-author-donation">
            <div class="bm-donation-encouragement">
                <h3>Like this plugin?</h3>
                <p>Send a cryptocurrency tip to support the development of BitMate Author Donations plugin.</p>
            </div>
            <ul class="bm-cc-links">
                <li class="bm-cc-btc"><a href="#bm-cc-btc"><i class="cf cf-btc"></i> Bitcoin</a></li>
                <li class="bm-cc-btc-alt"><a href="#bm-cc-btc-alt"><i class="cf cf-btc-alt"></i> Bitcoin Cash</a></li>
                <li class="bm-cc-eth"><a href="#bm-cc-eth"><i class="cf cf-eth"></i> Ethereum</a></li>
                <li class="bm-cc-ltc"><a href="#bm-cc-ltc"><i class="cf cf-ltc"></i> Litecoin</a></li>
                <li class="bm-cc-xmr"><a href="#bm-cc-xmr"><i class="cf cf-xmr"></i> Monero</a></li>
                <li class="bm-cc-zec"><a href="#bm-cc-zec"><i class="cf cf-zec"></i> ZCash</a></li>
            </ul>
            <div id="bm-cc-btc" class="bm-cc-tabs">
                <div class="bm-qr-code">
                    <img src="<?php echo plugins_url('../includes/qrme.php?', __FILE__); ?>1QHK34VSB4MqRUEXyXnUMDg56VEcvY7ND8 " alt="Scan to Donate Bitcoin to BitMate"/>
                </div>
                <div class="bm-window-detail">
                    <h3>Donate Bitcoin to BitMate</h3>
                    <div>Scan the QR code or copy the address below into your wallet to send some bitcoin:</div>
                    <input type="text" value="1QHK34VSB4MqRUEXyXnUMDg56VEcvY7ND8 " id="bitcoinAddress" class="bm-address" readonly>
                    <div class="bm-donate-buttons">
                        <a href="bitcoin:1QHK34VSB4MqRUEXyXnUMDg56VEcvY7ND8" title="Donate Bitcoin to BitMate" class="bm-button-donate bm-button-donate-btc"><i class="cf cf-btc"></i> Donate via Installed Wallet</a>
                        <button onclick="copyBitcoinAddress()" class="bm-button-copy" id="buttonBitcoinAddress">Copy</button>
                    </div>
                </div>
                <div class="bm-window-detail-close">
                    <a href="#bitmate-author-donation" class="bmHide">[X] Click Here to Hide Donation Details</a>
                </div>
                <script>
                function copyBitcoinAddress() {
                  var copyText = document.getElementById("bitcoinAddress");
                  copyText.select();
                  document.execCommand("Copy");
                  alert("Copied the Bitcoin Address: " + copyText.value);
                }
                </script>
            </div>
            <div id="bm-cc-btc-alt" class="bm-cc-tabs">
                <div class="bm-qr-code">
                    <img src="<?php echo plugins_url('../includes/qrme.php?', __FILE__); ?>16WdQvED6hGQZukDjx4i6rZ6foVy1Zhxav'" alt="Scan to Donate Bitcoin Cash to BitMate"/>
                </div>
                <div class="bm-window-detail">
                    <h3>Donate Bitcoin Cash to BitMate</h3>
                    Scan the QR code or copy the address below into your wallet to send bitcoin:
                    <input type="text" value="16WdQvED6hGQZukDjx4i6rZ6foVy1Zhxav" id="bitcoinCashAddress" class="bm-address" readonly>
                    <div class="bm-donate-buttons">
                        <a href="bitcoincash:16WdQvED6hGQZukDjx4i6rZ6foVy1Zhxav" title="Donate Bitcoin Cash to BitMate" class="bm-button-donate  bm-button-donate-btc-alt"><i class="cf cf-btc-alt"></i> Donate via Installed Wallet</a>
                        <button onclick="copyBitcoinCashAddress()" class="bm-button-copy" id="buttonBitcoinCashAddress">Copy</button>
                    </div>
                </div>
                <div class="bm-window-detail-close">
                    <a href="#bitmate-author-donation" class="bmHide">[X] Click Here to Hide Donation Details</a>
                </div>
                <script>
                function copyBitcoinCashAddress() {
                  var copyText = document.getElementById("bitcoinCashAddress");
                  copyText.select();
                  document.execCommand("Copy");
                  alert("Copied the Bitcoin Cash Address: " + copyText.value);
                }
                </script>
            </div>
            <div id="bm-cc-eth" class="bm-cc-tabs">
                <div class="bm-qr-code">
                    <img src="<?php echo plugins_url('../includes/qrme.php?', __FILE__); ?>0x0577eb2088d03eecf093085544909b110cd94728" alt="Scan to Donate Ethereum to BitMate"/>
                </div>
                <div class="bm-window-detail">
                    <h3>Donate Ethereum to BitMate</h3>
                    <div>Scan the QR code or copy the address below into your wallet to send some Ether:</div>
                    <input type="text" value="0x0577eb2088d03eecf093085544909b110cd94728" id="ethereumAddress" class="bm-address" readonly>
                    <div class="bm-donate-buttons">
                        <a href="ethereum:0x0577eb2088d03eecf093085544909b110cd94728" title="Donate Ethereum to BitMate" class="bm-button-donate bm-button-donate-eth"><i class="cf cf-eth"></i> Donate via Installed Wallet</a>
                        <button onclick="copyEthereumAddress()" class="bm-button-copy" id="buttonEthereumAddress">Copy</button>
                    </div>
                </div>
                <div class="bm-window-detail-close">
                    <a href="#bitmate-author-donation" class="bmHide">[X] Click Here to Hide Donation Details</a>
                </div>
                <script>
                function copyEthereumAddress() {
                  var copyText = document.getElementById("ethereumAddress");
                  copyText.select();
                  document.execCommand("Copy");
                  alert("Copied the Ethereum Address: " + copyText.value);
                }
                </script>
            </div>
            <div id="bm-cc-ltc" class="bm-cc-tabs">
                <div class="bm-qr-code">
                    <img src="<?php echo plugins_url('../includes/qrme.php?', __FILE__); ?>LWcXPjsmyEHDS9yXShjrpgYe6Sfha94iLy" alt="Scan to Donate Litecoin to BitMate"/>
                </div>
                <div class="bm-window-detail">
                    <h3>Donate Litecoin to BitMate</h3>
                    <div>Scan the QR code or copy the address below into your wallet to send some Litecoin:</div>
                    <input type="text" value="LWcXPjsmyEHDS9yXShjrpgYe6Sfha94iLy" id="litecoinAddress" class="bm-address" readonly>
                    <div class="bm-donate-buttons">
                        <a href="litecoin:LWcXPjsmyEHDS9yXShjrpgYe6Sfha94iLy" title="Donate Litecoin to BitMate" class="bm-button-donate bm-button-donate-ltc"><i class="cf cf-ltc"></i> Donate via Installed Wallet</a>
                        <button onclick="copyLitecoinAddress()" class="bm-button-copy" id="buttonLitecoinAddress">Copy</button>
                    </div>
                </div>
                <div class="bm-window-detail-close">
                    <a href="#bitmate-author-donation" class="bmHide">[X] Click Here to Hide Donation Details</a>
                </div>
                <script>
                function copyLitecoinAddress() {
                  var copyText = document.getElementById("litecoinAddress");
                  copyText.select();
                  document.execCommand("Copy");
                  alert("Copied the Litecoin Address: " + copyText.value);
                }
                </script>
            </div>
            <div id="bm-cc-xmr" class="bm-cc-tabs">
                <div class="bm-qr-code">
                    <img src="<?php echo plugins_url('../includes/qrme.php?', __FILE__); ?>446bYKR3hLnVtBt5NqKEYKAAh6DjSw2s55SxCbyJLfPU5fwpXsnbatXGzmXdZNJHZ4Wa5bn3uhaG2cghkBGX2vWcCL2gNmi3uhaG2cghkBGX2vWcCL2gNmi" alt="Scan to Donate Monero to BitMate"/>
                </div>
                <div class="bm-window-detail">
                    <h3>Donate Monero to BitMate</h3>
                    <div>Scan the QR code or copy the address below into your wallet to send some Monero:</div>
                    <input type="text" value="446bYKR3hLnVtBt5NqKEYKAAh6DjSw2s55SxCbyJLfPU5fwpXsnbatXGzmXdZNJHZ4Wa5bn3uhaG2cghkBGX2vWcCL2gNmi3uhaG2cghkBGX2vWcCL2gNmi" id="moneroAddress" class="bm-address" readonly>
                    <div class="bm-donate-buttons">
                        <a href="monero:446bYKR3hLnVtBt5NqKEYKAAh6DjSw2s55SxCbyJLfPU5fwpXsnbatXGzmXdZNJHZ4Wa5bn3uhaG2cghkBGX2vWcCL2gNmi3uhaG2cghkBGX2vWcCL2gNmi" title="Donate Monero to BitMate" class="bm-button-donate bm-button-donate-xmr"><i class="cf cf-xmr"></i> Donate via Installed Wallet</a>
                        <button onclick="copyMoneroAddress()" class="bm-button-copy" id="buttonMoneroAddress">Copy</button>
                    </div>
                </div>
                <div class="bm-window-detail-close">
                    <a href="#bitmate-author-donation" class="bmHide">[X] Click Here to Hide Donation Details</a>
                </div>
                <script>
                function copyMoneroAddress() {
                  var copyText = document.getElementById("moneroAddress");
                  copyText.select();
                  document.execCommand("Copy");
                  alert("Copied the Monero Address: " + copyText.value);
                }
                </script>
            </div>
            <div id="bm-cc-zec" class="bm-cc-tabs">
                <div class="bm-qr-code">
                    <img src="<?php echo plugins_url('../includes/qrme.php?', __FILE__); ?>t1PsNg2sHTPjFZn5HfMBViFcDoYaxX4vgNZ" alt="Scan to Donate ZCash to BitMate"/>
                </div>
                <div class="bm-window-detail">
                    <h3>Donate ZCash to BitMate</h3>
                    <div>Scan the QR code or copy the address below into your wallet to send some ZCash:</div>
                    <input type="text" value="t1PsNg2sHTPjFZn5HfMBViFcDoYaxX4vgNZ" id="zcashAddress" class="bm-address" readonly>
                    <div class="bm-donate-buttons">
                        <button onclick="copyZcashAddress()" class="bm-button-donate bm-button-donate-zec" id="buttonZcashAddress"><i class="cf cf-zec"></i> Copy ZCash Address</button>
                    </div>
                </div>
                <div class="bm-window-detail-close">
                    <a href="#bitmate-author-donation" class="bmHide">[X] Click Here to Hide Donation Details</a>
                </div>
                <script>
                function copyZcashAddress() {
                  var copyText = document.getElementById("zcashAddress");
                  copyText.select();
                  document.execCommand("Copy");
                  alert("Copied the ZCash Address: " + copyText.value);
                }
                </script>
            </div>
            <script>
                jQuery('.bm-button-copy').css('display','inline');
            </script>
            <script>
            // Stop href="#hashtarget" links jumping around the page
            var hashLinks = document.querySelectorAll("a[href^='#']");
            [].forEach.call(hashLinks, function (link) {
                link.addEventListener("click", function (event) {
                    event.preventDefault();
                    history.pushState({}, "", link.href);
                    history.pushState({}, "", link.href);
                    history.back();
                });
            });
            </script>
        </div>
        <?php
}

/**
 * Add Persistently Dismissable Admin Notice to Update Cryptocurrency Addresses
 */

function bm_deprecated_hook_admin_notice() {
        $bm_profile_url = get_edit_user_link();
        $bm_notice = sprintf( wp_kses( __( 'You can now add multiple Cryptocurrency addresses via your <a href="%s">user profile</a> with BitMate Author Donations.', 'bitmate-author-donations' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $bm_profile_url ) );
        // Check if it's been dismissed...
        if ( ! get_option('dismissed-bm_deprecated', FALSE ) ) { 
        ?>
            <div class="updated notice notice-bm-ad is-dismissible" data-notice="bm_deprecated">
                <p><?php echo $bm_notice; ?></p>
            </div>
        <?php }
}
add_action( 'admin_notices', 'bm_deprecated_hook_admin_notice' );

/* AJAX handler to store the state of dismissible notices. */
function ajax_notice_handler() {
    $type = $_POST['type'];
    update_option( 'dismissed-' . $type, TRUE );
}
add_action( 'wp_ajax_dismissed_notice_handler', 'ajax_notice_handler' );