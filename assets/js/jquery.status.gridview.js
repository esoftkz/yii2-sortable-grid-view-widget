(function ($) {

	$.fn.ChangeStatus = function (action) {		
		$(this).on('click', function(){
			var this_el = $(this);
			var id = this_el.closest('tr').data('key');			
			$.ajax({
				'url': action,
				'type': 'post',
				'data': {'id': id},
				'dataType': 'json',
				'success': function (data) {								
					if(data.status==1){
						this_el.addClass('active').removeClass('notactive');
					}else{
						this_el.addClass('notactive').removeClass('active');
					}					
				},
				'error': function (request, status, error) {
					alert(status + ' ' + error);
				}
			});		
		});
		
		
	}
	
})(jQuery);


