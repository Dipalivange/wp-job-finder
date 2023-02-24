<div class="container accordion--form">
  <!-- <form  method="post" name="booking_form" id="booking_form"> -->
    <h1><?php _e('SERVICE BOOKING FORM'); ?></h1>
    <!-- SERVICES DETAILS -->
    <fieldset class="accordion--form__fieldset" id="fieldset-one">
      <legend class="accordion--form__legend accordion--form__legend-active"><i class="fa fa-wrench" aria-hidden="true"></i>
      <?php _e('Select Service'); ?></legend>
     
      <?php $ajax_nonce = wp_create_nonce( "my-special-string" );?>
      <div class="accordion--form__wrapper accordion--form__wrapper-active">
        <input type="hidden" id="id" name="id" value="<?php echo get_the_ID();?>">     
        <div class="accordion--form__row">
          <label class="accordion--form__label" for="booking_services"><?php _e('Select Sevices');?> <span style="color:red;">*</span></label> <br />
           
            <select class="accordion--form__text " name="booking_services" id="booking_services" >
            <option value=""><?php _e('Select Services');?></option>
            <?php
                $args = array(
                    'post_type' => 'services',
                );
                $loop = new WP_Query($args);
                while($loop->have_posts()): $loop->the_post();  ?>
                     <option value="<?php the_title(); ?>"><?php the_title();?></option>
               <?php endwhile;
                wp_reset_query();
            ?>
            </select>
        </div>

        <div class="accordion--form__row">
          <label class="accordion--form__label" for="booking_date"><?php _e('Select Date');?> <span style="color:red;">*</span></label> <br />
          <input class="accordion--form__text required" type="text" name="booking_date" id="booking_date" placeholder="Select Date" autocomplete="off" required >
          <label class="accordion--form__label" id="no_date" style="display:none;"><?php _e('Select Service First!');?></label> <br />     
        </div>

        <div class="accordion--form__row" id="booking_time" >
          <label class="accordion--form__label" for="booking_time"><?php _e('Select Time');?> <span style="color:red;">*</span></label> <br /> <br />
          <label class="accordion--form__label" id="choose_date" for="booking_date"><?php _e('Choose a date above to see available times.');?></label> <br />
          <!-- <label class="accordion--form__label" id="no_slot" style="display:none;">Sorry! No Time slots are available.please select another date');?></label> <br /> -->
          <div id="hide_class"  style="display:none;">
          </div>
        </div>

        <div class="accordion--form__row service_price_class" style="display:none;">
          <label class="accordion--form__label" for="name"><?php _e('Price');?> *</label> <br />
          <input class="accordion--form__text " value="" type="text" name="service_price" id="service_price" placeholder="Service Price" readonly >
        </div>
       
        <!-- <div class="accordion--form__next-btn ">
      
         
        </div> -->
        
         <!-- CUSTOM TOOLTIP START-->         
         <button class="accordion--form__next-btn tooltip_wrapper disabled_button_noslot" style="display:none;"  disabled><?php _e('Next');?>
          <div class="tooltip">Sorry! No Time slots are available.please select another date</div></button>
          <!-- CUSTOM TOOLTIP END-->       

        <!-- CUSTOM TOOLTIP START-->         
          <button class="accordion--form__next-btn tooltip_wrapper disabled_button" style="display:none;" disabled><?php _e('Next');?>
          <div class="tooltip">All booking slots are booked..<br>please selected another dates.</div></button>
          <!-- CUSTOM TOOLTIP END-->
          <a class="accordion--form__next-btn  slot_button"><?php _e('Next');?></a>
        <div class="accordion--form__invalid"><?php _e('Please ensure all required fields are filled in');?></div>

      </div>
    </fieldset>

    <!-- CUSTOMER DETAILS -->
    <fieldset class="accordion--form__fieldset" id="fieldset-two">
      <legend class="accordion--form__legend"><i class="fa fa-user" aria-hidden="true"></i> <?php _e('Customer Details');?></legend>

      <div class="accordion--form__wrapper ">
          
        <div class="accordion--form__row">
          <label class="accordion--form__label" for="name"><?php _e('Name');?> *</label> <br />
          <input class="accordion--form__text required" type="text" name="customer_name" id="customer_name" placeholder="Name" required>
        </div>

        <div class="accordion--form__row">
          <label class="accordion--form__label" for="suname"><?php _e('Email');?> *</label> <br />
          <input class="accordion--form__text required" type="email" name="email" id="email" placeholder="Email" required>
          <div class="email_alert" style="display:none"></div>
        </div>

        <div class="accordion--form__row">
          <label class="accordion--form__label" for="suname"><?php _e('Telephone nos');?>  *</label> <br />
          <input class="accordion--form__text required" type="text" name="phone_no" id="phone_no" placeholder="Telephone no" required>
        </div>

        <div class="accordion--form__row">
          <label class="accordion--form__label" for="gender"><?php _e('Gender'); ?></label> <br />
          <input class="accordion--form__text" type="radio" name="gender" id="male" value="male" checked> <?php _e('Male');?>
          <input class="accordion--form__text" type="radio" name="gender" id="female" value="female"> <?php _e('Female'); ?>
        </div>

        <div class="accordion--form__row">
          <label class="accordion--form__label" for="Comments"><?php _e('Address');?> <span>*</span> </label> <br />
          <textarea class="accordion--form__textarea required" name="address" id="address" placeholder="Address" required></textarea>
        </div>

        <a class="accordion--form__prev-btn"><?php _e('Prev');?></a>
        <a class="accordion--form__next-btn" id="all_data_next"><?php _e('Next');?></a>

        <div class="accordion--form__invalid"><?php _e('ure all required fields are filled in');?></div>
                
      </div>
    </fieldset>

    <!-- PAYMENT DETAILS -->
    <fieldset class="accordion--form__fieldset" id="fieldset-three">
      <legend class="accordion--form__legend"><i class="fa fa-credit-card" aria-hidden="true"></i> <?php _e('Payment');?></legend>

      <div class="accordion--form__wrapper">
        <div class="accordion--form__row">
          <label class="accordion--form__label" for="paymnet_option">
           <strong> <?php _e(' Please tell us how you would like to pay:'); ?> </strong> </label> <br />
          <div class="codInfo" style="font-size:15px;">
            <input class="accordion--form__text" type="radio" name="paymnet_option" id="cod_check" value="cash" checked>
            <?php _e(' I will pay cash on delivery');?>
            <input class="accordion--form__text" type="text" value="" name="cod_price" id="cod_price" width="15px;" readonly>
          </div>
              <?php
                $payment = get_option('service_paypal_setting_data');
                if($payment['paypal_option'] == 'enable'){
                   ?>
                    <div class="paypalInfo" >
                      <input class="accordion--form__text" type="radio" name="paymnet_option" id="paypal_check" value="paypal" ><span> <?php _e('I will pay now with PayPal ');?>  </span>
                      <img src="http://localhost/wordpress/wp-content/uploads/2023/01/paypal.png" alt="PayPal"> 
                    </div>
                      <div class="paypal_payment" style="display:none;">
                          <input type="email" class="check_mail" id="email" placeholder="Enter Email" value="" style="display:none;">
                          <div class="paypal_payment_btn">
                              <?php 
                                $is_sanbox_enable = $payment['paypal_mode'];
                                $merchantId = $payment['paypal_merchant_email'];
                              ?>
                              <form target=<?php echo"_blank";?>  action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post'>
                                <div class="payPalForm">
                                  <input type='hidden' name='cmd' value=<?php echo "_xclick";  ?> />
                                  <input type='hidden' name='business' value=<?php echo $merchantId; ?> />         
                                  <input type='hidden' name='currency_code' value=<?php echo "USD";  ?> />
                                  <input type='hidden' name='amount' id="service_amt" value >
                                  <input type='hidden' name='item_name' id="item_name" value >
                                  <input type='hidden' name='lc' value=<?php echo "EN_US";  ?>>
                                  <input type='hidden' name='no_note' value=<?php echo "no_note";  ?>>
                                  <input type='hidden' name='paymentaction' value=<?php echo "sale";  ?>>
                                  <input type='hidden' id="paypal_url" name='return' value>
                                  <input type='hidden' name='bn'> 
                                  <input type='hidden' name='cancel_return' value=""/>
                                  <input class="accordion--form__submit paypalbuttonimage" id="paypalbutton" type="submit" name="submit" value="Pay with Palpal">
                                  <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                              </form>  
                              </div>        
                          </div>
                      </div>
                     
              <?php } else{ ?>
                    <div style="display:none;">
                      <input class="accordion--form__text" type="radio" name="paymnet_option" id="paypal" value="paypal"  > <?_e('PayPal'); ?> </div>
              <?php }  ?>
          </div>   
        <!-- <div class="accordion--form__row"> -->
          <!-- <input class="accordion--form__next-btn" id="Formsubmit" type="submit" name="submit" value="Submit"> -->
          <!-- <a class="accordion--form__next-btn" id="Formsubmit" ></a> -->
        <!-- </div> -->
        <a class="accordion--form__prev-btn">Prev</a>
        <a class="accordion--form__next-btn" id="Formsubmit">Next</a>        

      </div>
    </fieldset>
  <!-- </form> -->

    <fieldset class="accordion--form__fieldset" id="fieldset-four">
        <legend class="accordion--form__legend"><i class="fa fa-check-circle" aria-hidden="true"></i> Done</legend>
        <div class="accordion--form__wrapper">
          <div class="accordion--form__row">
            <p class="service_done_section">
              <?php _e('Thank you! Your booking is complete. An email with details of your booking has been sent to you soon.');?>
            </p>
          </div>
          <input class="accordion--form__submit start_over" type="submit" name="start_over" value="START OVER">
        </div>
    </fieldset>         
