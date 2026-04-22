<?php
/**
 * Section: Deka Outcomes (metrics).
 *
 * Props:
 *   index / title / label
 *   heading  (string) big serif with **italic** markers
 *   text     (string) italicized lede
 *   metrics  (array) each: ['num' => '', 'sup' => '', 'label' => '']
 *
 * @package Anchor_Framework
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$section = anchor_get_template_data();
$props   = ! empty( $section['props'] ) ? $section['props'] : [];

$index   = isset( $props['index'] )   ? $props['index']   : '';
$title   = isset( $props['title'] )   ? $props['title']   : '';
$label   = isset( $props['label'] )   ? $props['label']   : '';
$heading = isset( $props['heading'] ) ? $props['heading'] : '';
$text    = isset( $props['text'] )    ? $props['text']    : '';
$metrics = isset( $props['metrics'] ) && is_array( $props['metrics'] ) ? $props['metrics'] : [];

$heading_html = preg_replace( '/\*\*(.+?)\*\*/', '<em>$1</em>', esc_html( $heading ) );
?>
<section class="outcomes" id="outcomes">
    <div class="container">
        <div class="section-head">
            <div class="section-index"><?php echo esc_html( $index ); ?></div>
            <div class="section-title"><?php echo esc_html( $title ); ?></div>
            <div class="section-label"><?php echo esc_html( $label ); ?></div>
        </div>

        <div class="outcomes-wrap">
            <div class="outcomes-lead reveal">
                <?php if ( $heading ) : ?>
                    <h2 class="display"><?php echo $heading_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
                <?php endif; ?>
                <?php if ( $text ) : ?>
                    <p><?php echo esc_html( $text ); ?></p>
                <?php endif; ?>
            </div>

            <?php if ( ! empty( $metrics ) ) : ?>
                <div class="metrics reveal">
                    <?php foreach ( $metrics as $m ) : ?>
                        <div class="metric">
                            <div class="num"><?php echo esc_html( isset( $m['num'] ) ? $m['num'] : '' );
                                if ( ! empty( $m['sup'] ) ) { echo '<sup>' . esc_html( $m['sup'] ) . '</sup>'; }
                            ?></div>
                            <div class="lbl"><?php echo esc_html( isset( $m['label'] ) ? $m['label'] : '' ); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
