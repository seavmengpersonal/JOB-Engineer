<?php


$themename = "Jobsapp";
$shortname = "jt";

$all_pages = get_pages();
$page_options = array();
$page_list = array();
$page_list_footer = array();
$checked_options = array();

foreach ($all_pages as $page){
    $page_list[] = "jobthemes_nav_header_".$page->ID;
    $page_list_footer[] = "jobthemes_nav_footer_".$page->ID;
    $page_title = get_page($page->ID);
    $page_options[] = $page_title->post_title;
    $checked_options[] = "not";
}



$options = array(    
    
    /*
     * 
     * General Settings Section
     * 
     */
	
    array(
        "type" => "section",
        "icon" => "jobthemes-icon-home",
        "title" => "General Settings",
        "id" => "general",
        "expanded" => "true"
    ),
    
    
    
    
    
    
    array(
        "section" => "general",
        "type" => "heading",
        "title" => "Visual (logo, favicon)",
        "id" => "general-visual"
    ),
    
	
	
	  array(
    "under_section" => "general-visual",
  	"name" => "Enable logo:",
	"tip" => "Paste the URL of your web site logo image here. It will replace the default Jobsapp logo.(i.e. yoursite.com/logo.jpg)",
	"desc" => "",
	"id" => "jr_use_logo",
	"type" => "select",
	"options" => array("Yes", "No"),
	"default" => "Yes",
	"std" => ""),
	
    array(
        "under_section" => "general-visual",
        "type" => "image",
        "placeholder" => "http://example.com/logo.png",
        "name" => "Logo",
        "id" => "jr_logo_url",
        "desc" => "Paste the URL to your logo, or upload it here.",
		"tip" => "Paste the URL of your web site logo image here. It will replace the default Jobsapp logo.(i.e. yoursite.com/logo.jpg)",
        "default" => ""),
    
    array(
        "under_section" => "general-visual",
        "type" => "image",
        "placeholder" => "http://example.com/favicon.png",
        "name" => "Favicon",
        "id" => "favicon",
        "desc" => "Paste the URL to your favicon, or upload it here (resolution of 32x32 or 16x16)",
		"tip" => "Paste the URL of favicon image here. (i.e. yoursite.com/favicon.ico)",
        "default" => ""),
    
    
	
	
	 array(
        "title" => "Social Networks:",
        "under_section" => "general-visual",
        "type" => "small_heading",
    ),
	array( 
	"under_section" => "general-visual",
	"name" => "Facebook",
	"desc" => "Paste your facebook page ID here.",
	"id" => "jr_facebook_id",
	"type" => "text",
	"tip" => "Paste your Facebook Page ID here.It will be used in home page buttons, You must have a Facebook account and page setup first.",
	"std" => ""),
	
	array( 
	"under_section" => "general-visual",
	"name" => "Twitter",
	"desc" => "Paste your twitter page ID here.",
	"id" => "jr_twitter_id",
	"type" => "text",
	"tip" => "Paste your Facebook Page ID here.It will be used in home page buttons, You must have a Facebook account and page setup first.",
	"std" => ""),
	
	array( 
	"under_section" => "general-visual",
	"name" => "Linkedin",
	"desc" => "Paste your linkedin id here.",
	"id" => "linkedin_id",
	"type" => "text",
	"tip" => "Paste your Facebook Page ID here.It will be used in home page buttons, You must have a Facebook account and page setup first.",
	"std" => ""),
	
	array( 
	"under_section" => "general-visual",
	"name" => "Feedburner",
	"desc" => "Paste your feedburner address here.",
	"id" => "jr_feedburner_url",
	"type" => "text",
	"tip" => "Paste your Feedburner address here. It will automatically redirect your default RSS feed to Feedburner. You must have a Google Feedburner account setup first.",
	"std" => ""),
	
	
	
	
		  array(
        "section" => "general",
        "type" => "heading",
        "title" => "Home settings (Buttons,..)",
        "id" => "home"
    ),
	
	
	
		array( 
	"under_section" => "home",
	"name" => "Title of button #1",
	"desc" => "Set the title You want to display in the first button .i.e. Featured",
	"id" => "tab_1_name",
	"type" => "text",
	"default" => "Featured jobs",
	"tip" => "Set the title of the first button in home page,If you don't want to display any content,leave it empty.",
	"std" => ""),
	
	array( 
	"under_section" => "home",
	"name" => "Content if the button #1 is clicked",
	"desc" => "Set the area you want to display by cliking on first button, i.e: featured.",
	"id" => "tab_1",
	"type" => "select",
	"default" => "Featured",
	"options" => array(
	"Nothing",
	"Featured",
	"Last-jobs",
	"Categories" ,
	"Locations" ,
	"Sponsored"),
	"tip" => "If you want to display nothing,Select -Nothing- in options and empty the title above.",
	"std" => "Featured"),
	
	
	

	
	array( 
	"under_section" => "home",
	"name" => "Title of button #2",
	"desc" => "Set the title You want to display in the second button, i.e. Last jobs",
	"id" => "tab_2_name",
	"type" => "text",
	"default" => "Last Jobs",
	"tip" => "Set the title of the second button in home page,If you dont want to display any content,leave it empty.",
	"std" => ""),
	
	array( 
	"under_section" => "home",
		"name" => "Content if the button #2 is clicked",
	"desc" => "Set the area you want to display by cliking on the second button i.e: Last jobs.",
	"id" => "tab_2",
	"type" => "select",
	"default" => "Last-jobs",
	"options" => array(
	"Nothing",
	"Featured",
	"Last-jobs",
	"Categories" ,
	"Locations" ,
	"Sponsored"),
	"tip" => "Set which section you want to display, If you want to display nothing,Select -Nothing- in options and empty the title above.",
	"std" => ""),
	
	
	
	
	
	
	
		array( 
	"under_section" => "home",
	"name" => "Title of button #3",
	"desc" => "Set the title You want to display in the third button, i.e. Jobs by categories",
	"id" => "tab_3_name",
	"type" => "text",
	"default" => "Jobs by category",
	"tip" => "Set the title of the third button in home page,If you dont want to display any content,leave it empty.",
	"std" => ""),
	
	
	array( 
	"under_section" => "home",
		"name" => "Content if the button #3 is clicked",
	"desc" => "Set the area you want to display by cliking on the third button, i.e: Browse by categories.",
	"id" => "tab_3",
	"type" => "select",
	"default" => "Categories",
	"options" => array(
	"Nothing",
	"Featured",
	"Last-jobs",
	"Categories" ,
	"Locations" ,
	"Sponsored"),
	"tip" => "Set which section you want to display,If you want to display nothing,Select -Nothing- in options and empty the title above.",
	"std" => ""),
	
	
	

	
	array( 
	"under_section" => "home",
	"name" => "Title of button #4",
	"desc" => "Set the title You want to display in forth the buttons, i.e. Jobs by location",
	"id" => "tab_4_name",
	"type" => "text",
	"default" => "Jobs by location",
	"tip" => "Set the title of the forth button in home page,If you dont want to display any content,leave it empty.",
	"std" => ""),
	
	
	
	
	array( 
	"under_section" => "home",
		"name" => "Content if the button #4 is clicked",
	"desc" => "Set the area you want to display by cliking on forth button, i.e. Jobs by location.",
	"id" => "tab_4",
	"type" => "select",
	"default" => "Locations",
	"options" => array(
	"Nothing",
	"Featured",
	"Last-jobs",
	"Categories" ,
	"Locations" ,
	"Sponsored"),
	"tip" => "Set which section you want to display,If you want to display nothing,Select -Nothing- in options and empty the title above.",
	"std" => "",),
	
	
	
	
	
	
	
		array( 
	"under_section" => "home",
	"name" => "Title of button #5",
	"desc" => "Set the title You want to display in the fifth button, i.e. Sponsored jobs",
	"id" => "tab_5_name",
	"default" => "Sponsored jobs",
	"type" => "text",
	"tip" => "Set the title of the firth button in home page,If you dont want to display any conten,leave it empty.",
	"std" => ""),
	
	array( 
	"under_section" => "home",
		"name" => "Content if the button #5 is clicked",
	"desc" => "Set the area you want to display by cliking on fifth button, i.e Sponsored jobs.",
	"id" => "tab_5",
	"type" => "select",
	"default" => "Sponsored",
	"options" => array(
	"Nothing",
	"Featured",
	"Last-jobs",
	"Categories" ,
	"Locations" ,
	"Sponsored"),
	"tip" => "Set which section you want to display,If you want to display nothing,Select -Nothing- in options and empty the title above.",
	"std" => ""),
	
	
	
	array(
        "section" => "general",
        "type" => "heading",
        "title" => "Layouts",
        "id" => "layout"
    ),
	
	
	
		array( 
	"under_section" => "layout",
	"name" => "<strong>Site layout:</strong>",
	"desc" => "Set the layout you prefer for your site.<br/> <strong>Simple layout:</strong> Display the job listings one above the other like the jobroller default style, no tabs.<br/> <strong>Modern layout:</strong> Display the tabs",
	"id" => "layout_style",
	"type" => "select",
	"options" => array	("Modern","Simple" ),
	"tip" => "Simple layout display the job listings one above the other like the jobroller default style, Modern one displays the tabs .",
	"std" => ""),
	
	
	
	
	
	
		
	  array(        
    "under_section" => "layout",
	"show_labels" => "false",
    "type" => "radio_image",
	"image_src" => array(
	get_bloginfo('stylesheet_directory')."/admin/"."assets/right.png",
	get_bloginfo('stylesheet_directory')."/admin/"."assets/left.png"),
	"image_size" => array( "50"),
	"name" => "<strong>Main layout:</strong>",
	"id" => "main_layout",
	"options" => array("right","left"),	
	"default" => "right",	
	"desc" => "Select which layout you want for your site.",
	"tip" => "Select which layout you want for your site, the sidebar in the right by default",
	),
	
	
	
	
	
	
			
	
	array(
        "title" => "Slider settings",
        "under_section" => "layout",
        "type" => "small_heading",
    ), 
	
	
 	 array(
        "under_section" => "layout",
	"type" => "select",
	"name" => "Enable Slider",
	"id" => "enable_slider" ,				
	"options" => array("Disable","Enable"),
    "desc" => "Select enable if you want to use the slider in the home page.",
	"tip" => "Show/Hide the slider",
	"default" => "Disable"),
    
    array(
        "type" => "toggle_div_start",
        "display_checkbox_id" => "enable_slider",
        "under_section" => "appearance-layouts",
    ),
	
	array(
    "under_section" => "layout", 
    "type" => "text", 
    "name" => "Slider name(alias):", 
    "id" => "slider_alias", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "placeholder" => "mainslider",
    "desc" => "<b>-</b>Go to the Revolution Slider sub menu => Get the alias name of the slider you prefer to use and copy it in this field.<br>
	<b>-Note:</b> the default slider is named mainslider.",
	"tip" => "Set the header background slider.",
    "default" => "mainslider",
	"std" => "mainslider"
),
	
    array(
        "type" => "toggle_div_end",
        "under_section" => "appearance-layouts",
    ),
	
	

 
   array(
    "under_section" => "layout", 
    "type" => "color", 
    "name" => "Slider background color:", 
    "id" => "slider_background", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "placeholder" => "",
    "desc" => "Set the background color for the slider.",
	"tip" => "Set the header background slider.",
    "default" => ""
),
		
		
		
		
		
		
	
	
	
	
	
	
	
	
	
	
	
	 array(
        "title" => "This creates/hides the footer columns in widgets admin area. make sure to update the widgets after you change this layout",
        "under_section" => "layout",
        "type" => "small_heading",
    ),
	
	array(        
    "under_section" => "layout",
	"show_labels" => "false",
    "type" => "radio_image",
	"image_src" => array(
	get_bloginfo('stylesheet_directory')."/admin/"."assets/footer-0.png",
	get_bloginfo('stylesheet_directory')."/admin/"."assets/footer-1.png",
	get_bloginfo('stylesheet_directory')."/admin/"."assets/footer-2.png",
	get_bloginfo('stylesheet_directory')."/admin/"."assets/footer-3.png",
	get_bloginfo('stylesheet_directory')."/admin/"."assets/footer-4.png"),
	"image_size" => array( "50"),
	"name" => "<strong>Footer layout:</strong>",
	"id" => "footer_layout",
	"options" => array( "0", "1","2","3","4"),					
	"desc" => "Select which layout you want for  the footer.",
	"tip" => "Select which layout you want for the footer.You can use no footer, one,2 or three footer areas.",
	"default" => "0" ),
	
	
		
		
		
		
		
		
		
		

		
		
		
		
		
	
	array(
        "section" => "general",
        "type" => "heading",
        "title" => "Home page content",
        "id" => "content"
    ),
	
	 array(
        "title" => "Home page content - Under header area",
        "under_section" => "content",
        "type" => "small_heading",
    ),
	
	
	array( 
	"under_section" => "content",
	"name" => "Under header area content:",
	"desc" => "Paste here html code, text, or images",
	"id" => "content_home",
	"type" => "textarea",
	"validate" => "html",
	"tip" => "You can add content in the aread under the header of the home page.",
	"std" => ""),
	
	 array(
        "under_section" => "content",
        "type" => "image",
        "placeholder" => "http://example.com/background.jpg",
        "name" => "Home page image:",
        "id" => "content_home_image",
        "desc" => "Paste the URL to the image, or upload it here, this image be placed in home content).",
		"tip" => "Upload an image to be used in the header area.",
        "default" => ""),
	
	
	
	array( 
	"under_section" => "content",
	"name" => "Image position:",
	"desc" => "",
	"id" => "home_image_float",
	"type" => "select",
	"validate" => "html",
	"options" => array("Left", "Right"),
	"default" => "left",
	"tip" => "Set the position of the image in the header above.",
	"std" => ""),
	
	
	
	
	
	
	
	
	 array(
        "title" => "Under tabs areas",
        "under_section" => "content",
        "type" => "small_heading",
    ),
	
	array( 
	"under_section" => "content",
	"name" => "Under -browse by category- tab area:",
	"desc" => "Paste here html code, text,or images inside browse by categories tab",
	"id" => "content_home_tab1",
	"type" => "textarea",
	"validate" => "html",
	"tip" => "Use this area to add content under the list of categories in home page.",
	"std" => ""),
	
	
	array( 
	"under_section" => "content",
	"name" => "Under -browse by location- tab area:",
	"desc" => "Paste here html code, text,or images inside browse by locations tab",
	"id" => "content_home_tab2",
	"type" => "textarea",
	"validate" => "html",
		"tip" => "Use this area to add content under the list of locations in home page.",
	"std" => ""),
	
	
	
	
	
	
	array(
        "section" => "general",
        "type" => "heading",
        "title" => "Header content",
        "id" => "header_content"
    ),
	
		
	
	
	
	
	
	 array(
        "title" => "Hints of the search form",
        "under_section" => "header_content",
        "type" => "small_heading",
    ),
	
	
	
	
	array( 
	"under_section" => "header_content",
	"name" => "Under keywords input",
	"id" => "header-1",
	"type" => "text",
	"default" => "ex.: Project Manager",
	"tip" => "Set the hint phrase or words.",
	"std" => ""),
	
	
		array( 
	"under_section" => "header_content",
	"name" => "Under Location input",
	"id" => "header-2",
	"type" => "text",
	"default" => "ex.: San Francisco",
	"tip" => "Set the hint phrase or words.",
	"std" => ""),
	
	
		array( 
	"under_section" => "header_content",
	"name" => "Under Radius input",
	"id" => "header-3",
	"type" => "text",
	"default" => "Radius",
	"tip" => "Set the hint phrase or words.",
	"std" => ""),
	
	
	
	
	
	
	
	
	array( 
	"under_section" => "header_content", 
	"name" => "Enable header area:",
	"desc" => "This shows a landing area in the header (With text and Images and action buttons).",
	"id" => "enable_landing_header",
	"type" => "select",
	"options" => array	("No","Home page only","Entire site"),
	"default" => "No",
	"tip" => "Enable a two column landing area in header.It's disabled by default",
	"std" => ""),
	
	 array(
        "title" => "HEADER: LEFT SIDE [Job seeker]",
        "under_section" => "header_content",
        "type" => "small_heading",
    ),
	
		array( 
	"under_section" => "header_content",
	"name" => "Left area content",
	"desc" => "",
	"id" => "header_left",
	"type" => "textarea",
	"validate" => "html",
	"tip" => "Add your text here to add content to the left side of the header landing area.(Submit a resume area)",
	"std" => ""),
	
	
	array( 
	"under_section" => "header_content",
	"name" => "Title of submit a resume",
	"desc" => "Set the title You want to display in the submit a resume button.",
	"id" => "submit_resume_name",
	"default" => "Submit a resume",
	"type" => "text",
	"tip" => "Set the title of the submit a resume button in the header.",
	"std" => ""),
	
	
	 array(
        "under_section" => "header_content",
        "type" => "image",
        "placeholder" => "http://example.com/background.jpg",
        "name" => "Left side image",
        "id" => "header_left_image",
        "desc" => "Paste the URL to the image, or upload it here, this image be placed in the header landing area).",
		"tip" => "Upload an image to use in left area of the header",
        "default" => ""),
	
	
	
	
	
	
	
	
	 array(
        "title" => "HEADER: RIGHT SIDE [Job lister]",
        "under_section" => "header_content",
        "type" => "small_heading",
    ),
	
		array( 
	"under_section" => "header_content",
	"name" => "Right area content",
	"desc" => "",
	"id" => "header_right",
	"type" => "textarea",
	"validate" => "html",
	"tip" => "Add your text here to add content to the right side of the header landing area.(Submit a a job area)",
	"std" => ""),
	
	
	
		array( 
	"under_section" => "header_content",
	"name" => "Title of submit a job",
	"desc" => "Set the title You want to display in the submit a job button.",
	"id" => "submit_job_name",
	"default" => "Submit a job",
	"tip" => "Set the title of the submit a job button in the header.",
	"type" => "text",
	"std" => ""),
	
	
	array(
        "under_section" => "header_content",
        "type" => "image",
        "placeholder" => "http://example.com/background.jpg",
        "name" => "Right side image",
        "id" => "header_right_image",
        "desc" => "Paste the URL to the image, or upload it here, this image be placed in the header landing area).",
		"tip" => "Upload an image to use in left area of the header",
        "default" => ""),
	
	
	
	
	
	
	
	
	
	
	
	array(
        "section" => "general",
        "type" => "heading",
        "title" => "Register page content",
        "id" => "login_content"
    ),
	
	 array(
        "title" => "List of services for job seekers.",
        "under_section" => "login_content",
        "type" => "small_heading",
    ),
	
	

	
	
	
	array( 
	"under_section" => "login_content",
	"name" => "Enable a job seeker register content:",
	"desc" => "",
	"id" => "enable_login_tab1",
	"type" => "select",
	"validate" => "html",
	"options" => array("Yes", "No"),
	"tip" => "Enable this option to display custom content inside the area in login/register page if job seeker role is selected.",
	"default" => "No",
	"std" => ""),
	
	
	
	
	array( 
	"under_section" => "login_content",
	"name" => "List of services for job seekers",
	"desc" => "Tell job seekers why they should register.use the same format in the textarea,one item entry per line . Dont use it if you want to dislay the default list.",
	"id" => "content_login_tab1",
	"type" => "textarea",
	"validate" => "html",
	"default" => "<li>your text here</li>",
	"tip" => "Set a list of services your site is offering to job seekers.",
	"std" => ""),
	
	
	
	 array(
        "title" => "List of services for job listers.",
        "under_section" => "login_content",
        "type" => "small_heading",
    ),
	
	
		
	
	array( 
	"under_section" => "login_content",
	"name" => "Enable a job lister register content:",
	"desc" => "",
	"id" => "enable_login_tab2",
	"type" => "select",
	"validate" => "html",
	"options" => array("Yes", "No"),
	"tip" => "Enable this option to display custom content inside the area in login/register page if job lister role is selected.",
	"default" => "No",
	"std" => ""),
	
	
	array( 
	"under_section" => "login_content",
	"name" => "List of services for job listers",
	"desc" => "Tell job listers why they should register.use the same format in the textarea,one item entry per line.Dont use it if you want to dislay the default list.",
	"id" => "content_login_tab2",
	"type" => "textarea",
	"validate" => "html",
	"default" => "<li>your text here</li>",
	"tip" => "Set a list of services your site is offering to job listers.",
	"std" => ""),	
	
	
	
	
	
	
	
	
	
	array(
        "title" => "List of services for recruiters.",
        "under_section" => "login_content",
        "type" => "small_heading",
    ),
	
	
		
	
	array( 
	"under_section" => "login_content",
	"name" => "Enable a recruiter register content:",
	"desc" => "",
	"id" => "enable_login_tab3",
	"type" => "select",
	"validate" => "html",
	"options" => array("Yes", "No"),
	"tip" => "Enable this option to display custom content inside the area in login/register page if recruiter role is selected.",
	"default" => "No",
	"std" => ""),
	
	
	array( 
	"under_section" => "login_content",
	"name" => "List of services for job recruiter",
	"desc" => "Tell recruiters why they should register.use the same format in the textarea,one item entry per line.Dont use it if you want to dislay the default list.",
	"id" => "content_login_tab3",
	"type" => "textarea",
	"validate" => "html",
	"default" => "<li>your text here</li>",
	"tip" => "Set a list of services your site is offering to recruiters.",
	"std" => ""),
	
	
	
	
	
	
	
	
	
	
	
	
	
	 array(
        "title" => "Image under the lists of register page",
        "under_section" => "login_content",
        "type" => "small_heading",
    ),
	
	 array(
        "under_section" => "login_content",
        "type" => "image",
        "placeholder" => "http://example.com/background.jpg",
        "name" => "Register page image:",
        "id" => "content_login_image",
        "desc" => "Paste the URL to the image, or upload it here, this image be placed in home content).For better use of this option,upload un image of 400px of width.",
       "tip" => "Upload an image to use in login/register page, i.e a map of your country.",
	   "default" => ""),
	
	
    
         /*
     * 
     * Appearance Section
     * 
     */
	
    array(
        "type" => "section",
        "icon" => "jobthemes-icon-font",
        "title" => "Appearance",
        "id" => "appearance",
        "expanded" => "true"
    ),
    
    array(
        "section" => "appearance",
        "type" => "heading",
        "title" => "Theme settings",
        "id" => "appearance-settings"
    ),    
    
    array(        
        "under_section" => "appearance-settings",
	"show_labels" => "false",
        "type" => "radio_image",
	"image_src" => array(
			get_bloginfo('stylesheet_directory')."/admin/"."assets/white.png",
			get_bloginfo('stylesheet_directory')."/admin/"."assets/orange.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/blue.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/gray.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/green.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/red.png"),
	"image_size" => array( "50"),
	"name" => "<strong>Color schemes:</strong>",
	"id" => "jt_colors",
	"options" => array( "style-default.css","style-pro-orange.css", "style-pro-blue.css", "style-pro-gray.css", "style-pro-green.css", "style-pro-red.css"),					
	"desc" => "Default color",
	  "tip" => "Set the color scheme you would like to use.",
	"default" => "" ),
    
    

    
    
    array(
        "title" => "Custom Colors",
        "under_section" => "appearance-settings",
        "type" => "small_heading",
    ),
    
    
		array(
    "under_section" => "appearance-settings", //Required
    "type" => "color", //Required
    "name" => "Background color:", //Required
    "id" => "background_color", //Required
    "display_checkbox_id" => "toggle_checkbox_id",
    "placeholder" => "",
    "desc" => "Set the backgound color.",
	 "tip" => "Set the background color of your website.Clear the input if you want to use the default.",
    "default" => ""
),


array(
    "under_section" => "appearance-settings", 
    "type" => "color", 
    "name" => "Template color:", 
    "id" => "temp_color", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "placeholder" => "",
    "desc" => "Set the color of the header,buttons, ect.",
	 "tip" => "Set the color of header landing area.",
    "default" => ""
),



  array(
        "title" => "Custom Backgrounds",
        "under_section" => "appearance-settings",
        "type" => "small_heading",
    ),
	
   
   array(
        "under_section" => "appearance-settings",
        "type" => "image",
        "placeholder" => "http://example.com/background.jpg",
        "name" => "Background image:",
        "id" => "background_image",
        "desc" => "Paste the URL to the background image, or upload it here).",
		"tip" => "Upload an image you would like to use as background image.Note: This ovveride the background color.",
        "default" => ""),
	
	array( 
	"under_section" => "appearance-settings", 
	"name" => "Background repetition:",
	"desc" => "Set the repetition option of the background.",
	"id" => "background_repeat",
	"type" => "select",
	"options" => array	(
	"No repeat" => "no-repeat",
	"Repeat" =>"repeat" ,
	"Repeat-x" => "repeat-x",
	"Repeat-y" =>"repeat-y" ),
	"tip" => "Set the repetition option of the background image.",
	"std" => ""),
	
		array( 
	"under_section" => "appearance-settings", 
	"name" => "Background attachment:",
	"desc" => "Set the attachment option of the background.",
	"id" => "background_attach",
	"type" => "select",
	"options" => array	(
	"scroll" => "Default",
	"fixed" =>"Fixed" ),
	"tip" => "Set the attachment option of the background.It can be either fixed of srolling down while browsing the site.",
	"std" => ""),
	
	
	
	
	
	
	
	
	array(
        "under_section" => "appearance-settings",
	"type" => "checkbox",
	"name" => "<strong>Enable patterns</strong>",
	"id" => array( "enable_patterns" ),				
	"options" => array("Use patterns"),
    "desc" => "Select this if you want to use patterns",
	"tip" => "Show/Hide patterns to use for your website.",
	"default" => array("not")),
    
    array(
        "type" => "toggle_div_start",
        "display_checkbox_id" => "enable_patterns",
        "under_section" => "appearance-settings",
    ),
    
	array( 
	"under_section" => "appearance-settings",
	"name" => "Override the background:",
	"desc" => "",
	"id" => "override_patern",
	"type" => "select",
	"options" => array("Yes", "No"),
	"default" => "No",
	"tip" => "Select Yes if you want to use patters instead of background or background images.",
	"std" => ""),
	
	  
	  array(        
        "under_section" => "appearance-settings",
	"show_labels" => "false",
        "type" => "radio_image",
	"image_src" => array(
			get_bloginfo('stylesheet_directory')."/admin/"."assets/bedge.png",
			get_bloginfo('stylesheet_directory')."/admin/"."assets/cardboard.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/climpek.png",	
            get_bloginfo('stylesheet_directory')."/admin/"."assets/diagonal-waves.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/escheresque.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/light-noise.png",
			get_bloginfo('stylesheet_directory')."/admin/"."assets/nasty-fabric.png",
			get_bloginfo('stylesheet_directory')."/admin/"."assets/navy-blue.png",	
            get_bloginfo('stylesheet_directory')."/admin/"."assets/noisy-grid.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/noisy-net.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/norwegian-rose.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/office.png",
			get_bloginfo('stylesheet_directory')."/admin/"."assets/pyramid.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/reticular-tissue.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/shattered.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/straws.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/stressed-linen.png",
			get_bloginfo('stylesheet_directory')."/admin/"."assets/subtle-carbon.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/white-tiles.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/subtle-dots.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/triangles-pattern.png",
			get_bloginfo('stylesheet_directory')."/admin/"."assets/gray-floral.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/cartographer.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/tapestry.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/psychedelic.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/gplay.png",
			get_bloginfo('stylesheet_directory')."/admin/"."assets/shine-dotted.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/gradient-squares.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/tasky.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/dark-dot.png",
			get_bloginfo('stylesheet_directory')."/admin/"."assets/nami.png",
			get_bloginfo('stylesheet_directory')."/admin/"."assets/zig-zag.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/circles.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/dark-mosaic.png",
			get_bloginfo('stylesheet_directory')."/admin/"."assets/random-grey.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/dark-denim.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/diagmonds.png",
			get_bloginfo('stylesheet_directory')."/admin/"."assets/use-your-illusion.png",
			get_bloginfo('stylesheet_directory')."/admin/"."assets/grid-me.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/soft-pad.png",
            get_bloginfo('stylesheet_directory')."/admin/"."assets/plaid.png",
			get_bloginfo('stylesheet_directory')."/admin/"."assets/floral-motif.png"
			
			),
	"image_size" => array( "50"),
	"name" => "Choose a pattern:",
	"id" => "paterns",
	"options" => array("bedge", "cardboard", "climpek", "diagonal-waves", "escheresque", "light-noise", "nasty-fabric", "navy-blue" , "noisy-grid", "noisy-net", "norwegian-rose", "office", "pyramid" , "reticular-tissue", "shattered" , "straws", "stressed-linen", "subtle-carbon", "white-tiles", "subtle-dots", "triangles-pattern", 
	"gray-floral","cartographer","tapestry","psychedelic","gplay","shine-dotted","gradient-squares","tasky","dark-dot","nami","zig-zag","circles","dark-mosaic","random-grey","dark-denim","diagmonds","use-your-illusion","grid-me","soft-pad","plaid","floral-motif"),	
	"desc" => "Choose the pattern to use as background.",
	"tip" => "Choose what patter you would like to use for your website.",
	"default" => "" ),
	  
	  
	  
    
    array(
        "type" => "toggle_div_end",
        "under_section" => "appearance-settings",
    ),
	
	
	
 
   array(
        "title" => "Custom CSS",
        "under_section" => "appearance-settings",
        "type" => "small_heading",
    ),
	
	
 	array( 
	"under_section" => "appearance-settings",
	"name" => "Custom CSS:",
	"desc" => "Put here your custom css",
	"id" => "custom_css",
	"type" => "textarea",
	"tip" => "Paste here any custom css  classes you want to use.",
	"std" => ""),
 
 
 
 
 
 
 
 	 array(
        "section" => "appearance",
        "type" => "heading",
        "title" => "Font colors",
        "id" => "colors-fonts"
		),
		
		
		 array(
        "title" => "Main font",
        "under_section" => "colors-fonts",
        "type" => "small_heading",
    ),
		
		
		
	array(
    "under_section" => "colors-fonts", 
    "type" => "color", 
    "name" => "Main font color:", 
    "id" => "font_color", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "placeholder" => "",
    "desc" => "Set the color of the main font.",
	"tip" => "Set the color of the main content font. Clean the input if you want to use the default color.",
    "default" => ""
),


array(
    "under_section" => "colors-fonts", 
    "type" => "color", 
    "name" => "Font color on mouse over:", 
    "id" => "font_color_hover", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "placeholder" => "",
    "desc" => "Set the hover color.",
	"tip" => "Set the color of the main content font when mouse over.",
    "default" => ""
),


 array(
        "title" => "Reverse font",
        "under_section" => "colors-fonts",
        "type" => "small_heading",
    ),
		

	array(
    "under_section" => "colors-fonts", 
    "type" => "color", 
    "name" => "Reverse font color:", 
    "id" => "reverse_font_color", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "placeholder" => "",
    "desc" => "The reverse color is the color of the highlighted second font.",
	"tip" => "Set the color of the second color used in website.i.e. the green for orange scheme.",   
	"default" => ""
),

array(
    "under_section" => "colors-fonts", 
    "type" => "color", 
    "name" => "Reverse font color on mouse over:", 
    "id" => "reverse_font_color_hover", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "placeholder" => "",
    "desc" => "Set the hover color of the reverse font.",
	"tip" => "Set the color of the second font when mouse over.",  
	"default" => ""
),




 array(
        "title" => "Footer colors ",
        "under_section" => "colors-fonts",
        "type" => "small_heading",
    ),
		

	array(
    "under_section" => "colors-fonts", 
    "type" => "color", 
    "name" => "Footer font color:", 
    "id" => "footer_font_color", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "placeholder" => "",
    "desc" => "Set the font color of the footer links",
	"tip" => "Set the color of the footer links.", 
	"default" => ""
),
		
	
	array(
    "under_section" => "colors-fonts", 
    "type" => "color", 
    "name" => "Footer font color on mouse over:", 
    "id" => "footer_font_color_hover", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "placeholder" => "",
    "desc" => "Set the hover color of the footer",
	"tip" => "Set the color of the footer links when mouse over.", 
    "default" => ""
),
 


 array(
        "title" => "Menu colors",
        "under_section" => "colors-fonts",
        "type" => "small_heading",
    ),
		

	array(
    "under_section" => "colors-fonts", 
    "type" => "color", 
    "name" => "Menu Font color:", 
    "id" => "menu_font_color", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "placeholder" => "",
    "desc" => "Set the font color of the menu links",
	"tip" => "Set the color of the menu items.", 
    "default" => ""
),
		
	
	array(
    "under_section" => "colors-fonts", 
    "type" => "color", 
    "name" => "Menu font color on mouse over:", 
    "id" => "menu_font_color_hover", 
    "display_checkbox_id" => "toggle_checkbox_id",
    "placeholder" => "",
    "desc" => "Set the hover color of the menu.",
	"tip" => "Set the color of the menu items on mouse over.", 
    "default" => ""
),
	

    
    array(
        "section" => "appearance",
        "type" => "heading",
        "title" => "Typography",
        "id" => "appearance-fonts"
    ),
    
	
	
	array( 
	"under_section" => "appearance-fonts",
	"name" => "Enable content font style:",
	"desc" => "Enable or disable the content font style.",
	"id" => "enable_font_a",
	"type" => "select",
	"options" => array("Yes", "No"),
	"default" => "No",
	"tip" => "Enable the content font style.", 
	"std" => ""),
	
	
	array( 
	"under_section" => "appearance-fonts",
	"name" => "Content font size:",
	"desc" => "Set the size of the font in pixels, i.e. 12(do not write the px symbol).",
	"id" => "font_a_size",
	"type" => "text",
	"tip" => "Change the size of the main content text.", 
	"std" => ""),
	
    array(        
    "under_section" => "appearance-fonts",
	"show_labels" => "false",
    "type" => "radio_image",
	"image_src" => array(
            get_bloginfo('stylesheet_directory')."/admin/"."assets/arial.png"
			,get_bloginfo('stylesheet_directory')."/admin/"."assets/verdana.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/tahoma.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/georgia.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/lucida.png"
			, get_bloginfo('stylesheet_directory')."/admin/"."assets/palatino.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/trebuchet.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/oswald.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/orienta.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/benchnine.png"
			, get_bloginfo('stylesheet_directory')."/admin/"."assets/vidaloka.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/rokkit.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/lobster.png"
			, get_bloginfo('stylesheet_directory')."/admin/"."assets/bitter.png"
			, get_bloginfo('stylesheet_directory')."/admin/"."assets/alice.png"
			, get_bloginfo('stylesheet_directory')."/admin/"."assets/economica.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/arizonia.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/arvo.png"
			, get_bloginfo('stylesheet_directory')."/admin/"."assets/overlock.png"
			, get_bloginfo('stylesheet_directory')."/admin/"."assets/quando.png"),
	"image_size" => array( "198"),
	"name" => "Main content font:",
	"id" => "font_a",
	"options" => array("Arial","Vedana","tahoma","georgia","Lucida","Palatino","Trebuichet","Oswald", "Orienta", "Benchnine", "Vidaloka" , "Rokkit", "Lobster", "Bitter", "Alice", "Economica" , "Arizonia", "Arvo" ,"Overlock","Quando"),					
	"desc" => "Choose which font you want to use for main font.",
	"default" => "arial" ,
	"tip" => "Choose which google font you would like to use for the content texts of your website.", 
	"std" => ""),
    
    
       
    array( 
	"under_section" => "appearance-fonts",
	"name" => "Enable headline font style:",
	"desc" => "Enable or disable the head font style.",
	"id" => "enable_font_b",
	"type" => "select",
	"options" => array("Yes", "No"),
	"default" => "No",
	"tip" => "Enable the heading font style (titles).", 
	"std" => ""),
    
	
	
	array( 
	"under_section" => "appearance-fonts",
	"name" => "Heading font size:",
	"desc" => "Set the size of the font in pixels, ie.: 15(do not write the px symbol).",
	"id" => "font_b_size",
	"type" => "text",
	"tip" => "Change the size of the heading text.", 
	"std" => ""),
	
	
    array(        
        "under_section" => "appearance-fonts",
	"show_labels" => "false",
        "type" => "radio_image",
	"image_src" => array(
			get_bloginfo('stylesheet_directory')."/admin/"."assets/arial.png"
			,get_bloginfo('stylesheet_directory')."/admin/"."assets/verdana.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/tahoma.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/georgia.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/lucida.png"
			, get_bloginfo('stylesheet_directory')."/admin/"."assets/palatino.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/trebuchet.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/oswald.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/orienta.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/benchnine.png"
			, get_bloginfo('stylesheet_directory')."/admin/"."assets/vidaloka.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/rokkit.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/lobster.png"
			, get_bloginfo('stylesheet_directory')."/admin/"."assets/bitter.png"
			, get_bloginfo('stylesheet_directory')."/admin/"."assets/alice.png"
			, get_bloginfo('stylesheet_directory')."/admin/"."assets/economica.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/arizonia.png"
            , get_bloginfo('stylesheet_directory')."/admin/"."assets/arvo.png"
			, get_bloginfo('stylesheet_directory')."/admin/"."assets/overlock.png"
			, get_bloginfo('stylesheet_directory')."/admin/"."assets/quando.png"),
	"image_size" => array( "198"),
	"name" => "Heading font:",
	"id" => "font_b",
	"options" => array("Arial","Vedana","tahoma","georgia","Lucida","Palatino","Trebuichet","Oswald", "Orienta", "Benchnine", "Vidaloka" , "Rokkit", "Lobster", "Bitter", "Alice", "Economica" , "Arizonia", "Arvo" ,"Overlock","Quando"),					
	"desc" => "Choose which font you want to use for heading font.",
	"tip" => "Choose which google font you would like to use for the heading texts of your web site.", 
	"default" => "arial" ,
	"std" => ""),
    
    
    
       
    /*
     * 
     *  = Advertisings
     * 
     */
    
    
    
     array(
        "type" => "section",
        "icon" => "jobthemes-icon-window",
        "title" => "Advertising Settings",
        "id" => "advertising",
        "expanded" => "false"
    ),
    
     
	  array(
        "section" => "advertising",
        "type" => "heading",
        "title" => "Home sidebar",
        "id" => "adv_home"
    ),
    
	
	array( 
	"under_section" => "adv_home", 
	"name" => "Enable Advertising:",
	"desc" => "Change this option to enable or disable the home page sidebar spot.",
	"id" => "adv_home",
	"type" => "select",
	"options" => array	(
	"yes" => "Yes",
	"no" =>"No" ),
	"default" => "No",
	"tip" => "Enable an advertising spot to be placed in the home page sidebar.", 
	"std" => ""),
	
	array( 
	"under_section" => "adv_home", 
	"name" => "Home Sidebar Spot:",
	"desc" => "This can be adsense code, javscript,an image, a text,(250X250)",
	"id" => "ad_home",
	"validate" => "html",
	"type" => "textarea",
	"tip" => "Paste here the url or code of the ad to be placed in home page sidebar.", 
	"std" => ""),


	
	 array(
        "section" => "advertising",
        "type" => "heading",
        "title" => "Header spot",
        "id" => "adv_header"
    ),
	
	
		array( 
	"under_section" => "adv_header",
	"name" => "Enable Advertising:",
	"desc" => "Change this option to enable or disable a spot in header (under menu).",
	"id" => "adv_header",
	"type" => "select",
	"options" => array("No", "Home page only", "Inner pages only", "Entire site"),
	"default" => "No",
	"tip" => "Enable an advertising spot to be placed in the header of your website.", 
	"std" => ""),
	
	
	

	array( 
	"under_section" => "adv_header",
	"name" => "Spot Width Size:",
	"desc" => "Set the size of the spot, i.e.:728 ",
	"id" => "ad_header_size",
	"type" => "text",
	"default" => "728",
	"tip" => "Set the size of the header advertising ad, it's 728px by default.",
	"std" => ""),
	
	
	
		array( 
		"under_section" => "adv_header",
		"name" => "Banner position:",
	"desc" => "",
	"id" => "ad_header_float",
	"type" => "select",
	"validate" => "html",
	"options" => array("Center", "Left", "Right"),
	"tip" => "Set the position of the header ad spot.",
	"std" => ""),
	
	
	
array(
	"under_section" => "adv_header",
	"name" => "Header Banner Spot (728X90):",
	"desc" => "This can be adsense code, javscript,an image, a text,..",
	"id" => "ad_header",
	"type" => "textarea",
	"tip" => "Paste here the url or code of the ad to be placed in the header.",
	"std" => ""),
	
		
	  
	  array(
        "section" => "advertising",
        "type" => "heading",
        "title" => "Footer Spot",
        "id" => "adv_footer"
    ),
	
	array( 
	"under_section" => "adv_footer",
	"name" => "Enable Advertising:",
	"desc" => "Change this option to enable or disable a spot in footer.",
	"id" => "adv_footer",
	"type" => "select",
		"options" => array("No", "Home page only", "Inner pages only", "Entire site"),
	"default" => "No",
	"tip" => "Enable where the advertising spot to be placed in the footer of your website.", 
	"std" => ""),
	
		
	array( 
	"under_section" => "adv_footer",
	"name" => "Banner position:",
	"desc" => "",
	"id" => "ad_footer_float",
	"type" => "select",
	"options" => array("Center", "Left", "Right"),
	"tip" => "Set the position of the footer ad spot.",
	"std" => ""),
	
	
	array( 
	"under_section" => "adv_footer",
	"name" => "Spot Width Size:",
	"desc" => "Set the size of the spot, i.e.:728 ",
	"id" => "ad_footer_size",
	"type" => "text",
	"default" => "728",
	"tip" => "Set the size of the footer advertising ad, it's 728px by default.",
	"std" => ""),
	
	array( 
	"under_section" => "adv_footer",
	"name" => "Footer Banner Spot:",
	"desc" => "This can be adsense code, javscript,an image, a text,..",
	"id" => "ad_footer",
	"type" => "textarea",
	"validate" => "html",
	"tip" => "Paste here the url or code of the ad to be placed in the footer.",
	"std" => ""),
	
	
	
	
	
	
	  array(
        "section" => "advertising",
        "type" => "heading",
        "title" => "Job page",
        "id" => "adv_page"
    ),
	 
	 
	 
	array( 
	"under_section" => "adv_page",
	"name" => "Enable Advertising:",
	"desc" => "Change this option to enable or disable a banner spot in job page (right-top of the details)",
	"id" => "adv_job",
	"type" => "select",
	"options" => array("Yes", "No"),
	"default" => "No",
	"tip" => "Enable an advertising spot to be placed in the job pages.", 
	"std" => ""),
	
	
	array( 
	"under_section" => "adv_page",
	"name" => "Banner 300X300 position:",
	"desc" => "",
	"id" => "ad_job_float",
	"type" => "select",
	"options" => array("Center", "Left", "Right"),
		"tip" => "Set the position of the job ad spot.",
	"std" => ""),
	
		
	
	array( 
	"under_section" => "adv_page",
	"name" => "Job page spot:",
	"desc" => "This can be adsense code, javscript,an image, a text,..",
	"tip" => "Paste here the url or code of the ad to be placed in the job pages.",
	"id" => "ad_job",
	"type" => "textarea",
	"validate" => "html",
	"std" => ""),
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 array( 
	"under_section" => "adv_page",
	"name" => "Enable Banner under Job Details:",
	"desc" => "Change this option to enable or disable an ad under job details (job pages).",
	"id" => "adv_job_bottom",
	"type" => "select",
	"options" => array("Yes", "No"),
	"default" => "No",
	"tip" => "Enable an advertising spot to be placed under the content of job pages.", 
	"std" => ""),
	
	array( 
	"under_section" => "adv_page",
	"name" => "Banner 468X60 position:",
	"desc" => "",
	"id" => "ad_job_bottom_float",
	"type" => "select",
	"options" => array("Center", "Left", "Right"),
	"tip" => "Set the position of the ad spot under job details.",
	"std" => ""),
	
	array( 
	"under_section" => "adv_page",
	"name" => "Spot Width Size:",
	"desc" => "Set the size of the spot, i.e. 468 ",
	"id" => "ad_job_bottom_size",
	"type" => "text",
	"tip" => "Set the size of the spot under job details.",
	"std" => ""),
		
	array( 
	"under_section" => "adv_page",
	"name" => "Job page bottom Spot:",
	"desc" => "This can be adsense code, javscript,an image, a text,..",
	"id" => "ad_job_bottom",
	"type" => "textarea",
	"validate" => "html",
	"tip" => "Paste here the url or code of the ad to be placed under the details of jobs.",
	"std" => ""),
	 
	 
	 
	 
	 
	 
	array(
        "section" => "advertising",
        "type" => "heading",
        "title" => "Job listings",
        "id" => "adv_listings"
    ),
	 
	  array(
        "title" => "This put advertising spot between job listings",
        "under_section" => "adv_listings",
        "type" => "small_heading",
    ),
	array( 
	"under_section" => "adv_listings",
	"name" => "Enable Advertising:",
	"desc" => "Change this option to enable or disable job listings spot.",
	"id" => "adv_listings",
	"type" => "select",
	"options" => array("Yes", "No"),
	"default" => "No",
	"tip" => "Enable an advertising spot to be placed between job listings.", 
	"std" => ""),
	
	array( 
	"under_section" => "adv_listings",
	"name" => "Ad position (After x job listing):",
	"desc" => "Choose where you want to put this ad, after what job ad position.",
	"id" => "ad_listings_freq",
	"type" => "select",
	"default" => "1",
	"options" => array( "0", "1", "2" , "3" , "4", "5", "6" , "7" , "8" , "9" , "10"),
	"tip" => "Choose where you want to put this ad, after what job ad position (0 means before all job listings).", 
	"std" => ""),
	
	array( 
	"under_section" => "adv_listings",
	"name" => "Job listings spot:",
	"desc" => "This can be adsense code, javscript,an image, a text,..",
	"id" => "ad_listings",
	"type" => "textarea",
	"validate" => "html",
	"tip" => "Paste here the url or code of the ad to be placed between jobs.",
	"std" => ""),
	 
	
  	
	
    
      
	  
	   array(
        "type" => "section",
        "icon" => "jobthemes-icon-preference",
        "title" => "Advanced Settings",
        "id" => "advanced",
        "expanded" => "false"
    ),
    
     
	  array(
        "section" => "advanced",
        "type" => "heading",
        "title" => "Settings",
        "id" => "settings"
    ),
    
	
	
	
	array( 
	"under_section" => "settings", 
	"name" => "Primary menu action buttons:",
	"desc" => "Which button you want to display by default if the user is not logged in.",
	"id" => "enable_menu_button",
	"type" => "select",
	"options" => array	(
	"Submit a Job",
	"Submit a Resume",
	"None" ),
	"default" => "Submit a Job",
	"tip" => "Which menu tab you would like to display if the user is not logged in.",
	"std" => ""),
    
    
    
    
	
	array( 
	"under_section" => "settings", 
	"name" => "Job Location:",
	"desc" => "Which Location field you want to display by default in job listings.",
	"id" => "enable_location_field",
	"type" => "select",
	"options" => array	("Location by Google maps","Location by new taxonomy"),
	"default" => "Location by Google maps",
	"tip" => "Which location field you want to display by default in job listings,google map is selected by default.",	
	"std" => ""),
    
    
	
	array( 
	"under_section" => "settings", 
	"name" => "Job Share:",
	"desc" => "Which social network You want to use to share your job listings.",
	"id" => "enable_sharing",
	"type" => "select",
	"default" => "Share to Facebook",
	"options" => array	("Share to Facebook","Share to Linkedin","Share to Twitter"),
	"default" => "Share to Facebook",
	"tip" => "Which social network you want to use to share jobs in job listings.",	
	"std" => ""),
   
   
   
	
	
	

	 array(
        "title" => "Custom Post Type & Taxonomy URLs",
        "under_section" => "settings",
        "type" => "small_heading",
    ),
		
		
	array( 
	"under_section" => "settings",
	"name" => "Location new taxonomy name:",
	"desc" => "Set the name of the new custom taxonmy (Location) City or State <br><b>IMPORTANT:</b> Write it in your language , This cannot be translated.<br><a class='redo'>To create job locations, go to -Jobs- in wordpress admin menus => Select -Job location-.</a>",
	"id" => "job_loc_name",
	"type" => "text",
	"default" => "State",
	"tip" => "Set the name of the new custom taxonomy (location), ie: State. ",	
	"std" => ""),	
		
		
		array( 
	"under_section" => "settings",
	"name" => "Job location required",
	"desc" => "While submitting a job, is the new custom taxonomy (location) is required.",
	"id" => "jr_submit_loc_required",
	"type" => "select",
	"options" => array	("Yes","No"),
	"tip" => "Set wether the new job location is required or not while submitting a job.",
	"default" => "No",
	"std" => ""),
			
			
			
			
	array( 
	"under_section" => "settings",
	"name" => "Job location permalink:",
	"desc" => "Set the parmalink of job location.<br><b>IMPORTANT:</b> You must re-save your permalinks for this change to take effect.",
	"id" => "job_loc_tax_permalink",
	"default" => "job-location",
	"type" => "text",
	"tip" => "Set the parmalink of new job location field.",
	"std" => ""),
	

    
    
	
	
	

	
	
	  array(
        "section" => "advanced",
        "type" => "heading",
        "title" => "Translation",
        "id" => "translation"
    ),
	 
	  array(
        "title" => "This theme contains extra few words, You can translate/replace them here by your own.",
        "under_section" => "translation",
        "type" => "small_heading",
    ),
	 
	 
	 
	 

 array( 
	"under_section" => "translation", 
	"name" => "Submit a job",
	"desc" => "",
	"id" => "tr_submit_job",
	"type" => "text",
	"default" => "Submit a job",
	"tip" => "It's displayed in the header, the big button.",	
	"std" => "Submit a job"),
	 
	 
	 
	 array( 
	"under_section" => "translation", 
	"name" => "Submit a resume",
	"desc" => "",
	"id" => "tr_submit_resume",
	"type" => "text",
	"default" => "Submit a resume",
	"tip" => "It's displayed in the header, the big button if the job seeker is logged in.",	
	"std" => "Submit a resume"),
	 
	 
	 
	 
	 	 array( 
	"under_section" => "translation", 
	"name" => "Details",
	"desc" => "",
	"id" => "tr_details",
	"type" => "text",
	"default" => "Details",
	"tip" => "It's displayed in the job listings.",	
	"std" => "Details"),
	 
	 
	 
	 
	
 array( 
	"under_section" => "translation", 
	"name" => "Location",
	"desc" => "",
	"id" => "tr_location",
	"type" => "text",
	"default" => "Location",
	"tip" => "It's displayed in the job listings.",	
	"std" => "Location"),
	
	
	
	
	 array( 
	"under_section" => "translation", 
	"name" => "First name",
	"desc" => "",
	"id" => "tr_first_name",
	"type" => "text",
	"default" => "First name",
	"tip" => "It's displayed in the regisration form.",	
	"std" => "First name"),
	
    
	
	
	 array( 
	"under_section" => "translation", 
	"name" => "Last name",
	"desc" => "",
	"id" => "tr_last_name",
	"type" => "text",
	"default" => "Last name",
	"tip" => "It's displayed in the regisration form.",	
	"std" => "Last name"),
	
   array( 
	"under_section" => "translation", 
	"name" => "Phone",
	"desc" => "",
	"id" => "tr_phone",
	"type" => "text",
	"default" => "Phone",
	"tip" => "It's displayed in the regisration form.",	
	"std" => "Phone"),
	
	
	
	
	
	
	
	 array( 
	"under_section" => "translation", 
	"name" => "You already have an account..",
	"desc" => "",
	"id" => "tr_you_arleady",
	"type" => "text",
	"default" => "You already have an account and you are logged in, You can access to your dashboard",
	"tip" => "It's displayed in the login page",	
	"std" => "You already have an account and you are logged in, You can access to your dashboard"),
	
	
	 array( 
	"under_section" => "translation", 
	"name" => "here",
	"desc" => "",
	"id" => "tr_here",
	"type" => "text",
	"default" => "here",
	"tip" => "It's displayed in the login page",	
	"std" => "here"),
	
	
	
	
	
	
		
	
	
	
	
    
  
);
?>
