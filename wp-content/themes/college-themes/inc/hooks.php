<?php
/*
 * hide admin_bar & ....
 */
show_admin_bar(false);

function remove_recent_comments_style()
{

    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));

}

add_action('widgets_init', 'remove_recent_comments_style');

remove_action('wp_head', 'feed_links_extra', 3);

remove_action('wp_head', 'feed_links', 2);

remove_action('wp_head', 'rsd_link');

remove_action('wp_head', 'wlwmanifest_link');

remove_action('wp_head', 'index_rel_link');

remove_action('wp_head', 'parent_post_rel_link', 10);

remove_action('wp_head', 'start_post_rel_link', 10);

remove_action('wp_head', 'adjacent_posts_rel_link', 10);

remove_action('wp_head', 'wp_generator');

/*
 * more link & except more
 */
function modify_read_more_link()
{
    return '<a class="more-link " href="' . get_permalink() . '">...</a>';
}

add_filter('the_content_more_link', 'modify_read_more_link');

function new_excerpt_more($more)
{
    global $post;
    return '<a href="' . get_permalink($post->ID) . '">...</a>';
}

add_filter('excerpt_more', 'new_excerpt_more');

add_filter('post_gallery', 'my_gallery_output', 10, 2);

function my_gallery_output($output, $attr)
{
    $ids_arr = explode(',', $attr['ids']);
    $ids_arr = array_map('trim', $ids_arr);
    $pictures = get_posts(array(
        'posts_per_page' => -1,
        'post__in' => $ids_arr,
        'post_type' => 'attachment',
        'orderby' => 'post__in',
    ));
    if (!$pictures) return 'Запрос вернул пустой результат.';
    $out = '<div class="tabs_gallery_block"><div class="wrap_gallery">';
    $i = 0;
    foreach ($pictures as $pic) {
        $src = $pic->guid;
        $i++;
        if ($i == 1) {
            $out .= '<div class="big_thumbnail" style="background: url(' . $src . ') no-repeat center/cover"><a href="' . $src . '" class="gallery_link" rel="group"></a></div><div class="wrap_small_thumbnail">';
        } else if ($i > 5) {
            break;
        } else {
            $out .= '<div class="small_item" style="background: url(' . $src . ') no-repeat center/cover"><a href="' . $src . '" class="gallery_link" rel="group"></a></div>';
        }
    }
    $out .= '</div><!-- .wrap_small_thumbnail -->';
    $out .= '</div><!-- .wrap_gallery --></div><!-- .tabs_gallery_block -->';
    return $out;
}

function custom_rating_image_extension() {
    return 'png';
}
add_filter( 'wp_postratings_image_extension', 'custom_rating_image_extension' );







