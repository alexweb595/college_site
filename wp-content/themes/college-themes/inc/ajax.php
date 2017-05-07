<?php

function title_college()
{
    $args = unserialize(stripslashes($_POST['query']));
    $args['p'] = $_POST['p'];
    $query = new WP_Query($args);
    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post();
            // Fields group === //
            $region = get_field('region');
            $address = get_field('address');
            $open = get_field('open');
            $director = get_field('director');
            // Parents category === //
            $categories = get_the_category();
            $current_cat = array();
            if ($categories) {
                $current_cat_name = array();
                $current_cat_id = array();
                foreach ($categories as $category) {
                    $cat_name = $category->cat_name;
                    $cat_id = $category->cat_ID;
                    array_push($current_cat_name, $cat_name);
                    array_push($current_cat_id, $cat_id);
                }
                $current_cat = array_combine($current_cat_id, $current_cat_name);
                unset($current_cat[5]);
                array_unique($current_cat);
            }
            // Data results === //
            $array_data = array(
                'region' => $region,
                'address' => $address,
                'open' => $open,
                'director' => $director,
                'current_cat' => $current_cat
            );
            echo json_encode($array_data);
        endwhile;
    endif;
    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_title_college', 'title_college');
add_action('wp_ajax_nopriv_title_college', 'title_college');

function selected_category_field()
{
    // Vars data ===========================
    $data_cat = $_POST['cat'];
    $data_region = $_POST['region'];

    // Vars results ===================
    $post_title = array();
    $post_id = array();
    $region_field = array();
    $address_field = array();
    $open_field = array();
    $director_field = array();

    // Argument ===========================
    $argument = unserialize(stripslashes($_POST['query']));
    if ($_POST['region'] && $_POST['cat']) {
        $argument['cat'] = $_POST['cat'];
        $argument['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => 'region',
                'value' => $data_region,
                'type' => 'BINARY',
            )
        );
    } else if ((!$_POST['region']) && $_POST['cat']) {
        $argument['cat'] = $_POST['cat'];
    }

    if ($argument):
        $query = new WP_Query($argument);
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
                $region = get_field('region');
                $address = get_field('address');
                $open = get_field('open');
                $director = get_field('director');
                array_push($post_id, get_the_ID());
                array_push($post_title, get_the_title());
                array_push($region_field, $region);
                array_push($address_field, $address);
                array_push($open_field, $open);
                array_push($director_field, $director);
            endwhile;
        endif;
        $post_title_id = array_combine($post_id, $post_title);
        asort($post_title_id);
        reset($post_title_id);
        $array_data = array(
            'region' => $region_field,
            'address' => $address_field,
            'open' => $open_field,
            'director' => $director_field,
            'post_title_id' => $post_title_id
        );
        echo json_encode($array_data);
    endif;
    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_selected_category_field', 'selected_category_field');
add_action('wp_ajax_nopriv_selected_category_field', 'selected_category_field');

function region_field_selected()
{
    // Vars data ===========================
    $data_cat = $_POST['cat'];
    $data_region = $_POST['region'];

    // Vars results ===================
    $post_title = array();
    $post_id = array();
    $address_field = array();
    $open_field = array();
    $director_field = array();
    $region_field = array();
    $current_cat = array();
    $current_cat_name = array();
    $current_cat_id = array();

    // Argument ===========================
    $argument = unserialize(stripslashes($_POST['query']));
    if ($_POST['region'] && $_POST['cat']) {
        $argument['cat'] = $_POST['cat'];
        $argument['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => 'region',
                'value' => $data_region,
                'type' => 'BINARY',
            )
        );
    } else if (($_POST['region']) && (!$_POST['cat'])) {
        $argument['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => 'region',
                'value' => $data_region,
                'type' => 'BINARY',
            )
        );
    }
    if ($argument):
        $query = new WP_Query($argument);
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
                $region = get_field('region');
                $address = get_field('address');
                $open = get_field('open');
                $director = get_field('director');
                array_push($post_id, get_the_ID());
                array_push($post_title, get_the_title());
                array_push($address_field, $address);
                array_push($open_field, $open);
                array_push($director_field, $director);
                array_push($region_field, $region);
                if (!$_POST['cat']):
                    // Parents category === //
                    $categories = get_the_category();
                    if ($categories):
                        foreach ($categories as $category) :
                            $cat_name = $category->cat_name;
                            $cat_id = $category->cat_ID;
                            array_push($current_cat_name, $cat_name);
                            array_push($current_cat_id, $cat_id);
                        endforeach;
                        $current_cat = array_combine($current_cat_id, $current_cat_name);
                        unset($current_cat[5]);
                        array_unique($current_cat);
                    endif;
                endif;
            endwhile;
        endif;
        $region_field = array_unique($region_field);
        $post_title_id = array_combine($post_id, $post_title);
        asort($post_title_id);
        reset($post_title_id);
        $array_data = array();
        if (!$_POST['cat']):
            $array_data = array(
                'region' => $region_field,
                'address' => $address_field,
                'open' => $open_field,
                'director' => $director_field,
                'post_title_id' => $post_title_id,
                'current_cat' => $current_cat
            );
        elseif ($_POST['cat']):
            $cat_name = get_cat_name($_POST['cat']);
            $array_data = array(
                'region' => $region_field,
                'address' => $address_field,
                'open' => $open_field,
                'director' => $director_field,
                'post_title_id' => $post_title_id,
                'current_cat' => array($data_cat => $cat_name)
            );
        endif;
        echo json_encode($array_data);
    endif;
    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_region_field_selected', 'region_field_selected');
