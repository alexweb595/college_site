<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package college
 */
?>
<?php
// Vars data sort =============== //
$cat_id = array();
$cat_name = array();
$cat_name_id = array();
$post_title = array();
$post_id = array();
$post_title_id = array();
$region_field = array();
$address_field = array();
$open_field = array();
$director_field = array();
// query === //
$argument = array(
    'child_of' => 5,
    'parent' => 5,
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
    wp_reset_postdata();
    $cat_name_id = array_combine($cat_id, $cat_name);
    $post_title_id = array_combine($post_id, $post_title);
    asort($post_title_id);
    reset($post_title_id);
endif;
?>
<aside id="secondary" class="widget-area" role="complementary">
    <div class="sort_college_widget">
        <div class="section_title">Sort College</div><!-- .section_title -->
        <div class="row_flex">
            <div class="column">
                <p><?php echo get_cat_name(5); ?></p>
                <div class="column_scroll">
                    <?
                    $i = 0;
                    foreach ($cat_name_id as $cat_id => $cat_name) :
                        $i++;
                        echo '<span class="check"><input type="checkbox" class="option_cat" id="option_cat' . $i . '" value="' . $cat_id . '"><label for="option_cat' . $i . '">' . $cat_name . '</label></span>';
                    endforeach;
                    ?>
                </div><!-- .column_scroll -->
            </div><!-- .column -->

            <div class="column">
                <p>College</p>
                <div class="column_scroll">
                    <?php
                    $r = 0;
                    foreach ($post_title_id as $post_id => $post_title) :
                        $r++;
                        echo '<span class="check"><input type="checkbox" class="option_college" id="option_college' . $r . '" value="' . $post_id . '"><label for="option_college' . $r . '">' . $post_title . '</label></span>';
                    endforeach;
                    ?>
                </div><!-- .column_scroll -->
            </div><!-- .column -->

            <div class="column">
                <p>Region</p>
                <div class="column_scroll">
                    <?php
                    $c = 0;
                    $region_field = array_unique($region_field);
                    foreach ($region_field as $region) :
                        $c++;
                        echo '<span class="check"><input type="checkbox" class="option_region" id="option_region' . $c . '" value="' . $region . '"><label for="option_region' . $c . '">' . $region . '</label></span>';
                    endforeach;
                    ?>
                </div><!-- .column_scroll -->
            </div><!-- .column -->

            <div class="column">
                <p>Address</p>
                <div class="column_scroll">
                    <?php
                    $y = 0;
                    $address_field = array_unique($address_field);
                    foreach ($address_field as $address) :
                        $y++;
                        echo '<span class="check"><input type="checkbox" class="option_address" id="option_address' . $y . '" value="' . $address . '"><label for="option_address' . $y . '">' . $address . '</label></span>';
                    endforeach;
                    ?>
                </div><!-- .column_scroll -->
            </div><!-- .column -->

            <div class="column">
                <p>Open</p>
                <div class="column_scroll">
                    <?php
                    $k = 0;
                    $open_field = array_unique($open_field);
                    foreach ($open_field as $open) :
                        $k++;
                        echo '<span class="check"><input type="checkbox" class="option_open" id="option_open' . $k . '" value="' . $open . '"><label for="option_open' . $k . '">' . $open . '</label></span>';
                    endforeach;
                    ?>
                </div><!-- .column_scroll -->
            </div><!-- .column -->

            <div class="column">
                <p>Director</p>
                <div class="column_scroll">
                    <?php
                    $t = 0;
                    $director_field = array_unique($director_field);
                    foreach ($director_field as $director) :
                        $t++;
                        echo '<span class="check"><input type="checkbox" class="option_director" id="option_director' . $t . '" value="' . $director . '"><label for="option_director' . $t . '">' . $director . '</label></span>';
                    endforeach;
                    ?>
                </div><!-- .column_scroll -->
            </div><!-- .column -->

            <div class="column">
                <p class="wrap_results">
                    <button id="results">Search results</button>
                    <button id="reset">Reset</button>
                </p>
            </div>

        </div><!-- .row_flex -->
    </div><!-- .sort_college_widget -->
</aside><!-- #secondary -->
