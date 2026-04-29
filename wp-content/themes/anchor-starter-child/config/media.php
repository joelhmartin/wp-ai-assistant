<?php
/**
 * Media asset map.
 *
 * Maps logical media keys to image URLs. Resolver order:
 *   - Keys starting with '/' resolve against the stylesheet (child theme) URI.
 *   - Absolute URLs (http/https) pass through.
 *   - Named keys can recursively reference other keys.
 *
 * @package Anchor_Starter_Child
 */

return [

	// ── DEKA logos + product renders ────────────────────────────────
	// No static paths here. The keys below are populated with Media Library
	// attachment IDs by the `deka_seed_media` importer (see functions.php)
	// — keys resolve to attachment URLs at runtime. If the importer hasn't
	// run (or an attachment was deleted), the key resolves to '' and the
	// image simply doesn't render.
	//
	//   deka_logo         — DEKA wordmark (colour)
	//   deka_logo_white   — DEKA wordmark (white, for dark surfaces)
	//   product_us20d     — US-20D product render
	//   product_smartxide — SmartXide Ultraspeed 2 product render
	//   product_smartperio— SmartPerio product render
	//
	// Legacy aliases still map so older templates keep working.
	'logo'       => 'deka_logo',
	'logo_dark'  => 'deka_logo',
	'logo_white' => 'deka_logo_white',

	// ── Hero / editorial imagery (Unsplash, cool-toned clinical) ────
	'home_hero'           => 'https://images.unsplash.com/photo-1609840114035-3c981b782dfe?auto=format&fit=crop&w=1920&h=1200&q=80',
	'home_hero_mobile'    => 'https://images.unsplash.com/photo-1609840114035-3c981b782dfe?auto=format&fit=crop&w=800&h=1200&q=80',
	'mission_image'       => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=1200&h=1200&q=80',
	'flagship_image'      => 'product_us20d',
	'academy_bg'          => 'https://images.unsplash.com/photo-1571772996211-2f02c9727629?auto=format&fit=crop&w=1920&h=1080&q=80',

	// ── Hero / page imagery (kept so other page configs keep working) ─
	'about_hero'           => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1920&h=1080&q=80',
	'about_hero_mobile'    => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=800&h=1200&q=80',
	'contact_hero'         => 'https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?auto=format&fit=crop&w=1920&h=1080&q=80',
	'contact_hero_mobile'  => 'https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?auto=format&fit=crop&w=800&h=1200&q=80',
	'services_hero'        => 'https://images.unsplash.com/photo-1609840114035-3c981b782dfe?auto=format&fit=crop&w=1920&h=1080&q=80',
	'services_hero_mobile' => 'https://images.unsplash.com/photo-1609840114035-3c981b782dfe?auto=format&fit=crop&w=800&h=1200&q=80',
	'events_hero'          => 'https://images.unsplash.com/photo-1571772996211-2f02c9727629?auto=format&fit=crop&w=1920&h=1080&q=80',
	'events_hero_mobile'   => 'https://images.unsplash.com/photo-1571772996211-2f02c9727629?auto=format&fit=crop&w=800&h=1200&q=80',
	'blog_hero'            => 'https://images.unsplash.com/photo-1606265752439-1f18756aa5fc?auto=format&fit=crop&w=1920&h=1080&q=80',
	'blog_hero_mobile'     => 'https://images.unsplash.com/photo-1606265752439-1f18756aa5fc?auto=format&fit=crop&w=800&h=1200&q=80',

	// ── Per-version homepage assets ─────────────────────────────────
	'home_v3_hero_poster' => '/assets/images/v3/hero-poster.jpg',

	// ── Backgrounds / decorative ────────────────────────────────────
	'skyline'        => 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?auto=format&fit=crop&w=1920&h=800&q=80',
	'cta_background' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1920&h=1080&q=80',

	// ── Legacy service tab images (retained for fallback) ───────────
	'service_tab_1' => 'product_us20d',
	'service_tab_2' => 'product_smartxide',
	'service_tab_3' => 'product_smartperio',
	'service_tab_4' => 'product_us20d',
	'service_tab_5' => 'product_smartxide',

	// ── Team headshots (retained; home no longer uses team grid) ────
	'team_member_1' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&w=600&h=800&q=80',
	'team_member_2' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=600&h=800&q=80',
	'team_member_3' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?auto=format&fit=crop&w=600&h=800&q=80',
	'team_member_4' => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?auto=format&fit=crop&w=600&h=800&q=80',

	// ── Secondary editorial ─────────────────────────────────────────
	'story_image'      => 'https://images.unsplash.com/photo-1530026405186-ed1f139313f8?auto=format&fit=crop&w=800&h=1000&q=80',
	'philosophy_image' => 'https://images.unsplash.com/photo-1607613009820-a29f7bb81c04?auto=format&fit=crop&w=800&h=600&q=80',
];
