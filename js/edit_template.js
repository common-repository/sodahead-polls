!function(W, D){
  var templates = {
    poll: "<style>\n   .sh-template-1 {\n    padding: 5px;\n    border: 1px solid #ccc;\n    background: #fafafa;\n  }\n</style>\n\n<!-- Poll with loading spin -->\n<div class=\"sh-poll\" data-total=\"true\" data-count=\"true\">\n  <div class=\"sh-loading\"></div>\n</div>",
    poll_demo: "<style>\n   .sh-template-1 {\n    border: 1px solid black;\n    background: #fafafa;\n  }\n  .sh-template-1 .poll-header{\n    background-color: black;\n  }\n  .sh-template-1 .poll-header img{\n    margin: 0 auto;\n    padding: 5px 0;\n    max-width: 90%;\n    display: block;\n  }\n\n  .sh-template-1 .sh-demo{\n    width: 28%;\n    margin: 5px 2%;\n  }\n  .sh-template-1 .demo-container{\n    text-align: center;\n  }\n  .sh-template-1 .poll-body{\n    padding: 5px;\n  }\n  .sh-template-1.sh-flyout-box{\n    padding: 0;\n    margin-right: 0;\n  }\n\n  .sh-template-1.sh-flyout-box .relation-demo,\n  .sh-template-1.sh-poll-widget .relation-demo{\n    display: none;\n  }\n  .sh-template-1.sh-flyout-box .sh-demo,\n  .sh-template-1.sh-poll-widget .sh-demo{\n    width: 40%;\n  }\n</style>\n<!-- Replace the image URL with your logo URL -->\n<div class=\"poll-header\">\n  <img src=\"/wp-content/plugins/sodahead-polls/img/dailypoll.png\">\n</div>\n\n<div class=\"poll-body\">\n  <!-- Poll with loading spin -->\n  <div class=\"sh-poll\" data-total=\"true\" data-count=\"true\">\n    <div class=\"sh-loading\"></div>\n  </div>\n  <!-- Demographics appear under poll post-vote -->\n  <div class=\"demo-container sh-post-vote\">\n    <div class=\"sh-demo\" data-demo=\"age\" data-postvote=\"true\"></div>\n    <div class=\"sh-demo\" data-demo=\"gender\" data-postvote=\"true\"></div>\n    <div class=\"sh-demo relation-demo\" data-demo=\"relationship status\" data-postvote=\"true\"></div>\n  </div>\n</div>",
    poll_map: "<style>\n   .sh-template-1 {\n    padding: 5px;\n    border: 1px solid #ccc;\n    background: #fafafa;\n  }\n  .sh-template-1 .sh-demo{\n    width: 130px;\n    margin: 5px 10px;\n  }\n</style>\n\n<!-- Poll with loading spin -->\n<div class=\"sh-poll\" data-total=\"true\" data-count=\"true\">\n  <div class=\"sh-loading\"></div>\n</div>\n<!-- Language displayed above the map -->\n<h3 style=\"text-align: center\">Vote to see how the states voted.</h3>\n<!-- Display the U.S. Map pre-vote. To switch to world map, replace \"us\" with \"world\" -->\n<div class=\"sh-map\" data-coloring=\"lightness\" data-map=\"us\"></div>\n",
    poll_demo_map: "<!-- Medium Sized with Grey Border -->\n<style>\n   .sh-template-1 {\n    border: 1px solid black;\n    background: #fafafa;\n  }\n  .sh-template-1 .poll-header{\n    background-color: black;\n  }\n  .sh-template-1 .poll-header img{\n    margin: 0 auto;\n    padding: 5px 0;\n    max-width: 90%;\n    display: block;\n  }\n  .sh-template-1 .poll-body{\n    padding: 5px;\n  }\n  .sh-template-1 .sh-demo{\n    width: 28%;\n    margin: 5px 2%;\n  }\n  .sh-template-1 .demo-container{\n    text-align: center;\n  }\n\n  /* when displayed in the sidebar as a widget */\n  .sh-template-1.sh-flyout-box .relation-demo,\n  .sh-template-1.sh-poll-widget .relation-demo{\n    display: none;\n  }\n  .sh-template-1.sh-flyout-box .sh-demo,\n  .sh-template-1.sh-poll-widget .sh-demo{\n    width: 40%;\n  }\n  .sh-template-1.sh-flyout-box{\n    padding: 0;\n    border-right: 0;\n  }\n\n  /*\n  .sh-template-1.sh-poll-widget .relation-demo{\n\n</style>\n<!-- Replace the image URL with your logo URL -->\n<div class=\"poll-header\">\n  <img src=\"/wp-content/plugins/sodahead-polls/img/dailypoll.png\">\n</div>\n\n<div class=\"poll-body\">\n  <!-- Poll with loading spin -->\n  <div class=\"sh-poll\" data-total=\"true\" data-count=\"true\">\n    <div class=\"sh-loading\"></div>\n  </div>\n\n  <!-- Map and demographics appear under poll post-vote -->\n  <div class=\"demo-container sh-post-vote\">\n    <div class=\"sh-demo\" data-demo=\"age\" data-postvote=\"true\"></div>\n    <div class=\"sh-demo\" data-demo=\"gender\" data-postvote=\"true\"></div>\n    <div class=\"sh-demo relation-demo\" data-demo=\"relationship status\" data-postvote=\"true\"></div>\n  </div>\n  <!-- Display the world map results post-vote. To switch to U.S. map, replace \"world\" with \"us\" -->\n  <div class=\"sh-map\" data-coloring=\"lightness\" data-map=\"world\" data-zoom=\"true\"  data-postvote=\"true\"></div>\n</div>"
  };

  function load_template(){
    var template = templates[D.getElementById('id_sh_template').value];
    if (template) D.getElementById('id_template').value = template;
  }

  function insert(text){
    var t = D.getElementById('id_template');
    try{
      var from = t.selectionStart, to = t.selectionEnd;
      if(typeof t.selectionStart === "undefined")
        t.value += text;
      else
        t.value = t.value.slice(0, from) + text + t.value.slice(to);
    }catch(e){
      t.value += text;
    }
  }

  function insert_poll(){
    var cfg=[],
    total_votes = D.getElementById('id_total_votes'),
    poll_image = D.getElementById('id_poll_image'),
    vote_count = D.getElementById('id_vote_count');
    if(total_votes.checked) cfg.push('data-total="true"');
    if(vote_count.checked) cfg.push('data-count="true"');
    if(poll_image.checked) cfg.push('data-image="large"');
    insert('<div class="sh-poll" '+ cfg.join(' ') +'></div>');
  }

  function insert_map(){
    var cfg = [], map_type = D.getElementById('id_map_type').value,
    map =  D.getElementById('id_map').value,
    postvote = D.getElementById('id_map_postvote'),
    zoom = D.getElementById('id_map_zoom'),
    template = D.getElementById('id_template');
    if(map_type) cfg.push('data-coloring="' + map_type + '"');
    if(map) cfg.push('data-map="' + map + '"');
    if(zoom.checked) cfg.push('data-zoom="true"');
    if(postvote.checked) cfg.push(' data-postvote="true"');
    insert('\n<div class="sh-map" '+ cfg.join(' ') +'></div>');
  }

  function insert_demographic(){
    var cfg, demo = D.getElementById('id_demographic').value,
    section =  D.getElementById('id_section').value,
    askdemo =  D.getElementById('id_askdemo').checked,
    postvote = D.getElementById('id_demo_postvote'),
    template = D.getElementById('id_template');
    cfg = ['data-demo="' + demo + '"'];
    if(!askdemo) cfg.push('data-section="' + section + '"');
    if(postvote.checked) cfg.push('data-postvote="true"');
    insert('\n<div class="sh-demo" '+ cfg.join(' ') +'></div>');
  }

  var demographics = {
    "looking for": {
      "unknown": 0,
      "Expressing Myself": 1,
      "Discovering Opinions": 2,
      "Friendship": 3,
      "Dating": 4,
      // "A Relationship": 5,
      "Networking": 6
    },
    "sexual orientation": {
      "unknown": 0,
      "Straight": 1,
      "Bi": 2,
      "Gay/Lesbian": 3,
      "Not Sure": 4
    },
    "career industry": {
      "unknown": 0,
      "Accounting/Finance": 1,
      "Advertising/Graphic Design": 2,
      "Arts and Entertainment": 3,
      "Clerical": 4,
      "Healthcare": 5,
      "Hospitality": 6,
      "IT": 7,
      "Legal": 8,
      "Management": 9,
      "Military": 10,
      "Public Safety": 11,
      "Real Estate": 12,
      "Retail": 13,
      "Small Business Owner": 14,
      "Student":15,
      "Other": 99
    },
    "gender": {
      "unknown": 0,
      "Male": 1,
      "Female": 2
    },
    "age": {
      "unknown": 0,
      "13-17": 13,
      "18-24": 18,
      "25-34": 25,
      "35-44": 35,
      "45-54": 45,
      "55-64": 55,
      "65+": 65
    },
    "political views": {
      "unknown": 0,
      "Progressive": 1,
      // "Very Liberal": 2,
      "Liberal": 3,
      "Moderate": 4,
      "Conservative": 5,
      // "Very Conservative": 6,
      "Apathetic": 7,
      "Libertarian": 8,
      "Other": 99
    },
    "smoker": {
      "unknown": 0,
      "Yes": 1,
      "No": 2
    },
    "height": {
      "unknown": 0,
      "4' 5\" and shorter": 1,
      "4'6\"-4'11\"": 2,
      "5'-5'5\"": 3,
      "5'6\"-5'11\"": 4,
      "6'-6'5\"": 5,
      "6'6\" or taller": 6
    },
    "weight type": {
      "unknown": 0,
      "Slim/Slender": 1,
      "Athletic": 2,
      "Average": 3,
      "Love Handles": 4,
      //"Big and Beautiful": 5,
      "Body Builder": 6
    },
    "relationship status": {
      "unknown": 0,
      "Single": 1,
      "Married": 2,
      "Divorced": 3,
      "In a relationship": 4,
      "Engaged": 5,
      "It's complicated": 6,
      // "In an open relationship": 7,
      "Widowed": 8
    },
    "income": {
      "unknown": 0,
      "$0 - $25k": 1,
      "$25k - $50k": 2,
      "$50k - $75k": 3,
      "$75k - $100k": 4,
      "$100k+": 5
    },
    "drinker": {
      "unknown": 0,
      "Yes": 1,
      "No": 2
    },
    "employment status": {
      "unknown": 0,
      "Full-Time": 1,
      "Part-Time": 2,
      "Retired": 3,
      "Student": 4,
      "Not-Employed": 5
    },
    "zodiac": {
      "unknown": 0,
      "Capricorn": 1,
      "Aquarius": 2,
      "Pisces": 3,
      "Aries": 4,
      "Taurus": 5,
      "Gemini": 6,
      "Cancer": 7,
      "Leo": 8,
      "Virgo": 9,
      "Libra": 10,
      "Scorpio": 11,
      "Sagittarius": 12
    },
    "education": {
      "unknown": 0,
      "High School (Current)": 1,
      "High School Graduate": 2,
      "College (Current)": 3,
      "Some College": 4,
      "College Graduate": 5,
      "Graduate/Professional School": 6,
      "Post Graduate School": 7
    },
    "religious views": {
      "unknown": 0,
      "Agnostic": 1,
      "Atheist": 2,
      "Buddhist": 3,
      "Christian": 4,
      "Hindu": 5,
      "Jewish": 6,
      "Muslim": 7,
      "Pagan": 8,
      "Scientologist": 9,
      "Baha'i": 10,
      "Other": 99
    },
    "children": {
      "unknown": 0,
      "No thank you": 1,
      // "Love kids, but not for me": 2,
      "Undecided": 3,
      "Someday": 4,
      "Expecting": 5,
      "Proud Parent": 6
    },
    "ethnicity": {
      "unknown": 0,
      "Asian": 1,
      "Black/African descent": 2,
      "East Indian": 3,
      "Latino/Hispanic": 4,
      "Middle Eastern": 5,
      "Native American": 6,
      "Pacific Islander": 7,
      "White/Caucasian": 8,
      "Other": 99
    }
  };

  function demo_changed(){
    var select = D.getElementById('id_demographic'),
      title = D.getElementById('id_demo_title'),
      section = D.getElementById('id_section');
    section.innerHTML = '';
    title.innerHTML = select.value;
    for(var i in demographics[select.value]){
      var d = demographics[select.value];
      if(d.hasOwnProperty(i) && d[i]){
        section.appendChild(option(i, i));
      }
    }
  }

  function option(t, v, s){
    var option_elt = D.createElement('option');
    option_elt.value = v;
    option_elt.text = t || v;
    option_elt.innerHTML = t || v;
    if (s) option.selected = 'selected';
    return option_elt;
  }

  function fix_css(id){
    var content = D.getElementById('id_template');
    content.value = content.value.replace(/\.sh-template-\d+\b/g,
      '.sh-template-' + id);
    D.getElementById('id_fix_css_div').style.display = 'none';
  }

  function need_css_fix(id){
    var content = D.getElementById('id_template'),
    re = /(\.sh-template-\d+)/g, match;
    while((match = re.exec(content.value)) != null){
      if(match[0] != '.sh-template-' + id){
        D.getElementById('id_fix_css_div').style.display = '';
        return;
      }
    }
  }

  W['SodaHead'] = W['SodaHead'] || {};
  W['SodaHead'].demo_changed = demo_changed;
  W['SodaHead'].load_template = load_template;
  W['SodaHead'].insert_demographic = insert_demographic;
  W['SodaHead'].insert_poll = insert_poll;
  W['SodaHead'].insert_map = insert_map;
  W['SodaHead'].fix_css = fix_css;
  W['SodaHead'].need_css_fix = need_css_fix;
}(window, document);
