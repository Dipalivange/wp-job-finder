<form method="post" action="options.php">
    <?php settings_fields( 'lrbookly_service_payment_setting' ); ?>
    <?php do_settings_sections( 'lrbookly_service_payment_setting' ); ?>
    <h2><?php _e('Payment')?></h2>
    <h4><?php _e('Paypal Settings Options', 'lrbookly' );?></h4>
    <hr>
    <?php   $paypal_data = get_option('service_paypal_setting_data' ); ?>
    <table class="form-table" role="presentation">
        <tbody>
            <tr>
                <th scope="row"><?php _e('Status');?></th>
                <td>
                    <fieldset>
                        <select name="service_paypal_setting_data[paypal_option]" id="paypal_option">
                            <option value="enable" <?php echo isset( $paypal_data['paypal_option'] ) && $paypal_data['paypal_option'] === 'enable' ? 'selected' : '' ; ?>>Enable</option>
                            <option value="disable"  <?php echo isset( $paypal_data['paypal_option'] ) && $paypal_data['paypal_option'] === 'disable' ? 'selected' : '' ; ?>>Disable</option>
                        </select>
                        <br>
                        
                    </fieldset>
                </td>
            </tr>
            <tr >
                <th scope="row"><?php _e('Mode');?></th>
                <td>
                    <fieldset>
                            <select name="service_paypal_setting_data[paypal_mode]" id="paypal_mode">
                                <option value="sandbox"<?php echo isset( $paypal_data['paypal_mode'] ) && $paypal_data['paypal_mode'] === 'sandbox' ? 'selected' : '' ; ?>>Sandbox</option>

                                <option value="live"<?php echo isset( $paypal_data['paypal_mode'] ) && $paypal_data['paypal_mode'] === 'live' ? 'selected' : '' ; ?>>Live</option>
                            </select>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php _e('Title');?></th>
                <td>
                    <fieldset>
                        <input class="paypay_fileld" type="text" name="service_paypal_setting_data[paypal_title]" id="paypal_title" value="<?php
                        echo isset($paypal_data['paypal_title']) ? $paypal_data['paypal_title']: '';?>">
                        
                    </fieldset>
                </td>
            </tr>
        
            <tr class="live_mode" style="display:none;">
                <th scope="row"><?php _e('API Username');?></th>
                <td>
                    <fieldset>
                        <input class="paypay_fileld" type="password"  name="service_paypal_setting_data[paypal_api_username]" id="paypal_api_username" value="<?php echo isset($paypal_data['paypal_api_username']) ? base64_encode($paypal_data['paypal_api_username']): '';?>">
                    
                        <span toggle="#paypal_api_username" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </fieldset>
                </td>
            </tr>

            <tr class="live_mode" style="display:none;">
                <th scope="row"><?php _e('API Password');?></th>
                <td>
                    <fieldset>
                        <input class="paypay_fileld" type="password" name="service_paypal_setting_data[paypal_api_password]" id="paypal_api_password" value="<?php echo isset($paypal_data['paypal_api_password']) ? base64_encode($paypal_data['paypal_api_password']): '';?>">
                        <span toggle="#paypal_api_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        
                    </fieldset>
                </td>
            </tr>

            <tr class="live_mode" style="display:none;">
                <th scope="row"><?php _e('API Signature');?></th>
                <td>
                    <fieldset>
                        <input class="paypay_fileld" type="password" name="service_paypal_setting_data[paypal_api_signature]" id="paypal_api_signature" value="<?php echo isset($paypal_data['paypal_api_signature']) ? base64_encode($paypal_data['paypal_api_signature']): '';?>">
                        <span toggle="#paypal_api_signature" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        
                    </fieldset>
                </td>
            </tr>

            <tr class="sandbox_mode" style="display:none;">
                <th scope="row"><?php _e('Merchant Email');?></th>
                <td>
                    <fieldset>
                        <input class="paypay_fileld" type="text" name="service_paypal_setting_data[paypal_merchant_email]" id="paypal_merchant_email" value="<?php echo isset($paypal_data['paypal_merchant_email']) ? $paypal_data['paypal_merchant_email']: '';?>">
                    </fieldset>
                </td>
            </tr>

        </tbody>
    </table> 

<?php submit_button();?>
</from>
