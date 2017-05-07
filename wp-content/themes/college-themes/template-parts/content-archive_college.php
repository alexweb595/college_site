<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ayvar
 * Date: 23.03.2017
 * Time: 14:50
 */
?>
<article class="post_preview">
    <figure>
        <a href="<?php get_the_permalink(); ?>">
            <?php the_post_thumbnail(); ?>
        </a>
    </figure>
    <div class="post_content">
        <h4 class="post_preview_title"><?php the_title(); ?></h4><!-- .post_preview_title -->
        <div class="text_post_block">
            <?php the_content(); ?>
        </div><!-- .text_post_block -->
        <div class="more_post_block">
            <a href="<?php the_permalink(); ?>" class="more_view_post">more</a>
        </div>
    </div><!-- .post_content -->
</article><!-- .post_preview -->
