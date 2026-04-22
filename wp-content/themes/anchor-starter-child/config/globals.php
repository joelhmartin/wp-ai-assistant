<?php
/**
 * Global section definitions.
 *
 * Reusable sections that any page config can reference with the
 * shorthand 'global:key' syntax (e.g. 'global:cta_band').  The
 * parent Anchor Framework resolves these references at render time.
 *
 * @package Anchor_Starter_Child
 * @since   1.0.0
 */

return [

	// ── CTA Band ────────────────────────────────────────────────────
	// A prominent call-to-action section, typically placed near the
	// bottom of a page before the footer.
	'cta_band' => [
		'type'    => 'cta_band',
		'variant' => 'expand',
		'props'   => [
			'eyebrow'          => 'Take the Next Step',
			'heading'          => 'Lorem ipsum dolor sit',
			'heading_accent'   => 'amet?',
			'text'             => 'Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Maecenas faucibus mollis interdum.',
			'primary_cta'      => [ 'label' => 'Get in Touch',     'url' => '/contact/' ],
			'secondary_cta'    => [ 'label' => 'Learn About Us',   'url' => '/about/' ],
			'background_image' => 'cta_background',
		],
	],

	// ── Testimonials ────────────────────────────────────────────────
	// Social-proof section showcasing client quotes.
	'testimonials' => [
		'type'  => 'testimonial_band',
		'props' => [
			'eyebrow' => 'Testimonials',
			'heading' => 'What our clients say',
			'items'   => [
				[
					'quote'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit.',
					'author' => 'Client Name',
					'role'   => 'Patient',
				],
				[
					'quote'  => 'Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui.',
					'author' => 'Another Client',
					'role'   => 'Patient',
				],
				[
					'quote'  => 'Cras mattis consectetur purus sit amet fermentum. Vestibulum id ligula porta felis euismod.',
					'author' => 'Third Client',
					'role'   => 'Patient',
				],
			],
		],
	],
];
