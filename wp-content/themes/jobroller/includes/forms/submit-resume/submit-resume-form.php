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
<div class='col-md-9 col-lg-9'>
<ol class="steps ">
<li class="previous done"><span class="first">Create Profile</span></li>
<li class="current "><span class="">Create CV</span></li>
<li class=""><span class="">Preview</span></li>
<li class=""><span class="last">Confirm</span></li>
</ol>

		<!--<p><?php _e('Enter your CV details below. Once saved you will be able to view your CV and optionally add links to your websites/social networks if you wish.', APP_TD); ?></p>-->
	
		<div class="col-lg-12 col-md-12 well personal">
			<legend style="display:none;"><?php _e('Personal Information', APP_TD); ?></legend>
			<legend><?php _e('Add CV', APP_TD); ?></legend>
				<div class='col-md-12 col-lg-12'>      
					   <p><label for="resume_name"><?php _e('CV Title', APP_TD); ?> <span title="required">*</span></label></p>
				
					<input type="text" class="text required form-control" name="resume_name" id="resume_name" placeholder="<?php _e('e.g. Mechanical Engineer', APP_TD); ?>" value="<?php if (isset($posted['resume_name'])) echo $posted['resume_name']; ?>" required/>
				</div> 
				<div class="col-md-12"> 
					<p class="optional"><label for="your-photo"><?php _e('Photo (.jpg, .gif or .png)', APP_TD); ?></label></p>
					<input type="file" class="text" name="your-photo" id="your-photo" />
				</div>
<div class="hidden_field">
<input type="hidden" name="r_firstname" class="text regular-text" id="first_name" value="<?php echo $userdata->first_name ?>" maxlength="100" />
<input type="hidden" name="r_lastname" class="text regular-text" id="last_name" value="<?php echo $userdata->last_name ?>" maxlength="100" />
<input type="hidden" name="r_sex" class="text regular-text" id="r_sex" value="<?php echo $userdata->r_sex; ?>"/>
<input type="hidden" name="d_day" id="d_day" value="<?php echo $userdata->d_day; ?>"/>
<input type="hidden" name="d_month" id="d_month" value="<?php echo $userdata->d_month; ?>"/>
<input type="hidden" name="d_year" id="d_year" value="<?php echo $userdata->d_year; ?>"/>
<input type="hidden" name="r_marital" id="r_marital" value="<?php echo $userdata->r_marital; ?>"/>
<input type="hidden" class="text" name="email_address" value="<?php echo $userdata->user_email; ?>" id="email_address" />
<input type="hidden" class="hidden" name="mobile" value="<?php echo $userdata->phone; ?>" id="mobile" />
<input type="hidden" class="text" name="r_nationality" id="r_nationality" value="<?php echo $userdata->nationality; ?>" />
<input type="hidden" name="r_location" id="r_location" value="<?php echo $userdata->r_location; ?>"/>
</div>

<div class="disabled" style="display:none;">		
<p><label for="first_name"><?php _e('First Name',APP_TD) ?></label> 
<input readonly type="text" class="text regular-text" value="<?php echo $userdata->first_name ?>" />
</p>
			<p><label for="last_name"><?php _e('Last Name',APP_TD) ?></label>
<input readonly type="text" class="text regular-text" value="<?php echo $userdata->last_name ?>" />
</p>
			<p class="optional"><label for="your-photo"><?php _e('Photo (.jpg, .gif or .png)', APP_TD); ?></label> <input type="file" class="text" name="your-photo" id="your-photo" /></p>
                                                
		<p><label for="hire"><?php _e('Sex', APP_TD); ?> <span title="required">*</span></label> 
		<input type="text" class="text regular-text" readonly value="<?php if($userdata->r_sex!=""){ echo $userdata->r_sex; }else { echo "Please select..."; }?>"/></p>
			<p><label for="dob"><?php _e('Date of Birth', APP_TD); ?></label>
<input readonly style="width:106px" type="text" class="text" value="<?php if($userdata->d_day!=""){ echo $userdata->d_day; }else{ echo "Day.."; } ?>"/>
<input readonly style="width:106px" type="text" class="text" value="<?php if($userdata->d_month!="") {echo $userdata->d_month; } else { echo "Month.."; } ?>"/>
<input readonly style="width:106px" type="text" class="text" value="<?php if($userdata->d_year!=""){ echo $userdata->d_year; }else{ echo "Year.."; } ?>"/>
</p>
			<p><label for="hire"><?php _e('Marital', APP_TD); ?> <span title="required">*</span></label>
