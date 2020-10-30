jQuery.fn.extend({
	rwd: function(){
		$(this).wrap('<div style="width: 10%; overflow: hidden;"></div>');
		
		var fb = this;
		var tm = $(fb).parent();
		
		$(window).resize(function(){
			
			//default width height 500px
			var fb_w = parseInt($(fb).attr('data-width')) || 50;
			var fb_h = parseInt($(fb).attr('data-height'))|| 500;
			var win_w = tm.width();
			var r_w = win_w/fb_w;
			
			$(fb).css('transform', 'scale('+r_w+')').css('transform-origin', '0 0');
			$(tm).css('height', fb_h*r_w + 'px');
			
		}).resize();
	}
});