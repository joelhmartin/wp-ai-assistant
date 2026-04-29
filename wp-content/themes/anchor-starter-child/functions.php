<?php
/**
 * Anchor Starter Child – functions and definitions.
 *
 * Enqueues child-theme stylesheets that layer on top of the parent
 * Anchor Framework CSS.  The parent theme already enqueues its own
 * stylesheets, so we only need to add the child-specific overrides.
 *
 * @package Anchor_Starter_Child
 * @since   1.0.0
 */

if ( ! function_exists( 'anchor_starter_child_enqueue_styles' ) ) :
	/**
	 * Enqueue child-theme stylesheets.
	 *
	 * - client-tokens.css  – custom-property overrides (loads after parent CSS).
	 * - client-overrides.css – any additional CSS tweaks (loads after tokens).
	 */
	function anchor_starter_child_enqueue_styles() {

		$theme_version = wp_get_theme()->get( 'Version' );

		// Client design-token overrides (loaded after all parent CSS).
		wp_enqueue_style(
			'anchor-child-tokens',
			get_stylesheet_directory_uri() . '/assets/css/client-tokens.css',
			array( 'anchor-responsive' ),
			$theme_version
		);

		// Client CSS overrides (loaded after tokens).
		wp_enqueue_style(
			'anchor-child-overrides',
			get_stylesheet_directory_uri() . '/assets/css/client-overrides.css',
			array( 'anchor-child-tokens' ),
			$theme_version
		);

		// Front-page-only assets: bespoke editorial homepage.
		if ( is_front_page() ) {

			// Google Fonts for the homepage (Cormorant 300/400/500, Inter, JetBrains Mono).
			wp_enqueue_style(
				'deka-home-fonts',
				'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500&family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap',
				array(),
				null
			);

			wp_enqueue_style(
				'deka-home',
				get_stylesheet_directory_uri() . '/assets/css/deka-home.css',
				array( 'anchor-child-tokens', 'deka-home-fonts' ),
				$theme_version
			);

			wp_enqueue_script(
				'deka-home',
				get_stylesheet_directory_uri() . '/assets/js/deka-home.js',
				array(),
				$theme_version,
				true
			);
		}

		// Shop-only assets (archive + single laser_product).
		if ( is_post_type_archive( 'laser_product' ) || is_singular( 'laser_product' ) ) {
			wp_enqueue_style(
				'deka-home-fonts',
				'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500&family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap',
				array(),
				null
			);
			wp_enqueue_style(
				'deka-home',
				get_stylesheet_directory_uri() . '/assets/css/deka-home.css',
				array( 'anchor-child-tokens', 'deka-home-fonts' ),
				$theme_version
			);
			wp_enqueue_style(
				'deka-shop',
				get_stylesheet_directory_uri() . '/assets/css/deka-shop.css',
				array( 'deka-home' ),
				$theme_version
			);
			wp_enqueue_script(
				'deka-home',
				get_stylesheet_directory_uri() . '/assets/js/deka-home.js',
				array(),
				$theme_version,
				true
			);
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'anchor_starter_child_enqueue_styles' );

/**
 * Auto-enqueue a per-page CSS file from assets/css/pages/{slug}.css
 * when that file exists in the child theme. Allows scoped styles for
 * individual pages without touching global CSS.
 */
if ( ! function_exists( 'anchor_child_enqueue_page_css' ) ) :
	function anchor_child_enqueue_page_css() {
		$obj = get_queried_object();
		if ( ! $obj || ! isset( $obj->post_name ) || '' === $obj->post_name ) {
			return;
		}
		$slug = sanitize_file_name( $obj->post_name );
		$path = get_stylesheet_directory() . '/assets/css/pages/' . $slug . '.css';
		if ( ! file_exists( $path ) ) {
			return;
		}
		wp_enqueue_style(
			'anchor-page-' . $slug,
			get_stylesheet_directory_uri() . '/assets/css/pages/' . $slug . '.css',
			array( 'anchor-child-overrides' ),
			filemtime( $path )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'anchor_child_enqueue_page_css' );

/**
 * Body classes for the bespoke editorial chrome:
 *   - `deka-home`  on the front page
 *   - `deka-shop`  on the laser_product archive and single pages
 * The deka-shop class inherits the home stylesheet so the nav / typography /
 * reveal animations all apply consistently across shop URLs.
 */
add_filter( 'body_class', function( $classes ) {
	$slug = '';
	$obj  = get_queried_object();
	if ( $obj && isset( $obj->post_name ) ) {
		$slug = $obj->post_name;
	}
	$home_slugs = array( 'home-v1', 'home-v2', 'home-v3', 'home-v4' );

	if ( is_front_page() || in_array( $slug, $home_slugs, true ) ) {
		$classes[] = 'home-editorial';
		// Per-version class. Front page resolves to whichever WP page is set as
		// the static front page; if that has a slug in $home_slugs we tag it
		// directly. Otherwise we default to home-v1 so v1 styles still apply
		// at /.
		$front_id   = (int) get_option( 'page_on_front' );
		$front_slug = $front_id ? get_post_field( 'post_name', $front_id ) : '';
		$active     = in_array( $slug, $home_slugs, true ) ? $slug
		            : ( in_array( $front_slug, $home_slugs, true ) ? $front_slug : 'home-v1' );
		$classes[]  = $active;
	}
	if ( is_post_type_archive( 'laser_product' ) || is_singular( 'laser_product' ) ) {
		$classes[] = 'home-editorial'; // shared chrome scope
		$classes[] = 'home-v1';        // shop reuses v1 typography/animations
		$classes[] = 'shop-editorial';
	}
	return $classes;
} );

/**
 * Register the `laser_product` custom post type, rewriting to /shop/{slug}/.
 */
if ( ! function_exists( 'deka_register_laser_product_cpt' ) ) :
	function deka_register_laser_product_cpt() {
		register_post_type( 'laser_product', [
			'labels' => [
				'name'          => 'Laser Products',
				'singular_name' => 'Laser Product',
				'add_new_item'  => 'Add New Product',
				'edit_item'     => 'Edit Product',
				'all_items'     => 'All Products',
				'menu_name'     => 'Laser Products',
			],
			'public'             => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'has_archive'        => 'shop',
			'menu_icon'          => 'dashicons-store',
			'menu_position'      => 21,
			'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
			'rewrite'            => [ 'slug' => 'shop', 'with_front' => false ],
			'hierarchical'       => false,
			'capability_type'    => 'post',
		] );

		register_taxonomy( 'laser_product_category', 'laser_product', [
			'labels' => [
				'name'          => 'Categories',
				'singular_name' => 'Category',
			],
			'public'            => true,
			'show_in_rest'      => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'rewrite'           => [ 'slug' => 'shop/category', 'with_front' => false ],
		] );
	}
endif;
add_action( 'init', 'deka_register_laser_product_cpt', 5 );

/**
 * Flush rewrite rules once after the CPT is registered. Keyed by a version
 * constant so future CPT/rewrite changes can force a reflush by bumping it.
 */
add_action( 'init', function() {
	$version = '1';
	if ( get_option( 'deka_rewrite_flushed' ) !== $version ) {
		flush_rewrite_rules( false );
		update_option( 'deka_rewrite_flushed', $version );
	}
}, 20 );

/**
 * Seed the laser_product CPT from config/data.php on first request.
 * Idempotent: runs once, tracked by the `deka_products_seeded` option.
 * Re-run by deleting that option in wp_options.
 */
add_action( 'init', function() {
	if ( get_option( 'deka_products_seeded' ) === '1' ) {
		return;
	}
	if ( ! function_exists( 'anchor_get_data' ) ) {
		return;
	}
	$products = anchor_get_data( 'products' );
	if ( empty( $products ) || ! is_array( $products ) ) {
		return;
	}
	foreach ( $products as $p ) {
		if ( empty( $p['slug'] ) ) {
			continue;
		}
		// Skip if a post with this slug already exists.
		$existing = get_page_by_path( $p['slug'], OBJECT, 'laser_product' );
		if ( $existing ) {
			continue;
		}
		$post_id = wp_insert_post( [
			'post_type'    => 'laser_product',
			'post_status'  => 'publish',
			'post_title'   => isset( $p['name'] ) ? $p['name'] : $p['slug'],
			'post_name'    => $p['slug'],
			'post_excerpt' => isset( $p['tagline'] ) ? $p['tagline'] : '',
			'post_content' => isset( $p['description'] ) ? $p['description'] : '',
		] );
		if ( $post_id && ! is_wp_error( $post_id ) ) {
			if ( ! empty( $p['category'] ) ) {
				wp_set_object_terms( $post_id, $p['category'], 'laser_product_category' );
			}
			// Store the data.php slug on the post for lookups in templates.
			update_post_meta( $post_id, '_deka_product_slug', $p['slug'] );
		}
	}
	update_option( 'deka_products_seeded', '1' );
}, 50 );

/**
 * Look up a product config entry by slug. Returns null if not found.
 */
if ( ! function_exists( 'deka_get_product' ) ) :
	function deka_get_product( $slug ) {
		if ( ! function_exists( 'anchor_get_data' ) ) {
			return null;
		}
		$products = anchor_get_data( 'products' );
		if ( empty( $products ) ) {
			return null;
		}
		foreach ( $products as $p ) {
			if ( isset( $p['slug'] ) && $p['slug'] === $slug ) {
				return $p;
			}
		}
		return null;
	}
endif;

/* =============================================================
 * Media Library import
 * Imports every image used by the site (theme product renders +
 * remote accessory photos) into wp-content/uploads as proper
 * WordPress attachments, so they appear in the Media Library.
 * =============================================================
 */

/* Allow SVG uploads (used by the DEKA logos). Admin-only risk surface. */
add_filter( 'upload_mimes', function( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
} );
add_filter( 'wp_check_filetype_and_ext', function( $data, $file, $filename, $mimes ) {
	if ( substr( strtolower( $filename ), -4 ) === '.svg' ) {
		$data['type'] = 'image/svg+xml';
		$data['ext']  = 'svg';
	}
	return $data;
}, 10, 4 );

/**
 * Override the media config so named keys (e.g. `deka_logo`, `product_us20d`)
 * resolve to imported attachment IDs whenever the media importer has mapped
 * them. Falls back to the static values in config/media.php otherwise.
 */
if ( ! function_exists( 'anchor_get_media_config' ) ) :
	function anchor_get_media_config() {
		static $cache = null;
		if ( $cache !== null ) {
			return $cache;
		}
		// Load base config from child theme (or parent fallback) using the same
		// resolution logic as the framework.
		$config = function_exists( 'anchor_load_config' ) ? anchor_load_config( 'media' ) : [];
		$map    = get_option( 'deka_media_map', [] );
		if ( is_array( $map ) ) {
			foreach ( $map as $key => $attachment_id ) {
				if ( (int) $attachment_id > 0 ) {
					$config[ $key ] = (int) $attachment_id;
				}
			}
		}
		$cache = $config;
		return $cache;
	}
endif;

/**
 * Import all site images into the Media Library.
 * Runs once on the next request made by a logged-in admin (so the user's
 * next page load, from the front-end OR wp-admin, triggers it). Idempotent:
 * tracked by `deka_media_imported`; re-run by deleting that option.
 */
function deka_seed_media() {
	if ( get_option( 'deka_media_imported' ) === '1' ) {
		return;
	}
	if ( ! function_exists( 'anchor_get_data' ) ) {
		return;
	}
	// Bail if WP file APIs aren't loaded (shouldn't happen on standard requests).
	if ( ! defined( 'ABSPATH' ) ) {
		return;
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';

	@set_time_limit( 0 );

	$map = get_option( 'deka_media_map', [] );
	if ( ! is_array( $map ) ) { $map = []; }

	// ── 1. Local theme files (flagship product renders + logos) ────────
	$child_dir = get_stylesheet_directory();
	$locals = [
		[ 'key' => 'product_us20d',      'file' => $child_dir . '/assets/images/product-us20d.png',      'title' => 'DEKA US-20D CO₂ Laser' ],
		[ 'key' => 'product_smartxide',  'file' => $child_dir . '/assets/images/product-smartxide.jpg',  'title' => 'DEKA SmartXide Ultraspeed 2' ],
		[ 'key' => 'product_smartperio', 'file' => $child_dir . '/assets/images/product-smartperio.png', 'title' => 'DEKA SmartPerio Nd:YAG' ],
		[ 'key' => 'deka_logo',          'file' => $child_dir . '/assets/images/deka-logo.svg',          'title' => 'DEKA Dental Lasers Logo' ],
		[ 'key' => 'deka_logo_white',    'file' => $child_dir . '/assets/images/deka-logo-white.svg',    'title' => 'DEKA Dental Lasers Logo (white)' ],
	];

	$upload_dir = wp_upload_dir();
	$target_sub = $upload_dir['basedir'] . '/deka';
	if ( ! is_dir( $target_sub ) ) {
		wp_mkdir_p( $target_sub );
	}

	foreach ( $locals as $local ) {
		if ( ! empty( $map[ $local['key'] ] ) ) {
			continue; // already imported
		}
		if ( ! file_exists( $local['file'] ) ) {
			continue;
		}
		$basename   = wp_basename( $local['file'] );
		$dest       = $target_sub . '/' . $basename;
		if ( ! file_exists( $dest ) ) {
			@copy( $local['file'], $dest );
		}
		$filetype = wp_check_filetype( $basename );
		$attach_id = wp_insert_attachment( [
			'post_mime_type' => $filetype['type'] ?: 'application/octet-stream',
			'post_title'     => $local['title'],
			'post_content'   => '',
			'post_status'    => 'inherit',
		], $dest );
		if ( ! is_wp_error( $attach_id ) && $attach_id > 0 ) {
			$metadata = wp_generate_attachment_metadata( $attach_id, $dest );
			wp_update_attachment_metadata( $attach_id, $metadata );
			$map[ $local['key'] ] = $attach_id;
		}
	}

	// ── 2. Remote accessory photos from data.php → sideload ─────────
	$products = anchor_get_data( 'products' );
	if ( is_array( $products ) ) {
		foreach ( $products as $p ) {
			if ( ! empty( $p['featured'] ) ) {
				// Systems use theme-local files (handled above); set their
				// featured image on the CPT post.
				$post = get_page_by_path( $p['slug'], OBJECT, 'laser_product' );
				if ( $post && ! empty( $map[ $p['image'] ] ) ) {
					set_post_thumbnail( $post->ID, (int) $map[ $p['image'] ] );
				}
				continue;
			}
			$remote_url = isset( $p['image'] ) ? $p['image'] : '';
			if ( ! $remote_url || strpos( $remote_url, 'http' ) !== 0 ) {
				continue;
			}
			// Find the CPT post for this product.
			$post = get_page_by_path( $p['slug'], OBJECT, 'laser_product' );
			if ( ! $post ) {
				continue;
			}
			// Skip if already has thumbnail.
			if ( get_post_thumbnail_id( $post->ID ) ) {
				continue;
			}
			// Download + sideload the remote image and attach to the post.
			$desc = isset( $p['name'] ) ? $p['name'] : $p['slug'];
			$attach_id = media_sideload_image( $remote_url, $post->ID, $desc, 'id' );
			if ( ! is_wp_error( $attach_id ) && (int) $attach_id > 0 ) {
				set_post_thumbnail( $post->ID, (int) $attach_id );
				// Also update title/alt so the Media Library is tidy.
				wp_update_post( [
					'ID'         => $attach_id,
					'post_title' => $desc,
				] );
				if ( ! empty( $p['image_alt'] ) ) {
					update_post_meta( $attach_id, '_wp_attachment_image_alt', $p['image_alt'] );
				}
			}
		}
	}

	update_option( 'deka_media_map',      $map );
	update_option( 'deka_media_imported', '1' );
}

/* Run on any request by a logged-in administrator. Guarded so anonymous /
 * front-end traffic never triggers the download. Runs once per site. */
add_action( 'wp', function() {
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {
		deka_seed_media();
	}
} );
/* Also fire on admin dashboard loads, for admins who never hit the front-end. */
add_action( 'admin_init', 'deka_seed_media' );

/**
 * Return the best URL for a product's image — prefers the imported featured
 * image (if the CPT post has one set), falls back to the data.php static URL.
 */
if ( ! function_exists( 'deka_product_image_url' ) ) :
	function deka_product_image_url( $product, $size = 'medium' ) {
		$slug = isset( $product['slug'] ) ? $product['slug'] : '';
		if ( $slug ) {
			$post = get_page_by_path( $slug, OBJECT, 'laser_product' );
			if ( $post ) {
				$thumb = get_the_post_thumbnail_url( $post->ID, $size );
				if ( $thumb ) {
					return $thumb;
				}
			}
		}
		$fallback = isset( $product['image'] ) ? $product['image'] : '';
		if ( $fallback && function_exists( 'anchor_resolve_media' ) ) {
			return anchor_resolve_media( $fallback );
		}
		return $fallback;
	}
endif;

// Ensure classic Appearance > Menus is visible in WP 6.x admin.
add_action( 'after_setup_theme', function() {
    remove_theme_support( 'block-nav-menus' );
} );

/**
 * Register [anchor_form] shortcode for embedding CTM forms.
 * Usage: [anchor_form token="qjxA84XRzo8PkLxVFvGiLr1isObeQf9ZXrCmYlGWK88"]
 */
if ( ! function_exists( 'anchor_starter_child_form_shortcode' ) ) :
	function anchor_starter_child_form_shortcode( $atts ) {
		$atts = shortcode_atts( [
			'token'    => '',
			'api_base' => 'https://dashboard.anchorcorps.com/api',
		], $atts, 'anchor_form' );

		if ( empty( $atts['token'] ) ) {
			return '';
		}

		wp_enqueue_script(
			'anchor-ctm-forms',
			'https://dashboard.anchorcorps.com/ctm-forms/ctm-forms.js',
			[],
			null,
			true
		);

		return sprintf(
			'<div data-ctm-form-token="%s" data-api-base="%s"></div>',
			esc_attr( $atts['token'] ),
			esc_attr( $atts['api_base'] )
		);
	}
endif;
add_shortcode( 'anchor_form', 'anchor_starter_child_form_shortcode' );
