/*!
 * Ext JS Library 3.4.0
 * Copyright(c) 2006-2011 Sencha Inc.
 * licensing@sencha.com
 * http://www.sencha.com/license
 */
var panel;
Ext.onReady(function(){
    var xd = Ext.data; 
    var store = new Ext.data.JsonStore({
        url: 'templates/getTemplatesJson',
        root: 'images',
        fields: ['idTema','name', 'url', {name:'size', type: 'float'}, {name:'lastmod', type:'date', dateFormat:'timestamp'}]
    });
    store.load();

    var tpl = new Ext.XTemplate(
		'<tpl for=".">',
            '<div class="thumb-wrap" id="{name}">',
		    '<div class="thumb"><img src="{url}" title="{name}"></div>',
		    '<span class="x-editable">{shortName}</span></div>',
        '</tpl>',
        '<div class="x-clear"></div>'
	);
	
    panel = new Ext.Panel({
        id:'images-view',
        frame:true,
        width:535,
		height:200,
		unstyled:true,
      //  autoHeight:true,
      //  collapsible:true,
	  bbar: new Ext.PagingToolbar({
        store: store,       // grid and PagingToolbar using same store
        displayInfo: true,
        pageSize: 2,
        prependButtons: true,
		unstyled:true,
		hidden:false
    }),
        layout:'fit',
      //  title:'Simple DataView (0 items selected)',
		
        items: new Ext.DataView({
            store: store,
            tpl: tpl,
            autoHeight:true,
            multiSelect: true,
            overClass:'x-view-over',
            itemSelector:'div.thumb-wrap',
            emptyText: 'No images to display',
			
            plugins: [
            //    new Ext.DataView.DragSelector(),
           //     new Ext.DataView.LabelEditor({dataIndex: 'name'})
            ],

            prepareData: function(data){
                data.shortName = Ext.util.Format.ellipsis(data.name, 15);
                data.sizeString = Ext.util.Format.fileSize(data.size);
                data.dateString = data.lastmod.format("m/d/Y g:i a");
                return data;
            },
            
            listeners: {
            	selectionchange: {
            		fn: function(dv,nodes){
						console.log(nodes);
            			var l = nodes.length;
            			var s = l != 1 ? 's' : '';
            		//	panel.setTitle('Simple DataView ('+l+' item'+s+' selected)');
            		}
            	},
				click:function( dataview,  index, node,  e ){
					var rec = this.store.getAt(index);
					console.log(rec);
					alert(rec.data.idTema);
				}
				
            }
        })
    });
    panel.render("template_body");
	var el=Ext.get('incio');
	el.on('click',function(){
		panel.bottomToolbar.moveFirst(); 		
	});
	
	el=Ext.get('atras');
	el.on('click',function(){
		panel.bottomToolbar.movePrevious(); 		
	});
	
	el=Ext.get('siguiente');
	el.on('click',function(){
		panel.bottomToolbar.moveNext(); 		
	});
	
	el=Ext.get('fin');
	el.on('click',function(){
		panel.bottomToolbar.moveLast(); 		
	});
	console.log(el);
});