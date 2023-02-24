<!-- <table id="service_table"  class="form-table" >
    <tbody>
        <tr class="user-user-login-wrap">
            <th><b><label for="date">Select Date</label></b></th>
            <th><b><label for="time">Select Time</label></b></th> 
            <th><b><label for="date">Price</label></b></th>
        </tr>
        <tr> 
            <td>
                <input type="text" class="regular-text" name="service_date" id="service_date" value=""> 
            </td>
            <td>
                <select name="service_time" id="service_time">
                    <option value="">Select Time</option>
                    <option value="">15 min</option>
                    <option value="">30 min</option>
                    <option value="">45 min</option>
                    <option value="">1 hour</option>
                </select>
            </td>            
            <td>
                <input type="number" class="regular-text" name="service_price" id="service_price" value="">
            </td> 
            <td><button>+</button></td>  
        </tr>
    </tbody>       
</table>
<script>
    jQuery(function() {
        jQuery( "#service_date" ).datepicker();
    });


</script>     -->
<script type="text/javascript">		
		jQuery(document).ready(function($){
			jQuery(document).on('click', '.wc-remove-item', function() {
				jQuery(this).parents('tr.wc-sub-row').remove();
			}); 				
			jQuery(document).on('click', '.wc-add-item', function() {
				var row_no = jQuery('.wc-item-table tr.wc-sub-row').length;    
				var p_this = jQuery(this);
				row_no = parseFloat(row_no);
				var row_html = jQuery('.wc-item-table .wc-hide-tr').html().replace(/rand_no/g, row_no).replace(/hide_services_repeater_item/g, 'services_repeater_item');
                //alert(row_html);
				jQuery('.wc-item-table tbody').append('<tr class="wc-sub-row">' + row_html + '</div>');    
			});
		});

        // jQuery(function() {
        //     jQuery(".service_date").datepicker();
        // });
	</script>
   
	<table class="wc-item-table" width="100%">
		<tbody>
            <tr>
                <td><label for="date">Select Date</label></td>
                <td><label for="time">Select Time</label></td> 
                <td><label for="date">Price</label></td>
            </tr>
			<?php 
            $i = 0;
            $id = get_the_ID();
             //echo "<pre>";   
             $services_repeater_item = get_post_meta($id,'services_repeater_item');
            //  echo "<pre>";
            //  print_r($services_repeater_item);
           // exit;
			if( $services_repeater_item ){

				$keys = array_keys($services_repeater_item);
                for($i = 0; $i < count($services_repeater_item); $i++) {
                   
                    foreach($services_repeater_item[$keys[$i]] as $key => $value) {
                        
                        ?>
                       
                        <tr class="wc-sub-row">				
                            <td>
                            <input type="date" class="service_date" name="services_repeater_item[<?php echo $key; ?>][service_date]" id="service_date" value="<?php echo (isset($value['service_date'])) ? $value['service_date'] : ''; ?>"> 	
                            </td>
                            <td>
                            <select name="services_repeater_item[<?php echo $key; ?>][service_time]" id="service_time">
                            <option value="">Select Time</option>
                            
                            
                            
                            <?php $selected = (isset( $value['service_time'] ) && $value['service_time'] === '15 min') ? 'selected' : '' ; ?>
		                    <option value="15 min" <?php echo $selected; ?>><?php _e('15 min');?></option>

                            <?php $selected = (isset( $value['service_time'] ) && $value['service_time'] === '30 min') ? 'selected' : '' ; ?>
		                    <option value="30 min" <?php echo $selected; ?>><?php _e('30 min');?></option>

                            <?php $selected = (isset( $value['service_time'] ) && $value['service_time'] === '45 min') ? 'selected' : '' ; ?>
		                    <option value="45 min" <?php echo $selected; ?>><?php _e('45 min');?></option>

                            <?php $selected = (isset( $value['service_time'] ) && $value['service_time'] === '1 hour') ? 'selected' : '' ; ?>
		                    <option value="1 hour" <?php echo $selected; ?>><?php _e('1 hour');?></option>
                            
                            
                            </select>
                            </td>
                            <td>
                                <input type="number" class="regular-text" name="services_repeater_item[<?php echo $key; ?>][service_price]" id="service_price" value="<?php echo (isset($value['service_price'])) ? $value['service_price'] : ''; ?>">
                            </td>
                            <td>
                                <button class="wc-remove-item button" type="button">Remove</button>
                            </td>
                        </tr>
                        <?php
                    }
                   
                }
                   
                  
					
				}
			//}
			?>			
			<tr class="wc-hide-tr" style="display: none;">				
				<td>
                    <input type="date" class="service_date" name="hide_services_repeater_item[rand_no][service_date]" id="service_date" value=""> 	
				</td>
				<td>
                    <select name="hide_services_repeater_item[rand_no][service_time]" id="service_time">
                        <option value="">Select Time</option>
                        <option value="<?php _e("15 min");?>">15 min</option>
                        <option value="<?php _e("30 min");?>">30 min</option>
                        <option value="<?php _e("45 min");?>">45 min</option>
                        <option value="<?php _e("1 hour");?>">1 hour</option>
                    </select>
				</td>
                <td>
                    <input type="number" class="regular-text" name="hide_services_repeater_item[rand_no][service_price]" id="service_price" value="">
                </td>
				<td>
					<button class="wc-remove-item button" type="button">Remove</button>
				</td>
               
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4"><button class="wc-add-item button" type="button">Add another</button></td>
               
			</tr>
		</tfoot>
	</table>	
	<?php


