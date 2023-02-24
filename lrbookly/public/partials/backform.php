<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>


<div class="container accordion--form">

  <!-- <form  method="post" name="booking_form" id="booking_form"> -->

    <h1>SERVICE BOOKING FORM</h1>

    <!-- SERVICES DETAILS -->
    <fieldset class="accordion--form__fieldset" id="fieldset-one">
      <legend class="accordion--form__legend accordion--form__legend-active"><i class="fa fa-wrench" aria-hidden="true"></i>
 Select Service</legend>

      <div class="accordion--form__wrapper accordion--form__wrapper-active">
      <input type="hidden" id="id" name="id" value="<?php echo get_the_ID();?>">     
        <div class="accordion--form__row">
          <label class="accordion--form__label" for="booking_services">Select Sevices <span style="color:red;">*</span></label> <br />
            
            <select class="accordion--form__text " name="booking_services" id="booking_services" >
            <option value="">Select Services</option>
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
          <label class="accordion--form__label" for="booking_date">Select Date <span style="color:red;">*</span></label> <br />
          <input class="accordion--form__text required" type="text" name="booking_date" id="booking_date" placeholder="Select Date" autocomplete="off" required >
          <label class="accordion--form__label" id="no_date" style="display:none;">Select Service First!</label> <br />     
        </div>
        <div class="accordion--form__row" id="booking_time" >
          <label class="accordion--form__label" for="booking_time">Select Time <span style="color:red;">*</span></label> <br />
          <label class="accordion--form__label" id="choose_date" for="booking_date">Choose a date above to see available times.</label> <br />
          <label class="accordion--form__label" id="no_slot" style="display:none;">Sorry! No Time slots are available.please select another date</label> <br />
          <div id="hide_class"  style="display:none;">
          </div>
        </div>
        

        <a class="accordion--form__next-btn slot_button">Next</a>
        <div class="accordion--form__invalid">Please ensure all required fields are filled in</div>

      </div>
    </fieldset>

    <!-- CUSTOMER DETAILS -->
    <fieldset class="accordion--form__fieldset" id="fieldset-two">
      <legend class="accordion--form__legend"><i class="fa fa-user" aria-hidden="true"></i> Customer Details</legend>

      <div class="accordion--form__wrapper ">
          
        <div class="accordion--form__row">
          <label class="accordion--form__label" for="name">Name *</label> <br />
          <input class="accordion--form__text required" type="text" name="customer_name" id="customer_name" placeholder="Name" required>
        </div>

        <div class="accordion--form__row">
          <label class="accordion--form__label" for="suname">Email *</label> <br />
          <input class="accordion--form__text required" type="email" name="email" id="email" placeholder="Email" required>
        </div>

        <div class="accordion--form__row">
          <label class="accordion--form__label" for="suname">Telephone no *</label> <br />
          <input class="accordion--form__text required" type="text" name="phone_no" id="phone_no" placeholder="Telephone no" required>
        </div>

        <div class="accordion--form__row">
          <label class="accordion--form__label" for="gender">Gender</label> <br />
          <input class="accordion--form__text" type="radio" name="gender" id="male" value="male" checked>   Male
          <input class="accordion--form__text" type="radio" name="gender" id="female" value="female"> Female
        </div>

        <div class="accordion--form__row">
          <label class="accordion--form__label" for="Comments">Address <span>*</span> </label> <br />
          <textarea class="accordion--form__textarea required" name="address" id="address" placeholder="Address" required></textarea>
        </div>

        <a class="accordion--form__prev-btn">Prev</a>
        <a class="accordion--form__next-btn" id="all_data_next">Next</a>

        <div class="accordion--form__invalid">Please ensure all required fields are filled in</div>

      </div>
    </fieldset>

    <!-- PAYMENT DETAILS -->
    <fieldset class="accordion--form__fieldset" id="fieldset-three">
      <legend class="accordion--form__legend"><i class="fa fa-credit-card" aria-hidden="true"></i> Payment</legend>

      <div class="accordion--form__wrapper">
        <div class="accordion--form__row">
          <label class="accordion--form__label" for="paymnet_option">Payment Option</label> <br />
          <div>
            <input class="accordion--form__text" type="radio" name="paymnet_option" id="cod_check" value="cash" checked> Case on  Delivery
            <input type="text" value="" name="cod_price" id="cod_price" readonly>
          </div>
              <?php
                $payment = get_option('service_paypal_setting_data');
                if($payment['paypal_option'] == 'enable'){
                   ?>
                    <div>
                      <input class="accordion--form__text" type="radio" name="paymnet_option" id="paypal_check" value="paypal" > Paypal </div>
                      <div class="paypal_payment" style="display:none;">
                          <p>Enter Payment Details:</p>
                          <input type="email" placeholder="Enter Email" value="" style="display:none;">
                          <div class="paypal_payment_btn">
                              <?php 
                                $payment = get_option('service_paypal_setting_data');
                                $merchantId = $payment['paypal_merchant_email'];
                              ?>
                              <form target=<?php echo"_blank";?>  action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post'>
                                <div class="payPalForm">
                                  <input type='hidden' name='cmd' value=<?php echo "_xclick";  ?> />
                                  <input type='hidden' name='business' value='sb-fpvg623935674@business.example.com' />         
                                  <input type='hidden' name='currency_code' value=<?php echo "USD";  ?> />
                                 
                                  <!-- serviceInfo -->
                                  <input type='hidden' name='amount' id="service_amt" value >
                                  <input type='hidden' name='item_name' id="item_name" value >
                                  <input type='hidden' name='paypal_time_slot' id="paypal_time_slot" value >
                                  <input type='hidden' name='paypal_service_date' id="paypal_service_date" value >

                                  <!-- customer -->
                                  <input type='hidden' name='name' id="paypal_customer_name" value> 
                                  <input type='hidden' name='email' id="paypal_email" value> 
                                  <input type='hidden' name='telephone_no' id="paypal_telephone_no" value> 
                                  <input type='hidden' name='gender' id="paypal_gender" value> 
                                  <input type='hidden' name='address' id="paypal_address" value> 
                                  <!--  -->

                                  <input type='hidden' name='lc' value=<?php echo "EN_US";  ?>>
                                  <input type='hidden' name='no_note' value=<?php echo "no_note";  ?>>
                                  <input type='hidden' name='paymentaction' value=<?php echo "sale";  ?>>
                                  <input type='hidden' name='return' value='http://localhost/wordpress/?page_id=2934'><input type='hidden' name='bn'>
                                  <input type='hidden' name='cancel_return' value=""/>
                                  <input style='border: none;' class='paypalbuttonimage' type='image' src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_SM.gif' border='0' name='submit' alt='Make your payments with PayPal. It is free, secure, effective.'>
                                  <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                              </form>  
                              </div>        
                          </div>
                      </div>
                     
              <?php } else{ ?>
                    <div style="display:none;">
                      <input class="accordion--form__text" type="radio" name="paymnet_option" id="paypal" value="paypal"  > PayPal </div>
              <?php }  ?>
          </div>       
        
        <div class="accordion--form__row">
          <input class="accordion--form__submit" id="Formsubmit" type="submit" name="submit" value="Submit">
        </div>
         
        <a class="accordion--form__prev-btn">Prev</a>

      </div>
    </fieldset>

  <!-- </form> -->

          
