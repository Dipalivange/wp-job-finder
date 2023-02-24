<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.logicrays.com/
 * @since      1.0.0
 *
 * @package    Lrbookly
 * @subpackage Lrbookly/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Lrbookly
 * @subpackage Lrbookly/public
 * @author     LogicRays <dipali@logicrays.com>
 */
class Lrbookly_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_shortcode( 'my_shortcode', array($this, 'my_shortcode_add') );
		add_shortcode( 'success', array($this, 'thank_you_page_shortcode') );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lrbookly-public.css', array(), $this->version, 'all' );
		wp_enqueue_style('font-awesome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_enqueue_style('jquery-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lrbookly-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script('jquery-min', plugin_dir_url( __FILE__ ) .'js/jquery-ui.min.js',array('jquery'), $this->version, 'all' );
		wp_enqueue_script('jquery-ui', plugin_dir_url( __FILE__ ) .'js/jquery-ui.js',array('jquery'), $this->version, 'all' );

		wp_enqueue_script( 'lrbookly-ajax', plugin_dir_url( __FILE__ ) . 'js/lrbookly-public.js', array('jquery'),$this->version, false );
		wp_localize_script( 'lrbookly-ajax', 'lrbookly_ajax_object',
			array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'my-special-string' )
			)
		);	
	}
	public function save_with_position_data()
	{
		// print_r($_POST);
		global $wpdb;
		// echo $id = $_POST['id'];
		$x = $_POST['pos_x'];
		$y = $_POST['pos_y'];
		$table_no = $_POST['table_no'];
		$table_name = "element_positon";
		$available_table = array();
		
		$data = $wpdb->get_results("SELECT * FROM $table_name");
		// print_r($data);
		// exit;
		foreach($data as $table){
			$id = $table->id;
			$available_table[] = $table->table_no;	
		}
		if (in_array($table_no, $available_table)){
			// echo "found";
			$update = $wpdb->prepare("UPDATE $table_name 
			SET `x_position` = '$x' ,
				 `y_position` = '$y'
		 	WHERE `table_no` = '$table_no'");
			$wpdb->query($update);
			$result = array();
			$result['data']= ['x'=>$x,'y'=>$y,'table_no'=>$table_no];
	
			

		}else{
			// echo "notfound";
			$sql = $wpdb->prepare( "INSERT INTO ".$table_name." (x_position, y_position, table_no ) VALUES (  $x, $y, $table_no )");
			$wpdb->query($sql);
			$id = $wpdb->insert_id;
			$result = array();
			$result['data']= ['x'=>$x,'y'=>$y,'table_no'=>$table_no];
	
		}
		echo json_encode($result);
		exit;
		// print_r($available_table);
		// $sql = $wpdb->prepare( "INSERT INTO ".$table_name." (x_position, y_position, table_no ) VALUES (  $x, $y, $table_no )");
		// $wpdb->query($sql);
		// $id = $wpdb->insert_id;
		exit;
	}


	public function my_shortcode_add(){
		if(shortcode_exists('my_shortcode')) {
			wp_enqueue_script('shortcode-js'); //loaded here
			wp_enqueue_style('shortcode-css'); //loaded here
			ob_start();
			require_once plugin_dir_path(__FILE__) . 'partials/lrbookly-booking-form.php';
			return ob_get_clean();
		}
		
	}
	public function my_scripts_and_stylesheets() {
		wp_register_script( 'shortcode-js', plugin_dir_url( __FILE__ ) . 'js/lrbookly-public.js', array( 'jquery' ), '1.0', true );
		wp_register_style('shortcode-css', plugin_dir_url( __FILE__ ) . 'css/lrbookly-public.css' );
	}
	public function service_booking_date_data()
	{
		if(isset($_POST['booking_services']) && !empty($_POST['booking_services'])){
			
			global $wpdb;
			$service_name = $_POST['booking_services'];
			$id_query = $wpdb->get_var("SELECT `id` FROM `wp_posts` WHERE `post_title` = '$service_name' ");
			$booking_date = get_post_meta($id_query,'LrBooking_service_date');
			

			$Date1 = $booking_date[0]['start_date'];
			$Date2 = $booking_date[0]['end_date'];

			//GLOBAL DATE:
			$global_date = get_option('lrbookly_global_service_date');
			// print_r($global_date);
			if($global_date['is_enabled']){
				$global_start_date = $global_date['from_date'];
				$global_end_date = $global_date['to_date'];

				$now = new DateTime($global_start_date);
				$startdate = new DateTime($Date1);
				$enddate = new DateTime($Date2);
			}
			$global_disable_date = displayDates($global_start_date, $global_end_date);
			// print_r($global_disable_date);

			//GLOBAL DAY:
			$global_days = get_option('lrbookly_global_service_days');
			$day_name = array_keys($global_days);
			$disable_days = array();
			foreach($day_name as $key => $val){			
				$disable_days[] = $val;
			}
			if($startdate <= $now && $now <= $enddate) {
				$availableDates = array();
			
				$Variable1 = strtotime($Date1);
				$Variable2 = strtotime($Date2);
				// Use for loop to store dates into array
				// 86400 sec = 24 hrs = 60*60*24 = 1 day
				for ($currentDate = $Variable1; $currentDate <= $Variable2; 
												$currentDate += (86400)) {
					$Store = date('j-n-Y', $currentDate);
					$availableDates[] = $Store;
				}
				
				$result = array();
				$result['global_date']= $global_disable_date;
				$result['global_days']= $disable_days;
				$result['avilable_date']= $availableDates;
			}else{
				$availableDates = array();
			
				$Variable1 = strtotime($Date1);
				$Variable2 = strtotime($Date2);
				// Use for loop to store dates into array
				// 86400 sec = 24 hrs = 60*60*24 = 1 day
				for ($currentDate = $Variable1; $currentDate <= $Variable2; 
												$currentDate += (86400)) {
					$Store = date('j-n-Y', $currentDate);
					$availableDates[] = $Store;
				}
				$result = array();
				$result['avilable_date']= $availableDates;
			}
			
		}
		echo json_encode($result);
		exit;
	}
	function wpd_plugin_page_template( $page_template ){
		if ( is_page( 'thank-you' ) ) {
			$page_template = plugin_dir_path(__FILE__) . 'partials/lrbookly-booking-thank-you.php';
		}
		return $page_template;
	}
	public function service_booking_time_slot_data()
	{
		if(isset($_POST['selected_date']) && !empty($_POST['selected_date'])){
			global $wpdb;
			$service_name = $_POST['service'];
			$serviceDate = $_POST['selected_date'];
			$day = date('l', strtotime($serviceDate));

			$id_query = $wpdb->get_var("SELECT `id` FROM `wp_posts` WHERE `post_title` = '$service_name' ");
			$time = get_post_meta( $id_query, 'booking_avaibility',true );
			
			$res = search($time, 'bookable', '1');
			
			//check specific date time slot:
			$selected_time = array();
			$serveceDate_time = array();
			$currentDate_time = array();
			$customer_availibity = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE `meta_key` = 'LRbooking_form_customer_data'");

			foreach($customer_availibity as $data){
				
				$value = unserialize($data->meta_value);
				$serviceName = $value['service_name'];
				$serveceDate_time[] = array(
					"date" => $value['selected_date'],
					"time" => $value['selected_time']
				);
				$currentDate_time[] = array(
					"date" => $serviceDate,
					"time" => $value['selected_time']
				);
				$intersect = array_uintersect($serveceDate_time, $currentDate_time, 'compareDeepValue');
				if($intersect){
					$selected_time[] = $value['selected_time'];
				}
			}

			//get the particular service time slot with date:
			$time_array = array();	
			foreach($res as $value){
				$service_price = $value['price'];
				
				if($value['day'] == $day){
					$time_array = array(
						'from_time' => $value['from_time'],
						'to_time' => $value['to_time']
					);
					$service_availibility = $value['customer_availibility'];
					$get_time = get_option('lrbookly_global_service_time');
					$duration = $get_time['intervai_time'];
					$start = $time_array['from_time'];
					$end = $time_array['to_time'];
					
					$time_slots = prepare_time_slots($start, $end, $duration);
					$bookedTime=array_intersect($time_slots,$selected_time);
					$result = array();
					$result['service_name'] = $service_name;
					$result['service_price'] = $service_price;
					$result['availivility'] = $service_availibility;
					$result['data']= $time_slots;
					$result['booked'] = $selected_time;
					$result['msg']= "Get Slot";
				}
			}
			if($time_array == null){
				$result = array();
				$result['data']= null;
				$result['msg']= "Not Slot";
			}
		}
		echo json_encode($result);
		exit;
	}
	public function service_booking_form_data_function()
	{
		print_r($_POST);
		echo $nonce = $_POST['security'];
		echo "<br>";
		if ( ! wp_verify_nonce( $nonce, 'my-special-string' ) ) {
			die( 'Nonce value cannot be verified.' );
		}else{
			echo 'verified';
		}
   
		$adminInfo = get_users('role=Administrator');
		$adminMail = array();
		foreach ($adminInfo as $admin) {
			$adminMail[] = array('admin' => $admin->user_email);
		}  
		$admin_email = $adminMail[0]['admin'];
		
		$id = wp_insert_post(array(
			'post_title'=>$_POST['formData']['service_name'], 
			'post_type'=>'bookings', 
			'post_status'=>'publish'
		));
		$data = array(
			'service_name' => $_POST['formData']['service_name'], 
			'selected_date' => $_POST['formData']['selected_date'],
			'selected_time' => $_POST['formData']['selected_time'],
			'gender' => $_POST['formData']['gender'],
			'address' => $_POST['formData']['address'],
			'name' => $_POST['formData']['name'],
			'email' => $_POST['formData']['email'],
			'phone_no' => $_POST['formData']['phone_no'],
			'paymnet_option' => $_POST['formData']['paymnet_option'],
		); 

		add_post_meta($id,'LRbooking_form_customer_data',$data);
		$code = md5(time());
		
		$string = array('id'=>$id, 'code'=>$code);
		
		add_post_meta($id, 'account_activated', 0);
    	add_post_meta($id, 'activation_code', $code);

		$url = get_site_url(). '/?act=' .base64_encode( serialize($string));
		$html_link = 'Please click the following links <br/><br/> <a href="'.$url.'">'.$url.'</a>';
		$shortcodes = array(		
			"[user-name]", 
			"[user-email]", 
			"[services]" ,
			"[link]"
		);
		$data = array(		
			$_POST['formData']['name'],
			$_POST['formData']['email'],
			$_POST['formData']['service_name'],
			$html_link
		);

		$user_op = get_option('user_service_Etemplate_setting_data');
		$admin_op = get_option('admin_service_Etemplate_setting_data');

		if($user_op['is_enable'] == "yes"){
			$subject =str_replace( $shortcodes, $data, $user_op['user_template_subject']);		
			$message = str_replace( $shortcodes, $data, $user_op['user_template_msg']);
			$to = $_POST['formData']['email'];
			$headers = 'From: '. $_POST['formData']['email'] . "\r\n" .
				'Reply-To: ' . $_POST['formData']['email'] . "\r\n";
			$sent = wp_mail($to, $subject, strip_tags($message), $headers);
		}
		
		if($admin_op['is_enable'] == "yes"){
			$subject =str_replace( $shortcodes, $data, $admin_op['admin_template_subject']);		
			$message = str_replace( $shortcodes, $data, $admin_op['admin_template_msg']);
			$to = $admin_email;
			$headers = 'From: '. $admin_email . "\r\n" .
				'Reply-To: ' . $admin_email . "\r\n";
					
			$sent = wp_mail($to, $subject, strip_tags($message), $headers);
		}
		$result = array();
		$result['data']= 'booking';
		$result['msg']= "Booking Successfully";
		
		echo json_encode($result);
		exit;
	}	
	public function success_callback()
	{
		ob_start();
		require_once plugin_dir_path(__FILE__) . 'partials/lrbookly-booking-thank-you.php';
		return ob_get_clean();
	}

	function custom_function($arga){
		echo $arga;
 	}

	public function check_user_mail_data()
	{
		if(isset($_POST['emailInput']) && !empty($_POST['emailInput'])){
			global $wpdb;
			$email = $_POST['emailInput'];
			$exit_mail = array();
			$customer = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE `meta_key` = 'LRbooking_form_customer_data'");
			foreach($customer as $data){
				$check_val = unserialize($data->meta_value);
				$exit_mail[] =  $check_val['email'];
			}
			// print_r($exit_mail);
			if (in_array($email, $exit_mail)){
				$result = array();
				$result['data']= 'exist';
				$result['msg']= "Email Exist";
			}else{
				$result = array();
				$result['data']= 'new_email';
				$result['msg']= "Email not Exist";	
			}
			
		}
		echo json_encode($result);
		exit;
	}
 
}

function prepare_time_slots($starttime, $endtime, $duration){
	 
	$time_slots = array();
	$start_time    = strtotime($starttime); 
	$end_time      = strtotime($endtime); 
	 
	$add_mins  = $duration * 60;
	while ($start_time <= $end_time) 
	{
	   $time_slots[] = date("h:i:a", $start_time);
	   $start_time += $add_mins; 
	}
	return $time_slots;

}
function search($array, $key, $value) {
    $results = array();
    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }
        foreach ($array as $subarray) {
            $results = array_merge($results, 
                    search($subarray, $key, $value));
        }
    }
    return $results;
}
function compareDeepValue($val1, $val2)
{
   return strcmp($val1['date'], $val2['date']);
}

function displayDates($date1, $date2, $format = 'j-n-Y' ) {
	$dates = array();
	$current = strtotime($date1);
	$date2 = strtotime($date2);
	$stepVal = '+1 day';
	while( $current <= $date2 ) {
	   $dates[] = date($format, $current);
	   $current = strtotime($stepVal, $current);
	}
	return $dates;
 }