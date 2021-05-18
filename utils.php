<?php
function gc_get_category_index($cat)
{
    $index = -1;
    $saved_categories = gc_get_saved_categories();
    for ($i = 0; $i < count(gc_get_saved_categories()); $i++) {
        if ($saved_categories[$i][CATEGORY_NAME_KEY] === $cat) {
            $index = $i;
        }
    }
    return $index;
}

function gc_get_saved_categories()
{
    $saved_categories = get_site_option(CATEGORIES_META_KEY);
    return $saved_categories;
}


if (!function_exists('write_log')) {

    function write_log($log)
    {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}

function gc_create_template_page($channel_name, $channel_slug){
    $page_id = wp_insert_post(array(
        'post_title' => $channel_name,
        'post_type' => 'page',
        'post_name' => $channel_slug,
        'post_status' => 'publish',
        'post_content' => "[gc_render_channel_template]"
    ));
    return $page_id;
}


function having_shortcode($str)
{
    $query = new WP_Query("s='$str'");
    $arr = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $arr[] = get_the_ID();
        }
    }
    wp_reset_query();
    return $arr;
}