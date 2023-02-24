<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.logicrays.com/
 * @since      1.0.0
 *
 * @package    Lrbookly
 * @subpackage Lrbookly/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Lrbookly
 * @subpackage Lrbookly/admin
 * @author     LogicRays <dipali@logicrays.com>
 */
class Lrbookly_Admin {

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
		 * defined in Lrbookly_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lrbookly_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lrbookly-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style('jquery-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
		wp_enqueue_style('fontawesome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css');
		// wp_enqueue_style('jquery-css', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.css');

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
		 * defined in Lrbookly_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lrbookly_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		// wp_enqueue_script('jquery-min-js','https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',array( 'jquery' ),false); 
		// wp_enqueue_script('jquery','https://code.jquery.com/jquery-1.10.2.js',array( 'jquery' ),false);
		// wp_enqueue_script('jquery-ui-js',plugin_dir_url( __FILE__ ) . 'js/jquery-ui.js',array( 'jquery' ),false);
	
		// wp_enqueue_script('jquery','https://code.jquery.com/jquery-1.9.1.js',array( 'jquery' ),false);
		// wp_enqueue_script('jquery-ui','https://code.jquery.com/ui/1.10.3/jquery-ui.js',array( 'jquery' ),false);
		wp_enqueue_script('jquery-min', plugin_dir_url( __FILE__ ) .'js/jquery-ui.min.js',array('jquery'), $this->version, 'all' );
		wp_enqueue_script('jquery-ui', plugin_dir_url( __FILE__ ) .'js/jquery-ui.js',array('jquery'), $this->version, 'all' );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lrbookly-admin.js', array( 'jquery' ), $this->version, false );

	

	}
	public function lrbookly_service_post_type() {
		
		$labels = array(
			'name'                => _x( 'Services', 'Post Type General Name', 'lrbookly' ),
			'singular_name'       => _x( 'Services', 'Post Type Singular Name', 'lrbookly' ),
			'menu_name'           => __( 'Services', 'lrbookly' ),
			'parent_item_colon'   => __( 'Parent Services', 'lrbookly' ),
			'all_items'           => __( 'All Services', 'lrbookly' ),
			'view_item'           => __( 'View Services', 'lrbookly' ),
			'add_new_item'        => __( 'Add New Services', 'lrbookly' ),
			'add_new'             => __( 'Add New', 'lrbookly' ),
			'edit_item'           => __( 'Edit Services', 'lrbookly' ),
			'update_item'         => __( 'Update Services', 'lrbookly' ),
			'search_items'        => __( 'Search Services', 'lrbookly' ),
			'not_found'           => __( 'Not Found', 'lrbookly' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'lrbookly' ),
		);
	// Set other options for Custom Post Type
		$args = array(
			'label'               => __( 'Services', 'lrbookly' ),
			'description'         => __( 'Services news and reviews', 'lrbookly' ),
			'labels'              => $labels,  
			'supports'            => array(
											'title', // post title
											'editor', // post content
											'author', // post author
									),
			'taxonomies'          => array( 'genres' ),     
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true, //hide menu
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'menu_icon'           => 'dashicons-businessman',
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest' => true, 
		);
		// Registering your Custom Post Type
		register_post_type( 'services', $args );
	}
	
	public function lrbookly_booking_post_type()
	{
			$labels = array(
				'name'                => _x( 'Booking', 'Post Type General Name', 'lrbookly' ),
				'singular_name'       => _x( 'Booking', 'Post Type Singular Name', 'lrbookly' ),
				'menu_name'           => __( 'Booking', 'lrbookly' ),
				'parent_item_colon'   => __( 'Parent Booking', 'lrbookly' ),
				'all_items'           => __( 'All Booking', 'lrbookly' ),
				'view_item'           => __( 'View Booking', 'lrbookly' ),
				'add_new_item'        => __( 'Add New Booking', 'lrbookly' ),
				'add_new'             => __( 'Add New', 'lrbookly' ),
				'edit_item'           => __( 'Edit Booking', 'lrbookly' ),
				'update_item'         => __( 'Update Booking', 'lrbookly' ),
				'search_items'        => __( 'Search Booking', 'lrbookly' ),
				'not_found'           => __( 'Not Found', 'lrbookly' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'lrbookly' ),
			);
		// Set other options for Custom Post Type
			$args = array(
				'label'               => __( 'Booking', 'lrbookly' ),
				'description'         => __( 'Booking news and reviews', 'lrbookly' ),
				'labels'              => $labels,  
				'supports'            => array( 'title'),     
				'taxonomies'          => array( 'genres' ),     
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => 'edit.php?post_type=services', //hide menu
				'show_in_nav_menus'   => true,
				'show_in_admin_bar'   => true,
				//'menu_position'       => 5,
				'can_export'          => true,
				'has_archive'         => true,
				'menu_icon'           => 'dashicons-businessman',
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
				'show_in_rest' => true, 
			);
			// Registering your Custom Post Type
			register_post_type( 'bookings', $args );
		
	}

