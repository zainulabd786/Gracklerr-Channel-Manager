<?php
function gc_get_channel_options_default_markup()
{ ?>


    <?php wp_nonce_field("gc_registration_form_submit_verify"); ?>
    <h1>Channel Options</h1>
    <form action="admin-post.php" method="post">
        <input type="hidden" name="action" value="gc_registration_form_submit">
        <input type="hidden" name="redirect_url" value="<?= admin_url('admin.php?page=gc_channel_options') ?>">
        <input type="hidden" name="is_updating" value="true">
        <input type="hidden" name="gc_current_blog_id" value="<?= get_current_blog_id() ?>">
        <input type="hidden" name="<?= CHANNEL_NAME_KEY ?>" value="<?= get_blog_option(get_current_blog_id(), CHANNEL_NAME_KEY) ?>">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="<?= CATEGORIES_INPUT_KEY ?>">Category</label>
                    </th>
                    <td>
                        <select id="<?= CATEGORIES_INPUT_KEY ?>" name="<?= CATEGORIES_INPUT_KEY ?>">
                            <option>Select Category</option>
                            <?php
                            foreach (gc_get_saved_categories() as $cat) { ?>
                                <option <?= get_blog_option(get_current_blog_id(), CATEGORIES_INPUT_KEY) === $cat[CATEGORY_NAME_KEY] ? "selected" : "" ?> value="<?= $cat[CATEGORY_NAME_KEY] ?>"><?= $cat[CATEGORY_NAME_KEY] ?></option>
                            <?php
                            } ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="<?= PHONE_NUMBER_KEY ?>">Phone Number</label>
                    </th>

                    <td>
                        <input type="text" id="<?= PHONE_NUMBER_KEY ?>" name="<?= PHONE_NUMBER_KEY ?>" value="<?= get_blog_option(get_current_blog_id(), PHONE_NUMBER_KEY) ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="<?= STREET_ADDRESS_KEY ?>">Street Address</label>
                    </th>

                    <td>
                        <textarea id="<?= STREET_ADDRESS_KEY ?>" name="<?= STREET_ADDRESS_KEY ?>">
                            <?= get_blog_option(get_current_blog_id(), STREET_ADDRESS_KEY) ?>
                    </textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="<?= POSTAL_CODE_KEY ?>">Postal Code</label>
                    </th>

                    <td>
                        <input type="text" id="<?= POSTAL_CODE_KEY ?>" name="<?= POSTAL_CODE_KEY ?>" value="<?= get_blog_option(get_current_blog_id(), POSTAL_CODE_KEY) ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="<?= STATE_KEY ?>">State</label>
                    </th>

                    <td>
                        <input type="text" id="<?= STATE_KEY ?>" name="<?= STATE_KEY ?>" value="<?= get_blog_option(get_current_blog_id(), STATE_KEY) ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="<?= COUNTRY_KEY ?>">Country</label>
                    </th>

                    <td>
                        <input type="text" id="<?= COUNTRY_KEY ?>" name="<?= COUNTRY_KEY ?>" value="<?= get_blog_option(get_current_blog_id(), COUNTRY_KEY) ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="<?= STATE_KEY ?>">State</label>
                    </th>

                    <td>
                        <input type="text" id="<?= STATE_KEY ?>" name="<?= STATE_KEY ?>" value="<?= get_blog_option(get_current_blog_id(), STATE_KEY) ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="<?= SHORT_DESCRIPTION_KEY ?>">Short Description</label>
                    </th>

                    <td>
                        <textarea id="<?= SHORT_DESCRIPTION_KEY ?>" name="<?= SHORT_DESCRIPTION_KEY ?>">
                            <?= get_blog_option(get_current_blog_id(), SHORT_DESCRIPTION_KEY) ?>
                    </textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="<?= DESCRIPTION_KEY ?>">Description</label>
                    </th>

                    <td>
                        <textarea id="<?= DESCRIPTION_KEY ?>" name="<?= DESCRIPTION_KEY ?>">
                            <?= get_blog_option(get_current_blog_id(), DESCRIPTION_KEY) ?>
                    </textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="website">Website</label>
                    </th>

                    <td>
                        <input type="text" id="<?= WEBSITE_KEY ?>" name="<?= WEBSITE_KEY ?>" value="<?= get_blog_option(get_current_blog_id(), WEBSITE_KEY) ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="facebook">Facebook</label>
                    </th>

                    <td>
                        <input type="text" id="<?= FACEBOOK_KEY ?>" name="<?= FACEBOOK_KEY ?>" value="<?= get_blog_option(get_current_blog_id(), FACEBOOK_KEY) ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="twitter">Twitter</label>
                    </th>

                    <td>
                        <input type="text" id="<?= TWITTER_KEY ?>" name="<?= TWITTER_KEY ?>" value="<?= get_blog_option(get_current_blog_id(), TWITTER_KEY) ?>">
                        <br>
                        <span class="description">Twitter link</span>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="<?= INSTAGRAM_KEY ?>">Instagram</label>
                    </th>

                    <td>
                        <input type="text" id="<?= INSTAGRAM_KEY ?>" name="<?= INSTAGRAM_KEY ?>" value="<?= get_blog_option(get_current_blog_id(), INSTAGRAM_KEY) ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="<?= YOUTUBE_KEY ?>">Youtube</label>
                    </th>

                    <td>
                        <input type="text" id="<?= YOUTUBE_KEY ?>" name="<?= YOUTUBE_KEY ?>" value="<?= get_blog_option(get_current_blog_id(), YOUTUBE_KEY) ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="<?= LINKEDIN_KEY ?>">LinkedIn</label>
                    </th>

                    <td>
                        <input type="text" id="<?= LINKEDIN_KEY ?>" name="<?= LINKEDIN_KEY ?>" value="<?= get_blog_option(get_current_blog_id(), LINKEDIN_KEY) ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="<?= SNAPCHAT_KEY ?>">Snapchat</label>
                    </th>

                    <td>
                        <input type="text" id="<?= SNAPCHAT_KEY ?>" name="<?= SNAPCHAT_KEY ?>" value="<?= get_blog_option(get_current_blog_id(), SNAPCHAT_KEY) ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="<?= TIKTOK_KEY ?>">TikTok</label>
                    </th>

                    <td>
                        <input type="text" id="<?= TIKTOK_KEY ?>" name="<?= TIKTOK_KEY ?>" value="<?= get_blog_option(get_current_blog_id(), TIKTOK_KEY) ?>">
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit"><input type="submit" value="Save Changes" class="button-primary" name="Submit"></p>
    </form>
<?php
}

