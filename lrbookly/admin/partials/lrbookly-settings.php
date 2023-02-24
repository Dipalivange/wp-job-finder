<div class="wrap">
<h3><?php _e('Global Setting For Days');?></h3>
<?php
 $dateSetting = ( isset( $_GET['tab'] ) && 'service-date' == $_GET['tab'] ) ? true : false;
 $payment = ( isset( $_GET['tab'] ) && 'payment' == $_GET['tab'] ) ? true : false;
 $Etemplate = ( isset( $_GET['tab'] ) && 'email-template-settings' == $_GET['tab'] ) ? true : false;
 $timeInterval = ( isset( $_GET['tab'] ) && 'email-timeInterval-settings' == $_GET['tab'] ) ? true : false;

 //Email Template link:
 $user_mail_template = ( isset( $_GET['tab'] ) && 'user_mail_template' == $_GET['tab'] ) ? true : false;
 $admin_mail_template = ( isset( $_GET['action'] ) && 'admin-template' == $_GET['action'] ) ? true : false;
 $paypal_mail_template = ( isset( $_GET['action'] ) && 'paypal-template' == $_GET['action'] ) ? true : false;	

?>
<div style="padding-bottom: 12px;">
	<h2 class="nav-tab-wrapper">

		<a href="<?php echo admin_url( 'edit.php?post_type=services&page=service-settings' ); ?>" class="nav-tab<?php if ( ! isset( $_GET['tab'] ) || isset( $_GET['tab'] )  && 'service-date' != $_GET['tab']  && 'payment' != $_GET['tab']  && 'email-timeInterval-settings' != $_GET['tab']&& 'email-template-settings' != $_GET['tab'] ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'Weekdays Settings' ); ?></a>

		<a href="<?php echo esc_url( add_query_arg( array( 'tab' => 'service-date' ), admin_url( 'admin.php?page=service-settings' ) ) ); ?>" class="nav-tab<?php if ( $dateSetting ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'Date Setting' ); ?></a> 

		<a href="<?php echo esc_url( add_query_arg( array( 'tab' => 'payment' ), admin_url( 'admin.php?page=service-settings' ) ) ); ?>" class="nav-tab<?php if ( $payment ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'Payment' ); ?></a> 

		<a href="<?php echo esc_url( add_query_arg( array( 'tab' => 'email-template-settings' ), admin_url( 'admin.php?page=service-settings' ) ) ); ?>" class="nav-tab<?php if ( $Etemplate ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'Email Template' ); ?></a> 

		<a href="<?php echo esc_url( add_query_arg( array( 'tab' => 'email-timeInterval-settings' ), admin_url( 'admin.php?page=service-settings' ) ) ); ?>" class="nav-tab<?php if ( $timeInterval ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'Time Interval Settings' ); ?></a> 
		 
	</h2>
</div> 
<?php
if($Etemplate){ ?>
	<ul class="subsubsub" style="float: none;">	
		<li class="basicgrid_gallery">
			<a href="<?php echo esc_url( add_query_arg( array( 'tab' => 'email-template-settings' ), admin_url( 'admin.php?page=service-settings' ) ) ); ?>" class="<?php if ( ! isset( $_GET['action'] ) || isset( $_GET['action'] ) && 'admin-template' != $_GET['action']  && 'paypal-template' != $_GET['action'] ) echo ' current'; ?>"><?php esc_html_e( 'User Template' ); ?></a> |
		</li>
		<li class="basicslider_gallery">
			<a href="<?php echo esc_url( add_query_arg( array( 'tab' => 'email-template-settings', 'action' => 'admin-template'), admin_url( 'admin.php?page=service-settings' ) ) ); ?>" class="<?php if ( $admin_mail_template ) echo ' current'; ?>"><?php esc_html_e( 'Admin Template' ); ?></a> |
		</li>
		<li class="basicslider_gallery">
			<a href="<?php echo esc_url( add_query_arg( array( 'tab' => 'email-template-settings' ,'action' => 'paypal-template' ), admin_url( 'admin.php?page=service-settings' ) ) ); ?>" class="<?php if ( $paypal_mail_template ) echo ' current'; ?>"><?php esc_html_e( 'Paypal Template' ); ?></a> 
		</li>
	</ul> 
<?php }
if($payment){
	require_once plugin_dir_path(__FILE__) . 'lrbookly-payment-settings.php';
}elseif($Etemplate) {
	if( ! isset( $_GET['action'] ) || isset( $_GET['action'] ) && 'admin-template' != $_GET['action']  && 'paypal-template' != $_GET['action'] ){
		require_once plugin_dir_path(__FILE__) . 'lrbookly-user-email-template-settings.php';
	}
	if($admin_mail_template){
		require_once plugin_dir_path(__FILE__) . 'lrbookly-admin-mail-template-settings.php';
	}
	if($paypal_mail_template){
		require_once plugin_dir_path(__FILE__) . 'lrbookly-paypal-email-template-settings.php';
	}
}elseif($timeInterval) {
	require_once plugin_dir_path(__FILE__) . 'lrbookly-time-interval-settings.php';
}elseif($dateSetting) {
	require_once plugin_dir_path(__FILE__) . 'lrbookly-dates-settings.php';
}else{	
	require_once plugin_dir_path(__FILE__) . 'lrbookly-weekdays-settings.php';
}

?>



   