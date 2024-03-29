<ul class="widgets">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Right') ) { ?>
	
	<li class="widget widget_search">
		<?php get_search_form(); ?>
	</li>

	<li class="widget widget_categories">
		<h2><?php _e('Categories','comet'); ?></h2>
		<ul>
			<?php wp_list_categories('sort_column=name&title_li='); ?>
		</ul>
	</li>
		
	<li class="widget widget_archive">
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</li>
	
	<li class="widget widget_meta">
		<h2>Meta</h2>
		<ul>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>
	</li>

<?php } ?>

</ul><!-- /widgets -->