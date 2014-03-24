jQuery(document).ready(function() { 

jQuery('#home-slider').superslides({
	pagination: false,
	animation :'fade'
})

jQuery('#single-slider').superslides({
	pagination: false,
	animation :'fade'
})

jQuery(".folio-container").responsiveSlides({
	pager:true
});

jQuery("a[rel^='prettyPhoto']").prettyPhoto();

});