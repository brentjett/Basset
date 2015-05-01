( function( $ ) {
	
	wp.customize( 'basset_bar_bg', function( value ) {
		value.bind( function( to ) {
			$('.announcement-bar').css('background-color', to);
		});
	});

} )( jQuery);