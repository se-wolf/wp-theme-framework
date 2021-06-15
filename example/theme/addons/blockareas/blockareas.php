<?php

if ( !defined( 'ABSPATH' ) ) exit;

class BlockAreas {
	
	public static function init () {
		
		add_action( 'init', array( __CLASS__ , 'register_cpt' ) );
		include( __DIR__ . '/classes/widget.php' );
	
	}

	public static function register_cpt () {
		
		register_post_type( 'blockarea' , array(
			
			'labels' => array(
				'name' => __( 'Blockbereiche' ) ,
				'menu_name' => __( 'Blockbereiche' ) , 
				'singular_name' => __( 'Blockbereich' ) , 
				'add_new' => __( 'Blockbereich hinzufügen' ) , 
				'add_new_item' => __( 'Neuen Blockbereich hinzufügen' ) , 
				'edit_item' => 'Blockbereich bearbeiten' , 
				'all_items' => __( 'Blockbereiche' )
			) ,
			'public' => true , 
			'show_in_menu' => 'themes.php' , 
			'menu_position' => 30 , 
			'menu_icon' => 'dashicons-text-page' , 
			'show_in_rest' => true , 
			'supports' => array( 'title' , 'editor' , 'custom-fields' )

		) );
		
	}

	public static function get ( $option = array() ) {
		
		if ( is_numeric( $option ) ) {
			$query		=	new WP_Query( array( 'post_type' => 'blockarea' , 'post_status' => 'publish' , 'p' => $option ) );
		} else {
			$query 		= 	new WP_Query( array( 'post_type' => 'blockarea' , 'post_status' => 'publish' , 'posts_per_page' => $option[ 'limit' ] ?? -1 , 'paged' => get_query_var( 'page' , 1 ) ) );
		}
		
		return $query -> post_count > 0 ? array_map( array( __CLASS__ , 'sanitize_posts' ) , $query -> posts ) : array();
		
	}
	
	private static function sanitize_posts ( $post ) {
		
		return (object)array(
			'id' 				=> 	$post -> ID , 
			'title' 			=> 	$post -> post_title , 
			'content' 			=> 	has_blocks( $post ) ? do_blocks( $post -> post_content ) : self::filter_content( $post -> post_content ) , 
		);

	}
	
	private static function filter_content ( $string ) {
		return wptexturize( convert_smilies( wpautop( $string ) ) );
	}
	
}

\BlockAreas::init();