///old weekdays code
<form method="post" action="options.php">
    <?php settings_fields( 'global_weekdays_setting' ); ?>
    <?php do_settings_sections( 'global_weekdays_setting' ); ?>
    <h4><?php _e('Disable Days for Services', 'lrbookly' );?></h4>
    <hr>
    <table class="setting-table" width="30%" height="60px"  >
        <tbody>
            <tr>
                <td>Sunday</td>
                <td><label class="switch"><input type="checkbox" name="lrbookly_service_sunday" id="lrbookly_service_sunday" value="on"  <?php echo get_option('lrbookly_service_sunday') && get_option('lrbookly_service_sunday') ? "checked" : '';?>>
                
                        <span class="slider_toggle round"></span>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Monday</td>
                <td><label class="switch"><input type="checkbox" name="lrbookly_service_monday"  id="lrbookly_service_monday" value="on"  <?php echo get_option('lrbookly_service_sunday') && get_option('lrbookly_service_sunday') ? "checked" : '';?>>
                        <span class="slider_toggle round"></span>
                    </label>
                </td>
            </tr>

            <tr>
                <td>Tuesday</td>
                <td><label class="switch"><input type="checkbox" name="lrbookly_service_tuesday"  id="lrbookly_service_tuesday" value="on"  <?php echo get_option('lrbookly_service_tuesday') && get_option('lrbookly_service_tuesday') ? "checked" : '';?>>
                        <span class="slider_toggle round"></span>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Wednesday</td>
                <td><label class="switch"><input type="checkbox" name="lrbookly_service_wednesday"  id="lrbookly_service_wednesday" value="on"  <?php echo get_option('lrbookly_service_wednesday') && get_option('lrbookly_service_wednesday') ? "checked" : '';?>>
                        <span class="slider_toggle round"></span>
                    </label>
                </td>
            </tr>

            <tr>
                <td>Thursday</td>
                <td><label class="switch"><input type="checkbox" name="lrbookly_service_thursday"  id="lrbookly_service_thursday" value="on"  <?php echo get_option('lrbookly_service_thursday') && get_option('lrbookly_service_thursday') ? "checked" : '';?>>
                        <span class="slider_toggle round"></span>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Friday</td>
                <td><label class="switch"><input type="checkbox" name="lrbookly_service_friday" id="friday" value="on"  <?php echo get_option('lrbookly_service_friday') && get_option('lrbookly_service_friday') ? "checked" : '';?>>
                        <span class="slider_toggle round"></span>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Saturday</td>
                <td><label class="switch"><input type="checkbox" name="lrbookly_service_saturday" id="saturday" value="on"  <?php echo get_option('lrbookly_service_saturday') && get_option('lrbookly_service_saturday') ? "checked" : '';?>>
                        <span class="slider_toggle round"></span>
                    </label>
                </td>
            </tr>
            
        </tbody>

    </table>
    <?php submit_button(); ?>
