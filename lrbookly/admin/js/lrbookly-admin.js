(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
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

	// GLOBAL SERVICE DATE START : 
	jQuery(document).ready(function(){
        jQuery( "#from_date" ).datepicker({
            dateFormat: 'd-m-yy',//check change
            changeMonth: true,
            changeYear: true,
            minDate: 0,
            onSelect: function(date) {
                jQuery("#to_date").datepicker('option', 'minDate', date);
            }
        });
        jQuery( "#to_date" ).datepicker({
            dateFormat: 'd-m-yy',//check change
            changeMonth: true,
            changeYear: true
        });
    });
	// GLOBAL SERVICE DATE END : 

	//PAYPAL PAYMENT SETTINGS START:
	jQuery(document).ready(function(){
		jQuery(".toggle-password").click(function() {
			jQuery(this).toggleClass("fa-eye fa-eye-slash");
			var input = jQuery(jQuery(this).attr("toggle"));
			if (input.attr("type") == "password") {
			input.attr("type", "text");
			} else {
			input.attr("type", "password");
			}
		});
		var sandbox = jQuery('#paypal_mode').val();
		if(sandbox == 'sandbox'){
			jQuery('.sandbox_mode').css('display','');
		}
		if(sandbox == 'live'){
			jQuery('.live_mode').css('display','');  
		}
		jQuery('#paypal_mode').on('change', function() {
		  var paypalMode = this.value;  
		  if(paypalMode == 'sandbox'){
			jQuery('.sandbox_mode').css('display','');    
			jQuery('.live_mode').css('display','none');
		  }
	
		  if(paypalMode == 'live'){
			jQuery('.live_mode').css('display','');  
			jQuery('.sandbox_mode').css('display','none');
		  }
		});
	});
	//PAYPAL PAYMENT SETTINGS END : 

	//SERVICE META BOX JS START:
	// jQuery(document).ready(function(){
	// 	jQuery('.from_time').on('change', function(){
	// 		// alert('hello');
	// 		var fromTime = jQuery(this).val();
	// 		var today = new Date("11/24/1993 " + jQuery(this).val());
	// 		jQuery(this).closest('tr').find('.to_time option').filter(function() {
	// 		var tempDate = new Date("11/24/1993 "+jQuery(this).val());
	// 			return tempDate <= today;
	// 		}).prop('disabled', true);
	// 	});
	// });
	// jQuery(document).ready(function(){
	// 	jQuery( ".start_date" ).datepicker({
	// 		dateFormat: 'd-m-yy',//check change
	// 		changeMonth: true,
	// 		changeYear: true,
	// 		minDate: 0,
	// 		onSelect: function(date) {
	// 			jQuery(".end_date").datepicker('option', 'minDate', date);
	// 		}
	// 	});
	// 	jQuery( ".end_date" ).datepicker({
	// 		dateFormat: 'd-m-yy',//check change
	// 		changeMonth: true,
	// 		changeYear: true
	// 	});
	// 	jQuery('.start_date').on('change', function() {
	// 	   var start_date = jQuery(this).val();
	// 	   jQuery(".start_date").val(start_date);
	// 	});
	
	// 	jQuery('.end_date').on('change', function() {
	// 	   var end_date = jQuery(this).val();
	// 	   jQuery(".end_date").val(end_date);
	// 	});
		
	// 	jQuery('#price_apply').click(function () {
	// 		isChecked = jQuery('#service_price_check_enable').is(':checked');
	// 		if(isChecked == true){
	// 			var price = jQuery('#service_price_check').val();
	// 			jQuery('.individual_price').val(price);
	// 		}
	// 		return false;
	// 	});
	// });
	
	//SERVICE META BOX JS END:
})( jQuery );
