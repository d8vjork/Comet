<?php
/**
 * 404 template.
 *
 * @package Comet
 */

get_header();
?>

<article class="entry">
	<header class="entry-header">
		<h1 class="entry-title post-title"><?php esc_html_e( 'Page not found', 'comet' ); ?></h1>
	</header>

	<div class="entry-content post-text">
		<p><?php esc_html_e( 'The page you were looking for could not be found. If you followed a link on this site to get here, please contact the administrator so it can be corrected.', 'comet' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</article>

<?php get_footer(); ?>
