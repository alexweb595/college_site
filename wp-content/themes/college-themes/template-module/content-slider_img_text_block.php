<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ayvar
 * Date: 22.03.2017
 * Time: 16:52
 */
 // Vars
$images_slider_item = get_sub_field('single_image_small');
$text_block_slider_item = get_sub_field('item_text_block');
?>
<div class="top_slider_item">
    <div class="text_block_item">
        <div class="content_text_block">
        <?php echo $text_block_slider_item; ?>
        </div><!-- .content_text_block -->
    </div><!-- .text_block_items -->
    <div class="images_block_items"
         style="background: url('<?php echo $images_slider_item['url']; ?>') no-repeat center/cover">
    </div><!-- .images_block_items -->
</div>
