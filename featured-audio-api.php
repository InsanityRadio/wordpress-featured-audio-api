<?php
/**
 * Plugin Name: Featured Audio API
 * Description: Add featured audio API endpoints to the WP API. 
 * Version: 1.0
 * Author: Jamie Woods
 * Author URI: https://tech.insanityradio.com
 * License: Public Domain

*/

register_activation_hook(__FILE__, 'featured_audio_api_activate');
add_action( 'rest_api_init', 'featured_audio_register_api_endpoint' );


function featured_audio_api_activate () {
	if (!is_plugin_active('featured-audio/featured-audio.php')) {
		echo '<h3>Required featured audio plugin</h3>';
		@trigger_error(__('Please install Featured Audio before activating.', 'fa'), E_USER_ERROR);
	}
}

function featured_audio_register_api_endpoint() {
	register_rest_field('post', 'featured_audio_url', array(
		'get_callback' => 'featured_audio_get_api',
		'update_callback' => null,
		'schema' => null
	));
	
}

function featured_audio_get_api ($object, $field_name, $request ) {
	return get_featured_audio_src($object->id);
}
