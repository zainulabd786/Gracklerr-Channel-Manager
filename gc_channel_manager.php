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
@ini_set('upload_max_size', '120M');
@ini_set('post_max_size', '120M');
@ini_set('max_execution_time', '300');

include(plugin_dir_path(__FILE__) . 'constants.php');
include(plugin_dir_path(__FILE__) . 'utils.php');
include(plugin_dir_path(__FILE__) . 'markups.php');

function wp_enque_admin_styles_n_scripts()
{


    // Custom
    wp_enqueue_style('gc_admin_style_css', plugins_url('/admin/style.css', __FILE__));
    wp_enqueue_script('gc_script_js', plugins_url('/script.js', __FILE__), array());



    wp_localize_script(
        'gc_script_js',
        'gc_script_params',
        array(
            'ajaxurl' => admin_url('admin-ajax.php')
        )
    );
}
add_action('admin_enqueue_scripts', 'wp_enque_admin_styles_n_scripts');

function wp_enque_styles_n_scripts()
{
    global $post;
    $pages_having_sc = having_shortcode("[gc_render_channel_template]");
    if (in_array($post->ID, $pages_having_sc))
        wp_enqueue_style('bootstrap-css', "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css");

    wp_enqueue_style('gc-font-awesome-css', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    wp_enqueue_style('gc_style_css', plugins_url('/styles.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'wp_enque_styles_n_scripts');

add_action('admin_menu', 'gc_menu');
function gc_menu()
{
    add_menu_page('Channel Options', 'Channel Options', 'manage_options', 'gc_channel_options', 'gc_channel_options_markup');
}

add_action('network_admin_menu', 'gc_network_menu');
function gc_network_menu()
{
    add_menu_page('Manage Categories', 'Manage Categories', 'manage_options', 'gc_manage_categories', 'gc_manage_categories_markup');
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
    $saved_categories = gc_get_saved_categories();
    $cat = array(
        CATEGORY_NAME_KEY => $category,
        CATEGORY_IMAGE_KEY => ""
    );
    if (!empty($old_category)) {
        $old_category_index = gc_get_category_index($old_category);

        $saved_categories[$old_category_index][CATEGORY_NAME_KEY] =
            $category;
        update_site_option(CATEGORIES_META_KEY, $saved_categories);
    } else {
        if (gc_get_saved_categories()) {
            array_push($saved_categories, $cat);
            update_site_option(CATEGORIES_META_KEY, $saved_categories);
        } else {
            add_site_option(CATEGORIES_META_KEY, array($cat));
        }
    }
    $status = "CATEGORY_ADDED_SUCCESSFULLY";
    wp_redirect(admin_url('network/admin.php?page=gc_manage_categories&status=' . $status));
}

// add_action("wp_ajax_gc_delete_category", "gc_delete_category");
// function gc_delete_category()
// {
//     $category = $_POST['category'];
//     $category_index = gc_get_category_index($category);
//     if ($category_index > -1) {
//         $saved_categories = gc_get_saved_categories();
//         $cat_to_delete = $saved_categories[$category_index];
//         delete_site_meta(get_current_blog_id(), CATEGORIES_META_KEY, $cat_to_delete);
//     }
// }


add_action("admin_post_gc_registration_form_submit", "gc_registration_form_submit");
add_action("admin_post_nopriv_gc_registration_form_submit", "gc_registration_form_submit");
function gc_registration_form_submit()
{
    $status = "err";
    $is_updating = (!empty($_POST['is_updating']) ? $_POST['is_updating'] : 'false') === 'true';
    $first_name = !empty($_POST[FIRST_NAME_KEY]) ? $_POST[FIRST_NAME_KEY] : "";
    $last_name = !empty($_POST[LAST_NAME_KEY]) ? $_POST[LAST_NAME_KEY] : "";
    $email = !empty($_POST[EMAIL_KEY]) ? $_POST[EMAIL_KEY] : "";
    $password = !empty($_POST[PASSWORD_KEY]) ? $_POST[PASSWORD_KEY] : "";
    $channel_name = !empty($_POST[CHANNEL_NAME_KEY]) ? $_POST[CHANNEL_NAME_KEY] : "";
    $site_id = !empty($_POST['gc_current_blog_id']) ? $_POST['gc_current_blog_id'] : "";
    $user = get_user_by('email', $email);
    $created_user_id = 0;
    $keys_to_remove_on_update = array(
        FIRST_NAME_KEY,
        LAST_NAME_KEY,
        EMAIL_KEY,
        PASSWORD_KEY,
        "gc_current_blog_id",
        "is_updating"
    );

    if (!$is_updating) {
        if ($user) {
            $created_user_id = $user->ID;
        } else {
            $created_user_id = wp_insert_user(array(
                "user_pass" => $password,
                "user_login" => $email,
                "user_email" => $email,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "role" => "admin"
            ));
        }

        $options = array(
            'template' => TEMPLATE,
            'stylesheet' => STYLESHEET,
            'show_on_front' => 'page',
        );
        $site_id = wpmu_create_blog(DOMAIN, PATH . sanitize_title_with_dashes($channel_name),  $channel_name, $created_user_id, $options);
        switch_to_blog($site_id);
        $channel_page_id = gc_create_template_page($channel_name, sanitize_title_with_dashes($channel_name));
        update_option('page_on_front', $channel_page_id);
        restore_current_blog();
    }
    foreach ($keys_to_remove_on_update as $key) {
        unset($_POST[$key]);
    }
    foreach ($_POST as $key => $value) {
        if (!get_option($key)) {
            add_blog_option($site_id, $key, $value);
        } else {
            update_blog_option($site_id, $key, $value);
        }
    }
    $status = "success";
    wp_redirect($_POST['redirect_url'] . '&status=' . $status);
}

add_action('woocommerce_thankyou', 'woocommerce_channel_registration_form', 4);
function woocommerce_channel_registration_form($order_id)
{
    echo do_shortcode('[gc_render_registration_form order_id="' . $order_id . '"]');
}



add_shortcode('gc_render_registration_form', 'gc_render_registration_form');
function gc_render_registration_form($atts)
{
    ob_start();

    $status = !empty($_GET['status']) ? $_GET['status'] : "";
    $atts = shortcode_atts(array(
        "order_id" => 0
    ), $atts, 'gc_render_registration_form');

    $order_id = $atts['order_id'];

    if ($status === "err") { ?>
        <div class="update-nag notice notice-error" role="alert">
            Error occured while Registering
        </div>
    <?php
    }
    if ($status === "success") { ?>
        <div class="update-nag notice notice-success" role="alert">
            Successfully registered
        </div>
<?php

    }
    gc_get_channel_registration_form($order_id);
    return ob_get_clean();
}



function gc_render_channel_template()
{
    return gc_render_channel_markup();
}
add_shortcode("gc_render_channel_template", "gc_render_channel_template");
