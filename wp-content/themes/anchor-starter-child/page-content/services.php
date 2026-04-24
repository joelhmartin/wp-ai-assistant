<?php
/**
 * Services landing page — pure PHP.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$services = function_exists( 'anchor_get_data' ) ? anchor_get_data( 'services' ) : [];

// 1. Hero (short)
$props = [
    'image'         => anchor_resolve_media( 'services_hero' ),
    'image_mobile'  => anchor_resolve_media( 'services_hero_mobile' ),
    'eyebrow'       => 'What We Offer',
    'heading_lines' => [
        [ 'text' => 'Services built around', 'style' => 'bold' ],
        [ 'text' => 'your needs.',            'style' => 'accent' ],
    ],
    'min_height' => '55dvh',
];
anchor_set_template_data( [ 'type' => 'hero', 'variant' => 'short', 'props' => $props ] );
?>
<section class="anchor-section" data-section-type="hero" data-section-variant="short">
<?php get_template_part( 'template-parts/sections/hero' ); ?>
</section>

<?php
// 2. Intro text block (flush_bottom — joins the tabs section below)
$props = [
    'eyebrow'        => 'Our Services',
    'heading'        => 'How we can',
    'heading_accent' => 'help.',
    'text'           => 'Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Maecenas faucibus mollis interdum. Nullam quis risus eget urna mollis ornare vel eu leo.',
    'align'          => 'center',
    'max_width'      => '800px',
];
anchor_set_template_data( [ 'type' => 'text_block', 'props' => $props ] );
?>
<section class="anchor-section anchor-section--flush-bottom" data-section-type="text_block">
<?php get_template_part( 'template-parts/sections/text-block' ); ?>
</section>

<?php
// 3. Services tabs (pulls from data.php)
$tabs = array_map( function( $s ) {
    return [
        'id'          => $s['id'],
        'label'       => $s['title'],
        'subtitle'    => $s['subtitle']    ?? '',
        'title'       => $s['description'] ?? '',
        'description' => $s['text']        ?? '',
        'items'       => $s['items']        ?? [],
        'image'       => anchor_resolve_media( $s['image'] ?? '' ),
        'url'         => $s['url']          ?? '',
    ];
}, $services );

anchor_set_template_data( [ 'type' => 'services_tabs', 'props' => [ 'tabs' => $tabs ] ] );
?>
<section class="anchor-section" data-section-type="services_tabs">
<?php get_template_part( 'template-parts/sections/services-tabs' ); ?>
</section>

<?php
// 4. Service cards grid (quick links)
$card_items = array_map( function( $s ) {
    return [
        'title' => $s['title'],
        'text'  => $s['text'] ?? '',
        'url'   => $s['url']  ?? '',
        'icon'  => $s['icon'] ?? '',
    ];
}, $services );

anchor_set_template_data( [ 'type' => 'card_grid', 'variant' => 'services', 'props' => [
    'eyebrow'        => 'Quick Links',
    'heading'        => 'All',
    'heading_accent' => 'services',
    'columns'        => 3,
    'items'          => $card_items,
] ] );
?>
<section class="anchor-section anchor-section--services" data-section-type="card_grid" data-section-variant="services">
<?php get_template_part( 'template-parts/sections/card-grid' ); ?>
</section>
