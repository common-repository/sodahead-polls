<?php

class SH_Poll_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'foo_widget', // Base ID
      __('SodaHead Polling', 'text_domain'), // Name
      array('description' => __('Polling Widget', 'text_domain'),) // Args
   );
  }

  static function install(){
    # generate uniq ID for communication with SH
    global $wpdb;
    update_option('sh_secret', uniqid());
    update_option('sh_action_key', uniqid());
    $table_name = $wpdb->prefix . "sodahead_templates";
    $sql = "CREATE TABLE $table_name (
         id mediumint(9) NOT NULL AUTO_INCREMENT,
         creation datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
         name tinytext NOT NULL,
         display_results tinyint NOT NULL default 0,
         template text NOT NULL,
         UNIQUE KEY id (id)
       );";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    $template_exist = $wpdb->get_row( "select * from $table_name");
    if(!$template_exist){
      $wpdb->insert($table_name, array(
        'creation' => current_time('mysql'),
        'name' => 'Minimalist',
        'template' => "<style>\n   .sh-template-1 {\n    padding: 5px;\n    border: 1px solid #ccc;\n    background: #fafafa;\n  }\n</style>\n\n<!-- Poll with loading spin -->\n<div class=\"sh-poll\" data-total=\"true\" data-count=\"true\">\n  <div class=\"sh-loading\"></div>\n</div>"));
      update_option('sh_default_template_id', $wpdb->insert_id);
      $wpdb->insert($table_name, array(
        'creation' => current_time('mysql'),
        'name' => 'Classic: logo, demos',
        'template' => "<style>\n   .sh-template-2 {\n    border: 1px solid black;\n    background: #fafafa;\n  }\n  .sh-template-2 .poll-header{\n    background-color: black;\n  }\n  .sh-template-2 .poll-header img{\n    margin: 0 auto;\n    padding: 5px 0;\n    max-width: 90%;\n    display: block;\n  }\n\n  .sh-template-2 .sh-demo{\n    width: 28%;\n    margin: 5px 2%;\n  }\n  .sh-template-2 .demo-container{\n    text-align: center;\n  }\n  .sh-template-2 .poll-body{\n    padding: 5px;\n  }\n  .sh-template-2.sh-flyout-box{\n    padding: 0;\n    margin-right: 0;\n  }\n\n  .sh-template-2.sh-flyout-box .relation-demo,\n  .sh-template-2.sh-poll-widget .relation-demo{\n    display: none;\n  }\n  .sh-template-2.sh-flyout-box .sh-demo,\n  .sh-template-2.sh-poll-widget .sh-demo{\n    width: 40%;\n  }\n</style>\n<!-- Replace the image URL with your logo URL -->\n<div class=\"poll-header\">\n  <img src=\"/wp-content/plugins/sodahead-polls/img/dailypoll.png\">\n</div>\n\n<div class=\"poll-body\">\n  <!-- Poll with loading spin -->\n  <div class=\"sh-poll\" data-total=\"true\" data-count=\"true\">\n    <div class=\"sh-loading\"></div>\n  </div>\n  <!-- Demographics appear under poll post-vote -->\n  <div class=\"demo-container sh-post-vote\">\n    <div class=\"sh-demo\" data-demo=\"age\" data-postvote=\"true\"></div>\n    <div class=\"sh-demo\" data-demo=\"gender\" data-postvote=\"true\"></div>\n    <div class=\"sh-demo relation-demo\" data-demo=\"relationship status\" data-postvote=\"true\"></div>\n  </div>\n</div>"));
      $wpdb->insert($table_name, array(
        'creation' => current_time('mysql'),
        'name' => 'Classic: map',
        'template' => "<style>\n   .sh-template-3 {\n    padding: 5px;\n    border: 1px solid #ccc;\n    background: #fafafa;\n  }\n  .sh-template-3 .sh-demo{\n    width: 130px;\n    margin: 5px 10px;\n  }\n</style>\n\n<!-- Poll with loading spin -->\n<div class=\"sh-poll\" data-total=\"true\" data-count=\"true\">\n  <div class=\"sh-loading\"></div>\n</div>\n<!-- Language displayed above the map -->\n<h3 style=\"text-align: center\">Vote to see how the states voted.</h3>\n<!-- Display the U.S. Map pre-vote. To switch to world map, replace \"us\" with \"world\" -->\n<div class=\"sh-map\" data-coloring=\"lightness\" data-map=\"us\"></div>"));
      $wpdb->insert($table_name, array(
        'creation' => current_time('mysql'),
        'name' => 'Advanced: logo, demos, map',
        'template' => "<!-- Medium Sized with Grey Border -->\n<style>\n   .sh-template-4 {\n    border: 1px solid black;\n    background: #fafafa;\n  }\n  .sh-template-4 .poll-header{\n    background-color: black;\n  }\n  .sh-template-4 .poll-header img{\n    margin: 0 auto;\n    padding: 5px 0;\n    max-width: 90%;\n    display: block;\n  }\n  .sh-template-4 .poll-body{\n    padding: 5px;\n  }\n  .sh-template-4 .sh-demo{\n    width: 28%;\n    margin: 5px 2%;\n  }\n  .sh-template-4 .demo-container{\n    text-align: center;\n  }\n\n  /* when displayed in the sidebar as a widget */\n  .sh-template-4.sh-flyout-box .relation-demo,\n  .sh-template-4.sh-poll-widget .relation-demo{\n    display: none;\n  }\n  .sh-template-4.sh-flyout-box .sh-demo,\n  .sh-template-4.sh-poll-widget .sh-demo{\n    width: 40%;\n  }\n  .sh-template-4.sh-flyout-box{\n    padding: 0;\n    border-right: 0;\n  }\n\n  /*\n  .sh-template-4.sh-poll-widget .relation-demo{\n\n</style>\n<!-- Replace the image URL with your logo URL -->\n<div class=\"poll-header\">\n  <img src=\"/wp-content/plugins/sodahead-polls/img/dailypoll.png\">\n</div>\n\n<div class=\"poll-body\">\n  <!-- Poll with loading spin -->\n  <div class=\"sh-poll\" data-total=\"true\" data-count=\"true\">\n    <div class=\"sh-loading\"></div>\n  </div>\n\n  <!-- Map and demographics appear under poll post-vote -->\n  <div class=\"demo-container sh-post-vote\">\n    <div class=\"sh-demo\" data-demo=\"age\" data-postvote=\"true\"></div>\n    <div class=\"sh-demo\" data-demo=\"gender\" data-postvote=\"true\"></div>\n    <div class=\"sh-demo relation-demo\" data-demo=\"relationship status\" data-postvote=\"true\"></div>\n  </div>\n  <!-- Display the world map results post-vote. To switch to U.S. map, replace \"world\" with \"us\" -->\n  <div class=\"sh-map\" data-coloring=\"lightness\" data-map=\"world\" data-zoom=\"true\"  data-postvote=\"true\"></div>\n</div>"));
      $wpdb->insert($table_name, array(
        'creation' => current_time('mysql'),
        'name' => 'Old School Flash Style',
        'template' => "<!-- The style of this widget mimics SodaHead's previous flash widget -->\n<style>\n.sh-template-5 {\n\ttext-align: left;\n\twidth: 250px;\n\tbackground: #10425f;\n        padding: 10px 5px 5px;\n        color: white!important;\n}\n\n.sh-template-5 .sh-total-votes{\n  font-size: 11px;\n  margin-top: 5px;\n}\n\n.sh-template-5 h3 {\n\tfont-weight: bold;\n\tfont-size: 16px;\n\tcolor: white;\n\tmargin-bottom: 10px;\n\tline-height: 1.22;\n}\n\n.sh-template-5  button {\n\ttext-align: left;\n\tfont-family: sans-serif;\n\theight: 50px;\n\tbackground-color: inherit;\n\tborder: 1px solid rgba(255,255,255, .1);\n\tborder-radius: 20px;\n\tpadding-left: 20px;\n}\n\n.sh-template-5 button:hover {\n         transition: background-color 300ms;\n         -webkit-transition: background-color 300ms;\n\tbackground-color: rgba(255,255,255, .2);\n}\n\n.sh-template-5 .sh-poll-voted {\n\tfont-style: italic;\n}\n\n.sh-template-5 .sh-poll-answer-title {\n\tfont-size: 14px;\n\tcolor: white;\n\tfont-family: sans-serif;\n\tmargin-left: 10px;\n}\n\n.sh-template-5 .sh-poll-answer-bar-container {\n\twidth: 75%;\n\tmargin-left: 20px;\n\theight: 10px;\n\t-webkit-box-shadow: inset 5px 10px 0px 0px rgba(0,0,0,0.1);\n\t-moz-box-shadow: inset 5px 10px 0px 0px rgba(0,0,0,0.1);\n\tbox-shadow: inset -1px -1px 0px 0px rgba(155,155,155,0.5);\n}\n\n.sh-template-5 .widgetFooter {\n\t\tbackground: #fff url('http://widgets.sodahead.com/images/flash/footerGradient.gif') repeat-x scroll bottom center;\n\t\tborder: 1px solid #e6e6e6;\n\t\tfont-size: 0;\n\t\theight: 13px;\n\t\tline-height: 13px;\n\t\tpadding: 0 3px;\n\t\ttext-align: left;\n\t\tleft: 0;\n\t\tright: 0;\n\t\tbottom: 0;\n}\n</style>\n<div class=\"sh-poll\" id=\"poll37\" data-count=\"true\" data-total=\"true\"></div>"));
    }

    $table_name = $wpdb->prefix . "sodahead_user";
    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name){
      $old_user = $wpdb->get_row( "select * from $table_name");
      update_option('sh_old_token', $old_user->token);
    }
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget($args, $instance) {
    global $wpdb;

    $is_flyout = apply_filters('sodahead_widget', $instance['is_flyout']);
    $poll_id = apply_filters('sodahead_widget', $instance['poll_id']);
    $template_id = apply_filters('sodahead_widget', $instance['template_id']);
    $title = apply_filters('sodahead_widget', $instance['title']);
    if($poll_id == 'Latest' || $poll_id == 'Random'){
      if($poll_id == 'Random') $limit = 10;
      $author_id = get_option('sh_user_id');
      $poll_id = false;
    }

    if(!(bool)$template_id) $template_id = get_option('sh_default_template_id');
    if(get_option('sh_freq_on')){
      $freq = get_option('sh_freq_time', 0) * get_option('sh_freq_unit', 0);
      $imp = get_option('sh_freq_imp', 1);
    }

    $table_name = $wpdb->prefix . "sodahead_templates";
    $template = $wpdb->get_row("select * from $table_name where id = $template_id");

    # if couldn't find template, fallback on default template
    if(!$template)
      $template = $wpdb->get_row("select * from $table_name where id = " .
        get_option('sh_default_template_id'));

    echo $args['before_widget'];
    if ((bool)$poll_id || (bool)$author_id){
      echo $args['before_poll_id'];
      include('include/sodahead_widget.php');
      echo $ars['after_poll_id'];
    }
    echo $args['after_widget'];
  }


  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form($instance) {
    global $wpdb;
    if (isset($instance['is_flyout']))
      $is_flyout = $instance['is_flyout'];
    else
      $is_flyout = '';
    if (isset($instance['template_id']))
      $template_id = $instance['template_id'];
    else
      $template_id = '';
    if (isset($instance['title']))
      $title = $instance['title'];
    else
      $title = '';
    if (isset($instance['poll_id']))
      $poll_id = $instance['poll_id'];
    else
      $poll_id = '';
    $table_name = $wpdb->prefix . "sodahead_templates";
    $templates = $wpdb->get_results( "SELECT id, name, creation FROM $table_name" );
    include('include/sodahead_widget_form.php');
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['is_flyout'] = (!empty($new_instance['is_flyout'])) ? strip_tags($new_instance['is_flyout']) : '';
    $instance['template_id'] = (!empty($new_instance['template_id'])) ? strip_tags($new_instance['template_id']) : '';
    $instance['poll_id'] = (!empty($new_instance['poll_id'])) ? strip_tags($new_instance['poll_id']) : '';
    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

    return $instance;
  }

} // class Widget

// shortcode interpreter
function sodahead_shortcode_poll($kwargs){
  global $wpdb;
  $default_template_id = get_option('sh_default_template_id');
  extract(shortcode_atts( array(
    'poll_id'=> false,
    'template_id'=> $default_template_id
  ), $kwargs));
  if($poll_id){
    $table_name = $wpdb->prefix . "sodahead_templates";
    $template = $wpdb->get_row( "select * from $table_name where id = $template_id");
    if(!$template){
      $template = $wpdb->get_row(
        "select * from $table_name where id = $default_template_id");
    }
    $link = '';
    if(current_user_can('manage_options'))
      $link = '<div class="sh-edit-template"><a href="'. admin_url() .'admin.php?page=sh_menu_options_template_edit&template_id='. $template->id .'">edit poll template</a></div>';
    include('include/sodahead_widget_js.php');
    return "<div class=\"sh-poll-box sh-poll-post sh-template-$template->id\" ".
      "data-pollid=\"$poll_id\" " .
      ($template->display_results ? ' data-results="true"' : '') . '>' .
      $template->template . $link . '</div>';
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
