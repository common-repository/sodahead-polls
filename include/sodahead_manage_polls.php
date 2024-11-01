<style>
  button.button.load-more {
    font-weight: bold;
    color: #666;
    font-size: 18px;
    width: 300px;
    padding: 5px 10px;
    margin: 20px auto;
    display: block;
    height: auto;
  }
  div.poll-trunc {
    display: inline-block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>
<div class="wrap">
  <h2>
    <a href="#" onclick="SodaHead.flush_cache();location.reload();" style="float:right;font-size:.5em" title="Clear local cache">Refresh listing</a>
    Manage Polls
    <a class="add-new-h2" href="/wp-admin/admin-ajax.php?action=sodahead_ask" onclick="javascript:void window.open(this.href,'1380329618328','width=200,height=200');return false;">
      Add New
    </a>
  </h2>
  <table class="wp-list-table widefat">
    <thead>
      <tr>
        <th>Title</th>
        <th>Creation Date</th>
        <th>Status</th>
        <th>Total Votes</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Title</th>
        <th>Creation Date</th>
        <th>Status</th>
        <th>Total Votes</th>
      </tr>
    </tfoot>
    <tbody id="id_poll_tbody">
    </tbody>
  </table>
  <button style="display:none" id="id_load_more" class="button load-more">
    + Load More
  </button>
</div>
<script>
  SH_Q = window.SH_Q || [];
  SH_Q.push(function(){
    var cache = SodaHead.poll_cache(<?php echo get_option('sh_user_id'); ?>),
    page = 1;

    document.getElementById('id_load_more').onclick = function(){
      page++;
      cache.get_page(fill_listing, page);
      document.getElementById('id_load_more').style.display = 'none';
    };

    cache.get_page(fill_listing, page);
    SodaHead.subscribe('poll_created', function(poll_id){
      location.search = 'page=sh_menu_options_poll_edit&poll_id=' + poll_id;
    });

    SodaHead.subscribe('poll_deleted', function(poll_id){
      location.search = "page=sh_menu_options";
    });

    function fill_listing(polls){
      function TD(content){
        var td = document.createElement('td');
        td.innerHTML = content;
        return td;
      }
      var poll_tbody = document.getElementById('id_poll_tbody');
      for(var i = 0; i < polls.length; i++){
        var poll = polls[i], tr = document.createElement('tr');
        if(i%2) tr.className = 'alternate';
        var td = document.createElement('td');
        tr.appendChild(TD('<div class="poll-trunc" title="'+ poll.title +'">' +
          poll.title + '</div><div class="row-actions">' +
          '<a href="?page=sh_menu_options_poll_edit&poll_id=' +
          poll.id + '">Edit</a> | ' +
          '<a class="submitdelete deletion" ' +
          'onclick="javascript:void window.open(this.href,\'1380329618328\',\'width=400,height=300\');return false;" ' +
          'href="admin-ajax.php?action=sodahead_delete&poll_id=' + poll.id +
          '">Delete</a></div>'));
          tr.appendChild(TD(poll.creationDate));
          tr.appendChild(TD(poll.closed ? 'Closed' : 'Open'));
          tr.appendChild(TD(poll.totalVotes));
        poll_tbody.appendChild(tr);
      if(polls.length == 10)
        setTimeout(function(){
          document.getElementById('id_load_more').style.display = '';
        });
      }
    }
  });
</script>