</from>    





<script>
    jQuery(document).ready(function($) {
        jQuery('.toggleswitch').toggleSwitch();
        jQuery("#opt2").trigger("click"); // turn it on
    });
    </script>
   //
   <hr>
<form method="post" action="options.php">
    <?php
        settings_fields( 'global_dates_setting' );
        do_settings_sections( 'global_dates_setting' ); 
    ?>
    <table class="setting-table" width="30%" height="60px"  >
        <tbody>
            <tr>
                <td><?php _e('From Date'); ?> </td>
                <td>
                    <input type="text" name="lrbookly_global_service_date[from_date]" id="from_date" value="<?php echo isset($global_dates['from_date']) &&  $global_dates['from_date'] ? $global_dates['from_date']: '' ?>">
                </td>
            </tr>

            <tr>
                <td><?php _e('To Date'); ?> </td>
                <td>
                    <input type="text" name="lrbookly_global_service_date[to_date]" id="to_date" value="<?php echo isset($global_dates['to_date']) &&  $global_dates['to_date'] ? $global_dates['to_date']: '' ?>">
                </td>
            </tr>
        </tbody>
    </table>
    <?php submit_button(); ?>
</form>


<script>
    jQuery(document).ready(function(){
        $( "#from_date" ).datepicker({
            dateFormat: 'dd/mm/y',//check change
            changeMonth: true,
            changeYear: true,
            minDate: 0,
            onSelect: function(date) {
                $("#to_date").datepicker('option', 'minDate', date);
            }
        });
        $( "#to_date" ).datepicker({
            dateFormat: 'dd/mm/y',//check change
            changeMonth: true,
            changeYear: true
        });
    });
    </script>
    <select id="interval_time" name="booking_avaibility[interval_time]" style="width: 20%;">
            <option value="">Select Time</option>
            <?php $selected = (isset( $interval[0] ) && $interval[0] === '15 min') ? 'selected' : '' ; ?>
            <option value="15 min" <?php echo $selected; ?>><?php _e('15 min');?></option>

            <?php $selected = (isset( $interval[0] ) && $interval[0] === '30 min') ? 'selected' : '' ; ?>
            <option value="30 min" <?php echo $selected; ?>><?php _e('30 min');?></option>

            <?php $selected = (isset( $interval[0] ) && $interval[0] === '45 min') ? 'selected' : '' ; ?>
            <option value="45 min" <?php echo $selected; ?>><?php _e('45 min');?></option>

            <?php $selected = (isset( $interval[0] ) && $interval[0] === '1 hour') ? 'selected' : '' ; ?>
            <option value="1 hour" <?php echo $selected; ?>><?php _e('1 hour');?></option>
    </select> 

    function setEndTime() {
        alert('hello');
        var meetingLength = jQuery("#interval_time option:selected").text();  
        var selectedTime = jQuery('.from_time').timepicker('getTime'); 
        if (selectedTime == null || selectedTime == "") {
        alert("Please select the time first.");
        } else {
    alert(selectedTime);
        selectedTime.setMinutes(selectedTime.getMinutes() + parseInt(meetingLength, 10), 0);
        jQuery('.from_time').timepicker('setTime', selectedTime);
        } 
    }

    jQuery('.from_time').timepicker({
        // 'timeFormat': 'h:i a',
        'minTime': '12:00 AM',
        'maxTime': '12:00 PM',
    //'step': 30
    }).on(function() {
        setEndTime();
    });

    

    jQuery('#interval_time').bind('change', function() {
        jQuery('.from_time').timepicker('remove');
        jQuery('.from_time').timepicker({
        //   'timeFormat': 'h:i a',
        'minTime': '12:00 AM',
        'maxTime': '12:00 PM',
        //'step': jQuery('#interval_time').val()
        });
        setEndTime();
    });
    <input type="text" id="from_time" class="from_timepicker from_time" name="booking_avaibility[from_time][<?php echo $i;?>]" value="<?php echo isset($data[$days[$i]]['from_time']) ? $data[$days[$i]]['from_time']:''; ?>" >

    //selec field
    <div>    
    <label style="font-size:15px; font-weight:500;">Set Interval Time</label>
    <select id="interval_time">
    <?php $selected = (isset( $interval[0] ) && $interval[0] === '15 min') ? 'selected' : '' ; ?>
        <option value="15 min" <?php echo $selected; ?>><?php _e('15 min');?></option>

        <?php $selected = (isset( $interval[0] ) && $interval[0] === '30 min') ? 'selected' : '' ; ?>
        <option value="30 min" <?php echo $selected; ?>><?php _e('30 min');?></option>

        <?php $selected = (isset( $interval[0] ) && $interval[0] === '45 min') ? 'selected' : '' ; ?>
        <option value="45 min" <?php echo $selected; ?>><?php _e('45 min');?></option>

        <?php $selected = (isset( $interval[0] ) && $interval[0] === '60 min') ? 'selected' : '' ; ?>
        <option value="60 min" <?php echo $selected; ?>><?php _e('60 min');?></option>
    </select> 
   
