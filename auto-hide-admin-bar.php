<?php
/*
Plugin Name: Auto Hide Admin Bar
Plugin URI: http://www.nostromo.nl/wordpress-plugins/auto-hide-admin-bar
Description: Automatically hides the admin bar. Will show the admin bar when hovering over the top of the site.
Author: Marcel Bootsman
Version: 0.6.2
Author URI: http://www.nostromo.nl
*/



function auto_hide_admin_bar() {

    ?>
    <script type='text/javascript'>

            jQuery(document).ready(function(){

                jQuery('#wpadminbar').css('top','-28px');
                jQuery('body').css('margin-top','-28px');
                jQuery('body').css('background-position','0px -28px');
                jQuery('body').append('<div id=\'hiddendiv\'></div>');

		$autoHide = jQuery(this).find('#hiddendiv');
		$autoHide.css('width', '100%');
		$autoHide.css('min-height', '28px');
		$autoHide.css('z-index', '99998'); // admin bar is at z-index: 99999;
		$autoHide.css('position', 'fixed');
                $autoHide.css('top', '0px');

                var configIn = {
                    over:adminBarIn, // function = onMouseOver callback (REQUIRED)
                    sensitivity: 6,
                    out: doNothing // function = onMouseOut callback (REQUIRED)
                };
                var configOut = {
                    over: doNothing, // function = onMouseOver callback (REQUIRED)
                    timeout: 1500, // number = milliseconds delay before onMouseOut
                    out: adminBarOut // function = onMouseOut callback (REQUIRED)
                };

                $autoHide.hoverIntent(configIn);
                jQuery('#wpadminbar').hoverIntent(configOut);

                // doNothing function is for enabling hoverIntent to work with two layers.
                function doNothing(){}

                // Show the Admin Bar
                function adminBarIn() {
                    jQuery('#wpadminbar').animate({'top':'0px'}, 'fast');
                    jQuery('body').animate({'margin-top':'0px'}, 'fast');
		    jQuery('body').animate({'background-position':'0px 0px'}, 'fast');
                }
                // Hide the Admin Bar
                function adminBarOut() {
                    jQuery('#wpadminbar').animate({'top':'-28px'}, 'fast');
                    jQuery('body').animate({'margin-top':'-28px'}, 'fast');
		    jQuery('body').animate({'background-position':'0px -28px'}, 'fast');
                }
            });
        </script>
<?php
}

function add_jquery_stuff() {
    if (is_user_logged_in()) {
        /* determine plugin path */
        $x = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

        wp_enqueue_script('jquery');
        wp_register_script( 'jquery-hoverintent', $x.'js/jquery.hoverIntent.minified.js');
        wp_enqueue_script( 'jquery-hoverintent' );

    }
}
add_action('wp_print_scripts','add_jquery_stuff');

function add_my_hide_stuff() {

    if (is_user_logged_in()) {
        auto_hide_admin_bar();
    }
}
add_action('wp_head', 'add_my_hide_stuff');
?>