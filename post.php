<?php

function myplugin_buttonhooks() {
  // Only add hooks when the current user has permissions AND
  // is in Rich Text editor mode
  if ( ( current_user_can('edit_posts') || current_user_can('edit_pages') ) &&
    get_user_option('rich_editing') ) {
    add_filter("mce_external_plugins", "myplugin_register_tinymce_javascript");
    add_filter('mce_buttons', 'myplugin_register_buttons');
  }
}

function sodahead_add_buttons( $plugin_array ) {
  $plugin_array['sodahead'] = plugin_dir_url(__FILE__) . 'js/tinymce_btn.js';
  return $plugin_array;
}

function sodahead_register_buttons( $buttons ) {
  array_push( $buttons, 'sh_add_poll' );
  return $buttons;
}

function sodahead_edit_post_hook(){
  global $wpdb;
  global $SODAHEAD_ROOT;
  $table_name = $wpdb->prefix . "sodahead_templates";
  $templates = $wpdb->get_results( "SELECT id, name, creation FROM $table_name" );
  include('include/sodahead_add_poll_modal.php');
}

function sodahead_buttons() {
  add_filter('mce_external_plugins', 'sodahead_add_buttons');
  add_filter('mce_buttons', 'sodahead_register_buttons');
}

/**
 *  copyright (c) 2013  SodaHead.com
 *
 *  this program is free software: you can redistribute it and/or modify
 *  it under the terms of the gnu general public license as published by
 *  the free software foundation, either version 3 of the license, or
 *  (at your option) any later version.
 *
 *  this program is distributed in the hope that it will be useful,
 *  but without any warranty; without even the implied warranty of
 *  merchantability or fitness for a particular purpose.  see the
 *  gnu general public license for more details.
 *
 *  you should have received a copy of the gnu general public license
 *  along with this program.  if not, see <http://www.gnu.org/licenses/>.
 */
?>