</div> 
//old js
 // $(document).ready(function(){

    //     $('#interval_time').on('change', function() {
    //         var Hello = "HELLEOOE";
    //         if ( $('#interval_time').val() == 'stack' ) stack(Hello);
    //         else if ( $('#host').val() == 'exchange' ) exchange();
    //         else if ( $('#host').val() == 'something' ) something();
    //         });

    //         function stack(test)
    //         {	  alert(test);
    //             alert('Called function stack');
    //         }
    //         function exchange()
    //         {
    //             alert('Called function exchange');
    //         }
    //         function something()
    //         {
    //             alert('Called function something');
    //         }
    // });  
        
        
    jQuery(document).ready (function () {  
        // jQuery("select#interval_time").change (function () {  
        //     var Hello = $(this).children("option:selected").val();
        //     if ( $('select#interval_time').val()) 
        //     stack(Hello);
    
        // });
        // function stack(test,selector)
        // {	  
        //     alert(test);
        //     var select = $(selector);
        //     var hours, minutes, ampm;
        //     for(var i = 420; i <= 1320; i += 15){
        //         hours = Math.floor(i / 60);
        //         minutes = i % 60;
        //         if (minutes < 10){
        //             minutes = '0' + minutes; // adding leading zero
        //         }
        //         ampm = hours % 24 < 12 ? 'AM' : 'PM';
        //         hours = hours % 12;
        //         if (hours === 0){
        //             hours = 12;
        //         }
        //         select.append($('<option></option>')
        //             .attr('value', i)
        //             .text(hours + ':' + minutes + ' ' + ampm)); 
        //     }
        // } 
       
    }); 
  
// function populate(selector,sel)
// {
//     var fromValue = "";  
//     jQuery("select#interval_time").change (function () {  
//         var selectedtime = $(this).children("option:selected").val();
//        // console.log(selectedtime);  
//         var fromValue = selectedtime
//     }); 
//     console.log(fromValue);
//     var select = jQuery(selector);
//     var hours, minutes, ampm;
//     for(var i = 420; i <= 1320; i += 30){
//         hours = Math.floor(i / 60);
//         minutes = i % 60;
//         if (minutes < 10){
//             minutes = '0' + minutes; // adding leading zero
//         }
//         ampm = hours % 24 < 12 ? 'AM' : 'PM';
//         hours = hours % 12;
//         if (hours === 0){
//             hours = 12;
//         }
//         select.append(jQuery('<option></option>')
//             .attr('value', i)
//             .text(hours + ':' + minutes + ' ' + ampm)); 
//     }
// }
   
 

