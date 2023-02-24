 <h4><?php _e('Disable Date for Services', 'lrbookly' );?></h4>
<?php $global_dates = get_option('lrbookly_global_service_date'); ?>
<hr>
<form method="post" action="options.php">
    <?php
        settings_fields( 'global_dates_setting' );
        do_settings_sections( 'global_dates_setting' ); 
    ?>
    <table class="setting-table" width="30%" height="60px"  >
        <tbody>
            <tr>
                <td><?php _e('Enabled Global Dates Settings:'); ?> </td>
                <td>
                    <input type="checkbox" name="lrbookly_global_service_date[is_enabled]" id="is_enabled" value="yes" <?php echo isset($global_dates['is_enabled']) &&  $global_dates['is_enabled'] == "yes" ? "checked": '' ?>>
                </td>
            </tr>
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

