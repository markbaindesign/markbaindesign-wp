<?php
/**
 * Bain Design — template tags
 *
 * Brand-aware render helpers for use inside theme templates. Keep this
 * file in `your-theme/inc/bain-design-system.php`. Require it from
 * functions.php — see functions-snippet.php in this package.
 *
 * Naming convention: every public function is prefixed `bain_` and
 * every CSS class it emits starts with `bain-`, so you can grep for
 * "anything brand-system" with a single search.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }


/* =====================================================================
 *  Inline text helpers
 * ================================================================== */

/**
 * [Bracketed metadata] — e.g. `[WordPress Designer & Developer]`.
 * Use under names, in card meta lines, byline rows.
 *
 * @param string $text  Plain text — square brackets are added by CSS.
 * @param array  $args  Optional. `echo` (bool, default true), `tag` (str, default span).
 */
function bain_meta_bracket( $text, $args = array() ) {
	$args = wp_parse_args( $args, array( 'echo' => true, 'tag' => 'span' ) );
	$tag  = preg_match( '/^[a-z]+$/i', $args['tag'] ) ? $args['tag'] : 'span';
	$html = sprintf(
		'<%1$s class="meta-bracket">%2$s</%1$s>',
		$tag,
		esc_html( $text )
	);
	if ( $args['echo'] ) { echo $html; }
	return $html;
}


/**
 * Terminal cursor — appends a blinking `_` to the previous text node.
 * Use on H1s, sign-offs, hero text. Don't sprinkle indiscriminately.
 */
function bain_cursor() {
	echo '<span class="cursor" aria-hidden="true"></span>';
}


/**
 * "Build with ♥" — the brand sign-off. Drop into footer.php.
 */
function bain_sign_off( $prefix = 'Build with' ) {
	printf(
		'<p class="bain-signoff">%s <span class="heart" aria-label="love">&hearts;</span></p>',
		esc_html( $prefix )
	);
}


/* =====================================================================
 *  Lists
 * ================================================================== */

/**
 * ✔ Checked list — green phosphor checks, monospace.
 *
 * @param string[] $items  Each item may contain inline HTML (links, em,
 *                         code) — sanitised via wp_kses_post.
 * @param string   $class  Extra class names.
 */
function bain_check_list( array $items, $class = '' ) {
	if ( empty( $items ) ) { return; }
	printf( '<ul class="bain-check %s">', esc_attr( $class ) );
	foreach ( $items as $item ) {
		echo '<li>' . wp_kses_post( $item ) . '</li>';
	}
	echo '</ul>';
}


/* =====================================================================
 *  Buttons & CTAs
 * ================================================================== */

/**
 * Bain button — primary (ink on paper) or ghost.
 *
 * @param string $label     Button text — keep it a plain verb phrase.
 * @param string $url       href.
 * @param array  $args      Optional. `variant` (primary|ghost),
 *                          `external` (bool — adds rel + ↗),
 *                          `attrs` (assoc of extra HTML attributes).
 */
function bain_button( $label, $url, $args = array() ) {
	$args = wp_parse_args( $args, array(
		'variant'  => 'primary',
		'external' => false,
		'attrs'    => array(),
	) );
	$class = 'bain-btn' . ( $args['variant'] === 'ghost' ? ' bain-btn--ghost' : '' );

	$attr_html = '';
	foreach ( $args['attrs'] as $k => $v ) {
		$attr_html .= sprintf( ' %s="%s"', esc_attr( $k ), esc_attr( $v ) );
	}
	if ( $args['external'] ) {
		$attr_html .= ' target="_blank" rel="noopener noreferrer"';
	}

	$arrow = $args['external'] ? ' <span aria-hidden="true">↗</span>' : '';

	printf(
		'<a class="%s" href="%s"%s>%s%s</a>',
		esc_attr( $class ),
		esc_url( $url ),
		$attr_html,
		esc_html( $label ),
		$arrow
	);
}


/* =====================================================================
 *  Cards & headers
 * ================================================================== */

