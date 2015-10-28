<?php
add_shortcode('metaltec_sc_swissfinish', 'metaltec_swissfinish');
function metaltec_swissfinish() {
	$markup  = '<p><figure>';
	$markup .= '<img class="responsive" src="' . get_template_directory_uri() . '/img/metaltec_vision_fr.png">';
	$markup .= '</figure></p>';
	return $markup;
}