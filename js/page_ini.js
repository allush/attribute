$(document).ready(function() {
	if($('#slideshow-items').length) {
		$('#slideshow-items').cycle({
			fx:     'scrollHorz',
			speed:   800, 
			pager: '#nav',
			timeout: 4000,
			pagerAnchorBuilder: function(idx, slide) { 
			return '<a href="#"></a>'; 
			}
		});
	}
//	if($('.products-item').length) {
//		$('.products-item').mouseover(function(e){
//			if($(e.target).parents().filter('.products-item').length == 1 || $(e.target).attr('class')=='products-item'){
//				$(this).find('.to-basket-button').show();
//				$(this).find('.product-price span').css('color', '#32b0c6');
//				$(this).find('.name-product').addClass('hover');
//			}
//		});
//		$('.products-item').mouseout(function(e){
//			if($(e.target).parents().filter('.products-item').length == 1 || $(e.target).attr('class')=='products-item'){
//				$(this).find('.to-basket-button').hide();
//				$(this).find('.product-price span').css('color', '#71c1cf');
//				$(this).find('.name-product').removeClass('hover');
//			}
//		});
//	}
	if($('.product-images .gallery').length) {
		$('.product-images .gallery a').click(function() {
			var src = $(this).find('img').attr('src');
			$('.product-images .big-img').attr('src', src);
		});
	}
	if($('#question').length){
		$("#question").fancybox({
			'opacity'			: true,
			'overlayShow'		: true,
			'transitionIn'		: 'fade',
			'transitionOut'		: 'fade',
			'centerOnScroll'	: true,
			'hideOnContentClick': false,
			'showCloseButton'	: false,
			'titleShow'			: false,
			'overlayOpacity'	: 0.9,
			'overlayColor'		: '#00151d',
			'padding'			:0
		});
	}
	if($('input').length) {
		$('input').focus(function () {
			$(this).addClass('focus');
		});
		$('input').blur(function () {
			$(this).removeClass('focus');
		});
	}
});

