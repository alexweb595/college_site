<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ayvar
 * Date: 27.03.2017
 * Time: 12:35
 */
?>
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

} ?>

<div class="post_content">
    <div class="container">
        <article id="post_<?php the_ID(); ?>" class="single_post_content">
            <h2 class="section_title right"><?php the_title(); ?></h2>
            <div class="row">
                <div class="col-lg-3">
                    <div class="wrap_post_thumbnail">
                        <?php the_post_thumbnail(); ?>
                    </div><!-- .wrap_post_thumbnail -->
                </div>
                <div class="col-lg-9">
                    <div class="content">
                        <div class="posted"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date(); ?><span class="post_views"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/icon/glaz.png" alt=""><?php echo get_post_meta($post->ID, 'views', true); ?></span></div>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </article>
    </div><!-- .container -->
</div><!-- .post_content -->

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
endif; ?>