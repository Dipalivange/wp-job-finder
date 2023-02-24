<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.logicrays.com/
 * @since      1.0.0
 *
 * @package    Lrbookly
 * @subpackage Lrbookly/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Lrbookly
 * @subpackage Lrbookly/includes
 * @author     LogicRays <dipali@logicrays.com>
 */
class Lrbookly {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Lrbookly_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'LRBOOKLY_VERSION' ) ) {
			$this->version = LRBOOKLY_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'lrbookly';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Lrbookly_Loader. Orchestrates the hooks of the plugin.
	 * - Lrbookly_i18n. Defines internationalization functionality.
	 * - Lrbookly_Admin. Defines all hooks for the admin area.
	 * - Lrbookly_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-lrbookly-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-lrbookly-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-lrbookly-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-lrbookly-public.php';

		$this->loader = new Lrbookly_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Lrbookly_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Lrbookly_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Lrbookly_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		//CUSTOM POST TYPE:
		$this->loader->add_action( 'init', $plugin_admin, 'lrbookly_service_post_type');
		$this->loader->add_action( 'init', $plugin_admin, 'lrbookly_booking_post_type');
		//CUSTOM META BOX:
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'lrbookly_services_metabox');
		//SAVE CUSTOM META BOX
		$this->loader->add_action( 'save_post', $plugin_admin, 'lrbookly_services_metabox_save');
		//ADD SUBMENU PAGE
		$this->loader->add_action( 'admin_menu', $plugin_admin,'add_service_settings_page' );
		//REGISTER SUBMENU /options SETTINGS:
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_global_weeks_settings' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_global_dates_settings' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_global_time_settings' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'service_payment_settings' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'service_email_template_settings' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'service_admin_email_template_settings' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'service_paypal_email_template_settings' );
		
		//save message
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'save_notice');
		//ADD Filter and Action
		$this->loader->add_filter('manage_bookings_posts_columns',$plugin_admin, 'posts_column_views');
		$this->loader->add_action('manage_bookings_posts_custom_column',$plugin_admin, 'posts_custom_column_views',5,2);
		//thickBox
		$this->loader->add_action('init',$plugin_admin, 'init_theme_method');
		//verification link
		$this->loader->add_action( 'init',$plugin_admin,'verify_user_code' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Lrbookly_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		//add css and js for form
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'my_scripts_and_stylesheets' );
		//selected booking 
		$this->loader->add_action( 'wp_ajax_service_booking_date',$plugin_public, 'service_booking_date_data' );
		$this->loader->add_action( 'wp_ajax_nopriv_service_booking_date',$plugin_public, 'service_booking_date_data');
		//selected service date
		$this->loader->add_action( 'wp_ajax_service_booking_time_slot',$plugin_public, 'service_booking_time_slot_data' );
		$this->loader->add_action( 'wp_ajax_nopriv_service_booking_time_slot',$plugin_public, 'service_booking_time_slot_data');
		//save booking form data
		$this->loader->add_action( 'wp_ajax_service_booking_form_data',$plugin_public, 'service_booking_form_data_function' );
		$this->loader->add_action( 'wp_ajax_nopriv_service_booking_form_data',$plugin_public,'service_booking_form_data_function');
		//check email of user
		$this->loader->add_action( 'wp_ajax_check_user_mail',$plugin_public, 'check_user_mail_data' );
		$this->loader->add_action( 'wp_ajax_nopriv_check_user_mail',$plugin_public, 'check_user_mail_data');
		//check email of user
		$this->loader->add_action( 'wp_ajax_save_with_position',$plugin_public, 'save_with_position_data' );
		$this->loader->add_action( 'wp_ajax_nopriv_save_with_position',$plugin_public, 'save_with_position_data');
		//Add custom action action
		$this->loader->add_filter( 'page_template',$plugin_public, 'wpd_plugin_page_template' );
	


	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Lrbookly_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
