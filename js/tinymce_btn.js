(function() {
    tinymce.create('tinymce.plugins.sodahead', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {
          ed.addButton('sh_add_poll', {
              title : 'Insert a Poll',
              cmd : 'sh_add_poll',
              image : url + '/../img/button.png'
          });
          ed.addCommand('sh_add_poll', function(){
            jQuery('#sh_template_modal').dialog({title: 'Add a poll', width: 500});
            jQuery('#sh_template_modal').on( "dialogclose", function(){
              jQuery('#id_sh_insert_poll').unbind('click');
            });
            jQuery('#id_sh_insert_poll').click(function(){
              var poll_id = document.getElementById('id_sh_poll_id').value,
              template_id = document.getElementById('id_sh_template_id').value,
              options = [];
              if(poll_id > 0){
                options.push('poll_id="' + poll_id + '"');
                if(template_id)
                  options.push('template_id="' + template_id + '"');
                ed.execCommand('mceInsertContent', 0,
                  '[sh_poll ' + options.join(' ') + ']');
                jQuery('#sh_template_modal').dialog('close');
              }
            });
          });
        },

        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        },

        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'SodaHead Button',
                author : 'SodaHead inc.',
                authorurl : 'http://www.sodahead.com/',
                infourl : 'http://www.sodahead.com/about-us/custom-polls/#team',
                version : "1.0"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add( 'sodahead', tinymce.plugins.sodahead );
})();
