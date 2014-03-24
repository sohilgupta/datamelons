/*
* Theme Name: Invention
* Theme URI: http://www.jozoor.com
* Description: Invention Theme for corporate and creative sites, responsive and clean layout, more than color skins
* Author: Jozoor team
* Author URI: http://www.jozoor.com
* Version: 1.0
*/

/*
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =  
=     00   00 00 00   00 00 00   00 00 00   00 00 00   00 00    =
=     00   00    00        00    00    00   00    00   00       =
=     00   00    00      00      00    00   00    00   00       =
=     00   00    00    00        00    00   00    00   00       =
=  00 00   00 00 00   00 00 00   00 00 00   00 00 00   00       =
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
*/

jQuery(document).ready(function($) {

// Navigational Menu ddsmoothmenu
ddsmoothmenu.init({
	mainmenuid: "menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'navigation', //class added to menu's outer DIV
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

// Carousel slider
$('.slidewrap').carousel({
	slider: '.slider',
	slide: '.slide',
	slideHed: '.slidehed',
	nextSlide : '.next-slide',
	prevSlide : '.prev-slide',
	addPagination: false,
	addNav : false,
	speed: 700 // ms.
});

$('.slidewrap1').carousel({ 
namespace: "carousel1", // Defaults to “carousel”.
speed: 600 // ms.
})

$('.slidewrap2').carousel({ 
namespace: "carousel2", // Defaults to “carousel”.
speed: 600 // ms.
})

$('.slidewrap3').carousel({ 
namespace: "carousel3", // Defaults to “carousel”.
speed: 600 // ms.
})

$('.slidewrap4').carousel({ 
namespace: "carousel4", // Defaults to “carousel”.
speed: 600 // ms.
})

// works hover effect 
$('.recent-work .item').hover(function(){
	$(".img-caption", this).stop().animate({top:'0'},{queue:false,duration:400});
}, function() {
	$(".img-caption", this).stop().animate({top:'100%'},{queue:false,duration:400});
});

$('.portfolio .item').hover(function(){
	$(".img-caption", this).stop().animate({top:'0'},{queue:false,duration:400});
}, function() {
	$(".img-caption", this).stop().animate({top:'100%'},{queue:false,duration:400});
});

$('.gallery .item').hover(function(){
	$(".img-caption", this).stop().animate({top:'0'},{queue:false,duration:400});
}, function() {
	$(".img-caption", this).stop().animate({top:'100%'},{queue:false,duration:400});
});

// Tooltips
/* Adding a colortip to any tag with a data attribute: */
$('[data]').colorTip({color:'yellow'});

// UItoTop plugin 	
$().UItoTop({ easingType: 'easeOutQuart' });
 
// reponsive menu
$("#menu > a").click(function () {
      $("#menu > ul").slideToggle("fast");
});

(function ($) {
$('#menu > a').bind('click', function () {
  if ($(this).hasClass('current')) {
	  $(this).removeClass('current');
	  $(this).parent().parent().find('#menu > ul').slideUp('fast');
	  
	  return false;
  } else {
	  $(this).addClass('current');
	  $('#menu').removeClass('navigation');
	  $('#menu').addClass('responsive');
	  $(this).parent().parent().find('#menu > ul').slideDown('fast');
	  
	  return false;
  }
} );


$(window).bind('resize', function () { 
  if ($(this).width() > 959) {
	  $('#menu > a').removeClass('current');
	  $('#menu').removeClass('responsive');
	  $('#menu').addClass('navigation');
	  $('#menu > ul').removeAttr('style');
  } else {
	  $('#menu').removeClass('navigation');
	  $('#menu').addClass('responsive');  
  }
} );
} )(jQuery);



// Touch-friendly drop-down navigation
$( '#menu li:has(ul)' ).doubleTapToGo();

$(function() {
    $('#menu a').each(function() {
        if ( $(this).parent('li').children('ul').size() > 0 ) {
            $(this).append('<i class="icon-angle-down responsive"></i>');
        }           
    });
});

$("a.down-button").click(function () {
      $(".slidedown").slideToggle("slow");
});

// top bar show & hide
(function ($) {
$('a.down-button').bind('click', function () {
  if ($(this).hasClass('current')) {
	  $(this).removeClass('current');
	  $('a.down-button > i').removeClass('icon-angle-up');
	  $('a.down-button > i').addClass('icon-angle-down');
	  $(this).parent().parent().find('.slidedown').slideUp('slow');
	  
	  return false;
  } else {
	  $(this).addClass('current');
	  $('a.down-button > i').removeClass('icon-angle-down');
	  $('a.down-button > i').addClass('icon-angle-up');
	  $(this).parent().parent().find('.slidedown').slideDown('slow');
	  
	  return false;
  }
} );


$(window).bind('resize', function () { 
  if ($(this).width() > 768) {
	  $('a.down-button').removeClass('current');
	  $('a.down-button > i').removeClass('icon-angle-up');
	  $('a.down-button > i').addClass('icon-angle-down');
	  $('.slidedown').removeAttr('style');
  }
} );
} )(jQuery);

// Accordion
$("#accordion").accordion({
   autoHeight: false,
   //active: '.selected', 
   //selectedClass: 'active', 
   icons: { "header": "icon-plus", "activeHeader": "icon-minus" }
});
$("#accordion2").accordion({
   autoHeight: false,
   //active: '.selected', 
   //selectedClass: 'active', 
   icons: { "header": "icon-plus", "activeHeader": "icon-minus" }
});
$("#accordion3").accordion({
   autoHeight: false,
   active: '.selected', 
   selectedClass: 'active', 
   icons: { "header": "icon-plus", "activeHeader": "icon-minus" }
});
$("#accordion4").accordion({
   autoHeight: false,
   active: '.selected', 
   selectedClass: 'active', 
   icons: { "header": "icon-plus", "activeHeader": "icon-minus" }
});
$("#accordion5").accordion({
   autoHeight: false,
   active: '.selected', 
   selectedClass: 'active', 
   icons: { "header": "icon-plus", "activeHeader": "icon-minus" }
});
$("#accordion6").accordion({
   autoHeight: false,
   active: '.selected', 
   selectedClass: 'active', 
   icons: { "header": "icon-plus", "activeHeader": "icon-minus" }
});
$("#accordion7").accordion({
   autoHeight: false,
   active: '.selected', 
   selectedClass: 'active', 
   icons: { "header": "icon-plus", "activeHeader": "icon-minus" }
});
$("#accordion8").accordion({
   autoHeight: false,
   active: '.selected', 
   selectedClass: 'active', 
   icons: { "header": "icon-plus", "activeHeader": "icon-minus" }
});
$("#accordion9").accordion({
   autoHeight: false,
   active: '.selected', 
   selectedClass: 'active', 
   icons: { "header": "icon-plus", "activeHeader": "icon-minus" }
});
$("#accordion10").accordion({
   autoHeight: false,
   active: '.selected', 
   selectedClass: 'active', 
   icons: { "header": "icon-plus", "activeHeader": "icon-minus" }
});


// Progress Bar
setTimeout(function(){
$('.meter .meter-content').each(function() {
var me = $(this);
var perc = me.attr("data-percentage");
var current_perc = 0;
var progress = setInterval(function() {
if (current_perc>=perc) {
	clearInterval(progress);
} else {
	current_perc +=1;
	me.css('width', (current_perc)+'%');
}
me.text((current_perc)+'%');
}, 10);
});
},10);

// Tabs
$("#horizontal-tabs").tytabs({
  tabinit:"1",
  fadespeed:"fast"
  //catchget:"tab2"
  });
$("#horizontal-tabs.two").tytabs({
  tabinit:"1",
  prefixtabs:"tab_two",
  prefixcontent:"content_two",
  fadespeed:"fast"
  });
$("#horizontal-tabs.three").tytabs({
  tabinit:"1",
  prefixtabs:"tab_three",
  prefixcontent:"content_three",
  fadespeed:"fast"
  });
$("#horizontal-tabs.four").tytabs({
  tabinit:"1",
  prefixtabs:"tab_four",
  prefixcontent:"content_four",
  fadespeed:"fast"
  });
$("#horizontal-tabs.five").tytabs({
  tabinit:"1",
  prefixtabs:"tab_five",
  prefixcontent:"content_five",
  fadespeed:"fast"
  });

$("#vertical-tabs").tytabs({
  tabinit:"1",
  prefixtabs:"tab_v",
  prefixcontent:"content_v",
  fadespeed:"fast"
  });
$("#vertical-tabs.two").tytabs({
  tabinit:"1",
  prefixtabs:"tab_v_two",
  prefixcontent:"content_v_two",
  fadespeed:"fast"
  });
$("#vertical-tabs.three").tytabs({
  tabinit:"1",
  prefixtabs:"tab_v_three",
  prefixcontent:"content_v_three",
  fadespeed:"fast"
  });
$("#vertical-tabs.four").tytabs({
  tabinit:"1",
  prefixtabs:"tab_v_four",
  prefixcontent:"content_v_four",
  fadespeed:"fast"
  });
$("#vertical-tabs.five").tytabs({
  tabinit:"1",
  prefixtabs:"tab_v_five",
  prefixcontent:"content_v_five",
  fadespeed:"fast"
  });


// Alert Boxes
$(".hideit").click(function() {
  $(this).fadeOut(600);
});

// Toggle
$('#toggle-view li h4').click(function () {

var text = $(this).siblings('div.panel');

if (text.is(':hidden')) {
	text.slideDown('200');
	$(this).siblings('span').html('-');		
} else {
	text.slideUp('200');
	$(this).siblings('span').html('+');		
}
});


// Isotope Filtering
$(function(){
      
var $container = $('#contain');

// initialize Isotope
  $container.isotope({
	// options...
	resizable: false, // disable normal resizing
	// set columnWidth to a percentage of container width
	masonry: { columnWidth: $container.width() / 12 }
  });

  // update columnWidth on window resize
  $(window).smartresize(function(){
	$container.isotope({
	  // update columnWidth to a percentage of container width
	  masonry: { columnWidth: $container.width() / 12 }
	});
  });
  

$container.isotope({
  itemSelector : '.item',
   animationOptions: {
     duration: 750,
     easing: 'linear',
     queue: true
   }
});


var $optionSets = $('#options .option-set'),
	$optionLinks = $optionSets.find('a');

$optionLinks.click(function(){
  var $this = $(this);
  // don't proceed if already selected
  if ( $this.hasClass('selected') ) {
	return false;
  }
  var $optionSet = $this.parents('.option-set');
  $optionSet.find('.selected').removeClass('selected');
  $this.addClass('selected');

  // make option object dynamically, i.e. { filter: '.my-filter-class' }
  var options = {},
	  key = $optionSet.attr('data-option-key'),
	  value = $this.attr('data-option-value');
  // parse 'false' as false boolean
  value = value === 'false' ? false : value;
  options[ key ] = value;
  if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
	// changes in layout modes need extra logic
	changeLayoutMode( $this, options )
  } else {
	// otherwise, apply new options
	$container.isotope( options );
  }
  
  return false;
});


});


// Flex Slider
  $(window).ready(function() {
						   
  $('.flexslider').flexslider({
	animation: 'fade',
	animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
	slideshow: true,                //Boolean: Animate slider automatically
	slideshowSpeed: 6000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
	animationSpeed: 800,             //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
	pauseOnHover: true, 
	pauseOnAction:true,
	controlNav: false,
	directionNav: true,
	controlsContainer: '.flex-container',
	start: function(slider) {
		 var toptitle = $('.slider-1 .flex-active-slide h2').data('toptitle');
		 var topimage = $('.slider-1 .flex-active-slide .item').data('topimage');
		 var bottomtext = $('.slider-1 .flex-active-slide p').data('bottomtext');
		 var bottomlinks = $('.slider-1 .flex-active-slide .links').data('bottomlinks');
		 
		 $('.slider-1 .flex-active-slide').find('.item').css({ top: topimage});
         $('.slider-1 .flex-active-slide').find('.item').animate({ right: '0', opacity: '1'}, 1000);
		 $('.slider-1 .flex-active-slide').find('h2').animate({ left: '0', top: toptitle, opacity: '1'}, 1500);
		 $('.slider-1 .flex-active-slide').find('p').animate({ left: '0', bottom: bottomtext, opacity: '1'}, 1500);
		 $('.slider-1 .flex-active-slide').find('.links').animate({ left: '0', bottom: bottomlinks, opacity: '1'}, 1800);
		 
		 // remove class loading after start
		 slider.removeClass('loading');
      },
	before: function(slider) {
         $('.slider-1 .flex-active-slide').find('.item').animate({ right: '-100%', opacity: '0'}, 1000);
		 $('.slider-1 .flex-active-slide').find('h2').animate({ left: '0', top: '-100%', opacity: '0'}, 1500);
		 $('.slider-1 .flex-active-slide').find('p').animate({ left: '0', bottom: '-50%', opacity: '0'}, 1500);
		 $('.slider-1 .flex-active-slide').find('.links').animate({ left: '0', bottom: '-100%', opacity: '0'}, 1800);
      },
	after: function(slider) {
		 var toptitle = $('.slider-1 .flex-active-slide h2').data('toptitle');
		 var topimage = $('.slider-1 .flex-active-slide .item').data('topimage');
		 var bottomtext = $('.slider-1 .flex-active-slide p').data('bottomtext');
		 var bottomlinks = $('.slider-1 .flex-active-slide .links').data('bottomlinks');
		 
		 $('.slider-1 .flex-active-slide').find('.item').css({ top: topimage});
         $('.slider-1 .flex-active-slide').find('.item').animate({ right: '0', opacity: '1'}, 1000);
		 $('.slider-1 .flex-active-slide').find('h2').animate({ left: '0', top: toptitle, opacity: '1'}, 1500);
		 $('.slider-1 .flex-active-slide').find('p').animate({ left: '0', bottom: bottomtext, opacity: '1'}, 1500);
		 $('.slider-1 .flex-active-slide').find('.links').animate({ left: '0', bottom: bottomlinks, opacity: '1'}, 1800);
      }
		});
  
  $('.flexslider4').flexslider({
	animation: 'fade',
	animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
	slideshow: true,                //Boolean: Animate slider automatically
	slideshowSpeed: 6000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
	animationSpeed: 800,             //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
	pauseOnHover: true, 
	pauseOnAction:true,
	controlNav: false,
	directionNav: true,
	controlsContainer: '.flex-container',
	start: function(slider) {
		 var bottomtitle = $('.slider-2 .flex-active-slide h2').data('bottomtitle');
		 var bottomtext = $('.slider-2 .flex-active-slide p').data('bottomtext');
		 var bottomlinks = $('.slider-2 .flex-active-slide .links').data('bottomlinks');
		 
		 $('.slider-2 .flex-active-slide').find('h2').animate({ bottom: bottomtitle, opacity: '1'}, 1500);
		 $('.slider-2 .flex-active-slide').find('p').animate({ bottom: bottomtext, opacity: '1'}, 2000);
		 $('.slider-2 .flex-active-slide').find('.links').animate({ bottom: bottomlinks, opacity: '1'}, 2200);
		 
		 // remove class loading after start
		 slider.removeClass('loading');
      },
	before: function(slider) {
		 $('.slider-2 .flex-active-slide').find('h2').animate({ bottom: '-20%', opacity: '0'}, 1500);
		 $('.slider-2 .flex-active-slide').find('p').animate({ bottom: '-50%', opacity: '0'}, 2000);
		 $('.slider-2 .flex-active-slide').find('.links').animate({ bottom: '-60%', opacity: '0'}, 2200);
      },
	after: function(slider) {
		  var bottomtitle = $('.slider-2 .flex-active-slide h2').data('bottomtitle');
		 var bottomtext = $('.slider-2 .flex-active-slide p').data('bottomtext');
		 var bottomlinks = $('.slider-2 .flex-active-slide .links').data('bottomlinks');
		 
		 $('.slider-2 .flex-active-slide').find('h2').animate({ bottom: bottomtitle, opacity: '1'}, 1500);
		 $('.slider-2 .flex-active-slide').find('p').animate({  bottom: bottomtext, opacity: '1'}, 2000);
		 $('.slider-2 .flex-active-slide').find('.links').animate({  bottom: bottomlinks, opacity: '1'}, 2200);
      }
		});
  
  $('.flexslider2').flexslider({
	animation: 'slide',
	animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
	slideshow: true,                //Boolean: Animate slider automatically
	slideshowSpeed: 4500,           //Integer: Set the speed of the slideshow cycling, in milliseconds
	animationSpeed: 700,             //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
	pauseOnHover: true, 
	pauseOnAction:false,
	controlNav: false,
	directionNav: true,
	controlsContainer: '.flex-container'
		});
  
  $('.flexslider3').flexslider({
	animation: 'slide',
	animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
	slideshow: false,                //Boolean: Animate slider automatically
	slideshowSpeed: 4500,           //Integer: Set the speed of the slideshow cycling, in milliseconds
	animationSpeed: 700,             //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
	pauseOnHover: true, 
	pauseOnAction:false,
	controlNav: false,
	directionNav: true,
	controlsContainer: '.flex-container'
		});
  
  
	});

/* FancyBox plugin */
$('.fancybox').fancybox({

prevEffect : 'none',
nextEffect : 'none',
loop : false

});


/* header fixed with sticky plugin */
$("header.fixed .main-header").sticky({ topSpacing: 0 });
/* this for header 3 and 5
$("header.fixed .down-header").sticky({ topSpacing: 0 });
*/
$('.sticky-wrapper').removeAttr('style');
								
});