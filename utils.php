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


function gc_upload_attachment($file)
{
    // $file = $_FILES['<file input name>']
    $upload_dir = wp_upload_dir();
    $name = $file['name'];
    $tmp_name = $file['tmp_name'];
    $filepath = wp_mkdir_p($upload_dir['path']) ?
        $upload_dir['path'] . '/' . $name :
        $upload_dir['basedir'] . '/' . $name;

    move_uploaded_file($tmp_name, $filepath);

    $filetype = wp_check_filetype($name, null);

    $wp_file_attachment = array(
        'post_mime_type' => $filetype['type'],
        'post_title' => sanitize_file_name($name),
        'post_content' => '',
        'post_status' => 'inherit'
    );

    $file_attachment_id = wp_insert_attachment($wp_file_attachment, $filepath);

    require_once(ABSPATH . 'wp-admin/includes/image.php');

    $file_attachment_data = wp_generate_attachment_metadata($file_attachment_id, $filepath);

    wp_update_attachment_metadata($file_attachment_id, $file_attachment_data);

    return $file_attachment_id;
}