</div>

<script>

    //On click of the 'next' anchor
jQuery('.accordion--form__next-btn').on('click touchstart', function() {
    var parentWrapper = jQuery(this).parent().parent();
    var nextWrapper = jQuery(this).parent().parent().next('.accordion--form__fieldset');
    var sectionFields = jQuery(this).siblings().find('.required');
    //Validate the .required fields in this section
    var empty = jQuery(this).siblings().find('.required').filter(function() {
        return this.value === "";   
    });

    if (empty.length) {
            jQuery('.accordion--form__invalid').show();
    } else {
            jQuery('.accordion--form__invalid').hide();
            nextWrapper.find('.accordion--form__wrapper').addClass('accordion--form__wrapper-active');
            parentWrapper.find('.accordion--form__wrapper').removeClass('accordion--form__wrapper-active');
            nextWrapper.find('.accordion--form__legend').addClass('accordion--form__legend-active');
            parentWrapper.find('.accordion--form__legend').removeClass('accordion--form__legend-active');
    }
    return false;
});

//On click of the 'prev' anchor
jQuery('.accordion--form__prev-btn').on('click touchstart', function() {
        parentWrapper = jQuery(this).parent().parent();
        prevWrapper = jQuery(this).parent().parent().prev('.accordion--form__fieldset');
        prevWrapper.find('.accordion--form__wrapper').addClass('accordion--form__wrapper-active');
        parentWrapper.find('.accordion--form__wrapper').removeClass('accordion--form__wrapper-active');
        prevWrapper.find('.accordion--form__legend').addClass('accordion--form__legend-active');
        parentWrapper.find('.accordion--form__legend').removeClass('accordion--form__legend-active');
        return false;
});

