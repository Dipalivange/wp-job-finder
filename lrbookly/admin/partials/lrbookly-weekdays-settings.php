<form method="post" action="options.php">
    <?php 
        settings_fields( 'global_weekdays_setting' ); 
        do_settings_sections( 'global_weekdays_setting' ); 
        $days = get_option('lrbookly_global_service_days');
    ?>
    <h4><?php _e('Disable Days for Services', 'lrbookly' );?></h4>
    <hr>
    <table class="setting-table" width="30%" height="60px"  >
        <tbody>
            <tr>
                <td><?php _e('Sunday'); ?></td>
                <td><label class="switch"><input type="checkbox" name="lrbookly_global_service_days[0]" id="lrbookly_global_service_days[sunday]" value="on"  <?php echo !isset($days['0']) || !$days['0'] ? "" : 'checked';?>>
                        <span class="slider_toggle round"></span>
                    </label>
                </td>
            </tr>
            <tr>
                <td><?php _e('Monday'); ?></td>
                <td><label class="switch"><input type="checkbox" name="lrbookly_global_service_days[1]"  id="lrbookly_global_service_days[monday]" value="on"  <?php echo !isset($days['1']) || !$days['1'] ? "" : 'checked';?>>
                        <span class="slider_toggle round"></span>
                    </label>
                </td>
            </tr>

            <tr>
                <td><?php _e('Tuesday'); ?></td>
                <td><label class="switch"><input type="checkbox" name="lrbookly_global_service_days[2]"  id="lrbookly_global_service_days[tuesday]" value="on"  <?php echo !isset($days['2']) || !$days['2'] ? "" : 'checked';?>>
                        <span class="slider_toggle round"></span>
                    </label>
                </td>
            </tr>
            <tr>
                <td><?php _e('Wednesday'); ?></td>
                <td><label class="switch"><input type="checkbox" name="lrbookly_global_service_days[3]"  id="lrbookly_global_service_days[wednesday]" value="on"  <?php echo !isset($days['3']) || !$days['3'] ? "" : 'checked';?>>
                        <span class="slider_toggle round"></span>
                    </label>
                </td>
            </tr>
            <tr>
                <td><?php _e('Thursday'); ?></td>
                <td><label class="switch"><input type="checkbox" name="lrbookly_global_service_days[4]"  id="lrbookly_global_service_days[thursday]" value="on"  <?php echo !isset($days['4']) || !$days['4'] ? "" : 'checked';?>>
                        <span class="slider_toggle round"></span>
                    </label>
                </td>
            </tr>
            <tr>
                <td><?php _e('Friday'); ?></td>
                <td><label class="switch"><input type="checkbox" name="lrbookly_global_service_days[5]" id="friday" value="on"  <?php echo !isset($days['5']) || !$days['5'] ? "" : 'checked';?>>
                        <span class="slider_toggle round"></span>
                    </label>
                </td>
            </tr>
            <tr>
                <td><?php _e('Saturday'); ?></td>
                <td><label class="switch"><input type="checkbox" name="lrbookly_global_service_days[6]" id="saturday" value="on"  <?php echo !isset($days['6']) || !$days['6'] ? "" : 'checked';?>>
                        <span class="slider_toggle round"></span>
                    </label>
                </td>
            </tr>
            
        </tbody>

    </table>

    <?php submit_button(); ?>
</from>  
<?php //require_once plugin_dir_path(__FILE__) . 'lrbookly-dates-settings.php'; ?>