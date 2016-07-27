<?php
/*
 * Theme Settings
 * 
 * @package sonorous
 * @subpackage Template
 */
add_action( 'admin_menu', 'sonorous_theme_admin_setup' );

function sonorous_theme_admin_setup() {
    
	global $theme_settings_page;
	
	/* Get the theme settings page name */
	$theme_settings_page = 'appearance_page_theme-settings';

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* Create a settings meta box only on the theme settings page. */
	add_action( 'load-appearance_page_theme-settings', 'sonorous_theme_settings_meta_boxes' );

	/* Add a filter to validate/sanitize your settings. */
	add_filter( "sanitize_option_{$prefix}_theme_settings", 'sonorous_theme_validate_settings' );
	
	/* Enqueue styles */
	add_action( 'admin_enqueue_scripts', 'sonorous_admin_scripts' );

}

/* Adds custom meta boxes to the theme settings page. */
function sonorous_theme_settings_meta_boxes() {

	/* Add a custom meta box. */
	add_meta_box(
		'sonorous-theme-meta-box',			// Name/ID
		__( 'General', 'sonorous' ),	// Label
		'sonorous_theme_meta_box',			// Callback function
		'appearance_page_theme-settings',		// Page to load on, leave as is
		'normal',					// Which meta box holder?
		'high'					// High/low within the meta box holder
	);

	/* Add additional add_meta_box() calls here. */
}

/* Function for displaying the first meta box. */
function sonorous_theme_meta_box() { ?>

	<table class="form-table">
	
		<!-- Logo upload -->

		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'sonorous_logo_url' ); ?>"><?php _e( 'Logo:', 'sonorous' ); ?></label>
			</th>
			<td>
				<input type="text" id="<?php echo hybrid_settings_field_id( 'sonorous_logo_url' ); ?>" name="<?php echo hybrid_settings_field_name( 'sonorous_logo_url' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'sonorous_logo_url' ) ); ?>" />
				<input id="sonorous_logo_upload_button" class="button" type="button" value="Upload" />
				<p class="description"><?php _e( 'Upload image for logo. Once uploaded, click the Insert Into Post button. If that does not work, copy the address of the image and paste it in the input field above. Next, click on Save Settings buton at the bottom of this page. The image will automatically display here after settings are saved.', 'sonorous' ); ?></p>
				
				<?php /* Display uploaded image */
				if ( hybrid_get_setting( 'sonorous_logo_url' ) ) { ?>
                    <p><img src="<?php echo hybrid_get_setting( 'sonorous_logo_url' ); ?>" alt=""/></p>
				<?php } ?>
			</td>
		</tr>
		
		<!-- End custom form elements. -->
	</table><!-- .form-table --><?php
	
}	

/* Validate theme settings. */
function sonorous_theme_validate_settings( $settings ) {

	$settings['sonorous_logo_url'] = esc_url_raw( $settings['sonorous_logo_url'] );

    /* Return the array of theme settings. */
    return $settings;
}

/* Enqueue scripts (and related stylesheets) */
function sonorous_admin_scripts( $hook_suffix ) {
    
    global $theme_settings_page;
	
    if ( $theme_settings_page == $hook_suffix ) {

	    wp_enqueue_script( 'sonorous-admin', get_template_directory_uri() . '/js/sonorous-admin.js', array( 'jquery', 'media-upload' ), '20120819', false );

    }
}

?>