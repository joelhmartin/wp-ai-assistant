<?php
/**
 * Single template for a laser_product — /shop/{slug}/.
 * Reads the product's full config from config/data.php (via deka_get_product)
 * using the current WP post_name, then renders the editorial product page.
 *
 * @package Anchor_Framework
 */

get_header();

if ( have_posts() ) { the_post(); }

$slug    = get_post_field( 'post_name' );
$product = function_exists( 'deka_get_product' ) ? deka_get_product( $slug ) : null;

// Fallback to the post's own data if no matching config entry.
if ( ! $product ) {
	$product = [
		'slug'        => $slug,
		'name'        => get_the_title(),
		'subtitle'    => '',
		'category'    => '',
		'price'       => '',
		'image'       => '',
		'tagline'     => get_the_excerpt(),
		'description' => get_the_content(),
		'specs'       => [],
		'featured'    => false,
	];
}

// Resolve image URL — prefer imported Media Library attachment if present.
if ( function_exists( 'deka_product_image_url' ) ) {
	$img = deka_product_image_url( $product, 'large' );
} else {
	$img = isset( $product['image'] ) ? $product['image'] : '';
	if ( $img && function_exists( 'anchor_resolve_media' ) ) {
		$img = anchor_resolve_media( $img );
	}
}

$is_system   = ! empty( $product['featured'] );
$price_label = $is_system ? 'Inquiry' : 'Price';

// Related products: other items in the same category (excluding self), capped at 3.
$related = [];
if ( function_exists( 'anchor_get_data' ) ) {
	$all = anchor_get_data( 'products' );
	foreach ( (array) $all as $p ) {
		if ( empty( $p['slug'] ) || $p['slug'] === $slug ) continue;
		if ( ! empty( $product['category_slug'] ) && isset( $p['category_slug'] ) && $p['category_slug'] === $product['category_slug'] ) {
			$related[] = $p;
			if ( count( $related ) >= 3 ) break;
		}
	}
}
?>

<!-- ── PRODUCT HERO ──────────────────────────────────────── -->
<section class="product <?php echo $is_system ? 'product--system' : 'product--accessory'; ?>">
	<div class="container">
		<div class="product__breadcrumbs">
			<a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">Shop</a>
			<span aria-hidden="true">·</span>
			<span><?php echo esc_html( isset( $product['category'] ) ? $product['category'] : '' ); ?></span>
		</div>

		<div class="product__wrap">
			<div class="product__visual <?php echo $is_system ? 'product__visual--dark' : ''; ?>">
				<?php if ( $is_system ) : ?>
					<div class="sc-label">DEKA · <?php echo esc_html( strtoupper( $product['name'] ) ); ?></div>
					<div class="sc-frame">
						<div class="ring"></div>
						<div class="ring ring2"></div>
						<div class="ring ring3"></div>
						<div class="dot"></div>
					</div>
				<?php endif; ?>
				<?php if ( $img ) : ?>
					<div class="product__photo"><img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( isset( $product['image_alt'] ) ? $product['image_alt'] : $product['name'] ); ?>" loading="eager"></div>
				<?php endif; ?>
			</div>

			<div class="product__content">
				<?php if ( ! empty( $product['subtitle'] ) ) : ?>
					<div class="product__kicker">— <?php echo esc_html( $product['subtitle'] ); ?></div>
				<?php endif; ?>

				<h1 class="display product__title"><?php echo esc_html( $product['name'] ); ?></h1>

				<?php if ( ! empty( $product['tagline'] ) ) : ?>
					<p class="product__tagline"><?php echo esc_html( $product['tagline'] ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $product['description'] ) ) : ?>
					<p class="product__body"><?php echo esc_html( $product['description'] ); ?></p>
				<?php endif; ?>

				<div class="product__price-block">
					<div class="product__price-label"><?php echo esc_html( $price_label ); ?></div>
					<div class="product__price"><?php echo esc_html( isset( $product['price'] ) ? $product['price'] : '' ); ?></div>
					<?php if ( ! empty( $product['price_note'] ) ) : ?>
						<div class="product__price-note"><?php echo esc_html( $product['price_note'] ); ?></div>
					<?php endif; ?>
				</div>

				<div class="product__ctas">
					<?php if ( $is_system ) : ?>
						<a class="btn-dark" href="/contact/">
							Schedule a Private Demo
							<svg width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"/></svg>
						</a>
						<a class="btn-light-ghost" href="/contact/">Request Clinical Dossier</a>
					<?php else : ?>
						<a class="btn-dark" href="/contact/">
							Add to Order
							<svg width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"/></svg>
						</a>
						<a class="btn-light-ghost" href="tel:+18662234543">Call (866) 223-4543</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ── SPECS + INCLUDES ─────────────────────────────────── -->
