jQuery(document).ready(function() {
	
/* Navigation */
	jQuery('#submenu ul.sfmenu').superfish({ 
		delay:       500,								// 0.1 second delay on mouseout 
		animation:   { opacity:'show',height:'show'},	// fade-in and slide-down animation 
		dropShadows: true								// disable drop shadows 
	});	


/* Banner class */

	jQuery('.squarebanner ul li:nth-child(even)').addClass('rbanner');



/* Responsive slides */


	jQuery('.flexslider').flexslider({
		controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		directionNav: true 
	});	


/* Fancybox */

	jQuery(".fancybox").fancybox({
          helpers: {
              title : {
                  type : 'float'
              }
          }
  });



/*  Homepage gallery   */
        
   jQuery(".article-box").hover(function(){
      jQuery(this).find(".post-hover").fadeIn();
    }
     ,function(){
     jQuery(this).find(".post-hover").fadeOut();
     }
    );  
  

});