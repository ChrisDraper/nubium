<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Nubium
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'nubium' ); ?></a>

	<header id="masthead" class="site-header fw" role="banner">
		<div class="site-branding container">
			<h1 class="site-title six columns"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <nav class="top-nav six columns">
                <?php
                    wp_nav_menu( array('container_class' => 'menu-header',
                    'theme_location' => 'secondary') ); ?>
            </nav>
		</div><!-- .site-branding -->
        <div class="row">
        	<div class="header-search six columns offset-by-six">
				<?php get_search_form(); ?>
            </div>
        </div>
        
		<nav id="site-navigation" class="main-navigation fw" role="navigation">
			<button id="nav-button" class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Menu', 'nubium' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
