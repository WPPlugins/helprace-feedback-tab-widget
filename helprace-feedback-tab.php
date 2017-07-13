<?php 
/**
 * Plugin Name: Helprace Feedback Tab
 * Plugin URI: https://www.example.com/
 * Description: Add Helprace feedback tab widget on your site 
 * Version: 1.0.0
 * Author: Helprace
 * Author URI: https://helprace.com/
 * Text Domain: helprace
 * License: GPLv2 or later
*/

if( ! defined( 'ABSPATH' ) ) exit();

/**
 * Define Helprace Feedback Constants.
 */
 
define( 'HRFW_VERSION', '1.0.0' );
define( 'HRFW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'HRFW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Initialize language files
 */
 
function helprace_feedback_init_lang(){
  load_plugin_textdomain('helprace', false, dirname( plugin_basename( __FILE__ ) ). '/lang/');	
}
add_action('plugins_loaded', 'helprace_feedback_init_lang');

/**
 * Include required core files used in admin.
 */
 
if( is_admin() ){
  require_once( HRFW_PLUGIN_DIR . 'helprace-admin.php' );
  Helprace_Admin::get_instance();
}

/**
 * Default settings of display feeback widget settings.
 *
 * @return Array
 */
 
function helprace_feedback_default_settings(){
	return array( 
	  'hfbw_display' => 'enable',
	  'hfbw_name'   => '',
	  'hfbw_type'   => 'tab',
	  'hfbw_position' => 'left',
	  'hfbw_title' => __('Feedback & Support', 'helprace'),
	  'hfbw_bgcolor' => '#78a300',
	  'hfbw_textcolor' => '#fff',
	  'hfbw_openew_tab' => 'false',
	);  
}	
	
/**
 * Manual function for add helprace feedback javascript and display feeback widget tab.
 *
 * @param array $args 
 */
 
function helprace_feedback_widget_display( $args ){
   
   if( ! isset( $args['hfbw_display'] ) )
   $args['hfbw_display'] = 'disable';
   
   $options = wp_parse_args( $args, helprace_feedback_default_settings() );
   if( $options['hfbw_display'] != 'enable' || empty( $options['hfbw_name'] ) )
   return false;
   $widget_object = array( 
     'url' =>  '//'.$options['hfbw_name'].'.helprace.com/chd-widgets/feedback',
	 'assetsUrl' => '//d1culzimi74ed4.cloudfront.net/',
	 'feedbackType' => $options['hfbw_type']
   );
   
   if( $options['hfbw_type'] == 'tab' ){
	 $widget_object['tabTitle'] = $options['hfbw_title'];
	 $widget_object['tabPosition'] = $options['hfbw_position'];
	 $widget_object['tabBgColor'] = $options['hfbw_bgcolor'];
	 $widget_object['tabTextColor'] = $options['hfbw_textcolor'];
	 $widget_object['tabAction'] = $options['hfbw_openew_tab'];
   }
 echo '<script src="//d1culzimi74ed4.cloudfront.net/js/feedback/feedback.js"></script>'.PHP_EOL;
 echo '<script>ChdFeedbackWidget.init('.json_encode($widget_object).')</script>';
}		

/**
 * Display feedback widget fronted.
 */
 
function helprace_feedback_footer_init(){
  helprace_feedback_widget_display( (array)get_option( 'helprace_options' ) ); 	
}
add_action( 'wp_footer', 'helprace_feedback_footer_init', 5000 );