//Select Service First:
jQuery('#booking_date').click(function() {
      var value = jQuery('#booking_services').val();
      if(value.length == 0){ 
        jQuery('#no_date').slideDown();
      }
});

//Payment:
jQuery('#paypal_check').on('click',function() {
  jQuery(".paypal_payment_btn").slideDown();
  // jQuery(".paypal_payment_btn").after('.paypal_payment');
  jQuery(".paypal_payment").slideDown();
  jQuery("#cod_price").css({'display':'none'});
});

jQuery('#cod_check').on('click',function() {
  jQuery("#cod_price").slideDown();
  jQuery(".paypal_payment").css({'display':'none'});
});


//Service Booking Dates
jQuery('#booking_services').on('change', function() {
  jQuery('#no_date').css({'display':'none'});
  jQuery("#booking_date").datepicker("destroy");

jQuery("#booking_date").val("");
    jQuery(".app-check").hide();
      var booking_services = jQuery(this).val();
      jQuery.ajax({
        type: "POST",
        dataType : "json",
        url : frontend_ajax_object.ajaxurl,
        data : { action: "service_booking_date", booking_services : booking_services},
        success:function(response){
            var global_disableDays = response.global_days;
            var gloabal_disableDates = response.global_date;
            var availableDates = response.avilable_date;
            
            availableDates = jQuery.grep(availableDates, function(value) {
              return value != gloabal_disableDates;
            });
            console.log(global_disableDays);
            if(availableDates){
              if(global_disableDays == null){
                date(availableDates)
              }else{ 
                date(availableDates,global_disableDays); 
              }
            }else{
              console.log('dates are not available');
            }
        }    
    });
});

//Service Time Slot
jQuery("#booking_date").on("change",function(){
  jQuery(".app-check").remove();
  jQuery('#no_slot').css({'display':'none'});
      var selected_date = jQuery(this).val();
      var service = jQuery('#booking_services').val();
        jQuery.ajax({
        type: "POST",
        dataType : "json",
        url : frontend_ajax_object.ajaxurl,
        data : { action: "service_booking_time_slot", selected_date : selected_date,service:service},
        success:function(response){
          
          // jQuery('#item_name').val(response.service_name);

          if(response.data == null){
            jQuery('#no_slot').slideDown();
            jQuery('#choose_date').css({'display':'none'});
          }
          var servicePrice = response.service_price;
          jQuery('#cod_price').val(servicePrice);
          jQuery('#service_amt').val(servicePrice);

          var booked = response.booked;
          var arr = response.data;

          if(response.availivility == booked.length){
            jQuery.each(arr , function(i, val) {
                jQuery('#hide_class').append(' <div class="app-check"><input type="radio" class="option-input radio required" name="time_sloat" id="time_sloat" value="'+val+'" disabled/><div class="app-border"><label class="app-label">'+val+'</label></div></div>');
            });
          }else{
              jQuery.each(arr , function(i, val) {
                if(booked.includes(val) == true){
                  jQuery('#hide_class').append(' <div class="app-check"><input type="radio" class="option-input radio required" name="time_sloat" id="time_sloat" value="'+val+'" disabled/><div class="app-border"><label class="app-label">'+val+'</label></div></div>');
                }else{
                  jQuery('#hide_class').append(' <div class="app-check"><input type="radio" class="option-input radio required" name="time_sloat" id="time_sloat" value="'+val+'"/><div class="app-border"><label class="app-label">'+val+'</label></div></div>');
                }
            });
          }
          jQuery('#hide_class').css({'display':'block','margin-top': '-50px'});
          jQuery('#choose_date').css({'display':'none'}); 
          var availableDates = response.avilable_date;
          date(availableDates); 
        }    
    });
});

