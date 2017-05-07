<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ayvar
 * Date: 23.03.2017
 * Time: 12:40
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

<section class="what_is_college">
    <div class="container">
        <div class="section_title right"><?php echo get_field('title_block'); ?></div>
        <div class="content">
            <?php echo get_field('content_block'); ?>
            <div class="more-link">
                <a href="#more">More</a>
            </div>
        </div><!-- .content -->
        <div class="link_college_advantage">
            <?php
            $argument = array(
                'child_of' => 5,
                'parent' => 5,
                'orderby' => 'ID',
                'order' => 'ASC',
                'hide_empty' => 0,
                'hierarchical' => 0,
                'number' => 0,
                'taxonomy' => 'category',
                'pad_counts' => false,
            );
            $categories = get_categories($argument);
            if ($categories):
                echo '<ul>';
                foreach ($categories as $category) :
                    $name = $category->cat_name;
                    $id = $category->cat_ID; ?>
                    <li><a href="<?php echo get_category_link($id); ?>"><?php echo $name; ?></a><i class="shadows"></i></li>
                    <?php
                endforeach;
                echo '</ul>';
            endif;
            ?>
        </div><!-- .link_college_advantage -->
    </div><!-- .container -->
</section><!-- .what_is_college -->

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