// function to_time_populate(selector) {
//     var minLength = jQuery("#interval_time option:selected").text();  
//     var defualt_to_time = minLength.replace('min', '');
//     var time = 60;
//     // alert(time);
//     var select = jQuery(selector);
//     var hours, minutes, ampm;
//     for(var i = 420; i <= 1320; i += time){
//         hours = Math.floor(i / 60);
//         minutes = i % 60;
//         if (minutes < 10){
//             minutes = '0' + minutes; // adding leading zero
//         }
//         ampm = hours % 24 < 12 ? 'AM' : 'PM';
//         hours = hours % 12;
//         if (hours === 0){
//             hours = 12;
//         }
//         select.append(jQuery('<option></option>')
//             .attr('value', i)
//             .text(hours + ':' + minutes + ' ' + ampm)); 
//     }
// }

// to_time_populate('.to_time'); 

// $(document).ready(function(){ 
//     $('#interval_time').click(function(){ 
//         minLength = $('#interval_time :selected').text();
//         var to_time = minLength.replace('min', '');
//        // alert(to_time);
//         to_time_populate(to_time);
//     });
// });

//   jQuery(document).ready(function(){
//         jQuery('.to_time').timepicker({ 
//             interval: 60,
//         });
//         jQuery('.from_time').timepicker({ interval: 60,});


//         jQuery('.from_time')
//         .timepicker('option', 'change', function(time) {
//             var later = new Date(time.getTime() + ( 60 * 60 * 1000 ));
//            jQuery(this).closest('tr').find('.to_time').timepicker('option', 'minTime', time);
//            jQuery(this).closest('tr').find('.to_time').timepicker('setTime', later);
//         });

// jQuery(function() {
//     jQuery('input.from_timepicker').timepicker();
//     jQuery(".from_time").text(jQuery(".from_timepicker").val())

// });
// jQuery(function() {
//     jQuery('input.to_timepicker').timepicker();
//     jQuery("#to_time").text(jQuery("#to_timepicker").val())

// });
// use selector for your select   




// });

// booking form js start
// //On click of the 'next' anchor
// jQuery('.accordion--form__next-btn').on('click touchstart', function() {
//     var parentWrapper = jQuery(this).parent().parent();
    
//     var nextWrapper = jQuery(this).parent().parent().next('.accordion--form__fieldset');
//     var sectionFields = jQuery(this).siblings().find('.required');
   
//     //Validate the .required fields in this section
//     var empty = jQuery(this).siblings().find('.required').filter(function() {
//         return this.value === "";  
//     });   

//     if (empty.length) {
//             jQuery('.accordion--form__invalid').show();
//     } else {
//             jQuery('.accordion--form__invalid').hide();
//             nextWrapper.find('.accordion--form__wrapper').addClass('accordion--form__wrapper-active');
//             parentWrapper.find('.accordion--form__wrapper').removeClass('accordion--form__wrapper-active');
//             nextWrapper.find('.accordion--form__legend').addClass('accordion--form__legend-active');
//             parentWrapper.find('.accordion--form__legend').removeClass('accordion--form__legend-active');
//     }
//     return false;
// });

// jQuery('.slot_button').click(function(){
//     var isChecked = jQuery('#time_sloat').is(':checked');
//     if(isChecked == 'false'){
//       jQuery('.accordion--form__invalid').show();
//       return false;
//     }
// });

