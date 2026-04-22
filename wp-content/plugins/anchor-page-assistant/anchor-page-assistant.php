<?php
/**
 * Plugin Name: Anchor Page Assistant
 * Description: AI-powered page builder and config manager for the Anchor Framework theme system.
 * Version:     0.2.0
 * Author:      Anchor
 * Requires PHP: 7.4
 * License:     GPL-2.0-or-later
 *
 * @package Anchor_Page_Assistant
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'APA_VERSION', '0.2.0' );
define( 'APA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'APA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Core includes.
require_once APA_PLUGIN_DIR . 'includes/class-config-writer.php';
require_once APA_PLUGIN_DIR . 'includes/class-file-writer.php';
require_once APA_PLUGIN_DIR . 'includes/class-section-schema.php';
require_once APA_PLUGIN_DIR . 'includes/class-prompt-builder.php';

// Admin.
require_once APA_PLUGIN_DIR . 'admin/class-config-manager.php';
require_once APA_PLUGIN_DIR . 'admin/class-section-registry.php';
require_once APA_PLUGIN_DIR . 'admin/class-ai-handler.php';
require_once APA_PLUGIN_DIR . 'admin/class-admin-page.php';
require_once APA_PLUGIN_DIR . 'admin/class-settings-page.php';
require_once APA_PLUGIN_DIR . 'admin/class-frontend-chat.php';

// REST API.
require_once APA_PLUGIN_DIR . 'api/class-rest-config.php';
require_once APA_PLUGIN_DIR . 'api/class-rest-sections.php';
require_once APA_PLUGIN_DIR . 'api/class-rest-ai.php';
require_once APA_PLUGIN_DIR . 'api/class-rest-menus.php';
require_once APA_PLUGIN_DIR . 'api/class-rest-media.php';
require_once APA_PLUGIN_DIR . 'api/class-rest-history.php';
require_once APA_PLUGIN_DIR . 'api/class-rest-files.php';

/**
 * Boot the plugin.
 */
function apa_init() {
    // Verify Anchor Framework is active.
    if ( ! function_exists( 'anchor_get_template_data' ) ) {
        add_action( 'admin_notices', function() {
            echo '<div class="notice notice-error"><p><strong>Anchor Page Assistant</strong> requires the Anchor Framework theme to be active.</p></div>';
        } );
        return;
    }

    // Initialize components.
    APA_Config_Manager::instance();
    APA_Section_Registry::instance();
    APA_AI_Handler::instance();
    APA_Admin_Page::instance();
    APA_Settings_Page::instance();
    APA_Frontend_Chat::instance();
    APA_REST_Config::instance();
    APA_REST_Sections::instance();
    APA_REST_AI::instance();
    APA_REST_Menus::instance();
    APA_REST_Media::instance();
    APA_REST_History::instance();
    APA_REST_Files::instance();
}
add_action( 'after_setup_theme', 'apa_init', 20 );
