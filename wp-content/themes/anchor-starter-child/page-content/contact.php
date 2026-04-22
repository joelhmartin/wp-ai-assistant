<?php
/**
 * Contact page — direct-PHP.
 *
 * Renders the same sections the old config/pages/contact.php produced.
 * Edit this file freely; the AI Page Assistant (or the Monaco panel) can
 * tweak it. Helpers: anchor_get_site_config(), anchor_get_data(),
 * anchor_resolve_media(), anchor_render_section(), and get_template_part().
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// 1. Hero (short, compact)
anchor_render_section( [
	'type'    => 'hero',
	'variant' => 'short',
	'props'   => [
		'image'          => 'contact_hero',
		'image_mobile'   => 'contact_hero_mobile',
		'eyebrow'        => 'Contact Us',
		'heading'        => "Let's start the",
		'heading_accent' => 'conversation.',
		'min_height'     => '45dvh',
	],
] );

// 2. Contact block (CTM form embed + info)
anchor_render_section( [
	'type'  => 'contact_block',
	'props' => [
		'text'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Fill out the form below and we will get back to you shortly.',
		'show_form'      => false,
		'form_shortcode' => '[anchor_form token="qjxA84XRzo8PkLxVFvGiLr1isObeQf9ZXrCmYlGWK88"]',
	],
] );
