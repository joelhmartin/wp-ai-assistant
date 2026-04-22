<?php
/**
 * Contact page configuration.
 *
 * Defines the section order and content for the Contact page.
 */
return [
    'sections' => [
        // 1. Hero (short, compact)
        [
            'type' => 'hero',
            'variant' => 'short',
            'props' => [
                'image'        => 'contact_hero',
                'image_mobile' => 'contact_hero_mobile',
                'eyebrow' => 'Contact Us',
                'heading' => "Let's start the",
                'heading_accent' => 'conversation.',
                'min_height' => '45dvh',
            ],
        ],

        // 2. Contact block (CTM form embed + info)
        [
            'type' => 'contact_block',
            'props' => [
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Fill out the form below and we will get back to you shortly.',
                'show_form' => false,
                'form_shortcode' => '[anchor_form token="qjxA84XRzo8PkLxVFvGiLr1isObeQf9ZXrCmYlGWK88"]',
            ],
        ],
    ],
];
