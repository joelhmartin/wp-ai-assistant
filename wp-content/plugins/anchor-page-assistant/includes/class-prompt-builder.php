<?php
/**
 * Prompt Builder — constructs the AI system prompt with full config context.
 *
 * @package Anchor_Page_Assistant
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class APA_Prompt_Builder {

    /**
     * Build the system prompt for the AI.
     *
     * @param string|null $page_slug    Current page being edited (null if editing a config).
     * @param string|null $config_key   Current config being edited (site, data, globals, media).
     * @param array|null  $post_context Post data when on a single blog/event post.
     * @return string The system prompt.
     */
    public static function build( $page_slug = null, $config_key = null, $post_context = null ) {
        $sections = APA_Section_Registry::instance()->get_all();
        $cm       = APA_Config_Manager::instance();

        $prompt = "You are the Anchor Page Assistant, an AI that helps build and edit WordPress pages.\n\n";

        // Architecture context
        $prompt .= "## How This System Works\n\n";
        $prompt .= "Pages are built from PHP config arrays. Each page has a 'sections' array. ";
        $prompt .= "Each section has a 'type', optional 'variant', and 'props' object. ";
        $prompt .= "You modify the config and return the updated JSON. The system writes it to a PHP file.\n\n";
        $prompt .= "Section-level options: 'flush_bottom' (bool) removes bottom padding.\n\n";

        // Available section types
        $prompt .= "## Available Section Types\n\n";
        foreach ( $sections as $type => $schema ) {
            $prompt .= "### {$schema['label']} (type: '{$type}')\n";
            $prompt .= "{$schema['description']}\n";
            if ( ! empty( $schema['variants'] ) ) {
                $prompt .= "Variants: " . implode( ', ', $schema['variants'] ) . "\n";
            }
            $prompt .= "Props:\n";
            foreach ( $schema['props'] as $key => $prop ) {
                $req  = ! empty( $prop['required'] ) ? ' (required)' : '';
                $def  = isset( $prop['default'] ) ? " Default: {$prop['default']}" : '';
                $opts = ! empty( $prop['options'] ) ? ' Options: ' . implode( '|', $prop['options'] ) : '';
                $prompt .= "  - {$key} ({$prop['type']}): {$prop['label']}{$req}{$def}{$opts}\n";
            }
            $prompt .= "\n";
        }

        // Media keys
        $media = $cm->get_media();
        if ( ! empty( $media ) ) {
            $prompt .= "## Available Media Keys\n\n";
            $prompt .= "Use these keys in any 'media' type prop. They resolve to actual URLs.\n";
            foreach ( $media as $key => $value ) {
                $display = is_string( $value ) ? $value : "(attachment #{$value})";
                $prompt .= "  - '{$key}' → {$display}\n";
            }
            $prompt .= "\n";
        }

        // Site config
        $site = $cm->get_site();
        if ( ! empty( $site ) ) {
            $prompt .= "## Site Info\n\n";
            $prompt .= "Business name: " . ( $site['name'] ?? 'Unknown' ) . "\n";
            if ( ! empty( $site['phone'] ) ) $prompt .= "Phone: {$site['phone']}\n";
            if ( ! empty( $site['email'] ) ) $prompt .= "Email: {$site['email']}\n";
            if ( ! empty( $site['address'] ) ) $prompt .= "Address: {$site['address']}\n";
            $prompt .= "\n";
        }

        // Shared data summary
        $data = $cm->get_data();
        if ( ! empty( $data['services'] ) ) {
            $prompt .= "## Services (from data.php)\n\n";
            foreach ( $data['services'] as $s ) {
                $prompt .= "  - {$s['title']} (id: {$s['id']}, icon: {$s['icon']}, url: {$s['url']})\n";
            }
            $prompt .= "\nYou can reference services by using anchor_get_data('services') in PHP, but for JSON output just include the data inline.\n\n";
        }
        if ( ! empty( $data['team'] ) ) {
            $prompt .= "## Team Members (from data.php)\n\n";
            foreach ( $data['team'] as $m ) {
                $prompt .= "  - {$m['name']} ({$m['role']})\n";
            }
            $prompt .= "\n";
        }

        // Current page context
        if ( $page_slug ) {
            $page_config = $cm->get_page( $page_slug );
            if ( ! is_wp_error( $page_config ) ) {
                $prompt .= "## Current Page: {$page_slug}\n\n";
                $prompt .= "Current config (JSON):\n```json\n";
                $prompt .= json_encode( $page_config, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
                $prompt .= "\n```\n\n";
            }
        }

        // Current config context
        if ( $config_key ) {
            $config_data = null;
            switch ( $config_key ) {
                case 'site':    $config_data = $cm->get_site(); break;
                case 'data':    $config_data = $cm->get_data(); break;
                case 'globals': $config_data = $cm->get_globals(); break;
                case 'media':   $config_data = $cm->get_media(); break;
            }
            if ( $config_data ) {
                $prompt .= "## Current Config: {$config_key}.php\n\n";
                $prompt .= "```json\n" . json_encode( $config_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ) . "\n```\n\n";
            }
        }

        // Navigation menus
        $locations = get_nav_menu_locations();
        if ( ! empty( $locations ) ) {
            $prompt .= "## Navigation Menus\n\n";
            $prompt .= "Menus are managed via WordPress menus (not config files). You can modify them via the REST API.\n";
            $prompt .= "Available menu locations: " . implode( ', ', array_keys( $locations ) ) . "\n";
            foreach ( $locations as $loc => $menu_id ) {
                $items = wp_get_nav_menu_items( $menu_id );
                if ( $items ) {
                    $prompt .= "\n### Menu: {$loc}\n";
                    foreach ( $items as $item ) {
                        $indent = (int) $item->menu_item_parent > 0 ? '  ' : '';
                        $prompt .= "{$indent}- {$item->title} → {$item->url} (ID: {$item->ID})\n";
                    }
                }
            }
            $prompt .= "\nTo modify menus, output a JSON block with key \"menu_action\" instead of page config:\n";
            $prompt .= "```json\n{\"menu_action\": \"add_item\", \"location\": \"primary\", \"title\": \"New Page\", \"url\": \"/new-page/\", \"parent_id\": 0}\n```\n";
            $prompt .= "Actions: add_item, delete_item (with item id), replace_menu (with full tree array).\n\n";
        }

        // Blog/event post context
        if ( $post_context && is_array( $post_context ) ) {
            $prompt .= "## Current Post (WordPress Content)\n\n";
            $prompt .= "You are on a single blog post or event page. This is NOT a config-driven page.\n";
            $prompt .= "The page layout comes from a PHP template (single.php or single-anchor_event.php).\n";
            $prompt .= "The CONTENT is stored in the WordPress database, not in a config file.\n\n";
            $prompt .= "Post ID: {$post_context['id']}\n";
            $prompt .= "Type: {$post_context['type']}\n";
            $prompt .= "Title: {$post_context['title']}\n";
            $prompt .= "Content:\n```html\n{$post_context['content']}\n```\n\n";
            if ( ! empty( $post_context['excerpt'] ) ) {
                $prompt .= "Excerpt: {$post_context['excerpt']}\n";
            }
            if ( ! empty( $post_context['featured_image'] ) ) {
                $prompt .= "Featured image: {$post_context['featured_image']} (attachment ID: {$post_context['featured_image_id']})\n";
            } else {
                $prompt .= "Featured image: none set\n";
            }
            $prompt .= "\n";

            // Yoast SEO context
            if ( ! empty( $post_context['seo'] ) ) {
                $seo = $post_context['seo'];
                $prompt .= "### Yoast SEO Meta\n";
                $prompt .= "SEO Title: " . ( $seo['title'] ?: '(not set — WordPress will use post title)' ) . "\n";
                $prompt .= "Meta Description: " . ( $seo['description'] ?: '(not set)' ) . "\n";
                $prompt .= "Focus Keyword: " . ( $seo['focus_kw'] ?: '(not set)' ) . "\n";
                if ( $seo['canonical'] ) $prompt .= "Canonical URL: {$seo['canonical']}\n";
                if ( $seo['og_title'] ) $prompt .= "OG Title: {$seo['og_title']}\n";
                if ( $seo['og_desc'] ) $prompt .= "OG Description: {$seo['og_desc']}\n";
                $prompt .= "\n";
            }

            $prompt .= "### How to edit this post\n";
            $prompt .= "Output a JSON block with key \"post_action\":\n";
            $prompt .= "```json\n";
            $prompt .= "{\n";
            $prompt .= "  \"post_action\": \"update\",\n";
            $prompt .= "  \"post_id\": {$post_context['id']},\n";
            $prompt .= "  \"title\": \"New Title\",\n";
            $prompt .= "  \"content\": \"<h2>Section</h2><p>HTML content here.</p>\",\n";
            $prompt .= "  \"excerpt\": \"Short description for archives.\",\n";
            $prompt .= "  \"featured_image_id\": 123,\n";
            $prompt .= "  \"seo_title\": \"SEO Title | Brand\",\n";
            $prompt .= "  \"seo_description\": \"Meta description for search engines.\",\n";
            $prompt .= "  \"seo_focus_kw\": \"focus keyword\"\n";
            $prompt .= "}\n```\n";
            $prompt .= "Only include fields you want to change. For featured_image_id, use a WordPress attachment ID.\n";
            $prompt .= "If the user uploaded or selected an image, use that attachment ID for featured_image_id.\n";
            $prompt .= "Do NOT try to edit the page template or config — this page's content lives in the WP database.\n\n";
        }

        // Response format instructions
        $prompt .= "## Response Format\n\n";
        $prompt .= "When the user asks you to make changes, respond with:\n";
        $prompt .= "1. A brief explanation of what you're changing\n";
        $prompt .= "2. The updated config as a JSON code block tagged ```json\n";
        $prompt .= "3. The JSON must be the COMPLETE config (not a partial diff)\n\n";
        $prompt .= "When the user asks a question (not a change), just answer normally without JSON.\n\n";
        $prompt .= "IMPORTANT: Only output valid JSON in code blocks. The system will parse it and write it to the config file.\n";

        return $prompt;
    }
}
