<?php
/**
 * Section Schema — JSON-style schema definitions for every section type.
 *
 * @package Anchor_Page_Assistant
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class APA_Section_Schema {

    /**
     * Get the full schema registry for all section types.
     *
     * @return array Keyed by section type.
     */
    public static function get_all() {
        return [
            'hero' => [
                'label'       => 'Hero',
                'description' => 'Full-viewport or short hero with background image, heading, and CTAs.',
                'variants'    => [ 'full', 'short', 'centered' ],
                'props'       => [
                    'eyebrow'       => [ 'type' => 'string', 'label' => 'Eyebrow text' ],
                    'heading'       => [ 'type' => 'string', 'label' => 'Heading' ],
                    'heading_lines' => [ 'type' => 'array', 'label' => 'Multi-line heading', 'item_shape' => [ 'text', 'style' ] ],
                    'text'          => [ 'type' => 'string', 'label' => 'Subtitle text' ],
                    'image'         => [ 'type' => 'media', 'label' => 'Background image' ],
                    'primary_cta'   => [ 'type' => 'cta', 'label' => 'Primary button' ],
                    'secondary_cta' => [ 'type' => 'cta', 'label' => 'Secondary button' ],
                    'ticker_items'  => [ 'type' => 'array', 'label' => 'Ticker items (strings)' ],
                    'values'        => [ 'type' => 'array', 'label' => 'Values strip (strings)' ],
                    'back_link'     => [ 'type' => 'cta', 'label' => 'Back navigation link' ],
                    'category'      => [ 'type' => 'string', 'label' => 'Category badge' ],
                    'min_height'    => [ 'type' => 'string', 'label' => 'CSS min-height override' ],
                ],
            ],

            'split_content' => [
                'label'       => 'Split Content',
                'description' => 'Two-column layout with image on one side and text on the other.',
                'variants'    => [],
                'props'       => [
                    'eyebrow'        => [ 'type' => 'string', 'label' => 'Eyebrow text' ],
                    'heading'        => [ 'type' => 'string', 'label' => 'Heading', 'required' => true ],
                    'heading_accent' => [ 'type' => 'string', 'label' => 'Accent text (appended)' ],
                    'text'           => [ 'type' => 'text', 'label' => 'Body text (string or array of paragraphs)' ],
                    'image'          => [ 'type' => 'media', 'label' => 'Image' ],
                    'image_alt'      => [ 'type' => 'string', 'label' => 'Image alt text' ],
                    'image_position' => [ 'type' => 'select', 'label' => 'Image position', 'options' => [ 'left', 'right' ], 'default' => 'left' ],
                    'badge'          => [ 'type' => 'object', 'label' => 'Floating badge', 'shape' => [ 'value', 'label' ] ],
                    'cta'            => [ 'type' => 'cta', 'label' => 'CTA button' ],
                    'aspect'         => [ 'type' => 'string', 'label' => 'Image aspect ratio', 'default' => '4/4' ],
                    'dark'           => [ 'type' => 'boolean', 'label' => 'Dark background' ],
                ],
            ],

            'text_block' => [
                'label'       => 'Text Block',
                'description' => 'Centered or left-aligned text section for mission statements or quotes.',
                'variants'    => [],
                'props'       => [
                    'eyebrow'        => [ 'type' => 'string', 'label' => 'Eyebrow text' ],
                    'heading'        => [ 'type' => 'string', 'label' => 'Heading' ],
                    'heading_accent' => [ 'type' => 'string', 'label' => 'Accent text' ],
                    'text'           => [ 'type' => 'string', 'label' => 'Body content' ],
                    'content'        => [ 'type' => 'string', 'label' => 'Body content (alias)' ],
                    'align'          => [ 'type' => 'select', 'label' => 'Alignment', 'options' => [ 'center', 'left' ], 'default' => 'center' ],
                    'max_width'      => [ 'type' => 'string', 'label' => 'Max width', 'default' => '4xl' ],
                    'divider'        => [ 'type' => 'string', 'label' => 'Divider text' ],
                ],
            ],

            'card_grid' => [
                'label'       => 'Card Grid',
                'description' => 'Grid of cards with multiple visual variants.',
                'variants'    => [ 'services', 'benefits', 'icon', 'team-preview', 'posts' ],
                'props'       => [
                    'eyebrow'        => [ 'type' => 'string', 'label' => 'Eyebrow text' ],
                    'heading'        => [ 'type' => 'string', 'label' => 'Heading' ],
                    'heading_accent' => [ 'type' => 'string', 'label' => 'Accent text' ],
                    'text'           => [ 'type' => 'string', 'label' => 'Description' ],
                    'columns'        => [ 'type' => 'number', 'label' => 'Columns', 'default' => 3 ],
                    'items'          => [ 'type' => 'array', 'label' => 'Card items' ],
                    'cta'            => [ 'type' => 'cta', 'label' => 'Bottom CTA' ],
                    'align'          => [ 'type' => 'select', 'label' => 'Header alignment', 'options' => [ 'left', 'center' ], 'default' => 'left' ],
                    'dark'           => [ 'type' => 'boolean', 'label' => 'Dark background' ],
                ],
            ],

            'icon_list' => [
                'label'       => 'Icon List',
                'description' => 'Grid of icon + title + description items.',
                'variants'    => [],
                'props'       => [
                    'eyebrow'          => [ 'type' => 'string', 'label' => 'Eyebrow text' ],
                    'heading'          => [ 'type' => 'string', 'label' => 'Heading' ],
                    'heading_accent'   => [ 'type' => 'string', 'label' => 'Accent text' ],
                    'text'             => [ 'type' => 'string', 'label' => 'Description' ],
                    'columns'          => [ 'type' => 'number', 'label' => 'Columns', 'default' => 3 ],
                    'items'            => [ 'type' => 'array', 'label' => 'Icon items', 'item_shape' => [ 'icon', 'title', 'text' ] ],
                    'dark'             => [ 'type' => 'boolean', 'label' => 'Dark background' ],
                    'background_image' => [ 'type' => 'media', 'label' => 'Background image (dark only)' ],
                ],
            ],

            'testimonial_band' => [
                'label'       => 'Testimonials',
                'description' => 'Grid of testimonial quotes.',
                'variants'    => [],
                'props'       => [
                    'eyebrow' => [ 'type' => 'string', 'label' => 'Eyebrow text' ],
                    'heading' => [ 'type' => 'string', 'label' => 'Heading' ],
                    'items'   => [ 'type' => 'array', 'label' => 'Testimonials', 'item_shape' => [ 'quote', 'author', 'role', 'photo' ] ],
                    'layout'  => [ 'type' => 'select', 'label' => 'Layout', 'options' => [ 'grid' ], 'default' => 'grid' ],
                ],
            ],

            'faq_list' => [
                'label'       => 'FAQ',
                'description' => 'Accordion FAQ section.',
                'variants'    => [],
                'props'       => [
                    'eyebrow'        => [ 'type' => 'string', 'label' => 'Eyebrow text' ],
                    'heading'        => [ 'type' => 'string', 'label' => 'Heading' ],
                    'heading_accent' => [ 'type' => 'string', 'label' => 'Accent text' ],
                    'items'          => [ 'type' => 'array', 'label' => 'FAQ items', 'item_shape' => [ 'question', 'answer' ] ],
                    'columns'        => [ 'type' => 'number', 'label' => 'Columns (1 or 2)', 'default' => 1 ],
                ],
            ],

            'cta_band' => [
                'label'       => 'CTA Band',
                'description' => 'Call-to-action banner with multiple visual variants.',
                'variants'    => [ 'light', 'dark', 'accent', 'card', 'expand' ],
                'props'       => [
                    'eyebrow'          => [ 'type' => 'string', 'label' => 'Eyebrow text' ],
                    'heading'          => [ 'type' => 'string', 'label' => 'Heading' ],
                    'heading_accent'   => [ 'type' => 'string', 'label' => 'Accent text' ],
                    'text'             => [ 'type' => 'string', 'label' => 'Description' ],
                    'primary_cta'      => [ 'type' => 'cta', 'label' => 'Primary button' ],
                    'secondary_cta'    => [ 'type' => 'cta', 'label' => 'Secondary button' ],
                    'align'            => [ 'type' => 'select', 'label' => 'Alignment', 'options' => [ 'center', 'left' ], 'default' => 'center' ],
                    'background_image' => [ 'type' => 'media', 'label' => 'Background image (expand variant)' ],
                ],
            ],

            'services_tabs' => [
                'label'       => 'Services Tabs',
                'description' => 'Tabbed services section with image and content switching.',
                'variants'    => [],
                'props'       => [
                    'eyebrow'        => [ 'type' => 'string', 'label' => 'Eyebrow text' ],
                    'heading'        => [ 'type' => 'string', 'label' => 'Heading' ],
                    'heading_accent' => [ 'type' => 'string', 'label' => 'Accent text' ],
                    'text'           => [ 'type' => 'string', 'label' => 'Description' ],
                    'tabs'           => [ 'type' => 'array', 'label' => 'Service tabs', 'item_shape' => [ 'id', 'label', 'subtitle', 'title', 'description', 'items', 'image', 'url' ] ],
                    'cta'            => [ 'type' => 'cta', 'label' => 'Bottom CTA' ],
                ],
            ],

            'team_grid' => [
                'label'       => 'Team Grid',
                'description' => 'Team member photo grid or alternating bio layout.',
                'variants'    => [],
                'props'       => [
                    'eyebrow'        => [ 'type' => 'string', 'label' => 'Eyebrow text' ],
                    'heading'        => [ 'type' => 'string', 'label' => 'Heading' ],
                    'heading_accent' => [ 'type' => 'string', 'label' => 'Accent text' ],
                    'text'           => [ 'type' => 'string', 'label' => 'Description' ],
                    'columns'        => [ 'type' => 'number', 'label' => 'Columns', 'default' => 4 ],
                    'members'        => [ 'type' => 'array', 'label' => 'Team members', 'item_shape' => [ 'name', 'role', 'photo', 'url', 'bio', 'quote' ] ],
                    'layout'         => [ 'type' => 'select', 'label' => 'Layout', 'options' => [ 'grid', 'bios' ], 'default' => 'grid' ],
                    'cta'            => [ 'type' => 'cta', 'label' => 'Bottom CTA' ],
                ],
            ],

            'contact_block' => [
                'label'       => 'Contact Block',
                'description' => 'Contact info with form or shortcode embed.',
                'variants'    => [],
                'props'       => [
                    'heading'        => [ 'type' => 'string', 'label' => 'Heading' ],
                    'text'           => [ 'type' => 'string', 'label' => 'Description' ],
                    'show_form'      => [ 'type' => 'boolean', 'label' => 'Show built-in form', 'default' => true ],
                    'show_map'       => [ 'type' => 'boolean', 'label' => 'Show map', 'default' => false ],
                    'form_shortcode' => [ 'type' => 'string', 'label' => 'Form shortcode override' ],
                ],
            ],

            'gallery_band' => [
                'label'       => 'Gallery',
                'description' => 'Image gallery grid.',
                'variants'    => [],
                'props'       => [
                    'heading' => [ 'type' => 'string', 'label' => 'Heading' ],
                    'images'  => [ 'type' => 'array', 'label' => 'Images', 'item_shape' => [ 'image', 'alt', 'caption' ] ],
                    'columns' => [ 'type' => 'number', 'label' => 'Columns', 'default' => 3 ],
                    'aspect'  => [ 'type' => 'string', 'label' => 'Aspect ratio', 'default' => '16/10' ],
                ],
            ],

            'shortcode_block' => [
                'label'       => 'Shortcode Block',
                'description' => 'Wrapper for third-party shortcodes.',
                'variants'    => [],
                'props'       => [
                    'heading'    => [ 'type' => 'string', 'label' => 'Heading' ],
                    'text'       => [ 'type' => 'string', 'label' => 'Description' ],
                    'shortcode'  => [ 'type' => 'string', 'label' => 'Shortcode', 'required' => true ],
                    'max_width'  => [ 'type' => 'string', 'label' => 'Max width' ],
                    'background' => [ 'type' => 'string', 'label' => 'Background style' ],
                ],
            ],
        ];
    }
}
