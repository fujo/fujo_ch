<?php

/* Template Name: Markets overview */

$context = array();
$context = Timber::get_context(); 
$context['post'] = Timber::get_post();
$context['markets'] = Timber::get_posts('post_type=metaltec_market&orderby=menu_order&order=ASC'); // category
Timber::render('page.twig', $context);

?>