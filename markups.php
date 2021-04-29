<?php
function gc_get_channel_options_default_markup()
{ ?>
    <h1>Channel Options</h1>
    <form action="some-page.php" method="post">

        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="gcklr_category">Category</label>
                    </th>
                    <td>
                        <select id="gcklr_category" name="gcklr_category">
                            <option>Select Category</option>

                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="website">Website</label>
                    </th>

                    <td>
                        <input type="text" id="website" name="website">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="twitter">Twitter</label>
                    </th>

                    <td>
                        <input type="text" id="twitter" name="twitter">
                        <br>
                        <span class="description">Twitter link</span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="facebook">Facebook</label>
                    </th>

                    <td>
                        <input type="text" id="facebook" name="facebook">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="instagram">Instagram</label>
                    </th>

                    <td>
                        <input type="text" id="instagram" name="instagram">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="youtube">Youtube</label>
                    </th>

                    <td>
                        <input type="text" id="youtube" name="youtube">
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit"><input type="submit" value="Save Changes" class="button-primary" name="Submit"></p>
    </form>
<?php
}

function gc_get_channel_options_manage_categories_markup()
{
    $saved_categories = gc_get_saved_categories();
?>
    <div class="wrap">
        <form action="admin-post.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="gc_add_category">
            <?php wp_nonce_field("gc_add_category_verify"); ?>
            <input type="text" name="gc_category" placeholder="Add Category" />
            <button type="submit" class="button button-primary button-large">Add</button>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($saved_categories as $cat) { ?>
                <tr>
                    <td>
                        <?= $cat[CATEGORY_NAME_KEY] ?>
                    </td>
                    <td>
                        <span class="dashicons dashicons-edit"></span>
                        <span class="dashicons dashicons-trash"></span>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}


function gc_channel_options_markup()
{
    //check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    //Get the active tab from the $_GET param
    $default_tab = null;
    $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;

?>
    <!-- Our admin page content should all be inside .wrap -->
    <div class="wrap">
        <!-- Print the page title -->
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <!-- Here are our tabs -->
        <nav class="nav-tab-wrapper">
            <a href="?page=gcklr_channel_options" class="nav-tab <?php if ($tab === null) : ?>nav-tab-active<?php endif; ?>">Channel Options</a>
            <a href="?page=gc_channel_options&tab=manage_categories" class="nav-tab <?php if ($tab === 'settings') : ?>nav-tab-active<?php endif; ?>">Manage Categories</a>
        </nav>

        <div class="tab-content">
            <?php switch ($tab):
                case 'manage_categories':
                    echo gc_get_channel_options_manage_categories_markup();
                    break;
                default:
                    echo gc_get_channel_options_default_markup();
                    break;
            endswitch; ?>
        </div>
    </div>
<?php
}
