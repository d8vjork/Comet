<?php
/**
 * Comments template.
 *
 * @package Comet
 */

if ( post_password_required() ) {
	return;
}

$commenter = wp_get_current_commenter();
$required  = (bool) get_option( 'require_name_email' );
?>

<section id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<header class="comments-header">
			<h2 class="comment-heading post-title">
				<?php comments_number( esc_html__( 'No Comments', 'comet' ), esc_html__( '1 Comment', 'comet' ), esc_html__( '% Comments', 'comet' ) ); ?>
			</h2>
			<a href="#respond" class="leave-one"><?php esc_html_e( 'Leave a comment', 'comet' ); ?></a>
		</header>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation comment-navigation" aria-label="<?php esc_attr_e( 'Comment navigation', 'comet' ); ?>">
				<?php paginate_comments_links(); ?>
			</nav>
		<?php endif; ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation comment-navigation" aria-label="<?php esc_attr_e( 'Comment navigation', 'comet' ); ?>">
				<?php paginate_comments_links(); ?>
			</nav>
		<?php endif; ?>
	<?php elseif ( ! comments_open() && ! is_page() ) : ?>
		<p class="comments-closed"><?php esc_html_e( 'Comments are closed.', 'comet' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply_before'  => '<h3 id="reply-title" class="comment-heading post-title">',
			'title_reply_after'   => '</h3>',
			'class_form'          => 'comment-form',
			'class_submit'        => 'submit',
			'label_submit'        => esc_html__( 'Post Comment', 'comet' ),
			'comment_notes_before'=> '<p class="comment-notes">' . esc_html__( 'Your email address will not be published.', 'comet' ) . '</p>',
			'fields'              => array(
				'author' => sprintf(
					'<p class="comment-form-author"><label for="author">%1$s%2$s</label><input id="author" name="author" type="text" value="%3$s" size="30" %4$s></p>',
					esc_html__( 'Name', 'comet' ),
					$required ? ' <span class="required">*</span>' : '',
					esc_attr( $commenter['comment_author'] ),
					$required ? 'required' : ''
				),
				'email'  => sprintf(
					'<p class="comment-form-email"><label for="email">%1$s%2$s</label><input id="email" name="email" type="email" value="%3$s" size="30" %4$s></p>',
					esc_html__( 'Email', 'comet' ),
					$required ? ' <span class="required">*</span>' : '',
					esc_attr( $commenter['comment_author_email'] ),
					$required ? 'required' : ''
				),
				'url'    => sprintf(
					'<p class="comment-form-url"><label for="url">%1$s</label><input id="url" name="url" type="url" value="%2$s" size="30"></p>',
					esc_html__( 'Website', 'comet' ),
					esc_attr( $commenter['comment_author_url'] )
				),
			),
			'comment_field'       => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'comet' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>',
		)
	);
	?>
</section>
