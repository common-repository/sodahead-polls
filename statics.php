<?php

function sodahead_admin_statics($page){
  if($page == 'widgets.php' ||
    $page == 'polls_page_sh_menu_options_settings' ||
    $page == 'toplevel_page_sh_menu_options'){
    wp_enqueue_script( 'sh_widget_script',
      plugin_dir_url(__FILE__) . 'js/script.js');
  }
  if($page == 'post.php' || $page == 'post-new.php'){
    wp_enqueue_script( 'sh_widget_script',
      plugin_dir_url(__FILE__) . 'js/script.js');
    wp_enqueue_script('jquery-ui-dialog');
    wp_enqueue_style('jquery-style',
      '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css');

  }
  if($page == 'admin_page_sh_menu_options_template_edit' ||
    $page == 'admin_page_sh_menu_options_template_new'){
    wp_enqueue_script( 'sh_widget_script',
      plugin_dir_url(__FILE__) . 'js/script.js');
    wp_enqueue_script( 'sh_template_script',
      plugin_dir_url( __FILE__ ) . 'js/edit_template.js' );
  }
  if($page == 'admin_page_sh_menu_options_poll_edit'){
    global $SODAHEAD_STATICS;
    wp_enqueue_script( 'sh_widget_script',
      plugin_dir_url(__FILE__) . 'js/script.js');
    wp_enqueue_script('SH-widget',
      $SODAHEAD_STATICS . '/js/polls/widget-v1.js', array(), '1.0', true);
    wp_enqueue_style('SH-widget',
      plugin_dir_url( __FILE__ ) . 'css/widget.css');
  }
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