// //On click of the 'prev' anchor
// jQuery('.accordion--form__prev-btn').on('click touchstart', function() {
//         parentWrapper = jQuery(this).parent().parent();
//         prevWrapper = jQuery(this).parent().parent().prev('.accordion--form__fieldset');
//         prevWrapper.find('.accordion--form__wrapper').addClass('accordion--form__wrapper-active');
//         parentWrapper.find('.accordion--form__wrapper').removeClass('accordion--form__wrapper-active');
//         prevWrapper.find('.accordion--form__legend').addClass('accordion--form__legend-active');
//         parentWrapper.find('.accordion--form__legend').removeClass('accordion--form__legend-active');
//         return false;
// });

// //Select Service First:
// jQuery('#booking_date').click(function() {
//       var value = jQuery('#booking_services').val();
//       if(value.length == 0){ 
//         jQuery('#no_date').slideDown();
//       }
// });

// //Payment:
// jQuery('#paypal_check').on('click',function() {
//   jQuery(".paypal_payment_btn").slideDown();
//   jQuery(".paypal_payment").slideDown();
//   jQuery("#cod_price").css({'display':'none'});
//   jQuery("#Formsubmit").css({'display':'none'});
// });

// jQuery('#cod_check').on('click',function() {
//   jQuery("#cod_price").slideDown();
//   jQuery(".paypal_payment").css({'display':'none'});
// });

// //Service Booking Dates
// jQuery('#booking_services').on('change', function() {
//   jQuery('#no_date').css({'display':'none'});
//   jQuery("#booking_date").datepicker("destroy");

// jQuery("#booking_date").val("");
//     jQuery(".app-check").hide();
//       var booking_services = jQuery(this).val();
//       jQuery.ajax({
//         type: "POST",
//         dataType : "json",
//         url : frontend_ajax_object.ajaxurl,
//         data : { 
//           action: "service_booking_date", 
//           booking_services : booking_services
//         },
//         success:function(response){
//             var global_disableDays = response.global_days;
//             var gloabal_disableDates = response.global_date;
//             var availableDates = response.avilable_date;
           
//             if(gloabal_disableDates !== undefined){
//                 availableDates = availableDates.filter(val => !gloabal_disableDates.includes(val));
//             }
//             if(availableDates){
//               if(global_disableDays == null){
//                 date(availableDates)
//               }else{ 
//                 date(availableDates,global_disableDays); 
//               }
//             }else{
//               console.log('dates are not available');
//             }
//         }    
//     });
// });

// //Service Time Slot
// jQuery("#booking_date").on("change",function(){
//   jQuery(".app-check").remove();
//   jQuery('#no_slot').css({'display':'none'});
//       var selected_date = jQuery(this).val();
//       var service = jQuery('#booking_services').val();
//         jQuery.ajax({
//         type: "POST",
//         dataType : "json",
//         url : frontend_ajax_object.ajaxurl,
//         data : { action: "service_booking_time_slot", selected_date : selected_date,service:service},
//         success:function(response){
//           if(response.data == null){
//             jQuery('#no_slot').slideDown();
//             jQuery('#choose_date').css({'display':'none'});
//           }
//           var servicePrice = response.service_price;
//           if(typeof servicePrice == 'undefined'){
//             jQuery('.service_price_class').css({'display':'none'});
//           }else{
//             jQuery('.service_price_class').slideDown();
//             jQuery('#service_price').val(servicePrice);
//           }
//           jQuery('#cod_price').val(servicePrice);
//           jQuery('#service_amt').val(servicePrice);

//           var booked = response.booked;
//           var arr = response.data;

