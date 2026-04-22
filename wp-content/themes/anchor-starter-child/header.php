<?php
/**
 * Child theme header.
 *
 * On the front page, emit the bespoke editorial nav and skip the framework
 * pill nav. Everywhere else, fall back to the framework's header flow.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( is_front_page() ) :
    $nav = function_exists( 'anchor_get_navigation_config' ) ? anchor_get_navigation_config() : [];
    $main_nav    = isset( $nav['main_nav'] )   ? $nav['main_nav']   : [];
    $cta         = isset( $nav['cta_button'] ) ? $nav['cta_button'] : null;
    $logo_url    = function_exists( 'anchor_resolve_media' ) ? anchor_resolve_media( 'deka_logo' )       : '';
    $logo_w_url  = function_exists( 'anchor_resolve_media' ) ? anchor_resolve_media( 'deka_logo_white' ) : '';
    ?>
    <nav class="deka-nav" id="deka-nav">
        <div class="container nav-row">
            <div class="nav-logo" aria-label="DEKA Dental Lasers">
                <?php if ( $logo_url ) : ?>
                    <img class="nav-logo-light" src="<?php echo esc_url( $logo_url ); ?>" alt="DEKA" style="display:block;">
                    <?php if ( $logo_w_url ) : ?>
                        <img class="nav-logo-dark" src="<?php echo esc_url( $logo_w_url ); ?>" alt="" style="display:none;">
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="nav-links">
                <?php foreach ( $main_nav as $item ) : ?>
                    <a class="nav-link" href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
                <?php endforeach; ?>
            </div>

            <div class="nav-right">
                <?php if ( $cta ) : ?>
                    <a class="nav-cta" href="<?php echo esc_url( $cta['url'] ); ?>">
                        <?php echo esc_html( $cta['label'] ); ?>
                        <svg width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"/></svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <style>
        /* Swap nav logo variant when nav is dark. */
        .deka-nav.nav--dark .nav-logo-light { display: none !important; }
        .deka-nav.nav--dark .nav-logo-dark  { display: block !important; }
    </style>
<?php else : ?>
    <?php get_template_part( 'template-parts/navigation/header-nav' ); ?>
<?php endif; ?>
