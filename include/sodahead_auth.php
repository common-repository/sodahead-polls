<html>
  <head>
  </head>
  <body>
    <form action="<?php echo $SODAHEAD_ROOT; ?>/auth/" method="post">
      <?php
        if ( is_user_logged_in() ) {
          printf('<input type="hidden" name="token" value="%s">',
            get_option('sh_token'));
          printf('<input type="hidden" name="secret" value="%s">',
            get_option('sh_secret'));
        }
      ?>
      <input type="hidden" name="action" value="<?php echo $action; ?>">
      <input type="hidden" name="domain" value="" id="id_domain">
      <input type="hidden" name="protocol" value="" id="id_protocol">
    </form>
    <script>
      document.getElementById('id_domain').value = location.host;
      document.getElementById('id_protocol').value = location.protocol;
      document.forms[0].submit();
    </script>
  </body>
</html>
