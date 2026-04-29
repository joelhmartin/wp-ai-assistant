<?php
/**
 * Child front-page template.
 *
 * The parent's front-page.php hardcodes the slug 'home'. We honor whichever
 * static page the site is configured to show on the front, by reading its
 * post_name and asking the framework to load page-content/{slug}.php.
 *
 * @package Anchor_Starter_Child
 */

get_header();

$obj  = get_queried_object();
$slug = ( $obj && isset( $obj->post_name ) ) ? $obj->post_name : '';

// Fall back to home-v1 if the queried object has no slug — keeps / working
// during initial setup before the WP front-page setting is changed.
if ( '' === $slug ) {
	$slug = 'home-v1';
}

if ( function_exists( 'anchor_load_page_content' ) && anchor_load_page_content( $slug ) ) {
	// Direct-PHP page rendered by the loader.
} elseif ( function_exists( 'anchor_get_page_config' ) ) {
	$config = anchor_get_page_config( $slug );
	if ( $config && ! empty( $config['sections'] ) && function_exists( 'anchor_render_sections' ) ) {
		anchor_render_sections( $config['sections'] );
	} else {
		echo '<main class="anchor-main anchor-section-pad"><div class="anchor-container">';
		while ( have_posts() ) {
			the_post();
			the_content();
		}
		echo '</div></main>';
	}
}

get_footer();