// jQuery(".slot_button").click(function(){
//   var sloatValue = jQuery("input[name='time_sloat']:checked").val();
//     if(sloatValue){
//       jQuery.ajax({
//           type: "POST",
//           dataType : "json",
//           url : frontend_ajax_object.ajaxurl,
//           data : { action: "check_time_slot", sloatValue : sloatValue},
//           success:function(response){
//               console.log(response.data);
//               var val = response.data;
//               var check = response.value;
//              if(jQuery.inArray(val, check)){
//                 alert('disabled');
//                 jQuery("#hide_class").prop('disabled', true);
//              }
//           }
//         });    
//     }
// });

function date(availableDates,disable_days){
  jQuery('#booking_date').datepicker({
      dateFormat: 'd-m-yy',
      beforeShowDay:function(date){
      datepicker_date = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();   
      if (jQuery.inArray(datepicker_date, availableDates) != -1 && jQuery.inArray(date.getDay(),disable_days) == -1 ) {
        return [true, "","Available"];
      } else {
        return [false,"","unAvailable"];
      }
    }
  });
}

jQuery(document).ready(function(e){
  jQuery("#all_data_next").on('click', function(e){
            var service_name =  jQuery("#booking_services").val();
            var selected_date =  jQuery("#booking_date").val();
            var selected_time =  jQuery('input[name="time_sloat"]:checked').val();
            var gender =  jQuery('input[name="gender"]:checked').val();
            var address =  jQuery("#address").val();
            var name =  jQuery("#customer_name").val();
            var email =  jQuery("#email").val();
            var phone_no =  jQuery("#phone_no").val();

            jQuery('#item_name').val(service_name)
            jQuery('#paypal_service_date').val(selected_date)
            jQuery('#paypal_time_slot').val(selected_time) 
            jQuery('#paypal_gender').val(gender) 
            jQuery('#paypal_address').val(address) 
            jQuery('#paypal_customer_name').val(name)
            jQuery('#paypal_email').val(email) 
            jQuery('#paypal_telephone_no').val(phone_no);

            jQuery(".payPalForm").append("<input type='hidden' name='phone' value='"+phone_no+"'>");

  });
});  


jQuery(document).ready(function(e){
  jQuery("#Formsubmit").on('click', function(e){
        e.preventDefault();
        var formData = {
            id: jQuery("#id").val(),
            service_name: jQuery("#booking_services").val(),
            selected_date: jQuery("#booking_date").val(),
            selected_time: jQuery('input[name="time_sloat"]:checked').val(),
            gender: jQuery('input[name="gender"]:checked').val(),
            address: jQuery("#address").val(),
            name: jQuery("#customer_name").val(),
            email: jQuery("#email").val(),
            phone_no: jQuery("#phone_no").val(),
            paymnet_option: jQuery('input[name="paymnet_option"]:checked').val(),
        };
        console.log(formData);
        jQuery.ajax({
            type: "POST",
            dataType : "json",
            url : frontend_ajax_object.ajaxurl,
            data : { action: "service_booking_form_data", formData : formData},
            success:function(response){
            //   swal(
            //     'Service Booked',
            //     'Congratulations Your service is successfully booked!',
            //     'success'
            //   )
            //   setTimeout(function() {
            //       location.reload();
            //   }, 5000);
            }
        });
      });
  });       
</script>