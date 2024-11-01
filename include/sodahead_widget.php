<?php if($is_flyout){ ?>
<script>
!function(){
  var div = document.createElement('div');
  div.className="sh-flyout-box sh-template-<?php echo $template->id ?>";
  <?php if($poll_id){
    echo "\ndiv.setAttribute('data-pollid', $poll_id);";
  }else{
    echo "\ndiv.setAttribute('data-authorid', $author_id);";
    if($limit)
      echo "\ndiv.setAttribute('data-limit', $limit);";
  }
  if($freq){
    echo "\ndiv.setAttribute('data-freq', '$freq');";
    echo "\ndiv.setAttribute('data-imp', '$imp');";
  }

  echo "\ndiv.setAttribute('data-top', '" .
    get_option('sh_flyout_display', 'comments') . "');";
  echo "\ndiv.setAttribute('data-bottom', " .
    get_option('sh_flyout_bottom', 20) . ");";
  echo "\ndiv.setAttribute('data-width', " .
    get_option('sh_flyout_width', 20) . ");";
  ?>
  div.innerHTML = <?php echo json_encode($template->template); ?>;
  document.body.appendChild(div);

  var evt, eventName = 'flyout_added';
  if(document.createEvent) {
    evt = document.createEvent("HTMLEvents");
    evt.initEvent(eventName, true, true);
    div.dispatchEvent(evt);
  }else{
    try{
      evt = document.createEventObject();
      div.fireEvent('on'+eventName);
    }catch(e){}
  }
}();
</script>
<?php }else{ ?>
<?php if((bool)$title){ ?>
<h3 class="widget-title"><?php echo $title; ?></h3>
<?php } ?>
<div class="sh-poll-box sh-poll-widget sh-template-<?php echo $template->id; ?>"
<?php
  if($poll_id)
    echo ' data-pollid="'. $poll_id . '"';
  else{
    echo ' data-authorid="' . $author_id . '"';
    if($limit)
      echo ' data-limit="' . $limit . '"';
  }
  if($template->display_results)
    echo ' data-results="true"';
?>
  >
  <?php echo $template->template; ?>
<?php
  if(current_user_can('manage_options')){
    echo '<div class="sh-edit-template"><a href="'. admin_url() .
      '/admin.php?page=sh_menu_options_template_edit&template_id=' .
      $template->id . '">edit poll template</a></div>';
  }
?>
</div>
<?php
  if(!current_user_can('manage_options')){
    echo '<a style="font-size:10px" target="_blank" ' .
      'href="http://wordpress.org/plugins/sodahead-polls/">';
    if(rand(0,1)) echo "WordPress Poll by ";
    else echo "Poll plugin by ";
    echo '<img src="' . plugin_dir_url(__FILE__) . '../img/logo.png" ' .
       'title="SodaHead" style="vertical-align: middle; margin-left: 4px;">' .
        '</a>';
  }
}
?>
<?php include('sodahead_widget_js.php'); ?>