<?php if ( ! empty( $product['specs'] ) || ! empty( $product['includes'] ) ) : ?>
<section class="product-details">
	<div class="container">
		<div class="section-head">
			<div class="section-index">— 01</div>
			<div class="section-title">Specification</div>
			<div class="section-label">Measured, not marketed</div>
		</div>

		<div class="product-details__grid">
			<?php if ( ! empty( $product['specs'] ) ) : ?>
				<div class="product-specs">
					<?php foreach ( $product['specs'] as $s ) : ?>
						<div class="product-spec">
							<div class="k"><?php echo esc_html( isset( $s['k'] ) ? $s['k'] : '' ); ?></div>
							<div class="v"><?php
								echo esc_html( isset( $s['v'] ) ? $s['v'] : '' );
								if ( ! empty( $s['sup'] ) ) echo '<sup>' . esc_html( $s['sup'] ) . '</sup>';
							?></div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $product['includes'] ) ) : ?>
				<div class="product-includes">
					<div class="product-includes__title">In the box</div>
					<ul>
						<?php foreach ( $product['includes'] as $item ) : ?>
							<li><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ── COMPATIBILITY (accessories only) ─────────────────── -->
<?php if ( ! $is_system && ! empty( $product['compatibility'] ) ) : ?>
	<?php
	$compat_names = [];
	foreach ( (array) $product['compatibility'] as $compat_slug ) {
		$c = function_exists( 'deka_get_product' ) ? deka_get_product( $compat_slug ) : null;
		if ( $c ) $compat_names[] = $c;
	}
	?>
	<?php if ( ! empty( $compat_names ) ) : ?>
	<section class="product-compat">
		<div class="container">
			<div class="section-head">
				<div class="section-index">— 02</div>
				<div class="section-title">Compatibility</div>
				<div class="section-label">Built for these instruments</div>
			</div>
			<div class="product-compat__row">
				<?php foreach ( $compat_names as $c ) :
					$ci = function_exists( 'deka_product_image_url' )
						? deka_product_image_url( $c, 'medium' )
						: ( function_exists( 'anchor_resolve_media' ) ? anchor_resolve_media( $c['image'] ) : '' );
					?>
					<a class="product-compat__card" href="<?php echo esc_url( home_url( '/shop/' . $c['slug'] . '/' ) ); ?>">
						<?php if ( $ci ) : ?><div class="product-compat__img"><img src="<?php echo esc_url( $ci ); ?>" alt="<?php echo esc_attr( $c['name'] ); ?>" loading="lazy"></div><?php endif; ?>
						<div class="product-compat__name"><?php echo esc_html( $c['name'] ); ?></div>
						<div class="product-compat__sub"><?php echo esc_html( isset( $c['subtitle'] ) ? $c['subtitle'] : '' ); ?></div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>
<?php endif; ?>

<!-- ── RELATED ──────────────────────────────────────────── -->
<?php if ( ! empty( $related ) ) : ?>
<section class="product-related">
	<div class="container">
		<div class="section-head">
			<div class="section-index">— <?php echo $is_system ? '02' : '03'; ?></div>
			<div class="section-title">Also in this range</div>
			<div class="section-label"><?php echo esc_html( $product['category'] ); ?></div>
		</div>
		<div class="shop-grid">
			<?php foreach ( $related as $p ) :
				$ri = function_exists( 'deka_product_image_url' )
					? deka_product_image_url( $p, 'medium' )
					: ( isset( $p['image'] ) ? $p['image'] : '' );
				?>
				<a class="shop-card" href="<?php echo esc_url( home_url( '/shop/' . $p['slug'] . '/' ) ); ?>">
					<div class="shop-card__visual">
						<?php if ( $ri ) : ?><img src="<?php echo esc_url( $ri ); ?>" alt="<?php echo esc_attr( $p['image_alt'] ); ?>" loading="lazy"><?php endif; ?>
					</div>
					<div class="shop-card__body">
						<div class="shop-card__kicker"><?php echo esc_html( $p['subtitle'] ); ?></div>
						<h3 class="shop-card__title"><?php echo esc_html( $p['name'] ); ?></h3>
						<div class="shop-card__meta">
							<span class="shop-card__price"><?php echo esc_html( $p['price'] ); ?></span>
							<span class="arrow">→</span>
						</div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ── FINAL CTA ───────────────────────────────────────── -->
<?php
if ( function_exists( 'anchor_render_sections' ) ) {
	anchor_render_sections( [
		[
			'type'  => 'deka_final',
			'props' => [
				'eyebrow'       => '— Ordering',
				'heading'       => $is_system
					? "Ready to see the " . $product['name'] . " in your\n**operatory**?"
					: "Questions on fit, bundles, or\n**installation**?",
				'text'          => $is_system
					? "Our clinical specialist will schedule a private, unhurried demonstration — quiet, on your terms, and entirely without a showroom."
					: "Call us directly. Orders placed before 3 pm ET ship same-day; our specialists know which kit fits which system without a catalogue lookup.",
				'primary_cta'   => [ 'label' => $is_system ? 'Schedule a Private Demo' : 'Speak with a Specialist', 'url' => '/contact/' ],
				'secondary_cta' => [ 'label' => 'Call (866) 223-4543', 'url' => 'tel:+18662234543' ],
			],
		],
	] );
}

get_footer();
