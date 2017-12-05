<div class="desca">
<h1 class="como"><?php _e('As job seeker', APP_TD); ?>:</h1>
<ul>
	
		
	<?php if (get_option('enable_login_tab1') != 'Yes') { ?>
	
	
	<li><?php _e('Post your resume in minutes', APP_TD); ?>.</li>
	<li><?php _e('Manage resumes (edit,delete,create new, All in one place)', APP_TD); ?>.</li>
	<li><?php _e('Search jobs by category, location, job type or salary', APP_TD); ?>.</li>
	<li><?php _e('Receive jobs by email (Job Alerts)', APP_TD); ?>.</li>
	<li><?php _e('Apply online for jobs', APP_TD); ?></li>
	<li><?php _e('24/7 access to your online dashboard', APP_TD); ?>.</li>
	<li><?php _e('Browse career resources for job news and tips', APP_TD); ?>.</li>
		
		
<?php
} else {?>

		<?php echo stripslashes(get_option('content_login_tab1')); ?>
		
		
<?php }  ?>	
	
	
	
	
	
	
	
	
	
	
</ul>
</div>
<div id="login-country"><img border="0" src="<?php echo get_option('content_login_image'); ?>"></div>