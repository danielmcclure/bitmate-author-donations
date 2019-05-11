<?php

/**
 * BitMate Author Donations
 *
 * @link              https://www.bitmate.net/author-donations/
 * @since             2.1
 * @package           BitMate_Author_Donations
 *
 * @wordpress-plguin
 * Plugin Name: BitMate Author Donations
 * Plugin URI: https://www.bitmate.net/author-donations/
 * Description: Adds cryptocurrency address fields to user profiles so that authors can accept bitcoin donations via an automatically generated donation box after their posts.
 * Version: 2.1.0
 * Author: BitMate
 * Author URI: https://www.bitmate.net
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       bitmate-author-donations
 * Domain Path:       /languages
 * Requires at least: 4.6
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

    die;

}

// Plugin version.
if ( ! defined( 'BITMATE_AUTHOR_DONATIONS_VERSION' ) ) {

    define( 'BITMATE_AUTHOR_DONATIONS_VERSION', '2.0.1' );

}

// Plugin folder name.
if ( ! defined( 'BITMATE_AUTHOR_DONATIONS_NAME' ) ) {

    define( 'BITMATE_AUTHOR_DONATIONS_NAME', trim( dirname( plugin_basename( __FILE__ ) ), '/' ) );

}

// Plugin directory, including the folder.
if ( ! defined( 'BITMATE_AUTHOR_DONATIONS_DIR' ) ) {

    define( 'BITMATE_AUTHOR_DONATIONS_DIR', WP_PLUGIN_DIR . '/' . BITMATE_AUTHOR_DONATIONS_NAME );

}

// Plugin url, including the folder.
if ( ! defined( 'BITMATE_AUTHOR_DONATIONS_URL' ) ) {

    define( 'BITMATE_AUTHOR_DONATIONS_URL', WP_PLUGIN_URL . '/' . BITMATE_AUTHOR_DONATIONS_NAME );

}

// Plugin root file.
if ( ! defined( 'BITMATE_AUTHOR_DONATIONS_PLUGIN_FILE' ) ) {

    define( 'BITMATE_AUTHOR_DONATIONS_PLUGIN_FILE', __FILE__ );

}


if ( file_exists( BITMATE_AUTHOR_DONATIONS_DIR . '/admin/bm-admin.php' ) ) {

    require_once( BITMATE_AUTHOR_DONATIONS_DIR . '/admin/bm-admin.php' );

}

if ( file_exists( BITMATE_AUTHOR_DONATIONS_DIR . '/admin/bm-users.php' ) ) {

    require_once( BITMATE_AUTHOR_DONATIONS_DIR . '/admin/bm-users.php' );

}

if ( file_exists( BITMATE_AUTHOR_DONATIONS_DIR . '/welcome/welcome-init.php' ) ) {

    require_once( BITMATE_AUTHOR_DONATIONS_DIR . '/welcome/welcome-init.php' );

}

if ( file_exists( BITMATE_AUTHOR_DONATIONS_DIR . '/welcome/welcome-logic.php' ) ) {

    require_once( BITMATE_AUTHOR_DONATIONS_DIR . '/welcome/welcome-logic.php' );

}


/**
 * Load plugin textdomain.
 */
