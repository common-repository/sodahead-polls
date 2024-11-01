<?php

function sodahead_settings(){
  global $wpdb;
  if(!current_user_can('manage_options'))  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
  if($_POST['submit']){
    update_option('sh_freq_on', $_POST['freq']);
    update_option('sh_freq_imp', $_POST['impression']);
    update_option('sh_freq_time', $_POST['time']);
    update_option('sh_freq_unit', $_POST['unit']);
    update_option('sh_flyout_display', $_POST['display']);
    update_option('sh_flyout_width', $_POST['width']);
    update_option('sh_flyout_bottom', $_POST['bottom']);
    $message = "Settings updated.";
  }
  $freq_on = get_option('sh_freq_on');
  $freq_unit = get_option('sh_freq_unit');
  $freq_time = get_option('sh_freq_time');
  $freq_imp = get_option('sh_freq_imp');
  $display = get_option('sh_flyout_display');
  $display = get_option('sh_flyout_display');
  $display = get_option('sh_flyout_display');
  $width = get_option('sh_flyout_width');
  $bottom = get_option('sh_flyout_bottom');

  include('include/sodahead_settings.php');
}

function sodahead_authed(){
  include('include/sodahead_authed.html');
  die();
}

function sodahead_auth(){
  global $SODAHEAD_ROOT;
  if($_GET['action_key'] != get_option('sh_action_key'))
    die();
  update_option('sh_action_key', uniqid());
  $action = $_GET['sh_action'];
  if($action == 'sh_logout'){
    update_option('sh_user_id', '');
    update_option('sh_token', 'no token');
  }
  include('include/sodahead_auth.php');
  die();
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
