<div class="wrap">
<h1><?php _e('Paypal Email Template Settings', 'lrbookly' );
     $paypal_template = get_option('paypal_service_Etemplate_setting_data');
?></h1>
<form method="post" action="options.php">
    <?php settings_fields( 'lrbookly_service_paypalE-template_setting' ); ?>
    <?php do_settings_sections( 'lrbookly_service_paypalE-template_setting' ); ?>
	
	<p><?php _e('Use Below shortcode:', 'lrbookly' );?></p>
	<ol style="list-style-type:square">
		<li><?php _e('Username : [user-name]', 'lrbookly' );?></li>
		<li><?php _e('User Email : [user-email]', 'lrbookly' );?></li>
		<li><?php _e('Services : [services]', 'lrbookly' );?></li>
	</ol>
    
	 <!-- PAYPAL MAIL TEMPLATES SETTINGS: -->
     <hr>
	<h5><?php _e('Paypal mail Template Settings');?></h6>
	<table class="form-table">
		<tr valign="top">
			<th scope="row"><?php _e('Enable Paypal mail', 'lrbookly' );?></th>
            <?php $isChecked = !empty($paypal_template['is_enable']) && $paypal_template['is_enable'] == "yes" ? "checked" : " "; ?>
			<td><input type="checkbox"  name="paypal_service_Etemplate_setting_data[is_enable]" value="yes" <?php echo $isChecked ? $isChecked: "checked"?>></td>
        </tr>

		<tr valign="top">
        <th scope="row"><?php _e('Paypal Mail Heading', 'lrbookly' );?></th>
        <td><input type="text" placeholder="Paypal Mail Heading" name="paypal_service_Etemplate_setting_data[paypal_template_heading]" value="<?php echo  isset($paypal_template['paypal_template_heading']) ? $paypal_template['paypal_template_heading'] : '';?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php _e('Paypal Mail Subject', 'lrbookly' );?></th>
        <td><input type="text" placeholder="Paypal Mail Subject" name="paypal_service_Etemplate_setting_data[paypal_template_subject]" value="<?php echo  isset($paypal_template['paypal_template_subject']) ? $paypal_template['paypal_template_subject'] : '';?>"/></td>
        </tr>
        
		<tr valign="top">
        <th scope="row"><?php _e('Admin Message', 'lrbookly' );?></th>
        <td>
            <?php $args = array (
                'media_buttons' => false,
                'textarea_rows' => '10',
                'textarea_name' => 'paypal_service_Etemplate_setting_data[paypal_template_msg]'
            );
            wp_editor(isset($paypal_template['paypal_template_msg']) ? $paypal_template['paypal_template_msg'] : '','paypal_template_msg', $args ); ?>
        </td>
        </tr>

    </table>
    <?php submit_button(); ?>        
</form>

</div>