/**
 * Numbered section header. Renders a big margin numeral + heading.
 *
 *     bain_section_header( '01', 'Selected work' );
 *
 * The numeral is a decorative type element — set very large in the
 * left margin via CSS. Override `.bain-section__num` if you want a
 * different feel.
 */
function bain_section_header( $num, $title, $kicker = '' ) {
	?>
	<header class="bain-section">
		<div class="bain-section__num" aria-hidden="true"><?php echo esc_html( $num ); ?></div>
		<div class="bain-section__body">
			<?php if ( $kicker ) : ?>
				<?php bain_meta_bracket( $kicker ); ?>
			<?php endif; ?>
			<h2 class="bain-section__title"><?php echo esc_html( $title ); ?></h2>
		</div>
	</header>
	<style>
		.bain-section {
			display: grid;
			grid-template-columns: minmax(80px, 160px) 1fr;
			gap: var(--space-5);
			align-items: baseline;
			margin: var(--space-9) 0 var(--space-6);
		}
		.bain-section__num {
			font-family: var(--font-mono);
			font-size: clamp(72px, 10vw, var(--type-240));
			line-height: 0.9;
			color: var(--rule-soft);
			font-weight: 700;
			letter-spacing: var(--tracking-tight);
		}
		.bain-section__title { font-size: var(--type-44); }
		@media (max-width: 720px) {
			.bain-section { grid-template-columns: 1fr; gap: var(--space-3); }
			.bain-section__num { font-size: 56px; }
		}
	</style>
	<?php
}


/**
 * Portfolio card — one item in a project list.
 *
 * @param array $project {
 *   @type string $title    Project title.
 *   @type string $client   Client name / bracketed meta line.
 *   @type string $year     Year (4 digits).
 *   @type string $excerpt  One-paragraph blurb.
 *   @type string $url      Project URL.
 *   @type string $image    Optional. Full-bleed thumbnail.
 * }
 */
function bain_portfolio_card( $project ) {
	$project = wp_parse_args( $project, array(
		'title'   => '',
		'client'  => '',
		'year'    => '',
		'excerpt' => '',
		'url'     => '',
		'image'   => '',
	) );
	?>
	<article class="bain-card bain-project">
		<?php if ( $project['image'] ) : ?>
			<a href="<?php echo esc_url( $project['url'] ); ?>" class="bain-project__media">
				<img src="<?php echo esc_url( $project['image'] ); ?>" alt="" loading="lazy">
			</a>
		<?php endif; ?>

		<div class="bain-project__meta">
			<?php if ( $project['client'] ) bain_meta_bracket( $project['client'] ); ?>
			<?php if ( $project['year'] ) : ?>
				<span class="bain-project__year"> / <?php echo esc_html( $project['year'] ); ?></span>
			<?php endif; ?>
		</div>

		<h3 class="bain-project__title">
			<a href="<?php echo esc_url( $project['url'] ); ?>"><?php echo esc_html( $project['title'] ); ?></a>
		</h3>

		<?php if ( $project['excerpt'] ) : ?>
			<p class="bain-project__excerpt"><?php echo esc_html( $project['excerpt'] ); ?></p>
		<?php endif; ?>
	</article>
	<style>
		.bain-project { display: flex; flex-direction: column; gap: var(--space-3); }
		.bain-project__media { display: block; border-bottom: 1px solid var(--rule); margin: calc(var(--space-5) * -1) calc(var(--space-5) * -1) 0; }
		.bain-project__media img { width: 100%; height: auto; display: block; }
		.bain-project__meta { display: flex; gap: var(--space-2); align-items: baseline; }
		.bain-project__year { color: var(--pencil); font-family: var(--font-mono-2); font-size: var(--type-14); }
		.bain-project__title { font-size: var(--type-24); }
		.bain-project__title a { color: var(--ink); text-decoration: none; }
		.bain-project__title a:hover { text-decoration: underline; text-decoration-color: var(--clay); }
		.bain-project__excerpt { color: var(--graphite); margin: 0; }
	</style>
	<?php
}


/* =====================================================================
 *  ASCII patterns
 * ================================================================== */

