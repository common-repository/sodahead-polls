<style>
  #post-body.columns-2 #side-sortables {
    min-height: initial !important;
  }
  #poststuff h3, .metabox-holder h3 {
    font-weight: bold;
  }
</style>
<div class="wrap">
  <div id="icon-options-general" class="icon32"><br></div>
  <h2>Settings for SodaHead Polls</h2>
  <?php
    if($message){
      echo '<div id="message" class="updated below-h2"><p>';
      echo $message;
      echo '</p></div>';
    }
  ?>
  <div id="poststuff">
    <div id="post-body" class="metabox-holder columns-2">
      <div id="post-body-content">
        <h3>Account</h3>
        <table class="form-table">
          <tbody>
            <tr valign="top">
              <th scope="row">Login status</th>
              <td>
                <?php if(get_option('sh_user_id')){ ?>
                  You are currently authenticated. &nbsp;
                  <a class="button" href="<?php echo admin_url(); ?>admin-ajax.php?action=sodahead_auth&sh_action=sh_logout&action_key=<?php echo get_option('sh_action_key'); ?>" onclick="javascript:void window.open(this.href,'138029618328','width=200,height=200');return false;">Disconnect</a>
                <?php }else{ ?>
                  Connect to see your polls. &nbsp;
                  <a class="button" href="<?php echo admin_url(); ?>admin-ajax.php?action=sodahead_auth&sh_action=login&action_key=<?php echo get_option('sh_action_key'); ?>" onclick="javascript:void window.open(this.href,'138029618328','width=200,height=200');return false;">Authenticate</a>
                <?php } ?>
              </td>
            </tr>
            <?php if(get_option('sh_old_token')){
              echo '<tr valign="top"><th scope="row">Account Migration from 2.x'.
              '</th><td>' .
              '<a href="mailto:wp_support@sodahead.com?subject=Wordpress%20account%20recovery&body=token:%20'. get_option('sh_old_token') .'" target="_blank">Mail us</a> this information to recover your previous account:' .
              '<br>token:' .  get_option('sh_old_token') .
              '</td></tr>';
            }
            ?>
            <tr valign="top">
              <th scope="row"></th>
              <td>
                <a href="http://www.sodahead.com/forgot/password/" target="_blank">
                  Password recovery
                </a>
              </td>
            </tr>
          </tbody>
        </table>
        <h3>Miscellaneous</h3>
        <table class="form-table">
          <tbody>
            <tr valign="top">
              <th scope="row">Local cache</th>
              <td>
                <span id="id_local_cache_status"></span>
                <a href="#" onclick="SodaHead.flush_cache();return false;"
                   class="button"
                   id="id_flush_cache_button" style="display: none">
                  Flush cache
                </a>
                <div id="id_flush_cache_help" style="display: none">
                  You might want to flush cache if a recently created poll is not
                  visible in your listing.
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <form method="post">
          <h3>Flyout</h3>
          <table class="form-table">
            <tbody>
              <tr valign=top>
                <th scope="row">Width</th>
                <td>
                  <select name="width">
                    <option value="200" <?php
                      if($width == 200) echo "selected"; ?>>
                      Small (200px)
                    </option>
                    <option value="300" <?php
                      if($width == 300) echo "selected"; ?>>
                      Medium (300px)
                    </option>
                    <option value="500" <?php
                      if($width == 500) echo "selected"; ?>>
                      Large (500px)
                    </option>
                  </select>
                </td>
              </tr>
              <tr valign=top>
                <th scope="row">Display</th>
                <td>
                  <select name="display">
                    <option value="10" <?php
                      if($display == 10) echo "selected"; ?>>
                      When user starts scrolling
                    </option>
                    <option value="comment" <?php
                      if($display == 'comment') echo "selected"; ?>>
                      When user reaches the comments
                    </option>
                    <option value="footer" <?php
                      if($display == 'footer') echo "selected"; ?>>
                      When user reaches the footer
                    </option>
                  </select>
                </td>
              </tr>
              <tr valign=top>
                <th scope="row">Position from bottom</th>
                <td>
                  <input type="text" name="bottom" size=3 placeholder="20" <?php
                    echo "value=\"$bottom\""; ?> required pattern="^\d+$" maxlength=3>
                  pixels
                </td>
              </tr>
              <tr valign=top>
                <th scope="row">
                  <label>
                    <input type="checkbox" id="frequency_cap" name="freq"
                    <?php if($freq_on) echo "checked"; ?>>
                    Frequency Cap
                  </label>
                </th>
                <td>
                  <input type="text" name="impression" pattern="^\d+$" size=5
                    maxlength=3 value="<?php echo $freq_imp?>">
                  impressions per
                  <input type="text" name="time" pattern="^\d+$" size=5
                    maxlength=3 value="<?php echo $freq_time?>">
                  <select name="unit">
                    <option value="60" <?php
                      if($freq_unit == 60) echo "selected"; ?>>
                      minutes
                    </option>
                    <option value="3600" <?php
                      if($freq_unit == 3600) echo "selected"; ?>>
                      hours
                    </option>
                    <option value="86400" <?php
                      if($freq_unit == 86400) echo "selected"; ?>>
                      days
                    </option>
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
          <p class="submit">
            <input type="submit" name="submit" id="submit"
                   class="button button-primary" value="Save Changes">
          </p>
        </form>
      </div>
      <div id="postbox-container-1" class="postbox-container">
        <div id="side-sortables" class="meta-box-sortables ui-sortable">
          <div id="contact_us" class="postbox">
            <div class="handlediv" title="Click to toggle"><br></div>
            <h3 class="hndle"><span>Contact Us</span></h3>
            <div class="misc-pub-section">
              email support
              <a href="mailto:wp_support@sodahead.com" target="_blank">
                wp_support@sodahead.com
              </a>
            </div>
            <div class="clear"></div>
          </div>
          <div id="enjoy_sh" class="postbox">
            <div class="handlediv" title="Click to toggle"><br></div>
            <h3 class="hndle"><span>Enjoy SodaHead Polls?</span></h3>
            <div class="misc-pub-section">
              <p style="line-height: 18px;">
              Why not consider giving us a
              <a href="http://wordpress.org/plugins/sodahead-polls/" target="_blank">
              5-star rating on WordPress.org
              </a>. Thanks.
              </p>
              <div class="clear"></div>
            </div>
          </div>
          <div id="enjoy_sh" class="postbox">
            <div class="handlediv" title="Click to toggle"><br></div>
            <h3 class="hndle"><span>Stay Connected</span></h3>
            <div class="misc-pub-section">
              <div class="g-follow" data-annotation="bubble" data-height="24"
              data-href="https://plus.google.com/105489771528273222938"
              data-rel="publisher"></div>
            </div>
            <div class="misc-pub-section">
              <div class="fb-like" data-href="http://facebook.com/sodahead"
                   data-width="250" data-layout="standard" data-action="like"
                   data-show-faces="true" data-share="false"></div>
            </div>
            <div class="misc-pub-section">
              <a href="https://twitter.com/SodaHead" class="twitter-follow-button"
                 data-show-count="false" data-size="large" data-dnt="true">
                 Follow @SodaHead
              </a>
              <div class="clear"></div>
            </div>
          </div>
        </div>
        <script>
        (function() {
         var po = document.createElement('script');
         po.src = 'https://apis.google.com/js/plusone.js';
         var s = document.getElementsByTagName('script')[0];
         s.parentNode.insertBefore(po, s);
         })();
          !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='//platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
          (function(d, s, id) {
           var js, fjs = d.getElementsByTagName(s)[0];
           if (d.getElementById(id)) return;
           js = d.createElement(s); js.id = id;
           js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=351543254990469";
           fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));
        </script>
      </div>
    </div>
  </div>
</div>
<script>
  SH_Q = window.SH_Q || [];
  SH_Q.push(function(){
    SodaHead.subscribe('authed', function(){location.reload();});
    if(SodaHead.has_cache()){
      document.getElementById('id_local_cache_status').innerHTML = '';
      document.getElementById('id_flush_cache_button').style.display = '';
      document.getElementById('id_flush_cache_help').style.display = '';
    }else{
      document.getElementById('id_local_cache_status').innerHTML = 'Your web ' +
        'browser doesn\'t support this feature';
    }
  });
</script>
