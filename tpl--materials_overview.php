<?php
/* Template Name: Materials overview */
$context = array();
$context = Timber::get_context(); 
$context['post'] = Timber::get_post();
$context['materials'] = Timber::get_posts('post_type=metaltec_material&orderby=menu_order&order=ASC'); // category
Timber::render('page.twig', $context);
?>