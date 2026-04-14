<?php
/**
 * Attachment template.
 *
 * @package Comet
 */

get_header();
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		global $post;

		$next_attachment_url = wp_get_attachment_url( $post->ID );

		if ( wp_attachment_is_image( $post->ID ) && ! empty( $post->post_parent ) ) {
			$image_attachments = get_posts(
				array(
					'post_parent'    => $post->post_parent,
					'post_status'    => 'inherit',
					'post_type'      => 'attachment',
					'post_mime_type' => 'image',
					'orderby'        => 'menu_order ID',
					'order'          => 'ASC',
					'numberposts'    => -1,
				)
			);

			$attachment_ids = wp_list_pluck( $image_attachments, 'ID' );
			$current_index  = array_search( $post->ID, $attachment_ids, true );

			if ( false !== $current_index && count( $attachment_ids ) > 1 ) {
				$next_index          = isset( $attachment_ids[ $current_index + 1 ] ) ? $current_index + 1 : 0;
				$next_attachment_url = get_attachment_link( $attachment_ids[ $next_index ] );
			}
		}
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry attachment-entry' ); ?>>
			<header class="entry-header">
				<h1 class="entry-title post-title"><?php the_title(); ?></h1>
			</header>

			<div class="entry-content post-text">
				<?php if ( ! empty( $post->post_parent ) ) : ?>
					<p class="page-title">
						<?php esc_html_e( 'This is an attachment for the post', 'comet' ); ?>
						<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" rel="gallery"><?php echo esc_html( get_the_title( $post->post_parent ) ); ?></a>
					</p>
				<?php endif; ?>

				<?php if ( wp_attachment_is_image( $post->ID ) ) : ?>
					<figure class="attachment-media">
						<a href="<?php echo esc_url( $next_attachment_url ); ?>" rel="attachment">
							<?php echo wp_get_attachment_image( $post->ID, 'large' ); ?>
						</a>

						<?php if ( has_excerpt() ) : ?>
							<figcaption class="attachment-caption"><?php the_excerpt(); ?></figcaption>
						<?php endif; ?>
					</figure>

					<nav class="navigation image-navigation" aria-label="<?php esc_attr_e( 'Image navigation', 'comet' ); ?>">
						<div class="alignleft"><?php previous_image_link( false, esc_html__( 'Previous Image', 'comet' ) ); ?></div>
						<div class="alignright"><?php next_image_link( false, esc_html__( 'Next Image', 'comet' ) ); ?></div>
					</nav>
				<?php else : ?>
					<p><a href="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" rel="attachment"><?php echo esc_html( wp_basename( get_attached_file( $post->ID ) ) ); ?></a></p>
				<?php endif; ?>
			</div>

			<footer class="post-meta entry-meta">
				<div class="entry-meta__row">
					<?php if ( comments_open() || get_comments_number() ) : ?>
						<span class="comment-link">
							<?php comments_popup_link( esc_html__( 'No Comments', 'comet' ), esc_html__( '1 Comment', 'comet' ), esc_html__( '% Comments', 'comet' ) ); ?>
						</span>
					<?php endif; ?>

					<?php if ( comet_should_show_post_author() ) : ?>
						<span class="post-author">
							<?php esc_html_e( 'By', 'comet' ); ?>
							<?php the_author_posts_link(); ?>
						</span>
					<?php endif; ?>

					<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></time>

					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php esc_html_e( 'Permalink', 'comet' ); ?></a>

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
			<h1 class="entry-title post-title"><?php esc_html_e( 'Post not found', 'comet' ); ?></h1>
		</header>
		<div class="entry-content post-text">
			<p><?php esc_html_e( 'The post you were looking for could not be found.', 'comet' ); ?></p>
		</div>
	</article>
<?php endif; ?>

<?php get_footer(); ?>