//           if (booked !== undefined && arr !== undefined ) {
//               if(response.availivility == booked.length){
//                 jQuery('.slot_button').css({'display':'none'});
//                 jQuery('.disabled_button_noslot').css({'display':'none'});
//                 jQuery('.disabled_button').css({'display':'','cursor': 'not-allowed' ,'text-decoration': 'none'});
//                 jQuery.each(arr , function(i, val) {
//                     jQuery('#hide_class').append(' <div class="app-check"><input type="radio" class="option-input radio required" name="time_sloat" id="time_sloat" value="'+val+'" disabled/><div class="app-border"><label class="app-label">'+val+'</label></div></div>');
//                 });
//               }else{
//                 jQuery('.slot_button').css({'display':''});
//                 jQuery('.disabled_button').css({'display':'none'});
//                 jQuery('.disabled_button_noslot').css({'display':'none'});
//                   jQuery.each(arr , function(i, val) {
//                     if(booked.includes(val) == true){
//                       jQuery('#hide_class').append(' <div class="app-check"><input type="radio" class="option-input radio required" name="time_sloat" id="time_sloat" value="'+val+'" disabled/><div class="app-border"><label class="app-label">'+val+'</label></div></div>');
//                     }else{
//                       jQuery('#hide_class').append(' <div class="app-check"><input type="radio" class="option-input radio required" name="time_sloat" id="time_sloat" value="'+val+'"/><div class="app-border"><label class="app-label">'+val+'</label></div></div>');
//                     }
//                 });
//               }
//           }else{
//             jQuery('.slot_button').css({'display':'none'});
//             jQuery('.disabled_button').css({'display':'none'});
//             jQuery('.disabled_button_noslot').css({'display':''});            
//           }
//           jQuery('#hide_class').css({'display':'block','margin-top': '-50px'});
//           jQuery('#choose_date').css({'display':'none'}); 
//           var availableDates = response.avilable_date;
//           date(availableDates); 
//         }    
//     });
// });

// function date(availableDates,disable_days){
//   jQuery('#booking_date').datepicker({
//       dateFormat: 'd-m-yy',
//       beforeShowDay:function(date){
//       datepicker_date = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();   
//       if (jQuery.inArray(datepicker_date, availableDates) != -1 && jQuery.inArray(date.getDay(),disable_days) == -1 ) {
//         return [true, "","Available"];
//       } else {
//         return [false,"","unAvailable"];
//       }
//     }
//   });
// }

// jQuery(document).ready(function(e){
//   jQuery("#all_data_next").on('click', function(e){
//       var selected_date =  jQuery("#booking_date").val();
//       var selected_service =  jQuery("#booking_services").val();
//       var selected_time =  jQuery('input[name="time_sloat"]:checked').val();
//       var gender =  jQuery('input[name="gender"]:checked').val();
//       var address =  jQuery("#address").val();
//       var name =  jQuery("#customer_name").val();
//       var phone_no =  jQuery("#phone_no").val();
//       var email= jQuery("#email").val();
//       jQuery('#item_name').val(selected_service) 
//       var return_url = 'http://localhost/wordpress/?page_id=2934&service_date='+selected_date+'&selected_time='+selected_time+'&gender='+gender+'&address='+address+'&customer_name='+name+'&customer_mail='+email+'&phone_no='+phone_no+'';
            
//       var service_name =  jQuery("#paypal_url").val(return_url);
//   });
// }); 

// jQuery(document).ready(function(e){
//   jQuery("#Formsubmit").on('click', function(e){
//         e.preventDefault(); 
//         var formData = {
//             id: jQuery("#id").val(),
//             service_name: jQuery("#booking_services").val(),
//             selected_date: jQuery("#booking_date").val(),
//             selected_time: jQuery('input[name="time_sloat"]:checked').val(),
//             gender: jQuery('input[name="gender"]:checked').val(),
//             address: jQuery("#address").val(),
//             name: jQuery("#customer_name").val(),
//             email: jQuery("#email").val(),
//             phone_no: jQuery("#phone_no").val(),
//             paymnet_option: jQuery('input[name="paymnet_option"]:checked').val(),
//         };
        
//         jQuery.ajax({
//             type: "POST",
//             dataType : "json",
//             url : frontend_ajax_object.ajaxurl,
//             data : { 
//               security: frontend_ajax_object.nonce,
//               action: "service_booking_form_data", 
//               formData : formData 
//             },
//             success:function(response){
//               swal(
//                 'Service Booked',
//                 'Congratulations Your service  is successfully booked!',
//                 'success'
//               )
//               setTimeout(function() {
//                   location.reload();
//               }, 5000);
//             }
//         });
//       });
//   });   

