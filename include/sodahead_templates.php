<div class="wrap">
  <h2>
    <a href="http://blog.sodahead.com/?p=90" target="_blank"
      style="float: right; font-size: .5em">
      Want a Custom Template? Let us create one for you!
    </a>
    Manage Templates
    <a href="?page=sh_menu_options_template_edit" class="add-new-h2">
      Add New
    </a>
  </h2>
  <table class="wp-list-table widefat">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Creation</th>
        <th>Default</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Creation</th>
        <th>Default</th>
      </tr>
    </tfoot>
    <tbody>
      <?php foreach ($templates as $template) { ?>
        <tr>
          <td>
            <?php echo $template->id; ?>
          </td>
          <td>
            <?php echo $template->name ?>
            <div class="row-actions">
              <a href="?page=sh_menu_options_template_edit&template_id=<?php echo $template->id; ?>">Edit</a>
              <?php if(get_option("sh_default_template_id") != $template->id){ ?>
              |
              <a onclick="return confirm('Delete this template?');" href="admin-ajax.php?action=sodahead_template_delete&template_id=<?php echo $template->id; echo "&action_key=" . get_option('sh_action_key'); ?>">Delete</a>
              <?php } ?>
            </div>
          </td>
          <td><?php echo $template->creation; ?></td>
          <td><?php
            if(get_option('sh_default_template_id') == $template->id)
              echo "<strong>Default</strong>";
          ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

