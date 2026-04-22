<?php
/**
 * REST API — Section registry endpoint.
 *
 * @package Anchor_Page_Assistant
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class APA_REST_Sections {

    private static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
            self::$instance->init();
        }
        return self::$instance;
    }

    private function init() {
        add_action( 'rest_api_init', [ $this, 'register_routes' ] );
    }

    public function register_routes() {
        register_rest_route( 'anchor-assistant/v1', '/sections', [
            'methods'             => 'GET',
            'callback'            => [ $this, 'get_sections' ],
            'permission_callback' => function() {
                return current_user_can( 'manage_options' );
            },
        ] );

        register_rest_route( 'anchor-assistant/v1', '/sections/(?P<type>[a-z_]+)', [
            'methods'             => 'GET',
            'callback'            => [ $this, 'get_section' ],
            'permission_callback' => function() {
                return current_user_can( 'manage_options' );
            },
        ] );
    }

    public function get_sections() {
        return rest_ensure_response( APA_Section_Registry::instance()->get_all() );
    }

    public function get_section( $request ) {
        $schema = APA_Section_Registry::instance()->get( $request['type'] );
        if ( ! $schema ) {
            return new WP_REST_Response( [ 'error' => 'Unknown section type.' ], 404 );
        }
        return rest_ensure_response( $schema );
    }
}
