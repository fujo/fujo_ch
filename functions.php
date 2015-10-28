<?php 

error_reporting(E_ALL); 
ini_set('display_errors', 1);

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 */
add_action( 'after_setup_theme', 'metaltec_setup' );
function metaltec_setup() {
	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'metaltec' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'metaltec', get_template_directory() . '/languages' );
	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	//add_theme_support( 'title-tag' );
	/*
	 * Enable navigations menu
	 *
	 */
	// This theme uses wp_nav_menu() in three locations.
	register_nav_menus( array(
		'theme_location' => 'primary',
		'main' 		=> __( 'Main Menu' ),
		//'meta' 		=> __( 'Meta Menu' ),
		'footer' 	=> __( 'Footer Menu' )
	));
	
	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 200, true ); // default Post Thumbnail dimensions (cropped)
	// additional image sizes
	// add_image_size ( string $name, int $width, int $height, bool|array $crop = false )
	// delete the next line if you do not need additional image sizes
	// add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
	// add_image_size( 'large_thumb', 75, 75, true );
	// add_image_size( 'wider_image', 200, 150 );
	// use it: 
	// - wp_get_attachment_image_src( 325, 'wider_image'); 
	// - the_post_thumbnail();

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

}
/**
 * Register stylesheets + js scripts
 * Proper way to enqueue scripts and styles
 * @link https://codex.wordpress.org/Function_Reference/wp_enqueue_script
 */
add_action( 'wp_enqueue_scripts', 'custom_scripts', 10 );
function custom_scripts() {

	// styles

	wp_register_style( 'theme-style', get_template_directory_uri().'/css/dist/style.min.css', false, false, 'all' );
	wp_enqueue_style( 'theme-style' );

	// scripts

	//wp_register_script( 'modernizr', get_template_directory_uri().'/js/vendor/modernizr.js', array(), false, false );
	wp_register_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array(), false, false );
	wp_enqueue_script( 'modernizr' );

	https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js
	// moving jQuery to the footer
	if( !is_admin() )
	{
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"), false, '1.3.2', true);
	}
	// wp_register_script( 'custom_script', 'js/vendor/jquery.min.js', array(  ), false, true );
	wp_register_script( 'theme_script', get_template_directory_uri().'/js/dist/script.min.js', array('jquery'), false, '1.0', false );
	wp_enqueue_script( 'theme_script' );

}
// remove injected script
// http://contactform7.com/loading-javascript-and-stylesheet-only-when-it-is-necessary/
// add_filter( 'wpcf7_load_js', '__return_false' );
// add_filter( 'wpcf7_load_css', '__return_false' );
// define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS',true);
/**
 *
 * TIMBER
 *
 */
add_filter('timber_context', 'add_to_context');
function add_to_context($data){

    /* Add WPML API to timber context */
    // $data['current_lang_code'] = ICL_LANGUAGE_CODE;
    // https://wpml.org/documentation/getting-started-guide/language-setup/custom-language-switcher/
    $data['langmenu'] =   pll_the_languages(array('raw'=>1));
    /*
    echo '<pre>';
    print_r( pll_the_languages(array('raw'=>1)) );
    */

    /* Now, in similar fashion, you add a Timber menu and send it along to the context. */
    $data['mainmenu'] = new TimberMenu('main'); // This is where you can also send a Wordpress menu slug or ID
    // $data['footermenu'] = new TimberMenu('footer-'.ICL_LANGUAGE_CODE);
    // $data['quality'] = new TimberMenu('quality-'.ICL_LANGUAGE_CODE);
    
    /* SEO -> inc/globalcustomfields.php */
    // $data['metadescription'] = ( ICL_LANGUAGE_CODE != 'de' ) ? get_option('metaltec_metadescription') : get_option('metaltec_metadescription_de'); 
    // $data['metakeywords'] = ( ICL_LANGUAGE_CODE != 'de' ) ? get_option('metaltec_metakeywords') : get_option('metaltec_metakeywords_de'); 

    /* Everyone loves widgets! Of course they do... */
    // $data['footer_widgets'] = Timber::get_widgets('footer_widgets');
    return $data;
}
/**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
if (function_exists('register_sidebar')) {

	register_sidebar(array(
		'name' => 'footer_widgets',
		'id'   => 'footer_widgets',
		'description'   => 'This is a widget area.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));

}
/**
 *
 * Includes
 *
 */
require get_template_directory() . '/inc/common.php';
require get_template_directory() . '/inc/shortcode.php';
require get_template_directory() . '/inc/custom_global_fields.php';
require get_template_directory() . '/inc/tinymce.php';
// require get_template_directory() . '/inc/CPT_team.php';
// require get_template_directory() . '/inc/CPT_material.php';
// require get_template_directory() . '/inc/CPT_market.php';