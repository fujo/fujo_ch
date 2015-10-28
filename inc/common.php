<?php
/**
*
* Common configuration for Aquaverde WP Project
*
*/
/* 
remove ADD MEDIA in TinyMCE 
https://wordpress.org/support/topic/how-to-remove-add-media-button-in-wp-35
*/
add_action('admin_head','z_remove_media_controls');
function z_remove_media_controls() {
     remove_action( 'media_buttons', 'media_buttons' );
}
/*
https://codex.wordpress.org/Function_Reference/remove_menu_page
*/
function remove_menus(){
  
  // remove_menu_page( 'index.php' );                  //Dashboard
  // remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );                 //Media
  // remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  // remove_menu_page( 'themes.php' );                 //Appearance
  // remove_menu_page( 'plugins.php' );                //Plugins
  // remove_menu_page( 'users.php' );                  //Users
  // remove_menu_page( 'tools.php' );                  //Tools
  // remove_menu_page( 'options-general.php' );        //Settings
  
  if( !is_admin() ) {

    remove_menu_page( 'admin.php?page=customtaxorder' ); 

  }
  
}
add_action( 'admin_menu', 'remove_menus' );
/*
https://wordpress.org/support/topic/removing-emoji-code-from-header
*/
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );