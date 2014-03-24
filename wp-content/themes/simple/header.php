<!DOCTYPE htm <?php language_attributes(); ?>l>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

  <!-- Basic Page Needs -->
  <meta charset="utf-8">
  <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  <?php wp_head(); ?>
  
  <!--[if lt IE 9]>
      <script src="js/html5.js"></script>
  <![endif]-->

</head>
<body <?php body_class( $class ); ?>>

  <div id="wrap" class="boxed">
  
   <header>
   
   	 <?php if(vp_option('enable_top_toolbar') == '1'){ ?>
     <div class="top-bar">
       <div class="container clearfix">
        <div class="slidedown">
        
         <div class="eight columns">
           <div class="phone-mail">
           	 <?php if( vp_option('companynumber') != ''){ ?>
             <a><i class="icon-phone"></i> Phone : <?php echo vp_option('companynumber'); ?></a>
             <?php } ?>
             
             <?php if( vp_option('companyemail') != ''){ ?>
             <a href="info@website.com"><i class="icon-envelope-alt"></i> Mail : <?php echo vp_option('companyemail'); ?></a>
             <?php } ?>
           </div><!-- End phone-mail -->
         </div>
         <div class="eight columns">
         
         <?php if( vp_option('enable_header_icons') == '1'){ ?>
           <div class="social">
           
           <?php if( vp_option('twitter') != '' ){ ?>
           <a href="<?php echo vp_option('twitter'); ?>"><i class="social_icon-twitter s-14"></i></a>
           <?php } ?>
           
           <?php if( vp_option('facebook') != '' ){ ?>
           <a href="<?php echo vp_option('facebook'); ?>"><i class="social_icon-facebook s-18"></i></a>
           <?php } ?>
           
           <?php if( vp_option('dribbble') != '' ){ ?>
           <a href="<?php echo vp_option('dribbble'); ?>"><i class="social_icon-dribbble s-18"></i></a>
           <?php } ?>
           
           <?php if( vp_option('google') != '' ){ ?>
           <a href="<?php echo vp_option('google'); ?>"><i class="social_icon-gplus s-18"></i></a>
           <?php } ?>
           
           <?php if( vp_option('pinterest') != '' ){ ?>
           <a href="<?php echo vp_option('pinterest'); ?>"><i class="social_icon-pinterest s-18"></i></a>
           <?php } ?>
           
           <?php if( vp_option('youtube') != '' ){ ?>
           <a href="<?php echo vp_option('youtube'); ?>"><i class="social_icon-youtube s-18"></i></a>
           <?php } ?>
           
           <?php if( vp_option('enablerss') != '' ){ ?>
           <a href="<?php bloginfo('rss2_url'); ?>"><i class="social_icon-rss s-18"></i></a>
           <?php } ?>
           
           </div>
         <?php } ?>
         
          </div><!-- End social-icons -->
          
         </div><!-- End slidedown -->
       </div><!-- End Container -->
       
     </div><!-- End top-bar -->
     <?php } ?>
     
     <div class="main-header">
       <div class="container clearfix">
         <a href="#" class="down-button"><i class="icon-angle-down"></i></a><!-- this appear on small devices -->
         
          <?php if( vp_option('logo') != ''){ ?>
          <div class="one-third column">
          <div class="logo">
          <a href="<?php echo home_url( '/' ); ?>">
            <img src="<?php echo vp_option('logo'); ?>" alt="logo" />
          </a>
          </div>
          </div><!-- End Logo -->
          <?php } ?>
         
         
         <div class="two-thirds column">
          <nav id="menu" class="navigation" role="navigation">
          <a href="#">Show navigation</a><!-- this appear on small devices -->
          <?php get_template_part('nav'); ?>
         </nav>
        </div><!-- End Menu -->
       
       </div><!-- End Container -->
     </div><!-- End main-header -->
     
   </header><!-- <<< End Header >>> -->