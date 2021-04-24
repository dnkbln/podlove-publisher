<?php
// status: skeleton page, needs enabling via constant

namespace Podlove\Wizard;

use Podlove\Model\Podcast;

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

define('PODLOVE_WIZARD_URL_KEY', 'podlove-setup-wizard');
define('PODLOVE_DASHBOARD_URL_KEY', 'podlove_settings_handle');

add_action('wp_loaded', '\Podlove\Wizard\wizard_page', 9);
add_action('admin_notices', '\Podlove\Wizard\check_wizard');

function check_wizard()
{
    $podcast = Podcast::get();

    debug_to_console($podcast->wizard);

    if ($podcast->wizard === 0)
        return;

    if ($podcast->wizard > 0) {
        print_admin_notice_extend();
        return;
    }

    print_admin_notice();
}

function print_admin_notice()
{
    ?>
    <div class="update-message notice notice-warning notice-alt">
        <p>
        <?php echo __('You can setup the Podlove Podcasting Plugin with our Setup-Wizard', 'podlove-podcasting-plugin-for-wordpress'); ?>
        <a href="<?php echo admin_url('admin.php?page='.PODLOVE_WIZARD_URL_KEY); ?>"><?php echo __('Start the Setup Wizard', 'podlove-podcating-plugin-for-wordpress'); ?></a>
        </p>
  </div>
  <?php
}

function print_admin_notice_extend()
{
    // only show on podlove settings pages
    $page_key = filter_input(INPUT_GET, 'page');
    if (strpos($page_key, 'podlove') === false) {
        return;
    }

    ?>
    <div class="update-message notice notice-warning notice-alt">
        <p>
        <?php echo __('Extended Setup-Wizard', 'podlove-podcasting-plugin-for-wordpress'); ?>
        <a href="<?php echo admin_url('admin.php?page='.PODLOVE_WIZARD_URL_KEY); ?>"><?php echo __('Start the extended Setup Wizard', 'podlove-podcating-plugin-for-wordpress'); ?></a>
        </p>
  </div>
  <?php
}


function disable_wizard_page()
{
    $podcast = Podcast::get();
    $podcast->wizard = 0;
    $podcast->save();
}

function wizard_page()
{
    if (!isset($_GET['page'])) {
        return;
    }

    if ($_GET['page'] != PODLOVE_WIZARD_URL_KEY) {
        return;
    }
    wp_register_style('tailwind', \Podlove\PLUGIN_URL.'/css/tailwind.css', [], \Podlove\get_plugin_header('Version'));
    wp_enqueue_style('tailwind');

    wp_enqueue_script('podlove-episode-vue-apps', \Podlove\PLUGIN_URL.'/js/dist/app.js', ['underscore', 'jquery'], $version, true);

    wp_localize_script(
        'podlove-episode-vue-apps',
        'podlove_vue',
        [
            'rest_url' => esc_url_raw(rest_url()),
            'nonce' => wp_create_nonce('wp_rest'),
            'post_id' => get_the_ID(),
            'osf_active' => is_plugin_active('shownotes/shownotes.php'),
        ]
    );

    wp_enqueue_style('podlove-admin', \Podlove\PLUGIN_URL.'/css/admin.css', [], $version);
    wp_enqueue_style('podlove-admin-font', \Podlove\PLUGIN_URL.'/css/admin-font.css', [], $version);

    // chosen.js scripts & styles
    wp_enqueue_style('podlove-admin-chosen', \Podlove\PLUGIN_URL.'/js/admin/chosen/chosen.min.css', [], $version);
    wp_enqueue_style('podlove-admin-image-chosen', \Podlove\PLUGIN_URL.'/js/admin/chosen/chosenImage.css', [], $version);

    wp_enqueue_script('podlove_admin', \Podlove\PLUGIN_URL.'/js/dist/podlove-admin.js', [
        'jquery', 'jquery-ui-sortable', 'jquery-ui-datepicker',
    ], $version);

    wp_enqueue_style('jquery-ui-style', \Podlove\PLUGIN_URL.'/js/admin/jquery-ui/css/smoothness/jquery-ui.css');


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <title>Podlove Publisher | Setup Wizard</title>
</head>
<body>
    <div id="podlove-setup-wizard"></div>
    <?php wp_footer(); ?>
</body>
</html>
    <?php
    exit;
}
