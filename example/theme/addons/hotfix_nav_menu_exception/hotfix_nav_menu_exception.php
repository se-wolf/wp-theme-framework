<?php

add_filter( 'wp_get_nav_menu_items' , function ( $items , $menu , $args ) {

	foreach ( $items as $key => $item ) if ( !property_exists( $items[ $key ] , 'description' ) ) $items[ $key ] -> description = '';
    return $items;

} , 10, 3);