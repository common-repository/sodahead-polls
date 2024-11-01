<style>
  #id_demo_title{
    text-transform: lowercase;
    color: black;
  }
  #id_template{
    font-family: monospace;
  }
</style>
<div class="wrap">
  <?php if($is_new_template){ ?>
    <h2>New Poll Template</h2>
  <?php }else{ ?>
    <h2>
      Edit Poll Template
      <a href="?page=sh_menu_options_template_edit" class="add-new-h2">
        Add New
      </a>
    </h2>
  <?php
    }
    if($message){
      echo '<div id="message" class="updated below-h2"><p>';
      echo $message;
      echo '</p></div>';
    }
  ?>
  <form method="post" action=?page=sh_menu_options_template_edit<?php
    if(!$is_new_template)
      echo "&template_id=$template_id";
    ?>>
    <div id="poststuff">
      <div id="post-body" class="metabox-holder columns-2">
        <div id="post-body-content">
          <div style="margin-bottom:20px" id="titlediv">
            <input type="text" id="title" name="title"
                   required="required"
                   placeholder="Template Title..."
                   value="<?php echo $template->name; ?>">
          </div>
          <div>
          <textarea style="width:100%" rows=30 name="template"
                    id="id_template" required="required"><?php
              echo esc_textarea($template->template);
           ?></textarea>
          </div>
        </div>
        <div id="postbox-container-1" class="postbox-container">
          <div id="side-sortables" class="meta-box-sortables ui-sortable">
            <div id="save_template" class="postbox">
              <div class="handlediv" title="Click to toggle"><br></div>
              <h3 class="hndle"><span>Options</span></h3>
              <?php if($template_id){ ?>
              <div class="misc-pub-section">
                Created on:
                <?php echo date('jS M Y, h:i A', strtotime($template->creation)); ?>
              </div>
              <?php } ?>
              <div class="misc-pub-section">
                <label>
                   <input value="1" type="checkbox" name="results"<?php
                    if($template->display_results) echo ' checked="checked"'; ?>>
                   Display results only
                </label>
              </div>
              <div class="misc-pub-section">
                <?php if(get_option('sh_default_template_id') != $template_id){ ?>
                  <label>
                    <input name="default_template" type="checkbox">
                    Set as default template
                  </label>
                <?php }else{ ?>
                  This is your <strong>default template.</strong>
                <?php } ?>
              </div>
              <?php if($template_id){ ?>
              <div class="misc-pub-section">
                <label>
                   Parent CSS Class:
                </label>
                <strong>.sh-template-<?php echo $template_id; ?></strong>
                <p style="display: none; color: red" id="id_fix_css_div">
                  Mmmh, CSS seems wrong
                  <a class="button" href="#"
                    onclick="SodaHead.fix_css(<?php echo $template_id; ?>); return false">
                    let's fix that
                  </a>
                  <script>
                    var SH_Q = window.SH_Q || [];
                    SH_Q.push(function(){
                      function check_css(){
                        SodaHead.need_css_fix(<?php echo $template_id; ?>);
                      }
                      check_css();
                      document.getElementById('id_template').onchange = check_css;
                    });
                  </script>
                </p>
              </div>
              <?php } ?>
              <div id="major-publishing-actions">
                <?php if(!$is_new_template && get_option('sh_default_template_id') != $template_id){ ?>
                <div id="delete-action">
                  <a class="submitdelete deletion"
                     onclick="return confirm('Delete this template?')"
                     href="admin-ajax.php?action=sodahead_template_delete&template_id=<?php echo $template->id; echo "&action_key=" . get_option('sh_action_key'); ?>">Delete</a>
                </div>
                <?php } ?>
                <div id="publishing-action">
                  <span class="spinner" id="publish_spinner"></span>
                  <input type="submit" id="publish"
                         class="button button-primary button-large"
                         value="<?php
                          if ($is_new_template)
                            echo "Save Template";
                          else
                            echo "Update Template";
                          ?>">
                </div>
                <div class="clear"></div>
              </div>
            </div>
            <p>
            Start by loading a Standard Template.
            </p>
            <div id="load_template" class="postbox">
              <div class="handlediv" title="Click to toggle"><br></div>
              <h3 class="hndle"><span>Standard Templates</span></h3>
              <div class="misc-pub-section">
                <select id="id_sh_template" style="width: 100%">
                  <option> -- Pick a Template -- </option>
                  <option value="poll">Poll</option>
                  <option value="map">Map</option>
                  <option value="poll_demo" >Poll and Demographics</option>
                  <option value="poll_map">Poll and Map</option>
                  <option value="poll_demo_map">Poll, Demographics and Map</option>
                </select>
              </div>
              <div class="misc-pub-section">
                <a href="http://blog.sodahead.com/?p=90"
                   style="float:left; height: 25px; line-height:25px;"
                  target="_blank">Custom Templates</a>
                <div id="publishing-action">
                  <input type="button" onclick="SodaHead.load_template()"
                         class="button"
                         value="Load Template" accesskey="l">
                </div>
                <div class="clear"></div>
              </div>
            </div>
            <p>
              Then customize by editing the HTML and CSS in the editor to the left
              and/or adding any element(s) below.
            </p>
            <div id="load_template" class="postbox">
              <div class="handlediv" title="Click to toggle"><br></div>
              <h3 class="hndle"><span>Poll</span></h3>
              <div class="misc-pub-section">
                <label>
                   <input type="checkbox" id="id_poll_image">
                   Display poll image (if available)
                </label>
              </div>
              <div class="misc-pub-section">
                <label>
                   <input type="checkbox" id="id_vote_count">
                   Display vote count per answer
                </label>
              </div>
              <div class="misc-pub-section">
                <label>
                   <input type="checkbox" id="id_total_votes">
                   Display total votes
                </label>
              </div>
              <div class="misc-pub-section">
                <div id="publishing-action">
                  <input type="button" onclick="SodaHead.insert_poll();"
                         class="button"
                         value="Insert Poll">
                </div>
                <div class="clear"></div>
              </div>
            </div>
            <div id="load_template" class="postbox">
              <div class="handlediv" title="Click to toggle"><br></div>
              <h3 class="hndle"><span>Map</span></h3>
              <div class="misc-pub-section">
                <label for="id_map">Map: </label>
                <select id="id_map">
                  <option value="us">US Map (default)</option>
                  <option value="world">World Map</option>
                  <option value="americas">Americas</option>
                  <option value="us-metros">US Metros</option>
                  <option value="americas-us-states">Americas + US States</option>
                </select>
              </div>
              <div class="misc-pub-section">
                <label for="id_map_type">Coloring: </label>
                <select id="id_map_type">
                  <option value="lightness">Results gradient</option>
                  <option value="plain">Results flat</option>
                  <option value="heat">Heat map</option>
                </select>
              </div>
              <div class="misc-pub-section">
                <label>
                   <input type="checkbox" id="id_map_zoom">
                   Allow zoom
                </label>
              </div>
              <div class="misc-pub-section">
                <label>
                   <input type="checkbox" id="id_map_postvote">
                   Display after voting
                </label>
              </div>
              <div class="misc-pub-section">
                <div id="publishing-action">
                  <input type="button" onclick="SodaHead.insert_map()"
                         class="button"
                         value="Insert Map">
                </div>
                <div class="clear"></div>
              </div>
            </div>
            <div id="load_template" class="postbox">
              <div class="handlediv" title="Click to toggle"><br></div>
              <h3 class="hndle"><span>Demographics</span></h3>
              <div class="misc-pub-section">
                <label for="id_demographic">Demographic: </label>
                <select id="id_demographic" onchange="SodaHead.demo_changed()">
                  <option value="gender">Gender</option>
                  <option value="age">Age</option>
                  <option value="looking for">Looking For</option>
                  <option value="sexual orientation">Sexual Orientation</option>
                  <option value="career industry">Career Industry</option>
                  <option value="political views">Political Views</option>
                  <option value="smoker">Smoker</option>
                  <option value="height">Height</option>
                  <option value="weight type">Weight Type</option>
                  <option value="relationship status">Relationship Status</option>
                  <option value="income">Income</option>
                  <option value="drinker">Drinker</option>
                  <option value="employment status">Employment Status</option>
                  <option value="zodiac">Zodiac</option>
                  <option value="education">Education</option>
                  <option value="religious views">Religious views</option>
                  <option value="children">Children</option>
                  <option value="ethnicity">Ethnicity</option>
                </select>
              </div>
              <div class="misc-pub-section">
                <p>
                  <label>
                    <input type="radio" name="ask_demo" checked id="id_askdemo"
                    onclick="document.getElementById('id_section').setAttribute('disabled', 'disabled')">
                    Ask voters for their <span id="id_demo_title">gender</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input type="radio" name="ask_demo"
                    onclick="document.getElementById('id_section').removeAttribute('disabled')">
                    Display results of a specific demographic:
                  </label>
                  <div>
                    <select id="id_section" style="width: 100%" disabled>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                  </div>
                </p>
              </div>
              <div class="misc-pub-section">
                <label>
                   <input type="checkbox" id="id_demo_postvote">
                   Display after voting
                </label>
              </div>
              <div class="misc-pub-section">
                <div id="publishing-action">
                  <input type="button" onclick="SodaHead.insert_demographic()"
                         class="button"
                         value="Insert Demographic">
                </div>
                <div class="clear"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
