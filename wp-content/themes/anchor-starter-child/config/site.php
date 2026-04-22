<?php
/**
 * Site-wide business data — DEKA Dental Lasers.
 */

return [
	// ── Identity ────────────────────────────────────────────────────
	'name'        => 'DEKA Dental Lasers',
	'short_name'  => 'DEKA',
	'tagline'     => 'Improving the Work of Doctors',
	'description' => 'Three decades of laser engineering in dentistry. DEKA designs precision CO2 and Nd:YAG systems used by clinicians in more than 120 countries.',

	// ── Contact ─────────────────────────────────────────────────────
	'phone'      => '(866) 223-4543',
	'phone_href' => 'tel:+18662234543',
	'email'      => 'info@dekadentallasers.com',
	'email_href' => 'mailto:info@dekadentallasers.com',
	'address'    => '400 North Ashley Drive, Suite 2600, Tampa, FL 33602',
	'hours'      => 'Mon–Fri, 9:00 AM – 5:00 PM ET',

	// ── Location ────────────────────────────────────────────────────
	'city'     => 'Tampa',
	'state'    => 'FL',
	'location' => 'Tampa, FL',
	'founded'  => 1992,

	// ── Social profiles ─────────────────────────────────────────────
	'social' => [
		[ 'label' => 'LinkedIn',  'url' => '#', 'icon' => 'linkedin' ],
		[ 'label' => 'Facebook',  'url' => '#', 'icon' => 'facebook' ],
		[ 'label' => 'Instagram', 'url' => '#', 'icon' => 'instagram' ],
	],

	// ── Default call-to-action ──────────────────────────────────────
	'default_cta' => [
		'label' => 'Request Information',
		'url'   => '/contact/',
	],

	// ── Sticky footer bar (mobile only) ─────────────────────────────
	'sticky_footer' => [
		'enabled' => true,
		'buttons' => [
			[
				'label' => 'Request Info',
				'icon'  => 'message',
				'url'   => '/contact/',
				'style' => 'primary',
			],
			[
				'label' => 'Call Us',
				'icon'  => 'phone',
				'url'   => 'tel:+18662234543',
				'style' => 'secondary',
			],
		],
	],

	// ── Logo variants ───────────────────────────────────────────────
	'logo' => [
		'header_light' => 'deka_logo',
		'header_dark'  => 'deka_logo_white',
		'footer'       => 'deka_logo_white',
	],
];
