<?php
/**
 * Left sidebar template.
 *
 * @package Comet
 */
?>

<div class="widgets">
	<?php if ( ! dynamic_sidebar( 'left-sidebar' ) ) : ?>
		<section class="widget widget_recent_entries">
			<h2 class="widget-title"><?php esc_html_e( 'Recent Posts', 'comet' ); ?></h2>
			<ul>
				<?php
				wp_get_archives(
					array(
						'type'  => 'postbypost',
						'limit' => 5,
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
	<?php endif; ?>
</div>
