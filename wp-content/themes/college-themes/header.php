<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package college
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <script type="text/javascript">
        var ajax_url = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
    </script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <div class="mobil_menu_wrap">
        <div id="mobil_nav">
            <?php wp_nav_menu(array('theme_location' => 'menu-1', 'menu_id' => 'primary-menu')); ?>
        </div><!-- #mobil_nav -->
    </div><!-- #mobil_menu_wrap -->

    <div class="mobile-nav-button">
        <div class="mobile-nav-button__line"></div>
        <div class="mobile-nav-button__line"></div>
        <div class="mobile-nav-button__line"></div>
    </div><!-- .mobile-nav-button -->

    <div class="widget_fb">
        <span>
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/5678.png" alt="slide_1"/>
        </span>

        <div class="widget_text_1">
            <p>follow us</p>
        </div>
        <div class="widget_text_2">
            <p>on facebook</p>
        </div>
    </div><!-- widget facebook -->

    <?php
    get_template_part('inc/accessibility');
    ?>

    <header id="masthead" class="site_header" role="banner">
        <div class="container">
            <?php dynamic_sidebar('logo_top_img'); ?><!-- .logo -->
            <nav id="site-navigation" class="main_navigation" role="navigation">
                <span class="accessibility">
                    <a href="#" class="link_accessibility">
                       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/invalide.png" class="handicap-icon" alt="college"/>
                    </a>
                </span><!-- .accessibility -->
                <?php wp_nav_menu(array('theme_location' => 'menu-1', 'menu_id' => 'primary-menu')); ?>
            </nav><!-- #site-navigation -->
        </div><!-- .container -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
