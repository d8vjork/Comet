<?php
/**
 * Comet functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Comet
 * @since Comet 1.0
 */

/**
 * Comet only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'comet_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own comet_setup() function to override in a child theme.
 *
 * @since Comet 1.0
 */
function comet_setup()
{
	// Translations
	load_theme_textdomain('comet', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary-menu'		=> 'Above Title',
		'secondary-menu'	=> 'Below Title',
	) );

	// This theme uses register_sidebar() in two locations.
	register_sidebars( 2, array(
		[
			'id' 	=> 'left-sidebar',
			'name'	=> 'Sidebar Left'
		], 
		[
			'id'	=> 'right-sidebar',
			'name'	=> 'Sidebar Right'
		],
	) );
}
endif;
add_action( 'after_setup_theme', 'comet_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Comet 1.0
 */
function comet_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'comet_content_width', 600 );
}
add_action( 'after_setup_theme', 'comet_content_width', 0 );

/**
 * All of those functions below are pending to deletion
 */
function themeoptions_admin_menu()  
{  
    add_theme_page("Theme Options", "Theme Options", 'edit_themes', basename(__FILE__), 'themeoptions_page'); 
} 
 
function themeoptions_page()  
{  
	if ( isset($_POST['update_themeoptions']) == 'true' ) { themeoptions_update(); } 
	
	$fp_options = get_option('fp_options');
	?>
	<div class="wrap"> 
		<div id="icon-themes" class="icon32"><br /></div> 
		<h2>Theme Options</h2> 

		<form method="POST" action=""> 
			<input type="hidden" name="update_themeoptions" value="true" /> 

			<h3>Color scheme</h3>
			<?php $color = $fp_options['fp_color']; ?>
			
				<input type="radio" name="color" value="grey" id="grey" <?php if ($color=='grey') { echo 'checked="checked"'; } ?> />
				<label for="grey">
					<img src="<?php bloginfo('template_directory'); ?>/images/comet_color-grey.png" alt="grey" title="grey" width="100" height="150" />
				</label>
				
				<input type="radio" name="color" value="red" id="red" <?php if ($color=='red') { echo 'checked="checked"'; } ?> />
				<label for="red">	
					<img src="<?php bloginfo('template_directory'); ?>/images/comet_color-red.png" alt="red" title="red" width="100" height="150" />
				</label>
				
				<input type="radio" name="color" value="yellow" id="yellow" <?php if ($color=='yellow') { echo 'checked="checked"'; } ?> />
				<label for="yellow">	
					<img src="<?php bloginfo('template_directory'); ?>/images/comet_color-yellow.png" alt="yellow" title="yellow" width="100" height="150" />
				</label>
				
				<input type="radio" name="color" value="green" id="green" <?php if ($color=='green') { echo 'checked="checked"'; } ?> />
				<label for="green">	
					<img src="<?php bloginfo('template_directory'); ?>/images/comet_color-green.png" alt="green" title="green" width="100" height="150" />
				</label>
				
				<input type="radio" name="color" value="teal" id="teal" <?php if ($color=='teal') { echo 'checked="checked"'; } ?> />
				<label for="teal">	
					<img src="<?php bloginfo('template_directory'); ?>/images/comet_color-teal.png" alt="teal" title="teal" width="100" height="150" />
				</label>
				
				<input type="radio" name="color" value="blue" id="blue" <?php if ($color=='blue') { echo 'checked="checked"'; } ?> />
				<label for="blue">	
					<img src="<?php bloginfo('template_directory'); ?>/images/comet_color-blue.png" alt="blue" title="blue" width="100" height="150" />
				</label>
				
				<input type="radio" name="color" value="purple" id="purple" <?php if ($color=='purple') { echo 'checked="checked"'; } ?> />
				<label for="purple">	
					<img src="<?php bloginfo('template_directory'); ?>/images/comet_color-purple.png" alt="purple" title="purple" width="100" height="150" />
				</label>
			
			<h3>Layout</h3> 
			<?php $layout = $fp_options['fp_layout']; ?>  
		
				<input type="radio" name="layout" value="right" id="right" <?php if ($layout=='right') { echo 'checked="checked"'; } ?> />
				<label for="right">	
					<img src="<?php bloginfo('template_directory'); ?>/images/layout_right.png" alt="Sidebar to the right" title="Sidebars to the right" width="150" height="150" />
				</label>
				
				<input type="radio" name="layout" value="left" id="left" <?php if ($layout=='left') { echo 'checked="checked"'; } ?> />
				<label for="left">			
					<img src="<?php bloginfo('template_directory'); ?>/images/layout_left.png" alt="Sidebar to the left" title="Sidebars to the left" width="150" height="150" />
				</label>
				
				<input type="radio" name="layout" value="left and right" id="leftandright" <?php if ($layout=='left and right') { echo 'checked="checked"'; } ?> />
				<label for="leftandright">	
					<img src="<?php bloginfo('template_directory'); ?>/images/layout_left-and-right.png" alt="Sidebars to the left and right" title="Sidebars to the left and right" width="150" height="150" />
				</label>
				
				<input type="radio" name="layout" value="hidden" id="hidden" <?php if ($layout=='hidden') { echo 'checked="checked"'; } ?> />
				<label for="hidden">	
					<img src="<?php bloginfo('template_directory'); ?>/images/layout_hidden.png" alt="No sidebars" title="No sidebars" width="150" height="150" />
				</label>

			<h3>Font</h3>
				<label for="font">Font family:
					<select name="font" id="font"> 
						<?php $font = $fp_options['fp_font']; ?>  
						<option <?php if ($font=='Verdana') { echo 'selected="selected"'; } ?> >Verdana</option>
						<option <?php if ($font=='Tahoma') { echo 'selected="selected"'; } ?>>Tahoma</option>
						<option <?php if ($font=='Helvetica') { echo 'selected="selected"'; } ?>>Helvetica</option>
						<option value="'Trebuchet MS'" <?php if ($font=='\'Trebuchet MS\'') { echo 'selected="selected"'; } ?>>Trebuchet MS</option>
						<option <?php if ($font=='Georgia') { echo 'selected="selected"'; } ?>>Georgia</option>
					</select>
				</label>
			
				&nbsp; <label for="font_size">Font size: 
					<select name="font_size" id="font_size"> 
						<?php $font_size = $fp_options['fp_font_size']; ?>  
						<option <?php if ($font_size=='15px') { echo 'selected="selected"'; } ?>>15px</option>
						<option <?php if ($font_size=='14px') { echo 'selected="selected"'; } ?>>14px</option>
						<option <?php if ($font_size=='13px') { echo 'selected="selected"'; } ?>>13px</option>
						<option <?php if ($font_size=='12px') { echo 'selected="selected"'; } ?>>12px</option>
						<option <?php if ($font_size=='11px') { echo 'selected="selected"'; } ?>>11px</option>
					</select>
				</label>

			<h3>Logo</h3> 
			<?php $logo = $fp_options['fp_logo']; ?>  
			
				<label for="logo">URL to logo:
					<input type="text" name="logo" id="logo" style="width: 250px;" value="<?php echo $logo; ?>" />
				</label>
				&nbsp; <label for="logo_pos">Position of logo:
					<select name="logo_pos" id="logo_pos"> 
						<?php $logo_pos = $fp_options['fp_logo_pos']; ?>  
						<option value="alignleft" <?php if ($logo_pos=='alignleft') { echo 'selected="selected"'; } ?>>Left</option>
						<option value="aligncenter" <?php if ($logo_pos=='aligncenter') { echo 'selected="selected"'; } ?>>Center</option>
						<option value="alignright" <?php if ($logo_pos=='alignright') { echo 'selected="selected"'; } ?>>Right</option>
					</select>
				</label>

			<h3>Misc</h3>
			
				<label for="post_author">
					<input type="checkbox" name="post_author" id="post_author" <?php echo $fp_options['fp_post_author']; ?> />
					Display the author on each post
				</label>
			
			<h3>Footer</h3>
			<?php $footer = $fp_options['fp_footer']; ?>  
			
				<label for="fp_footer">Text that will apprear in the footer:<br/>
					<textarea name="fp_footer" id="fp_footer" cols="70" rows="3"><?php echo $footer; ?></textarea>
				</label>
			
			<h3>Custom CSS</h3>
			<?php $css = $fp_options['fp_css']; ?> 
			 
				<label for="css">Place any custom <abbr title="Cascading Style Sheets"><a href="http://www.w3schools.com/css/" target="_blank">CSS</a></abbr> you have here:<br/>
					<textarea name="css" id="css" cols="70" rows="6"><?php echo $css; ?></textarea>
				</label>

			<p><input type="submit" value="Update Options" class="button" /></p> 
		</form>  

	</div>  
	<?php  
}
add_action('admin_menu', 'themeoptions_admin_menu'); 

function themeoptions_update()  
{
	$fp_options['fp_color'] 		= stripslashes($_POST['color']);
	$fp_options['fp_layout'] 		= stripslashes($_POST['layout']);
	$fp_options['fp_font'] 			= stripslashes($_POST['font']);
	$fp_options['fp_font_size'] 	= stripslashes($_POST['font']);
	$fp_options['fp_logo'] 			= stripslashes($_POST['logo']);
	$fp_options['fp_logo_pos']		= stripslashes($_POST['logo_pos']);
	$fp_options['fp_footer'] 		= stripslashes($_POST['fp_footer']);
	$fp_options['fp_css'] 			= stripslashes($_POST['css']);
	
	if ( isset( $_POST['post_author'] ) == 'on' ) { 
		$fp_options['fp_post_author'] = 'checked="checked"';
	} else {
		$fp_options['fp_post_author'] = '';
	}
	
	// update
	update_option('fp_options', $fp_options);
}
