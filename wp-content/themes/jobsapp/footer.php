</div><!-- end of wrapo -->

<div id="footer">

    	<div class="inner-b">
			<!-- Show the banner only in homepage -->
			<?php
			if ( is_home() ) {
				// This is a homepage
				
				get_template_part( 'footer', 'home' );
				
			} else {

				// This is not a homepage
				get_template_part( 'footer', 'no-home' );
			}
			?>
		</div>
		
		<div class="spacer"></div>
		<div class="inner-b">
    	
    	<!---footer widgets-->
		
		<?php
		 if (get_option('footer_layout') != '0') { ?>

	<div id="custom-footer">	
		<div class="cf-inner">
	 
	<?php 
		$max_columns = get_option('footer_layout'); // change to number of columns you want to add to your footer
		$text_domain = APP_TD; // the text domain to use for translating the strings
	?>
	 
	<?php foreach ( range(1, $max_columns, 1) as $number ) { ?>	
	 
		 <?php $sidebar_name = sprintf(__('Footer Column %d', $text_domain), $number ); ?>
		 <div class="cf-column">
			<div id="cf-col-<?php echo $number; ?>">
					 <?php dynamic_sidebar( $sidebar_name ); ?>
			</div>
		 </div>	
	 
	<?php } ?>	
	 
		<div class="clear"></div>				
		</div>	
	</div>	 
		 
<?php		 
} else {

}
?>
    	<!---End footer widgets-->
    	<div class="spacer-line"></div>
			<div class="footy">
			<ul>
				<li><?php _e('Copyright &copy;',APP_TD); ?> <?php echo date_i18n('Y'); ?> <?php bloginfo('name'); ?></li>
			</ul>
			<?php wp_nav_menu( array( 
										'theme_location' => 'footer', 
										'container' => '', 
										'depth' => 1, 
										'fallback_cb' => 
										'default_footer_nav' 
										) 
								);?>
</div>

		<div class="spacer-lino"></div>
		<div class="spacer"></div>

		<?php get_template_part( 'includes/ft', 'st' ); ?>

		</div><!-- end inner -->
</div><!-- end footer -->


<script type="text/javascript">
         $(function(){
			  
			$(".phone").keydown(function (e) {
				// Allow: backspace, delete, tab, escape, enter and .
				if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
					 // Allow: Ctrl+A, Command+A
					(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
					 // Allow: home, end, left, right, down, up
					(e.keyCode >= 35 && e.keyCode <= 40)) {
						 // let it happen, don't do anything
						 return;
				}
				// Ensure that it is a number and stop the keypress
				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					e.preventDefault();
				}
			});


		  /*=========Language====*/
		   

		  $("input[name='log']").focus();

		  var count = 0;
		  $(".remove_language").bind('click',remove);
		  $(".add_language").bind('click',add);

		  function add(){
			   count = $(".remove_language").length;
			   var html = $(".main-language").html();
			   if(count <= 4){  
				  $(".language-append").append(html);
			   }
			   $(".remove_language").bind('click',remove);
			   return false;
		  }
		  function remove(){
			   var parent = $(this).parent().parent();
			   parent.remove();                    
			   return false;
		  }
		  /*======== experience=========*/

		  var count_app = 0;
		  $(".remove_experience").bind('click',remove_exp);
		  $(".add_experience").bind('click',add_exp);

		  function add_exp(){
			   count_app = $(".remove_experience").length;
			   var html = $(".main_experience").html();
			   if(count_app <= 4){  
				  $(".expend_experience").append(html);
			   }
			   $(".remove_experience").bind('click',remove_exp);
			   return false;
		  }
		  function remove_exp(){
			   var parent = $(this).parent().parent();
			   parent.remove();                    
			   return false;
		  }

		  /*===========education=========*/
		   
		  var count_edu = 0;
		  $(".remove_education").bind('click',remove_edu);
		  $(".add_education").bind('click',add_edu);

		  function add_edu(){
			   count_edu = $(".remove_education").length;
			   var html = $(".main_education").html();
			   if(count_edu <= 4){  
				  $(".expend_education").append(html);
			   }
			   $(".remove_education").bind('click',remove_edu);
			   return false;
		  }
		  function remove_edu(){
			   var parent = $(this).parent().parent();
			   parent.remove();                    
			   return false;
		  }
		<?php if($_GET['role']=="jobseeker"){?>
			   $("#show-me3").show();
		 <?php } ?>
		$(".watch-me3").change(function(){                               
			  $("#show-me3").show();               
		 });

		$("#watch-me").change(function(){
			 $("#show-me3").hide();
		});
	
	   /*========disabled========*/ 
		$("input[readonly], textarea[readonly]").click(function(){
			var count = $(".error").length;
			if(count <=1 ){                              
			$(this).parent().append("<label generated='true' class='error'>Please go to edit profile button to fill your information... </label>");  
			}       
		 });
		/*setInterval(function(e){ $(".error").remove();}, 5000);   */
	  });

</script>
