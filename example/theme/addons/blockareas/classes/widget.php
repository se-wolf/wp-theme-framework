<?php

namespace BlockAreas;

if ( !defined( 'ABSPATH' ) ) exit;

class Widget extends \WP_Widget {

	function __construct () {
		
		parent::__construct( 'widget_blockareas' , __( 'Blockbereiche' , 'widget_blockareas' ) , array( 'description' => __( 'Füge Blockbereiche in Widget Areas ein.' , 'widget_blockareas' ) ) );
		add_action( 'admin_enqueue_scripts' , array( __CLASS__ , 'load_admin' ) );
		add_action( 'wp_enqueue_scripts' , array( __CLASS__ , 'load_frontend' ) );
			
	}
 
	public function widget ( $args , $instance ) { 
		if ( !is_numeric( $instance[ 'blockarea' ] ) ) return;
		echo $args[ 'before_widget' ];
		echo \BlockAreas::get( (int)$instance[ 'blockarea' ] )[0] -> content;
		echo $args['after_widget']; 
	}
         
	public function form ( $instance ) { 
		$areas = \BlockAreas::get();
		?><div id="widget-blockareas">
			<p><b>Blockbereich:</b></p>
			<p>
				<select name="<?php echo $this -> get_field_name( 'blockarea' ); ?>">
					<?php if ( empty( $areas ) ) { ?><option value=false>Keine Blockbereiche angelegt</option><?php } ?>
					<?php foreach ( $areas as $area ) { ?><option value="<?php echo $area -> id; ?>" <?php selected( $instance[ 'blockarea' ] , $area -> id ); ?>><?php echo $area -> title; ?></option><?php } ?>
				</select>
			</p>
		</div><?php 
	}
     
	public function update ( $new , $old ) {
		return $new;
	}
	
	public static function load_widget () { register_widget( __CLASS__ ); }
	
	public static function load_admin () {}
	
	public static function load_frontend () {}

}

add_action( 'widgets_init' , array( __NAMESPACE__ . '\Widget' , 'load_widget' ) );