<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package college
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

		    if ( in_category( 5 ) ){

                if( has_tag( 'default-college-post' ) ){

                    get_template_part('template-parts/content-default_single_college');

                }else if(has_tag( 'business-college-post' )) {

                    get_template_part('template-parts/content-business_single_college');

                }

            }else {

                get_template_part( 'template-parts/content-default-single', 'post' );
//                get_template_part( 'template-parts/content', get_post_format() );

            }

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
