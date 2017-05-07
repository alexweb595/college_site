<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package college
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
            if (have_posts()) :
                if ( is_category(array('5')) || cat_is_ancestor_of(5, $cat) ) {
                    $field_key = 'field_58d28acda4dca';
                    $field = get_field_object($field_key, 49);

                    if ($field) {

                        echo '<section class="slider_top_block">';
                        echo '<div id="top_carousel">';
                        foreach ($field['value'] as $k => $v) {
                            if ($v['single_img']['url'] && !$v['single_image_small']['url']) {
                                echo '<div class="top_slider_item">';
                                echo '<div class="images_block_items_full" style="background: url(' . $v['single_img']['url'] . ') no-repeat center/cover"></div><!-- .images_block_items -->';
                                echo '</div>';
                            } else if ((!$v['single_img']['url'] && $v['single_image_small']['url']) || ($v['single_img']['url'] && $v['single_image_small']['url'])) {
                                echo '<div class="top_slider_item">';
                                echo '<div class="text_block_item">';
                                echo '<div class="content_text_block">' . $v['item_text_block'] . '</div><!-- .content_text_block -->';
                                echo '</div><!-- .text_block_items -->';
                                echo '<div class="images_block_items" style="background: url(' . $v['single_image_small']['url'] . ') no-repeat center/cover"></div><!-- .images_block_items -->';
                                echo '</div>';
                            }
                        }
                        echo '</div><!-- #top_carousel -->';
                        echo '</section><!-- .slider_top_block -->';

                    }

                    if( cat_is_ancestor_of(5, $cat)){

                        if(category_description( $cat )){
                            echo '<section class="block_description">';
                            echo '<div class="container">';
                            echo '<h2 class="section_title">'. get_cat_name( $cat ) .'</h2>';
                            echo '<div class="description">';
                            echo category_description( $cat );
                            echo '</div>';
                            echo '</div>';
                            echo '</section>';
                        }
                    }

                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-lg-5">';

                    get_sidebar();

                    echo '</div><!-- .col-... -->';
                    echo '<div class="col-lg-7">';
                    echo '<div id="search_results">';

                    while (have_posts()) : the_post();

                        get_template_part('template-parts/content-archive_college');

                    endwhile;
                    echo '</div><!-- #search_results -->';
                    echo '</div><!-- .col-... -->';
                    echo '</div><!-- .row -->';
                    echo '</div><!-- .container -->';

                } else {

                    while (have_posts()) : the_post();

                        get_template_part('template-parts/content', get_post_format());

                    endwhile;
                }
            else :

                get_template_part('template-parts/content', 'none');

            endif; ?>
            <?php
            if ( is_category(array('5')) || cat_is_ancestor_of(5, $cat) ):
                $field_key_small_slider = 'field_58d2a71237a5c';
                $field_small_slider = get_field_object($field_key_small_slider, 49);
                if ($field_small_slider):
                    ?>
                    <div class="carousel_block">
                        <div class="container">
                            <div id="slider_news" class="carousel_content">
                                <?php
                                foreach ($field_small_slider['value'] as $k => $v) {

                                    echo '<div class="carousel_item"><div class="bg_image" style=" background: url(' . $v['single_item_img']['url'] . ') no-repeat center/cover "></div></div>';

                                }
                                ?>
                            </div><!-- .carousel_content -->
                        </div><!-- .container -->
                    </div><!-- .carousel_block -->
                    <?php
                endif;
            endif;
            ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
