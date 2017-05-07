<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ayvar
 * Date: 22.03.2017
 * Time: 18:56
 */
?>
<div class="news-articles">
    <div class="news-articles_left-content">
        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="news"/>
    </div>
    <div class="news-articles_right-content">
        <h3><?php the_title(); ?></h3>
        <?php the_content(); ?>
        <span class="view_count"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/icon/glaz.png" alt=""><?php echo get_post_meta($post->ID, 'views', true); ?></span>
        <div class="button-view"><a class="link_view_more" href="<?php echo get_the_permalink(); ?>">View More</a></div>
    </div>
</div>
