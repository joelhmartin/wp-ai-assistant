<?php
/**
 * WooCommerce archive override — the /shop/ landing.
 *
 * Catalog mode. Pulls all products from config/data.php and renders the
 * editorial catalogue: hero → systems row → accessories grid → final CTA.
 * is_shop() routing is handled by WooCommerce; this template short-circuits
 * WC's standard archive output and emits our bespoke markup directly.
 *
 * @package Anchor_Starter_Child
 */

get_header();

$products = function_exists( 'anchor_get_data' ) ? anchor_get_data( 'products' ) : [];
$systems     = array_values( array_filter( $products, function( $p ) { return ! empty( $p['featured'] ); } ) );
$accessories = array_values( array_filter( $products, function( $p ) { return empty( $p['featured'] ); } ) );

// Group accessories by category for the filter chips.
$categories = [];
foreach ( $accessories as $p ) {
	$cat_slug = isset( $p['category_slug'] ) ? $p['category_slug'] : 'other';
	$cat_name = isset( $p['category'] )      ? $p['category']      : 'Other';
	$categories[ $cat_slug ] = $cat_name;
}
?>

<!-- ── SHOP HERO ─────────────────────────────────────────────── -->
<header class="shop-hero">
	<div class="container">
		<div class="shop-hero__meta">
			<span class="mono">— The Collection</span>
			<span class="mono">No. 02 / Shop</span>
		</div>
		<h1 class="display shop-hero__title">Every instrument,<br>every consumable,<br><em>one atelier</em>.</h1>
		<p class="shop-hero__sub">
			Three flagship systems, outfitted with the handpieces, attachments, fibers, and consumables
			we manufacture in Florence. Orders placed before 3&nbsp;pm ET ship same-day.
		</p>
	</div>
</header>

<!-- ── SYSTEMS ──────────────────────────────────────────────── -->
<?php if ( ! empty( $systems ) ) : ?>
<section class="shop-systems">
	<div class="container">
		<div class="section-head">
			<div class="section-index">— 01</div>
			<div class="section-title">Systems</div>
			<div class="section-label">Three instruments, one standard</div>
		</div>

		<div class="shop-systems__grid">
			<?php foreach ( $systems as $p ) :
				$img = function_exists( 'deka_product_image_url' )
					? deka_product_image_url( $p, 'large' )
					: ( function_exists( 'anchor_resolve_media' ) ? anchor_resolve_media( $p['image'] ) : '' );
				?>
				<a class="shop-system" href="<?php echo esc_url( home_url( '/shop/' . $p['slug'] . '/' ) ); ?>">
					<div class="shop-system__visual">
						<div class="shape"><div class="ring"></div><div class="ring-in"></div></div>
						<?php if ( $img ) : ?>
							<div class="pv-photo"><img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $p['image_alt'] ); ?>" loading="lazy"></div>
						<?php endif; ?>
						<div class="tag"><?php echo esc_html( $p['name'] ); ?></div>
						<div class="caption">
							<span><?php echo esc_html( $p['subtitle'] ); ?></span>
							<span>Flagship</span>
						</div>
					</div>
					<h3>
						<span class="sm"><?php echo esc_html( $p['subtitle'] ); ?></span>
						<?php echo esc_html( $p['name'] ); ?>
					</h3>
					<p><?php echo esc_html( $p['tagline'] ); ?></p>
					<div class="shop-system__meta">
						<span><?php echo esc_html( $p['price'] ); ?></span>
						<span class="arrow">→</span>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ── ACCESSORIES ─────────────────────────────────────────── -->
<?php if ( ! empty( $accessories ) ) : ?>
<section class="shop-catalog">
	<div class="container">
		<div class="section-head">
			<div class="section-index">— 02</div>
			<div class="section-title">Accessories &amp; Consumables</div>
			<div class="section-label"><?php echo esc_html( count( $accessories ) ); ?> items · ships from Tampa</div>
		</div>

		<?php if ( ! empty( $categories ) ) : ?>
			<div class="shop-filters" role="tablist" aria-label="Filter accessories by category">
				<button type="button" class="shop-filter active" data-filter="all">All</button>
				<?php foreach ( $categories as $slug => $name ) : ?>
					<button type="button" class="shop-filter" data-filter="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $name ); ?></button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="shop-grid">
			<?php foreach ( $accessories as $p ) :
				$img = function_exists( 'deka_product_image_url' )
					? deka_product_image_url( $p, 'medium' )
					: ( isset( $p['image'] ) ? $p['image'] : '' );
				?>
				<a class="shop-card" href="<?php echo esc_url( home_url( '/shop/' . $p['slug'] . '/' ) ); ?>" data-category="<?php echo esc_attr( isset( $p['category_slug'] ) ? $p['category_slug'] : 'other' ); ?>">
					<div class="shop-card__visual">
						<?php if ( $img ) : ?>
							<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $p['image_alt'] ); ?>" loading="lazy">
						<?php endif; ?>
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

<!-- ── FINAL CTA ──────────────────────────────────────────── -->
<?php
if ( function_exists( 'anchor_render_sections' ) ) {
	anchor_render_sections( [
		[
			'type'    => 'cta_band',
			'variant' => 'dark',
			'props'   => [
				'eyebrow'       => '— Ordering',
				'heading'       => "Not sure which instrument you need? We'll talk it through.",
				'text'          => "Every DEKA practice gets a dedicated clinical specialist. They know your system, your room, and your schedule — call us and they'll help you order against a case you're actually running.",
				'primary_cta'   => [ 'label' => 'Speak with a Specialist', 'url' => '/contact/' ],
				'secondary_cta' => [ 'label' => 'Call (866) 223-4543',    'url' => 'tel:+18662234543' ],
			],
		],
	] );
}

?>

<script>
(function () {
    var root = document.querySelector('.shop-catalog');
    if (!root) return;
    var filters = root.querySelectorAll('.shop-filter');
    var cards   = root.querySelectorAll('.shop-card');
    filters.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var want = btn.dataset.filter;
            filters.forEach(function (b) { b.classList.toggle('active', b === btn); });
            cards.forEach(function (card) {
                var match = (want === 'all') || (card.dataset.category === want);
                if (match) { card.removeAttribute('hidden'); }
                else       { card.setAttribute('hidden', ''); }
            });
        });
    });
})();
</script>

<?php
get_footer();
