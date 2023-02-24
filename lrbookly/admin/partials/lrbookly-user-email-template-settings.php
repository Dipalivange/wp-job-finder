<div class="wrap">
<h1><?php _e('User Email Template Settings', 'lrbookly' );
          $tempalte_Udata = get_option('user_service_Etemplate_setting_data');  
?></h1>

<form method="post" action="options.php">
    <?php settings_fields( 'lrbookly_service_userE-template_setting' ); ?>
    <?php do_settings_sections( 'lrbookly_service_userE-template_setting' ); ?>
	
	<p><?php _e('Use Below shortcode:', 'lrbookly' );?></p>
	<ol style="list-style-type:square">
		<li><?php _e('Username : [user-name]', 'lrbookly' );?></li>
		<li><?php _e('User Email : [user-email]', 'lrbookly' );?></li>
		<li><?php _e('Services : [services]', 'lrbookly' );?></li>
    </ol>

    <!-- USER EMAIL TEMPLATE SETTINGS -->
	<hr>
	<h5><?php _e('User mail Template Settings', 'lrbookly' );?></h5>
    <table class="form-table">

		<tr valign="top">
			<th scope="row"><?php _e('Enable User mail', 'lrbookly' );?></th>
            <?php $isChecked = !empty($tempalte_Udata['is_enable']) && $tempalte_Udata['is_enable'] == "yes" ? "checked" : " "; ?>
			<td><input type="checkbox"  name="user_service_Etemplate_setting_data[is_enable]" value="yes" <?php echo $isChecked ? $isChecked: "checked"?> ></td>
        </tr>

		<tr valign="top">
			<th scope="row"><?php _e('User mail template Heading', 'lrbookly' );?></th>
			<td><input type="text" placeholder="User mail template Heading" name="user_service_Etemplate_setting_data[user_template_heading]" value="<?php echo  isset($tempalte_Udata['user_template_heading']) ? $tempalte_Udata['user_template_heading'] : '';?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php _e('User mail template Subject', 'lrbookly' );?></th>
        <td><input type="text"  placeholder="User mail template Subject" name="user_service_Etemplate_setting_data[user_template_subject]" value="<?php echo  isset($tempalte_Udata['user_template_subject']) ? $tempalte_Udata['user_template_subject'] : '';?>" /></td>
        </tr>

		<tr valign="top">
        <th scope="row"><?php _e('User mail template Message', 'lrbookly' );?></th>
        <td>
            <?php $args = array (
                'media_buttons' => false,
                'textarea_rows' => '10',
                'textarea_name' => 'user_service_Etemplate_setting_data[user_template_msg]'
            );
            wp_editor(isset($tempalte_Udata['user_template_msg']) ? $tempalte_Udata['user_template_msg'] : '', 'user_template_msg', $args ); ?>
        </td>
        </tr>
    </table>
        
    <?php submit_button(); ?>

</form>
</div>