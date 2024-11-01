<?php

function sodahead_help($contextual_help, $screen_id, $screen) {
  if ($screen_id == 'polls_page_sh_menu_options_settings') {
    $screen->add_help_tab(array(
      'id' => 'account',
      'title' => 'Account',
      'content' => '<p>SodaHead Polls creates a link with your user '.
        'account on SodaHead.com. WordPress will remember your credentials '.
        'and authenticate you after you\'ve logged in. You can '.
        '<strong>Disconnect</strong> this relationship and connect with a '.
        'different SodaHead account at any time.</p><p>SodaHead Polls displays '.
        'polls and allow creating polls associated with the connected '.
        'account. You may reference any poll by a specific Poll ID '.
        'regardless of authentication.</p>'
    ));
    $screen->add_help_tab(array(
      'id' => 'flyout',
      'title' => 'Flyout',
      'content' => '<p>SodaHead Polls offers a Flyout option, which '.
        'displays a poll as an overlay that slides out of the side over the '.
        'page. Add a Flyout by adding the <strong>SodaHead Polls</strong> '.
        'widget in <strong>Appearance &gt; Widgets &gt; Sidebar</strong> and '.
        'clicking the <strong>Display as flyout</strong> option.<p> '.
        '<p>Flyouts work with any template -- you probably will want to '.
        'design a template specifically for use as a Flyout because of the '.
        'user experience.<p> <p>You can set when to <strong>Trigger '.
        'Display</strong> of the Flyout. Triggering the flyout <strong>When '.
        'user starts scrolling</strong> will generate more impressions of '.
        'the flyout than requiring the user to scroll to the bottom of the '.
        'page with <strong>When user reaches the footer</strong>.<p> <p>Set '.
        'a <strong>Frequency Cap</strong> to limit the number of times the '.
        'Flyout displays to an individual visitor. For instance, you may '.
        'only want to trigger the Flyout once per 2 minutes.<p>'));
    $screen->set_help_sidebar('<p><ul><li><a href="mailto:wp_support@sodahead.com" '.
      'target="_blank">Contact Support</a></li><li>' .
      '<a href="http://blog.sodahead.com/category/wordpress/" ' .
      'target="_blank">More Support</a></li></p>');
  }
  if ($screen_id == 'admin_page_sh_menu_options_poll_edit') {
    $screen->add_help_tab(array(
      'id' => 'general',
      'title' => 'General',
      'content' => '<p>You can make optional settings optional settings ' .
      'by clicking <strong>Edit poll</strong> to the right and editing your ' .
      'poll on SodaHead. These optional changes include adding images, '.
      'descriptions, "Read More" backlinks to your site, setting the close ' .
      'date, and more.</p>' .
      '<p>Click <strong>Hide Results</strong> to conceal the results from ' .
      'your audience.</p>'
    ));
    $screen->add_help_tab(array(
      'id' => 'poll_tips',
      'title' => 'Poll tips',
      'content' => '<ol><li><strong>Ask high-level questions.</strong>' .
        ' Don\'t make questions too specific. Ask about the broader topic '.
        'highlighted by a current event. For example, instead of asking <i>"Do '.
        'you like Kumquats more than Plums?"</i> you may ask <i>"Do you like ' .
        'to eat exotic fruits?"</i></li> <li><strong>Don\'t ask biased '.
        'questions.</strong> Phrase your question from an objective '.
        'standpoint so people from all sides of the discussion can '.
        'participate. For example, you don\'t want to ask a poll phrased "Is '.
        'Red the Best Color Ever?" and give only two answer choices: "(A) I '.
        'Love Red!" and "(B) I hate colors". Your poll won\'t do well and '.
        'you will lose out.</li> <li><strong>Have a daily poll.</strong> Create a '.
        'relationship with your audience so they visit daily. Write about '.
        'the results of the previous day\'s poll so they know their votes '.
        'matter. Voting only takes a few seconds, and your audience will '.
        'visit everyday just to participate and make their opinions '.
        'count.</li></ol>'));
    $screen->set_help_sidebar(
      '<p><a target="_blank" href="http://www.sodahead.com/user/login/?' .
      'next=/question/' . $_GET['poll_id'] .'/edit/">Edit poll</a></p>' .
      '<p><a href="//www.sodahead.com/my/questions/" target="_blank">' .
      'My polls</a></p>');
  }
  if ($screen_id == 'admin_page_sh_menu_options_template_edit') {
    $screen->add_help_tab(array(
      'id' => 'general',
      'title' => 'General',
      'content' => '<p> Customize your template with this editor. Load a '.
        '<strong>Standard Template</strong> to get started. Click on the '.
        '<strong>Poll</strong>, <strong>Map</strong> or <strong>'.
        'Demographics</strong> button to insert the macro into the template. '.
        'You have the option to arrange the poll elements and format them '.
        'using HTML. </p><p>You can insert multiple templates on a single '.
        'post.</p>'));
    $screen->add_help_tab(array(
      'id' => 'options',
      'title' => 'Options',
      'content' => '<p>Check the <strong>Display results only</strong> '.
        'box to show the results (poll, demographics and map) regardless if '.
        'the visitor has voted on the poll or if it has closed.</p><p>Check '.
        'the <strong>Set as default template</strong> box to set this template as '.
        'the "catchall" template. The default template will display when you '.
        'haven\'t specified a template, or have specified an invalid/deleted '.
        'template.</p><p>The <strong>Parent CSS Class</strong> value helps '.
        'if you want to use CSS in the editor. The SodaHead Poll Plugin '.
        'renders the template inside a parent DIV with this class.</p>'.
        '<p>Click <strong>Delete</strong> to permanently remove the '.
        'template from use. The Default template will display anytime '.
        'you\'ve specified to display a deleted template.</p>'));
    $screen->add_help_tab(array(
      'id' => 'poll',
      'title' => 'Poll',
      'content' => '<p>Check <strong>Display poll image</strong> to '.
        'display the question image. Add an image to a poll by using the '.
        'advanced options when editing a poll. Use CSS to customize how you '.
        'want to display the image.</p> <p>Each answer displays as a '.
        'percentage. Check <strong>Display vote count per answer</strong> to '.
        'additionally display the number of votes for each answer.</p> '.
        '<p>Check <strong>Display total votes</strong> to include the total '.
        'number of votes for the entire poll.</p>'));
    $screen->add_help_tab(array(
      'id' => 'map',
      'title' => 'Map',
      'content' => '<p>SodaHead Poll Plugin has very advanced mapping '.
        'features to help geographically display the results of your polls. '.
        'Select the type of map you want to display (e.g. United States, '.
        'World, etc...). </p>' .
        '<p>Coloring options allow displaying the results in one of three '.
        'formats: <ul>' .
        '<li><strong>Results gradient</strong> reflects the intensity of the '.
        'winning result in that region.</li>' .
        '<li><strong>Results flat</strong> same as previous but without '.
        'the gradient.</li>'.
        '<li><strong>Heat map</strong> reflects the number of voters in that '.
        'region regardless of results.</li>'.
        '</ul></p>'.
        '<p>Check the <strong>Display after voting</strong> box if you only want '.
        'to show the map after a visitor has voted. The map will display '.
        'regardless if you\'ve checked <strong>Display results only</strong> '.
        'in the <strong>Options</strong> at the top or if the poll has closed. '.
        '</p><p>Click '.
        '<strong>Insert Map</strong> to embed a DIV with the map. You can '.
        'customize that DIV with CSS.</p>'));
    $screen->add_help_tab(array(
      'id' => 'demographics',
      'title' => 'Demographics',
      'content' => '<p>SodaHead\'s Polls allows you to compare how '.
        'different demographics responded to a poll. Use the Demographics '.
        'sidebar tool to add the desired demographic(s) in your '.
        'template.</p> <p>First, select the <strong>demographic</strong> '.
        'category (e.g. Gender, Age, etc...).</p> <p>Second, select whether '.
        'you want to ask your visitor to identify his/her demographic or if '.
        'you want to display the results of a specific demographic.</p> '.
        '<p>If you select <strong>Display Results</strong>, you need to '.
        'select the exact demographic you want to display (e.g. Males, '.
        'Married, 18-24 year olds, etc...). This value helps if you want to '.
        'write in a post about the specific demographic results of an '.
        'earlier poll.</p> <p>Check the <strong>Display after '.
        'voting</strong> box if you only want to show the demographic after '.
        'a visitor has voted. The demographic will display regardless if '.
        'you\'ve checked <strong>Display results only</strong> in the '.
        'Options at the top or if the poll has closed.</p> <p>Click '.
        '<strong>Insert Demographic</strong> to embed a DIV with the '.
        'demographic element. You can customize that DIV with CSS.</p> '.
        '<p>You can embed any number of demographic elements into a '.
        'template. SodaHead Polls Plugin will remember the demographic of a '.
        'visitor who has provided that value.</p>'));
    $screen->add_help_tab(array(
      'id' => 'native_templates',
      'title' => 'Standard Templates',
      'content' => '<p>Loading a <strong>Standard Template</strong> '.
        'helps get you started '.
        'with some basic (or advanced) features -- but it does not allow you '.
        'to edit that template. Select the desired layout and click <strong>'.
        'Load Template</strong> to replace everything in the editor with ' .
        'the settings from the template you selected.</p> '.
        '<p><strong>CAUTION</strong>: '.
        'loading a Standard Template will clear everything in the current '.
        'editor area.</p>'));
    $screen->add_help_tab(array(
      'id' => 'css_html',
      'title' => 'CSS &amp; HTML',
      'content' => '<p>You can use CSS and HTML to design the layout of '.
        'the poll including colors, font, background, and more. When ' .
        'customizing the style of the elements contained in the template, ' .
        'use the value of <strong>Parent CSS Class</strong> to ensure '.
        'the modifications won\'t affect other elements on the page.</p>' .
        '<p>Add the class <strong>sh-pre-vote</strong> to any element you '.
        'want show before the visitor voted. Add the class <strong>' .
        'sh-post-vote</strong> to show element after the visitor has voted.' .
        '</p><p>Review the methods used in the Standard Templates for ideas.</p>' .
        '<p>Confused? <a href="http://blog.sodahead.com/?p=90">Ask us to customize' .
        '</a> a template for you, or visit our blog for newly added '.
        '<a href="http://blog.sodahead.com/tag/templates/" target="_blank">'.
        'poll templates</a>.'
      ));
    $screen->set_help_sidebar('<p><ul><li>' .
    '<a href="http://blog.sodahead.com/?p=90" target="_blank">' .
    'Custom Template Request</a></li><li>' .
    '<a href="http://blog.sodahead.com/tag/templates/" target="_blank">' .
    'New Templates</a></li></ul></p>');
  }
}

// register widget
function sodahead_register_widget() {
    register_widget('SH_Poll_widget');
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
