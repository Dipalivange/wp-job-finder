<form method="post" action="options.php">
    <?php
        settings_fields( 'global_time_setting' );
        do_settings_sections( 'global_time_setting' ); 
    ?>
  <table class="form-table">  
    <tr>
        <th scope="row">    <?php _e('Select Time Interval');?>   </th>
        <?php $global_time = get_option('lrbookly_global_service_time');?>
        <td>
            <select name="lrbookly_global_service_time[intervai_time]" id="lrbookly_global_service_time" style="width:100px;">
                <?php $selected = (isset(  $global_time['intervai_time'] ) &&  $global_time['intervai_time'] === '15 min') ? 'selected' : '' ; ?>
                <option value="15" <?php echo $selected; ?>><?php _e('15 min');?></option>

                <?php $selected = (isset(  $global_time['intervai_time'] ) &&  $global_time['intervai_time'] === '30') ? 'selected' : '' ; ?>
                <option value="30" <?php echo $selected; ?>><?php _e('30 min');?></option>

                <?php $selected = (isset(  $global_time['intervai_time'] ) &&  $global_time['intervai_time'] === '45') ? 'selected' : '' ; ?>
                <option value="45" <?php echo $selected; ?>><?php _e('45 min');?></option>

                <?php $selected = (isset(  $global_time['intervai_time'] ) &&  $global_time['intervai_time'] === '60') ? 'selected' : '' ; ?>
                <option value="60" <?php echo $selected; ?>><?php _e('60 min');?></option>
            </select>
        </td>
    </tr>
    <tr>
         <th scope="row">    <?php _e('Select Start Time');?>   </th>
        <td>
            <input type="time" name="lrbookly_global_service_time[start_time]" id="lrbookly_global_startTime" value="<?php echo
            (isset($global_time['start_time'])) && $global_time['start_time']? $global_time['start_time'] : '';
            ?>">
        </td>
    </tr>
     
    <tr>
        <th scope="row">    <?php _e('Select End Time');?>   </th>
        <td>
            <input type="time" name="lrbookly_global_service_time[end_time]" id="lrbookly_global_endTime" value="<?php echo
            (isset($global_time['end_time'])) && $global_time['end_time']? $global_time['end_time'] : '';
            ?>">
        </td>
    </tr>

</table>
<?php submit_button(); ?>
</form>