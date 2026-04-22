<?php
/**
 * Section: Deka Flagship (dark hero-treatment product).
 *
 * Props:
 *   index / title / label
 *   visual_label     (string)
 *   visual_caption   (string) bottom of ringed frame
 *   ticker_left      (string)
 *   ticker_right     (string)
 *   image            (string) media key or URL
 *   image_alt        (string)
 *   heading          (string) big serif; uses **italic** markers, <br> allowed as `\n`
 *   lede             (string)
 *   specs            (array) each: ['k' => '', 'v' => '', 'sup' => '']
 *   primary_cta / secondary_cta
 *
 * @package Anchor_Framework
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$section = anchor_get_template_data();
$props   = ! empty( $section['props'] ) ? $section['props'] : [];

$index          = isset( $props['index'] )           ? $props['index']           : '';
$title          = isset( $props['title'] )           ? $props['title']           : '';
$label          = isset( $props['label'] )           ? $props['label']           : '';
$visual_label   = isset( $props['visual_label'] )    ? $props['visual_label']    : '';
$visual_caption = isset( $props['visual_caption'] )  ? $props['visual_caption']  : '';
$ticker_left    = isset( $props['ticker_left'] )     ? $props['ticker_left']     : '';
$ticker_right   = isset( $props['ticker_right'] )    ? $props['ticker_right']    : '';
$image          = isset( $props['image'] )           ? $props['image']           : '';
$image_alt      = isset( $props['image_alt'] )       ? $props['image_alt']       : '';
$heading        = isset( $props['heading'] )         ? $props['heading']         : '';
$lede           = isset( $props['lede'] )            ? $props['lede']            : '';
$specs          = isset( $props['specs'] ) && is_array( $props['specs'] ) ? $props['specs'] : [];
$primary_cta    = isset( $props['primary_cta'] ) && is_array( $props['primary_cta'] )   ? $props['primary_cta']   : null;
$secondary_cta  = isset( $props['secondary_cta'] ) && is_array( $props['secondary_cta'] ) ? $props['secondary_cta'] : null;

// Build heading HTML: \n → <br>, **x** → <em>x</em>.
$heading_html = esc_html( $heading );
$heading_html = str_replace( "\n", '<br>', $heading_html );
$heading_html = preg_replace( '/\*\*(.+?)\*\*/', '<em>$1</em>', $heading_html );
?>
<section class="flagship">
    <div class="container">
        <div class="section-head">
            <div class="section-index"><?php echo esc_html( $index ); ?></div>
            <div class="section-title"><?php echo esc_html( $title ); ?></div>
            <div class="section-label"><?php echo esc_html( $label ); ?></div>
        </div>

        <div class="flagship-wrap">
            <div class="flagship-visual reveal">
                <?php if ( $visual_label ) : ?><div class="fv-label"><?php echo esc_html( $visual_label ); ?></div><?php endif; ?>

                <div class="fv-crop">
                    <div class="ring"></div>
                    <div class="ring ring2"></div>
                    <div class="ring ring3"></div>
                    <div class="dot"></div>
                    <?php if ( $visual_caption ) : ?><div class="caption"><?php echo esc_html( $visual_caption ); ?></div><?php endif; ?>
                </div>

                <?php if ( $image ) : ?>
                    <div class="fv-photo"><img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" loading="lazy"/></div>
                <?php endif; ?>

                <?php if ( $ticker_left || $ticker_right ) : ?>
                    <div class="fv-ticker">
                        <span><?php echo esc_html( $ticker_left ); ?></span>
                        <span><?php echo esc_html( $ticker_right ); ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="flagship-content">
                <?php if ( $heading ) : ?>
                    <h3 class="display reveal"><?php echo $heading_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3>
                <?php endif; ?>

                <?php if ( $lede ) : ?>
                    <p class="flagship-lede reveal"><?php echo esc_html( $lede ); ?></p>
                <?php endif; ?>

                <?php if ( ! empty( $specs ) ) : ?>
                    <div class="flagship-specs reveal">
                        <?php foreach ( $specs as $s ) : ?>
                            <div class="spec">
                                <div class="k"><?php echo esc_html( isset( $s['k'] ) ? $s['k'] : '' ); ?></div>
                                <div class="v"><?php echo esc_html( isset( $s['v'] ) ? $s['v'] : '' );
                                    if ( ! empty( $s['sup'] ) ) { echo '<sup>' . esc_html( $s['sup'] ) . '</sup>'; }
                                ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ( $primary_cta || $secondary_cta ) : ?>
                    <div class="flagship-ctas reveal">
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
        </div>
    </div>
</section>
