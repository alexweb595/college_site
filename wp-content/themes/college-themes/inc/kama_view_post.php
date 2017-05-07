<?php
/*
 * Kama post views
 */
function kama_postviews()
{
    /* ------------ Setting -------------- */
    $meta_key = 'views';
    $who_count = 0;
    $exclude_bots = 0;
    global $user_ID, $post;
    if (is_singular()) {
        $id = (int)$post->ID;
        static $post_views = false;
        if ($post_views) return true;
        $post_views = (int)get_post_meta($id, $meta_key, true);
        $should_count = false;
        switch ((int)$who_count) {
            case 0:
                $should_count = true;
                break;
            case 1:
                if ((int)$user_ID == 0)
                    $should_count = true;
                break;
            case 2:
                if ((int)$user_ID > 0)
                    $should_count = true;
                break;
        }
        if ((int)$exclude_bots == 1 && $should_count) {
            $useragent = $_SERVER['HTTP_USER_AGENT'];
            $notbot = "Mozilla|Opera";
            $bot = "Bot/|robot|Slurp/|yahoo";
            if (!preg_match("/$notbot/i", $useragent) || preg_match("!$bot!i", $useragent))
                $should_count = false;
        }
        if ($should_count)
            if (!update_post_meta($id, $meta_key, ($post_views + 1))) add_post_meta($id, $meta_key, 1, true);
    }
    return true;
}

add_action('wp_head', 'kama_postviews');