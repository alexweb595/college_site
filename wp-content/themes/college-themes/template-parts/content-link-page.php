<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ayvar
 * Date: 23.03.2017
 * Time: 11:45
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

<div class="container">
    <?php
    if( have_rows('repeater_link') ):
        while ( have_rows('repeater_link') ) : the_row();
            $url_link = get_sub_field('url_item');
            $title_item = get_sub_field('title_item');
            $content_item = get_sub_field('content_item');
            echo '<div class="single-article">';
            echo '<div class="title-block">';
            echo '<div class="section_title right"><a href="'. $url_link .'">'. $title_item .'</a></div><!-- .section_title -->';
            echo '</div><!-- .text-block -->';
            echo '<div class="content">';
            echo '<div class="inner-text">'. $content_item .'</div><!-- .inner-text -->';
            echo '<div class="more-link"><a href="'. $url_link .'">More</a></div><!-- .more-link -->';
            echo '</div><!-- .content -->';
            echo '</div><!-- .single-article -->';
        endwhile;
    endif;
    ?>
    </row>
</div> <!--container-->
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
