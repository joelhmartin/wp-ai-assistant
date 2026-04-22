<?php
/**
 * Section: Deka Hero (editorial).
 *
 * Props:
 *   meta_left      (string)
 *   meta_right     (string)
 *   heading_lines  (array) each: ['text' => '', 'italic' => ''] ('italic' rendered via <em>)
 *   sub            (string)
 *   stats          (array) each: ['num' => '', 'sup' => '', 'cap' => '']
 *   primary_cta    (['label' => '', 'url' => ''])
 *
 * @package Anchor_Framework
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$section = anchor_get_template_data();
$props   = ! empty( $section['props'] ) ? $section['props'] : [];

$meta_left     = isset( $props['meta_left'] )    ? $props['meta_left']    : '';
$meta_right    = isset( $props['meta_right'] )   ? $props['meta_right']   : '';
$lines         = isset( $props['heading_lines'] ) && is_array( $props['heading_lines'] ) ? $props['heading_lines'] : [];
$sub           = isset( $props['sub'] )          ? $props['sub']          : '';
$stats         = isset( $props['stats'] ) && is_array( $props['stats'] ) ? $props['stats'] : [];
$primary_cta   = isset( $props['primary_cta'] ) && is_array( $props['primary_cta'] ) ? $props['primary_cta'] : null;
?>
<header class="hero" id="top">
    <div class="hero-grain"></div>
    <div class="hero-beam b1"></div>
    <div class="hero-beam b2"></div>

    <div class="container hero-inner">
        <div class="hero-meta">
            <?php if ( $meta_left ) : ?><div class="mono"><?php echo esc_html( $meta_left ); ?></div><?php endif; ?>
            <?php if ( $meta_right ) : ?><div class="mono"><?php echo esc_html( $meta_right ); ?></div><?php endif; ?>
        </div>

        <div>
            <?php if ( ! empty( $lines ) ) : ?>
                <h1 class="display hero-headline" style="color: var(--deka-ivory);">
                    <?php foreach ( $lines as $line ) :
                        $text   = isset( $line['text'] )   ? $line['text']   : '';
                        $italic = isset( $line['italic'] ) ? $line['italic'] : '';
                        ?>
                        <span class="line"><span><?php
                            echo esc_html( $text );
                            if ( $italic !== '' ) {
                                echo ' <em>' . esc_html( $italic ) . '</em>';
                            }
                        ?></span></span>
                    <?php endforeach; ?>
                </h1>
            <?php endif; ?>

            <div class="hero-foot">
                <?php if ( $sub ) : ?>
                    <p class="hero-sub"><?php echo esc_html( $sub ); ?></p>
                <?php endif; ?>

                <?php if ( ! empty( $stats ) ) : ?>
                    <div class="hero-stats">
                        <?php foreach ( $stats as $s ) : ?>
                            <div class="hero-stat">
                                <div class="num"><?php echo esc_html( isset( $s['num'] ) ? $s['num'] : '' );
                                    if ( ! empty( $s['sup'] ) ) { echo '<sup>' . esc_html( $s['sup'] ) . '</sup>'; }
                                ?></div>
                                <div class="cap"><?php echo esc_html( isset( $s['cap'] ) ? $s['cap'] : '' ); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ( $primary_cta ) : ?>
                    <div>
                        <a class="hero-cta" href="<?php echo esc_url( $primary_cta['url'] ); ?>">
                            <?php echo esc_html( $primary_cta['label'] ); ?>
                            <svg class="arrow" viewBox="0 0 24 12" fill="none" aria-hidden="true"><path d="M0 6h22m0 0l-6-5m6 5l-6 5" stroke="currentColor" stroke-width="1.2"/></svg>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="hero-scroll">
        <span>Scroll</span>
        <div class="tick"></div>
    </div>
</header>
