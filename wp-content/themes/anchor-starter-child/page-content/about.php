<?php
/**
 * About page — pure PHP.
 *
 * Framework sections use anchor_set_template_data() + get_template_part() directly.
 * All data values are explicit in this file. Add HTML between sections freely.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$team = function_exists( 'anchor_get_data' ) ? anchor_get_data( 'team' ) : [];

// 1. Hero (short)
$props = [
    'image'         => anchor_resolve_media( 'about_hero' ),
    'image_mobile'  => anchor_resolve_media( 'about_hero_mobile' ),
    'eyebrow'       => 'Located in Lorem Ipsum Valley',
    'heading_lines' => [
        [ 'text' => 'We believe in something', 'style' => 'bold' ],
        [ 'text' => 'greater than ourselves.', 'style' => 'accent' ],
    ],
    'min_height' => '70dvh',
];
anchor_set_template_data( [ 'type' => 'hero', 'variant' => 'short', 'props' => $props ] );
?>
<section class="anchor-section" data-section-type="hero" data-section-variant="short">
<?php get_template_part( 'template-parts/sections/hero' ); ?>
</section>

<?php
// 2. Our Story (split content — image right)
$props = [
    'eyebrow'        => 'Our Story',
    'heading'        => 'What drives',
    'heading_accent' => 'everything',
    'heading_suffix' => ' we do.',
    'text'           => [
        'Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Maecenas faucibus mollis interdum. Nullam quis risus eget urna mollis ornare vel eu leo.',
        'Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.',
        'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper.',
    ],
    'image'          => anchor_resolve_media( 'story_image' ),
    'image_alt'      => 'Our story',
    'image_position' => 'right',
    'cta'            => [ 'label' => 'Get In Touch', 'url' => '/contact/' ],
];
anchor_set_template_data( [ 'type' => 'split_content', 'props' => $props ] );
?>
<section class="anchor-section" data-section-type="split_content">
<?php get_template_part( 'template-parts/sections/split-content' ); ?>
</section>

<?php
// 3. Our Mission (text block, centered)
$props = [
    'eyebrow'        => 'Our Mission',
    'heading'        => 'Driven by purpose,',
    'heading_accent' => 'guided by values.',
    'text'           => 'Cras justo odio, dapibus ut facilisis in, egestas eget quam. Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo.',
    'align'          => 'center',
    'max_width'      => '800px',
];
anchor_set_template_data( [ 'type' => 'text_block', 'props' => $props ] );
?>
<section class="anchor-section" data-section-type="text_block">
<?php get_template_part( 'template-parts/sections/text-block' ); ?>
</section>

<?php
// 4. Our Philosophy (split content — dark, image right)
$props = [
    'eyebrow'        => 'Our Philosophy',
    'heading'        => 'A commitment to',
    'heading_accent' => 'lasting impact.',
    'text'           => [
        'Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Maecenas faucibus mollis interdum.',
        'Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna mollis ornare vel eu leo. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.',
    ],
    'image'          => anchor_resolve_media( 'philosophy_image' ),
    'image_alt'      => 'Our philosophy in action',
    'image_position' => 'right',
    'dark'           => true,
];
anchor_set_template_data( [ 'type' => 'split_content', 'props' => $props ] );
?>
<section class="anchor-section anchor-section--dark" data-section-type="split_content">
<?php get_template_part( 'template-parts/sections/split-content' ); ?>
</section>

<?php
// 5. Our Values (card grid — icon variant, 4 columns)
$props = [
    'eyebrow'        => 'Our Values',
    'heading'        => 'The principles that',
    'heading_accent' => 'define us.',
    'columns'        => 4,
    'items'          => [
        [ 'icon' => 'heart',   'title' => 'Compassion', 'text' => 'Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper.' ],
        [ 'icon' => 'users',   'title' => 'Community',  'text' => 'Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante.' ],
        [ 'icon' => 'shield',  'title' => 'Integrity',  'text' => 'Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna vel scelerisque.' ],
        [ 'icon' => 'compass', 'title' => 'Innovation', 'text' => 'Nullam quis risus eget urna mollis ornare vel eu leo. Aenean lacinia bibendum nulla sed.' ],
    ],
];
anchor_set_template_data( [ 'type' => 'card_grid', 'variant' => 'icon', 'props' => $props ] );
?>
<section class="anchor-section anchor-section--icon" data-section-type="card_grid" data-section-variant="icon">
<?php get_template_part( 'template-parts/sections/card-grid' ); ?>
</section>

<?php
// 6. Team (team grid — bios layout)
$props = [
    'eyebrow'        => 'Meet the Team',
    'heading'        => 'The people behind',
    'heading_accent' => 'the mission.',
    'text'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas faucibus mollis interdum. Nullam id dolor id nibh ultricies vehicula ut id elit.',
    'layout'         => 'bios',
    'members'        => $team,
];
anchor_set_template_data( [ 'type' => 'team_grid', 'props' => $props ] );
?>
<section class="anchor-section" data-section-type="team_grid">
<?php get_template_part( 'template-parts/sections/team-grid' ); ?>
</section>
