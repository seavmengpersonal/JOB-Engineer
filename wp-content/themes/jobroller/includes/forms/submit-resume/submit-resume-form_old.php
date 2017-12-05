<?php
/**
 * JobRoller Resume form
 * Function outputs the resume submit form
 *
 *
 * @version 1.4
 * @author AppThemes
 * @package JobRoller
 * @copyright 2010 all rights reserved
 *
 */
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');




function jr_submit_resume_form( $resume_id = 0 ) {

	global $post, $posted;
	jr_geolocation_scripts();
        $userdata = wp_get_current_user();
	?>
	
	<form action="<?php
		if ( $resume_id > 0 ) {
			echo add_query_arg( 'edit', $resume_id, get_permalink( $post->ID ) );
		} else {
			echo get_permalink( $post->ID );
		}
	?>" method="post" enctype="multipart/form-data" id="submit_form" class="submit_form main_form">

		<p><?php _e('Enter your resume details below. Once saved you will be able to view your resume and optionally add links to your websites/social networks if you wish.', APP_TD); ?></p>

		<fieldset class="personal" onclick="alert('Please click button edit profile to update your profile.');">
			<legend><?php _e('Personal Information', APP_TD); ?></legend>
                        <p><label for="resume_name"><?php _e('Resume Title', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text required" name="resume_name" id="resume_name" class="text" placeholder="<?php _e('e.g. Lead Developer', APP_TD); ?>" value="<?php if (isset($posted['resume_name'])) echo $posted['resume_name']; ?>" /></p>
						
			<p><label for="first_name"><?php _e('First Name',APP_TD) ?></label> <input disabled type="text" name="r_firstname" class="text regular-text" id="first_name" value="<?php echo $userdata->first_name ?>" maxlength="100" /><input type="hidden" name="r_firstname" class="text regular-text" id="first_name" value="<?php echo $userdata->first_name ?>" maxlength="100" /></p>
				
			<p><label for="last_name"><?php _e('Last Name',APP_TD) ?></label><input disabled  type="text" name="r_lastname" class="text regular-text" id="last_name" value="<?php echo $userdata->last_name ?>" maxlength="100" /><input type="hidden" name="r_lastname" class="text regular-text" id="last_name" value="<?php echo $userdata->last_name ?>" maxlength="100" /></p>

			<p class="optional"><label for="your-photo"><?php _e('Photo (.jpg, .gif or .png)', APP_TD); ?></label> <input type="file" class="text" name="your-photo" id="your-photo" /></p>
                        
                        <p class="optional"><label for="your-file"><?php _e('File (.pdf, .zip or .doc)', APP_TD); ?></label> <input type="file" class="text" name="your-file" id="your-file" /></p>

			<p><label for="hire"><?php _e('Sex', APP_TD); ?> <span title="required">*</span></label> 
				<select disabled  name="r_sex" id="r_sex">
				<?php
				$job_types = get_terms( 'r_sex', array( 'hide_empty' => false ) );
				if ($job_types && sizeof($job_types) > 0) {
					foreach ($job_types as $type) {
						?>
						<option <?php if ( $userdata->r_sex==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
						<?php
					}
				}
				?>
			</select>
                        <input type="hidden" name="r_sex" class="text regular-text" id="r_sex" value="<?php echo $userdata->r_sex; ?>"/>
			</p>
			<p><label for="dob"><?php _e('Date of Birth', APP_TD); ?></label>
                        <select disabled  style="width:118px" class="day" name="d_day">
                             <option value="0">Day</option>
                             <?php for($i=1; $i<=31; $i++){ ?>
                             <option <?php if($userdata->d_day==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select><input type="hidden" name="d_day" class="text regular-text" id="d_day" value="<?php echo $userdata->d_day; ?>"/>

                        <select disabled  style="width:118px" class="month" name="d_month">
                             <option value="0">Month</option>
                             <?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                             foreach($months as $key => $month){ ?>
				<option <?php if($userdata->d_month==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
			    <?php } ?>
                        </select><input type="hidden" name="d_month" class="text regular-text" id="d_month" value="<?php echo $userdata->d_month; ?>"/>      
                  
                        <select disabled  style="width:118px" class="year" name="d_year">
                             <option value="0">Year</option>
                             <?php for($i=1970; $i<=2016; $i++){ ?>
                             <option <?php if($userdata->d_year==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select><input type="hidden" name="d_year" class="text regular-text" id="d_year" value="<?php echo $userdata->d_year; ?>"/></p>
			<p><label for="hire"><?php _e('Marital', APP_TD); ?> <span title="required">*</span></label> 
				<select disabled  name="r_marital" id="r_marital">
				<?php
				$job_types = get_terms( 'r_marital', array( 'hide_empty' => false ) );
				if ($job_types && sizeof($job_types) > 0) {
				foreach ($job_types as $type) { ?>
				<option <?php if ( $userdata->r_marital==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
				<?php } } ?>
			</select><input type="hidden" name="r_marital" class="text regular-text" id="r_marital" value="<?php echo $userdata->r_marital; ?>"/></p>
			<p class="optional"><label for="email_address"><?php _e('Email Address', APP_TD); ?></label> <input disabled  type="text" class="text" name="email_address" value="<?php echo $userdata->r_email; ?>" id="email_address" placeholder="<?php _e('you@yourdomain.com', APP_TD); ?>" /><input type="hidden" class="text" name="email_address" value="<?php echo $userdata->r_email; ?>" id="email_address" /></p>
			
			<p class="optional"><label for="mobile"><?php _e('Mobile', APP_TD); ?></label> <input disabled  type="text" class="text" name="mobile" value="<?php echo $userdata->phone; ?>" id="mobile" placeholder="<?php _e('Mobile number', APP_TD); ?>" /><input type="hidden" class="hidden" name="mobile" value="<?php echo $userdata->phone; ?>" id="mobile" /></p>
			
			<p><label for="nationality"><?php _e('Nationality', APP_TD); ?> <span title="required">*</span></label> <input  disabled type="text" class="text" name="r_nationality" id="r_nationality" value="<?php echo $userdata->nationality; ?>" placeholder="<?php _e('Khmer', APP_TD); ?>" /><input type="hidden" class="text" name="r_nationality" id="r_nationality" value="<?php echo $userdata->nationality; ?>" /></p>

			<p><label for="hire"><?php _e('Location', APP_TD); ?> <span title="required">*</span></label> 
				<select disabled  name="r_location" id="r_location">
				<?php
				$job_types = get_terms( 'job_loc', array( 'hide_empty' => false ) );
				if ($job_types && sizeof($job_types) > 0) {
					foreach ($job_types as $type) {
						?>
						<option <?php if ( $userdata->r_location==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
						<?php
					}
				}
				?>
			</select><input type="hidden" name="r_location" class="text regular-text" id="r_location" value="<?php echo $userdata->r_location; ?>"/></p>

			<p><label for="address"><?php _e('Address', APP_TD); ?> <span title="required">*</span></label> <textarea  disabled  rows="5" cols="30" name="r_address" id="r_address" placeholder="<?php _e('Phnom Penh, Cambodia.', APP_TD); ?>" class="short" style="height:100px;"><?php echo $userdata->r_address; ?></textarea>
<input type="hidden" name="r_address" class="text regular-text" id="r_address" value="<?php echo $userdata->r_address; ?>"/></p>

 
		</fieldset> 
                <p><a class="submit edit_profile" style="/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f3c5bd+0,ea2803+0,ff6600+75,c72200+100 */
background: #f3c5bd; /* Old browsers */
background: -moz-linear-gradient(top,  #f3c5bd 0%, #ea2803 0%, #ff6600 75%, #c72200 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,  #f3c5bd 0%,#ea2803 0%,#ff6600 75%,#c72200 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,  #f3c5bd 0%,#ea2803 0%,#ff6600 75%,#c72200 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f3c5bd', endColorstr='#c72200',GradientType=0 ); /* IE6-9 */
text-shadow:none;
color:white !important;
" target="_blank" href="http://www.tem-trading.com/jobs/my-profile/">Edit Profile →</a></p>
<hr/>
               
		<!---career profile-->

		<fieldset>
			<legend><?php _e('Career Profile', APP_TD); ?></legend>
			<p><label for="hire"><?php _e('Highest Qualification', APP_TD); ?> <span title="required">*</span></label> 
				<select name="r_highest_qualification" id="r_highest_qualification">
				<?php
				$job_types = get_terms( 'r_highest_qualification', array( 'hide_empty' => false ) );
				if ($job_types && sizeof($job_types) > 0) {
					foreach ($job_types as $type) {
						?>
						<option <?php if ( $posted['r_highest_qualification']==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
						<?php
					}
				}
				?>
			</select></p>
			<p><label for="hire"><?php _e('Latest Career Level', APP_TD); ?> <span title="required">*</span></label> 
				<select name="r_level" id="r_level">
				<?php
				$job_types = get_terms( 'r_level', array( 'hide_empty' => false ) );
				if ($job_types && sizeof($job_types) > 0) {
					foreach ($job_types as $type) {
						?>
						<option <?php if ( $posted['r_level']==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
						<?php
					}
				}
				?>
			</select></p>
			<p><label for="hire"><?php _e('Latest Industry', APP_TD); ?> <span title="required">*</span></label> 
				<select name="r_industry"  id="r_industry">
				<?php
				$job_types = get_terms( 'r_industry', array( 'hide_empty' => false ) );
				if ($job_types && sizeof($job_types) > 0) {
					foreach ($job_types as $type) {
						?>
						<option <?php if ( $posted['r_industry']==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
						<?php
					}
				} ?>
			</select></p>
			<p><label for="r_position"><?php _e('Latest Position', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text" name="r_position" id="r_position" value="<?php echo esc_attr( $posted['r_position'] ); ?>" /></p>
			<p><label for="r_salary"><?php _e('Latest Salary', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text" name="r_salary" id="r_salary" value="<?php echo esc_attr( $posted['r_salary'] ); ?>" /></p>						
		</fieldset>

		<!---end career profile-->
                
                <!---start job prefference profile-->

		<fieldset>
		     <legend><?php _e('Job Prefference', APP_TD); ?></legend>
		     	<p><label for="hire"><?php _e('Preferred Industry', APP_TD); ?> <span title="required">*</span></label> 
			<select name="r_p_industry" id="r_p_industry">
			<?php
			$job_types = get_terms( 'r_industry', array( 'hide_empty' => false ) );
			if ($job_types && sizeof($job_types) > 0) {
			foreach ($job_types as $type) {?>
			<option <?php if ( $posted['r_p_industry']==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
			<?php } } ?>
			</select></p>
		
		     	<p class="optional"><label for="r_pre_loc"><?php _e('Preferred Location', APP_TD); ?></label> <select name="r_pre_loc" id="r_pre_loc">
			<option value=""><?php _e('Any', APP_TD); ?></option>
			<?php
			$job_types = get_terms( 'job_loc', array( 'hide_empty' => '0' ) );
			if ($job_types && sizeof($job_types) > 0) {
				foreach ($job_types as $type) {
					?>
					<option <?php if (isset($posted['r_pre_loc']) && $posted['r_pre_loc']==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
					<?php
				}
			}
			?>
			</select></p>
			<p class="optional"><label for="job_salary"><?php _e('Expected Salary', APP_TD); ?></label> <select name="job_salary" id="job_salary">
			<option value=""><?php _e('Any', APP_TD); ?></option>
			<?php
			$job_types = get_terms( 'job_salary', array( 'hide_empty' => '0' ) );
			if ($job_types && sizeof($job_types) > 0) {
				foreach ($job_types as $type) {
					?>
					<option <?php if (isset($posted['job_salary']) && $posted['job_salary']==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
					<?php
				}
			}
			?>
			</select></p>
			<p class="optional"><label for="job_type"><?php _e('Job Type', APP_TD); ?></label> <select name="job_type" id="job_type">
				<option value=""><?php _e('Any', APP_TD); ?></option>
				<?php
				$job_types = get_terms( 'job_type', array( 'hide_empty' => '0' ) );
				if ($job_types && sizeof($job_types) > 0) {
					foreach ($job_types as $type) {
						?>
						<option <?php if (isset($posted['job_type']) && $posted['job_type']==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
						<?php
					}
				}
				?>
			</select></p>
		</fieldset>

                <!---end prefference profile-->
		
		<!----start education----->
		<fieldset>
			<legend><?php _e('Education', APP_TD); ?>  - <a href="#" class="add_education" style="color:#990;">Add</a></legend>
                        <p class="optional"><label for="r_qualification"><?php _e('Qualification', APP_TD); ?></label> <select name="r_qualification" id="r_qualification">
				<option value=""><?php _e('Any', APP_TD); ?></option>
				<?php
				$job_types = get_terms( 'r_highest_qualification', array( 'hide_empty' => '0' ) );
				if ($job_types && sizeof($job_types) > 0) {
					foreach ($job_types as $type) {
						?>
						<option <?php if (isset($posted['r_qualification']) && $posted['r_qualification']==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
						<?php
					}
				}
				?>
			</select></p>

			<p><label for="dob"><?php _e('Start Date', APP_TD); ?></label>
                        <select style="width:118px" class="s_day" name="s_day">
                             <option>Day</option>
                             <?php for($i=1; $i<=31; $i++){ ?>
                             <option <?php if($posted['s_day']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>

                        <select style="width:118px" class="s_month" name="s_month">
                             <option>Month</option>
			     <?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                             foreach($months as $key => $month){ ?>
				<option <?php if($posted['s_month']==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
			    <?php } ?>
                        </select>

                        <select style="width:118px" class="s_year" name="s_year">
                             <option>Year</option>
                             <?php for($i=1970; $i<=2016; $i++){ ?>
                             <option <?php if($posted['s_year']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select></p>	

			<p><label for="dob"><?php _e('End Date', APP_TD); ?></label>
                        <select style="width:118px" class="e_day" name="e_day">
                             <option>Day</option>
                             <?php for($i=1; $i<=31; $i++){ ?>
                             <option <?php if($posted['e_day']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>

                        <select style="width:118px" class="e_month" name="e_month">
                             <option>Month</option>
			     <?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                             foreach($months as $key => $month){?>
			     <option <?php if($posted['e_month']==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
			     <?php } ?>
                        </select>

                        <select style="width:118px" class="e_year" name="e_year">
                             <option>Year</option>
                             <?php for($i=1970; $i<=2016; $i++){ ?>
                             <option <?php if($posted['e_year']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select></p>

			<p><label for="r_position"><?php _e('University', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text" name="r_university" id="r_university" value="<?php echo esc_attr( $posted['r_university'] ); ?>" /></p>
			<p><label for="r_field"><?php _e('Field of Study', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text" name="r_field" id="r_field" value="<?php echo esc_attr( $posted['r_field'] ); ?>" /></p>
			<p><label for="r_e_description"><?php _e('Description', APP_TD); ?> <span title="required">*</span></label> <textarea rows="5" cols="30" name="r_e_description" id="r_e_description" placeholder="<?php _e('', APP_TD); ?>" class="short" style="height:100px;"><?php if (isset($posted['r_e_description'])) echo $posted['r_e_description']; ?></textarea></p>
                </fieldset>
				
		<fieldset class="education1" style="display:none;">
			<legend><?php _e('Education', APP_TD); ?>  - <a href="#" class="hide_education" style="color:#990;">Hide</a></legend>
                        <p class="optional"><label for="r_qualification"><?php _e('Qualification', APP_TD); ?></label> <select name="r_qualification1" id="r_qualification">
				<option value=""><?php _e('Any', APP_TD); ?></option>
				<?php
				$job_types = get_terms( 'r_highest_qualification', array( 'hide_empty' => '0' ) );
				if ($job_types && sizeof($job_types) > 0) {
				foreach ($job_types as $type) {?>
				<option <?php if (isset($posted['r_qualification1']) && $posted['r_qualification1']==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
				<?php } } ?>
			</select></p>

			<p><label for="dob"><?php _e('Start Date', APP_TD); ?></label>
                        <select style="width:118px" class="s_day" name="s_day1">
                             <option>Day</option>
                             <?php for($i=1; $i<=31; $i++){ ?>
                             <option <?php if($posted['s_day1']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>

                        <select style="width:118px" class="s_month" name="s_month1">
                             <option>Month</option>
			     <?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                             foreach($months as $key => $month){ ?>
				<option <?php if($posted['s_month1']==$i){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
			     <?php } ?>
                        </select>

                        <select style="width:118px" class="s_year" name="s_year1">
                             <option>Year</option>
                             <?php for($i=1970; $i<=2016; $i++){ ?>
                             <option <?php if($posted['s_year1']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select></p>

			<p><label for="dob"><?php _e('End Date', APP_TD); ?></label>
                        <select style="width:118px" class="e_day" name="e_day1">
                             <option>Day</option>
                             <?php for($i=1; $i<=31; $i++){ ?>
                             <option <?php if($posted['e_day1']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>

                        <select style="width:118px" class="e_month" name="e_month1">
                             <option>Month</option>
			     <?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                             foreach($months as $key => $month){ ?>
			     <option <?php if($posted['e_month1']==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
			     <?php } ?>
                        </select>

                        <select style="width:118px" class="e_year" name="e_year1">
                             <option>Year</option>
                             <?php for($i=1970; $i<=2016; $i++){ ?>
                             <option <?php if($posted['e_year1']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select></p>

			<p><label for="r_position1"><?php _e('University', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text" name="r_university1" id="r_university1" value="<?php echo esc_attr( $posted['r_university1'] ); ?>" /></p>
			<p><label for="r_field"><?php _e('Field of Study', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text" name="r_field1" id="r_field1" value="<?php echo esc_attr( $posted['r_field1'] ); ?>" /></p>
			<p><label for="r_e_description1"><?php _e('Description', APP_TD); ?> <span title="required">*</span></label> <textarea rows="5" cols="30" name="r_e_description1" id="r_e_description1" placeholder="<?php _e('', APP_TD); ?>" class="short" style="height:100px;"><?php if (isset($posted['r_e_description1'])) echo $posted['r_e_description1']; ?></textarea></p>
                </fieldset>
		<!-----end education ---->

                <!-----start education ---->
		<fieldset>
			<legend><?php _e('Language', APP_TD); ?> - <a href="#" class="add_language" style="color:#990;">Add</a> (1)</legend> 
                        <p class="optional"><label for="r_h_language"><?php _e('Language', APP_TD); ?></label> <select name="r_h_language" id="r_h_language">
			<option value=""><?php _e('Any', APP_TD); ?></option>
			<?php
			$job_types = get_terms( 'r_h_language', array( 'hide_empty' => '0' ) );
			if ($job_types && sizeof($job_types) > 0) {
				foreach ($job_types as $type) {
					?>
				<option <?php if (isset($posted['r_h_language']) && $posted['r_h_language']==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
				<?php } }?>
			</select></p>

			<p class="optional"><label for="l_r_level"><?php _e('Level', APP_TD); ?></label> <select name="l_r_level" id="l_r_level">
			<option value=""><?php _e('Any', APP_TD); ?></option>
			<?php
			$job_types = get_terms( 'l_r_level', array( 'hide_empty' => '0' ) );
			if ($job_types && sizeof($job_types) > 0) {
				foreach ($job_types as $type) {
					?>
					<option <?php if (isset($posted['l_r_level']) && $posted['r_level']==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
					<?php
				}
			}
			?>
			</select></p>
		</fieldset>

		<fieldset class="language1" style="display:none;">
			<legend><?php _e('Language 1', APP_TD); ?> - <a href="#" class="hide_language" style="color:#990;">Hide</a></legend> 
                        <p class="optional"><label for="r_h_language"><?php _e('Language', APP_TD); ?></label> <select name="r_h_language1" id="r_h_language">
			<option value=""><?php _e('Any', APP_TD); ?></option>
			<?php
			$job_types = get_terms( 'r_h_language', array( 'hide_empty' => '0' ) );
			if ($job_types && sizeof($job_types) > 0) {
			foreach ($job_types as $type) { ?>
			<option <?php if (isset($posted['r_h_language1']) && $posted['r_h_language1']==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
			<?php } } ?>
			</select></p>

			<p class="optional"><label for="l_r_level"><?php _e('Level', APP_TD); ?></label> <select name="l_r_level1" id="l_r_level">
			<option value=""><?php _e('Any', APP_TD); ?></option>
			<?php
			$job_types = get_terms( 'l_r_level', array( 'hide_empty' => '0' ) );
			if ($job_types && sizeof($job_types) > 0) {
			foreach ($job_types as $type) { ?>
			<option <?php if (isset($posted['l_r_level1']) && $posted['r_level1']==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
			<?php } } ?>
			</select></p>
		</fieldset>
		<!-----end language ------>
                <!------start experience --->
                 <fieldset>
			<legend><?php _e('Work Experience', APP_TD); ?> - <a href="#" class="add_experience" style="color:#990;">Add</a> (1)</legend>
			<p><label for="r_company_name"><?php _e('Company Name:', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text" name="r_company_name" id="r_company_name" value="<?php echo esc_attr( $posted['r_company_name'] ); ?>" /></p>
			<p><label for="start_date"><?php _e('Start Date', APP_TD); ?></label>
                        <select style="width:118px" class="w_s_day" name="w_s_day">
                             <option>Day</option>
                             <?php for($i=1; $i<=31; $i++){ ?>
                             <option <?php if($posted['w_s_day']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>
                        <select style="width:118px" class="w_s_month" name="w_s_month">
                     	<option>Month</option>
		   	<?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                     	foreach($months as $key => $month){ ?>
			<option <?php if($posted['w_s_month']==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
			<?php } ?>
                        </select>

                        <select style="width:118px" class="w_s_year" name="w_s_year">
                             <option>Year</option>
                             <?php for($i=1970; $i<=2016; $i++){ ?>
                             <option <?php if($posted['w_s_year']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select> </p>	

			<p><label for="end_date"><?php _e('End Date', APP_TD); ?></label>
                        <select style="width:118px" class="w_e_day" name="w_e_day">
                             <option>Day</option>
                              <?php for($i=1; $i<=31; $i++){ ?>
                             <option <?php if($posted['w_e_day']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>

                        <select style="width:118px" class="w_e_month" name="w_e_month">
                     	<option>Month</option>
			<?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                     	foreach($months as $key => $month){
			?>
			<option <?php if($posted['w_e_month']==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
			<?php } ?>
                        </select>

                        <select style="width:118px" class="w_e_year" name="w_e_year">
                             <option>Year</option>
                             <?php for($i=1970; $i<=2016; $i++){ ?>
                             <option <?php if($posted['w_e_year']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select></p>

			<p><label for="w_r_position"><?php _e('Position:', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text" name="w_r_position" id="w_r_position" value="<?php echo esc_attr( $posted['w_r_position'] ); ?>" /></p>
			<p><label for="w_e_description"><?php _e('Description', APP_TD); ?> <span title="required">*</span></label> <textarea rows="5" cols="30" name="w_e_description" id="w_e_description" placeholder="<?php _e('', APP_TD); ?>" class="short" style="height:100px;"><?php if (isset($posted['w_e_description'])) echo $posted['w_e_description']; ?></textarea></p>
		</fieldset>

		<fieldset style="display:none;" class="experience1">
			<legend><?php _e('Work Experience', APP_TD); ?> - <a href="#" class="hide_experience" style="color:#990;">Hide</a></legend>
			<p><label for="r_company_name"><?php _e('Company Name:', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text" name="r_company_name1" id="r_company_name" value="<?php echo esc_attr( $posted['r_company_name1'] ); ?>" /></p>
			<p><label for="start_date"><?php _e('Start Date', APP_TD); ?></label>
                        <select style="width:118px" class="w_s_day" name="w_s_day1">
                             <option>Day</option>
                             <?php for($i=1; $i<=31; $i++){ ?>
                             <option <?php if($posted['w_s_day1']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>

                        <select style="width:118px" class="w_s_month" name="w_s_month1">
                        <option>Month</option>
			<?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                        foreach($months as $key => $month){?>
			<option <?php if($posted['w_s_month1']==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
			<?php } ?>
                        </select>

                        <select style="width:118px" class="w_s_year" name="w_s_year1">
                             <option>Year</option>
                             <?php for($i=1970; $i<=2016; $i++){ ?>
                             <option <?php if($posted['w_s_year1']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select></p>	

			<p><label for="end_date"><?php _e('End Date', APP_TD); ?></label>
                        <select style="width:118px" class="w_e_day" name="w_e_day1">
                             <option>Day</option>
                              <?php for($i=1; $i<=31; $i++){ ?>
                             <option <?php if($posted['w_e_day1']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>

                        <select style="width:118px" class="w_e_month" name="w_e_month1">
                        <option>Month</option>
			<?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                             foreach($months as $key => $month){ ?>
			<option <?php if($posted['w_e_month1']==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
			<?php } ?>
                        </select>

                        <select style="width:118px" class="w_e_year" name="w_e_year1">
                             <option>Year</option>
                             <?php for($i=1970; $i<=2016; $i++){ ?>
                             <option <?php if($posted['w_e_year1']==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select></p>

			<p><label for="w_r_position"><?php _e('Position:', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text" name="w_r_position1" id="w_r_position" value="<?php echo esc_attr( $posted['w_r_position1'] ); ?>" /></p>
			<p><label for="w_e_description"><?php _e('Description', APP_TD); ?> <span title="required">*</span></label> <textarea rows="5" cols="30" name="w_e_description1" id="w_e_description" placeholder="<?php _e('', APP_TD); ?>" class="short" style="height:100px;"><?php if (isset($posted['w_e_description1'])) echo $posted['w_e_description1']; ?></textarea></p>
		</fieldset>								

		<!---job Training-->	
		<fieldset>
			<legend><?php _e('Training', APP_TD); ?></legend>	
			<p><?php _e('Detail your education, including details on your qualifications and schools/universities attended.', APP_TD); ?></p>		
			<p class="r_training">
				<?php if ( 'yes' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
					<?php wp_editor( ( ! empty( $posted['r_training'] ) ? $posted['r_training'] : '' ), 'r_training', jr_get_editor_settings() ); ?>
				<?php } else { ?>
					<textarea id="r_training" name="r_training" cols="30" rows="5" ><?php if (isset($posted['r_training'])) echo esc_textarea( $posted['r_training'] ); ?></textarea>
				<?php } ?>
			</p>
		</fieldset>
		<!---end job Training-->

		<!---job Hobby-->	
		<fieldset>
			<legend><?php _e('Hobby', APP_TD); ?></legend>
			<p><?php _e('Detail your education, including details on your qualifications and schools/universities attended.', APP_TD); ?></p>			
			<p class="r_hobby">
				<?php if ( 'yes' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
					<?php wp_editor( ( ! empty( $posted['r_hobby'] ) ? $posted['r_hobby'] : '' ), 'r_hobby', jr_get_editor_settings() ); ?>
				<?php } else { ?>
					<textarea id="r_hobby" name="r_hobby" cols="30" rows="5" ><?php if (isset($posted['r_hobby'])) echo esc_textarea( $posted['r_hobby'] ); ?></textarea>
				<?php } ?>
			</p>
		</fieldset>
		<!---end job Hobby-->
		
		<!---job Reference-->		
		<fieldset>
			<legend><?php _e('Reference', APP_TD); ?></legend>			
			<p><?php _e('Detail your education, including details on your qualifications and schools/universities attended.', APP_TD); ?></p>
			<p class="r_reference">
				<?php if ( 'yes' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
					<?php wp_editor( ( ! empty( $posted['r_reference'] ) ? $posted['r_reference'] : '' ), 'r_reference', jr_get_editor_settings() ); ?>
				<?php } else { ?>
					<textarea id="r_reference" name="r_reference" cols="30" rows="5" ><?php if (isset($posted['r_reference'])) echo esc_textarea( $posted['r_reference'] ); ?></textarea>
				<?php } ?>
			</p>
		</fieldset>
		<!---end job Education-->							
		<p><input type="submit" class="submit" name="save_resume" value="<?php _e('Save &rarr;', APP_TD); ?>" /></p>
		<div class="clear"></div>
	</form>
	<script type="text/javascript">

		jQuery(function(){
                        
                       

			/* Auto Complete */
			var availableTags = [
				<?php
					$terms_array = array();
					$terms = get_terms( 'resume_languages', 'hide_empty=0' );
					if ($terms) foreach ($terms as $term) {
						$terms_array[] = '"'.$term->name.'"';
					}
					echo implode(',', $terms_array);
				?>
			];
			function split( val ) {
				return val.split( /,\s*/ );
			}
			function extractLast( term ) {
				return split( term ).pop();
			}
			jQuery("#languages_wrap input").on( "keydown", function( event ) {
				if ( (event.keyCode === jQuery.ui.keyCode.TAB || event.keyCode === jQuery.ui.keyCode.COMMA) &&
						jQuery( this ).data( "autocomplete" ).menu.active ) {
					event.preventDefault();
				}
			}).autocomplete({
			    minLength: 0,
				source: function( request, response ) {
					// delegate back to autocomplete, but extract the last term
					response( jQuery.ui.autocomplete.filter(
						availableTags, extractLast( request.term ) ) );
				},
			    focus: function() {
			    	jQuery('input.ui-autocomplete-input').val('');
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {

					var terms = split( this.value );
					// remove the current input
					terms.pop();
					// add the selected item
					terms.push( ui.item.value );
					// add placeholder to get the comma-and-space at the end
					terms.push( "" );
					//this.value = terms.join( ", " );
					this.value = terms.join( "" );

					jQuery(this).blur();
					jQuery(this).focus();

					return false;
				}
			});

		});
	</script>
<?php
}