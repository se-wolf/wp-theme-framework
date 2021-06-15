<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no" />
		<?php wp_head(); ?>
	</head>

<body id="_top" <?php body_class(); ?>>

	<input type="checkbox" id="hamburger-cb" />
	
	<header id="branding">
		<div class="wrapper">
			<div class="inside">
				<div id="site-identity">
					<?php if ( has_custom_logo() ) { ?><div id="blog-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><img src="<?php the_logo(); ?>" alt="<?php bloginfo( 'description' ); ?>" /></a></div><?php } ?>
					<?php if ( get_theme_mod( 'sticky_logo' ) ) { ?><div id="blog-sticky-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><img src="<?php the_sticky_logo(); ?>" alt="<?php bloginfo( 'description' ); ?>" /></a></div><?php } ?>
					<?php if ( get_theme_mod( 'header_text' ) == 1 || has_custom_logo() === false ) { ?>
					<div id="blog-name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></div>
					<div id="blog-description"><?php bloginfo( 'description' ); ?></div>
					<?php } ?>
				</div>
				<label  id="hamburger" for="hamburger-cb"><span></span><span></span><span></span></label>
				<div id="main-navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'main-menu' , 'container' => 'nav' , 'container_id' => 'main' ) ); ?>
				</div>
			</div>
		</div>
	</header>

	<main id="_content">
		<div class="wrapper">
			<div class="inside">