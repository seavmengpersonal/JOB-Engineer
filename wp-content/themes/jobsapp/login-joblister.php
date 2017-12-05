<div class="desca">
<h1 class="como"><?php _e('As job lister/employer', APP_TD); ?>:</h1>
<ul>
	
	
	
<?php if (get_option('enable_login_tab2') != 'Yes') { ?>

	<li><?php _e('Submit jobs in minutes', APP_TD); ?>.</li>
	<li><?php _e('Manage Job Postings (edit,delete,renew jobs, All in one place)', APP_TD); ?>.</li>
	<li><?php _e('Take advantage of flexible posting options', APP_TD); ?>.</li>
	<li><?php _e('Reach candidates everywhere', APP_TD); ?>.</li>
	<li><?php _e('Manage applications online', APP_TD); ?></li>
	<li><?php _e('24/7 access to your online dashboard.', APP_TD); ?>.</li>
			
		
<?php
} else {?>

		<?php echo stripslashes(get_option('content_login_tab2')); ?>
		
		
<?php }  ?>	
	
	
	
	
	
	
	
	
	
</ul>
</div>
<div id="login-country"><img border="0" src="<?php echo get_option('content_login_image'); ?>"></div>




	