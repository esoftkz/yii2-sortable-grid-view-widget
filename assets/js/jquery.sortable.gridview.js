(function ($) {
    var fixHelper = function (e, ui) {
        ui.children().each(function () {
            $(this).width($(this).width());			
        });
		
        return ui;
    };

    $.fn.SortableGridView = function (action) {
        var widget = this;
        var grid = $('tbody', this);

        var initialIndex = [];
        $('tr', grid).each(function () {
            initialIndex.push($(this).data('key'));
        });

        grid.sortable({
			handle: ".sortable_icon",
			cursor: "move",
			tolerance: "pointer",
			items: 'tr',
			axis: "y",								
			scroll:true,
			
			start: function(event, ui){ 				
			    ui.item.addClass('sortable_item');	
				
			},
			sort: function(event, ui) {                 
				var $target = $(event.target);
				if (!/html|body/i.test($target.offsetParent()[0].tagName)) {
					var top = event.pageY - $target.offsetParent().offset().top - (ui.helper.outerHeight(true) / 2);
					ui.helper.css({'top' : top + 'px'});
				}
				
			},
			stop: function(event, ui){ 
				ui.item.removeClass('sortable_item');		
			},
			placeholder: 'placeholder',
            update: function () {
                var items = {};
                var i = 0;
                $('tr', grid).each(function () {
                    var currentKey = $(this).data('key');
					
                    if (initialIndex[i] != currentKey) {
                        items[currentKey] = initialIndex[i];
                        initialIndex[i] = currentKey;
                    }
                    ++i;
                });

                $.ajax({
                    'url': action,
                    'type': 'post',
                    'data': {'items': JSON.stringify(items)},
                    'success': function () {
                        widget.trigger('sortableSuccess');
                    },
                    'error': function (request, status, error) {
                        alert(status + ' ' + error);
                    }
                });
            },
            helper: fixHelper
        }).disableSelection();
    };
	
	
	
})(jQuery);


