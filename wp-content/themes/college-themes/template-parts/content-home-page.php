<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ayvar
 * Date: 21.03.2017
 * Time: 14:24
 */
?>
<section class="slider_top_block">
    <?php
    if (have_rows('slider_repeater')) {
        echo '<div id="top_carousel">';
        while (have_rows('slider_repeater')) : the_row();
            if (get_sub_field('single_img') && !get_sub_field('single_image_small')) {
                get_template_part('template-module/content-slider_img_full');
            } else if (get_sub_field('single_image_small') && !get_sub_field('single_img')) {
                get_template_part('template-module/content-slider_img_text_block');
            } else if (get_sub_field('single_image_small') && get_sub_field('single_img')) {
                get_template_part('template-module/content-slider_img_text_block');
            }
        endwhile;
        echo '</div><!-- #top_carousel -->';
    }
    ?>
</section><!-- .slider_top_block -->

<div id="advantage" class="advantages-block">
    <div class="container">
        <?php
        $before_wrap = '';
        $after_wrap = '';
        if (have_rows('repeat_text_info_block')):
            $i = 0;
            while (have_rows('repeat_text_info_block')) : the_row();
                $icon_infographic = get_sub_field('icon_Infographic');
                $title_text_block = get_sub_field('title_text_block');
                $text_block = get_sub_field('text_block');
                $i++;
                if ($i == 1 || $i % 2 == 1) {
                    $before_wrap = '<div class="row">';
                    $after_wrap = '';
                } else if ($i == 2 || $i % 2 == 0) {
                    $before_wrap = '';
                    $after_wrap = '</div><!-- .row -->';
                }
                echo $before_wrap;
                echo '<div class="col-lg-6 ' . $i . '">';
                echo '<div class="wrap_advantages-block auto_height">';
                echo '<div class="advantages-icon"><img src="' . $icon_infographic['url'] . '" alt="' . $icon_infographic['alt'] . '"/></div><!-- .advantage-icon -->';
                echo '<h2>' . $title_text_block . '</h2>';
                echo $text_block;
                echo '</div><!-- .wrap_advantages-block -->';
                echo '</div><!-- .col-.. -->';
                echo $after_wrap;
            endwhile;
        endif;
        ?>
    </div><!-- .container -->
</div><!-- .advantages-block -->

<div class="search_block">

    <div class="container">
        <div class="section_title">Search</div>
        <form action="<?php echo site_url(); ?>/search-results/">
            <div id="search_motor" class="form_search">

                <?php
                // Vars data sort =============== //
                $cat_id = array();
                $cat_name = array();
                $cat_name_id = array();
                $post_title = array();
                $post_id = array();
                $post_title_id = array();
                $region_field = array();
                $address_field = array();
                $open_field = array();
                $director_field = array();
                // query === //
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
                        $id = $category->cat_ID;
                        $name = $category->cat_name;
                        $args = array(
                            'cat' => $id,
                        );
                        array_push($cat_id, $id);
                        array_push($cat_name, $name);
                        $query = new WP_Query($args);
                        if ($query->have_posts()) :
                            while ($query->have_posts()) :
                                $query->the_post();
                                $region = get_field('region');
                                $address = get_field('address');
                                $open = get_field('open');
                                $director = get_field('director');
                                array_push($post_id, get_the_ID());
                                array_push($post_title, get_the_title());
                                array_push($region_field, $region);
                                array_push($address_field, $address);
                                array_push($open_field, $open);
                                array_push($director_field, $director);
                            endwhile;
                        endif;
                    endforeach;
                    wp_reset_postdata();
                    $cat_name_id = array_combine($cat_id, $cat_name);
                    $post_title_id = array_combine($post_id, $post_title);
                    asort($post_title_id);
                    reset($post_title_id);
                    echo '<p class="wrp_search"><select id="name_college" name="name_college" class="select_sort">';
                    echo '<option></option>';
                    foreach ($post_title_id as $post_id => $post_title) :
                        echo '<option value="' . $post_id . '">' . $post_title . '</option>';
                    endforeach;
                    echo '</select><!-- #name_college --></p>';
                endif;
                ?>

                <div class="wrap_column_search_block">

                    <div class="column-search_block">
                        <?php
                        echo '<p class="wrp_select"><select id="cat_school" name="cat_school" class="js-example-basic-hide-search select_sort">';
                        echo '<option></option>';
                        foreach ($cat_name_id as $cat_id => $cat_name) :
                            echo '<option value="' . $cat_id . '">' . $cat_name . '</option>';
                        endforeach;
                        echo '</select></p>';
                        echo '<p class="wrp_select"><select id="region_school" name="region_school" class="js-example-basic-hide-search select_sort">';
                        echo '<option></option>';
                        $region_field = array_unique($region_field);
                        foreach ($region_field as $region) :
                            echo '<option value="' . $region . '">' . $region . '</option>';
                        endforeach;
                        echo '</select></p>';
                        ?>
                    </div><!-- .column-search_block -->

                    <div class="column-search_block">
                        <?php
                        echo '<p class="wrp_select"><select id="address_school" name="address_school" class="js-example-basic-hide-search select_sort">';
                        $address_field = array_unique($address_field);
                        echo '<option></option>';
                        foreach ($address_field as $address) :
                            echo '<option value="' . $address . '">' . $address . '</option>';
                        endforeach;
                        echo '</select></p>';
                        $open_field = array_unique($open_field);
                        echo '<p class="wrp_select"><select id="open_school" name="open_school" class="js-example-basic-hide-search select_sort">';
                        echo '<option></option>';
                        foreach ($open_field as $open) :
                            echo '<option value="' . $open . '">' . $open . '</option>';
                        endforeach;
                        echo '</select></p>';
                        ?>
                    </div><!-- .column-search_block -->

                    <div class="column-search_block">
                        <?php
                        $director_field = array_unique($director_field);
                        echo '<p class="wrp_select" ><select id="director_school" name="director_school" class="js-example-basic-hide-search select_sort">';
                        echo '<option></option>';
                        foreach ($director_field as $director) :
                            echo '<option value="' . $director . '">' . $director . '</option>';
                        endforeach;
                        echo '</select></p>';
                        ?>
                        <p class="wrap_controls">
                            <button id="sort_start" type="submit" class="submit" formaction="<?php echo site_url(); ?>/search-results/" formmethod="POST" formenctype="multipart/form-data">Watch Results</button>
                            <button id="reset_search">Reset</button>
                        </p>
                    </div><!-- .column-search_block -->

                </div><!-- .wrap_column_search_block -->
            </div><!-- .search_motor -->
        </form><!-- form -->
    </div><!-- .container -->
