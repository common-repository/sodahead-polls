<?php

function sodahead_admin_menu(){
  add_menu_page('SodaHead Polls Management', 'Polls', 'manage_options',
    'sh_menu_options', 'sh_manage_polls', plugins_url('sodahead-polls/img/icon.png'));
  add_submenu_page('sh_menu_options', 'SodaHead Templates Management',
    'Templates', 'manage_options', 'sh_menu_options_templates',
    'sh_manage_templates');
  add_submenu_page('sh_menu_options', 'SodaHead Settings',
    'Settings', 'manage_options', 'sh_menu_options_settings',
    'sodahead_settings');

  // invisible sub menu
  add_submenu_page(NULL, 'SodaHead Template Edit',
    'Template Edit', 'manage_options', 'sh_menu_options_template_edit',
    'sh_edit_template');
  add_submenu_page(NULL, 'SodaHead Poll Edit',
    'Poll Edit', 'manage_options', 'sh_menu_options_poll_edit',
    'sh_edit_poll');
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