add_action('wp_ajax_nopriv_region_field_selected', 'region_field_selected');

function address_field_selected()
{
    // Vars data ===========================
    $data_cat = $_POST['cat'];
    $data_region = $_POST['region'];
    $data_address = $_POST['address'];

    // Vars results ===================
    $post_title = array();
    $post_id = array();
    $address_field = array();
    $open_field = array();
    $director_field = array();
    $region_field = array();
    $current_cat = array();
    $current_cat_name = array();
    $current_cat_id = array();

    // Argument ===========================
    $argument = unserialize(stripslashes($_POST['query']));
    if ($_POST['address'] && $_POST['region'] && $_POST['cat']) {
        $argument['cat'] = $_POST['cat'];
        $argument['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => 'region',
                'value' => $data_region,
                'type' => 'BINARY',
            ),
            array(
                'key' => 'address',
                'value' => $data_address,
                'type' => 'BINARY',
            )
        );
    } else if (($_POST['region']) && ($_POST['address']) && (!$_POST['cat'])) {
        $argument['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => 'region',
                'value' => $data_region,
                'type' => 'BINARY',
            ),
            array(
                'key' => 'address',
                'value' => $data_address,
                'type' => 'BINARY',
            )
        );
    } else if ($_POST['address'] && ($_POST['cat']) && (!$_POST['region'])) {
        $argument['cat'] = $_POST['cat'];
        $argument['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => 'address',
                'value' => $data_address,
                'type' => 'BINARY',
            )
        );
    } else if ($_POST['address'] && (!$_POST['cat']) && (!$_POST['region'])) {
        $argument['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => 'address',
                'value' => $data_address,
                'type' => 'BINARY',
            )
        );
    }
    if ($argument):
        $query = new WP_Query($argument);
        if ($query->have_posts()):
            while ($query->have_posts()): $query->the_post();
                $region = get_field('region');
                $open = get_field('open');
                $director = get_field('director');
                array_push($post_id, get_the_ID());
                array_push($post_title, get_the_title());
                array_push($open_field, $open);
                array_push($director_field, $director);
                array_push($region_field, $region);
                $title_cat = get_cat_name($data_cat);
                // Parents category === //
                $categories = get_the_category();
                if ($categories):
                    foreach ($categories as $category) :
                        $cat_name = $category->cat_name;
                        $cat_id = $category->cat_ID;
                        array_push($current_cat_name, $cat_name);
                        array_push($current_cat_id, $cat_id);
                    endforeach;
                    $current_cat = array_combine($current_cat_id, $current_cat_name);
                    unset($current_cat[5]);
                    array_unique($current_cat);
                endif;
            endwhile;
        endif;
        $region_field = array_unique($region_field);
        $post_title_id = array_combine($post_id, $post_title);
        asort($post_title_id);
        reset($post_title_id);
        $array_data = array();
        if (($_POST['region']) && ($_POST['address']) && (!$_POST['cat'])):
            $array_data = array(
                'fields' => 'selected fields address && region',
                'region' => $_POST['region'],
                'open' => $open_field,
                'director' => $director_field,
                'post_title_id' => $post_title_id,
                'current_cat' => $current_cat
            );
        elseif ((!$_POST['region']) && ($_POST['address']) && (!$_POST['cat'])):
            $array_data = array(
                'fields' => 'selected fields address',
                'region' => $region_field,
                'open' => $open_field,
                'director' => $director_field,
                'post_title_id' => $post_title_id,
                'current_cat' => $current_cat
            );
        elseif ((!$_POST['region']) && ($_POST['address']) && ($_POST['cat'])):
            $array_data = array(
                'fields' => 'selected fields cat && address',
                'region' => $region_field,
                'open' => $open_field,
                'director' => $director_field,
                'post_title_id' => $post_title_id,
                'current_cat' => array($_POST['cat'] => $title_cat)
            );
        elseif (($_POST['region']) && ($_POST['address']) && ($_POST['cat'])):
            $array_data = array(
                'fields' => 'selected fields cat && region && address',
                'region' => $_POST['region'],
                'open' => $open_field,
                'director' => $director_field,
                'post_title_id' => $post_title_id,
                'current_cat' => array($_POST['cat'] => $title_cat)
            );
        endif;

        echo json_encode($array_data);
    endif;
    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_address_field_selected', 'address_field_selected');
