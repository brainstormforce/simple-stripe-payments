<?php

function bsf_stripe_settings_setup() {
	add_options_page('Stripe Settings', 'Stripe Settings', 'manage_options', 'stripe-settings', 'bsf_stripe_render_options_page');
}
add_action('admin_menu', 'bsf_stripe_settings_setup');

function bsf_stripe_render_options_page() {
	global $stripe_options;
	?>
	<div class="wrap">
		<h2><?php _e('Stripe Settings', 'bsf_stripe'); ?></h2>
		<form method="post" action="options.php">
		
			<?php settings_fields('stripe_settings_group'); ?>
			
			<table class="form-table">
				<tbody>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('Test Mode', 'test_mode'); ?>
						</th>
						<td>
							<input id="stripe_settings[test_mode]" name="stripe_settings[test_mode]" type="checkbox" value="1" <?php checked(1, $stripe_options['test_mode']); ?> />
							<label class="description" for="stripe_settings[test_mode]"><?php _e('Check this to use the plugin in test mode.', 'test_mode'); ?></label>
						</td>
					</tr>
				</tbody>
			</table>	
			
			<h3 class="title"><?php _e('API Keys', 'bsf_stripe'); ?></h3>
			<table class="form-table">
				<tbody>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('Live Secret', 'bsf_stripe'); ?>
						</th>
						<td>
							<input id="stripe_settings[live_secret_key]" name="stripe_settings[live_secret_key]" type="text" class="regular-text" value="<?php echo $stripe_options['live_secret_key']; ?>"/>
							<label class="description" for="stripe_settings[live_secret_key]"><?php _e('Paste your live secret key.', 'bsf_stripe'); ?></label>
						</td>
					</tr>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('Live Publishable', 'bsf_stripe'); ?>
						</th>
						<td>
							<input id="stripe_settings[live_publishable_key]" name="stripe_settings[live_publishable_key]" type="text" class="regular-text" value="<?php echo $stripe_options['live_publishable_key']; ?>"/>
							<label class="description" for="stripe_settings[live_publishable_key]"><?php _e('Paste your live publishable key.', 'bsf_stripe'); ?></label>
						</td>
					</tr>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('Test Secret', 'bsf_stripe'); ?>
						</th>
						<td>
							<input id="stripe_settings[test_secret_key]" name="stripe_settings[test_secret_key]" type="text" class="regular-text" value="<?php echo $stripe_options['test_secret_key']; ?>"/>
							<label class="description" for="stripe_settings[test_secret_key]"><?php _e('Paste your test secret key.', 'bsf_stripe'); ?></label>
						</td>
					</tr>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('Test Publishable', 'bsf_stripe'); ?>
						</th>
						<td>
							<input id="stripe_settings[test_publishable_key]" name="stripe_settings[test_publishable_key]" class="regular-text" type="text" value="<?php echo $stripe_options['test_publishable_key']; ?>"/>
							<label class="description" for="stripe_settings[test_publishable_key]"><?php _e('Paste your test publishable key.', 'bsf_stripe'); ?></label>
						</td>
					</tr>
				</tbody>
			</table>	
			
			<!--<table class="form-table">
				<tbody>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('Allow Recurring', 'bsf_stripe'); ?>
						</th>
						<td>
							<input id="stripe_settings[recurring]" name="stripe_settings[recurring]" type="checkbox" value="1" <?php checked(1, $stripe_options['recurring']); ?> />
							<label class="description" for="stripe_settings[recurring]"><?php _e('Check this to allow users to setup recurring payments.', 'bsf_stripe'); ?></label>
						</td>
					</tr>
				</tbody>
			</table> -->
			
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Options', 'mfwp_domain'); ?>" />
			</p>	
		</form>
		<div class="stripe-shortcode-display">
		<h2><?php _e('Generated Short Code', 'bsf_stripe'); ?></h2>
    	<pre id="stripe-shortcode-generator" style="padding:15px;background:#666;color:#fff;">[simple_stripe_payments_form]</pre>
    	</div>
	<?php
}


function bsf_stripe_register_settings() {
	// creates our settings in the options table
	register_setting('stripe_settings_group', 'stripe_settings');
}
add_action('admin_init', 'bsf_stripe_register_settings');