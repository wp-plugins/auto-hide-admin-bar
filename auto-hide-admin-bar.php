<?php
/*
Plugin Name: Auto Hide Admin Bar
Plugin URI: http://www.nostromo.nl/plugins/auto-hide-admin-bar
Description: Automatically hides the admin bar. Will show the admin bar when hovering over the top of the site.
Author: Marcel Bootsman
Version: 0.4
Author URI: http://www.nostromo.nl
*/

function auto_hide_admin_bar() {

    ?>
    <script type='text/javascript'>

            jQuery(document).ready(function(){

                jQuery('#wpadminbar').css('top','-28px');
                jQuery('body').css('margin-top','-28px');
                jQuery('body').append('<div id=\'hiddendiv\'></div>');

		$autoHide = jQuery(this).find('#hiddendiv');
		$autoHide.css('width', '100%');
		$autoHide.css('min-height', '28px');
		$autoHide.css('z-index', '99998'); // admin bar is at z-index: 999999;
		$autoHide.css('position', 'absolute');
                $autoHide.css('top', '0px');

		$autoHide.mouseenter( function(e) {
			jQuery('#wpadminbar').animate({'top':'0px'}, 'fast');
                        jQuery('body').animate({'margin-top':'0px'}, 'fast');
		});

		jQuery('#wpadminbar').mouseleave( function(e) {
			jQuery('#wpadminbar').animate({'top':'-28px'}, 'fast');
                        jQuery('body').animate({'margin-top':'-28px'}, 'fast');
		});
        });
        </script>
    <?php

}
function add_jquery_stuff() {
    if (is_user_logged_in()) {
       wp_enqueue_script('jquery');
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