</div><!-- .search_block -->

<div class="carousel_block">
    <div class="container">
        <?php
        if (have_rows('image_repeater')):
            echo '<div id="slider_news" class="carousel_content">';
            while (have_rows('image_repeater')) : the_row();
                $slider_single_images = get_sub_field('single_item_img');
                echo '<div class="carousel_item"><div class="bg_image" style="background: url(' . $slider_single_images['url'] . ') no-repeat center/cover"></div></div>';
            endwhile;
            echo '</div><!-- .carousel_content -->';
        endif;
        ?>
    </div><!-- .container -->
</div><!-- .carousel_block -->

<div class="articles-block">
    <div class="container">
        <div class="section_title"><?php echo get_cat_name(3); ?></div>
        <div class="row">
            <div class="col-lg-9 col-md-8">
                <?php
                $paged = get_query_var('page') ? get_query_var('page') : 1;
                $args = array(
                    'cat' => 3,
                    'posts_per_page' => 3,
                    'paged' => $paged
                );
                $the_query = new WP_Query($args);
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    get_template_part('template-module/single-post_preview_news');
                }
                wp_reset_postdata();
                $big = 999999999;
                $pagination = paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?page=%#%',
                    'current' => max(1, get_query_var('page')),
                    'total' => $the_query->max_num_pages,
                    'show_al' => true,
                    'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                    'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                    'type' => 'plain'
                ));
                ?>
                <div class="pagination_link">
                    <?php echo $pagination; ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="last_news_sidebar">
                    <?php
                    $args = array(
                        'cat' => '3',
                        'posts_per_page' => 3,
                        'tag' => 'top-news',
                        'orderby' => 'date',
                        'order' => 'DESC'
                    );
                    $the_query = new WP_Query($args);
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        echo '<div class="banner_side-bar">';
                        echo '<div class="wrap_img">';
                        echo '<span class="view_count"><img src="' . esc_url(get_template_directory_uri()) . '/images/icon/glaz.png" alt="">' . get_post_meta($post->ID, 'views', true) . '</span>';
                        echo '<a href="' . get_the_permalink() . '">';
                        echo '<img class="post_thumb" src="' . get_the_post_thumbnail_url() . '" alt="' . get_the_title() . '"/>';
                        echo '</a>';
                        echo '<div class="mask">' . get_the_title() . '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    wp_reset_postdata();
                    ?>
                </div><!-- .last_news_sidebar -->
            </div>
        </div>
    </div>
</div>

