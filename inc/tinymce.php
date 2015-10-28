<?php

/**
*
* https://codex.wordpress.org/TinyMCE#Customize_TinyMCE_with_Filters
* Plugin "table" http://www.tinymce.com/wiki.php/Plugin:table
* Installed in wp-include/js/tinymce/plugins/
*
*/
function my_format_TinyMCE( $in ) {
	// remove the "Text" Tab = editor switcher
	echo '<style>#content-html{display:none;}</style>';
	/*
	$in['remove_linebreaks'] = false;
	$in['gecko_spellcheck'] = false;
	$in['keep_styles'] = true;
	$in['accessibility_focus'] = true;
	$in['tabfocus_elements'] = 'major-publishing-actions';
	$in['media_strict'] = false;
	$in['paste_remove_styles'] = false;
	$in['paste_remove_spans'] = false;
	$in['paste_strip_class_attributes'] = 'none';
	$in['paste_text_use_dialog'] = true;
	$in['wpeditimage_disable_captions'] = true;
	$in['plugins'] = 'tabfocus,paste,media,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpfullscreen';
	$in['content_css'] = get_template_directory_uri() . "/editor-style.css";
	$in['wpautop'] = true;
	$in['apply_source_formatting'] = false;
	$in['block_formats'] = "Paragraph=p; Heading 3=h3; Heading 4=h4";
	$in['toolbar1'] = 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,wp_fullscreen,wp_adv ';
	$in['toolbar2'] = 'formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help ';
 	*/
	$in['plugins'] = 'wplink,paste';
    $in['block_formats'] = 'Paragraph=p; Heading=h2';
    $in['toolbar1'] = 'formatselect,bold,italic,bullist,numlist,link,unlink,removeformat,pastetext';
   	$in['toolbar2'] = '';
	$in['toolbar3'] = '';
	$in['toolbar4'] = '';
	$in['content_css'] = get_template_directory_uri() . "/inc/tinymce-editor.css";
	return $in;
}
add_filter( 'tiny_mce_before_init', 'my_format_TinyMCE' );