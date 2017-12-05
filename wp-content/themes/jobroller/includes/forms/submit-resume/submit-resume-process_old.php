<?php
/**
 * JobRoller Submit Resume Process
 * Processes a job submission.
 *
 *
 * @version 1.4
 * @author AppThemes
 * @package JobRoller
 * @copyright 2010 all rights reserved
 *
 */

function jr_process_submit_resume_form( $resume_id = 0 ) {

	global $post, $posted;

	$errors = new WP_Error();
       
	if (isset($_POST['save_resume']) && $_POST['save_resume']) :

		// Get (and clean) data
		$fields = array(
			'resume_name',
			'summary',
			'skills',
			'specialities',
			'groups',
			'languages',
			'desired_salary',
			'desired_position',
			'resume_cat',
			'mobile',
			'tel',
			'email_address',
			'education',
			'experience',
			'jr_geo_latitude',
			'jr_geo_longitude',
			'jr_address',
			'r_firstname',
			'r_lastname',
			'r_sex',
                        'd_day',
                        'd_month',
			'd_year',
			'r_marital',
			'email_address',
                        'mobile',
                        'r_nationality',
                        'r_location',
'r_address',
'r_highest_qualification',
'r_level',
'r_industry',
'r_position',
'r_salary',
'r_p_industry',
'r_pre_loc',
'job_salary',
'job_type',

'r_qualification',
's_day',
's_month',
's_year',
'e_day',
'e_month',
'e_year',
'r_university',
'r_field',
'r_e_description',

'r_qualification1',
's_day1',
's_month1',
's_year1',
'e_day1',
'e_month1',
'e_year1',
'r_university1',
'r_field1',
'r_e_description1',

'r_h_language',
'l_r_level',
'r_h_language1',
'l_r_level1',

'r_company_name',
'w_s_day',
'w_s_month',
'w_s_year',
'w_e_day',
'w_e_month',
'w_e_year',
'w_r_position',
'w_e_description',

'r_company_name1',
'w_s_day1',
'w_s_month1',
'w_s_year1',
'w_e_day1',
'w_e_month1',
'w_e_year1',
'w_r_position1',
'w_e_description1',

'r_training',
'r_hobby',
'r_reference'
		);

		$posted = stripslashes_deep( wp_array_slice_assoc( $_POST, $fields ) );

		$sanitizer = ( get_option('jr_html_allowed')=='no' ) ? 'strip_tags' : 'wp_kses_post';

		foreach ( $posted as $key => &$value ) {
			if ( in_array( $key, array( 'summary', 'education', 'experience' ) ) ) {
				$value = $sanitizer( $value );
			} else {
				$value = strip_tags( $value );
			}
		}

		// Check required fields
		$required = array(			
			'r_firstname' => __('Firstname', APP_TD),
			'r_lastname' => __('Lastname', APP_TD),	
                        'email_address' => __('Email', APP_TD),
                        'mobile' => __('Mobile', APP_TD),
		);

		foreach ( $required as $field => $name ) {
			if ( empty( $posted[ $field ] ) ) {
				$errors->add('submit_error_' . $field, __( '<strong>ERROR</strong>: &ldquo;', APP_TD ).$name.__( '&rdquo; is a required field.', APP_TD ) );
			}
		}

		if ( ! empty($posted['desired_salary']) && ! intval($posted['desired_salary']) ) {
			$errors->add( 'submit_error_salary', __( 'Salary must be numeric.', APP_TD ) );
		}

		if ( $errors && sizeof( $errors ) > 0 && $errors->get_error_code() ) {} else {

			// TODO: use uploads.php function library for resumes uploading

			if ( isset( $_FILES['your-photo'] ) && ! empty( $_FILES['your-photo']['name'] )) {

				$posted['your-photo-name'] = $_FILES['your-photo']['name'];                                

				// Check valid extension
				$allowed = array(
					'png',
					'gif',
					'jpg',
					'jpeg'
				);

				$extension = strtolower(pathinfo($_FILES['your-photo']['name'], PATHINFO_EXTENSION));

				if ( ! in_array( $extension, $allowed ) ) {
					$errors->add('submit_error', __('<strong>ERROR</strong>: Only jpg, gif, and png images are allowed.', APP_TD));
				} else {

					/** WordPress Administration File API */
					include_once(ABSPATH . 'wp-admin/includes/file.php');
					/** WordPress Media Administration API */
					include_once(ABSPATH . 'wp-admin/includes/media.php');

					function resume_photo_upload_dir( $pathdata ) {
						$subdir = '/resume_photos'.$pathdata['subdir'];
					 	$pathdata['path'] = str_replace($pathdata['subdir'], $subdir, $pathdata['path']);
					 	$pathdata['url'] = str_replace($pathdata['subdir'], $subdir, $pathdata['url']);
						$pathdata['subdir'] = str_replace($pathdata['subdir'], $subdir, $pathdata['subdir']);
						return $pathdata;
					}

					add_filter('upload_dir', 'resume_photo_upload_dir');
					$time = current_time('mysql');
					$overrides = array('test_form'=>false);

					$file = wp_handle_upload($_FILES['your-photo'], $overrides, $time);

					$file_size = jr_get_file_size( 'resumes' );

					if ( $_FILES['your-photo']['size'] > ( $file_size['size'] * $file_size['unit_size'] ) ) {
						$errors->add( 'upload_size_warning', sprintf( __( 'File exceeds %d%s size limit.', APP_TD ), ($file_size['size'] * $file_size['unit_size']) / $file_size['unit_size'], $file_size['unit'] ) );
					} else {

						remove_filter('upload_dir', 'resume_photo_upload_dir');

						if ( !isset($file['error']) ) {
							$posted['your-photo'] = $file['url'];
							$posted['your-photo-type'] = $file['type'];
							$posted['your-photo-file'] = $file['file'];
						}
						else {
							$errors->add('submit_error', __('<strong>ERROR</strong>: ', APP_TD).$file['error'].'');
						}
					}

				}
			}
                      

                      /*===============upload=============*/
			if ( isset( $_FILES['your-file'] ) && ! empty( $_FILES['your-file']['name'] )) {
				$posted['your-file-name'] = $_FILES['your-file']['name'];                                
				$allowed_file = array(
					'zip',
					'pdf',
					'doc',
				);
				$extension_file = strtolower(pathinfo($_FILES['your-file']['name'], PATHINFO_EXTENSION));

				if ( ! in_array( $extension_file, $allowed_file ) ) {
					$errors->add('submit_error', __('<strong>ERROR</strong>: Only pdf, doc, zip are allowed.', APP_TD));
				} else {

					/** WordPress Administration File API */
					include_once(ABSPATH . 'wp-admin/includes/file.php');
					/** WordPress Media Administration API */
					include_once(ABSPATH . 'wp-admin/includes/media.php');

					function resume_photo_upload_dir_file( $pathdata ) {
						$subdir = '/uploaded_cvs'.$pathdata['subdir'];
					 	$pathdata['path'] = str_replace($pathdata['subdir'], $subdir, $pathdata['path']);
					 	$pathdata['url'] = str_replace($pathdata['subdir'], $subdir, $pathdata['url']);
						$pathdata['subdir'] = str_replace($pathdata['subdir'], $subdir, $pathdata['subdir']);
						return $pathdata;
					}
					add_filter('upload_dir', 'resume_photo_upload_dir_file');
					$time_file = current_time('mysql');
					$overrides_file = array('test_form'=>false);
					$file_upload = wp_handle_upload($_FILES['your-file'], $overrides_file, $time_file);					
					remove_filter('upload_dir', 'resume_photo_upload_dir_file');
					if ( !isset($file['error']) ) {
						$posted['your-file'] = $file_upload['url'];
						$posted['your-file-type'] = $file_upload['type'];
						$posted['your-file-file'] = $file_upload['file'];
					}
					else {
						$errors->add('submit_error', __('<strong>ERROR</strong>: ', APP_TD).$file['error'].'');
					}			
				}
			}		
       /*====================end================*/
		}

		if ( $errors && sizeof( $errors ) > 0 && $errors->get_error_code() ) {} else {

			// No errors? Create the resume post
			global $wpdb;

			if ( $resume_id > 0 ) :

				$data = array(
					'ID' => $resume_id,
					'post_content' => $posted['summary'],
					'post_title' => wp_strip_all_tags( $posted['resume_name'] )
				);

				wp_update_post( $data );

			else :

				$data = array(
					'post_content' => $posted['summary'],
					'post_title' => wp_strip_all_tags( $posted['resume_name'] ),
					'post_status' => 'private',
					'post_author' => get_current_user_id(),
					'post_type' => 'resume',
					'post_name' => get_current_user_id().uniqid(rand(10,1000), false),
				);

				$resume_id = wp_insert_post($data);

				if ($resume_id==0 || is_wp_error($resume_id)) wp_die( __('Error: Unable to create entry.', APP_TD) );

			endif;

			### Add meta data

				update_post_meta($resume_id, '_skills', $posted['skills']);
				update_post_meta($resume_id, '_desired_salary', preg_replace( '/[^0-9]/', '', $posted['desired_salary'] ));

				update_post_meta($resume_id, '_mobile', $posted['mobile']);
				update_post_meta($resume_id, '_tel', $posted['tel']);
				update_post_meta($resume_id, '_email_address', $posted['email_address']);

				update_post_meta($resume_id, '_education', $posted['education']);
				update_post_meta($resume_id, '_experience', $posted['experience']);
				
				## Add more function 
				update_post_meta($resume_id, 'r_firstname', $_POST['r_firstname']);
				update_post_meta($resume_id, 'r_lastname', $_POST['r_lastname']);
				update_post_meta($resume_id, 'r_dob', $_POST['r_dob']);
				update_post_meta($resume_id, 'r_sex', $_POST['r_sex']);
                                update_post_meta($resume_id, 'd_day', $_POST['d_day']);
                                update_post_meta($resume_id, 'd_month', $_POST['d_month']);
                                update_post_meta($resume_id, 'd_year', $_POST['d_year']);
				update_post_meta($resume_id, 'r_marital', $_POST['r_marital']);
                                update_post_meta($resume_id, 'email_address', $_POST['email_address']);
                                update_post_meta($resume_id, 'mobile', $_POST['mobile']);
				update_post_meta($resume_id, 'r_nationality', $_POST['r_nationality']);
				update_post_meta($resume_id, 'r_location', $_POST['r_location']);
				update_post_meta($resume_id, 'r_address', $_POST['r_address']);

				update_post_meta($resume_id, 'r_highest_qualification', $_POST['r_highest_qualification']);
				update_post_meta($resume_id, 'r_level', $_POST['r_level']);
				update_post_meta($resume_id, 'r_industry', $_POST['r_industry']);
				update_post_meta($resume_id, 'r_position', $_POST['r_position']);
				update_post_meta($resume_id, 'r_salary', $_POST['r_salary']);
				update_post_meta($resume_id, 'r_p_industry', $_POST['r_p_industry']);
				update_post_meta($resume_id, 'r_pre_loc', $_POST['r_pre_loc']);
                                update_post_meta($resume_id, 'job_salary', $_POST['job_salary']);
                                update_post_meta($resume_id, 'job_type', $_POST['job_type']);

update_post_meta($resume_id, 'r_qualification', $_POST['r_qualification']);
update_post_meta($resume_id, 's_day', $_POST['s_day']);
update_post_meta($resume_id, 's_month', $_POST['s_month']);
update_post_meta($resume_id, 's_year', $_POST['s_year']);
update_post_meta($resume_id, 'e_day', $_POST['e_day']);
update_post_meta($resume_id, 'e_month', $_POST['e_month']);
update_post_meta($resume_id, 'e_year', $_POST['e_year']);
update_post_meta($resume_id, 'r_university', $_POST['r_university']);
update_post_meta($resume_id, 'r_field', $_POST['r_field']);
update_post_meta($resume_id, 'r_e_description', $_POST['r_e_description']);

update_post_meta($resume_id, 'r_qualification1', $_POST['r_qualification1']);
update_post_meta($resume_id, 's_day1', $_POST['s_day1']);
update_post_meta($resume_id, 's_month1', $_POST['s_month1']);
update_post_meta($resume_id, 's_year1', $_POST['s_year1']);
update_post_meta($resume_id, 'e_day1', $_POST['e_day1']);
update_post_meta($resume_id, 'e_month1', $_POST['e_month1']);
update_post_meta($resume_id, 'e_year1', $_POST['e_year1']);
update_post_meta($resume_id, 'r_university1', $_POST['r_university1']);
update_post_meta($resume_id, 'r_field1', $_POST['r_field1']);
update_post_meta($resume_id, 'r_e_description1', $_POST['r_e_description1']);

update_post_meta($resume_id, 'r_h_language', $_POST['r_h_language']);
update_post_meta($resume_id, 'l_r_level', $_POST['l_r_level']);

update_post_meta($resume_id, 'r_h_language1', $_POST['r_h_language1']);
update_post_meta($resume_id, 'l_r_level1', $_POST['l_r_level1']);

update_post_meta($resume_id, 'r_company_name', $_POST['r_company_name']);
update_post_meta($resume_id, 'w_s_day', $_POST['w_s_day']);
update_post_meta($resume_id, 'w_s_month', $_POST['w_s_month']);
update_post_meta($resume_id, 'w_s_year', $_POST['w_s_year']);
update_post_meta($resume_id, 'w_e_day', $_POST['w_e_day']);
update_post_meta($resume_id, 'w_e_month', $_POST['w_e_month']);
update_post_meta($resume_id, 'w_e_year', $_POST['w_e_year']);
update_post_meta($resume_id, 'w_r_position', $_POST['w_r_position']);
update_post_meta($resume_id, 'w_e_description', $_POST['w_e_description']);

update_post_meta($resume_id, 'r_company_name1', $_POST['r_company_name1']);
update_post_meta($resume_id, 'w_s_day1', $_POST['w_s_day1']);
update_post_meta($resume_id, 'w_s_month1', $_POST['w_s_month1']);
update_post_meta($resume_id, 'w_s_year1', $_POST['w_s_year1']);
update_post_meta($resume_id, 'w_e_day1', $_POST['w_e_day1']);
update_post_meta($resume_id, 'w_e_month1', $_POST['w_e_month1']);
update_post_meta($resume_id, 'w_e_year1', $_POST['w_e_year1']);
update_post_meta($resume_id, 'w_r_position1', $_POST['w_r_position1']);
update_post_meta($resume_id, 'w_e_description1', $_POST['w_e_description1']);

update_post_meta($resume_id, 'r_training', $_POST['r_training']);
update_post_meta($resume_id, 'r_hobby', $_POST['r_hobby']);
update_post_meta($resume_id, 'r_reference', $_POST['r_reference']);

			## Desired position

			$post_into_types[] = get_term_by( 'slug', sanitize_title($posted['desired_position']), 'resume_job_type')->slug;

			if (sizeof($post_into_types)>0) wp_set_object_terms($resume_id, $post_into_types, 'resume_job_type');

				### Category

				$post_into_cats = array();

				if ( $posted['resume_cat'] > 0 ) {
					$post_into_cats[] = get_term_by( 'id', $posted['resume_cat'], 'resume_category')->slug;
				}

				if ( sizeof( $post_into_cats ) > 0 ) {
					wp_set_object_terms($resume_id, $post_into_cats, 'resume_category');
				}

				### Tags

				if ($posted['specialities']) :

					$thetags = explode(',', $posted['specialities']);
					$thetags = array_map('trim', $thetags);

					if (sizeof($thetags)>0) wp_set_object_terms($resume_id, $thetags, 'resume_specialities');

				endif;

				if ($posted['groups']) :

					$thetags = explode(',', $posted['groups']);
					$thetags = array_map('trim', $thetags);

					if (sizeof($thetags)>0) wp_set_object_terms($resume_id, $thetags, 'resume_groups');

				endif;

				if ($posted['languages']) :

					$thetags = explode(',', $posted['languages']);
					$thetags = array_map('trim', $thetags);

					if (sizeof($thetags)>0) wp_set_object_terms($resume_id, $thetags, 'resume_languages');

				endif;

		### GEO

		if (!empty($posted['jr_address'])) :

			$latitude = jr_clean_coordinate($posted['jr_geo_latitude']);
			$longitude = jr_clean_coordinate($posted['jr_geo_longitude']);

			update_post_meta($resume_id, '_jr_geo_latitude', $posted['jr_geo_latitude']);
			update_post_meta($resume_id, '_jr_geo_longitude', $posted['jr_geo_longitude']);

			if ($latitude && $longitude) :
				$address = jr_reverse_geocode($latitude, $longitude);

				update_post_meta($resume_id, 'geo_address', $address['address']);
				update_post_meta($resume_id, 'geo_country', $address['country']);
				update_post_meta($resume_id, 'geo_short_address', $address['short_address']);
				update_post_meta($resume_id, 'geo_short_address_country', $address['short_address_country']);

			endif;

		endif;

			## Load APIs and Link to photo

				include_once(ABSPATH . 'wp-admin/includes/file.php');
				include_once(ABSPATH . 'wp-admin/includes/image.php');
				include_once(ABSPATH . 'wp-admin/includes/media.php');

				$name_parts = pathinfo($posted['your-photo-name']);
				$name = trim( substr( $name, 0, -(1 + strlen($name_parts['extension'])) ) );

				$url = $posted['your-photo'];
				$type = $posted['your-photo-type'];
				$file = $posted['your-photo-file'];
				$title = $posted['your-photo-name'];

                                $url_up = $posted['your-file'];
				$type_up = $posted['your-file-type'];
				$file_up = $posted['your-file-file'];
				$title_up = $posted['your-file-name'];

				$content = '';
                                $content_up = '';
                                if($file_up) :
                                         
                                       // use image exif/iptc data for title and caption defaults if possible
					if ( $image_meta = @wp_read_image_metadata($file_up) ) {
						if ( trim($image_meta['title']) )
							$title_up = $image_meta['title'];
						if ( trim($image_meta['caption']) )
							$content_up = $image_meta['caption'];
					}
                                       // Construct the attachment array
					$attachment1 = array_merge( array(
						'post_mime_type' => $type_up,
						'guid' => $url_up,
						'post_parent' => $resume_id,
						'post_title' => $title_up,
						'post_content' => $content_up,
					), array() );

					// Save the data
					$id = wp_insert_attachment($attachment1, $file_up, $resume_id);
					if ( !is_wp_error($id) ) {
						wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $file_up) );
					}

					update_post_meta( $resume_id, '_thumbnail_id1', $id );     
                                endif;
				if ($file) :

					// use image exif/iptc data for title and caption defaults if possible
					if ( $image_meta = @wp_read_image_metadata($file) ) {
						if ( trim($image_meta['title']) )
							$title = $image_meta['title'];
						if ( trim($image_meta['caption']) )
							$content = $image_meta['caption'];
					}

					// Construct the attachment array
					$attachment = array_merge( array(
						'post_mime_type' => $type,
						'guid' => $url,
						'post_parent' => $resume_id,
						'post_title' => $title,
						'post_content' => $content,
					), array() );

					// Save the data
					$id = wp_insert_attachment($attachment, $file, $resume_id);
					if ( !is_wp_error($id) ) {
						wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $file ) );
					}

					update_post_meta( $resume_id, '_thumbnail_id', $id );

				endif;

				// Redirect to Resume
				$url = get_permalink( $resume_id );
				if (!$url) $url = get_permalink( JR_User_Profile_Page::get_id() );
				wp_redirect($url);
    			exit();

		}

	endif;

	$submit_form_results = array(
		'errors' => $errors,
		'posted' => $posted
	);

	return $submit_form_results;
}