	//Register Meta box
	public function lrbookly_services_metabox() {
		add_meta_box(
			'lrbookly_services_metabox_id',       // $id
			'Services Fields',                  // $title
			array($this,'lrbookly_services_meta_render_page'),
			'services',                 // $page
			'normal',                  // $context
			'high'                     // $priority
		);
	 }
	 public function lrbookly_services_meta_render_page()
	 {
		require_once plugin_dir_path(__FILE__) . 'partials/lrbookly-services-metaboxes.php';
	 }
	 public function lrbookly_services_metabox_save($post_id )
	 {
		if ( isset($_POST['booking_avaibility']) || !empty($_POST['booking_avaibility'])  ){
			
			$postdata = $_POST['booking_avaibility'];
			$price_data = array(
				'enable' => $_POST['service_price_check_enable'],
				'price' => $_POST['service_price_check'],
			);
			$serviceDate =  array(
					'service_name' => $_POST['post_name'],
					'start_date' => $_POST['start_date'],
					'end_date' => $_POST['end_date'],
			);
			$weekday =  array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
			for($i = 0; $i < count($weekday); $i++) {
				$input[$postdata['day'][$i]] =  array(
					'day' => $postdata['day'][$i],
					'bookable' => $postdata['bookable'][$i],    
					'price' => $postdata['price'][$i],
					'customer_availibility' => $postdata['customer_availibility'][$i],
					'from_time' => $postdata['from_time'][$i],
					'to_time' => $postdata['to_time'][$i],
				);
			}	
			update_post_meta( $post_id, 'LrBooking_service_date',$serviceDate );
			update_post_meta( $post_id, 'LrBooking_all_service_price',$price_data );
			update_post_meta( $post_id, 'booking_avaibility',$input );
		} 
		// else {
		// 	update_post_meta( $post_id, 'LrBooking_service_date',$serviceDate );
		// 	update_post_meta( $post_id, 'LrBooking_all_service_price',$all_service_price );
		// 	update_post_meta( $post_id, 'booking_avaibility', '' );
		// }
	 }

	 public function add_service_settings_page()
	 { 	
			add_submenu_page(
			'edit.php?post_type=services',
			__( 'Settings', 'lrbookly' ),
			__( 'Settings', 'lrbookly' ),
			'manage_options',
			'service-settings',
			'service_settings_callback_function'
			);

			add_submenu_page(
				'edit.php?post_type=bookings',
				'Bookings' , 
				'Bookings' ,
				'manage_options', 
				'service-settings',
			);	 
			
	 }
	 public function register_global_weeks_settings()
	 {
		register_setting( 'global_weekdays_setting', 'lrbookly_global_service_days' );
        
	 }
	 public function register_global_dates_settings()
	 {
		register_setting( 'global_dates_setting', 'lrbookly_global_service_date' );
	 }
	 public function register_global_time_settings()
	 {
		register_setting( 'global_time_setting', 'lrbookly_global_service_time' );
	 }
	 public function service_payment_settings()
	 {
		register_setting( 'lrbookly_service_payment_setting', 'service_paypal_setting_data' );
	 }
	 public function service_email_template_settings()
	 {
		register_setting( 'lrbookly_service_userE-template_setting', 'user_service_Etemplate_setting_data' );
		
	 }
	 public function service_admin_email_template_settings()
	 {
		register_setting( 'lrbookly_service_adminE-template_setting', 'admin_service_Etemplate_setting_data' );
		
	 }
	 public function service_paypal_email_template_settings()
	 {
		register_setting( 'lrbookly_service_paypalE-template_setting', 'paypal_service_Etemplate_setting_data' );
		
	 }
	public function save_notice()
	{
		if(isset( $_GET[ 'page' ] ) && 'service-settings' == $_GET[ 'page' ] && isset( $_GET[ 'settings-updated' ] ) && true == $_GET[ 'settings-updated' ]){
			echo '<div class="notice notice-success is-dismissible">
					<p>
						<strong>Settings saved.</strong>
					</p>
				</div>';
		} 
	} 
	public function init_theme_method() {
		add_thickbox();
	}
	//filter
	public function posts_column_views($defaults)
	{
		$defaults = array(
			'cb' => $columns['cb'],
			'title' => __( 'Title' ),
			'selected_time' => __('Selected Time'),
			'selected_date'=> __('Selected Date'),
			'payment_status'=> __('Status'),
			'more'=> __('More'),
			'date' => __('Date'),
		);
		return $defaults;	
	}