<input readonly type="text" class="text" value="<?php if($userdata->r_marital!=""){ echo $userdata->r_marital; }else { echo "Please select..."; } ?>"/></p>

			<p class="optional"><label for="email_address"><?php _e('Email Address', APP_TD); ?></label> 
<input readonly type="text" class="text" value="<?php echo $userdata->user_email; ?>" /></p>
			
			<p class="optional"><label for="mobile"><?php _e('Mobile', APP_TD); ?></label> 
<input readonly type="text" class="text" value="<?php echo $userdata->phone; ?>" id="mobile" /></p>
			
			<p><label for="nationality"><?php _e('Nationality', APP_TD); ?> <span title="required">*</span></label> <input readonly type="text" class="text" value="<?php echo $userdata->nationality; ?>" /></p>

			<p><label for="hire"><?php _e('Location', APP_TD); ?> <span title="required">*</span></label>
<input readonly type="text" name="r_location" class="text" id="r_location" value="<?php if($userdata->r_location!=""){ echo $userdata->r_location; } else { echo "Please select..."; } ?>"/></p>

			<p><label for="address"><?php _e('Address', APP_TD); ?> <span title="required">*</span></label> 
<textarea  readonly rows="5" cols="30" class="short" style="height:100px;"><?php echo $userdata->r_address; ?></textarea>
<input type="hidden" name="r_address" class="text regular-text" id="r_address" value="<?php echo $userdata->r_address; ?>"/></p>
                </div>
		</div>
 
                <p style="display:none;"><a class="submit edit_profile" style="background: #F68220; text-shadow:none; color:white !important; font-weight:500;" target="_blank" href="http://khmer-engineeringjob.com/my-profile/">Edit Profile →</a></p>
               
		<!---career profile-->
 
		<div class="col-lg-12 col-md-12 well"> 
			<legend><?php _e('Career Information', APP_TD); ?></legend>
			<p>Enter details about the information below. Be as descriptive as possible so that potential candidates can find your job listing easily.</p>
			<div class='col-md-12'> 
					<p><label for="hire"><?php _e('Highest Qualification', APP_TD); ?> <span title="required">*</span></label> </p>
				  
					<select class='form-control' name="r_highest_qualification" id="r_highest_qualification" required>
									   <option value="">  Select... </option>
					<?php
					$job_types = get_terms( 'r_highest_qualification', array( 'hide_empty' => false, 'orderby' => 'description','order'=> 'ASC' ) );
					if ($job_types && sizeof($job_types) > 0) {
						foreach ($job_types as $type) {
							?>
							<option <?php if ( $posted['r_highest_qualification']==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
							<?php
						}
					}
					?>
					</select>  
			</div>
			<div class='col-md-12'> 
			<p><label for="hire"><?php _e('Latest Career Level', APP_TD); ?> <span title="required">*</span></label> </p>
			  
				<select name="r_level" id="r_level" class='form-control' required>
                                    <option value="">  Select... </option>
					<?php
					$job_types = get_terms( 'r_level', array( 'hide_empty' => false, 'orderby' => 'description','order'=> 'ASC' ) );
					if ($job_types && sizeof($job_types) > 0) {
						foreach ($job_types as $type) {
							?>
							<option <?php if ( $posted['r_level']==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
							<?php
						}
					}
					?>
				</select> 
			</div>
			<div class='col-md-12'> 
				<p><label for="hire"><?php _e('Latest Industry', APP_TD); ?> <span title="required">*</span></label> </p>
				  
				<select name="r_industry" class='form-control' id="r_industry" required>
                                     <option value="">  Select... </option>
					<?php
					$job_types = get_terms( 'r_industry', array( 'hide_empty' => false, 'orderby' => 'description','order'=> 'ASC' ) );
					if ($job_types && sizeof($job_types) > 0) {
						foreach ($job_types as $type) {
							?>
							<option <?php if ( $posted['r_industry']==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
							<?php
						}
					} ?>
				</select> 
			</div>
			<div class='col-md-12'> 
				<p><label for="r_position"><?php _e('Latest Position', APP_TD); ?> <span title="required">*</span></label></p>
		
				 <input type="text" class="text form-control" name="r_position" id="r_position" value="<?php echo esc_attr( $posted['r_position'] ); ?>" required/>
			</div>
			<div class="col-md-12"> 
				<p><label for="r_salary"><?php _e('Latest Salary', APP_TD); ?></label> </p>
			 
				<input type="text" class="text form-control" name="r_salary" id="r_salary" value="<?php echo esc_attr( $posted['r_salary'] ); ?>" />				
             
			</div> 
			<div class='col-md-12' > 
			   <p class="optional"><label for="your-file"><?php _e('CV File (.pdf, .zip or .doc)', APP_TD); ?></label></p>
			   <input type="file" class="text" name="your-file" id="your-file" />
			</div>
		</div>

		<!---end career profile-->
                
                <!---start job prefference profile-->

		<div class="col-lg-12 col-md-12 well"> 
		    <legend><?php _e('Job Preference', APP_TD); ?></legend>
			<p>Enter details about the Job Preference below. Be as descriptive as possible so that potential candidates can find your job listing easily.</p>
			<div class='col-md-12'> 
				<p><label for="hire"><?php _e('Preferred Industry', APP_TD); ?> <span title="required">*</span></label> 
			  
				<select name="r_p_industry" id="r_p_industry" class='form-control' required>
								 <option value="">  Select... </option>
				<?php
				$job_types = get_terms( 'r_industry', array( 'hide_empty' => false, 'orderby' => 'description','order'=> 'ASC' ) );
				if ($job_types && sizeof($job_types) > 0) {
				foreach ($job_types as $type) {?>
				<option <?php if ( $posted['r_p_industry']==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
				<?php } } ?>
				</select>
			</div> 
		
			<div class='col-md-12'> 
		     	<p class="optional"><label for="r_pre_loc"><?php _e('Preferred Location', APP_TD); ?></label></p>
				<select name="r_pre_loc" id="r_pre_loc" class='form-control'>
				<option value="" ><?php _e('Any', APP_TD); ?></option>
				<?php
				$job_types = get_terms( 'job_loc', array( 'hide_empty' => '0','orderby'=> 'slug', 'orderby' => 'description','order'=> 'ASC') );
				if ($job_types && sizeof($job_types) > 0) {
					foreach ($job_types as $type) {
						?>
						<option <?php if (isset($posted['r_pre_loc']) && $posted['r_pre_loc']==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
						<?php
					}
				}
				?>
				</select> 
			</div>
			<div class='col-md-12'> 
				<p class="optional"><label for="job_salary"><?php _e('Expected Salary', APP_TD); ?></label></p>
				 
				 <select name="job_salary" id="job_salary" class='form-control'>
				<option value=""><?php _e('Any', APP_TD); ?></option>
				<?php
				$job_types = get_terms( 'job_salary', array( 'hide_empty' => '0', 'orderby' => 'description','order'=> 'ASC' ) );
				if ($job_types && sizeof($job_types) > 0) {
					foreach ($job_types as $type) {
						?>
						<option <?php if (isset($posted['job_salary']) && $posted['job_salary']==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
						<?php
					}
				}
				?>
				</select> 
			</div>
			
			<div class='col-md-12'> 
				<p class="optional"><label for="job_type"><?php _e('Job Type', APP_TD); ?></label></p>
				<select name="job_type" id="job_type" class='form-control'>
					<option value=""><?php _e('Any', APP_TD); ?></option>
					<?php
					$job_types = get_terms( 'job_type', array( 'hide_empty' => '0', 'orderby' => 'description','order'=> 'ASC' ) );
					if ($job_types && sizeof($job_types) > 0) {
						foreach ($job_types as $type) {
							?>
							<option <?php if (isset($posted['job_type']) && $posted['job_type']==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
							<?php
						}
					}
					?>
				</select> 
			</div> 
		</div>

                <!---end prefference profile-->
				<!--<fieldset>
                      <legend><a href="#" class="submit add_education" style="background: #F68220; text-shadow:none; color:white !important; font-weight:500;">Add Education (+)</a></legend>
                </fieldset>-->
		<!----start education----->
                <div class="main_education" style="display:none;">
		<fieldset>
			<legend><?php _e('Education', APP_TD); ?>  - 
			<a href="#" class="remove_education" style="color:#990;">Remove</a> (-)</legend>
									<p class="optional"><label for="r_qualification"><?php _e('Qualification', APP_TD); ?></label> <select name="r_qualification[]" id="r_qualification">
							<option value=""><?php _e('Any', APP_TD); ?></option>
							<?php
							$job_types = get_terms( 'r_highest_qualification', array( 'hide_empty' => '0', 'orderby' => 'description','order'=> 'ASC' ) );
						if ($job_types && sizeof($job_types) > 0) {
								foreach ($job_types as $type) {
									?>
									<option value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
									<?php
							}
						}
			?>
		</select></p>

			<p><label for="dob"><?php _e('Start Date', APP_TD); ?></label>
                        <select style="width:118px" class="s_day" name="s_day[]">
                             <option>Day</option>
                             <?php for($i=1; $i<=31; $i++){ ?>
                             <option value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>

                        <select style="width:118px" class="s_month" name="s_month[]">
                             <option>Month</option>
			     <?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                             foreach($months as $key => $month){ ?>
				<option value="<?= $month ?>"><?= $month ?></option>
			    <?php } ?>
                        </select>

                        <select style="width:118px" class="s_year" name="s_year[]">
                             <option>Year</option>
                             <?php for($i=1990; $i<=2020; $i++){ ?>
                             <option value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select></p>	

			<p><label for="dob"><?php _e('End Date', APP_TD); ?></label>
                        <select style="width:118px" class="e_day" name="e_day[]">
                             <option>Day</option>
                             <?php for($i=1; $i<=31; $i++){ ?>
                             <option value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>

                        <select style="width:118px" class="e_month" name="e_month[]">
                             <option>Month</option>
			     <?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                             foreach($months as $key => $month){?>
			     <option  value="<?= $month ?>"><?= $month ?></option>
			     <?php } ?>
                        </select>

                        <select style="width:118px" class="e_year" name="e_year[]">
                             <option>Year</option>
                             <?php for($i=1990; $i<=2020; $i++){ ?>
                             <option value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select></p>

			<p><label for="r_position"><?php _e('University', APP_TD); ?></label> <input type="text" class="text" name="r_university[]" id="r_university" value="" /></p>
			<p><label for="r_field"><?php _e('Field of Study', APP_TD); ?> </label> <input type="text" class="text" name="r_field[]" id="r_field" value="" /></p>
			<p><label for="r_e_description"><?php _e('Description', APP_TD); ?> </label> <textarea rows="5" cols="30" name="r_e_description[]" id="r_e_description" placeholder="<?php _e('', APP_TD); ?>" class="short" style="height:100px;"></textarea></p>
                </fieldset>
		</div>
		
<div class="expend_education">
<?php 
$r_qualifications = $posted['r_qualification']; 
$s_day = $posted['s_day']; 
$s_month = $posted['s_month']; 
$s_year = $posted['s_year']; 

$e_day= $posted['e_day']; 
$e_month = $posted['e_month']; 
$e_year = $posted['e_year']; 

$r_university = $posted['r_university']; 
$r_field = $posted['r_field']; 
$r_e_description = $posted['r_e_description']; 
if(!empty($r_qualifications)){
foreach($r_qualifications as $keys => $r_qualification) {
if($r_qualification!=""){
?>

<fieldset>
			<legend><?php _e('Education', APP_TD); ?>  - 
<a href="#" class="remove_education" style="color:#990;">Remove</a> (-)</legend>
                        <p class="optional"><label for="r_qualification"><?php _e('Qualification', APP_TD); ?></label> <select name="r_qualification[]" id="r_qualification">
				<option value=""><?php _e('Any', APP_TD); ?></option>
				<?php
				$job_types = get_terms( 'r_highest_qualification', array( 'hide_empty' => '0', 'orderby' => 'description','order'=> 'ASC' ) );
				if ($job_types && sizeof($job_types) > 0) {
					foreach ($job_types as $type) {
						?>
						<option <?php if (isset($posted['r_qualification']) && $r_qualification==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
						<?php
					}
				}
				?>
			</select></p>

			<p><label for="dob"><?php _e('Start Date', APP_TD); ?></label>
                        <select style="width:118px" class="s_day" name="s_day[]">
                             <option>Day</option>
                             <?php for($i=1; $i<=31; $i++){ ?>
                             <option <?php if($s_day[$keys]==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>

                        <select style="width:118px" class="s_month" name="s_month[]">
                             <option>Month</option>
			     <?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                             foreach($months as $key => $month){ ?>
				<option <?php if($s_month[$keys]==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
			    <?php } ?>
                        </select>

                        <select style="width:118px" class="s_year" name="s_year[]">
                             <option>Year</option>
                             <?php for($i=1990; $i<=2020; $i++){ ?>
                             <option <?php if($s_year[$keys]==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select></p>	

			<p><label for="dob"><?php _e('End Date', APP_TD); ?></label>
                        <select style="width:118px" class="e_day" name="e_day[]">
                             <option>Day</option>
                             <?php for($i=1; $i<=31; $i++){ ?>
                             <option <?php if($e_year[$keys]==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>

                        <select style="width:118px" class="e_month" name="e_month[]">
                             <option>Month</option>
			     <?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                             foreach($months as $key => $month){?>
			     <option <?php if($e_month[$keys]==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
			     <?php } ?>
                        </select>

                        <select style="width:118px" class="e_year" name="e_year[]">
                             <option>Year</option>
                             <?php for($i=1990; $i<=2020; $i++){ ?>
                             <option <?php if($e_year[$keys]==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select></p>

			<p><label for="r_position"><?php _e('University', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text" name="r_university[]" id="r_university" value="<?php echo esc_attr( $r_university[$keys] ); ?>" /></p>

			<p><label for="r_field"><?php _e('Field of Study', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text" name="r_field[]" id="r_field" value="<?php echo esc_attr( $r_field[$keys] ); ?>" /></p>

			<p><label for="r_e_description"><?php _e('Description', APP_TD); ?> <span title="required">*</span></label> <textarea rows="5" cols="30" name="r_e_description[]" id="r_e_description" placeholder="<?php _e('', APP_TD); ?>" class="short" style="height:100px;"><?php if (isset($posted['r_e_description'])) echo $r_e_description[$keys]; ?></textarea></p>
                </fieldset>
<?php } } } ?>
</div>
            <!-----start education ---->
				<div class="clear"></div> 
		<div class="col-lg-12 well">
				<legend><?php _e('Add Education', APP_TD); ?></legend>
				<p>Enter details about the Education below.</p>
				<div class="col-sm-12 form-group">
					<div class="wp_editor_wrapper">
						<?php if ( 'yes1' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
							<?php wp_editor( $job->apply, 'apply', jr_get_editor_settings( array( 'editor_class' => 'how' ) ) ); ?>
						<?php } else { ?>
								<textarea   name="r_trainings" cols="30" rows="5" class="form-control"><?php if (isset($posted['r_trainings'])) echo esc_textarea( $posted['r_trainings'] ); ?></textarea>
						<?php } ?>
					</div>
				</div>
		</div>
                <!--<fieldset>
                      <legend><a href="#" class="submit add_language" style="background: #F68220; text-shadow:none; color:white !important; font-weight:500;">Add Language (+)</a></legend>
                </fieldset>
	-->
                <div class="main-language" style="display:none;">
		<fieldset>
			<legend><?php _e('Language', APP_TD); ?> - 
                                <a href="#" class="remove_language" style="color:#990;">Remove</a> (-) </legend> 
                        <p class="optional"><label for="r_h_language"><?php _e('Language', APP_TD); ?></label> 
                        <select name="r_h_language[]" id="r_h_language">
			<option value=""><?php _e('Any', APP_TD); ?></option>
			<?php
			$job_types = get_terms( 'r_h_language', array( 'hide_empty' => '0', 'orderby' => 'description','order'=> 'ASC' ) );
			if ($job_types && sizeof($job_types) > 0) {
				foreach ($job_types as $type) {
					?>
				<option <?php if (isset($posted['r_h_language']) && $posted['r_h_language']==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
				<?php } }?>
			</select></p>

			<p class="optional"><label for="l_r_level"><?php _e('Level', APP_TD); ?></label> 
                        <select name="l_r_level[]" id="l_r_level">
			<option value=""><?php _e('Any', APP_TD); ?></option>
			<?php
			$job_types = get_terms( 'l_r_level', array( 'hide_empty' => '0', 'orderby' => 'description','order'=> 'ASC' ) );
			if ($job_types && sizeof($job_types) > 0) {
				foreach ($job_types as $type) {
					?>
					<option <?php if (isset($posted['l_r_level']) && $posted['l_r_level']==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
					<?php
				}
			}
			?>
			</select></p>
		</fieldset>
                </div>
                <!--<div class="language-append">
<?php 
$languages = $posted['r_h_language']; 
$level = $posted['l_r_level'];
if(!empty($languages )){
foreach($languages as $key=>$language) {
if($language!=""){
?>

                     <fieldset>
			<legend><?php _e('Language', APP_TD); ?> - 
                                <a href="#" class="remove_language" style="color:#990;">Remove</a> (-) </legend> 
                        <p class="optional"><label for="r_h_language"><?php _e('Language', APP_TD); ?></label> 
                        <select name="r_h_language[]" id="r_h_language">
			<option value=""><?php _e('Any', APP_TD); ?></option>
			<?php
			$job_types = get_terms( 'r_h_language', array( 'hide_empty' => '0', 'orderby' => 'description','order'=> 'ASC' ) );
			if ($job_types && sizeof($job_types) > 0) {
				foreach ($job_types as $type) {
					?>
				<option <?php if (isset($posted['r_h_language']) && $language==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
				<?php } }?>
			</select></p>

			<p class="optional"><label for="l_r_level"><?php _e('Level', APP_TD); ?></label> 
                        <select name="l_r_level[]" id="l_r_level">
			<option value=""><?php _e('Any', APP_TD); ?></option>
			<?php
			$job_types = get_terms( 'l_r_level', array( 'hide_empty' => '0', 'orderby' => 'description','order'=> 'ASC' ) );
			if ($job_types && sizeof($job_types) > 0) {
				foreach ($job_types as $type) {
					?>
					<option <?php if (isset($posted['l_r_level']) && $level[$key]==$type->slug) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
					<?php
				}
			}
			?>
			</select></p>
		</fieldset>

<?php } } }?>
                </div> -->
		<div class="col-lg-12 well">
				<legend><?php _e('Add Language', APP_TD); ?></legend>
				<p>Enter your language that you can use.</p>
				<div class="col-sm-12 form-group">
					<div class="wp_editor_wrapper">
						<?php if ( 'yes1' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
							<?php wp_editor( $job->apply, 'apply', jr_get_editor_settings( array( 'editor_class' => 'how' ) ) ); ?>
						<?php } else { ?>
								<textarea   name="r_trainings" cols="30" rows="5" class="form-control"><?php if (isset($posted['r_trainings'])) echo esc_textarea( $posted['r_trainings'] ); ?></textarea>
						<?php } ?>
					</div>
				</div>
		</div>
		<!-----end language ------>

				<!--
                <fieldset>
                      <legend><a href="#" class="submit add_experience" style="background: #F68220; text-shadow:none; color:white !important; font-weight:500;">Add Experience (+)</a></legend>
                </fieldset>-->
                <!------start experience --->
                 <div class="main_experience" style="display:none;">
                 <fieldset>
			<legend><?php _e('Work Experience', APP_TD); ?> - 
                        <a href="#" class="remove_experience" style="color:#990;">Remove</a> (-)</legend>
			<p><label for="r_company_name"><?php _e('Company Name:', APP_TD); ?> </label>                <input type="text" class="text" name="r_company_name[]" id="r_company_name" value="" /></p>
			<p><label for="start_date"><?php _e('Start Date', APP_TD); ?></label>
                        <select style="width:118px" class="w_s_day" name="w_s_day[]">
                             <option>Day</option>
                             <?php for($i=1; $i<=31; $i++){ ?>
                             <option value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>
                        <select style="width:118px" class="w_s_month" name="w_s_month[]">
                     	<option>Month</option>
		   	<?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                     	foreach($months as $key => $month){ ?>
			<option value="<?= $month ?>"><?= $month ?></option>
			<?php } ?>
                        </select>

                        <select style="width:118px" class="w_s_year" name="w_s_year[]">
                             <option>Year</option>
                             <?php for($i=1990; $i<=2020; $i++){ ?>
                             <option value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select> </p>	

			 <p><label for="end_date"><?php _e('End Date', APP_TD); ?></label>
                        <select style="width:118px" class="w_e_day" name="w_e_day[]">
                             <option>Day</option>
                              <?php for($i=1; $i<=31; $i++){ ?>
                             <option value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>

                        <select style="width:118px" class="w_e_month" name="w_e_month[]">
                     	<option>Month</option>
			<?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                     	foreach($months as $key => $month){
			?>
			<option value="<?= $month ?>"><?= $month ?></option>
			<?php } ?>
                        </select>

                        <select style="width:118px" class="w_e_year" name="w_e_year[]">
                             <option>Year</option>
                             <?php for($i=1990; $i<=2020; $i++){ ?>
                             <option value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select></p>

			<p><label for="w_r_position"><?php _e('Position:', APP_TD); ?> </label> <input type="text" class="text" name="w_r_position[]" id="w_r_position" value="" /></p>
			<p><label for="w_e_description"><?php _e('Description', APP_TD); ?></label> <textarea rows="5" cols="30" name="w_e_description[]" id="w_e_description" placeholder="<?php _e('', APP_TD); ?>" class="short" style="height:100px;"></textarea></p>
		</fieldset>

                </div>
<!--
<div class="expend_experience">
<?php 
$r_company_names = $posted['r_company_name']; 
$w_s_day = $posted['w_s_day'];
$w_s_month = $posted['w_s_month'];
$w_s_year = $posted['w_s_year'];

$w_e_day = $posted['w_e_day'];
$w_e_month = $posted['w_e_month'];
$w_e_year = $posted['w_e_year'];

$w_r_position = $posted['w_r_position'];
$w_e_description = $posted['w_e_description'];
if(!empty($r_company_names)){
foreach($r_company_names as $key1=>$r_company_name) {
if($r_company_name!=""){
?>

<fieldset>
			<legend><?php _e('Work Experience', APP_TD); ?> - 
                        <a href="#" class="remove_experience" style="color:#990;">Remove</a> (-)</legend>
			<p><label for="r_company_name"><?php _e('Company Name:', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text" name="r_company_name[]" id="r_company_name" value="<?php echo esc_attr( $r_company_name ); ?>" /></p>
			<p><label for="start_date"><?php _e('Start Date', APP_TD); ?></label>
                        <select style="width:118px" class="w_s_day" name="w_s_day[]">
                             <option>Day</option>
                             <?php for($i=1; $i<=31; $i++){ ?>
                             <option <?php if($w_s_day[$key1]==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>
                        <select style="width:118px" class="w_s_month" name="w_s_month[]">
                     	<option>Month</option>
		   	<?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                     	foreach($months as $key => $month){ ?>
			<option <?php if($w_s_month[$key1]==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
			<?php } ?>
                        </select>

                        <select style="width:118px" class="w_s_year" name="w_s_year[]">
                             <option>Year</option>
                             <?php for($i=1990; $i<=2020; $i++){ ?>
                             <option <?php if($w_s_year[$key1]==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select> </p>	

			<p><label for="end_date"><?php _e('End Date', APP_TD); ?></label>
                        <select style="width:118px" class="w_e_day" name="w_e_day[]">
                             <option>Day</option>
                              <?php for($i=1; $i<=31; $i++){ ?>
                             <option <?php if($w_e_day[$key1]==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select>

                        <select style="width:118px" class="w_e_month" name="w_e_month[]">
                     	<option>Month</option>
			<?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                     	foreach($months as $key => $month){
			?>
			<option <?php if($w_e_month[$key1]==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
			<?php } ?>
                        </select>

                        <select style="width:118px" class="w_e_year" name="w_e_year[]">
                             <option>Year</option>
                             <?php for($i=1990; $i<=2020; $i++){ ?>
                             <option <?php if($w_e_year[$key1]==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                             <?php } ?>
                        </select></p>

			<p><label for="w_r_position"><?php _e('Position:', APP_TD); ?> <span title="required">*</span></label> <input type="text" class="text" name="w_r_position[]" id="w_r_position" value="<?php echo esc_attr( $w_r_position[$key1] ); ?>" /></p>
			<p><label for="w_e_description"><?php _e('Description', APP_TD); ?> <span title="required">*</span></label> <textarea rows="5" cols="30" name="w_e_description[]" id="w_e_description" placeholder="<?php _e('', APP_TD); ?>" class="short" style="height:100px;"><?php if (isset($w_e_description[$key1])) echo $w_e_description[$keys]; ?></textarea></p>
		</fieldset>

<?php } } } ?>
</div>-->
		<div class="col-lg-12 well">
				<legend><?php _e('Work Experience', APP_TD); ?></legend>
				<p>Enter details about your job experience. Be as descriptive as possible so that potential candidates can find your job listing easily.</p>
				<div class="col-sm-12 form-group">
					<div class="wp_editor_wrapper">
						<?php if ( 'yes1' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
							<?php wp_editor( $job->apply, 'apply', jr_get_editor_settings( array( 'editor_class' => 'how' ) ) ); ?>
						<?php } else { ?>
								<textarea   name="test" cols="30" rows="5" class="form-control"><?php if (isset($posted['test'])) echo esc_textarea( $posted['test'] ); ?></textarea>
						<?php } ?>
					</div>
				</div>
		</div>		
		<!---job Training	
		<fieldset>
			<legend><?php _e('Training (Short Course)', APP_TD); ?></legend>	
			
			<p class=" ">
				<?php if ( 'yes' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
					<?php wp_editor( ( ! empty( $posted['r_training'] ) ? $posted['r_training'] : '' ), 'r_training', jr_get_editor_settings() ); ?>
				<?php } else { ?>
					<textarea   name="r_training" cols="30" rows="5" ><?php if (isset($posted['r_training'])) echo esc_textarea( $posted['r_training'] ); ?></textarea>
				<?php } ?>
			</p>
		</fieldset>-->
		<div class="col-lg-12 well">
				<legend><?php _e('Training (Short Course)', APP_TD); ?></legend>
				<p>Enter details about the job below. Be as descriptive as possible so that potential candidates can find your job listing easily.</p>
				<div class="col-sm-12 form-group">
					<div class="wp_editor_wrapper">
						<?php if ( 'yes1' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
							<?php wp_editor( $job->apply, 'apply', jr_get_editor_settings( array( 'editor_class' => 'how' ) ) ); ?>
						<?php } else { ?>
								<textarea   name="r_training" cols="30" rows="5" class="form-control"><?php if (isset($posted['r_training'])) echo esc_textarea( $posted['r_training'] ); ?></textarea>
						<?php } ?>
					</div>
				</div>
		</div>
		<!---end job Training-->
		
		
		
		<!---job Hobby-->	
		<!--- 	
		<fieldset>
			<legend><?php _e('Hobby', APP_TD); ?></legend>
				
			
			<p class="r_hobby">
				<?php if ( 'yes' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
					<?php wp_editor( ( ! empty( $posted['r_hobby'] ) ? $posted['r_hobby'] : '' ), 'r_hobby', jr_get_editor_settings() ); ?>
				<?php } else { ?>
					<textarea id="r_hobby" name="r_hobby" cols="30" rows="5" ><?php if (isset($posted['r_hobby'])) echo esc_textarea( $posted['r_hobby'] ); ?></textarea>
				<?php } ?>
			</p>
		</fieldset>-->
		<div class="col-lg-12 well">
				<legend><?php _e('Hobby', APP_TD); ?></legend>
				<p>Please enter your favourite hobby or something you are interest to do.</p>
				<div class="col-sm-12 form-group">
					<div class="wp_editor_wrapper">
						<?php if ( 'yes1' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
							<?php wp_editor( $job->apply, 'apply', jr_get_editor_settings( array( 'editor_class' => 'how' ) ) ); ?>
						<?php } else { ?>
								<textarea id="r_hobby" name="r_hobby" cols="30" rows="5"  class='form-control'><?php if (isset($posted['r_hobby'])) echo esc_textarea( $posted['r_hobby'] ); ?></textarea>
						<?php } ?>
					</div>
				</div>
		</div>
		<!---end job Hobby-->
		
		<!---job Referee		
		<fieldset>
			<legend><?php _e('Referee', APP_TD); ?></legend>			
			
			<p class="r_reference">
				<?php if ( 'yes' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
					<?php wp_editor( ( ! empty( $posted['r_reference'] ) ? $posted['r_reference'] : '' ), 'r_reference', jr_get_editor_settings() ); ?>
				<?php } else { ?>
					<textarea id="r_reference" name="r_reference" cols="30" rows="5" ><?php if (isset($posted['r_reference'])) echo esc_textarea( $posted['r_reference'] ); ?></textarea>
				<?php } ?>
			</p>
		</fieldset>-->
		<div class="col-lg-12 well">
				<legend><?php _e('Referee', APP_TD); ?></legend>
				<p>Enter details about the job below. Be as descriptive as possible so that potential candidates can find your job listing easily.</p>
				<div class="col-sm-12 form-group">
					<div class="wp_editor_wrapper">
						<?php if ( 'yes1' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
							<?php wp_editor( $job->apply, 'apply', jr_get_editor_settings( array( 'editor_class' => 'how' ) ) ); ?>
						<?php } else { ?>
							<textarea id="r_reference" name="r_reference" cols="30" rows="5" class='form-control' ><?php if (isset($posted['r_reference'])) echo esc_textarea( $posted['r_reference'] ); ?></textarea>
						<?php } ?>
					</div>
				</div>
		</div>
		<!---job Referee-->
		<!---end job Education-->							
		<p><a href="http://khmer-engineeringjob.com/my-profile/" style="background: #F68220; text-shadow:none; color:white !important; font-weight:500;" class="submit btn btn-warning" > << Back</a>
                <input type="submit" style="background: #F68220; text-shadow:none; color:white !important; font-weight:500;" class="submit btn btn-warning" name="save_resume" value="<?php _e('Next >> ', APP_TD); ?>" />
		</p> 
		<div class="clear"></div>
		</div>
		<div class='col-md-3 col-lg-3'>
			<?php if (get_option('jr_show_sidebar')!=='no') get_sidebar('user'); ?>
		</div>
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