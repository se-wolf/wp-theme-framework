<?php get_header(); ?>

<main id="post-single">
	<div class="inside">
	<?php while ( have_posts() ) { the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<div class="post-meta">
			<span class="post-date"><?php echo date( get_option( 'date_format' ) , strtotime( $post -> post_date ) ); ?></span>
			<span class="post-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) , get_the_author_meta( 'user_nicename' ) ); ?>"><?php if ( get_the_author_meta( 'first_name' ) || get_the_author_meta( 'last_name' ) ) { echo get_the_author_meta( 'first_name' ) . ' ' . get_the_author_meta( 'last_name' ); } else { the_author(); } ?></a></span>
		</div>
		<?php the_content(); ?>
	<?php } ?>
	</div>
</main>

<?php if ( is_active_sidebar( 'aside-widget-area' ) ) { ?>
<aside>
	<div class="inside">
		<?php dynamic_sidebar( 'aside-widget-area' ); ?>
	</div>
</aside>
<?php } ?>

<?php get_footer(); ?>