<?php
/**
 * Search form template.
 *
 * @package Comet
 */
?>
<form role="search" method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="s"><?php esc_html_e( 'Search for:', 'comet' ); ?></label>
	<input type="search" id="s" class="search-field" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" placeholder="<?php esc_attr_e( 'Search...', 'comet' ); ?>">
	<button type="submit" id="searchsubmit" class="search-submit"><?php esc_html_e( 'Search', 'comet' ); ?></button>
</form>
