<?php global $SODAHEAD_STATICS;  ?>
<script>
(function(D) {
 if(D.getElementById('id_sodahead_widget_js')) return;
 var s = D.createElement('script'); s.type = 'text/javascript';
 s.src = '<?php echo $SODAHEAD_STATICS; ?>/js/polls/widget.js';
 s.id = "id_sodahead_widget_js";
 D.getElementsByTagName('head')[0].appendChild(s);
 })(document);

(function(D) {
 if(D.getElementById('id_sodahead_widget_css')) return;
 var l = D.createElement('link'); l.type = "text/css"; l.rel = "stylesheet";
 l.href = "<?php echo plugin_dir_url( __FILE__ ); ?>../css/widget.css" ;
 l.id = "id_sodahead_widget_css";
 D.getElementsByTagName('head')[0].appendChild(l);
 })(document);
</script>