add_action('wp_ajax_nopriv_address_field_selected', 'address_field_selected');

function data_open_college()
{
    // Vars data ===========================
    $data_cat = $_POST['cat'];
    $data_region = $_POST['region'];
    $data_address = $_POST['address'];
    $data_open = $_POST['open'];

    // Vars results ===================
    $post_title = array();
    $post_id = array();
    $address_field = array();
    $open_field = array();
    $director_field = array();
    $region_field = array();
    $current_cat = array();
    $current_cat_name = array();
    $current_cat_id = array();

    // Argument ===========================
    $argument = unserialize(stripslashes($_POST['query']));
    if (($_POST['open']) && (!$_POST['cat']) && (!$_POST['region']) && (!$_POST['address'])):
        $argument['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => 'open',
                'value' => $data_open,
                'type' => 'BINARY'
            )
        );
    elseif (($_POST['open']) && ($_POST['cat']) && (!$_POST['region']) && (!$_POST['address'])):
        $argument['cat'] = $_POST['cat'];
        $argument['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => 'open',
                'value' => $data_open,
                'type' => 'BINARY'
            )
        );
    elseif (($_POST['open']) && ($_POST['cat']) && ($_POST['region']) && ($_POST['address'])):
        $argument['cat'] = $_POST['cat'];
        $argument['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => 'open',
                'value' => $data_open,
                'type' => 'BINARY'
            ),
            array(
                'key' => 'region',
                'value' => $data_region,
                'type' => 'BINARY',
            ),
            array(
                'key' => 'address',
                'value' => $data_address,
                'type' => 'BINARY',
            )
        );
    endif;
    if ($argument):
        $query = new WP_Query($argument);
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
                $region = get_field('region');
                $address = get_field('address');
                $open = get_field('open');
                $director = get_field('director');
                array_push($post_id, get_the_ID());
                array_push($post_title, get_the_title());
                array_push($address_field, $address);
                array_push($open_field, $open);
                array_push($director_field, $director);
                array_push($region_field, $region);
                $title_cat = get_cat_name($data_cat);
                // Parents category === //
                $categories = get_the_category();
                if ($categories):
                    foreach ($categories as $category) :
                        $cat_name = $category->cat_name;
                        $cat_id = $category->cat_ID;
                        array_push($current_cat_name, $cat_name);
                        array_push($current_cat_id, $cat_id);
                    endforeach;
                    $current_cat = array_combine($current_cat_id, $current_cat_name);
                    unset($current_cat[5]);
                    array_unique($current_cat);
                endif;
            endwhile;
        endif;
        $region_field = array_unique($region_field);
        $post_title_id = array_combine($post_id, $post_title);
        asort($post_title_id);
        reset($post_title_id);
