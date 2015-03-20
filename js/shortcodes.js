// JavaScript Document

(function() {
    tinymce.PluginManager.add('my_mce_button_columns', function( editor, url ) {
        editor.addButton('my_mce_button_columns', {
            text: 'Columns',
            icon: false,
			
			onclick: function() {
               var colsize = prompt("Columns?", "one");
			  if (colsize != null && colsize != '')
				 editor.execCommand('mceInsertContent', false, '[nu-grid columns="'+colsize+'"]' + tinymce.activeEditor.selection.getContent() + '[/nu-grid]');
			  else
				 editor.execCommand('mceInsertContent', false, '[nu-grid]Content[/nu-grid]');
            }
        });
    });
})();


(function() {
    tinymce.PluginManager.add('my_mce_button_row', function( editor, url ) {
        editor.addButton('my_mce_button_row', {
            text: 'Row',
            icon: false,			
			onclick: function() {  
				 editor.execCommand('mceInsertContent', false, ('[nu-row]' + tinymce.activeEditor.selection.getContent() + '[/nu-row]'));
        	}
    	});
    });
})();

