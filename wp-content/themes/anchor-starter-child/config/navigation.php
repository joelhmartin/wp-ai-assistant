<?php
/**
 * Navigation configuration — DEKA Dental Lasers.
 */

$product_links = [
	[ 'label' => 'US-20D CO2 Laser',         'url' => '/shop/us-20d/' ],
	[ 'label' => 'SmartXide Ultraspeed2',    'url' => '/shop/smartxide-ultraspeed2/' ],
	[ 'label' => 'SmartPerio Nd:YAG',        'url' => '/shop/smartperio/' ],
];

return [

	// ── Primary navigation (header) ─────────────────────────────────
	'main_nav' => [
		[
			'label'    => 'Dental Lasers',
			'url'      => '/shop/',
			'children' => $product_links,
		],
		[ 'label' => 'DEKA Dental Academy', 'url' => '/academy/' ],
		[ 'label' => 'Endorsements',        'url' => '/endorsements/' ],
		[ 'label' => 'Company',             'url' => '/about/' ],
		[ 'label' => 'Contact',             'url' => '/contact/' ],
	],

	// ── Header CTA button ───────────────────────────────────────────
	'cta_button' => [
		'label' => 'Request Information',
		'url'   => '/contact/',
	],

	// ── Footer link columns ─────────────────────────────────────────
	'footer_nav' => [
		'Dental Lasers' => $product_links,
		'Company' => [
			[ 'label' => 'About DEKA',          'url' => '/about/' ],
			[ 'label' => 'DEKA Dental Academy', 'url' => '/academy/' ],
			[ 'label' => 'Endorsements',        'url' => '/endorsements/' ],
			[ 'label' => 'Contact',             'url' => '/contact/' ],
		],
	],
];