//        $array_data = array();
//        if (($_POST['open']) && (!$_POST['cat']) && (!$_POST['region']) && (!$_POST['address'])):
//
//        elseif (($_POST['open']) && ($_POST['cat']) && (!$_POST['region']) && (!$_POST['address'])):
//
//        elseif (($_POST['open']) && ($_POST['cat']) && ($_POST['region']) && (!$_POST['address'])):
//
//        elseif (($_POST['open']) && ($_POST['cat']) && ($_POST['region']) && ($_POST['address'])):
//
//        endif;
        $array_data = array(
            'address' => $address_field,
            'region' => $region_field,
            'open' => $open_field,
            'director' => $director_field,
            'post_title_id' => $post_title_id,
            'current_cat' => $current_cat,

        );
        echo json_encode($array_data);
    endif;
    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_data_open_college', 'data_open_college');
add_action('wp_ajax_nopriv_data_open_college', 'data_open_college');

function selected_director_field()
{
    // Vars data ===========================
    $data_cat = $_POST['cat'];
    $data_region = $_POST['region'];
    $data_address = $_POST['address'];
    $data_open = $_POST['open'];
    $data_director = $_POST['director'];

    // Vars results ===================
    $post_title = array();
    $post_id = array();
    $address_field = array();
    $open_field = array();
    $director_field = array();
    $region_field = array();
    $current_cat = array();
    $current_cat_name = array();
    $current_cat_id = array();

    // Argument ===========================
    $argument = unserialize(stripslashes($_POST['query']));
    if (($_POST['director']) && (!$_POST['open']) && (!$_POST['cat']) && (!$_POST['region']) && (!$_POST['address'])):
        $argument['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => 'director',
                'value' => $data_director,
                'type' => 'BINARY'
            )
        );
    endif;
    if ($argument):
        $query = new WP_Query($argument);
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
                $region = get_field('region');
                $address = get_field('address');
                $open = get_field('open');
                $director = get_field('director');
                array_push($post_id, get_the_ID());
                array_push($post_title, get_the_title());
                array_push($address_field, $address);
                array_push($open_field, $open);
                array_push($director_field, $director);
                array_push($region_field, $region);
                $title_cat = get_cat_name($data_cat);
                // Parents category === //
                $categories = get_the_category();
                if ($categories):
                    foreach ($categories as $category) :
                        $cat_name = $category->cat_name;
                        $cat_id = $category->cat_ID;
                        array_push($current_cat_name, $cat_name);
                        array_push($current_cat_id, $cat_id);
                    endforeach;
                    $current_cat = array_combine($current_cat_id, $current_cat_name);
                    unset($current_cat[5]);
                    array_unique($current_cat);
                endif;
            endwhile;
        endif;
        $region_field = array_unique($region_field);
        $post_title_id = array_combine($post_id, $post_title);
        asort($post_title_id);
        reset($post_title_id);
        $array_data = array(
            'address' => $address_field,
            'region' => $region_field,
            'open' => $open_field ,
            'director' => $director_field,
            'post_title_id' => $post_title_id,
            'current_cat' => $current_cat,
        );
        echo json_encode($array_data);
    endif;
    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_selected_director_field', 'selected_director_field');
add_action('wp_ajax_nopriv_selected_director_field', 'selected_director_field');

