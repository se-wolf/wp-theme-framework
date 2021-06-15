<?php get_header(); ?>

<?php while ( have_posts() ) { 
	?><h1><?php the_title(); ?></h1><?php
	the_post();
	the_content();
} ?>

<?php get_footer(); ?>