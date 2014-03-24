// Gallery plugin written by Towfiq I.
jQuery(window).ready(function() {
//======================Gallery=================================//
//remove any <br> inside the gallery markup
jQuery(".gallery br").remove();
//wrap all .gallery-item with .gall_dash /  For making the thumbnail navigation area
jQuery(".gallery").each(function (){jQuery(this).find(".gallery-item").wrapAll('<div class="gall_dash" />');});
jQuery('.gall_dash .hasimg').removeClass('hasimg');
//get the large version of the image from href of first thumbnail.
var first_image = jQuery('.gallery-item:eq(0) a').attr("href");
//get the domain name of the site. to load the newloader.gif on any domain, because loading external image is not an option.
var base =jQuery('.logo a').attr("href");
//Prepend the big image area. and load the src image of the first thumbnail. The.ast_full is for fancybox integration.
jQuery(".thn_post_wrap .gallery").prepend("<div class='ast_gall'><a href='"+first_image+"' class='ast_full' title='See larger version of this image'></a><span class='ast_cap'></span><img id='mainImage' src='"+galleryloadergif+"' data-original='"+first_image+"' class='gallery_full'/></div>");

//Add Lazyload
jQuery("#mainImage").lazyload();
//if a .gallery-item has caption inside it, add has_cap class
jQuery(".gallery-item").has('dd').addClass('has_cap');
//if a .gallery-item does not have caption inside it, add no_cap class
jQuery(".gallery-item").not(':has(dd)').addClass('no_cap');

//if the first thumbail image has caption inside of it, add the caption text to our empty .ast_cap span tag that we appended earlier.
  if(jQuery('.gallery-item:eq(0) .gallery-caption').length>0){
 		jQuery(".ast_cap").html(jQuery('.gallery-item:eq(0) .gallery-caption').html());
 		}else{
 		jQuery(".ast_cap").css("display","none");
 		}

//add .gall_active to first gallery-item for styling purpose
jQuery('.gallery-item:eq(0) img').addClass('gall_active');


//here goes our main click function to load the large images from the thumbnail images
jQuery(".gallery-item").click(function(event) {
	event.preventDefault();
	var thisImage = jQuery(this).find('a');
	jQuery(".gall_active").removeClass("gall_active");
	jQuery(this).find("img").addClass("gall_active");
	jQuery("#mainImage").fadeOut(function() {
    jQuery(this).fadeOut('fast').attr("src", thisImage.attr("href")).fadeIn('fast');
	});	
	
	//change the link of .ast_full to current large image link
	jQuery(".ast_full").fadeOut(function() {
    jQuery(this).fadeOut('fast').attr("href", thisImage.attr("href")).fadeIn('fast');
	});	
});

//if the .gallery-item that has .has_cap class only clicking them should show their caption
jQuery(".has_cap").click(function(event) {
	event.preventDefault();	
	var thisCap = jQuery(this).find('.wp-caption-text').html();
	
	jQuery(".ast_cap").fadeOut(function() {
	jQuery(this).fadeOut('fast').html(thisCap).fadeIn('fast');
	});			
});
//if the .gallery-item that has .no_cap class only clicking them should hide the caption
jQuery(".no_cap").click(function(event) {
	event.preventDefault();	
	jQuery(".ast_cap").hide();
		
});
});