<?php
function wp_code_highlight_admin() {
	add_options_page('WP Code Highlight Options', 'WP Bootstrap code','manage_options', __FILE__, 'wp_code_highlight_options');
}
function wp_code_highlight_options(){
	add_option('wp_code_highlight_button','enable');
    add_option('wp_code_highlight_themes','wp-code-highlight');
	add_option('wp_code_highlight_line_numbers','disable');
	add_option('wp_code_highlight_deactivate','yes');
?>
<div class="wrap">
	
<?php screen_icon(); ?>
<h2>WP Bootstrap highlighting of code</h2>

<form action="options.php" method="post" enctype="multipart/form-data" name="wp_code_highlight_form">
<?php wp_nonce_field('update-options'); ?>

<table class="form-table">
	<tr valign="top">
		<th scope="row">
			<?php _e('Code Button','WP-Code-Highlight'); ?>
		</th>
		<td>
			<label>
				<input name="wp_code_highlight_button" type="radio" value="enable"<?php if (get_option('wp_code_highlight_button') == 'enable') { ?> checked="checked"<?php } ?> />
				<?php _e('enable','WP-Code-Highlight'); ?>
			</label>
			<label>
				<input name="wp_code_highlight_button" type="radio" value="disable"<?php if (get_option('wp_code_highlight_button') == 'disable') { ?> checked="checked"<?php } ?> />
				<?php _e('disable','WP-Code-Highlight'); ?>
			</label>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<?php _e('Highlight Themes','WP-Code-Highlight'); ?>
		</th>
		<td>
			<label>
				<input name="wp_code_highlight_themes" type="radio" value="wp-code-highlight"<?php if (get_option('wp_code_highlight_themes') == 'wp-code-highlight') { ?> checked="checked"<?php } ?> />
				bootstrap
			</label>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<?php _e('Line Numbers','WP-Code-Highlight'); ?>
		</th>
		<td>
			<label>
				<input name="wp_code_highlight_line_numbers" type="radio" value="enable"<?php if (get_option('wp_code_highlight_line_numbers') == 'enable') { ?> checked="checked"<?php } ?> />
				<?php _e('enable','WP-Code-Highlight'); ?>
			</label>
			<label>
				<input name="wp_code_highlight_line_numbers" type="radio" value="disable"<?php if (get_option('wp_code_highlight_line_numbers') == 'disable') { ?> checked="checked"<?php } ?> />
				<?php _e('disable','WP-Code-Highlight'); ?>
			</label>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<?php _e('Delete Options','WP-Code-Highlight'); ?>
		</th>
		<td>
			<label>
				<input type="checkbox" name="wp_code_highlight_deactivate" value="yes" <?php if(get_option("wp_code_highlight_deactivate")=='yes') echo 'checked="checked"'; ?> />
				<?php _e('Delete options while deactivate this plugin.','WP-Code-Highlight'); ?>
			</label>
		</td>
	</tr>
</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="wp_code_highlight_button,wp_code_highlight_themes,wp_code_highlight_line_numbers,wp_code_highlight_deactivate" />

<p class="submit">
<input type="submit" class="button-primary" name="Submit" value="<?php _e('Save Changes'); ?>" />
</p>

</form>

<h3>Basic Usage</h3>
Wrap code blocks with <code>&lt;pre&gt;</code> and <code>&lt;/pre&gt;</code> and inline with <code>&lt;code&gt;</code> and <code>&lt;/code&gt;</code> <br/> for more information, please visit: <a href="http://imshanks.com/bootstrap-highlighting-of-code/" target="_blank">WP Bootstrap highlighting of code</a> 

<h3>Example</h3>
<code>&lt;code&gt;</code>
&lt;div&gt;
<code>&lt;/code&gt;</code>
<br /><br />
<code>&lt;pre&gt;</code><br />
     &lt;div class="hello" id="world"&gt;imshanks.com&lt;/div&gt;<br />
<code>&lt;/pre&gt;</code>


<br /><br />


</div>
<?php 
}
add_action('admin_menu', 'wp_code_highlight_admin');
?>