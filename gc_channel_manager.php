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

    $cat = array(
        CATEGORY_NAME_KEY => $category,
        CATEGORY_IMAGE_KEY => ""
    );
    add_site_meta(get_current_blog_id(), CATEGORIES_META_KEY, $cat);
    // delete_site_meta(get_current_blog_id(), CATEGORIES_META_KEY);
    $status = "CATEGORY_ADDED_SUCCESSFULLY";
    wp_redirect(admin_url('admin.php?page=gc_channel_options&tab=manage_categories&status=' . $status));
}
