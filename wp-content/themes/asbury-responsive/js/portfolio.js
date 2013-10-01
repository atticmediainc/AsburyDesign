$j=jQuery.noConflict();

$j(document).ready(function(){
	
	// Use #current-page content (a hidden <p> element) to determine which Portfolio Menu link should get the active category class
	var current_page = $j('#current-page').text(); // get current page
	var current_link;
	switch (current_page) {
		case 'publication':
			current_link = "publication";
			break;
		case 'print':
			current_link = "print";
			break;
		case 'advertising':
			current_link = "advertising";
			break;
		case 'branding & corporate identity':
			current_link = "branding";
			break;
		case 'websites':
			current_link = "websites";
			break;
		case 'environment':
			current_link = "environment";
			break;
		case 'interiors':
			current_link = "interiors";
	}
	$j('#' + current_link).addClass('active-category'); // add .active-category to the appropriate link
	
	// Setup project nav menu listeners
	$j('.portfolio-menu-toggle').click(function(){
		$j('#portfolio-menu').toggleClass('toggled');
	});
	
	// Setup lightbox for project thumbnails
	$j('.fancybox').fancybox();

});