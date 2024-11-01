<?php

function sodahead_update_token(){
  global $wpdb;
  global $SODAHEAD_ROOT;
  $domain = $_POST['domain'];
  $domain_hash = $_POST['domain_hash'];
  $user_id = $_POST['user_id'];
  $secret = get_option('sh_secret');
  if (hash('sha256', $domain . $secret) == $domain_hash){
    update_option('sh_user_id', $user_id);
    $url = 'https:' . $SODAHEAD_ROOT . '/token/';
    $data = array('secret' => $secret, 'domain' => $domain);
    $options = array(
      'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
      ),
    );
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    if (strlen($response) == 32){
      update_option('sh_token', $response);
    }
  }
  wp_redirect($_SERVER['HTTP_REFERER']);
  exit;
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