function bm_author_donations_load_plugin_textdomain() {
    load_plugin_textdomain( 'bitmate-author-donations', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
//add_action( 'init', 'bm_author_donations_load_plugin_textdomain' );

/* Register and Enqueue Bitmate Author Donations Scripts & Stylesheets */
add_action( 'wp_enqueue_scripts', 'bm_author_donations_stylesheet' );

function bm_author_donations_stylesheet() {
    // Styles
    wp_register_style( 'bm-author-donations-style', plugins_url('style.css', __FILE__) );
    wp_register_style( 'bm-crypto-font', plugins_url('/css/cryptofont.min.css', __FILE__) );
    wp_enqueue_style( 'bm-crypto-font' );
    wp_enqueue_style( 'bm-author-donations-style' );
}


/* Register and Enqueue Bitmate Author Donations Admin Scripts & Stylesheets */
function bm_load_admin_scripts() {
	// Styles
	wp_register_style( 'bm-author-donations-style', plugins_url('style.css', __FILE__) );
    wp_register_style( 'bm-crypto-font', plugins_url('/css/cryptofont.min.css', __FILE__) );
    wp_enqueue_style( 'bm-crypto-font' );
    wp_enqueue_style( 'bm-author-donations-style' );

    // Scripts
    wp_enqueue_script( 'bm-admin-js', plugins_url( '/js/bm-admin.js' , __FILE__ ) );
}
add_action('admin_enqueue_scripts', 'bm_load_admin_scripts');

/* Add BitMate Donation Box After Posts */
add_filter( 'the_content', 'bm_author_donation_box' );

function bm_author_donation_box($content) {

	$display_options = get_option( 'bitmate_author_donations_display_options' );

	if( isset( $display_options['display_bm_post_box'] ) && $display_options[ 'display_bm_post_box' ] ) { 

		$bm_site_name = get_bloginfo( 'name' );
		$bm_author_name = get_the_author_meta( 'display_name' );
		$bm_post_url = get_permalink();
		$bm_author_bitcoin = get_the_author_meta( 'bitcoin' );
		$bm_author_bitcoincash = get_the_author_meta( 'bitcoincash' );
		$bm_author_ethereum = get_the_author_meta( 'ethereum' );
		$bm_author_litecoin = get_the_author_meta( 'litecoin' );
		$bm_author_monero = get_the_author_meta( 'monero' );
		$bm_author_zcash = get_the_author_meta( 'zcash' );
		$bm_author_bitcoin_url = 'bitcoin:'. $bm_author_bitcoin.'?label='. urlencode($bm_site_name) .'%3A%20'. urlencode($bm_author_name) .'&message=Donation%20for%3A'. urlencode($bm_post_url) .'';
		$bm_author_bitcoincash_url = 'bitcoincash:'. $bm_author_bitcoincash.'?label='. urlencode($bm_site_name) .'%3A%20'. urlencode($bm_author_name) .'&message=Donation%20for%3A'. urlencode($bm_post_url) .'';
		$bm_author_ethereum_url = 'ethereum:'. $bm_author_ethereum;
		$bm_author_litecoin_url = 'litecoin:'. $bm_author_litecoin;
		$bm_author_monero_url = 'monero:'. $bm_author_monero;
		// Does not appear to be standardised URI format 04/02/2018 - $bm_author_zcash_url = 'zcash:'. $bm_author_zcash;

		// Strings for Translation
		$bm_like_this = __('Did you like this?', 'bitmate-author-donations');
		$bm_donate_bitcoin_to = __('Donate Bitcoin to', 'bitmate-author-donations');
		$bm_donate_bitcoin_cash_to = __('Donate Bitcoin Cash to', 'bitmate-author-donations');
		$bm_donate_ethereum_to = __('Donate Ethereum to', 'bitmate-author-donations');
		$bm_donate_litecoin_to = __('Donate Litecoin to', 'bitmate-author-donations');
		$bm_donate_monero_to = __('Donate Monero to', 'bitmate-author-donations');
		$bm_donate_zcash_to = __('Donate ZCash to', 'bitmate-author-donations');
		$bm_crypto_tip_to = __('Send a Cryptocurrency Donation to ', 'bitmate-author-donations');
		$bm_bitcoin_tip_to = __('Send a Bitcoin Donation to', 'bitmate-author-donations');
		$bm_bitcoin_cash_tip_to = __('Send a Bitcoin Cash Donation to', 'bitmate-author-donations');
		$bm_ethereum_tip_to = __('Send a Ethereum Donation to', 'bitmate-author-donations');
		$bm_litecoin_tip_to = __('Send a Litecoin Donation to', 'bitmate-author-donations');
		$bm_monero_tip_to = __('Send a Monero Donation to', 'bitmate-author-donations');
		$bm_zcash_tip_to = __('Send a ZCash Donation to', 'bitmate-author-donations');
		$bm_scan_to_donate = __('Scan to Donate to', 'bitmate-author-donations');
		$bm_donation_encouragement_instructions = __('Scan the QR code or copy the address below into your wallet to send your donation:', 'bitmate-author-donations');
		$bm_donation_encouragement_button = __('Donate via Installed Wallet', 'bitmate-author-donations');
		$bm_copy = __('Copy', 'bitmate-author-donations');
		$bm_close = __('[X] Click Here to Hide Donation Details', 'bitmate-author-donations');
		$bm_credit_text = __('Powered by BitMate Author Donations', 'bitmate-author-donations');
		
		if( isset( $display_options['display_bm_author_credit'] ) && $display_options[ 'display_bm_author_credit' ] ) {
			$bm_author_credit = '<small class="bitmate-author-credit"><a href="https://www.bitmate.net/author-donations/" rel="nofollow" class="bitmate-author-credit">'. $bm_credit_text .'</a></small>';
		} else {
			$bm_author_credit = '';
		}

		// Set empty names
		$bm_cc_link_bitcoin = '';
		$bm_cc_link_bitcoincash = '';
		$bm_cc_link_ethereum = '';
		$bm_cc_link_litecoin = '';
		$bm_cc_link_monero = '';
		$bm_cc_link_zcash = '';
		if( isset( $display_options['display_bm_show_names'] ) && $display_options[ 'display_bm_show_names' ] ) {
			$bm_cc_link_bitcoin = ' Bitcoin';
			$bm_cc_link_bitcoincash = ' Bitcoin Cash';
			$bm_cc_link_ethereum = ' Ethereum';
			$bm_cc_link_litecoin = ' Litecoin';
			$bm_cc_link_monero = ' Monero';
			$bm_cc_link_zcash = ' ZCash';
		}

		$bm_cc_links = '';
		if (get_the_author_meta( 'bitcoin' )) {
			$bm_cc_links = '<li class="bm-cc-btc"><a href="#bm-cc-btc"><i class="cf cf-btc"></i>'.$bm_cc_link_bitcoin.'</a></li>';
		}
		if (get_the_author_meta( 'bitcoincash' )) {
			$bm_cc_links = $bm_cc_links.'<li class="bm-cc-btc-alt"><a href="#bm-cc-btc-alt"><i class="cf cf-btc-alt"></i>'.$bm_cc_link_bitcoincash.'</a></li>';
		}
		if (get_the_author_meta( 'ethereum' )) {
			$bm_cc_links = $bm_cc_links.'<li class="bm-cc-eth"><a href="#bm-cc-eth"><i class="cf cf-eth"></i>'.$bm_cc_link_ethereum.'</a></li>';
		}
		if (get_the_author_meta( 'litecoin' )) {
			$bm_cc_links = $bm_cc_links.'<li class="bm-cc-ltc"><a href="#bm-cc-ltc"><i class="cf cf-ltc"></i>'.$bm_cc_link_litecoin.'</a></li>';
		}
		if (get_the_author_meta( 'monero' )) {
			$bm_cc_links = $bm_cc_links.'<li class="bm-cc-xmr"><a href="#bm-cc-xmr"><i class="cf cf-xmr"></i>'.$bm_cc_link_monero.'</a></li>';
		}
		if (get_the_author_meta( 'zcash' )) {
			$bm_cc_links = $bm_cc_links.'<li class="bm-cc-zec"><a href="#bm-cc-zec"><i class="cf cf-zec"></i>'.$bm_cc_link_zcash.'</a></li>';
		}
		
		if( (get_the_author_meta( 'bitcoin' )) && !( (get_the_author_meta( 'bitcoincash' )) || (get_the_author_meta( 'ethereum' )) || (get_the_author_meta( 'litecoin' )) || (get_the_author_meta( 'monero' )) || (get_the_author_meta( 'zcash' )) )) {
			$bm_donation_box='
				<div class="bitmate-author-donation" id="bitmate-author-donation">
					<div id="bm-cc-btc" class="bm-cc-tabs" style="border: none !important; display:block !important;">
					    <div class="bm-qr-code">
					    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_bitcoin.'" alt="'. $bm_scan_to_donate . ' ' . $bm_author_name .'"/>
					    </div><div class="bm-window-detail">
					    <div class="bm-classic"><strong>'.$bm_like_this.'</strong><br/>'.$bm_bitcoin_tip_to . ' ' .$bm_author_name.'</div>
					    <input type="text" value="'.$bm_author_bitcoin.'" id="bitcoinAddress" class="bm-address" class="bm-address" readonly>
					    <div class="bm-donate-buttons">
					    	<a href="'.$bm_author_bitcoin_url.'" title="'.$bm_bitcoin_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-btc"><i class="cf cf-btc"></i> '. $bm_donation_encouragement_button .'</a>
					    	<button onclick="copyBitcoinAddress()" class="bm-button-copy" id="buttonBitcoinAddress">'. $bm_copy .'</button>
					    </div>
					    </div>
					    '. $bm_author_credit .'
					    <script>
						function copyBitcoinAddress() {
						  var copyText = document.getElementById("bitcoinAddress");
						  copyText.select();
						  document.execCommand("Copy");
						  alert("Copied the Bitcoin Address: " + copyText.value);
						}
						</script>
					</div>
					<script>
						jQuery(\'.bm-button-copy\').css(\'display\',\'inline\');
					</script>
				</div>
			';
		} else {
			$bm_donation_box='
				<div class="bitmate-author-donation" id="bitmate-author-donation">
					<div class="bm-donation-encouragement"><strong>'.$bm_like_this.'</strong><br/>'.$bm_crypto_tip_to.' '.$bm_author_name.'</div>
					<ul class="bm-cc-links">
						'.$bm_cc_links.'
					</ul>
					'. $bm_author_credit .'
					<div id="bm-cc-btc" class="bm-cc-tabs">
					    <h3>Donate Bitcoin to '.$bm_author_name.'</h3>
					    <div class="bm-qr-code">
					    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_bitcoin.'" alt="' . $bm_scan_to_donate. ' '. $bm_author_name .'"/>
					    </div><div class="bm-window-detail">
					    <div>'. $bm_donation_encouragement_instructions . '</div>
					    <input type="text" value="'.$bm_author_bitcoin.'" id="bitcoinAddress" class="bm-address" readonly>
					    <div class="bm-donate-buttons">
					    	<a href="'.$bm_author_bitcoin_url.'" title="'.$bm_bitcoin_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-btc"><i class="cf cf-btc"></i> '. $bm_donation_encouragement_button .'</a>
					    	<button onclick="copyBitcoinAddress()" class="bm-button-copy" id="buttonBitcoinAddress">'. $bm_copy .'</button>
					    </div>
					    </div>
					    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
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
					    <h3>Donate Bitcoin Cash to '.$bm_author_name.'</h3>
					    <div class="bm-qr-code">
					    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_bitcoincash.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
					    </div><div class="bm-window-detail">
					    <div>'. $bm_donation_encouragement_instructions . '</div>
					    <input type="text" value="'.$bm_author_bitcoincash.'" id="bitcoinCashAddress" class="bm-address" readonly>
					    <div class="bm-donate-buttons">
					    	<a href="'.$bm_author_bitcoincash_url.'" title="'.$bm_bitcoin_cash_tip_to.' '.$bm_author_name.'" class="bm-button-donate  bm-button-donate-btc-alt"><i class="cf cf-btc-alt"></i> '. $bm_donation_encouragement_button .'</a>
					    	<button onclick="copyBitcoinCashAddress()" class="bm-button-copy" id="buttonBitcoinCashAddress">'. $bm_copy .'</button>
					    </div>
					    </div>
					    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
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
					    <h3>Donate Ethereum to '.$bm_author_name.'</h3>
					    <div class="bm-qr-code">
					    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_ethereum.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
					    </div><div class="bm-window-detail">
					    <div>'. $bm_donation_encouragement_instructions . '</div>
					    <input type="text" value="'.$bm_author_ethereum.'" id="ethereumAddress" class="bm-address" readonly>
					    <div class="bm-donate-buttons">
					    	<a href="'.$bm_author_ethereum_url.'" title="'.$bm_ethereum_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-eth"><i class="cf cf-eth"></i> '. $bm_donation_encouragement_button .'</a>
					    	<button onclick="copyEthereumAddress()" class="bm-button-copy" id="buttonEthereumAddress">'. $bm_copy .'</button>
					    </div>
					    </div>
					    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
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
					    <h3>Donate Litecoin to '.$bm_author_name.'</h3>
					    <div class="bm-qr-code">
					    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_litecoin.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
					    </div><div class="bm-window-detail">
					    <div>'. $bm_donation_encouragement_instructions . '</div>
					    <input type="text" value="'.$bm_author_litecoin.'" id="litecoinAddress" class="bm-address" readonly>
					    <div class="bm-donate-buttons">
					    	<a href="'.$bm_author_litecoin_url.'" title="'.$bm_litecoin_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-ltc"><i class="cf cf-ltc"></i> '. $bm_donation_encouragement_button .'</a>
					    	<button onclick="copyLitecoinAddress()" class="bm-button-copy" id="buttonLitecoinAddress">'. $bm_copy .'</button>
					    </div>
					    </div>
					    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
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
					    <h3>Donate Monero to '.$bm_author_name.'</h3>
					    <div class="bm-qr-code">
					    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_monero.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
					    </div><div class="bm-window-detail">
					    <div>'. $bm_donation_encouragement_instructions . '</div>
					    <input type="text" value="'.$bm_author_monero.'" id="moneroAddress" class="bm-address" readonly>
					    <div class="bm-donate-buttons">
					    	<a href="'.$bm_author_monero_url.'" title="'.$bm_monero_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-xmr"><i class="cf cf-xmr"></i> '. $bm_donation_encouragement_button .'</a>
					    	<button onclick="copyMoneroAddress()" class="bm-button-copy" id="buttonMoneroAddress">'. $bm_copy .'</button>
					    </div>
					    </div>
					    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
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
					    <h3>Donate ZCash to '.$bm_author_name.'</h3>
					    <div class="bm-qr-code">
					    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_zcash.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
					    </div><div class="bm-window-detail">
					    <div>'. $bm_donation_encouragement_instructions . '</div>
					    <input type="text" value="'.$bm_author_zcash.'" id="zcashAddress" class="bm-address" readonly>
					    <div class="bm-donate-buttons">
					    	<button onclick="copyZcashAddress()" class="bm-button-donate bm-button-donate-zec" id="buttonZcashAddress"><i class="cf cf-zec"></i> Copy ZCash Address</button>
					    </div>
					    </div>
					    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
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
						jQuery(\'.bm-button-copy\').css(\'display\',\'inline\');
					</script>
					<script>
					// Stop href="#hashtarget" links jumping around the page
					var hashLinks = document.querySelectorAll("a[href^=\'#\']");
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
			';
		}
		
		if ( (get_the_author_meta( 'bitcoin' ) || get_the_author_meta( 'bitcoincash' ) || get_the_author_meta( 'ethereum' ) || get_the_author_meta( 'litecoin' ) || get_the_author_meta( 'monero' ) || get_the_author_meta( 'zcash' )) && !is_page() ) { 
			return $content.$bm_donation_box;
		} else {
			return $content;
		}
	} else {
		return $content;
	}
}

/* Add BitMate Donation Box Shortcode */
function bm_author_donate_shortcode() {

	$display_options = get_option( 'bitmate_author_donations_display_options' );

	$bm_site_name = get_bloginfo( 'name' );
	$bm_author_name = get_the_author_meta( 'display_name' );
	$bm_post_url = get_permalink();
	$bm_author_bitcoin = get_the_author_meta( 'bitcoin' );
	$bm_author_bitcoincash = get_the_author_meta( 'bitcoincash' );
	$bm_author_ethereum = get_the_author_meta( 'ethereum' );
	$bm_author_litecoin = get_the_author_meta( 'litecoin' );
	$bm_author_monero = get_the_author_meta( 'monero' );
	$bm_author_zcash = get_the_author_meta( 'zcash' );
	$bm_author_bitcoin_url = 'bitcoin:'. $bm_author_bitcoin.'?label='. urlencode($bm_site_name) .'%3A%20'. urlencode($bm_author_name) .'&message=Donation%20for%3A'. urlencode($bm_post_url) .'';
	$bm_author_bitcoincash_url = 'bitcoincash:'. $bm_author_bitcoincash.'?label='. urlencode($bm_site_name) .'%3A%20'. urlencode($bm_author_name) .'&message=Donation%20for%3A'. urlencode($bm_post_url) .'';
	$bm_author_ethereum_url = 'ethereum:'. $bm_author_ethereum;
	$bm_author_litecoin_url = 'litecoin:'. $bm_author_litecoin;
	$bm_author_monero_url = 'monero:'. $bm_author_monero;
	// Does not appear to be standardised URI format 04/02/2018 - $bm_author_zcash_url = 'zcash:'. $bm_author_zcash;

	// Strings for Translation
	$bm_like_this = __('Did you like this?', 'bitmate-author-donations');
	$bm_donate_bitcoin_to = __('Donate Bitcoin to', 'bitmate-author-donations');
	$bm_donate_bitcoin_cash_to = __('Donate Bitcoin Cash to', 'bitmate-author-donations');
	$bm_donate_ethereum_to = __('Donate Ethereum to', 'bitmate-author-donations');
	$bm_donate_litecoin_to = __('Donate Litecoin to', 'bitmate-author-donations');
	$bm_donate_monero_to = __('Donate Monero to', 'bitmate-author-donations');
	$bm_donate_zcash_to = __('Donate ZCash to', 'bitmate-author-donations');
	$bm_crypto_tip_to = __('Send a Cryptocurrency Donation to ', 'bitmate-author-donations');
	$bm_bitcoin_tip_to = __('Send a Bitcoin Donation to', 'bitmate-author-donations');
	$bm_bitcoin_cash_tip_to = __('Send a Bitcoin Cash Donation to', 'bitmate-author-donations');
	$bm_ethereum_tip_to = __('Send a Ethereum Donation to', 'bitmate-author-donations');
	$bm_litecoin_tip_to = __('Send a Litecoin Donation to', 'bitmate-author-donations');
	$bm_monero_tip_to = __('Send a Monero Donation to', 'bitmate-author-donations');
	$bm_zcash_tip_to = __('Send a ZCash Donation to', 'bitmate-author-donations');
	$bm_scan_to_donate = __('Scan to Donate to', 'bitmate-author-donations');
	$bm_donation_encouragement_instructions = __('Scan the QR code or copy the address below into your wallet to send your donation:', 'bitmate-author-donations');
	$bm_donation_encouragement_button = __('Donate via Installed Wallet', 'bitmate-author-donations');
	$bm_copy = __('Copy', 'bitmate-author-donations');
	$bm_close = __('[X] Click Here to Hide Donation Details', 'bitmate-author-donations');
	$bm_credit_text = __('Powered by BitMate Author Donations', 'bitmate-author-donations');

	if( isset( $display_options['display_bm_author_credit'] ) && $display_options[ 'display_bm_author_credit' ] ) {
		$bm_author_credit = '<small class="bitmate-author-credit"><a href="https://www.bitmate.net/author-donations/" rel="nofollow" class="bitmate-author-credit">'. $bm_credit_text .'</a></small>';
	} else {
		$bm_author_credit = '';
	}

	// Set empty names
	$bm_cc_link_bitcoin = '';
	$bm_cc_link_bitcoincash = '';
	$bm_cc_link_ethereum = '';
	$bm_cc_link_litecoin = '';
	$bm_cc_link_monero = '';
	$bm_cc_link_zcash = '';
	if( isset( $display_options['display_bm_show_names'] ) && $display_options[ 'display_bm_show_names' ] ) {
		$bm_cc_link_bitcoin = ' Bitcoin';
		$bm_cc_link_bitcoincash = ' Bitcoin Cash';
		$bm_cc_link_ethereum = ' Ethereum';
		$bm_cc_link_litecoin = ' Litecoin';
		$bm_cc_link_monero = ' Monero';
		$bm_cc_link_zcash = ' ZCash';
	}

	$bm_cc_links = '';
	if (get_the_author_meta( 'bitcoin' )) {
		$bm_cc_links = '<li class="bm-cc-btc"><a href="#bm-sc-cc-btc"><i class="cf cf-btc"></i>'.$bm_cc_link_bitcoin.'</a></li>';
	}
	if (get_the_author_meta( 'bitcoincash' )) {
		$bm_cc_links = $bm_cc_links.'<li class="bm-cc-btc-alt"><a href="#bm-sc-cc-btc-alt"><i class="cf cf-btc-alt"></i>'.$bm_cc_link_bitcoincash.'</a></li>';
	}
	if (get_the_author_meta( 'ethereum' )) {
		$bm_cc_links = $bm_cc_links.'<li class="bm-cc-eth"><a href="#bm-sc-cc-eth"><i class="cf cf-eth"></i>'.$bm_cc_link_ethereum.'</a></li>';
	}
	if (get_the_author_meta( 'litecoin' )) {
		$bm_cc_links = $bm_cc_links.'<li class="bm-cc-ltc"><a href="#bm-sc-cc-ltc"><i class="cf cf-ltc"></i>'.$bm_cc_link_litecoin.'</a></li>';
	}
	if (get_the_author_meta( 'monero' )) {
		$bm_cc_links = $bm_cc_links.'<li class="bm-cc-xmr"><a href="#bm-sc-cc-xmr"><i class="cf cf-xmr"></i>'.$bm_cc_link_monero.'</a></li>';
	}
	if (get_the_author_meta( 'zcash' )) {
		$bm_cc_links = $bm_cc_links.'<li class="bm-cc-zec"><a href="#bm-sc-cc-zec"><i class="cf cf-zec"></i>'.$bm_cc_link_zcash.'</a></li>';
	}
	
	if( (get_the_author_meta( 'bitcoin' )) && !( (get_the_author_meta( 'bitcoincash' )) || (get_the_author_meta( 'ethereum' )) || (get_the_author_meta( 'litecoin' )) || (get_the_author_meta( 'monero' )) || (get_the_author_meta( 'zcash' )) )) {
		$bm_donation_box='
			<div class="bitmate-author-donation bm-ad-sc" id="bitmate-author-donation bm-ad-sc">
				<div id="bm-cc-btc" class="bm-cc-tabs" style="border: none !important; display:block !important;">
				    <div class="bm-qr-code">
				    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_bitcoin.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
				    </div><div class="bm-window-detail">
				    <div class="bm-classic"><strong>'.$bm_like_this.'</strong><br/>'.$bm_bitcoin_tip_to.' '.$bm_author_name.'</div>
				    <input type="text" value="'.$bm_author_bitcoin.'" id="bitcoinAddress" class="bm-address" readonly>
				    <div class="bm-donate-buttons">
				    	<a href="'.$bm_author_bitcoin_url.'" title="'.$bm_bitcoin_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-btc"><i class="cf cf-btc"></i> '. $bm_donation_encouragement_button .'</a>
				    	<button onclick="copyBitcoinAddress()" class="bm-button-copy" id="buttonBitcoinAddress">'. $bm_copy .'</button>
				    </div>
				    </div>
				    '. $bm_author_credit .'
				    <script>
					function copyBitcoinAddress() {
					  var copyText = document.getElementById("bitcoinAddress");
					  copyText.select();
					  document.execCommand("Copy");
					  alert("Copied the Bitcoin Address: " + copyText.value);
					}
					</script>
				</div>
				<script>
					jQuery(\'.bm-button-copy\').css(\'display\',\'inline\');
				</script>
			</div>
		';
	} else {
		$bm_donation_box='
			<div class="bitmate-author-donation" id="bitmate-author-donation">
				<div class="bm-donation-encouragement"><strong>'.$bm_like_this.'</strong><br/>'.$bm_crypto_tip_to.' ' .$bm_author_name.'</div>
				<ul class="bm-cc-links">
					'.$bm_cc_links.'
				</ul>
				'. $bm_author_credit .'
				<div id="bm-sc-cc-btc" class="bm-cc-tabs">
				    <h3>'.$bm_donate_bitcoin_to.' '.$bm_author_name.'</h3>
				    <div class="bm-qr-code">
				    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_bitcoin.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
				    </div><div class="bm-window-detail">
				    <div>'. $bm_donation_encouragement_instructions . '</div>
				    <input type="text" value="'.$bm_author_bitcoin.'" id="bitcoinAddress" class="bm-address" readonly>
				    <div class="bm-donate-buttons">
				    	<a href="'.$bm_author_bitcoin_url.'" title="'.$bm_bitcoin_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-btc"><i class="cf cf-btc"></i> '. $bm_donation_encouragement_button .'</a>
				    	<button onclick="copyBitcoinAddress()" class="bm-button-copy" id="buttonBitcoinAddress">'. $bm_copy .'</button>
				    </div>
				    </div>
				    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
				    <script>
					function copyBitcoinAddress() {
					  var copyText = document.getElementById("bitcoinAddress");
					  copyText.select();
					  document.execCommand("Copy");
					  alert("Copied the Bitcoin Address: " + copyText.value);
					}
					</script>
				</div>
				<div id="bm-sc-cc-btc-alt" class="bm-cc-tabs">
				    <h3>'.$bm_donate_bitcoin_cash_to.' '.$bm_author_name.'</h3>
				    <div class="bm-qr-code">
				    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_bitcoincash.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
				    </div><div class="bm-window-detail">
				    <div>'. $bm_donation_encouragement_instructions . '</div>
				    <input type="text" value="'.$bm_author_bitcoincash.'" id="bitcoinCashAddress" class="bm-address" readonly>
				    <div class="bm-donate-buttons">
				    	<a href="'.$bm_author_bitcoincash_url.'" title="'.$bm_bitcoin_cash_tip_to.' '.$bm_author_name.'" class="bm-button-donate  bm-button-donate-btc-alt"><i class="cf cf-btc-alt"></i> '. $bm_donation_encouragement_button .'</a>
				    	<button onclick="copyBitcoinCashAddress()" class="bm-button-copy" id="buttonBitcoinCashAddress">'. $bm_copy .'</button>
				    </div>
				    </div>
				    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
				    <script>
					function copyBitcoinCashAddress() {
					  var copyText = document.getElementById("bitcoinCashAddress");
					  copyText.select();
					  document.execCommand("Copy");
					  alert("Copied the Bitcoin Cash Address: " + copyText.value);
					}
					</script>
				</div>
				<div id="bm-sc-cc-eth" class="bm-cc-tabs">
				    <h3>'.$bm_donate_ethereum_to.' '.$bm_author_name.'</h3>
				    <div class="bm-qr-code">
				    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_ethereum.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
				    </div><div class="bm-window-detail">
				    <div>'. $bm_donation_encouragement_instructions . '</div>
				    <input type="text" value="'.$bm_author_ethereum.'" id="ethereumAddress" class="bm-address" readonly>
				    <div class="bm-donate-buttons">
				    	<a href="'.$bm_author_ethereum_url.'" title="'.$bm_ethereum_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-eth"><i class="cf cf-eth"></i> '. $bm_donation_encouragement_button .'</a>
				    	<button onclick="copyEthereumAddress()" class="bm-button-copy" id="buttonEthereumAddress">'. $bm_copy .'</button>
				    </div>
				    </div>
				    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
				    <script>
					function copyEthereumAddress() {
					  var copyText = document.getElementById("ethereumAddress");
					  copyText.select();
					  document.execCommand("Copy");
					  alert("Copied the Ethereum Address: " + copyText.value);
					}
					</script>
				</div>
				<div id="bm-sc-cc-ltc" class="bm-cc-tabs">
				    <h3>'.$bm_donate_litecoin_to.' '.$bm_author_name.'</h3>
				    <div class="bm-qr-code">
				    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_litecoin.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
				    </div><div class="bm-window-detail">
				    <div>'. $bm_donation_encouragement_instructions . '</div>
				    <input type="text" value="'.$bm_author_litecoin.'" id="litecoinAddress" class="bm-address" readonly>
				    <div class="bm-donate-buttons">
				    	<a href="'.$bm_author_litecoin_url.'" title="'.$bm_litecoin_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-ltc"><i class="cf cf-ltc"></i> '. $bm_donation_encouragement_button .'</a>
				    	<button onclick="copyLitecoinAddress()" class="bm-button-copy" id="buttonLitecoinAddress">'. $bm_copy .'</button>
				    </div>
				    </div>
				    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
				    <script>
					function copyLitecoinAddress() {
					  var copyText = document.getElementById("litecoinAddress");
					  copyText.select();
					  document.execCommand("Copy");
					  alert("Copied the Litecoin Address: " + copyText.value);
					}
					</script>
				</div>
				<div id="bm-sc-cc-xmr" class="bm-cc-tabs">
				    <h3>'.$bm_donate_monero_to.' '.$bm_author_name.'</h3>
				    <div class="bm-qr-code">
				    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_monero.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
				    </div><div class="bm-window-detail">
				    <div>'. $bm_donation_encouragement_instructions . '</div>
				    <input type="text" value="'.$bm_author_monero.'" id="moneroAddress" class="bm-address" readonly>
				    <div class="bm-donate-buttons">
				    	<a href="'.$bm_author_monero_url.'" title="'.$bm_monero_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-xmr"><i class="cf cf-xmr"></i> '. $bm_donation_encouragement_button .'</a>
				    	<button onclick="copyMoneroAddress()" class="bm-button-copy" id="buttonMoneroAddress">'. $bm_copy .'</button>
				    </div>
				    </div>
				    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
				    <script>
					function copyMoneroAddress() {
					  var copyText = document.getElementById("moneroAddress");
					  copyText.select();
					  document.execCommand("Copy");
					  alert("Copied the Monero Address: " + copyText.value);
					}
					</script>
				</div>
				<div id="bm-sc-cc-zec" class="bm-cc-tabs">
				    <h3>'.$bm_donate_zcash_to.' '.$bm_author_name.'</h3>
				    <div class="bm-qr-code">
				    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_zcash.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
				    </div><div class="bm-window-detail">
				    <div>'. $bm_donation_encouragement_instructions . '</div>
				    <input type="text" value="'.$bm_author_zcash.'" id="zcashAddress" class="bm-address" readonly>
				    <div class="bm-donate-buttons">
				    	<button onclick="copyZcashAddress()" class="bm-button-donate bm-button-donate-zec" id="buttonZcashAddress"><i class="cf cf-zec"></i> Copy ZCash Address</button>
				    </div>
				    </div>
				    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
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
					jQuery(\'.bm-button-copy\').css(\'display\',\'inline\');
				</script>
				<script>
				// Stop href="#hashtarget" links jumping around the page
				var hashLinks = document.querySelectorAll("a[href^=\'#\']");
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
		';
	}
		
	if ( (get_the_author_meta( 'bitcoin' ) || get_the_author_meta( 'bitcoincash' ) || get_the_author_meta( 'ethereum' ) || get_the_author_meta( 'litecoin' ) || get_the_author_meta( 'monero' ) || get_the_author_meta( 'zcash' )) ) { 
	return $bm_donation_box;
		}
}
add_shortcode( 'bitmate-author-donate', 'bm_author_donate_shortcode' );

/* Builds BitMate Donation Widget */
function bm_donate_widget_shortcode() {

	$display_options = get_option( 'bitmate_author_donations_display_options' );

	$bm_site_name = get_bloginfo( 'name' );
	$bm_author_name = get_the_author_meta( 'display_name' );
	$bm_post_url = get_permalink();
	$bm_author_bitcoin = get_the_author_meta( 'bitcoin' );
	$bm_author_bitcoincash = get_the_author_meta( 'bitcoincash' );
	$bm_author_ethereum = get_the_author_meta( 'ethereum' );
	$bm_author_litecoin = get_the_author_meta( 'litecoin' );
	$bm_author_monero = get_the_author_meta( 'monero' );
	$bm_author_zcash = get_the_author_meta( 'zcash' );
	$bm_author_bitcoin_url = 'bitcoin:'. $bm_author_bitcoin.'?label='. urlencode($bm_site_name) .'%3A%20'. urlencode($bm_author_name) .'&message=Donation%20for%3A'. urlencode($bm_post_url) .'';
	$bm_author_bitcoincash_url = 'bitcoincash:'. $bm_author_bitcoincash.'?label='. urlencode($bm_site_name) .'%3A%20'. urlencode($bm_author_name) .'&message=Donation%20for%3A'. urlencode($bm_post_url) .'';
	$bm_author_ethereum_url = 'ethereum:'. $bm_author_ethereum;
	$bm_author_litecoin_url = 'litecoin:'. $bm_author_litecoin;
	$bm_author_monero_url = 'monero:'. $bm_author_monero;
	// Does not appear to be standardised URI format 04/02/2018 - $bm_author_zcash_url = 'zcash:'. $bm_author_zcash;

	// Strings for Translation
	$bm_like_this = __('Did you like this?', 'bitmate-author-donations');
	$bm_donate_bitcoin_to = __('Donate Bitcoin to', 'bitmate-author-donations');
	$bm_donate_bitcoin_cash_to = __('Donate Bitcoin Cash to', 'bitmate-author-donations');
	$bm_donate_ethereum_to = __('Donate Ethereum to', 'bitmate-author-donations');
	$bm_donate_litecoin_to = __('Donate Litecoin to', 'bitmate-author-donations');
	$bm_donate_monero_to = __('Donate Monero to', 'bitmate-author-donations');
	$bm_donate_zcash_to = __('Donate ZCash to', 'bitmate-author-donations');
	$bm_crypto_tip_to = __('Send a Cryptocurrency Donation to ', 'bitmate-author-donations');
	$bm_bitcoin_tip_to = __('Send a Bitcoin Donation to', 'bitmate-author-donations');
	$bm_bitcoin_cash_tip_to = __('Send a Bitcoin Cash Donation to', 'bitmate-author-donations');
	$bm_ethereum_tip_to = __('Send a Ethereum Donation to', 'bitmate-author-donations');
	$bm_litecoin_tip_to = __('Send a Litecoin Donation to', 'bitmate-author-donations');
	$bm_monero_tip_to = __('Send a Monero Donation to', 'bitmate-author-donations');
	$bm_zcash_tip_to = __('Send a ZCash Donation to', 'bitmate-author-donations');
	$bm_scan_to_donate = __('Scan to Donate to', 'bitmate-author-donations');
	$bm_donation_encouragement_instructions = __('Scan the QR code or copy the address below into your wallet to send your donation:', 'bitmate-author-donations');
	$bm_donation_encouragement_button = __('Donate via Installed Wallet', 'bitmate-author-donations');
	$bm_copy = __('Copy', 'bitmate-author-donations');
	$bm_close = __('[X] Click Here to Hide Donation Details', 'bitmate-author-donations');
	$bm_credit_text = __('Powered by BitMate Author Donations', 'bitmate-author-donations');
	
	if( isset( $display_options['display_bm_author_credit'] ) && $display_options[ 'display_bm_author_credit' ] ) {
		$bm_author_credit = '<small class="bitmate-author-credit"><a href="https://www.bitmate.net/author-donations/" rel="nofollow" class="bitmate-author-credit">'. $bm_credit_text .'</a></small>';
	} else {
		$bm_author_credit = '';
	}

	// Set empty names
	$bm_cc_link_bitcoin = '';
	$bm_cc_link_bitcoincash = '';
	$bm_cc_link_ethereum = '';
	$bm_cc_link_litecoin = '';
	$bm_cc_link_monero = '';
	$bm_cc_link_zcash = '';
	if( isset( $display_options['display_bm_show_names'] ) && $display_options[ 'display_bm_show_names' ] ) {
		$bm_cc_link_bitcoin = ' Bitcoin';
		$bm_cc_link_bitcoincash = ' Bitcoin Cash';
		$bm_cc_link_ethereum = ' Ethereum';
		$bm_cc_link_litecoin = ' Litecoin';
		$bm_cc_link_monero = ' Monero';
		$bm_cc_link_zcash = ' ZCash';
	}

	$bm_cc_links = '';
	if (get_the_author_meta( 'bitcoin' )) {
		$bm_cc_links = '<li class="bm-cc-btc"><a href="#bm-w-cc-btc"><i class="cf cf-btc"></i>'.$bm_cc_link_bitcoin.'</a></li>';
	}
	if (get_the_author_meta( 'bitcoincash' )) {
		$bm_cc_links = $bm_cc_links.'<li class="bm-cc-btc-alt"><a href="#bm-w-cc-btc-alt"><i class="cf cf-btc-alt"></i>'.$bm_cc_link_bitcoincash.'</a></li>';
	}
	if (get_the_author_meta( 'ethereum' )) {
		$bm_cc_links = $bm_cc_links.'<li class="bm-cc-eth"><a href="#bm-w-cc-eth"><i class="cf cf-eth"></i>'.$bm_cc_link_ethereum.'</a></li>';
	}
	if (get_the_author_meta( 'litecoin' )) {
		$bm_cc_links = $bm_cc_links.'<li class="bm-cc-ltc"><a href="#bm-w-cc-ltc"><i class="cf cf-ltc"></i>'.$bm_cc_link_litecoin.'</a></li>';
	}
	if (get_the_author_meta( 'monero' )) {
		$bm_cc_links = $bm_cc_links.'<li class="bm-cc-xmr"><a href="#bm-w-cc-xmr"><i class="cf cf-xmr"></i>'.$bm_cc_link_monero.'</a></li>';
	}
	if (get_the_author_meta( 'zcash' )) {
		$bm_cc_links = $bm_cc_links.'<li class="bm-cc-zec"><a href="#bm-w-cc-zec"><i class="cf cf-zec"></i>'.$bm_cc_link_zcash.'</a></li>';
	}
	
	if( (get_the_author_meta( 'bitcoin' )) && !( (get_the_author_meta( 'bitcoincash' )) || (get_the_author_meta( 'ethereum' )) || (get_the_author_meta( 'litecoin' )) || (get_the_author_meta( 'monero' )) || (get_the_author_meta( 'zcash' )) )) {
		$bm_donation_box='
			<div class="bitmate-author-donation bm-ad-widget" id="bitmate-author-donation bm-ad-widget">
				<div id="bm-cc-btc" class="bm-cc-tabs" style="border: none !important; display:block !important;">
					<div class="bm-classic"><strong>'.$bm_like_this.'</strong><br/>'.$bm_bitcoin_tip_to.' '.$bm_author_name.'</div>
				    <div class="bm-qr-code">
				    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_bitcoin.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
				    </div><div class="bm-window-detail">
				    <input type="text" value="'.$bm_author_bitcoin.'" id="bitcoinAddress" class="bm-address" readonly>
				    <div class="bm-donate-buttons">
				    	<a href="'.$bm_author_bitcoin_url.'" title="'.$bm_bitcoin_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-btc"><i class="cf cf-btc"></i> '. $bm_donation_encouragement_button .'</a>
				    	<button onclick="copyBitcoinAddress()" class="bm-button-copy" id="buttonBitcoinAddress">'. $bm_copy .'</button>
				    </div>
				    </div>
				    '. $bm_author_credit .'
				    <script>
					function copyBitcoinAddress() {
					  var copyText = document.getElementById("bitcoinAddress");
					  copyText.select();
					  document.execCommand("Copy");
					  alert("Copied the Bitcoin Address: " + copyText.value);
					}
					</script>
				</div>
				<script>
					jQuery(\'.bm-button-copy\').css(\'display\',\'inline\');
				</script>
			</div>
		';
	} else {
		$bm_donation_box='
			<div class="bitmate-author-donation bm-ad-widget" id="bitmate-author-donation bm-ad-widget">
				<div class="bm-donation-encouragement"><strong>'.$bm_like_this.'</strong><br/>'.$bm_crypto_tip_to.' '.$bm_author_name.'</div>
				<ul class="bm-cc-links">
					'.$bm_cc_links.'
				</ul>
				'. $bm_author_credit .'
				<div id="bm-w-cc-btc" class="bm-cc-tabs">
				    <h3>'.$bm_donate_bitcoin_to.' '.$bm_author_name.'</h3>
				    <div class="bm-qr-code">
				    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_bitcoin.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
				    </div><div class="bm-window-detail">
				    <div>'. $bm_donation_encouragement_instructions . '</div>
				    <input type="text" value="'.$bm_author_bitcoin.'" id="bitcoinAddress" class="bm-address" class="bm-address" readonly>
				    <div class="bm-donate-buttons">
				    	<a href="'.$bm_author_bitcoin_url.'" title="'.$bm_bitcoin_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-btc"><i class="cf cf-btc"></i> '. $bm_donation_encouragement_button .'</a>
				    	<button onclick="copyBitcoinAddress()" class="bm-button-copy" id="buttonBitcoinAddress">'. $bm_copy .'</button>
				    </div>
				    </div>
				    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
				    <script>
					function copyBitcoinAddress() {
					  var copyText = document.getElementById("bitcoinAddress");
					  copyText.select();
					  document.execCommand("Copy");
					  alert("Copied the Bitcoin Address: " + copyText.value);
					}
					</script>
				</div>
				<div id="bm-w-cc-btc-alt" class="bm-cc-tabs">
				    <h3>'.$bm_donate_bitcoin_cash_to.' '.$bm_author_name.'</h3>
				    <div class="bm-qr-code">
				    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_bitcoincash.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
				    </div><div class="bm-window-detail">
				    <div>'. $bm_donation_encouragement_instructions . '</div>
				    <input type="text" value="'.$bm_author_bitcoincash.'" id="bitcoinCashAddress" class="bm-address" readonly>
				    <div class="bm-donate-buttons">
				    	<a href="'.$bm_author_bitcoincash_url.'" title="'.$bm_bitcoin_cash_tip_to.' '.$bm_author_name.'" class="bm-button-donate  bm-button-donate-btc-alt"><i class="cf cf-btc-alt"></i> '. $bm_donation_encouragement_button .'</a>
				    	<button onclick="copyBitcoinCashAddress()" class="bm-button-copy" id="buttonBitcoinCashAddress">'. $bm_copy .'</button>
				    </div>
				    </div>
				    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
				    <script>
					function copyBitcoinCashAddress() {
					  var copyText = document.getElementById("bitcoinCashAddress");
					  copyText.select();
					  document.execCommand("Copy");
					  alert("Copied the Bitcoin Cash Address: " + copyText.value);
					}
					</script>
				</div>
				<div id="bm-w-cc-eth" class="bm-cc-tabs">
				    <h3>'.$bm_donate_ethereum_to.' '.$bm_author_name.'</h3>
				    <div class="bm-qr-code">
				    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_ethereum.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
				    </div><div class="bm-window-detail">
				    <div>'. $bm_donation_encouragement_instructions . '</div>
				    <input type="text" value="'.$bm_author_ethereum.'" id="ethereumAddress" class="bm-address" readonly>
				    <div class="bm-donate-buttons">
				    	<a href="'.$bm_author_ethereum_url.'" title="'.$bm_ethereum_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-eth"><i class="cf cf-eth"></i> '. $bm_donation_encouragement_button .'</a>
				    	<button onclick="copyEthereumAddress()" class="bm-button-copy" id="buttonEthereumAddress">'. $bm_copy .'</button>
				    </div>
				    </div>
				    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
				    <script>
					function copyEthereumAddress() {
					  var copyText = document.getElementById("ethereumAddress");
					  copyText.select();
					  document.execCommand("Copy");
					  alert("Copied the Ethereum Address: " + copyText.value);
					}
					</script>
				</div>
				<div id="bm-w-cc-ltc" class="bm-cc-tabs">
				    <h3>'.$bm_donate_litecoin_to.' '.$bm_author_name.'</h3>
				    <div class="bm-qr-code">
				    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_litecoin.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
				    </div><div class="bm-window-detail">
				    <div>'. $bm_donation_encouragement_instructions . '</div>
				    <input type="text" value="'.$bm_author_litecoin.'" id="litecoinAddress" class="bm-address" readonly>
				    <div class="bm-donate-buttons">
				    	<a href="'.$bm_author_litecoin_url.'" title="'.$bm_litecoin_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-ltc"><i class="cf cf-ltc"></i> '. $bm_donation_encouragement_button .'</a>
				    	<button onclick="copyLitecoinAddress()" class="bm-button-copy" id="buttonLitecoinAddress">'. $bm_copy .'</button>
				    </div>
				    </div>
				    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
				    <script>
					function copyLitecoinAddress() {
					  var copyText = document.getElementById("litecoinAddress");
					  copyText.select();
					  document.execCommand("Copy");
					  alert("Copied the Litecoin Address: " + copyText.value);
					}
					</script>
				</div>
				<div id="bm-w-cc-xmr" class="bm-cc-tabs">
				    <h3>'.$bm_donate_monero_to.' '.$bm_author_name.'</h3>
				    <div class="bm-qr-code">
				    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_monero.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
				    </div><div class="bm-window-detail">
				    <div>'. $bm_donation_encouragement_instructions . '</div>
				    <input type="text" value="'.$bm_author_monero.'" id="moneroAddress" class="bm-address" readonly>
				    <div class="bm-donate-buttons">
				    	<a href="'.$bm_author_monero_url.'" title="'.$bm_monero_tip_to.' '.$bm_author_name.'" class="bm-button-donate bm-button-donate-xmr"><i class="cf cf-xmr"></i> '. $bm_donation_encouragement_button .'</a>
				    	<button onclick="copyMoneroAddress()" class="bm-button-copy" id="buttonMoneroAddress">'. $bm_copy .'</button>
				    </div>
				    </div>
				    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
				    <script>
					function copyMoneroAddress() {
					  var copyText = document.getElementById("moneroAddress");
					  copyText.select();
					  document.execCommand("Copy");
					  alert("Copied the Monero Address: " + copyText.value);
					}
					</script>
				</div>
				<div id="bm-w-cc-zec" class="bm-cc-tabs">
				    <h3>'.$bm_donate_zcash_to.' '.$bm_author_name.'</h3>
				    <div class="bm-qr-code">
				    	<img src="'.plugins_url('includes/qrme.php?', __FILE__).$bm_author_zcash.'" alt="' . $bm_scan_to_donate .' '. $bm_author_name .'"/>
				    </div><div class="bm-window-detail">
				    <div>'. $bm_donation_encouragement_instructions . '</div>
				    <input type="text" value="'.$bm_author_zcash.'" id="zcashAddress" class="bm-address" readonly>
				    <div class="bm-donate-buttons">
				    	<button onclick="copyZcashAddress()" class="bm-button-donate bm-button-donate-zec" id="buttonZcashAddress"><i class="cf cf-zec"></i> Copy ZCash Address</button>
				    </div>
				    </div>
				    <div class="bm-window-detail-close"><a href="#bitmate-author-donation" class="bmHide">'.$bm_close.'</a></div>
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
					jQuery(\'.bm-button-copy\').css(\'display\',\'inline\');
				</script>
				<script>
				// Stop href="#hashtarget" links jumping around the page
				var hashLinks = document.querySelectorAll("a[href^=\'#\']");
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
		';
	}
		
	if ( (get_the_author_meta( 'bitcoin' ) || get_the_author_meta( 'bitcoincash' ) || get_the_author_meta( 'ethereum' ) || get_the_author_meta( 'litecoin' ) || get_the_author_meta( 'monero' ) || get_the_author_meta( 'zcash' )) ) { 
		return $bm_donation_box;
	}
}
add_shortcode( 'bitmate-author-donate-widget', 'bm_donate_widget_shortcode' );

/* Adds Widget Functionality */

class BM_Donation_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'bm_donation_widget',
			esc_html__('BitMate Donations Widget','bitmate-author-donations'),
			array( 'description' => __('A widget for collecting bitcoin donations.', 'bitmate-author-donations') ) 
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		?>
		<div class="bitmate-donate-widget">
			<h4 class="widget-title"><?php echo $title ?></h4>
			<?php echo do_shortcode('[bitmate-author-donate-widget]'); ?>
		</div>
		<?php	
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __('Donate Bitcoin', 'bitmate-author-donations');
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />		
		</p>
		<?php 
	}

}

function bitmate_widgets_init(){
	register_widget( 'BM_Donation_Widget' );
}
add_action( 'widgets_init', 'bitmate_widgets_init' );