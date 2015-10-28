<?php
// include the custom post type class
include_once('Class/CPT.php');

// add & set options
$options = array(
    'public'              => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_nav_menus'   => true,  // add to menu navigation
    'show_in_menu'        => true,  // admin menu
    'show_in_admin_bar'   => true,  // admin bar
    'menu_position'       => 120,
    'capability_type'     => 'post',
    'hierarchical'        => true,  // order
    'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
    'has_archive'         => false,
    'query_var'           => true
);

// create a materials custom post type
$materials = new CPT(array(
    'post_type_name' => 'metaltec_material',
    'singular' => 'Material',
    'plural' => 'Materials',
    'slug' => _x( 'materials', 'URL slug', 'metaltec' ) // https://wpml.org/documentation/getting-started-guide/translating-page-slugs/
    //'slug' => __( 'materials', 'URL slug', 'metaltec' )
), $options );

// use "pages" icon for post type
$materials->menu_icon("dashicons-hammer"); 
// https://developer.wordpress.org/resource/dashicons/#exerpt-view menu_order

$materials->filters(array('menu_order'));

$materials->columns(array(
    'cb' => '<input type="checkbox" />',
    'title' => __('Title'),
    'menu_order' => __('Order')
    //'date' => __('Date')
));
$materials->populate_column('menu_order', function($column, $post) {
    // your code goes here…
     echo $post->menu_order;
});

