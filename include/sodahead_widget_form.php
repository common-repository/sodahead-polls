<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
  <input type="text" name="<?php echo $this->get_field_name("title") ?>"
    id="<?php echo $this->get_field_id("title"); ?>"
    value="<?php echo esc_attr($title); ?>">
</p>

<p>
  <?php _e('Poll to display:'); ?>
  <strong id="<?php echo $this->get_field_id('poll_id'); ?>_question_title">
  <?php
    if ((bool)$poll_id)
      echo esc_attr($poll_id);
    else
      echo 'Disabled';
  ?>
  </strong>
  <a href="#" id="<?php echo $this->get_field_id('poll_id'); ?>_change">[change]</a>
  <div id="<?php echo $this->get_field_id('poll_id'); ?>_questions"<?php
    echo (bool)$poll_id;
    if($poll_id) echo ' style="display:none"';
  ?>>
   <a style="float: right" href="/wp-admin/admin-ajax.php?action=sodahead_ask" onclick="javascript:void window.open(this.href,'1380329618328','width=200,height=200');return false;">Ask a new question</a>
    <select class="widefat" id="<?php echo $this->get_field_id('poll_id'); ?>"
           size=10 style="height: 150px"
           name="<?php echo $this->get_field_name('poll_id'); ?>"
           type="text" value="<?php echo esc_attr($poll_id); ?>">
      <option value="">-- Disabled --</option>
    </select>
    <a href="#" id="<?php echo $this->get_field_id('poll_id'); ?>_next"
       style="float: right">
      next &gt;
    </a>
    <a href="#" id="<?php echo $this->get_field_id('poll_id'); ?>_previous">
      &lt; previous
    </a>
  </div>
</p>
<p>
  <label>
  <input name="<?php echo $this->get_field_name('is_flyout'); ?>"
         type="checkbox" value="1" <?php
    if($is_flyout) echo 'checked="checked"';
  ?>> Display as a flyout
    <a href="<?php echo admin_url(); ?>admin.php?page=sh_menu_options_settings">
      settings
    </a>
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('template_id'); ?>">
    <a style="float: right" href="<?php echo admin_url();
      ?>admin.php?page=sh_menu_options_template_edit&template_id=<?php
        if($template_id)
          echo $template_id;
        else
          echo get_option('sh_default_template_id');
      ?>"
      id="<?php echo $this->get_field_id('template_id'); ?>_link">edit template</a>
    <?php _e('Template:'); ?>
  </label>
  <select class="widefat" id="<?php echo $this->get_field_id('template_id'); ?>"
         name="<?php echo $this->get_field_name('template_id'); ?>"
         type="text" value="<?php echo esc_attr($template_id); ?>">
    <option value="">-- Default Template --</option>
    <?php foreach ($templates as $template) { ?>
      <option value="<?php echo $template->id; ?>" <?php
        if($template_id == $template->id) echo 'selected="selected"'; ?>>
        <?php echo $template->name; ?>
      </option>
    <?php } ?>
  </select>
</p>

<script>
  document.getElementById('<?php
    echo $this->get_field_id('template_id'); ?>').onchange=update_template_link;
  function update_template_link(){
    var t_id = this.value || <?php echo get_option('sh_default_template_id'); ?>;
    document.getElementById("<?php echo $this->get_field_id('template_id'); ?>_link")
     .href = "<?php echo admin_url(); ?>admin.php?page=sh_menu_options_template_edit&template_id=" + t_id;
  }
  update_template_link();
  var sh_fill_poll_list_options = [
   {text: '-- Disabled --',
    value: ''},
   {text: '-- Random Recent Poll --',
    value: 'Random'},
   {text: '-- Latest Poll --',
    value: 'Latest'}
  ];
  SodaHead.fill_poll_list(
    "<?php echo get_option('sh_user_id'); ?>",
    "<?php echo $this->get_field_id('poll_id'); ?>",
    "<?php echo esc_attr($poll_id); ?>", sh_fill_poll_list_options);

  SodaHead.subscribe('poll_created', SodaHead.fill_poll_list,
    ["<?php echo get_option('sh_user_id'); ?>",
     "<?php echo $this->get_field_id('poll_id'); ?>",
     null, sh_fill_poll_list_options]);

  if(/^\d+$/.test("<?php echo esc_attr($poll_id); ?>")){
    SodaHead.poll_cache().get_poll("<?php echo esc_attr($poll_id); ?>",
      function(poll){
        var poll_title = document.getElementById("<?php
          echo $this->get_field_id('poll_id'); ?>_question_title");
        poll_title.innerHTML = poll.title;
      }
    );
  }
  document.getElementById('<?php
    echo $this->get_field_id('poll_id'); ?>_change').onclick = function(){
    document.getElementById('<?php
      echo $this->get_field_id('poll_id');
      ?>_questions').style.display = '';
    return false;
  };
  document.getElementById('<?php
    echo $this->get_field_id('poll_id'); ?>').onchange = function(){
    document.getElementById('<?php
      echo $this->get_field_id('poll_id');
      ?>_questions').style.display = 'none';
    if(/^\d+$/.test(this.value)){
      SodaHead.poll_cache().get_poll(this.value,
        function(poll){
          var poll_title = document.getElementById("<?php
            echo $this->get_field_id('poll_id'); ?>_question_title");
          poll_title.innerHTML = poll.title;
        }
      );
    }else{
      var poll_title = document.getElementById("<?php
        echo $this->get_field_id('poll_id'); ?>_question_title");
      poll_title.innerHTML = this.value ? this.value : 'Disabled';
    }
  };
</script>
