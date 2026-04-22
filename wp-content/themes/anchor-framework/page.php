<?php
/**
 * Page Template
 * Loads page config by slug and renders config-driven sections.
 * Falls back to standard content if no config exists.
 *
 * @package Anchor_Framework
 */

get_header();

$slug   = anchor_determine_page_slug();
$config = $slug ? anchor_get_page_config( $slug ) : null;

if ( $config && ! empty( $config['sections'] ) ) {
	anchor_render_sections( $config['sections'] );
} else {
	// Standard page content fallback
	?>
	<main class="anchor-main">
		<!-- Simple page hero -->
		<div class="anchor-hero anchor-hero--short anchor-hero--solid">
			<div class="anchor-hero__content anchor-hero__content--short anchor-section-pad">
				<h1 class="anchor-hero__heading anchor-hero__heading--page">
					<?php the_title(); ?>
				</h1>
			</div>
		</div>

		<div class="anchor-section anchor-section-pad">
			<div class="anchor-container anchor-page__container">
				<div class="anchor-article">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</main>
	<?php
}

get_footer();
