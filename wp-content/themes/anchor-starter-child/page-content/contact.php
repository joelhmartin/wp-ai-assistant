<?php
/**
 * Contact page — pure PHP.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. Hero (short, compact)
$props = [
    'image'          => anchor_resolve_media( 'contact_hero' ),
    'image_mobile'   => anchor_resolve_media( 'contact_hero_mobile' ),
    'eyebrow'        => 'Contact Us',
    'heading'        => "Let's start the",
    'heading_accent' => 'conversation.',
    'min_height'     => '45dvh',
];
anchor_set_template_data( [ 'type' => 'hero', 'variant' => 'short', 'props' => $props ] );
?>
<section class="anchor-section" data-section-type="hero" data-section-variant="short">
<?php get_template_part( 'template-parts/sections/hero' ); ?>
</section>

<?php
// 2. Contact block (CTM form embed + info columns)
$props = [
    'text'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Fill out the form below and we will get back to you shortly.',
    'show_form'      => false,
    'form_shortcode' => '[anchor_form token="qjxA84XRzo8PkLxVFvGiLr1isObeQf9ZXrCmYlGWK88"]',
];
anchor_set_template_data( [ 'type' => 'contact_block', 'props' => $props ] );
?>
<section class="anchor-section" data-section-type="contact_block">
<?php get_template_part( 'template-parts/sections/contact-block' ); ?>
</section>
