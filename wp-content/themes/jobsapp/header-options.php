
           <script type="text/javascript">
        var HOST_NAME = '';
        function SelectAll(id)
        {
                document.getElementById(id).focus();
                document.getElementById(id).select();
        }
</script>

<script>
   $(function() {
	   
      // Create the dropdown base
      $("<select />").appendTo("nav");
      
      // Create default option "Go to..."
      $("<option />", {
         "selected": "selected",
         "value"   : "",
         "text"    : "Go to..."
      }).appendTo("nav select");
      
      // Populate dropdown with menu items
      $("nav a").each(function() {
       var el = $(this);
       $("<option />", {
           "value"   : el.attr("href"),
           "text"    : el.text()
       }).appendTo("nav select");
      });
      
	   // To make dropdown actually work
	   // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
      $("nav select").change(function() {
        window.location = $(this).find("option:selected").val();
      });
	 
	 });
	  </script>
	  
<?php if (get_option('enable_font_a')=='Yes') : ?>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo get_option('font_a'); ?>">
		<style> 
		body {font-family: '<?php echo get_option('font_a'); ?>' !important;}
		ol.resumes dd strong, a, ol.jobs dd strong a, ol.resumes dd strong, a, ol.jobs dd strong a, ol.resumes dd {font-family: '<?php echo get_option('font_a'); ?>' !important; font-size: <?php echo get_option('font_a_size'); ?>px !important}
	
	 </style>
	  <?php endif; ?>
	 <?php if (get_option('enable_font_b')=='Yes') : ?>
	 <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo get_option('font_b'); ?>">
	<style>
	#content h2,#content h1 {font-family: '<?php echo get_option('font_b'); ?>' !important; font-size: <?php echo get_option('font_b_size'); ?>px !important }
	
 </style>
  <?php endif; ?>
	 <style>
	body {
	<?php if( !get_option('background_color') ) {} else {?>
	background-color: #<?php echo get_option('background_color')?> !important;
	<?php }?>	
	<?php if( !get_option('background_image') ) {} else {?>
	background: url("<?php echo get_option('background_image')?>") <?php echo get_option('background_repeat')?>  !important;
	<?php }?>	
	<?php if( !get_option('background_attach') ) {} else { ?>
	background-attachment: <?php echo get_option('background_attach')?> !important;
	<?php }?>	
	     }
	 <?php if( !get_option('footer_font_color') ) {} else { ?>
	#footer-widget ul li a, #footer a { color: #<?php echo get_option('footer_font_color')?> !important;}
	<?php }?>	
	<?php if( !get_option('footer_font_color_hover') ) {} else {?>
	#footer-widget ul li a:hover, #footer a:hover { color: #<?php echo get_option('footer_font_color_hover')?> !important;}
	<?php }?>	

	   
<?php if (get_option('override_patern')=='Yes') : ?>
	   body {background: url(<?php bloginfo('stylesheet_directory'); ?>/img/<?php echo get_option('paterns')?>.png) repeat !important;}
			<?php endif; ?>
<?php if (get_option('temp_color')) : ?>
				.menu-head , a.button-s, .header-ino , .under-menu , .sbHolder , .tp-bullets.simplebullets.round .selected  { background-color: #<?php echo get_option('temp_color')?> !important}
				 .bannero ,  div#content .inner , #topNav ,  #backtotop  , a.button-s , .sbHolder , .tp-bullets.simplebullets.round .selected , .sbOptions{border-color: #<?php echo get_option('temp_color')?> !important}
			a.button-s {box-shadow: none; }
				
				#backtotop  { background: #<?php get_option('temp_color')?> url(<?php bloginfo('stylesheet_directory'); ?>/images/arri.png) center center no-repeat}
				div#footer > .inner {border: 0px !important;}
				<?php endif; ?>


			body { color: #<?php echo get_option('font_color')?> !important }
			a:hover { color: #<?php echo get_option('font_color_hover')?> !important }
			.counter , h1, h2, h3, h4, h5, h6, .pagetitle, .tito h2.title , .tabcontrol li.tab a  {color:#<?php echo get_option('reverse_font_color')?> !important}
			h1:hover, h2:hover, h3:hover, h4:hover, h5:hover, h6:hover, .pagetitle:hover  {color: #<?php echo get_option('reverse_font_color_hover')?> !important}
<?php if( !get_option('reverse_font_color') ) {} else {?>
			.menus-s li.dashboard  { background: url("<?php bloginfo('stylesheet_directory'); ?>/images/menu-bg.png") repeat-x scroll 0 top #<?php echo get_option('reverse_font_color')?> !important; border-color:#<?php echo get_option('reverse_font_color')?> !important; border-bottom:0px !important}
<?php }?>	
<?php if( !get_option('menu_font_color') ) {} else {?>
	.menus-s li a , #topNav li a , #topNav li.current-menu-item a, #topNav li.current_page_item a {color: #<?php echo get_option('menu_font_color')?> !important;}
<?php }?>	
<?php if( !get_option('menu_font_color_hover') ) {} else {?>
	.menus-s li a:hover, #topNav li a:hover, #topNav li.current-menu-item a:hover, #topNav li.current_page_item a:hover {color: #<?php echo get_option(menu_font_color_hover)?> !important;}
		<?php }?>	

	
	
	<?php if( !get_option('slider_background') ) {} else {?>
	.mainso {background-color: #<?php echo get_option('slider_background')?> !important;}
	<?php }?>	
	<?php if (get_option('main_layout') != 'right') { ?>
	   .sidebarhome { float: left !important; margin: 0 3px 0 8px !important;}
	  .blocks , #mainContent { float: right !important;}
	  #sidebar {float: left !important;}
<?php } else { ?>
<?php }?>
	<?php  switch (get_option('footer_layout')) {

                case "Default": ?>
               
                <?php break;

                case "1": ?>
              #cf-col-1  { width: 965px !important; }
                <?php break;

                case "2": ?>
                #cf-col-1, #cf-col-2  { width: 470px !important; }
                <?php break;

                case "3": ?>
				
                #cf-col-1, #cf-col-2 , #cf-col-3  { width: 306px !important;}
				
				 <?php break;

                case "4": ?>
              #cf-col-1, #cf-col-2 , #cf-col-3,#cf-col-4   { width: 227px !important; }
			  
                <?php break;

               
            }
?>


<?php if( !get_option(custom_css ) ) {} else {echo get_option('custom_css'); }	?>
	 </style>