<?php

function sh_edit_template(){
  if(!current_user_can('manage_options'))  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
  global $wpdb;
  $template_id = $_GET['template_id'] * 1;
  $is_new_template = !(bool) $template_id;
  $table_name = $wpdb->prefix . "sodahead_templates";
  if($_POST['title'] and $_POST['template']){
    if($is_new_template){
      $wpdb->show_errors();
      $wpdb->insert($table_name, array('name' => $_POST['title'],
        'display_results' => $_POST['results'],
        'creation' => current_time('mysql'),
        'template' => stripslashes($_POST['template'])));
      $is_new_template = false;
      $template_id =  $wpdb->insert_id;
      $message = "Template created.";
    }else{
      $wpdb->update($table_name, array('name' => $_POST['title'],
        'display_results' => $_POST['results'],
        'template' => stripslashes($_POST['template'])),
        array('id' => $template_id));
      $message = "Template updated.";
    }
  }
  if($_POST['default_template'] && !$is_new_template){
    update_option('sh_default_template_id', $template_id);
  }
  $template = $wpdb->get_row("select * from $table_name where id = $template_id");
  if($template_id && !$template){
    echo "<h2>Template not found</h2>";
    echo "<p>The template ID $template_id you requested can't be found";
  }else{
    include('include/sodahead_template_edit.php');
  }
}


function sh_manage_templates(){
  if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
  global $wpdb;
  $table_name = $wpdb->prefix . "sodahead_templates";
  $templates = $wpdb->get_results( "SELECT id, name, creation FROM $table_name" );
  include('include/sodahead_templates.php');
}

function sodahead_template_delete(){
  if(!current_user_can('manage_options'))  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
  global $wpdb;
  if($_GET['action_key'] == get_option('sh_action_key')){
    $template_id = $_GET['template_id'] * 1;
    if($template_id != get_option("sh_default_template_id")){
      $table_name = $wpdb->prefix . "sodahead_templates";
      $wpdb->delete($table_name, array('ID' => $template_id));
      update_option('sh_action_key', uniqid());
    }
  }
  wp_redirect(admin_url() . 'admin.php?page=sh_menu_options_templates');
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
