$j=jQuery.noConflict();

$j(document).ready(function(){
	
	$j('.bxslider').bxSlider({
		auto: true,
		pause: 7500,
		speed: 7500,
		responsive: true,
		mode: 'fade',
		pager: true,
		controls: false,
		autoHover: true,
		autoDelay: 500 // wait 500ms before starting slideshow
	});

});