(function() {
    tinymce.create('tinymce.plugins.Spider_Facebook_mce', {
 
        init : function(ed, url){
			
			ed.addCommand('mceSpider_Facebook_mce', function() {
				ed.windowManager.open({
					file : ((ajaxurl.indexOf("://") != -1) ? ajaxurl:(location.protocol+'//'+location.host+ajaxurl))+"?action=spiderfacebookeditorwindow",
					width : 400 + ed.getLang('Spider_Facebook_mce.delta_width', 0),
					height : 250 + ed.getLang('Spider_Facebook_mce.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});
            ed.addButton('Spider_Facebook_mce', {
            title : 'Spider Facebook',
			cmd : 'mceSpider_Facebook_mce',
            });
        }
    });
 
    tinymce.PluginManager.add('Spider_Facebook_mce', tinymce.plugins.Spider_Facebook_mce);
 
})();