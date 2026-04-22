<?php
/**
 * Individual service page config.
 *
 * Dynamically populates from config/data.php based on the current page slug.
 * Falls back to generic content if the service isn't found in data.
 *
 * WordPress pages: Create child pages under /services/ with slugs matching
 * the service 'id' in data.php (e.g., /services/service-one/).
 */

$services    = function_exists( 'anchor_get_data' ) ? anchor_get_data( 'services' ) : [];
$page        = get_queried_object();
$current_slug = $page ? $page->post_name : '';

// Find matching service from data.php by id
$service = null;
foreach ( $services as $s ) {
    if ( ! empty( $s['id'] ) && $s['id'] === $current_slug ) {
        $service = $s;
        break;
    }
}

// Fallback values if service not found in data
$title       = $service ? $service['title'] : ( $page ? $page->post_title : 'Our Service' );
$description = $service ? $service['description'] : '';
$text        = $service ? $service['text'] : '';
$image       = $service ? $service['image'] : 'services_hero';
$icon        = $service ? $service['icon'] : '';
$items       = $service && ! empty( $service['items'] ) ? $service['items'] : [];

return [
    'sections' => [
        // 1. Hero
        [
            'type' => 'hero',
            'variant' => 'short',
            'props' => [
                'image' => $image,
                'back_link' => ['label' => 'All Services', 'url' => '/services/'],
                'eyebrow' => $title,
                'heading' => $description,
                'min_height' => '50dvh',
            ],
        ],

        // 2. Service detail
        [
            'type' => 'split_content',
            'props' => [
                'eyebrow' => 'About This Service',
                'heading' => $title,
                'text' => $text,
                'image' => $image,
                'image_alt' => $title,
                'image_position' => 'left',
                'aspect' => '4/3',
            ],
        ],

        // 3. What's included (if service has items)
        ! empty( $items ) ? [
            'type' => 'icon_list',
            'props' => [
                'eyebrow' => 'What\'s Included',
                'heading' => 'Key features of',
                'heading_accent' => $title,
                'columns' => 2,
                'items' => array_map( function( $item ) use ( $icon ) {
                    return [
                        'icon'  => $icon ?: 'check-circle',
                        'title' => $item,
                        'text'  => '',
                    ];
                }, $items ),
            ],
        ] : null,

    ],
];
