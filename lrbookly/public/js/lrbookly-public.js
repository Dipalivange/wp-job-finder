(function( $ ) {
	'use strict';
	// alert('lrbookly service');
	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
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

		jQuery('.slot_button').click(function(){
			var isChecked = jQuery('#time_sloat').is(':checked');
			if(isChecked == 'false'){
			jQuery('.accordion--form__invalid').show();
			return false;
			}
		});

		//On click of the 'prev' anchor
		jQuery('.accordion--form__prev-btn').on('click touchstart', function() {
			var	parentWrapper = jQuery(this).parent().parent();
			var	prevWrapper = jQuery(this).parent().parent().prev('.accordion--form__fieldset');
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
			jQuery(".paypal_payment").slideDown();
			jQuery("#cod_price").css({'display':'none'});
			jQuery("#Formsubmit").css({'display':'none'});
		});

		//COD Check
		jQuery('#cod_check').on('click',function() {
			jQuery("#cod_price").slideDown();
			jQuery(".paypal_payment").css({'display':'none'});
			jQuery("#Formsubmit").css({'display':''});
		});

		//Service Booking Dates
		jQuery('#booking_services').on('change', function() {
		jQuery('#no_date').css({'display':'none'});
		jQuery('.service_price_class').css({'display':'none'});

		
		jQuery("#booking_date").datepicker("destroy");

		jQuery("#booking_date").val("");
			jQuery(".app-check").hide();
			var booking_services = jQuery(this).val();
			jQuery.ajax({
				type: "POST",
				dataType : "json",
				url : lrbookly_ajax_object.ajaxurl,
				data : { 
				action: "service_booking_date", 
				booking_services : booking_services
				},
				success:function(response){
					var global_disableDays = response.global_days;
					var gloabal_disableDates = response.global_date;
					var availableDates = response.avilable_date;
				
					if(gloabal_disableDates !== undefined){
						availableDates = availableDates.filter(val => !gloabal_disableDates.includes(val));
					}
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
				url : lrbookly_ajax_object.ajaxurl,
				data : { action: "service_booking_time_slot", selected_date : selected_date,service:service},
				success:function(response){
					

				if(response.data == null){
					
					jQuery('#no_slot').slideDown();
					jQuery('#choose_date').css({'display':'none'});
				}
				var servicePrice = response.service_price;
				if(typeof servicePrice == 'undefined'){
					jQuery('.service_price_class').css({'display':'none'});
				}else{
					jQuery('.service_price_class').slideDown();
					jQuery('#service_price').val(servicePrice);
				}
				jQuery('#cod_price').val(servicePrice);
				jQuery('#service_amt').val(servicePrice);

				var booked = response.booked;
				var arr = response.data;

				if (booked !== undefined && arr !== undefined ) {
					if(response.availivility == booked.length){
						jQuery('.slot_button').css({'display':'none'});
						jQuery('.disabled_button_noslot').css({'display':'none'});
						jQuery('.disabled_button').css({'display':'','cursor': 'not-allowed' ,'text-decoration': 'none'});
						jQuery.each(arr , function(i, val) {
							jQuery('#hide_class').append(' <div class="app-check"><input type="radio" class="option-input radio required" name="time_sloat" id="time_sloat" value="'+val+'" disabled/><div class="app-border"><label class="app-label">'+val+'</label></div></div>');
						});
					}else{
						jQuery('.slot_button').css({'display':''});
						jQuery('.disabled_button').css({'display':'none'});
						jQuery('.disabled_button_noslot').css({'display':'none'});
						jQuery.each(arr , function(i, val) {
							if(booked.includes(val) == true){
							jQuery('#hide_class').append(' <div class="app-check"><input type="radio" class="option-input radio required" name="time_sloat" id="time_sloat" value="'+val+'" disabled/><div class="app-border"><label class="app-label">'+val+'</label></div></div>');
							}else{
							jQuery('#hide_class').append(' <div class="app-check"><input type="radio" class="option-input radio required" name="time_sloat" id="time_sloat" value="'+val+'"/><div class="app-border"><label class="app-label">'+val+'</label></div></div>');
							}
						});
					}
				}else{
					jQuery('.slot_button').css({'display':'none'});
					jQuery('.disabled_button').css({'display':'none'});
					jQuery('.disabled_button_noslot').css({'display':''});            
				}
				jQuery('#hide_class').css({'display':'block','margin-top': '-50px'});
				jQuery('#choose_date').css({'display':'none'}); 
				var availableDates = response.avilable_date;
				date(availableDates); 
				}    
			});
		});

		jQuery(document).ready(function(e){
		jQuery("#all_data_next").on('click', function(e){
			var origin   = window.location.origin;	
			var selected_date =  jQuery("#booking_date").val();
			var selected_service =  jQuery("#booking_services").val();
			var selected_time =  jQuery('input[name="time_sloat"]:checked').val();
			var gender =  jQuery('input[name="gender"]:checked').val();
			var address =  jQuery("#address").val();
			var name =  jQuery("#customer_name").val();
			var phone_no =  jQuery("#phone_no").val();
			var email= jQuery("#email").val();
			jQuery('#item_name').val(selected_service) 
			var return_url = origin+'/thank-you?service_date='+selected_date+'&selected_time='+selected_time+'&gender='+gender+'&address='+address+'&customer_name='+name+'&customer_mail='+email+'&phone_no='+phone_no+'';
			var service_name =  jQuery("#paypal_url").val(return_url);
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
				
				jQuery.ajax({
					type: "POST",
					dataType : "json",
					url : lrbookly_ajax_object.ajaxurl,
					data : { 
						security: lrbookly_ajax_object.nonce,
						action: "service_booking_form_data", 
						formData : formData 
					},
					success:function(response){
						swal(
						'Service Booked',
						'Congratulations Your service  is successfully booked!',
						'success'
						)
						setTimeout(function() {
							location.reload();
						}, 5000);
					}
				});
				});
		});   
		// jQuery("#txtstartdate").datepicker({
		// 	minDate: 0,
		// 	onSelect: function(date) {
		// 	  jQuery("#txtenddate").datepicker('option', 'minDate', date);
		// 	}
		// });
		  
		// jQuery("#txtenddate").datepicker({});


})


( jQuery );
function date(availableDates,disable_days){
	jQuery('#booking_date').datepicker({
		minDate:0,
        beforeShowDay: function (date) {
            //getDate() returns the day (0-31)
            if (date.getDay() == 1 ) {
                return [true, ''];
            }
            return [false, ''];
        },
		dateFormat: 'd-m-yy',
		startDate: new Date(),
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