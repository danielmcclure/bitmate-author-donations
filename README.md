ME=== BitMate Author Donations ===
Contributors: danielmcclure
Donate link: http://bitmate.net/donate/
Tags: bitcoin, donate, donations, cryptocurrency, currency, payments, bitmate, ethereum, litecoin, bitcoin cash, monero, zcash
Requires at least: 3.0
Tested up to: 4.9.4
Stable tag: trunk
License: GPLv3 or later

A simple plugin to help website owners and authors on WordPress powered sites to receive cryptocurrency donations from their posts.

== Description ==

Adds a bitcoin address field to user profiles so that authors can accept bitcoin donations via an automatically generated bitcoin donation box after their posts or anywhere on the site with the `[bitmate-author-donate]` shortcode.

Here are a few of the special features you might not notice at first:

* Can be used in "Maximalist" Bitcoin only mode with classic styles or will adapt to a modern multi-currency display when you add other currencies.
* Sets Bitcoin label & message when using compatible installed wallets.
* Makes use of compatible URI formats where possible, for example [BIP 21 for Bitcoin](https://github.com/bitcoin/bips/blob/master/bip-0021.mediawiki).
* Uses local and self-hosted fonts to avoid calling other servers.
* Works without Javascript enabled - although offers optimisations when it is!
* Makes use of open-source self-hosted QR code generator for increase privacy.

**Coming Soon:**

* International translation hooks

**Like this plugin?** 
You can make a donation through the following methods:

**Bitcoin:** 1QHK34VSB4MqRUEXyXnUMDg56VEcvY7ND8
**Bitcoin Cash:** 16WdQvED6hGQZukDjx4i6rZ6foVy1Zhxav
**Ethereum:** 0x0577eb2088d03eecf093085544909b110cd94728
**Litecoin:** LWcXPjsmyEHDS9yXShjrpgYe6Sfha94iLy
**Monero:** 446bYKR3hLnVtBt5NqKEYKAAh6DjSw2s55SxCbyJLfPU5fwpXsnbatXGzmXdZNJHZ4Wa5bn3uhaG2cghkBGX2vWcCL2gNmi3uhaG2cghkBGX2vWcCL2gNmi
**ZCash:** t1PsNg2sHTPjFZn5HfMBViFcDoYaxX4vgNZ

**Thanks for your support!**

== Installation ==

1. Upload `bitmate-author-donations` to the `/wp-content/plugins/` directory
2. Activate the plugin through the ‘Plugins’ menu in WordPress
3. Enter a valid bitcoin address on the User Profile page under “BitMate Donation Information” for any users that wish to enable the donation box.
4. Configure the display options through the “BitMate” page.
5. (Optional) Use the [bitmate-author-donate] shortcode anywhere you want to manually include the donation box, e.g. WordPress pages etc.

== Frequently Asked Questions ==

= What if I don't want the donation box to appear on my posts? =
You can simply remove the bitcoin address from your user profile to disable the box from appearing on your posts. The same applies for any user. 

= I need help with something not mentioned here? =
Check out the [official plugin site](http://bitmate.net/author-donations/) for more information.

== Screenshots ==

1. Multi-Cryptocurrency BitMate Donation Box 
2. Expanded Multi-Cryptocurrency BitMate Donation Box
3. Multi-Cryptocurrency BitMate Donation Box with Names
4. Multi-Cryptocurrency BitMate Donation Box Widget
5. Expanded Multi-Cryptocurrency BitMate Donation Box Widget
6. Maximalist BitMate Donation Box
7. Maximalist BitMate Donation Box Widget
8. The User Profile Settings

== Changelog ==

= 2.0 =
* Created "Maximalist Mode" which uses legacy styling when only a Bitcoin address is in use.
* Added support for additional cryptocurrencies; Ethereum, Litecoin, Monero, ZCash
* Add option to show/hide names next to cryptocurrency icons
* Interated CryptoFont by [@AMPoellmann](https://AlexanderPoellmann.com/CryptoFont)
* Using [Semnatic Versioning](https://semver.org/) with consideration to; overall interface adjustments and cryptocurrency URI parsing as major (X.0.0), feature and currency additions as minor (0.X.0), and bug fixes as patches (0.0.X). 
* Moved from Google QR Chart API to [local open source generator](https://sourceforge.net/projects/phpqrcode/) for improved privacy. 
* Added welcome/update screen.

= 1.2.2 =
* Fixed page display bug.

= 1.2.1 =
* Fixed mixed content error for SSL enabled websites.
* Removed encoded character bug on settings page. 

= 1.2 =
* Fixed content display for authors without bitcoin address.

= 1.1.2 =
* Display below posts option now only applies to posts, not pages.

= 1.1.1 =
* Widget QR Code Bugfix

= 1.1 =
* Added BitMate author donation widget 
* Optimised responsive CSS for improved display at smaller widths

= 1.0 =
* First Public Release

== Upgrade Notice ==

= 2.0.0 =
This version introduces a lot of under the hood improvements as well as new cryptocurrencies. It also introduces a new appearance so be prepared for change!

== Publisher ==

[BitMate - Bitcoin Plugins for WordPress](http://bitmate.net "BitMate - Bitcoin Plugins for WordPress")

Please visit our site and subscribe for updates to stay in the loop about our Bitcoin plugins for WordPress.

