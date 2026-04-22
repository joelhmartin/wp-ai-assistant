<?php
/**
 * Services landing page — direct-PHP.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services = function_exists( 'anchor_get_data' ) ? anchor_get_data( 'services' ) : [];

// 1. Hero
anchor_render_section( [
	'type'    => 'hero',
	'variant' => 'short',
	'props'   => [
		'image'         => 'services_hero',
		'image_mobile'  => 'services_hero_mobile',
		'eyebrow'       => 'What We Offer',
		'heading_lines' => [
			[ 'text' => 'Services built around', 'style' => 'bold' ],
			[ 'text' => 'your needs.',            'style' => 'accent' ],
		],
		'min_height'    => '55dvh',
	],
] );

// 2. Intro
anchor_render_section( [
	'type'         => 'text_block',
	'flush_bottom' => true,
	'props'        => [
		'eyebrow'        => 'Our Services',
		'heading'        => 'How we can',
		'heading_accent' => 'help.',
		'text'           => 'Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Maecenas faucibus mollis interdum. Nullam quis risus eget urna mollis ornare vel eu leo.',
		'align'          => 'center',
		'max_width'      => '800px',
	],
] );

// 3. Service tabs with images — pulls from data.php
anchor_render_section( [
	'type'  => 'services_tabs',
	'props' => [
		'tabs' => array_map(
			function ( $s ) {
				return [
					'id'          => $s['id'],
					'label'       => $s['title'],
					'subtitle'    => $s['subtitle'],
					'title'       => $s['description'],
					'description' => $s['text'],
					'items'       => $s['items'],
					'image'       => $s['image'],
					'url'         => $s['url'],
				];
			},
			$services
		),
	],
] );

// 4. Service cards grid
anchor_render_section( [
	'type'    => 'card_grid',
	'variant' => 'services',
	'props'   => [
		'eyebrow'        => 'Quick Links',
		'heading'        => 'All',
		'heading_accent' => 'services',
		'columns'        => 3,
		'items'          => array_map(
			function ( $s ) {
				return [
					'title' => $s['title'],
					'text'  => $s['text'],
					'url'   => $s['url'],
					'icon'  => $s['icon'],
				];
			},
			$services
		),
	],
] );
