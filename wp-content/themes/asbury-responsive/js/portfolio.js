$j=jQuery.noConflict();

$j(document).ready(function(){
	
	// Setup project nav menu listeners
	$j('.portfolio-menu-toggle').click(function(){
		$j('#portfolio-menu').toggleClass('toggled');
	});
	
	// Setup lightbox for project thumbnails
	$j('.fancybox').fancybox();

});