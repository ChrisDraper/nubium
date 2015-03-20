<?php
/**
 * Nubium functions and definitions
 *
 * @package Nubium
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'nubium_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nubium_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Nubium, use a find and replace
	 * to change 'nubium' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'nubium', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'nubium' ),
		'secondary' => __( 'Secondary Menu', 'nubium' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'nubium_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // nubium_setup
add_action( 'after_setup_theme', 'nubium_setup' );




/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function nubium_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'nubium' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'nubium_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nubium_scripts() {
	wp_enqueue_style( 'nubium-style', get_stylesheet_uri() );

	wp_enqueue_script( 'nubium-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'nubium-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nubium_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/* Moonshine amends 
---------------------------------------------------------------
*/
/*  Remove admin bar  
*/
add_filter('show_admin_bar', '__return_false');

/**
 * Enqueue scripts and styles.
 */
function mi_nubium_styles() {
	
}
add_action( 'wp_enqueue_scripts', 'mi_nubium_styles' );

function load_google_fonts() {
            wp_register_style('googleFontsRoboto', 'http://fonts.googleapis.com/css?family=Roboto:400,300,500,700');
            wp_enqueue_style( 'googleFontsRoboto'); 
}
add_action('wp_print_styles', 'load_google_fonts');

/* Shortcodes -------------------------------------------------------
*/

function nu_grid_shortcode($atts, $content = null) {   
	extract(shortcode_atts(array(
      'columns' => 'one',
	  'row' => ''
   ), $atts));
   
   if ($row=='yes') {
   	$return_string = '<div class=\'row\'>' . $content . '</div>';
   } else {
   	$return_string = '<div class=\'columns ' . $columns . '\'>' . $content . '</div>';
   }
   return $return_string;
}

function nu_row_shortcode($atts, $content = null) {   
	extract(shortcode_atts(array(
      'columns' => 'one',
	  'row' => ''
   ), $atts));
     	
   $return_string = '<div class=\'row\'>' . do_shortcode($content) . '</div>';
   return $return_string;
}

function register_shortcodes(){
   add_shortcode('nu-grid', 'nu_grid_shortcode');
   add_shortcode('nu-row', 'nu_row_shortcode');

}

add_action( 'init', 'register_shortcodes');


/* Shortcode button on editor */

// Hooks your functions into the correct filters
function my_add_mce_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'my_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'my_register_mce_button' );
	}
}
add_action('admin_head', 'my_add_mce_button');

// Declare script for new button
function my_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['my_mce_button_columns'] = get_template_directory_uri() .'/js/shortcodes.js';
	$plugin_array['my_mce_button_row'] = get_template_directory_uri() .'/js/shortcodes.js';
	return $plugin_array;
}

// Register new button in the editor
function my_register_mce_button( $buttons ) {
	array_push( $buttons, 'my_mce_button_columns' );
	array_push( $buttons, 'my_mce_button_row' );
	return $buttons;
}

