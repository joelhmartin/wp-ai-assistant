<?php
/**
 * About page — direct-PHP.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$team = function_exists( 'anchor_get_data' ) ? anchor_get_data( 'team' ) : [];

// 1. Hero (short)
anchor_render_section( [
	'type'    => 'hero',
	'variant' => 'short',
	'props'   => [
		'image'         => 'about_hero',
		'image_mobile'  => 'about_hero_mobile',
		'eyebrow'       => 'Located in Lorem Ipsum Valley',
		'heading_lines' => [
			[ 'text' => 'We believe in something', 'style' => 'bold' ],
			[ 'text' => 'greater than ourselves.', 'style' => 'accent' ],
		],
		'min_height'    => '70dvh',
	],
] );

// 2. Our Story (split content)
anchor_render_section( [
	'type'  => 'split_content',
	'props' => [
		'eyebrow'        => 'Our Story',
		'heading'        => 'What drives',
		'heading_accent' => 'everything',
		'heading_suffix' => ' we do.',
		'text'           => [
			'Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Maecenas faucibus mollis interdum. Nullam quis risus eget urna mollis ornare vel eu leo.',
			'Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.',
			'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper.',
		],
		'image'          => 'story_image',
		'image_alt'      => 'Our story',
		'image_position' => 'right',
		'cta'            => [ 'label' => 'Get In Touch', 'url' => '/contact/' ],
	],
] );

// 3. Our Mission (text block)
anchor_render_section( [
	'type'  => 'text_block',
	'props' => [
		'eyebrow'        => 'Our Mission',
		'heading'        => 'Driven by purpose,',
		'heading_accent' => 'guided by values.',
		'text'           => 'Cras justo odio, dapibus ut facilisis in, egestas eget quam. Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo.',
		'align'          => 'center',
		'max_width'      => '800px',
	],
] );

// 4. Our Philosophy (split content — dark)
anchor_render_section( [
	'type'  => 'split_content',
	'props' => [
		'eyebrow'        => 'Our Philosophy',
		'heading'        => 'A commitment to',
		'heading_accent' => 'lasting impact.',
		'text'           => [
			'Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Maecenas faucibus mollis interdum.',
			'Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna mollis ornare vel eu leo. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.',
		],
		'image'          => 'philosophy_image',
		'image_alt'      => 'Our philosophy in action',
		'image_position' => 'right',
		'dark'           => true,
	],
] );

// 5. Our Values (card grid — icons)
anchor_render_section( [
	'type'    => 'card_grid',
	'variant' => 'icon',
	'props'   => [
		'eyebrow'        => 'Our Values',
		'heading'        => 'The principles that',
		'heading_accent' => 'define us.',
		'columns'        => 4,
		'items'          => [
			[
				'icon'  => 'heart',
				'title' => 'Compassion',
				'text'  => 'Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper.',
			],
			[
				'icon'  => 'users',
				'title' => 'Community',
				'text'  => 'Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante.',
			],
			[
				'icon'  => 'shield',
				'title' => 'Integrity',
				'text'  => 'Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna vel scelerisque.',
			],
			[
				'icon'  => 'compass',
				'title' => 'Innovation',
				'text'  => 'Nullam quis risus eget urna mollis ornare vel eu leo. Aenean lacinia bibendum nulla sed.',
			],
		],
	],
] );

// 6. Team (full bios)
anchor_render_section( [
	'type'  => 'team_grid',
	'props' => [
		'eyebrow'        => 'Meet the Team',
		'heading'        => 'The people behind',
		'heading_accent' => 'the mission.',
		'text'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas faucibus mollis interdum. Nullam id dolor id nibh ultricies vehicula ut id elit.',
		'layout'         => 'bios',
		'members'        => $team,
	],
] );
