<div class="wrap">
<h1><?php _e('Admin Email Template Settings', 'lrbookly' );
        $tempalte_Adata = get_option('admin_service_Etemplate_setting_data'); 
?></h1>

<form method="post" action="options.php">
    <?php settings_fields( 'lrbookly_service_adminE-template_setting' ); ?>
    <?php do_settings_sections( 'lrbookly_service_adminE-template_setting' ); ?>
	
	<p><?php _e('Use Below shortcode:', 'lrbookly' );?></p>
	<ol style="list-style-type:square">
		<li><?php _e('Username : [user-name]', 'lrbookly' );?></li>
		<li><?php _e('User Email : [user-email]', 'lrbookly' );?></li>
		<li><?php _e('Services : [services]', 'lrbookly' );?></li>
	</ol>
     <!-- ADMIN EMAIL TEMPLATE SETTINGS -->
    
	<hr>
	<h5><?php _e('Admin mail Template Settings');?></h6>
	<table class="form-table">
		<tr valign="top">
			<th scope="row"><?php _e('Enable Admin mail', 'lrbookly' );?></th>
            <?php $isChecked = !empty($tempalte_Adata['is_enable']) && $tempalte_Adata['is_enable'] == "yes" ? "checked" : " "; ?>
			<td><input type="checkbox"  name="admin_service_Etemplate_setting_data[is_enable]" value="yes" <?php echo $isChecked ? $isChecked: "checked"?>></td>
        </tr>

		<tr valign="top">
        <th scope="row"><?php _e('Admin Mail Heading', 'lrbookly' );?></th>
        <td><input type="text" placeholder="Admin Mail Heading" name="admin_service_Etemplate_setting_data[admin_template_heading]" value="<?php echo  isset($tempalte_Adata['admin_template_heading']) ? $tempalte_Adata['admin_template_heading'] : '';?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php _e('Admin Mail Subject', 'lrbookly' );?></th>
        <td><input type="text" placeholder="Admin Mail Subject" name="admin_service_Etemplate_setting_data[admin_template_subject]" value="<?php echo  isset($tempalte_Adata['admin_template_subject']) ? $tempalte_Adata['admin_template_subject'] : '';?>"/></td>
        </tr>
        
		<tr valign="top">
        <th scope="row"><?php _e('Admin Message', 'lrbookly' );?></th>
        <td>
            <?php $args = array (
                'media_buttons' => false,
                'textarea_rows' => '10',
                'textarea_name' => 'admin_service_Etemplate_setting_data[admin_template_msg]'
            );
            wp_editor(isset($tempalte_Adata['admin_template_msg']) ? $tempalte_Adata['admin_template_msg'] : '', 'admin_template_msg', $args ); ?>
        </td>
        </tr>

    </table>
    <?php submit_button(); ?>       
</form>

</div>