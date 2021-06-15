<?php 

require_once( __DIR__ . '/theme/missing-functions.php' );
require_once( __DIR__ . '/theme/theme.php' );

Theme::init( 
	array(
		'slug' => 'foo_domain' , 
		'editor' => array(
			array( 'type' => 'style' , 'name' => 'editor-style' , 'url' => 'css/editor.css' ) , 
			array( 'type' => 'style' , 'name' => 'colors' , 'url' => 'css/colors.css' ) , 
		) , 
		'frontend' => array(
			array( 'type' => 'style' , 'name' => 'fonts' , 'url' => 'https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap' ) , 
			array( 'type' => 'style' , 'name' => 'dashicons' ) , 
			array( 'type' => 'style' , 'name' => 'style' , 'url' => 'css/style.css' ) , 
			array( 'type' => 'style' , 'name' => 'custom-colors' , 'url' => 'css/colors.css' ) , 
			array( 'type' => 'style' , 'name' => 'responsive' , 'url' => 'css/responsive.css' ) , 
		) , 
		'admin' => array(
			array( 'type' => 'style' , 'name' => 'fonts' , 'url' => 'https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap' ) , 
		) , 
		'support' => array(
			'title-tag' => true , 
			'custom-logo' => array( 'width' => 300 , 'height' => 100 , 'flex-height' => true , 'flex-width' => true , 'header-text' => array( 'site-title' , 'site-description' ) ) , 
			'post-thumbnails' => true , 
			'html5' => array( 'search-form' ) , 
			'align-wide' => true , 
			'editor-color-palette' => array(
				array( 'name' => __( 'White' , 'foo_domain' ) , 'slug' => 'white' , 'color' => '#FFFFFF' ) , 
				array( 'name' => __( 'Black' , 'foo_domain' ) , 'slug' => 'black' , 'color' => '#000000' ) , 
				array( 'name' => __( 'Gray' , 'foo_domain' ) , 'slug' => 'grey' , 'color' => '#777777' ) , 
				array( 'name' => __( 'Red' , 'foo_domain' ) , 'slug' => 'red' , 'color' => '#E20000' ) , 
				
			) , 
		) , 
		'menus' => array( 
			'main-menu' => __( 'Main menu' , 'foo_domain' ) , 
			'footer-menu' => __( 'Footer menu' , 'foo_domain' ) , 
		) , 
		'sidebars' => array(
			array( 'id' => 'footer-widget-area' , 'name' => __( 'Footer Widget Area' , 'foo_domain' ) , 'before_widget' => '<div id="%1$s" class="widget %2$s">' , 'after_widget' => '</div>' ) ,  
		) , 
		'upload_mimes' => array( 'svg' => 'image/svg+xml' ) , 
		'block_categories' => array() , 
		'textdomain' => array( 'dir' => 'lang' ) , 
	) 
);