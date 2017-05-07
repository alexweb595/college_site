<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package college
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

                if( is_page(49) ){

                    get_template_part( 'template-parts/content-home', 'page' );

                }else if( is_page(46) ){

	                get_template_part( 'template-parts/content-about_us', 'page' );

                }else if(is_page( 34 )){

	                get_template_part( 'template-parts/content-faq', 'page' );

                }else if(is_page( 37 )){

                    get_template_part( 'template-parts/content-what_is_college', 'page' );

                }else if(is_page( 40 )){

                    get_template_part( 'template-parts/content-link', 'page' );

                }else {

                    get_template_part('template-parts/content-default', 'page');
//                    get_template_part( 'template-parts/content', 'page' );

                }

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
