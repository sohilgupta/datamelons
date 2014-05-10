/*
    Plugin Name: JotForm Embed Forms
    Plugin URI: http://www.jotform.com/labs/wordpress
    Description:
    Version: 1.0
    Author: Ertugrul Emre Ertekin
    Author URI: http://ee.ertek.in
    License: GNU General Public License v3
*/

(function() {
    tinymce.create('tinymce.plugins.JotFormWPEmbed', {
        init : function(ed, url) {
            console.log(url);
            ed.addButton('JotFormWPEmbed', {
                title : 'JotForm',
                image : url+'/images/jotform.png',
                onclick : function() {
                    function openWizard() {
                        window.jotformFormPicker.openWizard(function(formID){
                            if (formID !== undefined && formID.length > 0 && formID !== "Please enter your form id") {
                                ed.execCommand('mceInsertContent', false, '[jotform id="'+formID+'"]');
                            }
                        });
                    }
                    if(window.jotformFormPicker) {
                        openWizard();
                    }
                    else {
                        jQuery.getScript("http://js.jotform.com/JotFormFormPicker.js", function(data, textStatus, jqxhr) {
                            event.preventDefault();
                            window.jotformFormPicker = new JotFormFormPicker();
                            openWizard();
                        });
                    }
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "JotForm Embed Forms",
                author : 'Ertugrul Emre Ertekin',
                authorurl : 'http://ee.ertek.in',
                infourl : 'http://www.jotform.com/labs/wordpress',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('JotFormWPEmbed', tinymce.plugins.JotFormWPEmbed);
})();