function gc_manage_categories_markup()
{
    $saved_categories = gc_get_saved_categories();
?>
    <div class="wrap">
        <form action="<?php echo admin_url('/admin-post.php'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="gc_add_category">
            <?php wp_nonce_field("gc_add_category_verify"); ?>
            <input type="text" name="gc_category" placeholder="Add Category" id="gc_category_input" />
            <input type="hidden" name="gc_old_category" id="gc_old_category_input" />
            <button type="submit" class="button button-primary button-large">Add</button>
        </form>
    </div>
    <table id="gc_admin_table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($saved_categories as $cat) {
                gc_get_category_index($cat[CATEGORY_NAME_KEY]); ?>
                <tr>
                    <td>
                        <?= $cat[CATEGORY_NAME_KEY] ?>
                    </td>
                    <td>
                        <span data-category="<?= $cat[CATEGORY_NAME_KEY] ?>" class="dashicons dashicons-edit gc_category_action_icon gc_edit_category_icon"></span>
                        <span data-category="<?= $cat[CATEGORY_NAME_KEY] ?>" class="dashicons dashicons-trash gc_category_action_icon gc_delete_category_icon"></span>
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
            <a href="?page=gc_channel_options" class="nav-tab <?php if ($tab === null) : ?>nav-tab-active<?php endif; ?>">Channel Options</a>

        </nav>

        <div class="tab-content">
            <?php switch ($tab):
                    // case 'manage_categories':
                    //     echo gc_get_channel_options_manage_categories_markup();
                    //     break;
                default:
                    echo gc_get_channel_options_default_markup();
                    break;
            endswitch; ?>
        </div>
    </div>
<?php
}

