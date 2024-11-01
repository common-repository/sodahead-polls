<?php
/**
 * Plugin Name: SodaHead Polls
 * Plugin URI: http://www.sodahead.com/poll-widget/
 * Description: Quickly and easily create free, customized polls for your blog with the best WordPress poll plugin available.
 * Version: 3.0.4
 * Author: SodaHead inc.
 * Author URI: http://www.sodahead.com
 * License: A "Slug" license name e.g. GPL2
 */

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

$SODAHEAD_ROOT = '//wpapi.sodahead.com';
$SODAHEAD_STATICS = '//d6fekxp9qbg3b.cloudfront.net';

require(plugin_dir_path(__FILE__) . 'help.php');
require(plugin_dir_path(__FILE__) . 'widget.php');
require(plugin_dir_path(__FILE__) . 'statics.php');
require(plugin_dir_path(__FILE__) . 'post.php');
require(plugin_dir_path(__FILE__) . 'token.php');
require(plugin_dir_path(__FILE__) . 'template.php');
require(plugin_dir_path(__FILE__) . 'poll.php');
require(plugin_dir_path(__FILE__) . 'settings.php');
require(plugin_dir_path(__FILE__) . 'admin.php');

add_action('widgets_init', 'sodahead_register_widget');
add_action('admin_enqueue_scripts', 'sodahead_admin_statics');
add_action('admin_menu', 'sodahead_admin_menu');
add_action('edit_form_after_title', 'sodahead_edit_post_hook');
add_action('init', 'sodahead_buttons');

// Ajax views
add_action('wp_ajax_sodahead_auth', 'sodahead_auth');
add_action('wp_ajax_sodahead_authed', 'sodahead_authed');
add_action('wp_ajax_sodahead_ask', 'sodahead_ask');
add_action('wp_ajax_sodahead_delete', 'sodahead_delete');
add_action('wp_ajax_sodahead_deleted', 'sodahead_deleted');
add_action('wp_ajax_sodahead_update_token', 'sodahead_update_token');
add_action('wp_ajax_sodahead_poll_created', 'sodahead_poll_created');
add_action('wp_ajax_sodahead_error', 'sodahead_error');
add_action('wp_ajax_sodahead_poll_edited', 'sodahead_poll_edited');
add_action('wp_ajax_sodahead_template_delete', 'sodahead_template_delete');

add_shortcode('sh_poll', 'sodahead_shortcode_poll');

add_filter('contextual_help', 'sodahead_help', 10, 3);

register_activation_hook(__FILE__, Array('SH_Poll_Widget', 'install'));
?>