	public function posts_custom_column_views($column_name, $post_ID)
	{
		global $post, $wpdb;
		$table_name = $wpdb->prefix . "lr_payment_order_table";
		$service = $wpdb->get_results( "SELECT * FROM $table_name WHERE `services_id` = $post->ID" );
		$data = get_post_meta($post->ID,'LRbooking_form_customer_data');
	
		if ( $column_name == 'selected_time') {
			$data = get_post_meta($post->ID,'LRbooking_form_customer_data');
			print_r($data[0]['selected_time']);
		}
		if ( $column_name == 'selected_date') {
			$data = get_post_meta($post->ID,'LRbooking_form_customer_data');
			print_r($data[0]['selected_date']);

		}
		if ( $column_name == 'payment_status') {
			if($data[0]['paymnet_option'] == 'paypal'){
				print_r('<p class="order_status">'.$service[0]->order_status.'</p>');
			}else{
				print_r('<p class="cod_order_status">Processing</p>');
			}
		}
		if($column_name =='more'){ 
			echo '<a href="#TB_inline?&width=600&height=500&inlineId=my-content-id'.$post->ID.'" class="thickbox button" title="Service Booking Details">More</a>
			<div id="my-content-id'.$post->ID.'" style="display:none;">
				<strong><p>Customer Details</p></strong>
				<table id="moreDetials">
					<tr>
						<th>Username</th>
						<td>'.$data[0]['name'].'</td>
					</tr>
					<tr>
						<th>Gender</th>
						<td>'.$data[0]['gender'].'</td>
					</tr>
					<tr>
						<th>Email</th>
						<td>'.$data[0]['email'].'</td>
					</tr>
					<tr>
						<th>Telephone</th>
						<td>'.$data[0]['phone_no'].'</td>
					</tr>
					<tr>
						<th>Address</th>
						<td>'.$data[0]['address'].'</td>
					</tr>
					<tr>
						<th>Paymnet Option</th>
						<td>'.$data[0]['paymnet_option'].'</td>
					</tr>
				</table>'.
				(($data[0]['paymnet_option'] == 'paypal') ? '<strong><p>Service Details</p></strong>
				<table id="moreDetials">
					<tr>
						<th>Service Name</th>
						<td>'.$service[0]->services_name.'</td>
					</tr>
					<tr>
						<th>Service Amount</th>
						<td>'.$service[0]->total_amount.'</td>
					</tr>
					<tr>
						<th>Shipping Charges</th>
						<td>'.$service[0]->shipping_charges.'</td>
					</tr>
					<tr>
						<th>Transaction Id</th>
						<td>'.$service[0]->transaction_id.'</td>
					</tr>
					<tr>
						<th>Order Status</th>
						<td>'.$service[0]->order_status.'</td>
					</tr>
				</table>' : 'cod').'
			</div>';	
		}
	}

	function verify_user_code(){
		if(isset($_GET['act'])){
			$data = unserialize(base64_decode($_GET['act']));
			$code = get_post_meta($data['id'], 'activation_code', true);
			// verify whether the code given is the same as ours
			if($code == $data['code']){
				echo 'Your Service booking is Confirmed!';
				update_post_meta($data['id'], 'is_activated', 1);
				wc_add_notice( __( '<strong>Success:</strong> Your Service booking is Confirmed! ', 'lrbookly' )  );
			}
		}
	}
}
function service_settings_callback_function()
{
	require_once plugin_dir_path(__FILE__) . 'partials/lrbookly-settings.php';
}