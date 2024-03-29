<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
<?php $fp_options = get_option('fp_options'); ?>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title('-',true,'right'); ?><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
	<link rel="license" href="//creativecommons.org/licenses/by-nc-nd/4.0/">
	
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/print.css" type="text/css" media="print" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/_<?php if ( $fp_options['fp_color'] == '' ) { echo 'grey'; } else { echo  $fp_options['fp_color']; } ?>.css" type="text/css" />
	<!--[if lte IE 7]>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/ie.css" type="text/css" media="all" />
	<![endif]-->

	<style type="text/css">
	<?php
	if ( $fp_options['fp_font'] != '' ) { // font family
		echo "body, input, select, textarea { font-family: ". $fp_options['fp_font'] .", Verdana, Tahoma, Helvetica, sans-serif; }\n";
	}
	if ( $fp_options['fp_font_size'] != '' ) { // font size
		echo "body, input, select, textarea { font-size: ". $fp_options['fp_font_size'] ."; }\n";
	}

	if( $fp_options['fp_layout'] == 'left') { // sidebar to the left
		echo "#c1 { display: block; }\n";
		echo "#c2 { margin: 0 0 0 10px; }\n";
		echo "#c3 { display: none; }\n";
	}
	if( $fp_options['fp_layout'] == 'left and right') { // sidebars left and right
		echo "#c1 { display: block; width: 200px; }\n";
		echo "#c2 { width: 480px; margin: 0 10px 0 10px; }\n";
		echo "#c3 { width: 200px; }\n";
		echo "#searchform #s { width: 160px; }\n";
	}
	if( $fp_options['fp_layout'] == 'hidden') { // no sidebars
		echo "#c2 { width: 900px; margin: 0; }\n";
		echo "#c3 { display: none; }\n";
	}
	
	if( $fp_options['fp_post_author'] != 'checked="checked"' ) { // display post authors
		echo ".post-author { display: none; }\n";
	}
	
	echo $fp_options['fp_css'] ."\n"; // custom css
	?>
	</style>

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div id="wrap">

	<?php
	// using WordPress 3.0 or higher
	if ( function_exists('has_nav_menu') ) {
		// has primary menu
		if ( has_nav_menu('primary-menu') ) {
			wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_id' => 'primary-menu', 'container' => '', 'fallback_cb' => '' ) );
		}
		// no menu assigned, display default
		elseif ( !has_nav_menu('primary-menu') && !has_nav_menu('secondary-menu') ) {
			echo '<ul class="menu">';
			wp_list_pages( 'title_li=' );
			echo '</ul>';
		}
	// using old version of WordPress
	} else {
		echo '<ul class="menu">';
		wp_list_pages( 'title_li=' );
		echo '</ul>';
	}
	?>

	<div id="header">
		<?php
		// has logo
		if( $fp_options['fp_logo'] != '' ) {
		
			echo "<a href='". get_option('siteurl') ."'><img src='". $fp_options['fp_logo'] ."' alt='". get_option('blogname') ."' border='0' class='". $fp_options['fp_logo_pos'] ."' /></a>";

		// no logo; normal heading
		} else {

			echo "<h1><a href='". get_option('siteurl') ."'>". get_option('blogname') ."</a></h1>";

			if( get_bloginfo('description') ) {
				echo "<h4>". get_bloginfo('description') ."</h4>";
			}

		}
		?>
	</div><!-- /header -->
	
	<?php
	// using WordPress 3.0 or higher
	if ( function_exists('has_nav_menu') ) {
		// has secondary menu
		if ( has_nav_menu('secondary-menu') ) {
			wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_id' => 'secondary-menu', 'container' => '', 'fallback_cb' => '' ) );
		}
	}
	?>

	<div id="content">
		
		<div id="c1">
			
			<?php get_sidebar('left'); ?>
			
		</div>

		<div id="c2">

			<?php if ( is_archive() || is_search() ) { ?>
				<div class="page-head">

				<?php if (is_tag()) { ?>

					<?php _e('All posts tagged','comet'); ?> <b><?php single_tag_title(''); ?></b>
					<?php echo tag_description(); ?>
					
				<?php } elseif (is_category()) { ?>

					<?php _e('All posts in category','comet'); ?> <b><?php single_cat_title(''); ?></b>

				<?php } elseif (is_day()) { ?>

					<?php _e('All posts for the day','comet'); ?> <b><?php the_time('F jS, Y'); ?></b>

				<?php } elseif (is_month()) { ?>

					<?php _e('All posts for the month','comet'); ?> <b><?php the_time('F, Y'); ?></b>

				<?php } elseif (is_year()) { ?>

					<?php _e('All posts for the year','comet'); ?> <b><?php the_time('Y'); ?></b>

				<?php } elseif (is_search()) { ?>

					<?php _e('All posts found when searching for','comet'); ?> <b><?php the_search_query(); ?></b>

				<?php } ?>

				</div>
			<?php }?>