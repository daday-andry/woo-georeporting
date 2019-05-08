<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       andrynirina.portfoliobox.net
 * @since      1.0.0
 *
 * @package    Woo_Georeporting
 * @subpackage Woo_Georeporting/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_Georeporting
 * @subpackage Woo_Georeporting/admin
 * @author     ANDRY Nirina <andrysahaedena@gmail.com>
 */
class Woo_Georeporting_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Georeporting_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Georeporting_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-georeporting-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ).'css/bootstrap.min.css',array(), $this->version);
		///wp_enqueue_style( $this->plugin_name,"",array(), $this->version);
		

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Georeporting_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Georeporting_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo-georeporting-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name,'http://cdn.leafletjs.com/leaflet-0.7.1/leaflet.js');

	}
	public function add_admin_menu_page(){
		$this->plugin_screen_hook_suffix = add_menu_page( "woo-georeporting", "Woo Geo-reporting","manage_options","woo-georeporting",array($this,'admin_page'));
		
	}
	function admin_page(){
		if (is_plugin_active('woocommerce/woocommerce.php')) {
			include_once 'partials/woo-georeporting-admin-display.php';
		}else{
			include_once 'partials/woo-georeporting-404.php';
		}
		 
	 }

}
