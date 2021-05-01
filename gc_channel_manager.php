<?php

/**
 * Plugin Name: Gracklerr Channel Manager
 * Description: Manages the entire Channel creation process
 * Version: 1.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Zainul Abideen
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: gc_channel_manager
 * Domain Path: /languages
 */
ini_set('memory_limit', '1024M');
@ini_set('post_max_size', '120M');
@ini_set('max_execution_time', '300');

define("CATEGORIES_META_KEY", "gc_categories");
define("CATEGORY_NAME_KEY", "name");
define("CATEGORY_IMAGE_KEY", "image");


include(plugin_dir_path(__FILE__) . 'utils.php');
include(plugin_dir_path(__FILE__) . 'markups.php');

function wp_enque_styles_n_scripts()
{
    global $post;
    // Custom
    wp_enqueue_style('gc_style_css', plugins_url('/style.css', __FILE__));
    wp_enqueue_script('gc_script_js', plugins_url('/script.js', __FILE__), array());

    wp_localize_script(
        'gc_script_js',
        'gc_script_params',
        array(
            'ajaxurl' => admin_url('admin-ajax.php')
        )
    );
}
add_action('admin_enqueue_scripts', 'wp_enque_styles_n_scripts');

add_action('admin_menu', 'gc_menu');
function gc_menu()
{
    add_menu_page('Channel Options', 'Channel Options', 'manage_options', 'gc_channel_options', 'gc_channel_options_markup');
}


add_action("admin_post_gc_add_category", "gc_add_category");
function gc_add_category()
{
    /**
     * Sample category arr
     * array(
     *  array(
     *      "name" => "category name"
     *      "image" => "image url"
     *  )
     * )
     */
    if (!current_user_can('edit_theme_options')) wp_die('You are not allowed to be on this page');
    check_admin_referer("gc_add_category_verify");
    $status = "";
    $category = $_POST['gc_category'];
    $old_category = $_POST['gc_old_category'];

    $cat = array(
        CATEGORY_NAME_KEY => $category,
        CATEGORY_IMAGE_KEY => ""
    );

    if (!empty($old_category)) {
        $old_category_index = gc_get_category_index($old_category);
        $saved_categories = gc_get_saved_categories();
        $prev_val = $saved_categories[$old_category_index];
        update_site_meta(get_current_blog_id(), CATEGORIES_META_KEY, $cat, $prev_val);
    } else {
        add_site_meta(get_current_blog_id(), CATEGORIES_META_KEY, $cat);
    }
    $status = "CATEGORY_ADDED_SUCCESSFULLY";
    wp_redirect(admin_url('admin.php?page=gc_channel_options&tab=manage_categories&status=' . $status));
}

add_action("wp_ajax_gc_update_category", "gc_update_category");
function gc_update_category()
{
    $old_value = $_POST['old_value'];
    $new_value = $_POST['new_value'];
    $saved_categories = gc_get_saved_categories();
    $category_index = gc_get_category_index($old_value);
    $updated_val = array(
        CATEGORY_NAME_KEY => $new_value,
        CATEGORY_IMAGE_KEY => ""
    );
    $prev_val = $saved_categories[$category_index];
    update_site_meta(get_current_blog_id(), CATEGORIES_META_KEY, $updated_val, $prev_val);
}
