<?php
/**
 * Section: Deka Product Lineup.
 *
 * Props:
 *   index / title / label — section head
 *   products (array) each:
 *     - image        (string) media key or URL
 *     - image_alt    (string)
 *     - tag          (string) upper-right tag
 *     - caption_l    (string) bottom-left caption
 *     - caption_r    (string) bottom-right caption
 *     - sm           (string) small mono line above product name
 *     - name         (string) product display name (serif)
 *     - description  (string) paragraph
 *     - meta_l       (string) footer meta left
 *     - url          (string) product detail URL
 *
 * @package Anchor_Framework
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$section = anchor_get_template_data();
$props   = ! empty( $section['props'] ) ? $section['props'] : [];

$index    = isset( $props['index'] )   ? $props['index']   : '';
$title    = isset( $props['title'] )   ? $props['title']   : '';
$label    = isset( $props['label'] )   ? $props['label']   : '';
$products = isset( $props['products'] ) && is_array( $props['products'] ) ? $props['products'] : [];
?>
<section class="lineup" id="products">
    <div class="container">
        <div class="section-head">
            <div class="section-index"><?php echo esc_html( $index ); ?></div>
            <div class="section-title"><?php echo esc_html( $title ); ?></div>
            <div class="section-label"><?php echo esc_html( $label ); ?></div>
        </div>

        <?php if ( ! empty( $products ) ) : ?>
            <div class="lineup-grid">
                <?php foreach ( $products as $p ) :
                    $img  = isset( $p['image'] ) ? $p['image'] : '';
                    $alt  = isset( $p['image_alt'] ) ? $p['image_alt'] : '';
                    $url  = isset( $p['url'] ) ? $p['url'] : '#';
                    ?>
                    <a class="product" href="<?php echo esc_url( $url ); ?>">
                        <div class="product-visual">
                            <div class="shape">
                                <div class="ring"></div>
                                <div class="ring-in"></div>
                            </div>
                            <?php if ( $img ) : ?>
                                <div class="pv-photo"><img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy"/></div>
                            <?php endif; ?>
                            <?php if ( ! empty( $p['tag'] ) ) : ?><div class="tag"><?php echo esc_html( $p['tag'] ); ?></div><?php endif; ?>
                            <?php if ( ! empty( $p['caption_l'] ) || ! empty( $p['caption_r'] ) ) : ?>
                                <div class="caption">
                                    <span><?php echo esc_html( isset( $p['caption_l'] ) ? $p['caption_l'] : '' ); ?></span>
                                    <span><?php echo esc_html( isset( $p['caption_r'] ) ? $p['caption_r'] : '' ); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <h4>
                            <?php if ( ! empty( $p['sm'] ) ) : ?><span class="sm"><?php echo esc_html( $p['sm'] ); ?></span><?php endif; ?>
                            <?php echo esc_html( isset( $p['name'] ) ? $p['name'] : '' ); ?>
                        </h4>

                        <?php if ( ! empty( $p['description'] ) ) : ?>
                            <p><?php echo esc_html( $p['description'] ); ?></p>
                        <?php endif; ?>

                        <div class="product-meta">
                            <span><?php echo esc_html( isset( $p['meta_l'] ) ? $p['meta_l'] : '' ); ?></span>
                            <span class="arrow">→</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
