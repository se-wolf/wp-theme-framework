<?php

if ( !defined( 'ABSPATH' ) ) return;

add_action( 'init' , function() {
	wp_register_script( 'metaComponents' , get_template_uri_by_dir( __DIR__ , 'metacomponents.js' ) , array( 'wp-plugins' , 'wp-edit-post' , 'wp-element' , 'wp-components' ) , time() );
} );