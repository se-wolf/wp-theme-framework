<?php get_header(); ?>

<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
	<div class="blog-entry">
		<div class="inside">
			<?php if ( has_post_thumbnail() ) { ?>
			<div class="blog-entry-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="sizeify" data-ratio="16/10" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
					<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" />
				</a>
			</div>
			<?php } ?>
			<div class="blog-entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></div>
			<div class="blog-entry-content"><?php the_excerpt(); ?></div>
			<div class="blog-entry-meta"><?php the_date(); ?></div>
		</div>
	</div>
<?php } } ?>
<div class="pagination"><?php the_pagination(); ?></div>

<?php get_footer(); ?>