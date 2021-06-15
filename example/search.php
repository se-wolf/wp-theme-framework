<?php get_header(); ?>

<main>
	<div class="inside">
		<h1><?php _e( 'Results' , 'foo_domain' ); ?></h1>
		<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
		<div class="search-item">
			<div class="search-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> (<?php the_date(); ?>)</div>
			<div class="search-item-excerpt"><?php the_excerpt(); ?></div>
		</div>
		<?php } the_pagination(); 
		} else { ?>
		<div class="search-error">
			<p><?php _e( 'I haven\'t found anything. Please try using different keywords.' , 'foo_domain' ); ?></p>
		</div>
		<?php } ?>
	</div>
</main>

<?php get_footer(); ?>