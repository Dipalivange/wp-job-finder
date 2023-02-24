<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header(); ?>
<hr>
<?php
    if ( !empty( $_REQUEST) && isset($_REQUEST['st'])=='completed' ){
        GLOBAL $wpdb;   
 
      $amount = isset($_GET['amt']) && !empty($_GET['amt']) ? $_GET['amt'] :''; 
      $payment_status =  isset($_GET['payment_status'])  && !empty($_GET['payment_status']) ? $_GET['payment_status'] : ''; 
      $receiver_id =  isset($_GET['receiver_id'])  && !empty($_GET['receiver_id'])? $_GET['receiver_id'] : ''; 
      $payer_email =  isset($_GET['payer_email'])  && !empty($_GET['payer_email'])? $_GET['payer_email'] : ''; 
      $shipping = isset($_GET['shipping'])  && !empty($_GET['shipping'])? $_GET['shipping'] : ''; 
      $payer_id = isset($_GET['payer_id'])  && !empty($_GET['payer_id'])? $_GET['payer_id'] : ''; 
      $item_name = isset($_GET['item_name'])  && !empty($_GET['item_name'])? $_GET['item_name'] : '';
        //Transaction Id: 
      $transactionId = isset($_GET['tx'])  && !empty($_GET['tx'])? $_GET['tx'] : ''; 
      $verify_sign = isset($_GET['verify_sign'])  && !empty($_GET['verify_sign'])? $_GET['verify_sign'] : '';


        //Service Data:  
      $service_date = isset($_GET['service_date']) && !empty($_GET['service_date']) ? $_GET['service_date'] :''; 
      $selected_time =  isset($_GET['selected_time'])  && !empty($_GET['selected_time']) ? $_GET['selected_time'] : ''; 
      $gender =  isset($_GET['gender'])  && !empty($_GET['gender'])? $_GET['gender'] : ''; 
      $address =  isset($_GET['address'])  && !empty($_GET['address'])? $_GET['address'] : ''; 
      $customer_name = isset($_GET['customer_name'])  && !empty($_GET['customer_name'])? $_GET['customer_name'] : ''; 
      $phone_no = isset($_GET['phone_no'])  && !empty($_GET['phone_no'])? $_GET['phone_no'] : '';
      $customer_mail  = isset($_GET['customer_mail'])  && !empty($_GET['customer_mail'])? $_GET['customer_mail'] : '';
      

        $id = wp_insert_post(array(
          'post_title'=>$item_name, 
          'post_type'=>'bookings', 
          'post_status'=>'publish'
        ));
        

        $data = array(
          'service_name' => $item_name, 
          'selected_date' => $service_date,
          'selected_time' => $selected_time,
          'gender' => $gender,
          'address' => $address,
          'name' => $customer_name,
          'email' => $customer_mail,
          'phone_no' => $phone_no,
          'paymnet_option' => 'paypal'
        ); 
        add_post_meta($id,'LRbooking_form_customer_data',$data);

        $insert = $wpdb->insert( 'wp_lr_payment_order_table', array(
          'transaction_id' => $transactionId, 
          'order_status' => $payment_status,
          'total_amount' => $amount, 
          'receiver_id' => $receiver_id,
          'shipping_charges' => $shipping, 
          'payer_email' => $customer_mail, 
          'verify_sign' => $verify_sign,
          'services_name' => $item_name,
          'services_id' => $id,
      
        ));
     
        $shortcodes = array(		
          "[transaction_id]", 
          "[user-name]", 
          "[user-email]", 
          "[phone_no]",
          "[services-name]" ,
          "[selected_date]",
          "[service-price]",
          "[shipping_charges]",
          "[address]",
          "[paymnet_option]"
        );
   
        $data = array(		
          $transactionId,
          $customer_name,
          $customer_mail,
          $phone_no,
          $item_name,
          $service_date,
          $amount,
          $shipping,
          $address,
          'paypal'
        );
        
       
        $paypal = get_option('paypal_service_Etemplate_setting_data');
       
       
        if($paypal['is_enable'] == "yes"){
          $subject =str_replace( $shortcodes, $data, $paypal['paypal_template_subject']);		
          $message = str_replace( $shortcodes, $data, $paypal['paypal_template_msg']);
          $to = $customer_mail;
          $headers = 'From: '. $customer_mail . "\r\n" .
            'Reply-To: ' . $customer_mail . "\r\n";
              
          $sent = wp_mail($to, $subject, strip_tags($message), $headers);
        } 
    }
    
?>  
<?php $url = site_url(); ?>
<div class=content style="text-align: center;">
  <div class="wrapper-1">
    <div class="wrapper-2">
      <h1><?php _e('Thank you !'); ?></h1>
      <i class="fa fa-check-circle fa-4x" style="color:green" aria-hidden="true"></i><br>
      <p><?php _e('Your service is confirm!!'); ?></p>
      <p><?php _e('you should receive a email soon about service'); ?>  </p>
      <table id="success_table">
          <tr>
          <th scope="col" colspan="2" style="background-color: aliceblue; border-radius: 23px;"><i class="fa fa-user" aria-hidden="true"></i><?php _e('Customer Details'); ?></th>
          </tr>

          <tr>
            <td><?php _e('Customer Name'); ?></td>
            <td><?php echo $customer_name; ?></td>
          </tr>

          <tr>
            <td><?php _e('Customer Email'); ?></td>
            <td><?php echo $customer_mail; ?></td>
          </tr>
            
          <tr>
            <td><?php _e('Customer Phone no'); ?> </td>
            <td><?php echo $phone_no; ?></td>
          </tr>

          <tr>
            <th scope="col" colspan="2" style="background-color: aliceblue; border-radius: 23px;"><i class="fa fa-file" aria-hidden="true"></i> <?php _e('Service Details'); ?></th>
          </tr>

         <tr>
           <td><?php _e('Service Name'); ?></td>
           <td><?php echo $item_name;?></td>
         </tr>

         <tr>
           <td><?php _e('Service Date'); ?></td>
           <td><i class="fa fa-calendar" aria-hidden="true"></i>
              <?php echo $service_date;?>
            </td>
         </tr>

         <tr>
           <td><?php _e('Service Time'); ?></td>
           <td><i class="fa fa-clock-o" aria-hidden="true"></i>
              <?php echo $selected_time;?>
            </td>
         </tr>

         <tr>
           <td><?php _e('Service Amount'); ?></td>
           <td><i class="fa fa-inr" aria-hidden="true"></i>
            <?php echo $amount; ?></td>
         </tr>
           
         <tr>
           <td><?php _e('Shipping Charges'); ?></td>
           <td><?php echo $shipping; ?></td>
         </tr>

         <tr>
           <td><?php _e('Transaction ID'); ?></td>
           <td><?php echo $transactionId; ?></td>
         </tr>

         <tr>
           <td><?php _e('Payment Status'); ?></td>
           <td><?php echo $payment_status; ?></td>
         </tr>
    </table><br>
      <a href=<?php echo $url; ?>>
          <button class="go-home">
         <?php _e('go home');?>
          </button>
      </a>
     
    </div>
    <div class="footer-like" >
      
    </div>
</div>
</div>
 <hr>

<?php  get_footer(); ?>