function gc_get_channel_registration_form($order_id)
{
    global $post;
    $order = new WC_Order($order_id);
    $email = $order->get_billing_email();
    $first_name = $order->get_billing_first_name();
    $last_name = $order->get_billing_last_name();
    $phone = $order->get_billing_phone();
    $postcode = $order->get_billing_postcode();
    $state = $order->get_billing_state();
    $city = $order->get_billing_city();
    $country = $order->get_billing_country();
    $address = $order->get_billing_address_1(); ?>

    <div class="container">
        <form action="<?= admin_url('admin-post.php') ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="gc_registration_form_submit">
            <input type="hidden" name="redirect_url" value="<?= get_home_url() . '?' ?>">
            <?php wp_nonce_field("gc_registration_form_submit_verify"); ?>
            <h3>CREATE YOUR CHANNEL NOW</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?= $first_name ?>" id="first-name" name="<?= FIRST_NAME_KEY ?>" placeholder="First Name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="last-name" value="<?= $last_name ?>" name="<?= LAST_NAME_KEY ?>" placeholder="Last Name" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="channel-name" name="<?= CHANNEL_NAME_KEY ?>" placeholder="Please enter your preferred channel name" required>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <input type="text" placeholder="Phone Number" class="form-control" value="<?= $phone ?>" name="<?= PHONE_NUMBER_KEY ?>" id="phone-number" required>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select class="form-control" id="categories" name="<?= CATEGORIES_INPUT_KEY ?>" required>
                            <option value="">Category</option>
                            <?php
                            foreach (gc_get_saved_categories() as $cat) { ?>
                                <option value="<?= $cat[CATEGORY_NAME_KEY] ?>"><?= $cat[CATEGORY_NAME_KEY] ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                </div>
            </div>

            <h3>Address</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea placeholder="Street Address" class="form-control" name="<?= STREET_ADDRESS_KEY ?>" id="street-address" rows="3" required><?= $address ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <input type="text" class="form-control" id="city" value="<?= $city ?>" placeholder="City" name="<?= CITY_KEY ?>" required>
                            </div>
                            <input type="text" value="<?= $postcode ?>" class="form-control" id="postal-code" name="<?= POSTAL_CODE_KEY ?>" placeholder="Postal Code" required>
                        </div>

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <input type="text" class="form-control" id="state" name="<?= STATE_KEY ?>" value="<?= $state ?>" placeholder="State/Region" required>
                            </div>
                            <input type="text" class="form-control" id="country" name="<?= COUNTRY_KEY ?>" value="<?= $country ?>" placeholder="Country" required>
                        </div>

                    </div>
                </div>
            </div>

            <h4>Enter your website link and your social media links below</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="website" name="<?= WEBSITE_KEY ?>" placeholder="Website">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="facebook" name="<?= FACEBOOK_KEY ?>" placeholder="Facebook">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="twitter" name="<?= TWITTER_KEY ?>" placeholder="Twitter">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="instagram" name="<?= INSTAGRAM_KEY ?>" placeholder="Instagram">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="youtube" name="<?= YOUTUBE_KEY ?>" placeholder="Youtube">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="linkedin" name="<?= LINKEDIN_KEY ?>" placeholder="LinkedIn">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="snapchat" name="<?= SNAPCHAT_KEY ?>" placeholder="Snapchat">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="tiktok" name="<?= TIKTOK_KEY ?>" placeholder="TikTok">
                    </div>
                </div>
            </div>

            <h3>Description</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea placeholder="Short Description" class="form-control" name="<?= SHORT_DESCRIPTION_KEY ?>" id="short-description" rows="3" required maxlength="100"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea placeholder="Discription" class="form-control" name="<?= DESCRIPTION_KEY ?>" id="description" rows="3" required maxlength="250"></textarea>
                    </div>
                </div>
            </div>

            <h3>Login Information</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="email" value="<?= $email ?>" class="form-control" id="email" name="<?= EMAIL_KEY ?>" placeholder="Email">
                        <div id="email-error-msg" class="error-msg"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
                    </div>
                    <div id="password-error-msg" class="error-msg"></div>
                </div>
            </div>

            <button id="gcklr-reg-submit-btn" class="btn btn-primary">Build My channel</button>

        </form>
    </div>
<?php
}



function gc_render_channel_markup()
{
    $website =
        get_blog_option(get_current_blog_id(), WEBSITE_KEY);
    $facebook =
        get_blog_option(get_current_blog_id(), FACEBOOK_KEY);
    $instagram
        = get_blog_option(get_current_blog_id(), INSTAGRAM_KEY);
    $twitter =
        get_blog_option(get_current_blog_id(), TWITTER_KEY);
    $youtube =
        get_blog_option(get_current_blog_id(), YOUTUBE_KEY);
    $linkedin =
        get_blog_option(get_current_blog_id(), LINKEDIN_KEY);
    $snapchat =
        get_blog_option(get_current_blog_id(), SNAPCHAT_KEY);
    $tiktok =
        get_blog_option(get_current_blog_id(), TIKTOK_KEY);
?>
    <div class="container">
        <!-- Banner Image -->
        <div class="row">
            <div class="col-sm-12">
                <div class="banner-image">
                    <img src="https://gracklerr.com/wp-content/uploads/2021/05/Other.jpg" />
                </div>
            </div>
        </div><!-- row -->

        <div class="row">
            <div class="col-sm-5 position-relative">
                <!-- Profile Image -->
                <div class="profile_image position-absolute">
                    <img src="https://gracklerr.com/wp-content/uploads/2021/03/Leonardo-DiCaprio.png" />
                    <div class="name h2">
                        <?= get_blog_option(get_current_blog_id(), CHANNEL_NAME_KEY) ?>
                        <a href="<?= get_site_url(get_current_blog_id()) ?>/wp-admin/admin.php?page=gc_channel_options" target="_blank"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <?php if (!empty($categories)) { ?>
                    <div class="text-right mb-2 mt-3">
                        Category: <?= get_blog_option(get_current_blog_id(), CATEGORIES_INPUT_KEY) ?>
                    </div><?php
                        } ?>

                <div class="d-flex justify-content-end align-items-center my-2">
                    <div class="hamburger mx-4">
                        <div class="dropdown-container">
                            <button class="drop-btn text-dark bg-white p-0">
                                <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-content"><?php
                                                            if (!empty($website))
                                                                echo '
                            <a href="' . $website . '" target="_blank">
                                <i class="fa fa-link" aria-hidden="true"></i> Website
                            </a>
                            ';

                                                            if (!empty($facebook))
                                                                echo '
                            <a href="' . $facebook . '" target="_blank">
                                <i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook
                            </a>
                            ';

                                                            if (!empty($twitter))
                                                                echo '
                            <a href="' . $twitter . '" target="_blank">
                                <i class="fa fa-twitter-square" aria-hidden="true"></i> Twitter
                            </a>
                            ';

                                                            if (!empty($instagram))
                                                                echo '
                            <a href="' . $instagram . '" target="_blank">
                                <i class="fa fa-instagram" aria-hidden="true"></i> Instagram
                            </a>
                            ';

                                                            if (!empty($youtube))
                                                                echo '
                            <a href="' . $youtube . '" target="_blank">
                                <i class="fa fa-youtube-play" aria-hidden="true"></i> YouTube
                            </a>
                            ';

                                                            if (!empty($linkedin))
                                                                echo '
                            <a href="' . $linkedin . '" target="_blank">
                                <i class="fa fa-linkedin-square" aria-hidden="true"></i> Linkedin
                            </a>
                            ';

                                                            if (!empty($snapchat))
                                                                echo '
                            <a href="' . $snapchat . '" target="_blank">
                                <i class="fa fa-snapchat-square" aria-hidden="true"></i> Snapchat
                            </a>
                            ';

                                                            if (!empty($tiktok))
                                                                echo '
                            <a href="' . $tiktok . '" target="_blank">
                                <i class="fa fa-external-link" aria-hidden="true"></i> TikTok
                            </a>
                            ';


                                                            ?>
                            </div>
                        </div>

                    </div>
                    <div class="notification mx-4">
                        <div class="dropdown-container">
                            <button class="drop-btn text-dark bg-white p-0">
                                <i class="fa fa-bell-o fa-2x" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-content">
                                <a href="#">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Subscribe
                                </a>
                                <a href="#">
                                    <i class="fa fa-reply" aria-hidden="true"></i> Author’s replies
                                </a>
                                <a href="#">
                                    <i class="fa fa-bell-slash" aria-hidden="true"></i> Turn off
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="watching ml-4 py-3 px-4 h1 gc-bg text-white">
                        Watching
                    </div>
                </div>
                <div class="h2 text-right">
                    <a href="#" target="_blank">Option Available</a>
                </div>
            </div>
        </div> <!-- row -->
        <div class="row gc-bg text-white py-2 mt-2">
            <div class="col-sm-6">
                <div class="text-left h1">+ OPINIONS</div>
            </div>
            <div class="col-sm-6">
                <div class="text-right h1">- OPINIONS</div>
            </div>
        </div> <!-- row -->

        <div class="row">
            <div class="col-sm-12 px-0 py-1">
                <p><?= get_blog_option(get_current_blog_id(), SHORT_DESCRIPTION_KEY) ?></p>
            </div>
        </div>
    </div>
<?php
}
