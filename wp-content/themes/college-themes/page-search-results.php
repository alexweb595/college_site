<?php

get_header(); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
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
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <?php get_sidebar(); ?>
                    </div><!-- .col-.. -->
                    <div class="col-lg-7">
                        <div id="search_results" data-results_cat="<?php echo $_POST['cat_school']; ?>"
                             data-results_post="<?php echo $_POST['name_college']; ?>"
                             data-results_region="<?php echo $_POST['region_school']; ?>"
                             data-results_address="<?php echo $_POST['address_school']; ?>"
                             data-results_open="<?php echo $_POST['open_school']; ?>"
                             data-results_director="<?php echo $_POST['director_school']; ?>">
                            <?php
                            $mete_query_array = array(
                                'relation' => 'AND',
                            );
                            if ($_POST['cat_school']) {
                                $current_cat = $_POST['cat_school'];
                                if ($_POST['name_college']) {
                                    $post_id = $_POST['name_college'];
                                } else {
                                    $post_id = '';
                                }
                                if ($_POST['region_school']) {
                                    $data_region = array(
                                        'key' => 'region',
                                        'value' => $_POST['region_school'],
                                        'type' => 'BINARY'
                                    );
                                    array_push($mete_query_array, $data_region);
                                }
                                if ($_POST['address_school']) {
                                    $data_address = array(
                                        'key' => 'address',
                                        'value' => $_POST['address_school'],
                                        'type' => 'BINARY'
                                    );
                                    array_push($mete_query_array, $data_address);
                                }
                                if ($_POST['open_school']) {
                                    $data_open = array(
                                        'key' => 'open',
                                        'value' => $_POST['open_school'],
                                        'type' => 'BINARY'
                                    );
                                    array_push($mete_query_array, $data_open);
                                }
                                if ($_POST['director_school']) {
                                    $data_director = array(
                                        'key' => 'director',
                                        'value' => $_POST['director_school'],
                                        'type' => 'BINARY'
                                    );
                                    array_push($mete_query_array, $data_director);
                                }
                                $args = array(
                                    'cat' => $current_cat,
                                    'p' => $post_id,
                                    'meta_query' => $mete_query_array
                                );
                                $query = new WP_Query($args);
                                if ($query->have_posts()) :
                                    while ($query->have_posts()) :
                                        $query->the_post();
                                        get_template_part('template-parts/content-archive_college');
                                    endwhile;
                                endif;

                            } elseif (!$_POST['cat_school']) {
                                $argument = array(
                                    'child_of' => 5,
                                    'parent' => 5,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                    'hide_empty' => 0,
                                    'hierarchical' => 0,
                                    'number' => 0,
                                    'taxonomy' => 'category',
                                    'pad_counts' => false,
                                );
                                $categories = get_categories($argument);
                                if ($categories) :
                                    foreach ($categories as $category) :
                                        $current_cat = $category->cat_ID;
                                        $name = $category->cat_name;
                                        if ($_POST['name_college']) {
                                            $post_id = $_POST['name_college'];
                                        } else {
                                            $post_id = '';
                                        }
                                        if ($_POST['region_school']) {
                                            $data_region = array(
                                                'key' => 'region',
                                                'value' => $_POST['region_school'],
                                                'type' => 'BINARY'
                                            );
                                            array_push($mete_query_array, $data_region);
                                        }
                                        if ($_POST['address_school']) {
                                            $data_address = array(
                                                'key' => 'address',
                                                'value' => $_POST['address_school'],
                                                'type' => 'BINARY'
                                            );
                                            array_push($mete_query_array, $data_address);
                                        }
                                        if ($_POST['open_school']) {
                                            $data_open = array(
                                                'key' => 'open',
                                                'value' => $_POST['open_school'],
                                                'type' => 'BINARY'
                                            );
                                            array_push($mete_query_array, $data_open);
                                        }
                                        if ($_POST['director_school']) {
                                            $data_director = array(
                                                'key' => 'director',
                                                'value' => $_POST['director_school'],
                                                'type' => 'BINARY'
                                            );
                                            array_push($mete_query_array, $data_director);
                                        }
                                        $args = array(
                                            'cat' => $current_cat,
                                            'p' => $post_id,
                                            'meta_query' => $mete_query_array
                                        );
                                        $query = new WP_Query($args);
                                        if ($query->have_posts()) :
                                            while ($query->have_posts()) :
                                                $query->the_post();
                                                get_template_part('template-parts/content-archive_college');
                                            endwhile;
                                        endif;
                                    endforeach;
                                endif;
                            }
                            ?>
                        </div><!-- #search_results -->
                    </div><!-- .col-.. -->
                </div><!-- .row -->
            </div><!-- .container -->
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
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
?>
<?php
get_footer();
