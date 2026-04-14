<?php
/**
 * Right sidebar template.
 *
 * @package Comet
 */
?>

<div class="widgets">
	<?php if ( ! dynamic_sidebar( 'right-sidebar' ) ) : ?>
		<section class="widget widget_search">
			<?php get_search_form(); ?>
		</section>

		<section class="widget widget_categories">
			<h2 class="widget-title"><?php esc_html_e( 'Categories', 'comet' ); ?></h2>
			<ul>
				<?php
				wp_list_categories(
					array(
						'title_li' => '',
					)
				);
				?>
			</ul>
		</section>

		<section class="widget widget_archive">
			<h2 class="widget-title"><?php esc_html_e( 'Archives', 'comet' ); ?></h2>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</section>

		<section class="widget widget_meta">
			<h2 class="widget-title"><?php esc_html_e( 'Meta', 'comet' ); ?></h2>
			<ul>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</section>
	<?php endif; ?>
</div>
