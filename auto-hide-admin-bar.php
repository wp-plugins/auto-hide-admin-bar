<?php
/*
Plugin Name: Auto Hide Admin Bar
Plugin URI: http://www.nostromo.nl/wordpress-plugins/auto-hide-admin-bar
Description: Automatically hides the Toolbar. Will show the Toolbar when hovering over the top of the site.
Author: Marcel Bootsman
Version: 0.7
Author URI: http://www.nostromo.nl
*/

/* ----------------------------------------------------------------------------
 *  Global data */
$plugin_file = dirname( __FILE__ ) . '/auto-hide-admin-bar.php';
$plugin_path = plugin_dir_path( $plugin_file );

/* Define some default numnbers */
define("DEFAULT_SPEED", 200);
define("DEFAULT_DELAY", 1500);
define("DEFAULT_INTERVAL", 100);

/**
 * Include options page for admin area 
 * 
 */
if (is_admin()) {
    include_once $plugin_path.'ahab_options.php';
    
}

/**
 * Add Settings link to plugin page
 * 
 * @author Marcel Bootsman
 * @link http://www.nostromo.nl/wordpress-plugins/auto-hide-admin-bar/
 * @param Array $links, filename $file
 * @return Array $links with new link=
 */
function ahab_add_settings_link( $links, $file ) {
    $this_plugin = plugin_basename( __FILE__ );
    
    if ( $file == $this_plugin ){
        $settings_link = '<a href="plugins.php?page=auto-hide-admin-bar">'.__( "Settings", "auto-hide-admin-bar" ).'</a>';
        array_unshift( $links, $settings_link );
    }
    return $links;
 }
 
 add_filter( 'plugin_action_links', 'ahab_add_settings_link', 10, 2 );
 /**
 * The main function. Build JS code and ouput it.
 * 
 * @author Marcel Bootsman
 * @link http://www.nostromo.nl/wordpress-plugins/auto-hide-admin-bar/
 * @param None
 * @return None
 */
function auto_hide_admin_bar() {
    
    /* Get options
     * 
     */
    $options = get_option( 'ahab_plugin_options' );
    
            if ( ( $options['speed'] != '' ) && (is_numeric($options['speed']) ) ) {
                $ahab_anim_speed = $options['speed'];
            }
            else {
                $ahab_anim_speed = DEFAULT_SPEED;
            }

            if ( ( $options['delay'] != '' )  && (is_numeric($options['delay']) ) ) {
                $ahab_delay = $options['delay'];
            }
            else {
                $ahab_delay = DEFAULT_DELAY;
            }
            
            if ( ( $options['interval'] != '' ) && (is_numeric($options['interval']) ) ) {
                $ahab_interval = $options['interval'];
            }
            else {
                $ahab_interval = DEFAULT_INTERVAL;
            }

    ?>
    <script type='text/javascript'>

            jQuery(document).ready(function(){

                jQuery('#wpadminbar').css('top','-28px');
                jQuery('body').css('margin-top','-28px');
                //jQuery('body').css('background-position','0px -28px');
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
                    timeout: <?php echo $ahab_delay; ?>, // number = milliseconds delay before onMouseOut
                    interval: <?php echo $ahab_interval; ?>, // number = millseconds interval for mouse polling
                    out: adminBarOut // function = onMouseOut callback (REQUIRED)
                };

                $autoHide.hoverIntent(configIn);
                jQuery('#wpadminbar').hoverIntent(configOut);

		// doNothing function is for enabling hoverIntent to work with two layers.
                function doNothing(){}

                // Show the Admin Bar
                function adminBarIn() {
                    jQuery('#wpadminbar').animate({'top':'0px'},<?php echo $ahab_anim_speed; ?>);
                    jQuery('body').animate({'margin-top':'0px'}, <?php echo $ahab_anim_speed; ?>);
		    jQuery('body').animate({'background-position-y':'0px'}, <?php echo $ahab_anim_speed; ?>);
                }
                // Hide the Admin Bar
                function adminBarOut() {
                    jQuery('#wpadminbar').animate({'top':'-28px'}, <?php echo $ahab_anim_speed; ?>);
                    jQuery('body').animate({'margin-top':'-28px'}, <?php echo $ahab_anim_speed; ?>);
		    jQuery('body').animate({'background-position-y':'-28px'}, <?php echo $ahab_anim_speed; ?>);
                }
            });
        </script>
<?php
}

add_action('wp_head','ahab_add_jquery_stuff');

/**
 * Add jQuery
 * 
 * @author Marcel Bootsman
 * @link http://www.nostromo.nl/wordpress-plugins/auto-hide-admin-bar/
 * @param None
 * @return None
 */
function ahab_add_jquery_stuff() {
    if (is_user_logged_in()) {
        /* determine plugin path */
        $x = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

	wp_enqueue_script('jquery');
        wp_register_script( 'jquery-hoverintent', $x.'js/jquery.hoverIntent.minified.js');
        wp_enqueue_script( 'jquery-hoverintent' );
    }
}

add_action('wp_head', 'ahab_add_my_hide_stuff');

/**
 * Hook main function only if user is logged in.
 * 
 * @author Marcel Bootsman
 * @link http://www.nostromo.nl/wordpress-plugins/auto-hide-admin-bar/
 * @param None
 * @return None
 */
function ahab_add_my_hide_stuff() {

    if (is_user_logged_in()) {
        auto_hide_admin_bar();
    }
}

?>