<?php

/* Template Name: Team Overview */

$context = array();
$context = Timber::get_context();
$context['post'] = Timber::get_post();
$context['divisions'] = Timber::get_terms('division'); // category
Timber::render('page.twig', $context);

?>