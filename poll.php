<?php

function sh_manage_polls(){
  if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
  include('include/sodahead_manage_polls.php');
}

function sh_edit_poll(){
  $poll_id = $_GET['poll_id'] * 1;
  global $SODAHEAD_ROOT;
  include('include/sodahead_poll_edit.php');
}

function sodahead_poll_edited(){
  include('include/sodahead_poll_edited.html');
  die();
}

function sodahead_poll_created(){
  include('include/sodahead_poll_created.html');
  die();
}

function sodahead_deleted(){
  include('include/sodahead_deleted.html');
  die();
}

function sodahead_error(){
  include('include/sodahead_error.html');
  die();
}

function sodahead_delete(){
  global $SODAHEAD_ROOT;
  $poll_id = $_GET['poll_id'] * 1;
  include('include/sodahead_delete.php');
  die();
}

function sodahead_ask(){
  global $SODAHEAD_ROOT;
  include('include/sodahead_ask.php');
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
