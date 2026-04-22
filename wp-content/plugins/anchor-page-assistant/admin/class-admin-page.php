<?php
/**
 * Admin Page — registers the plugin's admin menu and enqueues assets.
 *
 * @package Anchor_Page_Assistant
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class APA_Admin_Page {

    private static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
            self::$instance->init();
        }
        return self::$instance;
    }

    private function init() {
        add_action( 'admin_menu', [ $this, 'register_menu' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
    }

    public function register_menu() {
        add_menu_page(
            'Page Assistant',
            'Page Assistant',
            'manage_options',
            'anchor-page-assistant',
            [ $this, 'render_page' ],
            'dashicons-layout',
            30
        );

        add_submenu_page(
            'anchor-page-assistant',
            'Live Editor',
            'Live Editor',
            'manage_options',
            'apa-live-editor',
            [ $this, 'render_live_editor' ]
        );
    }

    public function enqueue_assets( $hook ) {
        $is_main = ( 'toplevel_page_anchor-page-assistant' === $hook );
        $is_live = ( 'page-assistant_page_apa-live-editor' === $hook );

        if ( ! $is_main && ! $is_live ) return;

        // Live editor gets its own minimal assets.
        if ( $is_live ) {
            wp_enqueue_style( 'apa-live-editor', APA_PLUGIN_URL . 'assets/css/live-editor.css', [], APA_VERSION );
            wp_enqueue_script( 'apa-live-editor', APA_PLUGIN_URL . 'assets/js/live-editor.js', [], APA_VERSION, true );
            wp_localize_script( 'apa-live-editor', 'apaLive', [
                'restBase' => rest_url( 'anchor-assistant/v1/' ),
                'nonce'    => wp_create_nonce( 'wp_rest' ),
                'siteUrl'  => home_url( '/' ),
                'pages'    => APA_Config_Manager::instance()->list_pages(),
            ] );
            return;
        }

        wp_enqueue_style(
            'apa-admin',
            APA_PLUGIN_URL . 'assets/css/admin.css',
            [],
            APA_VERSION
        );

        wp_enqueue_script(
            'apa-admin',
            APA_PLUGIN_URL . 'assets/js/admin-app.js',
            [],
            APA_VERSION,
            true
        );

        wp_enqueue_script(
            'apa-chat',
            APA_PLUGIN_URL . 'assets/js/chat-widget.js',
            [ 'apa-admin' ],
            APA_VERSION,
            true
        );

        wp_enqueue_style( 'dashicons' );

        wp_localize_script( 'apa-admin', 'apaData', [
            'restBase' => rest_url( 'anchor-assistant/v1/' ),
            'nonce'    => wp_create_nonce( 'wp_rest' ),
            'pages'    => APA_Config_Manager::instance()->list_pages(),
            'sections' => APA_Section_Registry::instance()->get_all(),
        ] );
    }

    public function render_page() {
        include APA_PLUGIN_DIR . 'templates/admin-page.php';
    }

    public function render_live_editor() {
        include APA_PLUGIN_DIR . 'templates/live-editor.php';
    }
}
