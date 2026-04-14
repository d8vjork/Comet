<?php
/**
 * Page template.
 *
 * @package Comet
 */

get_header();
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
			<header class="entry-header">
				<h1 class="entry-title post-title"><?php the_title(); ?></h1>
			</header>

			<div class="entry-content post-text">
				<?php the_content( esc_html__( 'Read the full post', 'comet' ) . ' &raquo;' ); ?>
				<?php
				wp_link_pages(
					array(
						'before' => '<div class="post-pages">' . esc_html__( 'Pages', 'comet' ) . ': ',
						'after'  => '</div>',
					)
				);
				?>
			</div>

			<footer class="post-meta entry-meta">
				<div class="entry-meta__row">
					<?php if ( comments_open() || get_comments_number() ) : ?>
						<span class="comment-link">
							<?php comments_popup_link( esc_html__( 'No Comments', 'comet' ), esc_html__( '1 Comment', 'comet' ), esc_html__( '% Comments', 'comet' ) ); ?>
						</span>
					<?php endif; ?>

					<?php edit_post_link( esc_html__( 'Edit Post', 'comet' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
			</footer>
		</article>

		<?php if ( comments_open() || get_comments_number() ) : ?>
			<?php comments_template(); ?>
		<?php endif; ?>
	<?php endwhile; ?>
<?php else : ?>
	<article class="entry">
		<header class="entry-header">
			<h1 class="entry-title post-title"><?php esc_html_e( 'Page not found', 'comet' ); ?></h1>
		</header>
		<div class="entry-content post-text">
			<p><?php esc_html_e( 'The page you were looking for could not be found.', 'comet' ); ?></p>
		</div>
	</article>
<?php endif; ?>

<?php get_footer(); ?>
