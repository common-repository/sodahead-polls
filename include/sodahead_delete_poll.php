<html>
  <head>
  </head>
  <body>
    <form action="<?php echo $SODAHEAD_ROOT; ?>/delete/
      <?php echo poll_id ?>" method="post">
      <?php
        if ( is_user_logged_in() ) {
          printf('<input type="hidden" name="token" value="%s">',
            get_option('sh_token'));
          printf('<input type="hidden" name="secret" value="%s">',
            get_option('sh_secret'));
        }
      ?>
      <input type="submit" value="Confirm Poll deletion">
      <input type="hidden" name="domain" value="" id="id_domain">
      <input type="hidden" name="protocol" value="" id="id_protocol">
    </form>
    <script>
      document.getElementById('id_domain').value = location.host;
      document.getElementById('id_protocol').value = location.protocol;
    </script>
  </body>
</html>
