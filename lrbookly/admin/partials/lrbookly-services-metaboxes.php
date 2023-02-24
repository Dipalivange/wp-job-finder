<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
<?php 
    $id = get_the_ID();
    $booking_avaibility = get_post_meta($id,'booking_avaibility');
    $booking_date = get_post_meta($id,'LrBooking_service_date');
    $service_price = get_post_meta($id,'LrBooking_all_service_price');

    $days =  array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    $time_interval = get_option('lrbookly_global_service_time');
    $set_time = $time_interval['intervai_time']; 
    $startTime = $time_interval['start_time'];
    $endTime = $time_interval['end_time'] ;    
    ?>
    <div class="service_date">
        <div>
            <label for="strat_date"><?php _e('Start Date');?></label>
            <input type="text" id="start_date" class="start_date" name="start_date" value="<?php echo isset($booking_date[0]['start_date']) && $booking_date[0]['start_date'] ?$booking_date[0]['start_date'] : ''; ?>">
        </div>
        <div>
            <label for="end_date"><?php _e('End Date');?></label>
            <input type="text" id="end_date" class="end_date" name="end_date" value="<?php echo isset($booking_date[0]['end_date']) && $booking_date[0]['end_date'] ? $booking_date[0]['end_date'] : ''; ?>">
        </div>
    </div>     
    <div class="all_service_price">
        <div>
            <?php $isChecked = !empty($service_price[0]['enable']) && $service_price[0]['enable'] == "yes" ? "checked" : " "; ?>
            <input type="checkbox" name="service_price_check_enable" id="service_price_check_enable" value="yes"<?php echo $isChecked ? $isChecked: "checked"?> >
        </div>
        <div>
            <label for="price_label"><?php _e('Enable, if you want to all Service with same price');?></label>
        </div>
        <div>
            <input type="number" id="service_price_check" class="service_price_check" name="service_price_check" value="<?php echo isset($service_price[0]['price']) && $service_price[0]['price'] ?$service_price[0]['price'] : ''; ?>" >
        </div>        <div>
            <button id="price_apply" class="button-primary button-large"><?php _e('Apply');?></button>  
        </div>
    </div>
<hr>
   
