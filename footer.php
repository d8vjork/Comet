<?php
/**
 * The footer for the theme.
 *
 * @package Comet
 */
?>
			</main>

			<aside id="c3" class="sidebar sidebar-right" aria-label="<?php esc_attr_e( 'Right sidebar', 'comet' ); ?>">
				<?php if ( comet_has_right_sidebar() ) : ?>
					<?php get_sidebar( 'right' ); ?>
				<?php endif; ?>
			</aside>
		</div>

		<footer id="footer" class="site-footer">
			<div class="site-footer__text" data-default-text="<?php echo esc_attr( comet_get_default_footer_text() ); ?>"><?php comet_render_footer_text(); ?></div>
		</footer>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
