<?php

add_action('init', 'of_options');
if (!function_exists('of_options')) {

    function of_options() {
        // VARIABLES
        $themename = 'One page Theme';
        $shortname = "of";
        // Populate OptionsFramework option in array for use in theme
        global $of_options;
        $of_options = onepage_get_option('of_options');
        //Front page on/off
        $file_rename = array("on" => "On", "off" => "Off");
        $home_page_blog_content = array("on" => "On", "off" => "Off");
        // Background Defaults
        $background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat', 'position' => 'top center', 'attachment' => 'scroll');
        //Stylesheet Reader
        // Pull all the categories into an array
        $options_categories = array();
        $options_categories_obj = get_categories();
        foreach ($options_categories_obj as $category) {
            $options_categories[$category->cat_ID] = $category->cat_name;
        }

        // Populate OptionsFramework option in array for use in theme
        $contact_option = array("on" => "On", "off" => "Off");
        $captcha_option = array("on" => "On", "off" => "Off");
        // Pull all the pages into an array
        $options_pages = array();
        $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
        $options_pages[''] = 'Select a page:';
        foreach ($options_pages_obj as $page) {
            $options_pages[$page->ID] = $page->post_title;
        }
        // If using image radio buttons, define a directory path
        $imagepath = get_template_directory_uri() . '/images/';

        $options = array(
            array("name" => "General Settings",
                "type" => "heading"),
            array("name" => "Custom Logo",
                "desc" => "Upload a logo for your Website. The recommended size for the logo is 250px width x 50px height.",
                "id" => "onepage_logo",
                "type" => "upload"),
            array("name" => "Custom Favicon",
                "desc" => "Here you can upload a Favicon for your Website. Specified size is 16px x 16px.",
                "id" => "onepage_favicon",
                "type" => "upload"),
            array("name" => "Contact Number",
                "desc" => "Mention your contact number here through which users can interact to you directly.",
                "id" => "onepage_contact_number",
                "std" => "",
                "type" => "text"),
            array("name" => "Mobile Navigation Menu",
                "desc" => "Enter your mobile navigation menu text",
                "id" => "onepage_nav",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Front Page On/Off",
                "desc" => "If the front page option is active then home page will appear otherwise blog page will display.",
                "id" => "re_nm",
                "std" => "on",
                "type" => "radio",
                "options" => $file_rename),
            array("name" => "Optional Menu on Home Page",
                "type" => "saperate",
                "class" => "saperator"),
            array("name" => "Optional Menu Title",
                "desc" => "Here you can create a page menu that will display in menu section on your featured homepage besides the default featured home page menu. It is optional.",
                "id" => "onepage_opt_menu_heading",
                "std" => "",
                "type" => "text"),
            array("name" => "Optional Menu Link",
                "desc" => "Here you can mention a URL for the optional menu that will redirect the users to the a particular page.",
                "id" => "onepage_opt_menu_link",
                "std" => "",
                "type" => "text"),
            //Home Page Slider Setting
            array("name" => "Homepage Top Feature Area",
                "type" => "heading"),
            //First Slider
            array("name" => "Homepage Fulwidth Featured Image",
                "type" => "saperate",
                "class" => "saperator"),
            array("name" => "Featured Image",
                "desc" => "The optimal size of the image is 1920 px wide x 654 px height, but it can be varied as per your requirement.",
                "id" => "onepage_slideimage1",
                "std" => "",
                "type" => "upload"),
            array("name" => "Featured Image",
                "desc" => "Mention the heading for the featured image.",
                "id" => "onepage_sliderheading1",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Link for Featured Image",
                "desc" => "Mention the URL for featured image.",
                "id" => "onepage_Sliderlink1",
                "std" => "",
                "type" => "text"),
            array("name" => "Featured Image Description",
                "desc" => "Here mention a short description for the featured image heading.",
                "id" => "onepage_sliderdes1",
                "std" => "",
                "type" => "textarea"),
            //****=============================================================================****//
            //Homepage Feature Area Section1
            array("name" => "Homepage Feature Area",
                "type" => "heading"),
            array("name" => "Featured Heading",
                "desc" => "Mention the punch line for your business here.",
                "id" => "onepage_page_main_heading",
                "std" => "",
                "type" => "textarea"),
            array("name" => "Featured Sub Heading",
                "desc" => "Mention the tagline for your business here that will complement the punch line.",
                "id" => "onepage_page_sub_heading",
                "std" => "",
                "type" => "textarea"),
            //****=============================================================================****//
            //Home Page Our Services Section 2		
            array("name" => "Homepage Services Section",
                "type" => "heading"),
            array("name" => "Heading",
                "desc" => "Here you can mention a suitable heading for your services. It will also appear on the home page menu.",
                "id" => "onepage_our_services_heading",
                "std" => "",
                "type" => "text"),
            // Services block 1
            array("name" => "First block",
                "type" => "saperate",
                "class" => "saperator"),
            array("name" => "First Image",
                "desc" => "The optimal size of the image is 264 px wide x 264 px height, but it can be varied as per your requirement.",
                "id" => "onepage_our_services_image1",
                "std" => "",
                "type" => "upload"),
            array("name" => "Title 1",
                "desc" => "Here you can mention a suitable title that will display the title in services section.",
                "id" => "onepage_our_services_title1",
                "std" => "",
                "type" => "text"),
            array("name" => "Link for Title 1",
                "desc" => "Mention the URL for Title 1",
                "id" => "onepage_services_title_link1",
                "std" => "",
                "type" => "text"),
            array("name" => "Description 1",
                "desc" => "Here you can mention a suitable title that will display the small description in services section.",
                "id" => "onepage_our_services_desc1",
                "std" => "",
                "type" => "textarea"),
            // Services block 2
            array("name" => "Second Block",
                "type" => "saperate",
                "class" => "saperator"),
            array("name" => "Second Image",
                "desc" => "The optimal size of the image is 264 px wide x 264 px height, but it can be varied as per your requirement.",
                "id" => "onepage_our_services_image2",
                "std" => "",
                "type" => "upload"),
            array("name" => "Title 2",
                "desc" => "Here you can mention a suitable title that will display the title in services section.",
                "id" => "onepage_our_services_title2",
                "std" => "",
                "type" => "text"),
            array("name" => "Link for Title 2",
                "desc" => "Mention the URL for Title2",
                "id" => "onepage_services_title_link2",
                "std" => "",
                "type" => "text"),
            array("name" => "Description 2",
                "desc" => "Here you can mention a suitable title that will display the small description in services section.",
                "id" => "onepage_our_services_desc2",
                "std" => "",
                "type" => "textarea"),
            // Services block 3
            array("name" => "Third block",
                "type" => "saperate",
                "class" => "saperator"),
            array("name" => "Third Image",
                "desc" => "The optimal size of the image is 264 px wide x 264 px height, but it can be varied as per your requirement.",
                "id" => "onepage_our_services_image3",
                "std" => "",
                "type" => "upload"),
            array("name" => "Title 3",
                "desc" => "Here you can mention a suitable title that will display the title in services section.",
                "id" => "onepage_our_services_title3",
                "std" => "",
                "type" => "text"),
            array("name" => "Link for Title 3",
                "desc" => "Mention the URL for Title 3",
                "id" => "onepage_services_title_link3",
                "std" => "",
                "type" => "text"),
            array("name" => "Description 3",
                "desc" => "Here you can mention a suitable title that will display the small description in services section.",
                "id" => "onepage_our_services_desc3",
                "std" => "",
                "type" => "textarea"),
            // Services block 4
            $options[] = array("name" => "Fourth block",
        "type" => "saperate",
        "class" => "saperator"),
            array("name" => "Fourth Image",
                "desc" => "The optimal size of the image is 264 px wide x 264 px height, but it can be varied as per your requirement.",
                "id" => "onepage_our_services_image4",
                "std" => "",
                "type" => "upload"),
            array("name" => "Title 4",
                "desc" => "Here you can mention a suitable title that will display the title in services section.",
                "id" => "onepage_our_services_title4",
                "std" => "",
                "type" => "text"),
            array("name" => "Link for Title 4",
                "desc" => "Mention the URL for Title 4",
                "id" => "onepage_services_title_link4",
                "std" => "",
                "type" => "text"),
            array("name" => "Description 4",
                "desc" => "Here you can mention a suitable title that will display the small description in services section.",
                "id" => "onepage_our_services_desc4",
                "std" => "",
                "type" => "textarea"),
            //****=============================================================================****//
            //Home Page Blog Section 3		
            array("name" => "Homepage Recent Blogs Section",
                "type" => "heading"),
            // blog block 1
            array("name" => "Blog Heading",
                "desc" => "Here you can mention a suitable heading that will display as blog heading on home page. Also display on the menu.",
                "id" => "onepage_recent_blog_heading",
                "std" => "",
                "type" => "text"),
            array("name" => "To show your recent posts on home page you need to insert the feature image of the blog while publishing it.",
                "desc" => "",
                "id" => "",
                "std" => "",
                "type" => ""),
            //****=============================================================================****//
            //****=============================================================================****//
            //Home Page Contact Section 5		
            array("name" => "Contact Section",
                "type" => "heading"),
            // contact block 0
            array("name" => "Contact Heading",
                "desc" => "Here you can mention a suitable heading that will display as your contact title on home page. Also display on the menu.",
                "id" => "onepage_our_contact_heading",
                "std" => "",
                "type" => "text"),
            // contact block 1
            array("name" => "Contact Sub Heading",
                "desc" => "Here you can mention a suitable heading that will display as contact heading on the right side of home page under contact section.",
                "id" => "onepage_our_contact_sub_heading",
                "std" => "",
                "type" => "text"),
            array("name" => "Business Address",
                "desc" => "Here you can put your business address that will display on home page of your website.",
                "id" => "onepage_contact_address",
                "std" => "",
                "type" => "text"),
            array("name" => "Contact Number",
                "desc" => "Here you can mention your contact number that will appear on home page.",
                "id" => "onepage_contact_phone_no",
                "std" => "",
                "type" => "text"),
            array("name" => "Contact Email",
                "desc" => "Here you can mention your email id that will appear on home page.",
                "id" => "onepage_ontact_email",
                "std" => "",
                "type" => "text"),
            array("name" => " Your Website",
                "desc" => "Here you can mention your website name that will appear on home page.",
                "id" => "onepage_contact_website",
                "std" => "",
                "type" => "text"),
            
            //****=============================================================================****//
            //****=========Optional Menu Frontpage ============================================****//
//****=============================================================================****//
//****=============================================================================****//
//****-------------This code is used for creating social logos options-------------****//					
//****=============================================================================****//
            array("name" => "Social Icons",
                "type" => "heading"),
            array("name" => "Facebook URL",
                "desc" => "Mention the URL of your Facebook here.",
                "id" => "onepage_facebook",
                "std" => "",
                "type" => "text"),
            array("name" => "Twitter URL",
                "desc" => "Mention the URL of your Twitter here.",
                "id" => "onepage_twitter",
                "std" => "",
                "type" => "text"),
            array("name" => "Google+ URL",
                "desc" => "Mention the URL of your Google+ here.",
                "id" => "onepage_google",
                "std" => "",
                "type" => "text"),
            array("name" => "Rss Feed URL",
                "desc" => "Mention the URL of your Rss Feed here.",
                "id" => "onepage_rss",
                "std" => "",
                "type" => "text"),
            array("name" => "Pinterest URL",
                "desc" => "Mention the URL of your Pinterest here.",
                "id" => "onepage_pinterest",
                "std" => "",
                "type" => "text"),
            array("name" => "YouTube URL",
                "desc" => "Mention the URL of your YouTube here.",
                "id" => "onepage_youtube",
                "std" => "",
                "type" => "text"));

        onepage_update_option('of_template', $options);
        onepage_update_option('of_themename', $themename);
        onepage_update_option('of_shortname', $shortname);
    }

}
?>
