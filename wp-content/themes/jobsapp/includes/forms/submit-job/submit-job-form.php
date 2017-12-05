<?php
/**
 * JobRoller Submit/Edit/Relist Job form
 * Function outputs the job submit form
 *
 *
 * @version 1.7
 * @author AppThemes
 * @package JobRoller
 * @copyright 2010 all rights reserved
 *
 */
 	
	// if content is empty update the object for the JS validator
	
	$actions = array( 'edit-job', 'new-job', 'relist-job' );
	if ( ! empty($_POST['action']) && in_array( $_POST['action'], $actions ) && isset( $_POST['post_content'] ) && empty( $_POST['post_content'] ) ) {
		$job->post_content = '';
	}
	
	jr_geolocation_scripts( $job );
    $userdata = wp_get_current_user();
	
?>
		
	
	<form action="<?php echo esc_url( $form_action ) ?>" method="post" enctype="multipart/form-data" id="submit_form" class="submit_form main_form">
		<?php wp_nonce_field('submit_job', 'nonce') ?>
		<fieldset style="display:none;">
		
			<legend><?php _e('Company Details', APP_TD); ?></legend>
			<p><?php _e('Fill in the company section to provide details of the company listing the job. Leave this section blank to show your display name and profile page link instead.', APP_TD); ?></p>

			<p class="optional">
				<label for="your_name"><?php _e('Company Name', APP_TD); ?></label> 
				<input readonly type="text" class="form-control " value="<?php echo esc_attr( $userdata->company); ?>" />
			</p>
						
			<p class="optional">
				<label for="website"><?php _e('Website', APP_TD); ?></label> 
				<input readonly type="text" class="form-control" value="<?php echo esc_attr( $userdata->website); ?>" />
			</p>

			<p class="optional">
				<label for="email"><?php _e('Email', APP_TD); ?></label> 
				<input readonly type="text" class="form-control" value="<?php echo $userdata->user_email; ?>" />
			</p>

			<p class="optional">
				<label for="phone"><?php _e('Mobile', APP_TD); ?></label> 
				<input readonly type="text" class="form-control" value="<?php echo esc_attr( $userdata->phone); ?>" />
			</p>

			<p>
				<label for="hire"><?php _e('Location', APP_TD); ?></label> 
				<input readonly type="text" class="form-control" value="<?php echo $userdata->r_location; ?>" />
			</p>

			<p>
				<label for="address"><?php _e('Address', APP_TD); ?></label> 
				<textarea readonly rows="5" cols="30" class="form-control" style="height:100px;">
					<?php echo $userdata->r_address; ?>
				</textarea>
			</p>  		                
		</fieldset>	
	

	<?php // the_listing_logo_editor( $job->ID ); ?>

		<input type="hidden" class="text" name="your_name" id="your_name" value="<?php echo esc_attr( $userdata->company); ?>" />
		<input type="hidden" class="text" name="website" value="<?php echo esc_attr( $userdata->website); ?>" placeholder="http://" id="website" />
		<input type="hidden" class="text" name="email" value="<?php echo $userdata->user_email; ?>" />
		<input type="hidden" class="text" name="phone" value="<?php echo esc_attr( $userdata->phone); ?>" />
		<input type="hidden" class="text" name="j_location" value="<?php echo $userdata->r_location; ?>" />
		<input type="hidden" class="text" name="j_profile" value="<?php echo $userdata->r_profile; ?>" />
		<input type="hidden" class="text" name="j_location" value="<?php echo $userdata->r_address; ?>" />

		<div class="col-lg-12 well">
		
			<legend><?php _e('Job Details', APP_TD); ?></legend>			
			<p><?php _e('Enter details about the job below. Be as descriptive as possible so that potential candidates can find your job listing easily.', APP_TD); ?></p>
			
			<div class="col-sm-12 form-group">
				<label for="post_title"><?php _e('Job title', APP_TD); ?> <span title="required">*</span></label> 
				<input type="text" class="form-control required" name="post_title" id="post_title" value="<?php echo esc_attr( $job->post_title ); ?>" />
			</div>
				
				<div class="col-sm-12 form-group">
					<label for="post_title"><?php _e('Start Date', APP_TD); ?> <span title="required">*</span></label> 
					<input type="text" class="form-control required datepicker" name="start_date" id="start_date" value="<?php echo date("d/m/Y") ?>" />
				</div>
				
				<div class="col-sm-12 form-group">	
					<label for="post_title"><?php _e('End Date', APP_TD); ?> <span title="required">*</span></label> 
					<input type="text" class="form-control required datepicker" name="end_date" id="end_date" value="<?php echo date("d/m/Y") ?>" />
				</div>
																					
				<div class="col-md-3 col-sm-3 hidden">
					<div class="form-group">
						<label class="control-label" for="dob"><?php _e('Start Date', APP_TD); ?></label>
						<select class="form-control s_day" name="s_day">
							 <option>Day</option>
							 <?php for($i=1; $i<=31; $i++){ ?>
							 <option <?php if($job->s_day==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
							 <?php } ?>
						</select>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-3 hidden">
					<div class="form-group">
						<label class="control-label" for="dob">&nbsp;</label>
						<select class="form-control s_month" name="s_month">
							 <option>Month</option>
							 <?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
							foreach($months as $key => $month){ ?>
										<option <?php if($job->s_month==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-3 hidden">
					<div class="form-group">
						<label class="control-label" for="dob">&nbsp;</label>
						<select class="form-control s_year" name="s_year">
							 <option>Year</option>
							 <?php for($i=2010; $i<=2020; $i++){ ?>
							 <option <?php if($job->s_year==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
							 <?php } ?>
						</select>
					</div>
				</div>
				
				<div class="clearfix"></div>
			
				<div class="col-md-3 col-sm-3 hidden">
					<div class="form-group">
						<label class="control-label" for="dob"><?php _e('End Date', APP_TD); ?></label>
						<select class="form-control e_day" name="e_day">
							 <option>Day</option>
							 <?php for($i=1; $i<=31; $i++){ ?>
							 <option <?php if($job->e_day==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
							 <?php } ?>
						</select>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-3 hidden">
					<div class="form-group">
						<label class="control-label" for="dob">&nbsp;</label>
						<select class="form-control e_month" name="e_month">
							 <option>Month</option>
						 <?php $months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
									 foreach($months as $key => $month){?>
						 <option <?php if($job->e_month==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
						 <?php } ?>
						</select>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-3 hidden">
					<div class="form-group">
						<label class="control-label" for="dob">&nbsp;</label>
						<select class="form-control e_year" name="e_year">
							 <option>Year</option>
							 <?php for($i=2010; $i<=2020; $i++){ ?>
							 <option <?php if($job->e_year==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
							 <?php } ?>
						</select>
					</div>
				</div>
			
			<div class="clearfix"></div>

			<div class="col-sm-12 form-group">
				<label for="hire"><?php _e('Hiring Person', APP_TD); ?></label>						
				<select name="hire" id="hire" class="form-control required">
					<option value="">  Select... </option>
					<?php
					$job_types = get_terms( 'hire', array( 'hide_empty' => false, 'orderby' => 'description','order'=> 'ASC' ) );
					if ($job_types && sizeof($job_types) > 0) {
						foreach ($job_types as $type) { ?>
							<option <?php if ( $job->hire==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
				
			<div class="col-sm-12 form-group">
				<label for="j_type"><?php _e('Type', APP_TD); ?> <span title="required">*</span></label> 
				<select name="j_type" id="j_type" class="form-control required">
					<option value="">  Select... </option>
					<?php
					$job_types = get_terms( 'type', array( 'hide_empty' => false, 'orderby' => 'description','order'=> 'ASC') );
					if ($job_types && sizeof($job_types) > 0) {
						foreach ($job_types as $type) {
							?>
							<option <?php if ( $job->j_type==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
			
			
			<div class="col-sm-12 form-group"
				<label for="Industry"><?php _e('Industry', APP_TD); ?> </label> 
				<select name="industry" id="industry" class="form-control">
					<?php
					$job_types = get_terms( 'industry', array( 'hide_empty' => false, 'orderby' => 'description','order'=> 'ASC' ) );
					if ($job_types && sizeof($job_types) > 0) {
						foreach ($job_types as $type) {
							?>
							<option <?php if ( $job->industry==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
			
			<div class="col-sm-12 form-group">
				<label for="job_type"><?php _e('Job type', APP_TD); ?> <span title="required">*</span></label> 
				<select name="job_term_type" id="job_type" class="form-control required">
									<option value="">   Select... </option>
					<?php
					$job_types = get_terms( 'job_type', array( 'hide_empty' => false ) );
					if ($job_types && sizeof($job_types) > 0) {
						foreach ($job_types as $type) {
							?>
							<option <?php if ( $job->type==$type->term_id ) echo 'selected="selected"'; ?> value="<?php echo $type->term_id; ?>"><?php echo $type->name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
			
			<?php 
				$cat_required = '';
				if ( 'yes' == get_option('jr_submit_cat_required') )
					$cat_required = 'required';
			?>
			
			<div class="col-sm-12 form-group">
				<label for="job_cat"><?php _e('Job Category', APP_TD); ?>
					<?php if ( $cat_required ) : ?><span title="required">*</span><?php endif; ?></label> 
			<?php
				$args = array(
					'taxonomy'			=> APP_TAX_CAT,
					'orderby'			=> 'description', 
					'order'				=> 'ASC',
					'name'				=> 'job_term_cat',
					'class'				=> 'form-control job_cat ' . $cat_required,
					'selected' 			=> $job->category,
					'hide_empty'		=> false,
					'hierarchical'		=> true,
					'show_option_none' 	=> __( 'Select a category&hellip;', APP_TD ),
					'echo'				=> false,
				);
				$drop_cats = wp_dropdown_categories( $args );
				if ( $cat_required && get_query_var('job_edit') && !empty($job->category) && 'no' == get_option( 'jr_submit_cat_editable' ) ) {
					$drop_cats = str_replace( '<select', '<select disabled', $drop_cats );
					$display_no_edit_cat_msg = __( 'The category cannot be edited', APP_TD );
					echo "<input type='hidden' name='job_term_cat' value='".esc_attr($job->category)."'>";
				}
				echo $drop_cats;

				if ( ! empty($display_no_edit_cat_msg) ) {
					echo html( 'p', html( 'strong', __( 'Note: ', APP_TD ) ) . $display_no_edit_cat_msg );
				}
			?>
			</div>
		
			<?php do_action( 'jr_after_submit_job_form_category', $job ); ?>

			<!--added-->
			
			<div class="col-sm-12 form-group">
				<label for="job_loc"><?php _e('Job Location', APP_TD); ?> 
				<?php if (get_option('jr_submit_loc_required')=='Yes') : ?>
				<span title="required">*</span><?php endif; ?></label> <?php
					$args = array(
						'orderby'            => 'description', 
						'order'              => 'ASC',                                    
						'name'               => 'job_term_loc',
						'hierarchical'       => false, 
						'echo'		 => false,
						'class'              => 'form-control job_loc',
						'selected'			 => $job->loc,
						'taxonomy'			 => 'job_loc',
						'hide_empty'		 => false
					);
					$dropdown = wp_dropdown_categories( $args );
					$dropdown = str_replace('class=\'job_loc\' >','class=\'job_loc\' ><option value="">'.__('Select a location&hellip;', APP_TD).'</option>', $dropdown);
					echo $dropdown;
				?>
			</div>
					
			<!--endadded-->

			<?php if (get_option('jr_enable_salary_field')!=='no') : ?>
			<div class="col-sm-12 form-group">
				<label for="job_term_salary"><?php _e('Job Salary', APP_TD); ?></label> 
				<?php
				$args = array(
					'orderby'            => 'description', 
					'order'              => 'ASC',
					'name'               => 'job_term_salary',
					'hierarchical'       => false, 
					'echo'				 => false,
					'class'              => 'form-control job_salary',
					'selected'			 => $job->salary,
					'taxonomy'			 => 'job_salary',
					'hide_empty'		 => false
				);
				$dropdown = wp_dropdown_categories( $args );
				$dropdown = str_replace('class=\'job_salary\' >','class=\'job_salary\' ><option value="">'.__('Select a salary&hellip;', APP_TD).'</option>', $dropdown);
				echo $dropdown;
			?></div><?php endif; ?>			
			
		</div>
		
		<fieldset style="display:none;">
			<legend><?php _e('Job Location', APP_TD); ?></legend>
			<p><?php _e('Leave blank if the location of the applicant does not matter e.g. the job involves working from home.', APP_TD); ?></p>	
			<div id="geolocation_box">
				<p>
					<label>
						<input id="geolocation-load" type="button" class="button geolocationadd submit" value="<?php _e('Find Address/Location', APP_TD); ?>" />
					</label> 

					<input type="text" class="text" name="jr_address" id="geolocation-address" value="<?php echo esc_attr( $job->jr_address ); ?>" autocomplete="off" />
					<input type="hidden" class="text" name="jr_geo_latitude" id="geolocation-latitude" value="<?php echo esc_attr( $job->jr_geo_latitude ); ?>" />
					<input type="hidden" class="text" name="jr_geo_longitude" id="geolocation-longitude" value="<?php echo esc_attr( $job->jr_geo_longitude ); ?>" />
					<input type="hidden" class="text" name="jr_geo_country" id="geolocation-country" value="<?php echo esc_attr( $job->jr_geo_country ); ?>" />
					<input type="hidden" class="text" name="jr_geo_short_address" id="geolocation-short-address" value="<?php echo esc_attr( $job->jr_geo_short_address ); ?>" />
					<input type="hidden" class="text" name="jr_geo_short_address_country" id="geolocation-short-address-country" value="<?php echo esc_attr( $job->jr_geo_short_address_country ); ?>" />
				</p>	
				<div id="map_wrap" style="border:solid 2px #ddd;"><div id="geolocation-map" style="width:100%;height:350px;"></div></div>			
			</div>
		</fieldset>
		
		
		<div class="col-lg-12 well">
			<legend><?php _e(' Job Description', APP_TD); ?> <span title="required">*</span></legend>
			<p><?php _e('Give details about job description. such as scope of working, duties & responsibilities', APP_TD); ?>
			<?php if (get_option('jr_html_allowed')=='no') : ?><?php _e(' HTML is not allowed.', APP_TD); ?><?php endif; ?></p>
			<div class="col-sm-12 form-group">
				<div class="wp_editor_wrapper <?php echo ( isset( $_POST['post_content'] ) && empty( $_POST['post_content'] ) ? 'wp_editor_empty' : '' ); ?>">
					<?php if ( 'yes1' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
						<?php wp_editor( $job->post_content, 'post_content', jr_get_editor_settings( array( 'editor_class' => '' ) ) ); ?>
					<?php } else { ?>
						<textarea class="form-control required" id="post_content" name="post_content" cols="30" rows="5"><?php echo esc_textarea( $job->post_content ); ?></textarea>
					<?php } ?>
				</div>
			</div>
		</div>
		
		<div class="col-lg-12 well">
		
			<legend><?php _e(' Job Requirements', APP_TD); ?> <span title="required">*</span></legend>				
			<div class="col-sm-12 form-group">
				<label for="level"><?php _e('Level', APP_TD); ?> <span title="required">*</span></label> 
				<select name="level" id="level" class="form-control required">
							<option value="">  Select... </option>
					<?php
					$job_types = get_terms( 'level', array( 'hide_empty' => false, 'orderby' => 'description','order'=> 'ASC') );
					if ($job_types && sizeof($job_types) > 0) {
						foreach ($job_types as $type) {
							?>
							<option <?php if ( $job->level==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
			
			
			<div class="col-sm-12 form-group">
				<label for="hire"><?php _e('Number of Expr (Year)', APP_TD); ?> </label> 
				<select name="experience" id="experience" class="form-control ">
					<?php
					$job_types = get_terms( 'experience', array( 'hide_empty' => false ) );
					if ($job_types && sizeof($job_types) > 0) {
						foreach ($job_types as $type) {
							?>
							<option <?php if ( $job->experience==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>	
			
			<div class="col-sm-12 form-group">
				<label for="hire"><?php _e('Qualification', APP_TD); ?> <span title="required">*</span></label> 
				<select name="qualification" id="qualification" class="form-control required">
										<option value=""> Select... </option>
					<?php
					$job_types = get_terms( 'qualification', array( 'hide_empty' => false, 'orderby' => 'description','order'=> 'ASC' ) );
					if ($job_types && sizeof($job_types) > 0) {
						foreach ($job_types as $type) {
							?>
							<option <?php if ( $job->qualification==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
			
			<div class="col-sm-12 form-group">
				<label for="hire"><?php _e('Field of Study', APP_TD); ?> </label> 
				<input type="text" class="form-control text " name="field" id="field" value="<?php echo esc_attr( $job->field ); ?>" />
			</div>
			
			<div class="col-sm-12 form-group">
				<label for="hire"><?php _e('Language', APP_TD); ?> </label> 
				<input type="text" class="form-control text " name="language" id="language" value="<?php echo esc_attr( $job->language ); ?>" />
			</div>
			
			<div class="col-sm-12 form-group">
				<label for="hire"><?php _e('Sex', APP_TD); ?> <span title="required">*</span></label> 
				<select name="sex" id="sex" class="form-control ">
					<option value=""> Select... </option>
					<?php
					$job_types = get_terms( 'sex', array( 'hide_empty' => false, 'orderby' => 'description','order'=> 'ASC' ) );
					if ($job_types && sizeof($job_types) > 0) {
						foreach ($job_types as $type) {
							?>
							<option <?php if ( $job->sex==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
			
			<div class="col-sm-12 form-group">
				<label for="hire"><?php _e('Age', APP_TD); ?> <span title="required">*</span></label> 
				<select name="age" id="age" class="form-control required">
					<option value=""> Select... </option>
					<?php
					$job_types = get_terms( 'age', array( 'hide_empty' => false, 'orderby' => 'description','order'=> 'ASC' ) );
					if ($job_types && sizeof($job_types) > 0) {
						foreach ($job_types as $type) {
							?>
							<option <?php if ( $job->age==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
			
			<div class="col-sm-12 form-group">
				<label for="hire"><?php _e('Marital', APP_TD); ?> <span title="required">*</span></label> 
				<select name="marital" id="marital" class="form-control required">
										<option value=""> Select... </option>
					<?php
					$job_types = get_terms( 'marital', array( 'hide_empty' => false, 'orderby' => 'description','order'=> 'ASC' ) );
					if ($job_types && sizeof($job_types) > 0) {
						foreach ($job_types as $type) { ?>
							<option <?php if ( $job->marital==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
			
		</div>
		
		<div class="col-lg-12 well">
			<legend><?php _e(' Job Requirement', APP_TD); ?> <span title="required">*</span></legend>
			<p>Give details about the job requirement. such as qualification & requirement, working days and hours, working place, relationship, salary and benefit. <p>			
			<div class="col-sm-12 form-group">
				<div class="wp_editor_wrapper <?php echo ( isset( $_POST['post_require'] ) && empty( $_POST['post_require'] ) ? 'wp_editor_empty' : '' ); ?>">
					<?php if ( 'yes1' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
						<?php wp_editor( $job->post_require, 'post_require', jr_get_editor_settings( array( 'editor_class' => 'required' ) ) ); ?>
					<?php } else { ?>
						<textarea class="form-control required" id="post_require" name="post_require" cols="30" rows="5"><?php echo esc_textarea( $job->post_require ); ?></textarea>
					<?php } ?>
				</div>
			</div>
		</div>


		<?php if (get_option('jr_submit_how_to_apply_display')=='yes') : ?>
			<div class="col-lg-12 well">
				<legend><?php _e('How to apply', APP_TD); ?></legend>
				<p><?php _e('Tell applicants how to apply &ndash; they will also be able to email you via the &ldquo;apply&rdquo; form on your job listing\'s page.', APP_TD); ?><?php if (get_option('jr_html_allowed')=='no') : ?><?php _e(' HTML is not allowed.', APP_TD); ?><?php endif; ?></p>
				<div class="col-sm-12 form-group">
					<div class="wp_editor_wrapper">
						<?php if ( 'yes1' == get_option('jr_html_allowed') && ! wp_is_mobile() ) { ?>
							<?php wp_editor( $job->apply, 'apply', jr_get_editor_settings( array( 'editor_class' => 'how' ) ) ); ?>
						<?php } else { ?>
							<textarea class="form-control how" id="apply" name="apply" cols="30" rows="5" ><?php echo esc_textarea( $job->apply ); ?></textarea>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php do_action( 'jr_after_submit_job_form', $job ); ?>

		<input type="hidden" name="action" value="<?php echo esc_attr($post_action); ?>" />
		<input type="hidden" name="step" value="<?php echo esc_attr($step); ?>"/>
		<input type="hidden" name="ID" value="<?php echo esc_attr($job->ID); ?>">
		<input type="hidden" name="order_id" value="<?php echo esc_attr($order_id); ?>">

		<input type="hidden" name="preview_job" />
		 <?php if ( get_query_var('job_relist') ): ?>
			<input type="hidden" name="relist" value="1"/>
		<?php endif; ?>

		<div class="col-lg-12 form-group">
			<input type="submit" class="btn btn-danger submit" name="job_submit" value="<?php echo esc_attr( $submit_text ); ?>" />
		</div>

		<div class="clear"></div>
			
	</form>
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<script type="text/javascript">
		/* <![CDATA[ */

		jQuery.noConflict();
		(function($) {
			
			$( ".datepicker" ).datepicker();
			
			<?php get_template_part('includes/countries'); ?>
			var availableCountries = [
				<?php
					global $countries;
					$countries_array = array();
					if ($countries) foreach ($countries as $code=>$country) {
						$countries_array[] = '"'.$country.'"';
					}
					echo implode(',', $countries_array);
				?>
			];
			var availableStates = [
				<?php
					global $states;
					echo implode(',', $states);
				?>
			];
			$("input#job_country").autocomplete({
				source: availableCountries,
				minLength: 2
			});
			$("input#job_city").autocomplete({
				source: availableStates,
				minLength: 1,
				search: function(){
					var c_val = $("input#job_country").val();
					if (c_val=='United States' || c_val.val()=='USA' || c_val=='US') return true; else return false;
				}
			});

			$("#submit_form").submit(function() {
				$('input#job_city, input#job_country').removeAttr('autocomplete');
			});
			
		})(jQuery);		
		/* ]]> */
	</script>

<?php
	if ( 'yes' == get_option('jr_html_allowed') && ! wp_is_mobile() )
		jr_tinymce();
?>