<?php
/**
 * Section: Deka Final CTA.
 *
 * Props:
 *   eyebrow        (string)
 *   heading        (string) supports \n and **italic**
 *   text           (string) italicized lede
 *   primary_cta / secondary_cta
 *
 * @package Anchor_Framework
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$section = anchor_get_template_data();
$props   = ! empty( $section['props'] ) ? $section['props'] : [];

$eyebrow        = isset( $props['eyebrow'] )       ? $props['eyebrow']       : '';
$heading        = isset( $props['heading'] )       ? $props['heading']       : '';
$text           = isset( $props['text'] )          ? $props['text']          : '';
$primary_cta    = isset( $props['primary_cta'] ) && is_array( $props['primary_cta'] )   ? $props['primary_cta']   : null;
$secondary_cta  = isset( $props['secondary_cta'] ) && is_array( $props['secondary_cta'] ) ? $props['secondary_cta'] : null;

$heading_html = esc_html( $heading );
$heading_html = str_replace( "\n", '<br>', $heading_html );
$heading_html = preg_replace( '/\*\*(.+?)\*\*/', '<em>$1</em>', $heading_html );
?>
<section class="final" id="final">
    <div class="container final-inner">
        <?php if ( $eyebrow ) : ?>
            <span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
        <?php endif; ?>

        <?php if ( $heading ) : ?>
            <h2 class="display"><?php echo $heading_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
        <?php endif; ?>

        <?php if ( $text ) : ?>
            <p><?php echo esc_html( $text ); ?></p>
        <?php endif; ?>

        <?php if ( $primary_cta || $secondary_cta ) : ?>
            <div class="final-ctas">
                <?php if ( $primary_cta ) : ?>
                    <a class="btn-primary" href="<?php echo esc_url( $primary_cta['url'] ); ?>">
                        <?php echo esc_html( $primary_cta['label'] ); ?>
                        <svg width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"/></svg>
                    </a>
                <?php endif; ?>
                <?php if ( $secondary_cta ) : ?>
                    <a class="btn-ghost" href="<?php echo esc_url( $secondary_cta['url'] ); ?>"><?php echo esc_html( $secondary_cta['label'] ); ?></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
