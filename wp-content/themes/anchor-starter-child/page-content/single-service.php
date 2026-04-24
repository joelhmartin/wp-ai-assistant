<?php
/**
 * Single service page — pure PHP.
 *
 * Matches a service from config/data.php by the current page slug.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

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
$image       = $service ? anchor_resolve_media( $service['image'] ) : anchor_resolve_media( 'services_hero' );
$icon        = $service ? $service['icon']        : '';
$items       = ( $service && ! empty( $service['items'] ) ) ? $service['items'] : [];

// 1. Hero (short)
anchor_set_template_data( [
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
?>
<section class="anchor-section" data-section-type="hero" data-section-variant="short">
<?php get_template_part( 'template-parts/sections/hero' ); ?>
</section>

<?php
// 2. Service detail (split content — image left)
anchor_set_template_data( [
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
?>
<section class="anchor-section" data-section-type="split_content">
<?php get_template_part( 'template-parts/sections/split-content' ); ?>
</section>

<?php
// 3. What's included (icon list — only if service has items)
if ( ! empty( $items ) ) :
    $icon_items = array_map( function( $item ) use ( $icon ) {
        return [
            'icon'  => $icon ?: 'check-circle',
            'title' => $item,
            'text'  => '',
        ];
    }, $items );

    anchor_set_template_data( [
        'type'  => 'icon_list',
        'props' => [
            'eyebrow'        => "What's Included",
            'heading'        => 'Key features of',
            'heading_accent' => $title,
            'columns'        => 2,
            'items'          => $icon_items,
        ],
    ] );
?>
<section class="anchor-section" data-section-type="icon_list">
<?php get_template_part( 'template-parts/sections/icon-list' ); ?>
</section>
<?php endif; ?>