//booking form  js end

position

<style>

  .draggable {
      width: 50px;
      height: 50px;
      padding: 0.5em;
      float: left;
      margin: 0 10px 10px 0;
      cursor:move;      
      margin-bottom:20px;
  }

  #containment-wrapper {
      width: 500px;
      height: 500px;
      border:2px solid #ccc;
      padding: 10px;
  }
  h3 {
      clear: left;
  }
  #dragThis {
    width: 6em;
    height: 6em;
    padding: 0.5em;
    border: 3px solid #ccc;
    border-radius: 0 1em 1em 1em;
}
</style>
<div id="dragThis">
    <ul>
        <li id="posX"></li>
        <li id="posY"></li>
    </ul>
</div>


<div id="message" style="display:none"><h1>Saved!</h1></div>

<div id="containment-wrapper">
    <div id="1" class="ui-widget-content draggable" data-left="20px" data-top="20px" style="position:absolute" >T1</div>
    <div id="2" class="ui-widget-content draggable" data-left="97px" data-top="102px" style="  position:absolute">T2</div>
    <div id="3" class="ui-widget-content draggable" data-left="98px" data-top="20px" style="  position:absolute">T3</div>
    <div id="4" class="ui-widget-content draggable" data-left="176px" data-top="20px" style="  position:absolute">T4</div>
</div>
<input type="submit" id="save" value="save">
<script>
//   jQuery(function() {
//   jQuery( "#set div" ).draggable({ 
    
//     stack: "#set div",
//       stop: function(event, ui) {
//         var elem = jQuery(this),
//         id = elem.attr('data-table');
//         var newleft = elem.attr('data-left');
//          console.log(newleft);
//         var newtop = elem.attr('data-top');
//          console.log(newtop);
//           // var pos_x = ui.offset.left;
//           // var pos_y = ui.offset.top;
//           // var table = ui.helper.data("table");
         
//           // console.log(pos_x);
//           // console.log(pos_y);
//           // console.log(table);

//           jQuery.ajax({
// 					type: "POST",
// 					dataType : "json",
// 					url : lrbookly_ajax_object.ajaxurl,
//           data: { action: "save_with_position", pos_x: pos_x, pos_y: pos_y, table_no: table},
            
//           success:function(response){
//               console.log(response);
//               var table_no = response.data.table_no;
//               var x = response.data.x;
//               var y = response.data.y;
//               // jQuery('#set [data-table=' + table_no + ']' ).addClass("selected");
//               // jQuery('.selected').css( { left: x+'px', top: y+'px' } );
//             }
//           });

//        }
//   });
// });
jQuery(document).on("ready", function(){
    jQuery(".draggable").draggable({
        containment: "#containment-wrapper"
    });
})

jQuery(document).on("mouseup", ".draggable", function(){

    var elem = jQuery(this),
        id = elem.attr('id'),
        desc = elem.attr('data-desc'),
        pos = elem.position();
        
    console.log('Left: '+pos.left+'; Top:'+pos.top);

});
  
jQuery(document).on("click", "#save", function(){
  alert('helo');
    jQuery(".draggable").each(function(){
        var elem = jQuery(this),
            id = elem.attr('id');
            newleft = elem.attr('data-left'),
            newtop = elem.attr('data-top');
            
            jQuery.ajax({
            type: "POST",
            dataType : "json",
            url : lrbookly_ajax_object.ajaxurl,
            data: { action: "save_with_position", pos_x: newleft, pos_y: newtop, table_no: id},
              success: function(response){
                 console.log(response);
                 var table_no = response.data.table_no;
                 var x = response.data.x;
//               var y = response.data.y;
                var d = jQuery('div[id=' + table_no + ']' ).attr('data-left',x);
                alert(d);
                //  jQuery("img").attr("width", "500");
              }
        })            
            
    })

})
  
</script>