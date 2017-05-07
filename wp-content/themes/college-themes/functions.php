<?php
/**
 * college functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package college
 */

if ( ! function_exists( 'college_themes_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function college_themes_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on college, use a find and replace
	 * to change 'college-themes' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'college-themes', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'college-themes' ),
        'menu-2' => esc_html__( 'footer_left', 'college-themes' ),
        'menu-3' => esc_html__( 'footer_right', 'college-themes' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'college_themes_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'college_themes_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function college_themes_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'college_themes_content_width', 640 );
}
add_action( 'after_setup_theme', 'college_themes_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function college_themes_widgets_init() {
//	register_sidebar( array(
//		'name'          => esc_html__( 'Sidebar', 'college-themes' ),
//		'id'            => 'sidebar-1',
//		'description'   => esc_html__( 'Add widgets here.', 'college-themes' ),
//		'before_widget' => '<section id="%1$s" class="widget %2$s">',
//		'after_widget'  => '</section>',
//		'before_title'  => '<h2 class="widget-title">',
//		'after_title'   => '</h2>',
//	) );

    register_sidebar( array(
        'name'          => esc_html__( 'Logo_top_img' ),
        'id'            => "logo_top_img",
        'description'   => 'Logo image in the header',
        'class'         => 'logo',
        'before_widget' => '<div class="logo"><a href="' . site_url() . '">',
        'after_widget'  => '</a></div>',
        'before_title'  => false,
        'after_title'   => false,
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Logo_bottom_img' ),
        'id'            => "logo_bottom_img",
        'description'   => 'Logo image in footer',
        'class'         => 'logo',
        'before_widget' => '<div class="footer_logo"><a href="' . site_url() . '">',
        'after_widget'  => '</a></div>',
        'before_title'  => false,
        'after_title'   => false,
    ) );

}
add_action( 'widgets_init', 'college_themes_widgets_init' );

/**
 * Enqueue styles.
 */
function college_themes_style() {
	wp_enqueue_style( 'college-themes-style', get_stylesheet_uri() );

    wp_enqueue_style( 'college_themes-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.css' );

    wp_enqueue_style( 'college_themes-custom_scroll', get_template_directory_uri() . '/libs/customscroll/jquery.mCustomScrollbar.css' );

    wp_enqueue_style( 'college_themes-slick_style', get_template_directory_uri() . '/libs/slick/slick.css' );

    wp_enqueue_style( 'college_themes-select_style', get_template_directory_uri() . '/libs/select2-master/css/select2.min.css' );

    wp_enqueue_style( 'college_themes-slick_themes', get_template_directory_uri() . '/libs/slick/slick-theme.css' );

    wp_enqueue_style( 'college_themes-fancy_box', get_template_directory_uri() . '/libs/fancy_box/jquery.fancybox-min.css' );

    wp_enqueue_style( 'college_themes-main-style', get_template_directory_uri() . '/stylesheets/main.css' );

    wp_enqueue_style( 'college_themes-media-style', get_template_directory_uri() . '/stylesheets/media.css' );

    wp_enqueue_style( 'college_themes-edit-style', get_template_directory_uri() . '/edit_themes.css' );
}
add_action( 'wp_enqueue_scripts', 'college_themes_style' );

/**
 * Enqueue scripts.
 */
function college_themes_scripts() {

    wp_enqueue_script( 'college-themes-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script( 'college_themes-customscroll', get_template_directory_uri() . '/libs/customscroll/jquery.mCustomScrollbar.js', array('jquery'), '20151215', true );

    wp_enqueue_script( 'college_themes-mousweheel', get_template_directory_uri() . '/libs/customscroll/jquery.mousewheel.min.js', array('jquery'), '20151215', true );

    wp_enqueue_script( 'college_themes-slick', get_template_directory_uri() . '/libs/slick/slick.min.js', array('jquery'), '20151215', true );

    wp_enqueue_script( 'college_themes-fancy_box.js', get_template_directory_uri() . '/libs/fancy_box/jquery.fancybox.pack.js', array('jquery'), '20151215', true );

    wp_enqueue_script( 'college_themes-select.js', get_template_directory_uri() . '/libs/select2-master/js/select2.full.js', array('jquery'), '20151215', true );

    wp_enqueue_script( 'college_themes-my_app', get_template_directory_uri() . '/js/main_app.js', array('jquery'), '20151215', true );

    wp_enqueue_script( 'college_themes-accessibility', get_template_directory_uri() . '/js/accessibility.js', array('jquery'), '20151215', true );

}
add_action( 'wp_enqueue_scripts', 'college_themes_scripts' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Count views posts
 */
require get_template_directory() . '/inc/kama_view_post.php';

/**
 * My hooks
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * My ajax
 */
require get_template_directory() . '/inc/ajax.php';

