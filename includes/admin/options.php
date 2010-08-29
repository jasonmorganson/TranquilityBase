<?php

global $themename, $shortname, $options;

$options = array (
   
    array(  "section" => "Layout",
    		"description" => "Total Width<br><span style='font-size: 10px; color: #FF8A00;'>Warning: No validation performed, this must be accurate</span>",
            "id" => "total-width",
            "default" => "950",
            "type" => "text"),

    array(  "section" => "Layout",
    		"description" => "Content Width",
            "id" => "content-width",
            "default" => "450",
            "type" => "text"),

    array(  "section" => "Layout",
    		"description" => "Left Sidebar Width<br><span style='font-size: 12px;'>If you set this to zero it will remove the sidebar completely</span><br><span style='font-size: 10px; color: #FF8A00;'>Note: Setting to zero will change all the page templates also</span>",
	  		"id" => "sidebar-left-width",
            "default" => "200",
            "type" => "text"),

    array(  "section" => "Layout",
    		"description" => "Right Sidebar Width<br><span style='font-size: 12px;'>If you set this to zero it will remove the sidebar completely</span><br><span style='font-size: 10px; color: #FF8A00;'>Note: Setting to zero will change all the page templates also</span>",
	  		"id" => "sidebar-right-width",
            "default" => "200",
            "type" => "text"),


/*
    array(  "section" => "Layout",
			"description" => "Site same and description position<br />(Relative to the header banner)",
            "id" => $shortname."_name_position",
            "type" => "select",
            "default" => "Inside",
            "options" => array("Inside", "Above" )),

    array(  "section" => "Layout",
			"description" => "Top navigation position",
            "id" => $shortname."_nav_position",
            "type" => "select",
            "default" => "Above",
            "options" => array("Left", "Above", "Right" )),
        
    array(  "section" => "Layout",
			"description" => "Top navigation alignment",
            "id" => $shortname."_nav_align",
            "type" => "select",
            "default" => "Center",
            "options" => array("Left", "Center", "Right" )),
*/          

    /* Banner */
    
    array(  "section" => "Banner",
    		"description" => "Banner Width",
            "id" => "banner_width",
            "default" => "950",
            "type" => "text"),

    array(  "section" => "Banner",
    		"description" => "Banner Height",
            "id" => "banner_height",
            "default" => "200",
            "type" => "text"),


/*   
    array(  "section" => "Fonts",
			"description" => "Font Family",
            "id" => $shortname."_body_font",
            "type" => "select",
            "default" => "Verdana",
            "options" => array("Trebuchet MS", "Verdana", "Arial", "Georgia")),
*/

	/* Images */

/*	
	array(  "section" => "Images",
    		"description" => "Body Background Image",
            "id" => $shortname."_content_background_image",
            "default" => "",
            "type" => "text"),
*/
            
	/* Colors */

/*
	array(  "section" => "Colors",
			"description" => "Font Color",
            "id" => $shortname."_font_color",
            "default" => "#574f4a",
            "type" => "text"),

	array(  "section" => "Colors",
			"description" => "Body Background Color",
            "id" => $shortname."_bg_color",
            "default" => "#574f4a",
            "type" => "text"),

	array(  "section" => "Colors",
			"description" => "Header Band Color",
            "id" => $shortname."_band_color",
            "default" => "#574f4a",
            "type" => "text"),

    array(  "section" => "Colors",
    		"description" => "Content Background Color",
            "id" => $shortname."_content_background_color",
            "default" => "#FFFFFF",
            "type" => "text"),

    array(  "section" => "Colors",
    		"description" => "Content Border Color",
            "id" => $shortname."_content_border_color",
            "default" => "#EBEBEB",
            "type" => "text"),
			
	array(    "description" => "Link Color",
            "id" => $shortname."_link_color",
            "default" => "#605752",
            "type" => "text"),

	array(    "description" => "Navigation Link Color <br><span style='font-size: 10px; color: #FF8A00;'>(controls the color of the Pages links)</span>",
            "id" => $shortname."_nav_color",
            "default" => "#52094e",
            "type" => "text"),
			
	array(    "description" => "Categories Link Color <br><span style='font-size: 10px; color: #FF8A00;'>(controls the color of category links)</span>",
            "id" => $shortname."_cat_color",
            "default" => "#ffa4ff",
            "type" => "text"),
*/				

/*

	array(  "section" => "Effects",
			"description" => "Rounded corners",
            "id" => $shortname."_fc",
            "default" => "#false",
            "type" => "checkbox"),
            
	array(  "section" => "Effects",
			"description" => "Body drop shadow",
            "id" => $shortname."_fc",
            "default" => "#false",
            "type" => "checkbox"),

	array(  "section" => "Effects",
			"description" => "Band backlight",
            "id" => $shortname."_fc",
            "default" => "#false",
            "type" => "checkbox"),

	
    array(    "description" => "Hide/Display Share Button <br><span style='font-size: 10px; color: #FF8A00;'>(choosing hidden will remove the <br>share button one post pages)</span>",
            "id" => $shortname."_share",
            "type" => "select",
            "default" => "visible",
            "options" => array("visible", "hidden")),
*/				


	array(  "section" => "Stylesheets",
			"description" => "Minify stylesheets",
            "id" => "minify_css",
            "default" => "false",
            "type" => "checkbox"),	
	
	array(  "section" => "Stylesheets",
			"description" => "Embed data URIs in stylesheets",
            "id" => "embed_uris",
            "default" => "false",
            "type" => "checkbox"),	            

	array(  "section" => "Footer",
			"description" => "Copyright",
            "id" => $shortname."_copyright",
            "default" => "© Copyright 2010. All rights reserved.",
            "type" => "text"),			

);

?>