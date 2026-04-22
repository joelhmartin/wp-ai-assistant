<?php
/**
 * Section: Deka Voices (testimonial slider).
 *
 * JS (deka-home.js) reads quotes from window.__DEKA_VOICES, so the PHP
 * template emits a small inline <script> to populate that global.
 *
 * Props:
 *   index / title / label
 *   voices (array) each: ['q' => '', 'n' => '', 't' => '']
 *     - 'q' may contain <em>word</em> (raw HTML allowed for the italic accent)
 *
 * @package Anchor_Framework
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$section = anchor_get_template_data();
$props   = ! empty( $section['props'] ) ? $section['props'] : [];

$index  = isset( $props['index'] )  ? $props['index']  : '';
$title  = isset( $props['title'] )  ? $props['title']  : '';
$label  = isset( $props['label'] )  ? $props['label']  : '';
$voices = isset( $props['voices'] ) && is_array( $props['voices'] ) ? $props['voices'] : [];

// For JS consumption: keep <em>...</em> intact; strip everything else.
$safe_voices = array_map( function( $v ) {
    $q = isset( $v['q'] ) ? wp_kses( $v['q'], [ 'em' => [] ] ) : '';
    return [
        'q' => $q,
        'n' => isset( $v['n'] ) ? wp_strip_all_tags( $v['n'] ) : '',
        't' => isset( $v['t'] ) ? wp_strip_all_tags( $v['t'] ) : '',
    ];
}, $voices );
$count = count( $safe_voices );
?>
<section class="voices" id="clinicians">
    <div class="container">
        <div class="section-head">
            <div class="section-index"><?php echo esc_html( $index ); ?></div>
            <div class="section-title"><?php echo esc_html( $title ); ?></div>
            <div class="section-label"><?php echo esc_html( $label ); ?></div>
        </div>

        <div class="voices-slider reveal" id="voices">
            <div class="voices-track" id="voices-track"></div>

            <div class="voices-controls">
                <div class="voices-dots" id="voices-dots"></div>
                <div class="voices-counter" id="voices-counter">01 / <?php echo esc_html( str_pad( (string) max( 1, $count ), 2, '0', STR_PAD_LEFT ) ); ?></div>
                <div class="voices-arrows">
                    <button id="voices-prev" aria-label="Previous">
                        <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M13 5H1m0 0l4-4m-4 4l4 4" stroke="currentColor" stroke-width="1.2"/></svg>
                    </button>
                    <button id="voices-next" aria-label="Next">
                        <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.__DEKA_VOICES = <?php echo wp_json_encode( $safe_voices ); ?>;
    </script>
</section>
