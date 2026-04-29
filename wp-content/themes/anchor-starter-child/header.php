<?php
/**
 * Child theme header.
 *
 * On the bespoke editorial pages (home-v1..v4 and the shop) emit the unified
 * .site-nav. Everywhere else, fall back to the framework's header nav.
 *
 * @package Anchor_Starter_Child
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

<?php
$obj           = get_queried_object();
$current_slug  = ( $obj && isset( $obj->post_name ) ) ? $obj->post_name : '';
$home_slugs    = array( 'home-v1', 'home-v2', 'home-v3', 'home-v4' );
$is_home_var   = is_front_page() || in_array( $current_slug, $home_slugs, true );
$is_shop       = ( function_exists( 'is_shop' ) && is_shop() )
              || ( function_exists( 'is_product' ) && is_product() )
              || ( function_exists( 'is_product_category' ) && is_product_category() )
              || ( function_exists( 'is_product_tag' ) && is_product_tag() );
$show_site_nav = $is_home_var || $is_shop;

// Resolve the slug that the Versions dropdown should mark active. On the
// front page that is the slug of the WP "page on front" setting, otherwise
// it is the queried slug.
$active_slug = $current_slug;
if ( is_front_page() ) {
	$front_id    = (int) get_option( 'page_on_front' );
	$active_slug = $front_id ? get_post_field( 'post_name', $front_id ) : 'home-v1';
}

$nav_cfg   = function_exists( 'anchor_get_navigation_config' ) ? anchor_get_navigation_config() : array();
$cta       = isset( $nav_cfg['cta_button'] ) ? $nav_cfg['cta_button'] : null;
$logo_url  = function_exists( 'anchor_resolve_media' ) ? anchor_resolve_media( 'deka_logo' )       : '';
$logo_w    = function_exists( 'anchor_resolve_media' ) ? anchor_resolve_media( 'deka_logo_white' ) : '';

$versions = array(
	array( 'slug' => 'home-v1', 'label' => 'Home v1' ),
	array( 'slug' => 'home-v2', 'label' => 'Home v2' ),
	array( 'slug' => 'home-v3', 'label' => 'Home v3' ),
	array( 'slug' => 'home-v4', 'label' => 'Home v4' ),
);
?>

<?php if ( $show_site_nav ) : ?>
<nav class="site-nav" id="site-nav">
	<div class="container nav-row">
		<a class="nav-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="DEKA Dental Lasers">
			<?php if ( $logo_url ) : ?>
				<img class="nav-logo-light" src="<?php echo esc_url( $logo_url ); ?>" alt="DEKA" style="display:block;">
			<?php endif; ?>
			<?php if ( $logo_w ) : ?>
				<img class="nav-logo-dark" src="<?php echo esc_url( $logo_w ); ?>" alt="" style="display:none;">
			<?php endif; ?>
		</a>

		<div class="nav-links">
			<div class="nav-dropdown">
				<button type="button" class="nav-link nav-dropdown__toggle" aria-haspopup="true" aria-expanded="false">
					Versions
					<svg class="chev" viewBox="0 0 12 12" fill="none" aria-hidden="true"><path d="M3 5l3 3 3-3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
				</button>
				<div class="nav-dropdown__menu" role="menu">
					<?php foreach ( $versions as $v ) :
						$is_active = ( $v['slug'] === $active_slug );
						$attrs     = $is_active ? ' aria-current="page"' : '';
						?>
						<a class="nav-dropdown__item" href="<?php echo esc_url( home_url( '/' . $v['slug'] . '/' ) ); ?>"<?php echo $attrs; ?> role="menuitem"><?php echo esc_html( $v['label'] ); ?></a>
					<?php endforeach; ?>
				</div>
			</div>
			<a class="nav-link" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"<?php echo $is_shop ? ' aria-current="page"' : ''; ?>>Shop</a>
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
	.site-nav.nav--dark .nav-logo-light { display: none !important; }
	.site-nav.nav--dark .nav-logo-dark  { display: block !important; }
</style>
<?php else : ?>
<?php get_template_part( 'template-parts/navigation/header-nav' ); ?>
<?php endif; ?>
