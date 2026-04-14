<?php
/**
 * Main index template.
 *
 * @package Comet
 */

get_header();
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
			<?php if ( is_single() ) : ?>
				<nav class="post-nav" aria-label="<?php esc_attr_e( 'Post navigation', 'comet' ); ?>">
					<?php previous_post_link( '<div class="alignleft"><i>' . esc_html__( 'Previous Post', 'comet' ) . '</i><br>%link</div>' ); ?>
					<?php next_post_link( '<div class="alignright"><i>' . esc_html__( 'Next Post', 'comet' ) . '</i><br>%link</div>' ); ?>
				</nav>
			<?php endif; ?>

			<header class="entry-header">
				<?php if ( is_single() ) : ?>
					<h1 class="entry-title post-title"><?php the_title(); ?></h1>
				<?php else : ?>
					<h2 class="entry-title post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php endif; ?>
			</header>

			<div class="entry-content post-text">
				<?php if ( is_archive() || is_search() ) : ?>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="entry-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
						</a>
					<?php endif; ?>
					<?php the_excerpt(); ?>
				<?php else : ?>
					<?php the_content( esc_html__( 'Read the full post', 'comet' ) . ' &raquo;' ); ?>
				<?php endif; ?>

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

					<span class="entry-byline">
						<?php if ( comet_should_show_post_author() ) : ?>
							<span class="post-author">
								<?php esc_html_e( 'By', 'comet' ); ?>
								<?php the_author_posts_link(); ?>,
							</span>
						<?php endif; ?>

						<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></time>
					</span>

					<span class="entry-taxonomy">
						<?php esc_html_e( 'Posted in', 'comet' ); ?>
						<?php the_category( ', ' ); ?>
					</span>

					<?php edit_post_link( esc_html__( 'Edit Post', 'comet' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
			</footer>

			<div class="print-view">
				<p>
					<?php
					printf(
						/* translators: 1: Author, 2: Date. */
						esc_html__( 'By %1$s on %2$s', 'comet' ),
						esc_html( get_the_author() ),
						esc_html( get_the_date( 'j F Y' ) )
					);
					?>
				</p>
				<p><?php echo esc_url( get_permalink() ); ?></p>
			</div>
		</article>

		<?php if ( is_single() ) : ?>
			<?php comments_template(); ?>
		<?php endif; ?>
	<?php endwhile; ?>

	<?php if ( ! is_single() ) : ?>
		<nav class="navigation posts-navigation" aria-label="<?php esc_attr_e( 'Posts navigation', 'comet' ); ?>">
			<div class="alignleft"><?php next_posts_link( '&laquo; ' . esc_html__( 'Older Posts', 'comet' ) ); ?></div>
			<div class="alignright"><?php previous_posts_link( esc_html__( 'Newer Posts', 'comet' ) . ' &raquo;' ); ?></div>
		</nav>
	<?php endif; ?>
<?php else : ?>
	<article class="entry">
		<header class="entry-header">
			<h1 class="entry-title post-title"><?php esc_html_e( 'Post not found', 'comet' ); ?></h1>
		</header>
		<div class="entry-content post-text">
			<p><?php esc_html_e( 'The post you were looking for could not be found.', 'comet' ); ?></p>
		</div>
	</article>
<?php endif; ?>

<?php get_footer(); ?>