<table class="wc-item-table" id="ToBeApplied" width="100%">
		<tbody>
            <tr>
                <th><?php _e('No');?>.</th>
                <th><?php _e('Weekdays');?></th>
                <th><?php _e('Bookable');?></th>
                <th><?php _e('Price');?></th>
                <th><?php _e('Number of Availibility');?> </th>
                <th><?php _e('From Time');?></th>
                <th><?php _e('To Time');?> </th>
            </tr>
          
            <?php 
            $keys = array_keys($days);
            $no = 0;
            for($i = 0; $i < count($days); $i++) {
                $no ++;
                if($booking_avaibility){
                foreach($booking_avaibility as $key => $data) { ?>
                    <tr>
                        <td>
                            <?php echo $no; ?>
                        </td>
                        <td>
                            <input type="hidden" name="booking_avaibility[day][<?php echo $i;?>]" value="<?php echo isset($data[$days[$i]]['day']) ? $data[$days[$i]]['day'] : $days[$i];?>">  <?php echo $days[$i];?>  
                        </td>
                        <td>
                            <?php 
                                if(!empty(isset($data[$days[$i]]['bookable']))) { ?>
                                    <label class="switch"><input type='checkbox' name='booking_avaibility[bookable][<?php echo $i; ?>]' id='opt1' value='1'  checked/>
                                        <span class="slider_toggle round"></span>
                                    </label>
                                    <?php } else{ ?>
                                        <label class="switch"><input type='checkbox' name='booking_avaibility[bookable][<?php echo $i; ?>]' id='opt1' value='1' >
                                        <span class="slider_toggle round"></span>
                                    </label>
                            <?php } ?>
                        </td>
                        <td>
                            <input type="number" id="price" class="individual_price"  name="booking_avaibility[price][<?php echo $i;?>]" value="<?php echo isset($data[$days[$i]]['price']) ? $data[$days[$i]]['price'] :''; ?>" style="width: 100px">
                        </td>
                        <td>
                            <input type="number" id="customer_availibility" name="booking_avaibility[customer_availibility][<?php echo $i;?>]" value="<?php echo isset($data[$days[$i]]['customer_availibility']) ? $data[$days[$i]]['customer_availibility'] :''; ?>" style="width: 60px" >
                        </td>
                        <td>
                            <select class="from_time " id="from_time" name="booking_avaibility[from_time][<?php echo $i;?>]" (change)="changeFromTime($event.target.value)">
                                <?php
                                
                                    $start = strtotime($startTime);
                                    $end   = strtotime($endTime);
                                    for ($a=$start; $a<=$end; $a = $a + $set_time*60){ 
                                        echo $selcted = isset($data[$days[$i]]['from_time']) && $data[$days[$i]]['from_time'] === date('g:i A',$a) ? 'selected':'';
                                        ?>
                                        <option value="<?php echo date('g:i A',$a);?>" <?php echo $selcted;?>><?php echo date('g:i A',$a); ?></option>
                                    <?php }
                                ?>
                            </select>
                        </td>
                        <td>
                        <select class="to_time" id="to_time" name="booking_avaibility[to_time][<?php echo $i;?>]" disabled>
                            <?php
                                $start = strtotime($startTime);
                                $end   = strtotime($endTime);
                                for ($a=$start; $a<=$end; $a = $a + $set_time*60){ 
                                    $selcted = isset($data[$days[$i]]['to_time']) && $data[$days[$i]]['to_time'] === date('g:i A',$a) ? 'selected':'';
                                    ?>
                                    
                                    <option value="<?php echo date('g:i A',$a);?>" <?php echo $selcted;?>><?php echo date('g:i A',$a); ?></option>
                                <?php }
                            ?>
                        </select>
                    
                        </td>
                    
                    </tr>
            <?php  } }else{ ?>
                    <tr>
                        <td>
                            <?php echo $no; ?>
                        </td>
                        <td>
                            <input type="hidden" name="booking_avaibility[day][<?php echo $i;?>]" value="<?php echo isset($data[$days[$i]]['day']) ? $data[$days[$i]]['day'] : $days[$i];?>">  <?php echo $days[$i];?>  
                        </td>
                        <td>
                            <?php 
                                if(!empty(isset($data[$days[$i]]['bookable']))) { ?>
                                    <label class="switch"><input type='checkbox' name='booking_avaibility[bookable][<?php echo $i; ?>]' id='opt1' value='1'  checked/>
                                        <span class="slider_toggle round"></span>
                                    </label>
                                    <?php } else{ ?>
                                        <label class="switch"><input type='checkbox' name='booking_avaibility[bookable][<?php echo $i; ?>]' id='opt1' value='1' >
                                        <span class="slider_toggle round"></span>
                                    </label>
                            <?php } ?>
                        </td>
                        <td>
                            <input type="number" id="price" class="individual_price"  name="booking_avaibility[price][<?php echo $i;?>]" value="<?php echo isset($data[$days[$i]]['price']) ? $data[$days[$i]]['price'] :''; ?>" style="width: 100px">
                        </td>
                        <td>
                            <input type="number" id="customer_availibility" name="booking_avaibility[customer_availibility][<?php echo $i;?>]" value="<?php echo isset($data[$days[$i]]['customer_availibility']) ? $data[$days[$i]]['customer_availibility'] :''; ?>" style="width: 60px" >
                        </td>
                        <td>
                            <select class="from_time " id="from_time" name="booking_avaibility[from_time][<?php echo $i;?>]" (change)="changeFromTime($event.target.value)">
                                <?php
                                
                                    $start = strtotime($startTime);
                                    $end   = strtotime($endTime);
                                    for ($a=$start; $a<=$end; $a = $a + $set_time*60){ 
                                        echo $selcted = isset($data[$days[$i]]['from_time']) && $data[$days[$i]]['from_time'] === date('g:i A',$a) ? 'selected':'';
                                        ?>
                                        <option value="<?php echo date('g:i A',$a);?>" <?php echo $selcted;?>><?php echo date('g:i A',$a); ?></option>
                                    <?php }
                                ?>
                            </select>
                        </td>
                        <td>
                        <select class="to_time" id="to_time" name="booking_avaibility[to_time][<?php echo $i;?>]" disabled>
                            <?php
                                $start = strtotime($startTime);
                                $end   = strtotime($endTime);
                                for ($a=$start; $a<=$end; $a = $a + $set_time*60){ 
                                    $selcted = isset($data[$days[$i]]['to_time']) && $data[$days[$i]]['to_time'] === date('g:i A',$a) ? 'selected':'';
                                    ?>
                                    
                                    <option value="<?php echo date('g:i A',$a);?>" <?php echo $selcted;?>><?php echo date('g:i A',$a); ?></option>
                                <?php }
                            ?>
                        </select>
                    
                        </td>
                    
                    </tr>
           <?php }
        } ?>
    </tbody>       
</table>
  
<script>
$(document).ready(function(){
    $('.from_time').on('change', function(){
        var fromTime = $(this).val();
        var today = new Date("11/24/1993 " + $(this).val());
        $(this).closest('tr').find('.to_time option').filter(function() {
        var tempDate = new Date("11/24/1993 "+$(this).val());
            return tempDate <= today;
        }).prop('disabled', true);
    });
});
$(document).ready(function(){
    $( ".start_date" ).datepicker({
        dateFormat: 'd-m-yy',//check change
        changeMonth: true,
        changeYear: true,
        minDate: 0,
        onSelect: function(date) {
            $(".end_date").datepicker('option', 'minDate', date);
        }
    });
    $( ".end_date" ).datepicker({
        dateFormat: 'd-m-yy',//check change
        changeMonth: true,
        changeYear: true
    });
    jQuery('.start_date').on('change', function() {
       var start_date = jQuery(this).val();
       $(".start_date").val(start_date);
    });

    jQuery('.end_date').on('change', function() {
       var end_date = jQuery(this).val();
       $(".end_date").val(end_date);
    });
    
    jQuery('#price_apply').click(function () {
        isChecked = jQuery('#service_price_check_enable').is(':checked');
        if(isChecked == true){
            var price = jQuery('#service_price_check').val();
            jQuery('.individual_price').val(price);
        }
        return false;
    })
    jQuery(document).ready(function(){
		jQuery('.from_time').change(function () {
			jQuery(this).closest('tr').find('.to_time').prop('disabled', false);
		});
	});

});    
</script>