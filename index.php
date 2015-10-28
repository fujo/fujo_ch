<?php
/**
*
* Here is the WP Template Hierarchy "router".
*
*/

$context 	= array();
$template 	= '';

// Set up page context

$context = Timber::get_context();

if ( is_singular() )  
{
    $context['post'] 		= new TimberPost();
} 
else
{
    $context['posts'] 		= Timber::get_posts();
    $context['pagination'] 	= Timber::get_pagination();
}

// set up th template

if ( is_single() ) 
{
    $template = 'page';
}
elseif ( is_front_page() )  
{
	$context['is_home'] = 1; // bool is home
	// $context['last_posts'] 	= Timber::get_posts('post_type=post&numberposts=3');
	// complete the row with teaser page
	// $count = sizeof( $context['last_posts'] );
    // $ids = get_field('teasers');
	// $context['teasers'] = Timber::get_posts( array_slice( $ids, 0, 3 - $count ) );
	$template = 'home';
}
elseif ( is_home() ) 
{
    die('is_home');
}
elseif ( is_page() ) 
{
    $template = 'page';
}
elseif ( is_category() )
{
    die('is_category');
    $context['archive_title'] = get_cat_name(get_query_var('cat'));
    $context['archive_description'] = term_description();
    $context['page'] = 'category';
    $template = 'category';
}
elseif ( is_404() ) 
{
  	$context['post'] 		= Timber::get_post('notfound'); // "notfound" = page slug
    $context['404']         = 1;
    $template 				= '404';
}

Timber::render(	$template.'.twig', $context);

$loader = new TimberLoader();
$loader->clear_cache_timber();
$loader->clear_cache_twig();

// echo "<pre>";
// print_r($context);

?>