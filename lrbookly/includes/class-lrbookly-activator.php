<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.logicrays.com/
 * @since      1.0.0
 *
 * @package    Lrbookly
 * @subpackage Lrbookly/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Lrbookly
 * @subpackage Lrbookly/includes
 * @author     LogicRays <dipali@logicrays.com>
 */
class Lrbookly_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		
		global $wpdb;
        $table_name = $wpdb->prefix.'lr_payment_order_table';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
                    id INT(20) NOT NULL AUTO_INCREMENT,
                    receiver_id varchar(100) NOT NULL,
					total_amount varchar(100) NOT NULL,
					payer_email varchar(100) NOT NULL,
					shipping_charges varchar(100) NOT NULL,
					transaction_id varchar(100) NOT NULL,
					order_status varchar(100) NOT NULL,
					verify_sign varchar(100) NOT NULL,
					services_name varchar(100) NOT NULL,
					services_id INT(20) NOT NULL,
                    PRIMARY KEY (id) )";	
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );


		//CREAT THANK YOU PAGE :	

		if( get_page_by_title( 'thank-you' ) == NULL ){
			$PageGuid = site_url() . "/thank-you";
			$my_post  = array( 'post_title'     => 'Thank You',
							'post_type'      => 'page',
							'post_name'      => 'thank-you',
							'post_content'   => '[success]',
							'post_status'    => 'publish',
							'comment_status' => 'closed',
							'ping_status'    => 'closed',
							'post_author'    => 1,
							'menu_order'     => 0,
							'guid'           => $PageGuid );
			
			$PageID = wp_insert_post( $my_post, FALSE ); 
		}	
	}
}
