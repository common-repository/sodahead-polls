<style>
  input.small-input{
    border: 1px solid #aaa;
    border-radius: 2px;
    width: 17px;
  }
  input.error {
    border-color: #953b39;
  }
  input.answer-input {
    padding: 4px 8px;
    font-size:1.2em;
    line-height:100%;
    width: 100%;
    outline: 0;
    margin: 1px 0;
  }
  .form-line{
    margin: 10px 0 5px 0;
  }
  .sh-poll h3{
    display: none;
  }
  #totalVotes{
    float: right;
    font-style: italic;
  }
  .sh-poll-answer-title span{
    font-style: italic;
  }
</style>
<div class="wrap">
  <h2>
    Edit Poll
  </h2>
  <iframe style="display:none" name="sh-root-iframe" id="sh-root-iframe"></iframe>
  <form method="post" action="<?php echo $SODAHEAD_ROOT; ?>/edit/<?php
    echo $poll_id; ?>/" id="id_poll_form" target="sh-root-iframe">
    <?php
      if(is_user_logged_in()){
        printf('<input type="hidden" name="token" value="%s">',
          get_option('sh_token'));
        printf('<input type="hidden" name="secret" value="%s">',
          get_option('sh_secret'));
      }
    ?>
    <input type="hidden" name="domain" value="" id="id_domain">
    <input type="hidden" name="protocol" value="" id="id_protocol">
    <input type="hidden" name="category" value="" id="category">
    <div id="poststuff">
      <div id="post-body" class="metabox-holder columns-2">
        <div id="post-body-content">
          <div id="titlediv" class="form-line" style="margin-bottom: 20px">
            <div id="titlewrap">
              <input type="text" id="title" name="title" required="required"
                  placeholder="Template Title..." value="">
            </div>
          </div>
          <div class="form-line">
            <input type="text" id="answer_01" name="answer_01"
              class="answer-input" placeholder="Answer (Required)"
              required="required">
          </div>
          <div class="form-line">
            <input type="text" id="answer_02" name="answer_02"
              class="answer-input" placeholder="Answer (Required)"
              required="required">
          </div>
          <div class="form-line">
            <input type="text" id="answer_03" name="answer_03"
              class="answer-input" placeholder="Answer (Optional)">
          </div>
          <div class="form-line">
            <input type="text" id="answer_04" name="answer_04"
              class="answer-input" placeholder="Answer (Optional)">
          </div>
          <div class="form-line">
            <input type="text" id="answer_05" name="answer_05"
              class="answer-input" placeholder="Answer (Optional)">
          </div>
          <div class="form-line">
            <input type="text" id="answer_06" name="answer_06"
              class="answer-input" placeholder="Answer (Optional)">
          </div>
          <div class="form-line">
            <input type="text" id="answer_07" name="answer_07"
              class="answer-input" placeholder="Answer (Optional)">
          </div>
          <div class="form-line">
            <input type="text" id="answer_08" name="answer_08"
              class="answer-input" placeholder="Answer (Optional)">
          </div>
          <div class="form-line">
            <input type="text" id="answer_09" name="answer_09"
              class="answer-input" placeholder="Answer (Optional)">
          </div>
        </div>
        <div id="postbox-container-1" class="postbox-container">
          <div id="side-sortables" class="meta-box-sortables ui-sortable">
            <div id="save_poll" class="postbox">
              <div class="handlediv" title="Click to toggle"><br></div>
              <h3 class="hndle"><span>Options</span></h3>
              <div class="misc-pub-section">
                Created on: <strong id="creation_date"></strong>
              </div>
              <div class="misc-pub-section">
                <label>
                  <input value="y" type="checkbox" name="hideResults"
                    id="hideResults"> Hide results
                </label>
              </div>
              <div id="major-publishing-actions">
                <div id="delete-action">
                  <a class="submitdelete deletion"
                     onclick="javascript:void window.open(this.href,'1380329618328','width=400,height=300');return false;"
                     href="admin-ajax.php?action=sodahead_delete&poll_id=<?php echo $poll_id; ?>">Delete</a>&nbsp;
                  <a class="submitdelete deletion" href="http://www.sodahead.com/user/login/?next=/question/<?php echo $poll_id; ?>/edit/" target="blank">
                  Advanced options
                  </a>
                </div>
                <div id="publishing-action">
                  <span class="spinner" id="save_spinner"></span>
                  <input type="hidden" value="edit" name="action">
                  <input type="submit" value="Save Poll" id="save_button"
                         class="button button-primary button-large">
                </div>
                <div class="clear"></div>
              </div>
            </div>
            <div id="map_poll" class="postbox">
              <div class="handlediv" title="Click to toggle"><br></div>
              <h3 class="hndle">
                <span id="totalVotes"></span>
                <span>Results</span>
              </h3>
              <div class="misc-pub-section">
                <div data-results="true" class="sh-poll-box"
                     data-pollid="<?php echo $poll_id ?>">
                  <div data-count="true" class="sh-poll"></div>
                </div>
              </div>
            </div>
            <div id="map_poll" class="postbox">
              <div class="handlediv" title="Click to toggle"><br></div>
              <h3 class="hndle"><span>Map</span></h3>
              <div class="misc-pub-section">
                <div data-results="true" class="sh-poll-box"
                     data-pollid="<?php echo $poll_id ?>">
                  <div class="sh-map"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<script>
  SH_Q = window.SH_Q || [];
  SH_Q.push(function(){
    function get(x){ return document.getElementById(x);}
    var cache = SodaHead.poll_cache(<?php echo get_option('sh_user_id'); ?>);
    cache.get_poll(<?php echo $poll_id ?>, fill_form);
    SodaHead.subscribe('error', function(fields){
      clear_errors();
      for (var i = 0 ; i < fields.length; i++){
        get(fields[i]).className += ' error';
      }
      get('save_spinner').style.display = '';
      get('save_button').value = 'Save Poll';
      get('save_button').removeAttribute('disabled');
    });
    function clear_errors(){
      var fields = document.getElementsByClassName('error');
      for(var i = 0; i < fields.length ; i++){
        fields[i].className.replace(/(^| )error($| )/, '');
      }
    }
    SodaHead.subscribe('poll_deleted', function(poll_id){
      SodaHead.flush_cache();
      location.search = "page=sh_menu_options";
    });
    SodaHead.subscribe('poll_edited', function(poll_id){
      SodaHead.flush_cache();
      location.reload();
    });
    function fill_form(poll){
      get('title').value = poll.title;
      get('category').value = poll.category.id;
      if(poll.hideResults){
        get('hideResults').checked = 'checked';
      }
      for(var i = 0; i < poll.answers.length; i++){
        get('answer_0' + (i+1)).value = poll.answers[i].title;
      }
      for(; i < 9 ; i++){
        get('answer_0' + (i+1)).style.display = 'none';
      }
      get('creation_date').innerHTML = poll.creationDate;
      get('totalVotes').innerHTML = poll.totalVotes + ' votes';
    }
    get('id_poll_form').onsubmit = function(){
      get('save_spinner').style.display = 'inline-block';
      get('save_button').value = 'Saving...';
      get('save_button').setAttribute('disabled', 'disabled');
    };
    get('id_domain').value = location.host;
    get('id_protocol').value = location.protocol;
  });

</script>
