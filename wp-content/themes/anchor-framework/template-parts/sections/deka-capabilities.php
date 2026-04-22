<?php
/**
 * Section: Deka Capabilities.
 *
 * Props:
 *   index / title / label — section head (mono)
 *   heading  (string)  big serif with **italic** markers
 *   text     (string)
 *   cards    (array) each: ['num' => '01', 'kicker' => 'Benefit', 'h' => '', 'p' => '']
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
$cards   = isset( $props['cards'] ) && is_array( $props['cards'] ) ? $props['cards'] : [];

$heading_html = preg_replace( '/\*\*(.+?)\*\*/', '<em>$1</em>', esc_html( $heading ) );
?>
<section class="capabilities" id="technology">
    <div class="container">
        <div class="section-head">
            <div class="section-index"><?php echo esc_html( $index ); ?></div>
            <div class="section-title"><?php echo esc_html( $title ); ?></div>
            <div class="section-label"><?php echo esc_html( $label ); ?></div>
        </div>

        <div class="cap-head">
            <?php if ( $heading ) : ?>
                <h2 class="display reveal"><?php echo $heading_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
            <?php endif; ?>
            <?php if ( $text ) : ?>
                <p class="reveal"><?php echo esc_html( $text ); ?></p>
            <?php endif; ?>
        </div>

        <?php if ( ! empty( $cards ) ) : ?>
            <div class="cap-grid">
                <?php foreach ( $cards as $c ) : ?>
                    <div class="cap-card reveal">
                        <div>
                            <div class="cap-num"><?php echo esc_html( isset( $c['num'] ) ? $c['num'] : '' ); ?></div>
                            <?php if ( ! empty( $c['kicker'] ) ) : ?>
                                <div class="cap-kicker"><?php echo esc_html( $c['kicker'] ); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="cap-body">
                            <?php if ( ! empty( $c['h'] ) ) : ?><h3><?php echo esc_html( $c['h'] ); ?></h3><?php endif; ?>
                            <?php if ( ! empty( $c['p'] ) ) : ?><p><?php echo esc_html( $c['p'] ); ?></p><?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
