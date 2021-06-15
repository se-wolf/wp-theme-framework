<?php

class Theme {
	
	static $root , $slug , $enqueue_frontend , $enqueue_admin , $enqueue_editor;
	static $addons_dir		=	'/addons/';
	static $blocks_dir		=	'/blocks/';
	
	public static function init ( $config = false ) {
		
		self::register_config( $config );
		self::register_addons();
		self::register_blocks();
		self::register_frontend();
		self::register_admin();
		self::register_editor();
		
	}
	
	private static function register_config ( $config ) {
		
		self::$root				=	get_template_directory_uri();
		self::$enqueue_admin	=	array();
		self::$enqueue_frontend	=	array();
		if ( $config === false ) return;
		self::$slug				=	$config[ 'slug' ];
		if ( !empty( $config[ 'frontend' ] ) ) foreach( $config[ 'frontend' ] as $attachment ) self::attach( $attachment[ 'name' ] , $attachment[ 'url' ] , $attachment[ 'type' ] , 'frontend' , $attachment[ 'dependencies' ] , $attachment[ 'ver' ] , $attachment[ 'flag' ] );
		if ( !empty( $config[ 'admin' ] ) ) foreach( $config[ 'admin' ] as $attachment ) self::attach( $attachment[ 'name' ] , $attachment[ 'url' ] , $attachment[ 'type' ] , 'admin' , $attachment[ 'dependencies' ] , $attachment[ 'ver' ] , $attachment[ 'flag' ] );
		if ( !empty( $config[ 'editor' ] ) ) foreach( $config[ 'editor' ] as $attachment ) self::attach( $attachment[ 'name' ] , $attachment[ 'url' ] , $attachment[ 'type' ] , 'editor' , $attachment[ 'dependencies' ] , $attachment[ 'ver' ] , $attachment[ 'flag' ] );
		if ( !empty( $config[ 'support' ] ) ) foreach ( $config[ 'support' ] as $key => $args ) if ( is_array( $args ) ) { add_theme_support( $key , $args ); } else { add_theme_support( $key ); }
		if ( !empty( $config[ 'menus' ] ) ) add_action( 'after_setup_theme' , function () use( $config ) { register_nav_menus( $config[ 'menus' ] ); } );
		if ( !empty( $config[ 'sidebars' ] ) ) add_action( 'widgets_init' , function () use( $config ) { foreach ( $config[ 'sidebars' ] as $sidebar ) register_sidebar( $sidebar ); } );
		if ( !empty( $config[ 'upload_mimes' ] ) ) add_filter( 'upload_mimes' , function ( $mime ) use( $config ) { foreach ( $config[ 'upload_mimes' ] as $key => $value ) $mime[ $key ] = $value; return $mime; } );
		if ( !empty( $config[ 'block_categories' ] ) ) add_filter( 'block_categories' , function ( $categories ) use( $config ) { return array_merge( $categories , $config[ 'block_categories' ] ); die( json_encode( $categories ) ); } );
		if ( !empty( $config[ 'textdomain' ] ) ) load_theme_textdomain( $config[ 'textdomain' ][ 'domain' ] ?? self::$slug , get_template_directory() . '/' . ltrim( $config[ 'textdomain' ][ 'dir' ] , '/' ) );

	}
	
	private static function register_addons () {
		foreach ( $addons = new DirectoryIterator( __DIR__ . self::$addons_dir ) as $item ) if ( $item -> isDir() && !$item -> isDot() ) if ( file_exists( $item -> getPathname() . '/' . $item -> getBasename() . '.php' ) ) include( $item -> getPathname() . '/' . $item -> getBasename() . '.php' );
	}

	private static function register_blocks () {
		require_once( __DIR__ . '/block_factory.php' );
		foreach ( $blocks = new DirectoryIterator( __DIR__ . self::$blocks_dir ) as $item ) if ( $item -> isDir() && !$item -> isDot() ) if ( file_exists( $item -> getPathname() . '/' . $item -> getBasename() . '.php' ) ) include( $item -> getPathname() . '/' . $item -> getBasename() . '.php' );
	}
	
	private static function register_frontend () {
		if ( is_admin() || is_login_page() ) return;
		self::enqueue( self::$enqueue_frontend );
	}
	
	private static function register_admin () {
		self::enqueue( self::$enqueue_admin );
	}
	
	private static function register_editor () {
		if ( is_array( self::$enqueue_editor ) && !current_theme_supports( 'editor-styles' ) ) add_theme_support( 'editor-styles' );
		foreach ( self::$enqueue_editor as $attachment ) add_editor_style( $attachment -> url  );
	}
	
	public static function attach ( $name , $url = '' , $type = 'style' , $location = 'frontend' , $dependencies = array() , $ver = false , $flag = 'all' ) {
		if ( $location == 'admin' ) self::$enqueue_admin[] = (object)array( 'type' => $type , 'name' => $name , 'url' => self::$root . '/' . ltrim( $url , '/' ) , 'dependencies' => $dependencies , 'ver' => $ver , 'flag' => $flag );
		if ( $location == 'editor' ) self::$enqueue_editor[] = (object)array( 'type' => $type , 'name' => $name , 'url' => ltrim( $url , '/' ) , 'dependencies' => $dependencies , 'ver' => $ver , 'flag' => $flag );
		if ( $location == 'frontend' ) self::$enqueue_frontend[] = (object)array( 'type' => $type , 'name' => $name , 'url' => self::$root . '/' . ltrim( $url , '/' ) , 'dependencies' => $dependencies , 'ver' => $ver , 'flag' => $flag );
	}
	
	private static function enqueue ( $attachments ) {
		if ( !is_array( $attachments ) ) return;
		foreach ( $attachments as $attachment ) {
			if ( $attachment -> type == 'style' ) 	wp_enqueue_style ( $attachment -> name , $attachment -> url , $attachment -> dependencies , $attachment -> ver , $attachment -> flag );
			if ( $attachment -> type == 'script' ) 	wp_enqueue_script( $attachment -> name , $attachment -> url , $attachment -> dependencies , $attachment -> ver , !is_bool( $attachment -> flag ) ? false : $attachment -> flag );
		}
	}
	
}