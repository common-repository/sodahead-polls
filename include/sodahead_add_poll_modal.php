<div id="sh_template_modal" style="display: none;">
  <p style="font-weight: bold">
    1. <a href="/wp-admin/admin-ajax.php?action=sodahead_ask" style="color: #21759b;" onclick="javascript:void window.open(this.href,'1380329618328','width=200,height=200');return false;">Ask a new question</a>, or select a previously created one...
  </p>
  <div style="margin: 5px 0;">
    <select style="height: 180px;width: 100%" size=10 id="id_sh_poll_id"></select>
    <a href="#" id="id_sh_poll_id_next"
       style="float: right">
      next polls &gt;
    </a>
    <a href="#" id="id_sh_poll_id_previous">
      &lt; previous polls
    </a>
  </div>
  <p style="font-weight: bold">2. Select a poll design...</p>
  <div style="margin: 5px 0;">
    <select style="width: 100%" id="id_sh_template_id">
      <option value="">-- Default Template --</option>
      <?php foreach ($templates as $template) { ?>
        <option value="<?php echo $template->id; ?>" <?php
          if($template_id == $template->id) echo 'selected="selected"'; ?>>
          <?php echo $template->name; ?>
        </option>
      <?php } ?>
    </select>
  </div>
  <div>
    <input type="button" id="id_sh_insert_poll" value="Insert Poll"
    style="float: right;">
  </div>
</div>
<script>
  var SH_Q = window.SH_Q || [];
  SH_Q.push(function(){
    SodaHead.fill_poll_list("<?php echo get_option('sh_user_id'); ?>",
      "id_sh_poll_id", -1);
    SodaHead.subscribe('poll_created', function(poll_id){
      SodaHead.fill_poll_list(<?php echo get_option('sh_user_id'); ?>,
        "id_sh_poll_id", poll_id);
    });
  });
</script>
