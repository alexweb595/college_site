<?php
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