$j=jQuery.noConflict();

$j(document).ready(function(){
	
	$j('.bxslider').bxSlider({
		auto: true,
		pause: 6000,
		speed: 1500,
		responsive: true,
		mode: 'fade',
		pager: true,
		controls: false,
		autoHover: true,
		autoDelay: 500 // wait 500ms before starting slideshow
	});

});