function reset_search()
{
    // Argument ===========================
    $argument = array(
        'child_of' => $_POST['parent_cat'],
        'parent' => $_POST['parent_cat'],
        'orderby' => 'title',
        'order' => 'ASC',
        'hide_empty' => 0,
        'hierarchical' => 0,
        'number' => 0,
        'taxonomy' => 'category',
        'pad_counts' => false,
    );
    $categories = get_categories($argument);
    if ($categories) :
        // Vars data sort =============== //
        $cat_id = array();
        $cat_name = array();
        $post_title = array();
        $post_id = array();
        $post_title_id = array();
        $cat_name_id = array();
        $region_field = array();
        $address_field = array();
        $open_field = array();
        $director_field = array();
        foreach ($categories as $category) :
            $id = $category->cat_ID;
            $name = $category->cat_name;
            $args = array(
                'cat' => $id,
            );
            array_push($cat_id, $id);
            array_push($cat_name, $name);
            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();
                    $region = get_field('region');
                    $address = get_field('address');
                    $open = get_field('open');
                    $director = get_field('director');
                    array_push($post_id, get_the_ID());
                    array_push($post_title, get_the_title());
                    array_push($region_field, $region);
                    array_push($address_field, $address);
                    array_push($open_field, $open);
                    array_push($director_field, $director);
                endwhile;
            endif;
        endforeach;
        $cat_name_id = array_combine($cat_id, $cat_name);
        $post_title_id = array_combine($post_id, $post_title);
        asort($post_title_id);
        reset($post_title_id);
        // Results data ==== //
        $array_data = array(
            'post_title_id' => $post_title_id,
            'cat_name_id' => $cat_name_id,
            'region' => $region_field,
            'address' => $address_field,
            'open' =>  $open_field,
            'director' => $director_field,
        );
        echo json_encode($array_data);
    endif;
    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_reset_search', 'reset_search');
add_action('wp_ajax_nopriv_reset_search', 'reset_search');

function archive_sort_widget(){
    // Vars === //
    $mete_query_array = array(
        'relation' => 'OR',
    );
    // Argument === //
    $argument = unserialize(stripslashes($_POST['query']));

        if($_POST['check_cat']) : $argument['category__in'] = $_POST['check_cat']; elseif($argument['category__in'] = array('6', '7', '8', '9')) : endif;

        if ($_POST['check_post']){$argument['post__in'] = $_POST['check_post'];}

        if ($_POST['check_region']){
            $data_region = array(
                'key' => 'region',
                'value' => $_POST['check_region'],
                'type' => 'BINARY'
            );
            array_push($mete_query_array, $data_region);
        }

        if ($_POST['check_address']){
            $data_address = array(
                'key' => 'address',
                'value' => $_POST['address_school'],
                'type' => 'BINARY'
            );
            array_push($mete_query_array, $data_address);
        }

        if ($_POST['check_open']) {
            $data_open = array(
                'key' => 'open',
                'value' => $_POST['check_open'],
                'type' => 'BINARY'
            );
            array_push($mete_query_array, $data_open);
        }

        if ($_POST['check_director']) {
            $data_director = array(
                'key' => 'director',
                'value' => $_POST['check_director'],
                'type' => 'BINARY'
            );
            array_push($mete_query_array, $data_director);
        }

        $argument['meta_query'] = $mete_query_array;
        if($argument):
            $query = new WP_Query($argument);
            if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();
                    $img_post = get_the_post_thumbnail();
                    echo '<article id="post_id-'. get_the_ID() .'" class="post_preview">';
                    echo '<figure>';
                    echo '<a href="'. get_the_permalink() .'">'. $img_post .'</a>';
                    echo '</figure>';
                    echo '<div class="post_content">';
                    echo '<h4 class="post_preview_title">'. get_the_title() .'</h4><!-- .post_preview_title -->';
                    echo '<div class="text_post_block">'. get_the_content() .'</div><!-- .text_post_block -->';
                    echo '<div class="more_post_block"><a href="'. get_the_permalink() .'" class="more_view_post">more</a></div>';
                    echo '</div><!-- .post_content -->';
                    echo '</article><!-- .post_preview -->';
                endwhile;
            endif;
        endif;
    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_archive_sort_widget', 'archive_sort_widget');
add_action('wp_ajax_nopriv_archive_sort_widget', 'archive_sort_widget');