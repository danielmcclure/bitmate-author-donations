<?php

/**
 * Welcome Page View
 *
 * @since 1.0.0
 * @package BITMATE_AUTHOR_DONATIONS
 */

if ( ! defined( 'WPINC' ) ) {

    die;

}

global $current_user;
get_currentuserinfo();
$user_email = esc_html( $current_user->user_email );
?>

<div class="wrap about-wrap bm-welcome">

    <h1><?php printf( __( 'BitMate Author Donations&nbsp; %s', 'BITMATE_AUTHOR_DONATIONS' ), BITMATE_AUTHOR_DONATIONS_VERSION ); ?></h1>

    <div class="about-text">
        <?php printf( __( "Congratulations! Authors on this site can now accept cryptocurrency donations.", 'BITMATE_AUTHOR_DONATIONS' ), BITMATE_AUTHOR_DONATIONS_VERSION ); ?>
    </div>

    <div class="wp-badge bm_welcome_logo"></div>

    <h2 class="nav-tab-wrapper wp-clearfix">
        <a class="nav-tab nav-tab-active">What’s New</a>
    </h2>

    <div class="changelog point-releases">
        <h3>Latest Releases</h3>
        <p><strong>Version 2.0.0</strong> Introduced five new cryptocurrencies, improved onboarding, and updated design.</p>
    </div>

        <div class="feature-section two-col">
        <div class="col">
            <h3><?php _e( 'Getting Started', 'BITMATE_AUTHOR_DONATIONS' ); ?></h3>
            <ul class="bm-steps">
                <li><strong><?php _e( 'Step #1:', 'BITMATE_AUTHOR_DONATIONS' ); ?></strong> <?php _e( 'Select your desired display options on the settings page.', 'BITMATE_AUTHOR_DONATIONS' ); ?></li>
                <li><strong><?php _e( 'Step #2:', 'BITMATE_AUTHOR_DONATIONS' ); ?></strong> <?php _e( 'Set your cryptocurrency addresses in your user profile. ', 'BITMATE_AUTHOR_DONATIONS' ); ?></li>
                <li><strong><?php _e( 'Step #3:', 'BITMATE_AUTHOR_DONATIONS' ); ?></strong> <?php _e( 'Add any desired widgets and shortcodes.', 'BITMATE_AUTHOR_DONATIONS' ); ?></li>
                <li><strong><?php _e( 'Step #4:', 'BITMATE_AUTHOR_DONATIONS' ); ?></strong> <?php _e( 'Sign up to the BitMate Newsletter &#128521;', 'BITMATE_AUTHOR_DONATIONS' ); ?></li>
            </ul>
        </div>
        <div class="col">
            <h3><?php _e( 'Subscribe to Email Updates', 'BITMATE_AUTHOR_DONATIONS' ); ?></h3>
            <p><em><?php _e( 'Join the BitMate newsletter for free updates and cryptocurrency news!', 'BITMATE_AUTHOR_DONATIONS' ); ?></em></p>
            <form method="POST" action="https://safelink.activehosted.com/proc.php" id="_form_1131_" class="_form _form_1131 _inline-form  _dark" novalidate>
              <input type="hidden" name="u" value="1131" />
              <input type="hidden" name="f" value="1131" />
              <input type="hidden" name="s" />
              <input type="hidden" name="c" value="0" />
              <input type="hidden" name="m" value="0" />
              <input type="hidden" name="act" value="sub" />
              <input type="hidden" name="v" value="2" />
              <div class="_form-content">
                <div class="_form_element _x83567110 _full_width " >
                  <label class="_form-label">
                  </label>
                  <div class="_field-wrapper">
                    <input type="text" name="email" placeholder="Enter your best email address..." value="<?php echo $user_email ?>" class="textinput" required/>
                  </div>
                </div>
                <div class="_button-wrapper _full_width">
                  <button id="_form_1131_submit" class="_submit button button-primary" type="submit">
                    Subscribe to Updates from BitMate
                  </button>
                </div>
                <div class="_clear-element">
                </div>
              </div>
              <div class="_form-thank-you" style="display:none;">
              </div>
            </form><script type="text/javascript">
            window.cfields = [];
            window._show_thank_you = function(id, message, trackcmp_url) {
              var form = document.getElementById('_form_' + id + '_'), thank_you = form.querySelector('._form-thank-you');
              form.querySelector('._form-content').style.display = 'none';
              thank_you.innerHTML = message;
              thank_you.style.display = 'block';
              if (typeof(trackcmp_url) != 'undefined' && trackcmp_url) {
                // Site tracking URL to use after inline form submission.
                _load_script(trackcmp_url);
              }
              if (typeof window._form_callback !== 'undefined') window._form_callback(id);
            };
            window._show_error = function(id, message, html) {
              var form = document.getElementById('_form_' + id + '_'), err = document.createElement('div'), button = form.querySelector('button'), old_error = form.querySelector('._form_error');
              if (old_error) old_error.parentNode.removeChild(old_error);
              err.innerHTML = message;
              err.className = '_error-inner _form_error _no_arrow';
              var wrapper = document.createElement('div');
              wrapper.className = '_form-inner';
              wrapper.appendChild(err);
              button.parentNode.insertBefore(wrapper, button);
              document.querySelector('[id^="_form"][id$="_submit"]').disabled = false;
              if (html) {
                var div = document.createElement('div');
                div.className = '_error-html';
                div.innerHTML = html;
                err.appendChild(div);
              }
            };
            window._load_script = function(url, callback) {
                var head = document.querySelector('head'), script = document.createElement('script'), r = false;
                script.type = 'text/javascript';
                script.charset = 'utf-8';
                script.src = url;
                if (callback) {
                  script.onload = script.onreadystatechange = function() {
                  if (!r && (!this.readyState || this.readyState == 'complete')) {
                    r = true;
                    callback();
                    }
                  };
                }
                head.appendChild(script);
            };
            (function() {
              if (window.location.search.search("excludeform") !== -1) return false;
              var getCookie = function(name) {
                var match = document.cookie.match(new RegExp('(^|; )' + name + '=([^;]+)'));
                return match ? match[2] : null;
              }
              var setCookie = function(name, value) {
                var now = new Date();
                var time = now.getTime();
                var expireTime = time + 1000 * 60 * 60 * 24 * 365;
                now.setTime(expireTime);
                document.cookie = name + '=' + value + '; expires=' + now + ';path=/';
              }
                  var addEvent = function(element, event, func) {
                if (element.addEventListener) {
                  element.addEventListener(event, func);
                } else {
                  var oldFunc = element['on' + event];
                  element['on' + event] = function() {
                    oldFunc.apply(this, arguments);
                    func.apply(this, arguments);
                  };
                }
              }
              var _removed = false;
              var form_to_submit = document.getElementById('_form_1131_');
              var allInputs = form_to_submit.querySelectorAll('input, select, textarea'), tooltips = [], submitted = false;

              var getUrlParam = function(name) {
                var regexStr = '[\?&]' + name + '=([^&#]*)';
                var results = new RegExp(regexStr, 'i').exec(window.location.href);
                return results != undefined ? decodeURIComponent(results[1]) : false;
              };

              for (var i = 0; i < allInputs.length; i++) {
                var regexStr = "field\\[(\\d+)\\]";
                var results = new RegExp(regexStr).exec(allInputs[i].name);
                if (results != undefined) {
                  allInputs[i].dataset.name = window.cfields[results[1]];
                } else {
                  allInputs[i].dataset.name = allInputs[i].name;
                }
                var fieldVal = getUrlParam(allInputs[i].dataset.name);

                if (fieldVal) {
                  if (allInputs[i].type == "radio" || allInputs[i].type == "checkbox") {
                    if (allInputs[i].value == fieldVal) {
                      allInputs[i].checked = true;
                    }
                  } else {
                    allInputs[i].value = fieldVal;
                  }
                }
              }

              var remove_tooltips = function() {
                for (var i = 0; i < tooltips.length; i++) {
                  tooltips[i].tip.parentNode.removeChild(tooltips[i].tip);
                }
                  tooltips = [];
              };
              var remove_tooltip = function(elem) {
                for (var i = 0; i < tooltips.length; i++) {
                  if (tooltips[i].elem === elem) {
                    tooltips[i].tip.parentNode.removeChild(tooltips[i].tip);
                    tooltips.splice(i, 1);
                    return;
                  }
                }
              };
              var create_tooltip = function(elem, text) {
                var tooltip = document.createElement('div'), arrow = document.createElement('div'), inner = document.createElement('div'), new_tooltip = {};
                if (elem.type != 'radio' && elem.type != 'checkbox') {
                  tooltip.className = '_error';
                  arrow.className = '_error-arrow';
                  inner.className = '_error-inner';
                  inner.innerHTML = text;
                  tooltip.appendChild(arrow);
                  tooltip.appendChild(inner);
                  elem.parentNode.appendChild(tooltip);
                } else {
                  tooltip.className = '_error-inner _no_arrow';
                  tooltip.innerHTML = text;
                  elem.parentNode.insertBefore(tooltip, elem);
                  new_tooltip.no_arrow = true;
                }
                new_tooltip.tip = tooltip;
                new_tooltip.elem = elem;
                tooltips.push(new_tooltip);
                return new_tooltip;
              };
              var resize_tooltip = function(tooltip) {
                var rect = tooltip.elem.getBoundingClientRect();
                var doc = document.documentElement, scrollPosition = rect.top - ((window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0));
                if (scrollPosition < 40) {
                  tooltip.tip.className = tooltip.tip.className.replace(/ ?(_above|_below) ?/g, '') + ' _below';
                } else {
                  tooltip.tip.className = tooltip.tip.className.replace(/ ?(_above|_below) ?/g, '') + ' _above';
                }
              };
              var resize_tooltips = function() {
                if (_removed) return;
                for (var i = 0; i < tooltips.length; i++) {
                  if (!tooltips[i].no_arrow) resize_tooltip(tooltips[i]);
                }
              };
              var validate_field = function(elem, remove) {
                var tooltip = null, value = elem.value, no_error = true;
                remove ? remove_tooltip(elem) : false;
                if (elem.type != 'checkbox') elem.className = elem.className.replace(/ ?_has_error ?/g, '');
                if (elem.getAttribute('required') !== null) {
                  if (elem.type == 'radio' || (elem.type == 'checkbox' && /any/.test(elem.className))) {
                    var elems = form_to_submit.elements[elem.name];
                    if (!(elems instanceof NodeList || elems instanceof HTMLCollection) || elems.length <= 1) {
                      no_error = elem.checked;
                    }
                    else {
                      no_error = false;
                      for (var i = 0; i < elems.length; i++) {
                        if (elems[i].checked) no_error = true;
                      }
                    }
                    if (!no_error) {
                      tooltip = create_tooltip(elem, "Please select an option.");
                    }
                  } else if (elem.type =='checkbox') {
                    var elems = form_to_submit.elements[elem.name], found = false, err = [];
                    no_error = true;
                    for (var i = 0; i < elems.length; i++) {
                      if (elems[i].getAttribute('required') === null) continue;
                      if (!found && elems[i] !== elem) return true;
                      found = true;
                      elems[i].className = elems[i].className.replace(/ ?_has_error ?/g, '');
                      if (!elems[i].checked) {
                        no_error = false;
                        elems[i].className = elems[i].className + ' _has_error';
                        err.push("Checking %s is required".replace("%s", elems[i].value));
                      }
                    }
                    if (!no_error) {
                      tooltip = create_tooltip(elem, err.join('<br/>'));
                    }
                  } else if (elem.tagName == 'SELECT') {
                    var selected = true;
                    if (elem.multiple) {
                      selected = false;
                      for (var i = 0; i < elem.options.length; i++) {
                        if (elem.options[i].selected) {
                          selected = true;
                          break;
                        }
                      }
                    } else {
                      for (var i = 0; i < elem.options.length; i++) {
                        if (elem.options[i].selected && !elem.options[i].value) {
                          selected = false;
                        }
                      }
                    }
                    if (!selected) {
                      elem.className = elem.className + ' _has_error';
                      no_error = false;
                      tooltip = create_tooltip(elem, "Please select an option.");
                    }
                  } else if (value === undefined || value === null || value === '') {
                    elem.className = elem.className + ' _has_error';
                    no_error = false;
                    tooltip = create_tooltip(elem, "This field is required.");
                  }
                }
                if (no_error && elem.name == 'email') {
                  if (!value.match(/^[\+_a-z0-9-'&=]+(\.[\+_a-z0-9-']+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i)) {
                    elem.className = elem.className + ' _has_error';
                    no_error = false;
                    tooltip = create_tooltip(elem, "Enter a valid email address.");
                  }
                }
                if (no_error && /date_field/.test(elem.className)) {
                  if (!value.match(/^\d\d\d\d-\d\d-\d\d$/)) {
                    elem.className = elem.className + ' _has_error';
                    no_error = false;
                    tooltip = create_tooltip(elem, "Enter a valid date.");
                  }
                }
                tooltip ? resize_tooltip(tooltip) : false;
                return no_error;
              };
              var needs_validate = function(el) {
                return el.name == 'email' || el.getAttribute('required') !== null;
              };
              var validate_form = function(e) {
                var err = form_to_submit.querySelector('._form_error'), no_error = true;
                if (!submitted) {
                  submitted = true;
                  for (var i = 0, len = allInputs.length; i < len; i++) {
                    var input = allInputs[i];
                    if (needs_validate(input)) {
                      if (input.type == 'text') {
                        addEvent(input, 'blur', function() {
                          this.value = this.value.trim();
                          validate_field(this, true);
                        });
                        addEvent(input, 'input', function() {
                          validate_field(this, true);
                        });
                      } else if (input.type == 'radio' || input.type == 'checkbox') {
                        (function(el) {
                          var radios = form_to_submit.elements[el.name];
                          for (var i = 0; i < radios.length; i++) {
                            addEvent(radios[i], 'click', function() {
                              validate_field(el, true);
                            });
                          }
                        })(input);
                      } else if (input.tagName == 'SELECT') {
                        addEvent(input, 'change', function() {
                          validate_field(this, true);
                        });
                      }
                    }
                  }
                }
                remove_tooltips();
                for (var i = 0, len = allInputs.length; i < len; i++) {
                  var elem = allInputs[i];
                  if (needs_validate(elem)) {
                    if (elem.tagName.toLowerCase() !== "select") {
                      elem.value = elem.value.trim();
                    }
                    validate_field(elem) ? true : no_error = false;
                  }
                }
                if (!no_error && e) {
                  e.preventDefault();
                }
                resize_tooltips();
                return no_error;
              };
              addEvent(window, 'resize', resize_tooltips);
              addEvent(window, 'scroll', resize_tooltips);
              window._old_serialize = null;
              if (typeof serialize !== 'undefined') window._old_serialize = window.serialize;
              _load_script("//d3rxaij56vjege.cloudfront.net/form-serialize/0.3/serialize.min.js", function() {
                window._form_serialize = window.serialize;
                if (window._old_serialize) window.serialize = window._old_serialize;
              });
              var form_submit = function(e) {
                e.preventDefault();
                if (validate_form()) {
                  // use this trick to get the submit button & disable it using plain javascript
                  document.querySelector('[id^="_form"][id$="_submit"]').disabled = true;
                        var serialized = _form_serialize(document.getElementById('_form_1131_'));
                  var err = form_to_submit.querySelector('._form_error');
                  err ? err.parentNode.removeChild(err) : false;
                  _load_script('https://safelink.activehosted.com/proc.php?' + serialized + '&jsonp=true');
                }
                return false;
              };
              addEvent(form_to_submit, 'submit', form_submit);
            })();

            </script>
            <p class="bm-privacy"><small><?php _e( 'We Respect Your Privacy &middot; <a href="https://bitmate.net/privacy-policy/?utm_source=bitmate_author_donations&utm_medium=plugin&utm_campaign=welcome&utm_term=privacy_policy">Privacy Policy</a>', 'BITMATE_AUTHOR_DONATIONS' ); ?></small></p>
        </div>
     </div>

    <div class="feature-section two-col">
        <div class="col">
            <img src="<?php echo plugins_url('images/multiple-cryptocurrencies.jpeg', dirname(__FILE__) ); ?>" />
            <h3><?php _e( 'Accept Multiple Cryptocurrencies', 'BITMATE_AUTHOR_DONATIONS' ); ?></h3>
            <p><?php _e( 'BitMate Author Donations currently allows you to collect cryptocurrency donations in six different currencies. You can currently enable; Bitcoin, Bitcoin Cash, Ethereum, Litecoin, Monero, and ZCash.', 'BITMATE_AUTHOR_DONATIONS' ); ?></p>
        </div>
        <div class="col">
            <img src="<?php echo plugins_url('images/bitmate-post-box.jpeg', dirname(__FILE__) ); ?>" />
            <h3><?php _e( 'Automatically Include Below Posts', 'BITMATE_AUTHOR_DONATIONS' ); ?></h3>
            <p><?php _e( 'You can set the BitMate Author Donation box to automatically appear under all of the posts on your site. This will allow all authors to easily collect donations simply by posting to your site.', 'BITMATE_AUTHOR_DONATIONS' ); ?></p>
        </div>
    </div>

    <div class="feature-section two-col">
        <div class="col">
            <img src="<?php echo plugins_url('images/bitmate-shortcode.jpeg', dirname(__FILE__) ); ?>" />
            <h3><?php _e( 'Shortcode For Manual Donation Boxes', 'BITMATE_AUTHOR_DONATIONS' ); ?></h3>
            <p><?php _e( 'If you would like more control over where the donation box appears within your post then you can manually add it with a shortce. Just type <strong>[bitmate-author-donate]</strong> where you\'d like it to appear.', 'BITMATE_AUTHOR_DONATIONS' ); ?></p>
        </div>
        <div class="col">
            <img src="<?php echo plugins_url('images/bitmate-widget.jpeg', dirname(__FILE__) ); ?>" />
            <h3><?php _e( 'Widget for Visual Page Builders & Sidebars' ); ?></h3>
            <p><?php _e( 'If you\'d prefer the donation box to appear in your sidebar then you can make use of the built in widget. This option is also useful if you use a visual page builder such as <a href="https://bitmate.net/beaver-builder">Beaver Builder</a>.', 'BITMATE_AUTHOR_DONATIONS' ); ?></p>
        </div>
    </div>

    <?php bm_author_donations_admin_donations(); ?>

</div>
