<?php

/* Template Name: Contact */

$context = array();
$context = Timber::get_context(); 
$context['post'] = Timber::get_post();
$context['team'] = Timber::get_post( get_field('team') );
$context['form'] = Timber::get_post( get_field('form') );
Timber::render('contact.twig', $context);

?>