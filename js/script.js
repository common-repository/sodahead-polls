!function(W, D){
  var events = {}, events_once = {}, pc = {},
    root="http://partners.sodahead.com";
  function subscribe(evt, callback, args, trigger_once){
    args = args || [];
    var evts = trigger_once ? events_once : events;
    if(evt in evts)
      evts[evt].push([callback, args]);
    else
      evts[evt] = [[callback, args]];
  }

  // will fire the callback associated with the event only once
  function once(evt, callback, args){
    subscribe(evt, callback, args, true);
  }

  function fire(evt, args){
    var e, i, callback, callback_args;
    if(evt in events){
      for(i = 0 ; i < events[evt].length ; i++){
        callback = events[evt][i][0];
        callback_args = events[evt][i][1].concat(args);
        callback.apply(null, callback_args);
      }
    }
    if(evt in events_once){
      while(e = events_once[evt].shift()) e[0].apply(null, e[1].concat(args));
    }
  }

  function poll_cache(user_id){
    if(!(user_id in pc))
      pc[user_id] = new PollCache(user_id);
    return pc[user_id];
  }

  function flush_cache(){
    cache = {};
    if(has_cache())
      W.sessionStorage.sodahead = W.JSON.stringify(cache);
  }

  function fill_poll_list(user_id, id, value, options){
    var select = D.getElementById(id), cache = poll_cache(user_id),
    next = D.getElementById(id + '_next'),
    previous = D.getElementById(id + '_previous'),
    current_page = 1;
    options = options || [];
    value = value || select.value;
    cache.get_page(set_options, current_page);

    next.onclick = function(){
      next.style.visibility = 'hidden';
      current_page += 1;
      cache.get_page(set_options, current_page);
      return false;
    };

    previous.onclick = function(){
      previous.style.visibility = 'hidden';
      if(current_page == 1) return;
      current_page -= 1;
      cache.get_page(set_options, current_page);
      return false;
    };

    function set_options(polls){
      var i;
      if(!polls.length) return (current_page -= 1);
      if(current_page==1) previous.style.visibility = 'hidden';
      else previous.style.visibility = '';
      if(polls.length == 10) next.style.visibility = '';
      select.innerHTML = '';
      for(i = 0; i < options.length; i++)
        select.appendChild(option(options[i].value,
          options[i].text,
          options[i].value == value));
      for(i = 0;i < polls.length;i++)
        select.appendChild(option(polls[i].id, polls[i].title,
          polls[i].id==value));
    }
  }

  function option(v, t, s){
    var option_elt = D.createElement('option');
    option_elt.value = v;
    option_elt.text = t;
    if (s) option_elt.selected = 'selected';
    return option_elt;
  }

  function script(src, kw){
    kw = kw || {};
    var s = D.createElement("script"); s.src = src; s.id = kw.id;
    s.text = kw.body || "";
    s.onerror = function(){s.parentElement.removeChild(s);};
    if(kw.cb){
      var o = "onload", r = "onreadystatechange";
      s[o] = kw.cb;
      s[r] = function(){if(!/in/.test(s.readyState)){
          kw.cb(); s[o] = s[r] = null;
      }};
    }
    (kw.e || D.getElementsByTagName("head")[0]).appendChild(s);
    return s;
  }

  function uuid(prefix){
    function S4(){
      return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    }
    return (prefix || '') + S4()+S4()+"_"+S4()+"_"+S4()+"_"+S4()+"_"+S4()+S4()+S4();
  }

  function jsonp(url, callback){
    var script_elt, f_uuid = 'json_p' + uuid();
    if(!/^(https?:\/\/|^\/\/)/.test(url)) url = root + url;
    url += (/\?/.test(url) ? '&jsonp=' : '?jsonp=') + f_uuid;
    W[f_uuid] = function(data){
      callback(data);
      W[f_uuid] = undefined;
      try{
        delete W[f_uuid];
      }catch(e){}
      script_elt.parentElement.removeChild(script_elt);
    };
    script_elt = script(url, {id: 'id_' + f_uuid});
  }

  var cache;
  function Cache(name, expire){
    var db, exp;
    expire = expire || 10 * 60000; // 10 minutes default
    if(!cache && has_cache())
      cache = W.JSON.parse(W.sessionStorage.sodahead || '{"db":{}, "exp":{}}');
    if(!(cache && cache.exp && cache.db)) cache = {db:{}, exp:{}};
    if(!cache.db.hasOwnProperty(name)){
      cache.db[name] = {};
      cache.exp[name] = {};
    }

    exp = cache.exp[name];
    db = cache.db[name];
    store();

    this.has = has;
    function has(key){
      return (db.hasOwnProperty(key) && exp[key] + expire > new Date().getTime());
    }

    this.del = del;
    function del(key){
      if(key in db){
        delete db[key];
        delete exp[key];
        store();
      }
    }

    this.set = set;
    function set(key, value){
      db[key] = value;
      exp[key] = new Date().getTime();
      store();
    }

    this.flush = flush;
    function flush(){
      for(var k in db){ if(db.hasOwnProperty(k)) delete db[k]; }
      for(k in exp){ if(exp.hasOwnProperty(k)) delete exp[k]; }
      store();
    }

    this.get = get;
    function get(key, def){
      return (has(key) ? db[key] : def);
    }

    this.update = store;
    function store(){
      if(has_cache())
        W.sessionStorage.sodahead = W.JSON.stringify(cache);
    }
  }

  function has_cache(){
    return W.JSON && W.Storage;
  }

  var db_polls = new Cache('db_polls');

  function PollCache(user_id){
    var pages = new Cache('pages', 20*60*1000);

    this.flush = flush;
    function flush(poll_id){
      if(poll_id){
        db_polls.del(poll_id);
      }else{
        db_polls.flush();
      }
    }

    // add a new ID to the pages
    this.unshift = unshift;
    function unshift(id, page){
      page = page || 1;
      if(page > pages.get('last_page', 0)) return;
      if(pages.has(page)){
        if(id){
          pages.get(page).unshift(id);
          pages.update();
        }
        unshift(pages.get(page).pop(), page+1);
      }else{
        unshift(null, page+1);
      }
    }
    subscribe('poll_created', unshift);

    this.get_page = get_page;
    function get_page(callback, page){
      page = page || 1;
      var url = '/api/polls/author/'+ user_id +'/?page=' + page;
      if(pages.has(page) && pages.get(page).length == 10){
        get_polls(pages.get(page), callback);
      }else{
        jsonp(url, function(d){
          var poll, i;
          pages.set(page, []);
          for(i = 0; i < d.polls.length ; i++){
            poll = d.polls[i].poll;
            db_polls.set(poll.id, poll);
            pages.get(page).push(poll.id);
            fire('poll_received', [poll]);
          }
          pages.set('last_page', (page > pages.get('last_page', 0) ?
            page : pages.get('last_page',0)));
          get_polls(pages.get(page), callback);
        });
      }
    }

    function are_available(ids){
      for(var i = 0; i < ids.length; i++){
        if(!(db_polls.has(ids[i]))) return false;
      }
      return true;
    }

    function polls_from_ids(ids){
      var r = [];
      for(var i = 0; i < ids.length; i++){
        r.push(db_polls.get(ids[i]));
      }
      return r;
    }

    this.get_polls = get_polls;
    function get_polls(ids, callback){
      if(are_available(ids)) callback(polls_from_ids(ids));
      else{
        for(var i = 0; i < ids.length; i++){
          get_poll(ids[i], function(){
            if(are_available(ids)) callback(polls_from_ids(ids));
          });
        }
      }
    }

    this.get_poll = get_poll;
    function get_poll(id, callback){
      if(db_polls.has(id)) callback(db_polls.get(id));
      else{
        remote_get([id]);
        subscribe('poll_received', function(poll){
          if(poll.id == id) callback(db_polls.get(id));
        });
      }
    }

    var remote_get_timeout, poll_id_queue = [];
    function remote_get(poll_ids){
      poll_id_queue = poll_id_queue.concat(poll_ids);
      if(remote_get_timeout) clearTimeout(remote_get_timeout);
      remote_get_timeout=setTimeout(function(){
        var url = '/api/polls/' + poll_id_queue.join('/') + '/';
        poll_id_queue = [];
        jsonp(url, function(d){
          var poll, i;
          if('poll' in d) d.polls = [{'poll': d.poll, 'vote': d.vote}];
          for(i = 0; i < d.polls.length ; i++){
            poll = d.polls[i].poll;
            db_polls.set(poll.id, poll);
            fire('poll_received', [poll]);
          }
        });
      }, 20);
    }
  }


  W['SodaHead'] = W['SodaHead'] || {};
  W['SodaHead'].fill_poll_list = fill_poll_list;
  W['SodaHead'].once = once;
  W['SodaHead'].subscribe = subscribe;
  W['SodaHead'].fire = fire;
  W['SodaHead'].jsonp = jsonp;
  W['SodaHead'].root = root;
  W['SodaHead'].poll_cache = poll_cache;
  W['SodaHead'].flush_cache = flush_cache;
  W['SodaHead'].has_cache = has_cache;

  if(W.SH_Q){
    var fq;
    while(fq = W.SH_Q.shift()) fq();
  }
  SH_Q = { push: function(f){f();} };

}(window, document);
