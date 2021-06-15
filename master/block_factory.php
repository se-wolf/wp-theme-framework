<?php

class BlockFactory {
	
	static $block			=	'';

	static $title			=	'';
	static $namespace       =   '';
	static $slug            =   '';
	static $is_dynamic      =   false;
	static $category		=	'common';
	static $icon			=	'smiley';
	static $ver				=	'0';

	static $attributes		=	array( 
		'title' => array( 'type' => 'string' ) , 
	);

	static $block_dir		=	'';

	static $editor_js		=	'';
	static $editor_css		=	'';
	static $editor_dependencies	=	array();

	static $block_js		=	'';
	static $block_css		=	'';
	static $block_dependencies	=	array();

	static $dynamic_tpl		=	'';

	static function init () {
		
		if ( static::$editor_css && !current_theme_supports( 'editor-styles' ) ) add_theme_support( 'editor-styles' );
		add_action( 'init' , array( static::$block , 'register_block' ) );
		add_action( 'admin_enqueue_scripts' , array( static::$block , 'load_admin' ) );
		add_action( 'enqueue_block_editor_assets' , array( static::$block , 'load_editor' ) );
		add_action( 'wp_enqueue_scripts' , array( static::$block , 'load_frontend' ) );

	}

	static function register_block () {
		
		if ( !empty( static::$editor_js ) ) wp_register_script( 
			static::$namespace . '-' . static::$slug . '-editor' , 
			get_template_uri_by_dir( static::$block_dir , static::$editor_js ) , 
			array_merge( array( 'jquery' , 'wp-blocks' , 'wp-element' , 'wp-editor' , 'wp-block-editor' , 'wp-components' , 'wp-data' ) , static::$editor_dependencies ) , 
			static::$ver
		);
		
		if ( !empty( static::$block_css ) ) wp_register_style( static::$namespace . '-' . static::$slug , get_template_uri_by_dir( static::$block_dir , static::$block_css ) , static::$ver );
		if ( !empty( static::$block_js ) ) wp_register_script( static::$namespace . '-' . static::$slug , get_template_uri_by_dir( static::$block_dir , static::$block_js ) , static::$block_dependencies , static::$ver );
		
		if ( !empty( static::$editor_css ) ) add_editor_style( str_replace( get_template_directory() , '' , __DIR__ ) . '/' . ltrim( static::$editor_css , '/' ) );
		if ( !empty( static::$editor_js ) ) wp_localize_script( static::$namespace . '-' . static::$slug . '-editor' , 'blockSettings' , static::localize_vars() );
		if ( !empty( static::$editor_js ) ) register_block_type( static::$namespace . '/' . static::$slug , array(
			'editor_script' => static::$namespace . '-' . static::$slug . '-editor' , 
			'editor_style' => static::$namespace . '-' . static::$slug . '-editor' , 
			'script' => static::$namespace . '-' . static::$slug , 
			'style' => static::$namespace . '-' . static::$slug , 
			'render_callback' => static::$is_dynamic ? array( static::$block , 'render_callback' ) : array() , 
			'attributes' => static::$attributes , 
		) );

	}

	static function render_callback ( $attributes ) {
		
		ob_start();
		if ( !empty( static::$dynamic_tpl ) ) include( static::$block_dir . '/' . ltrim( static::$dynamic_tpl , '/' ) );
		return ob_get_clean();

	}

	static function localize_vars () {

		return array( 
			'title' => __( static::$title , \Theme::$slug ) , 
			'name' => static::$namespace . '/' . static::$slug , 
			'category' => static::$category , 
			'icon' => static::$icon , 
			'attributes' => static::$attributes , 
		);

	}

	static function load_admin () {}
	
	static function load_editor () {}

	static function load_frontend () {}

}