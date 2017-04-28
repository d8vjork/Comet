<?php get_header(); ?>

<?php if (have_posts()) : ?>
  
	<?php while (have_posts()) : the_post(); ?>

	<!-- post -->
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php if (is_single()) { ?>
	<div class="post post-nav">
		<?php previous_post_link('<div class="alignleft"><i>'.__('Previous Post','comet').'</i><br />%link</div>'); ?>
		<?php next_post_link('<div class="alignright"><i>'.__('Next Post','comet').'</i><br />%link</div>'); ?>
	</div>
	<?php } ?>
	<?php if( is_single() ) { ?>
		<h1 class="post-title"><?php the_title(); ?></h1>
	<?php } else { ?>
		<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	<?php } ?>
		<div class="post-text">
		<?php
		// when browsing category, search, etc
		if ( is_archive() || is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() ) { 
			// post thumbnail if it exist
			if ( has_post_thumbnail() ) {
			  the_post_thumbnail('thumbnail');
			}
			the_excerpt();
			wp_link_pages('before=<div class="post-pages">'.__('Pages','comet').':&after=</div>&next_or_number=number&pagelink=<span>%</span>');
		// everything else, including single posts
		} else { 
			the_content(__('Read the full post','comet').' &raquo;');
			wp_link_pages('before=<div class="post-pages">'.__('Pages','comet').':&after=</div>&next_or_number=number&pagelink=<span>%</span>');
		} ?>
		</div>
		<div class="post-meta">
			<div class="row">
				<?php if ( comments_open() ) { ?>
					<div class="alignright"><?php comments_popup_link(__('No Comments','comet'),__('1 Comment','comet'),__('% Comments','comet')); ?></div>
				<?php } ?>
				<span class="post-author">Por <?php the_author_posts_link() ?>, el </span><?php the_time('j F Y') ?>
				&nbsp;&bull;&nbsp;
				<?php _e('Posted in','comet'); ?> <?php the_category(', ') ?>
				<?php edit_post_link(__('Edit Post','comet'), ' &nbsp;&bull;&nbsp; ', ''); ?>
				
				
			</div>
		</div>
		<div class="print-view"
			<p>Por <?php the_author() ?>, el <?php the_time('j F Y') ?></p>
			<p><?php the_permalink(); ?></p>
		</div>
	</div>
	<!--/post -->
	
	<!-- <div class="sep-alt"></div> -->
	
	<?php comments_template(); ?>
		
	<?php endwhile; ?>

	<div class="navigation">
		<div class="alignleft"><?php next_posts_link('&laquo; '.__('Older Posts','comet')) ?></div>
		<div class="alignright"><?php previous_posts_link(__('Newer Posts','comet').' &raquo;') ?></div>
	</div>

	<?php else : ?>

	<div class="post">
		<h1 class="post-title"><?php _e('Post not found','comet'); ?></h1>
		<div class="post-text">
			<p><?php _e('The post you were looking for could not be found.','comet'); ?></p>
		</div>
	</div>
		
<?php endif; ?>

<?php get_footer(); ?>