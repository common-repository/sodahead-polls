<html>
  <head>
    <title>Confirm Poll Deletion</title>
    <script src="/wp-content/plugins/sodahead-polls/js/script.js?ver=3.7"></script>
    <style>
      body{
        font-family: arial, sans;
      }
      .warning {
        margin: 0 auto;
        display: block;
        font-size: 16px;
        padding: 5px 10px;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <h1>Delete Poll?</h1>
    <p>Are you sure you want to delete <strong id="poll_title"></strong>. This operation cannot be undone
    </p>
    <form action="<?php echo $SODAHEAD_ROOT; ?>/delete/<?php
      echo $poll_id ?>/" method="post">
      <?php
        if ( is_user_logged_in() ) {
          printf('<input type="hidden" name="token" value="%s">',
            get_option('sh_token'));
          printf('<input type="hidden" name="secret" value="%s">',
            get_option('sh_secret'));
        }
      ?>
      <input type="submit" value="Confirm Poll Deletion" class="warning">
      <input type="hidden" name="domain" value="" id="id_domain">
      <input type="hidden" name="protocol" value="" id="id_protocol">
    </form>
    <script>
      document.getElementById('id_domain').value = location.host;
      document.getElementById('id_protocol').value = location.protocol;
      SH_Q = window.SH_Q || [];
      SH_Q.push(function(){
        var cache = SodaHead.poll_cache(<?php echo get_option('sh_user_id'); ?>);
        cache.get_poll(<?php echo $poll_id ?>, function(poll){
          document.getElementById('poll_title').innerHTML = poll.title;
        });
      });
    </script>
  </body>
</html>
