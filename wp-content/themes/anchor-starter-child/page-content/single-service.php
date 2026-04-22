<?php
/**
 * Single service page — direct-PHP.
 *
 * Used for child pages under /services/ (slug pattern: services/{id}).
 * Pulls the matching service record from config/data.php by post_name
 * and falls back to generic copy when the slug doesn't match a known
 * service.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services     = function_exists( 'anchor_get_data' ) ? anchor_get_data( 'services' ) : [];
$page         = get_queried_object();
$current_slug = $page ? $page->post_name : '';

$service = null;
foreach ( $services as $s ) {
	if ( ! empty( $s['id'] ) && $s['id'] === $current_slug ) {
		$service = $s;
		break;
	}
}

$title       = $service ? $service['title']       : ( $page ? $page->post_title : 'Our Service' );
$description = $service ? $service['description'] : '';
$text        = $service ? $service['text']        : '';
$image       = $service ? $service['image']       : 'services_hero';
$icon        = $service ? $service['icon']        : '';
$items       = ( $service && ! empty( $service['items'] ) ) ? $service['items'] : [];

// 1. Hero
anchor_render_section( [
	'type'    => 'hero',
	'variant' => 'short',
	'props'   => [
		'image'      => $image,
		'back_link'  => [ 'label' => 'All Services', 'url' => '/services/' ],
		'eyebrow'    => $title,
		'heading'    => $description,
		'min_height' => '50dvh',
	],
] );

// 2. Service detail
anchor_render_section( [
	'type'  => 'split_content',
	'props' => [
		'eyebrow'        => 'About This Service',
		'heading'        => $title,
		'text'           => $text,
		'image'          => $image,
		'image_alt'      => $title,
		'image_position' => 'left',
		'aspect'         => '4/3',
	],
] );

// 3. What's included (if service has items)
if ( ! empty( $items ) ) {
	anchor_render_section( [
		'type'  => 'icon_list',
		'props' => [
			'eyebrow'        => "What's Included",
			'heading'        => 'Key features of',
			'heading_accent' => $title,
			'columns'        => 2,
			'items'          => array_map(
				function ( $item ) use ( $icon ) {
					return [
						'icon'  => $icon ?: 'check-circle',
						'title' => $item,
						'text'  => '',
					];
				},
				$items
			),
		],
	] );
}