/**
 * Full-width box-drawing rule — for major section dividers.
 *
 *     bain_ascii_rule();           // ──── across the row
 *     bain_ascii_rule( '┌─┐' );    // custom pattern
 */
function bain_ascii_rule( $glyph = '─' ) {
	printf(
		'<div class="bain-ascii-rule" aria-hidden="true" style="font-family:var(--font-mono);color:var(--pencil);overflow:hidden;white-space:nowrap;line-height:1;margin:var(--space-6) 0;">%s</div>',
		str_repeat( esc_html( $glyph ), 200 )
	);
}


/* =====================================================================
 *  Single project template helpers
 * ================================================================== */

/**
 * ACF field with fallback to post meta, then a default value.
 */
function bain_project_field( $key, $post_id = null, $default = '' ) {
	$post_id = $post_id ?: get_the_ID();
	if ( function_exists( 'get_field' ) ) {
		$v = get_field( $key, $post_id );
		if ( $v !== null && $v !== '' && $v !== false ) {
			return $v;
		}
	}
	$meta = get_post_meta( $post_id, $key, true );
	return $meta !== '' ? $meta : $default;
}

/**
 * Two-digit zero-padded project number derived from menu_order.
 */
function bain_project_number( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	$order   = (int) get_post_field( 'menu_order', $post_id );
	if ( $order > 0 ) {
		return str_pad( $order, 2, '0', STR_PAD_LEFT );
	}
	return str_pad( ( $post_id % 99 ) + 1, 2, '0', STR_PAD_LEFT );
}

/**
 * Wins repeater → flat array of strings.
 */
function bain_project_wins( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	if ( ! function_exists( 'have_rows' ) ) {
		return array_filter( (array) get_post_meta( $post_id, 'wins', true ) );
	}
	$out = array();
	if ( have_rows( 'wins', $post_id ) ) {
		while ( have_rows( 'wins', $post_id ) ) {
			the_row();
			$txt = get_sub_field( 'win' );
			if ( $txt ) { $out[] = $txt; }
		}
	}
	return $out;
}

/**
 * Stack repeater → flat array of strings.
 */
function bain_project_stack( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	if ( ! function_exists( 'have_rows' ) ) {
		return array_filter( array_map( 'trim', explode( ',', (string) get_post_meta( $post_id, 'stack', true ) ) ) );
	}
	$out = array();
	if ( have_rows( 'stack', $post_id ) ) {
		while ( have_rows( 'stack', $post_id ) ) {
			the_row();
			$txt = get_sub_field( 'tech' );
			if ( $txt ) { $out[] = $txt; }
		}
	}
	return $out;
}

/**
 * Related projects — manual picks from ACF, falling back to shared
 * project-category-service terms.
 *
 * @return WP_Post[]
 */
function bain_project_related( $post_id = null, $limit = 2 ) {
	if ( function_exists( 'bd324_get_project_related' ) ) {
		return bd324_get_project_related( $post_id ?: get_the_ID(), $limit );
	}
	return array();
}

/**
 * Adjacent project — previous or next by date within bd324_projects.
 *
 * @param string $direction 'prev' or 'next'
 * @return WP_Post|null
 */
function bain_project_adjacent( $direction = 'prev' ) {
	$args = array(
		'post_type'      => 'bd324_projects',
		'posts_per_page' => 1,
		'orderby'        => 'date',
		'order'          => $direction === 'prev' ? 'DESC' : 'ASC',
		'date_query'     => array( array(
			$direction === 'prev' ? 'before' : 'after' => get_the_date( 'Y-m-d H:i:s' ),
		) ),
	);
	$q = get_posts( $args );
	return $q ? $q[0] : null;
}


/* =====================================================================
 *  Body sign-off auto-render (optional)
 * ================================================================== */

/**
 * If your footer.php is locked away in a parent theme, you can hook the
 * sign-off in instead of editing the file. Uncomment to enable:
 *
 *   add_action( 'wp_footer', 'bain_sign_off_footer', 5 );
 *   function bain_sign_off_footer() { echo '<div class="bain-wrap">'; bain_sign_off(); echo '</div>'; }
 */
