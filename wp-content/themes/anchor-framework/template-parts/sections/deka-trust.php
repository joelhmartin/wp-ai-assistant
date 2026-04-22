<?php
/**
 * Section: Deka Trust (institution logos as type).
 *
 * Props:
 *   label   (string) left-side mono label
 *   logos   (array) each: ['name' => '', 'mono' => bool, 'href' => '']
 *
 * @package Anchor_Framework
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$section = anchor_get_template_data();
$props   = ! empty( $section['props'] ) ? $section['props'] : [];

$label = isset( $props['label'] ) ? $props['label'] : '';
$logos = isset( $props['logos'] ) && is_array( $props['logos'] ) ? $props['logos'] : [];
?>
<section class="trust">
    <div class="container trust-wrap">
        <?php if ( $label ) : ?>
            <div class="trust-label"><?php echo esc_html( $label ); ?></div>
        <?php endif; ?>

        <?php if ( ! empty( $logos ) ) : ?>
            <div class="trust-logos">
                <?php foreach ( $logos as $logo ) :
                    $cls  = 'trust-logo' . ( ! empty( $logo['mono'] ) ? ' mono' : '' );
                    $name = isset( $logo['name'] ) ? $logo['name'] : '';
                    $href = isset( $logo['href'] ) ? $logo['href'] : '';
                    if ( $href ) {
                        printf(
                            '<a class="%s" href="%s">%s</a>',
                            esc_attr( $cls ),
                            esc_url( $href ),
                            esc_html( $name )
                        );
                    } else {
                        printf( '<div class="%s">%s</div>', esc_attr( $cls ), esc_html( $name ) );
                    }
                endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
