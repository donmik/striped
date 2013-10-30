<?php
/**
 * Header
 *
 * @package stripedbydonmik
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(striped_by_donmik_options('sidebar_position').'-sidebar'); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
    
    <div id="togglebar">
        <header id="masthead_small" class="site-header_small" role="banner">
            <div class="site-branding">
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            </div>
            <div class="toggle"></div>
        </header>
    </div>
    
    <div id="sidebar">
        <header id="masthead" class="site-header" role="banner">
            <div class="site-branding">
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            </div>

            <nav id="site-navigation" class="main-navigation" role="navigation">
                <h1 class="menu-toggle"><?php _e( 'Menu', 'striped_by_donmik' ); ?></h1>
                <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'striped_by_donmik' ); ?></a>

                <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
            </nav><!-- #site-navigation -->
        </header><!-- #masthead -->

        <?php get_sidebar(); ?>

        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="site-info">
                <p>
                    <?php do_action( 'striped_by_donmik_credits' ); ?>
                    <a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Proudly powered by %s', 'striped_by_donmik' ), 'WordPress' ); ?></a>
                    <span class="sep"> | </span>
                    <?php printf( __( 'Theme: %1$s by %2$s.', 'striped_by_donmik' ), 'stripedbydonmik', '<a href="http://donmik.com" rel="author">donmik</a>' ); ?>
                    <span class="sep"> | </span>
                    <?php printf( __('Inspired by: %1$s from %2$s.', 'striped_by_donmik'), '<a href="http://html5up.net/striped/" rel="designer">Striped</a>', '<a href="http://html5up.net/ rel="designer">HTML5 Up</a>'); ?>
                </p>
            </div><!-- .site-info -->
        </footer><!-- #colophon -->
    </div>

	<div id="content" class="site-content">
