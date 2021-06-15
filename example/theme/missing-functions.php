<?php

function is_login_page () { return in_array( $GLOBALS[ 'pagenow' ] , array( 'wp-login.php' , 'wp-register.php' ) ); }

function get_template_uri_by_dir ( $dir , $file = '' ) { return get_template_directory_uri() . str_replace( str_replace( '\\' , '/' , get_template_directory() ) , '' , str_replace( '\\' , '/' , $dir ) . ( !empty( $file ) ? '/' . ltrim( $file , '/' ) : '' ) ); }

function the_pagination () {
	$args		=	array( 'prev_text' => '' , 'next_text' => '' );
	echo '<nav class="pagination">' . paginate_links( $args ) . '</nav>';
}

function the_logo () {
	$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'medium' );
	echo !empty( $logo ) ? esc_url( $logo[0] ) : false;
}

function has_children ( $args = array() ) {
	return count( get_children( array_merge( array( 'post_parent' => is_front_page() ? 0 : get_queried_object_id() ) , $args ) ) ) > 0;
}

function has_siblings ( $post_id = null , $args = array() ) {
	$post = get_post( $post_id );
	return count( get_children( array_merge( $args , array( 'post_parent' => $post -> post_parent ) ) ) ) > 0;
}

function calling_function (){ $e = new Exception(); $t = $e -> getTrace(); return $t; }

function rip_tags ($str) { $str = preg_replace ('/<[^>]*>/', ' ', $str); $str = str_replace("\r", '', $str); $str = str_replace("\n", ' ', $str); $str = str_replace("\t", ' ', $str); $str=trim(preg_replace('/ {2,}/',' ',$str));return $str; }

//Update jQuery Version
function replace_core_jquery_version() {
	wp_deregister_script( 'jquery-core' );
	wp_deregister_script( 'jquery-migrate' );
	wp_register_script( 'jquery-core' , get_template_directory_uri() . '/js/jquery-3.4.1.min.js' , array() , '3.4.1' );
	wp_register_script( 'jquery-migrate' , get_template_directory_uri() . '/js/jquery-migrate-3.1.0.min.js' , array() , '3.1.0' );
}
add_action( 'wp_enqueue_scripts', 'replace_core_jquery_version' );
// Replacing jQuery in wp_admin is not recommended!
//add_action( 'admin_enqueue_scripts', 'replace_core_jquery_version' );

// Add constant for pages with block editor
add_action( 'enqueue_block_editor_assets' , function () { define( 'WP_BLOCK_EDITOR' , true ); } );

/**
 * Check if Block Editor is active.
 * Must only be used after plugins_loaded action is fired.
 *
 * @return bool
 */
function is_block_editor () {
	
	if ( has_filter( 'replace_editor' , 'gutenberg_init' ) === false && !version_compare( $GLOBALS[ 'wp_version' ] , '5.0-beta', '>' ) ) return false;

    if ( has_classic_editor() ) {
        $editor_option       = get_option( 'classic-editor-replace' );
        $block_editor_active = array( 'no-replace', 'block' );
		return in_array( get_option( 'classic-editor-replace' ) , array( 'no-replace' , 'block' ) , true );
    }

	return true;
	
}

/**
 * Check if Classic Editor plugin is active.
 *
 * @return bool
 */
function has_classic_editor () {
    if ( ! function_exists( 'is_plugin_active' ) ) include_once ABSPATH . 'wp-admin/includes/plugin.php';
    if ( is_plugin_active( 'classic-editor/classic-editor.php' ) ) return true;
    return false;
}