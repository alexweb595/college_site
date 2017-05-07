<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ayvar
 * Date: 29.03.2017
 * Time: 15:48
 */
?>
<section class="slider_top_block">
    <?php
    if (have_rows('slider_repeat_block')) {
        echo '<div id="top_carousel">';
        while (have_rows('slider_repeat_block')) : the_row();
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

<div class="college_info">
    <div class="container">
        <div class="col-lg-6">
            <div class="wrap_post_thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .wrap_post_thumbnail -->
        </div><!-- .col-.. -->
        <div class="col-lg-6">
            <div class="college_info_top_right">
                <h1 class="post_title"><?php the_title(); ?></h1><!-- .post_title -->
                <div class="post_except"><?php the_content(); ?></div>
                <?php
                if (function_exists('the_ratings')) {
                    the_ratings();
                }
                ?><!-- .college_rating -->
                <?php
                $category = get_the_category();
                $cat_name = $category[0]->cat_name;
                ?>
                <div class="college_info_field_block">
                    <h4 class="college_info_title">Information</h4>
                    <p class="college_info_phar">
                        <span class="title_phar">Category:</span><span
                                class="value_phar"><?php echo $cat_name; ?></span>
                    </p>
                    <?php
                    $region = get_field('region');
                    $address = get_field('address');
                    $open = get_field('open');
                    $number_of = get_field('number_of_students');
                    $director = get_field('director');
                    echo '<p class="college_info_phar"><span class="title_phar">Region:</span><span class="value_phar">' . $region . '</span>   </p>';
                    echo '<p class="college_info_phar"><span class="title_phar">Address:</span><span class="value_phar">' . $address . '</span> </p>';
                    echo '<p class="college_info_phar"><span class="title_phar">Open:</span><span class="value_phar">' . $open . '</span>   </p>';
                    echo '<p class="college_info_phar"><span class="title_phar">Number of Students:</span><span class="value_phar">' . $number_of . '</span>    </p>';
                    echo '<p class="college_info_phar"><span class="title_phar">Director:</span><span class="value_phar">' . $director . '</span>   </p>';
                    ?>
                </div><!-- .college_info -->
            </div><!-- .college_info_top_right -->
        </div><!-- .col-.. -->
    </div><!-- .container -->
</div><!-- .college_info -->

<section class="for_student">
    <div class="container">
        <h4 class="title_section_for_student"><?php echo get_field('for_students_title'); ?>:</h4>
        <?php echo get_field('for_students_content'); ?>
        <div class="hidden_block">
            <?php echo get_field('for_student_hidden_block'); ?>
        </div>
        <a href="#" class="more_show">More</a>
    </div><!-- .container -->
</section><!-- .for_student -->

<?php
if (have_rows('flexible_content_college_page')):
    while (have_rows('flexible_content_college_page')) : the_row();

        if (get_row_layout() == 'tabloid'): ?>
            <section id="premium_section" class="premium_content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <?php
                            $active = '';
                            $title_tab = get_sub_field('title_tabs');
                            if (have_rows('tabloid_block')):
                                echo '<div id="my_tabs" class="tabs_block">';
                                echo '<div class="header_tabs">';
                                echo '<div class="title_section">' . $title_tab . '</div><!-- .title_section -->';
                                echo '<ul class="nav_tab">';
                                $i = 0;
                                while (have_rows('tabloid_block')) : the_row();
                                    $i++;
                                    if ($i == 1) {
                                        $active = 'active';
                                    } else {
                                        $active = '';
                                    }
                                    $tab_title = get_sub_field('tab_title');
                                    echo '<li class="tabs_link ' . $active . '" data-tabs="#block_' . $i . '"><a href="#">' . $tab_title . '</a></li>';
                                endwhile;
                                echo '</ul>';
                                echo '</div><!-- .header_tabs -->';
                                $c = 0;
                                $visible = '';
                                echo '<div class="tabs_content">';
                                while (have_rows('tabloid_block')) : the_row();
                                    $c++;
                                    if ($c == 1) {
                                        $visible = 'visible';
                                    } else {
                                        $visible = '';
                                    }
                                    $content_open = get_sub_field('tab_content');
                                    $content_hidden = get_sub_field('tab_content_hidden');
                                    echo '<div id="block_' . $c . '" class="single_tabs_content ' . $visible . '">';
                                    echo '<div class="tabs_text_block">';
                                    echo $content_open;
                                    echo '<div class="hidden_tab_text_block">';
                                    echo $content_hidden;
                                    echo '</div><!-- .hidden_tab_text_block -->';
                                    echo '</div><!-- .tabs_text_block -->';
                                    echo '<a href="#" class="more_show_hidden_block">More</a>';
                                    echo '</div><!-- .single_tabs_content -->';
                                endwhile;
                                echo '</div><!-- .tab_content -->';
                                echo '</div><!-- .tabs_block -->';
                            endif;
                            ?>
                        </div><!-- .col-.. -->
                        <div class="col-lg-5">
                            <div class="contact_us">
                                <div class="section_title">contact us</div><!-- .section_title -->
                                <?php echo do_shortcode(get_sub_field('feedback_form_shortcode')); ?>
                            </div><!-- .contact_us -->
                        </div><!-- .col-.. -->
                    </div><!-- .row -->
                </div><!-- .container -->
            </section><!-- .premium_content -->
            <?php
        elseif (get_row_layout() == 'blue_block_content'):
            ?>
            <section class="text_blue_row">
                <div class="container">
                    <div class="row">
                        <?php
                        if (have_rows('blue_bloc')):
                            while (have_rows('blue_bloc')) : the_row();
                                $left_content_blue_block = get_sub_field('left_content');
                                $right_content_blue_block = get_sub_field('right_content');
                                echo '<div class="col-lg-6">';
                                echo '<div class="text_block">';
                                echo $left_content_blue_block;
                                echo '</div><!-- .text_block -->';
                                echo '</div><!-- .col-.. -->';
                                echo '<div class="col-lg-6">';
                                echo '<div class="text_block">';
                                echo $right_content_blue_block;
                                echo '</div><!-- .text_block -->';
                                echo '</div><!-- .col-.. -->';
                            endwhile;
                        endif;
                        ?>
                    </div><!-- .row -->
                </div><!-- .container -->
            </section><!-- .text_blue_row -->
            <?php
        elseif (get_row_layout() == 'video_block'): ?>
            <section id="video_block" class="video_block">
                <div class="container">
                    <h2 class="title_video_block">Video</h2>
                    <div class="row">
                        <?php
                        if (have_rows('video_repeater')):
                            while (have_rows('video_repeater')) : the_row();
                                $you_tube_video_url = get_sub_field('url_video_youtube');
                                preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $you_tube_video_url, $matches);
                                if (isset($matches[2]) && $matches[2] != '') {
                                    $Youtube_id = $matches[2];
                                }
                                echo '<div class="col-lg-6">';
                                echo '<div class="video">';
                                echo '<iframe width="100%" height="300" src="https://www.youtube.com/embed/' . $Youtube_id . '" frameborder="0" allowfullscreen></iframe>';
                                echo '<div class="mask"></div><!-- .mask -->';
                                echo '</div><!-- .video -->';
                                echo '</div><!-- .col-.. -->';

                            endwhile;
                        endif;
                        ?>

                    </div><!-- .row -->
                </div><!-- .container -->
            </section><!-- .video_block -->
            <?php
        elseif (get_row_layout() == 'map_code'): ?>
            <section class="map_block">
                <div class="container">
                    <h2 class="title_map_block">Map</h2>
                    <p class="address"><?php echo 'Israel' . "\n " . get_field('region') . "\n " . get_field('address') ?></p>
                    <div class="map">
                        <?php
                        $map = get_sub_field('map');
                        echo $map;
                        ?>
                    </div>
                </div><!-- .container -->
            </section><!-- .map_block -->
            <?php
        elseif (get_row_layout() == 'bottom_carousel'): ?>
            <div class="carousel_block">
                <div class="container">
                    <?php
                    if (have_rows('repeater_img')):
                        echo '<div id="slider_news" class="carousel_content">';
                        while (have_rows('repeater_img')) : the_row();
                            $slider_single_images = get_sub_field('single_img');
                            echo '<div class="carousel_item"><div class="bg_image" style=" background: url(' . $slider_single_images['url'] . ') no-repeat center/cover"></div></div>';
                        endwhile;
                        echo '</div><!-- .carousel_content -->';
                    endif;
                    ?>
                </div><!-- .container -->
            </div><!-- .carousel_block -->
            <?php
        endif;
    endwhile;
endif;
?>


