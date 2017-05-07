<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ayvar
 * Date: 29.03.2017
 * Time: 15:47
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
                    echo '<p class="college_info_phar"><span class="title_phar">Region:</span><span class="value_phar">' . $region . '</span></p>';
                    echo '<p class="college_info_phar"><span class="title_phar">Address:</span><span class="value_phar">' . $address . '</span></p>';
                    echo '<p class="college_info_phar"><span class="title_phar">Open:</span><span class="value_phar">' . $open . '</span></p>';
                    echo '<p class="college_info_phar"><span class="title_phar">Number of Students:</span><span class="value_phar">' . $number_of . '</span></p>';
                    echo '<p class="college_info_phar"><span class="title_phar">Director:</span><span class="value_phar">' . $director . '</span></p>';


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

<div class="carousel_block">
    <div class="container">
        <?php
        if (have_rows('bottom_carousel')):
            echo '<div id="slider_news" class="carousel_content">';
            while (have_rows('bottom_carousel')) : the_row();
                $slider_single_images = get_sub_field('single_img');
                echo '<div class="carousel_item"><div class="bg_image" style="background: url(' . $slider_single_images['url'] . ') no-repeat center/cover"></div></div>';
            endwhile;
            echo '</div><!-- .carousel_content -->';
        endif;
        ?>
    </div><!-- .container -->
</div><!-- .carousel_block -->

</div>
</div>