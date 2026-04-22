<?php
/**
 * Section: Deka Manifesto.
 *
 * Props:
 *   index    (string) e.g. "— 01"
 *   title    (string) section title (mono)
 *   label    (string) section label (mono, right-aligned)
 *   quote    (string) big serif quote; use ** around the word to italicize, e.g. "arrives like **intention** —"
 *   columns  (array) each: ['h' => '', 'p' => '']
 *
 * @package Anchor_Framework
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$section = anchor_get_template_data();
$props   = ! empty( $section['props'] ) ? $section['props'] : [];

$index   = isset( $props['index'] )   ? $props['index']   : '';
$title   = isset( $props['title'] )   ? $props['title']   : '';
$label   = isset( $props['label'] )   ? $props['label']   : '';
$quote   = isset( $props['quote'] )   ? $props['quote']   : '';
$columns = isset( $props['columns'] ) && is_array( $props['columns'] ) ? $props['columns'] : [];

// Convert **word** into <em>word</em> for the serif italic accent.
$quote_html = esc_html( $quote );
$quote_html = preg_replace( '/\*\*(.+?)\*\*/', '<em>$1</em>', $quote_html );
?>
<section class="manifesto">
    <div class="container">
        <div class="section-head">
            <div class="section-index"><?php echo esc_html( $index ); ?></div>
            <div class="section-title"><?php echo esc_html( $title ); ?></div>
            <div class="section-label"><?php echo esc_html( $label ); ?></div>
        </div>

        <?php if ( $quote ) : ?>
            <div class="manifesto-body">
                <p class="manifesto-quote reveal">
                    <?php echo $quote_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </p>
            </div>
        <?php endif; ?>

        <?php if ( ! empty( $columns ) ) : ?>
            <div class="manifesto-foot">
                <?php foreach ( $columns as $c ) : ?>
                    <div class="manifesto-col reveal">
                        <?php if ( ! empty( $c['h'] ) ) : ?><h4><?php echo esc_html( $c['h'] ); ?></h4><?php endif; ?>
                        <?php if ( ! empty( $c['p'] ) ) : ?><p><?php echo esc_html( $c['p'] ); ?></p><?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
