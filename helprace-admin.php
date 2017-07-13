<?php 
/**
 * Helprace Feedback Admin Class.
 *
 * @class Helprace_Admin
 */
 
class Helprace_Admin {
	
	private static $page_slug = 'helprace-feedback-tab'; // Admin feedback setting page slug
	
	/**
	 * The single instance of the class.
	 *
	 * @var Helprace_Admin
	 */
     
	private static $instance = null; 
	
	/**
	 * Class Helprace_Admin Constructor.
	 */
     
	public function __construct(){
	  
	  /**
	   * Initialize hook.
	   */	
       
	  add_action( 'init',  array( $this, 'init') );	
	
	}
	
	/**
	 * Admin Class.
	 *
	 * Single instance of class loaded once.
	 * @static
	 * @return Helprace_Admin - instance.
	 */
     
	public static function get_instance(){
	  
	  if( is_null( self::$instance ) )
	  self::$instance = new self();	// Get class instance 
	  return self::$instance;
	}
	
	/**
	 * Register wordpress hooks filters and actions.
	 */
     
	public function init(){
	
	  $this->init_hooks();	
		
	}
	
    /**
	 * Hook into actions and filters.
	 */
     
	private function init_hooks(){
	  add_filter( 'plugin_action_links_'.plugin_basename( HRFW_PLUGIN_DIR . 'helprace-feedback-tab.php'), array( $this , 'plugin_setting_link' ) );
	  add_action( 'admin_menu', array( $this, 'admin_menu') );	
	  add_action( 'admin_init', array( $this, 'admin_init') );
	}

	/**
	 * Show action links on the plugin page.
	 *
	 * @param	array $links Plugin Action links
	 * @return	array
	 */
     
	public function plugin_setting_link( $links ){
	  $setting_link = array( '<a href="'. esc_url( admin_url( 'options-general.php?page='.self::$page_slug ) ) .'">' .__( 'Settings', 'helprace' ). '</a>' );
	  return array_merge( $setting_link, $links );
	}

    /**
	 * Add admin menu item in admin Settings.
	 *
	 */	
     
	public function admin_menu(){
	  // Create a new admin menu item in settings tab.	
	  $hook = add_options_page( 
	            __( 'Helprace Feedback Tab', 'helprace' ), 
			    __( 'Helprace Feedback Tab', 'helprace' ), 
			    'manage_options', 
			    self::$page_slug , 
			    array( $this, 'settings_page') 
			  );	
	  // 			  
	  add_action( 'load-'.$hook, array( $this, 'settings_enqueue_scripts' ) );
	}

    /**
	 * Register settings option item.
	 */
     
	public function admin_init(){
        
		register_setting(
          self::$page_slug,  // settings section current page slug name
          'helprace_options', // setting name
		  array( $this, 'validate_settings') // validate callback
        );
	}
	
	/**
	 * Enqueue scripts and styles in setting page.
	 *
	 */
     
	public function settings_enqueue_scripts(){
	  wp_enqueue_style( 'wp-color-picker' ); 
	  wp_enqueue_style( 'helprace-admin', HRFW_PLUGIN_URL.'assets/css/admin-style.css' );
	  wp_enqueue_script( 'helprace-admin', HRFW_PLUGIN_URL.'assets/js/admin-script.js', array('jquery', 'wp-color-picker' ) );	
	}
	
	/**
	 * Display feedback settings form content.
	 *
	 */
     
	public function settings_page(){
      
	  require_once( HRFW_PLUGIN_DIR.'templates/admin-settings-form.php' );
	
	}

    /**
	 * Validate sanitizes option's value.
	 *
	 */  
     
	public function validate_settings( $fields ){
	   if( empty( $fields['hfbw_name'] ) )
	   add_settings_error( 'helprace_options', 'hfbw_name', __( 'Insert a valid Domain Name', 'helprace' ), 'error' );
	   return $fields;
    }	


}