</div>



<style>
    #set div { width: 90px; height: 90px; padding: 0.5em; float: left; margin: 0 10px 10px 0; background: black;}
  #set { clear:both; float:left; width: 368px;}
  p { clear:both; margin:0; padding:1em 0; }
</style>
<div id="set">
     <div data-table="1" style="left:20px; top:20px" data-left="20px" data-top="20px" ></div>
     <div data-table="2" style="left:20px; top:20px"></div>
     <div data-table="3" style="left:20px; top:20px"></div>
     <div data-table="4" style="left:20px; top:20px"></div>
     <div data-table="5" style="left:20px; top:20px"></div>
</div>
<script>
  jQuery(function() {
  jQuery( "#set div" ).draggable({ 
    
    stack: "#set div",
      stop: function(event, ui) {
          var pos_x = ui.offset.left;
          var pos_y = ui.offset.top;
          var table = ui.helper.data("table");
         
          console.log(pos_x);
          console.log(pos_y);
          console.log(table);

          jQuery.ajax({
					type: "POST",
					dataType : "json",
					url : lrbookly_ajax_object.ajaxurl,
          data: { action: "save_with_position", pos_x: pos_x, pos_y: pos_y, table_no: table},
            
          success:function(response){
              console.log(response);
              var table_no = response.data.table_no;
              var x = response.data.x;
              var y = response.data.y;
              // jQuery('#set [data-table=' + table_no + ']' ).addClass("selected");
              // jQuery('.selected').css( { left: x+'px', top: y+'px' } );
            }
          });

       }
  });
});

</script>