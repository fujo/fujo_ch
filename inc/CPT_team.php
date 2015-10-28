<?php
// include the custom post type class
include_once('Class/CPT.php');

// add & set options
$options = array(
    'public'              => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_nav_menus'   => false, // add to menu navigation
    'show_in_menu'        => true,  // admin menu
    'show_in_admin_bar'   => false, // admin bar
    'menu_position'       => 110,
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'supports'            => array( 'title', 'editor', 'thumbnail'),
    'has_archive'         => false,
    'query_var'           => true
);

// create a book custom post type
$teams = new CPT(array(
    'post_type_name' => 'metaltec_team',
    'singular' => 'Team',
    'plural' => 'Teams',
    'slug' => 'team'
), $options );

// use "pages" icon for post type
$teams->menu_icon("dashicons-admin-users"); 
// https://developer.wordpress.org/resource/dashicons/#exerpt-view

// create a genre taxonomy
$teams->register_taxonomy(array(
    'taxonomy_name' => 'division',
    'singular' => 'Division',
    'plural' => 'Divisions',
    'slug' => 'division'
));


/*
// define the columns to appear on the admin edit screen
$teams->columns(array(
    'cb' => '<input type="checkbox" />',
    'title' => __('Title'),
    'division' => __('Divisions'),
    'photo' => __('Photo'),
    // 'date_golive' => __('Date Go Live')
    // 'date' => __('Date')
));


// populate the price column
$teams->populate_column('photo', function($column, $post) {

    $array = get_field('photo'); // ACF get_field() function
    $thumb_url = $array['sizes']['thumbnail']; 
    echo '<img src="'. $thumb_url .'" width="100" />';

}); 

// populate the ratings column
$teams->populate_column('date_golive', function($column, $post) {
    // echo get_field('date_golive'); // ACF get_field() function
});

// make rating and price columns sortable
$teams->sortable(array(
    // 'date_golive' => array('date_golive', true)
));
*/