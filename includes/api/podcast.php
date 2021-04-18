<?php

namespace Podlove\Api\Podcast;

use Podlove\Model\Podcast;
use WP_Error;
use WP_REST_Controller;
use WP_REST_Server;
use WP_REST_Response;

add_action('rest_api_init', __NAMESPACE__.'\\api_init');

function api_init()
{
    register_rest_route('podlove/v1', 'podcast', [
        'methods' => 'GET',
        'callback' => __NAMESPACE__.'\\postcast_api',
        'permission_callback' => '__return_true',
    ]);
}

function postcast_api()
{
    $podcast = Podcast::get();

    return new \WP_REST_Response([
        'version' => 'v1',
        'title' => $podcast->title,
        'subtitle' => $podcast->subtitle,
    ]);
}

add_action( 'rest_api_init', function() {
        $controller = new WP_REST_Podlove_Controller();
        $controller->register_routes();
});

class WP_REST_Podlove_Controller extends WP_REST_Controller {
    /** 
     * Constructor.
     */
    public function __construct()
    {
        $this->namespace = 'podlove/v1';
        $this->rest_base = 'podlove';
    }

    /**
     * Register the component routes
     */
    public function register_routes()
    {
        register_rest_route( $this->namespace, '/'.$this->rest_base, array(
            array(
                'methods' => WP_REST_Server::READABLE,
                'callback' => array( $this, 'get_item'),
                'permission_callback' => array( $this, 'get_item_permissions_check'),
            ),
            array(
                'methods' => WP_REST_Server::EDITABLE,
                'callback' => array( $this, 'update_item'),
                'permission_callback' => array( $this, 'update_item_permissions_check')
            )
        ));
    }

    /**
     * Check permission for read
     */
    public function get_item_permissions_check($request)
    {
        return true;
    }

    /**
     * Check permission for change
     */
    public function update_item_permissions_check($request)
    {
        if (! current_user_can( 'manage_options')) {
            return new WP_Error('rest_forbidden', 
                esc_html__('sorry, you do not have permissions to use this REST API endpoint'),
                array('status' => 401));
        }
        return true;
    }

    public function get_item($request)
    {
        $podcast = Podcast::get();

        $res = [];
        $res['version'] = 'v1';
        $res['title'] = $podcast->title;
        $res['subtitle'] = $podcast->subtitle;
        $res['summary'] = $podcast->summary;
        $res['mnemonic'] = $podcast->mnemonic;
        if (get_option('podlove_disable_wizard'))
            $res['wizard'] = $podcast->wizard;

        return rest_ensure_response($res);
    }

    public function update_item($request)
    {
        $podcast = Podcast::get();
        if ( isset($request['title'])) {
            $podcast->__set('title', $request['title']);
        }
        if ( isset($request['subtitle'])) {
            $podcast->__set('subtitle', $request['subtitle']);
        }
        if ( isset($request['summary'])) {
            $podcast->__set('summary', $request['summary']);
        }
        if ( isset($request['mnemonic'])) {
            $podcast->__set('mnemonic', $request['mnemonic']);
        }
        if ( isset($request['wizard'])) {
            add_option('podlove_disable_wizard', true);
            $podcast->wizard = $request['wizard'];
        }

        $podcast->save();

        return new WP_REST_Response(null, 200);
    }
}