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
$markets = new CPT(array(
    'post_type_name' => 'metaltec_market',
    'singular' => 'Market',
    'plural' => 'Markets',
    'slug' => _x( 'markets', 'URL slug', 'metaltec' ) // https://wpml.org/documentation/getting-started-guide/translating-page-slugs/
), $options );

// use "pages" icon for post type
$markets->menu_icon("dashicons-chart-pie"); 
// https://developer.wordpress.org/resource/dashicons/#exerpt-view menu_order

// Translation
$markets->set_textdomain('metaltec');

$markets->columns(array(
    'cb' => '<input type="checkbox" />',
    'title' => __('Title'),
    'menu_order' => __('Order')
    //'date' => __('Date')
));
$markets->populate_column('menu_order', function($column, $post) {
    // your code goes here…
    echo $post->menu_order;
});
/*
$markets->sortable(array(
    'menu_order' => array( 'order', true)
));
*/