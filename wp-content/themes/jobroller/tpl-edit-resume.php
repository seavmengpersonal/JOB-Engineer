<?php
/*
 * Template Name: Edit Resume Template
 */
?>

<?php
	global $post, $job_details, $posted, $errors;

	### Prevent Caching
	nocache_headers();

	appthemes_auth_redirect_login();

	$resume_id = 0;

	if ( isset( $_GET['edit'] ) ) {
		$resume_id = (int) $_GET['edit'];
	}

	$error_msg = __( 'You don\'t have permissions to edit CV.', APP_TD );

	if ( ! current_user_can('can_submit_resume') || ( isset( $_GET['edit'] ) && ! $resume_id ) ) {
		appthemes_add_notice( 1, $error_msg );
		redirect_myjobs();
		exit();
	}

	if ( isset( $_REQUEST['edit'] ) ) {
		$editing = true;
	} else {
		$editing = false;
	}

	$message = '';

	$posted = array();
	$errors = new WP_Error();

	### Edit?

	if ( $resume_id > 0 ) :

		// Get job details
		$resume_details = get_post($resume_id);

		if ( ! isset( $_POST['save_resume'] ) ):
			// Set post data
			$posted['resume_name'] = $resume_details->post_title;
			$posted['summary'] = $resume_details->post_content;
			$posted['skills'] = get_post_meta($resume_id, '_skills', true);
			$posted['desired_salary'] = get_post_meta($resume_id, '_desired_salary', true);
			$posted['desired_position'] = get_post_meta($resume_id, '_desired_position', true);

			$posted['mobile'] = get_post_meta($resume_id, '_mobile', true);
			$posted['tel'] = get_post_meta($resume_id, '_tel', true);
			$posted['email_address'] = get_post_meta($resume_id, '_email_address', true);

			$posted['education'] = get_post_meta($resume_id, '_education', true);
			$posted['experience'] = get_post_meta($resume_id, '_experience', true);
			
			## set add more
			
$posted['r_firstname']= get_post_meta($resume_id, 'r_firstname', true);
$posted['r_lastname']= get_post_meta($resume_id, 'r_lastname', true);

$posted['r_sex']= get_post_meta($resume_id, 'r_sex', true);
$posted['d_day']= get_post_meta($resume_id, 'd_day', true);
$posted['d_month']= get_post_meta($resume_id, 'd_month', true);
$posted['d_year']= get_post_meta($resume_id, 'd_year', true);

$posted['r_marital']= get_post_meta($resume_id, 'r_marital', true);
$posted['email_address']= get_post_meta($resume_id, 'email_address', true);
$posted['mobile']= get_post_meta($resume_id, 'mobile', true);
$posted['r_nationality']= get_post_meta($resume_id, 'r_nationality', true);
$posted['r_location']= get_post_meta($resume_id, 'r_location', true);
$posted['r_address']= get_post_meta($resume_id, 'r_address', true);


$posted['r_highest_qualification']= get_post_meta($resume_id, 'r_highest_qualification', true);
$posted['r_level']= get_post_meta($resume_id, 'r_level', true);
$posted['r_industry']= get_post_meta($resume_id, 'r_industry', true);
$posted['r_position']= get_post_meta($resume_id, 'r_position', true);
$posted['r_salary']= get_post_meta($resume_id, 'r_salary', true);
$posted['r_p_industry']= get_post_meta($resume_id, 'r_p_industry', true);
$posted['r_pre_loc']= get_post_meta($resume_id, 'r_pre_loc', true);
$posted['job_salary']= get_post_meta($resume_id, 'job_salary', true);
$posted['job_type']= get_post_meta($resume_id, 'job_type', true);

$posted['r_qualification']= get_post_meta($resume_id, 'r_qualification', true);
$posted['s_day']= get_post_meta($resume_id, 's_day', true);
$posted['s_month']= get_post_meta($resume_id, 's_month', true);
$posted['s_year']= get_post_meta($resume_id, 's_year', true);
$posted['e_day']= get_post_meta($resume_id, 'e_day', true);
$posted['e_month']= get_post_meta($resume_id, 'e_month', true);
$posted['e_year']= get_post_meta($resume_id, 'e_year', true);
$posted['r_university']= get_post_meta($resume_id, 'r_university', true);
$posted['r_field']= get_post_meta($resume_id, 'r_field', true);
$posted['r_e_description']= get_post_meta($resume_id, 'r_e_description', true);

$posted['r_qualification1']= get_post_meta($resume_id, 'r_qualification1', true);
$posted['s_day1']= get_post_meta($resume_id, 's_day1', true);
$posted['s_month1']= get_post_meta($resume_id, 's_month1', true);
$posted['s_year1']= get_post_meta($resume_id, 's_year1', true);
$posted['e_day1']= get_post_meta($resume_id, 'e_day1', true);
$posted['e_month1']= get_post_meta($resume_id, 'e_month1', true);
$posted['e_year1']= get_post_meta($resume_id, 'e_year1', true);
$posted['r_university1']= get_post_meta($resume_id, 'r_university1', true);
$posted['r_field1']= get_post_meta($resume_id, 'r_field1', true);
$posted['r_e_description1']= get_post_meta($resume_id, 'r_e_description1', true);

$posted['r_qualification2']= get_post_meta($resume_id, 'r_qualification2', true);
$posted['s_day2']= get_post_meta($resume_id, 's_day2', true);
$posted['s_month2']= get_post_meta($resume_id, 's_month2', true);
$posted['s_year2']= get_post_meta($resume_id, 's_year2', true);
$posted['e_day2']= get_post_meta($resume_id, 'e_day2', true);
$posted['e_month2']= get_post_meta($resume_id, 'e_month2', true);
$posted['e_year2']= get_post_meta($resume_id, 'e_year2', true);
$posted['r_university2']= get_post_meta($resume_id, 'r_university2', true);
$posted['r_field2']= get_post_meta($resume_id, 'r_field2', true);
$posted['r_e_description2']= get_post_meta($resume_id, 'r_e_description2', true);

$posted['r_qualification3']= get_post_meta($resume_id, 'r_qualification3', true);
$posted['s_day3']= get_post_meta($resume_id, 's_day3', true);
$posted['s_month3']= get_post_meta($resume_id, 's_month3', true);
$posted['s_year3']= get_post_meta($resume_id, 's_year3', true);
$posted['e_day3']= get_post_meta($resume_id, 'e_day3', true);
$posted['e_month3']= get_post_meta($resume_id, 'e_month3', true);
$posted['e_year3']= get_post_meta($resume_id, 'e_year3', true);
$posted['r_university3']= get_post_meta($resume_id, 'r_university3', true);
$posted['r_field3']= get_post_meta($resume_id, 'r_field3', true);
$posted['r_e_description3']= get_post_meta($resume_id, 'r_e_description3', true);

$posted['r_qualification4']= get_post_meta($resume_id, 'r_qualification4', true);
$posted['s_day4']= get_post_meta($resume_id, 's_day4', true);
$posted['s_month4']= get_post_meta($resume_id, 's_month4', true);
$posted['s_year4']= get_post_meta($resume_id, 's_year4', true);
$posted['e_day4']= get_post_meta($resume_id, 'e_day4', true);
$posted['e_month4']= get_post_meta($resume_id, 'e_month4', true);
$posted['e_year4']= get_post_meta($resume_id, 'e_year4', true);
$posted['r_university4']= get_post_meta($resume_id, 'r_university4', true);
$posted['r_field4']= get_post_meta($resume_id, 'r_field4', true);
$posted['r_e_description4']= get_post_meta($resume_id, 'r_e_description4', true);



$posted['r_h_language']= get_post_meta($resume_id, 'r_h_language', true);
$posted['l_r_level']= get_post_meta($resume_id, 'l_r_level', true);

$posted['r_h_language1']= get_post_meta($resume_id, 'r_h_language1', true);
$posted['l_r_level1']= get_post_meta($resume_id, 'l_r_level1', true);

$posted['r_h_language2']= get_post_meta($resume_id, 'r_h_language2', true);
$posted['l_r_level2']= get_post_meta($resume_id, 'l_r_level2', true);

$posted['r_h_language3']= get_post_meta($resume_id, 'r_h_language3', true);
$posted['l_r_level3']= get_post_meta($resume_id, 'l_r_level3', true);

$posted['r_h_language4']= get_post_meta($resume_id, 'r_h_language4', true);
$posted['l_r_level4']= get_post_meta($resume_id, 'l_r_level4', true);


$posted['r_company_name']= get_post_meta($resume_id, 'r_company_name', true);
$posted['w_s_day']= get_post_meta($resume_id, 'w_s_day', true);
$posted['w_s_month']= get_post_meta($resume_id, 'w_s_month', true);
$posted['w_s_year']= get_post_meta($resume_id, 'w_s_year', true);
$posted['w_e_day']= get_post_meta($resume_id, 'w_e_day', true);
$posted['w_e_month']= get_post_meta($resume_id, 'w_e_month', true);
$posted['w_e_year']= get_post_meta($resume_id, 'w_e_year', true);
$posted['w_r_position']= get_post_meta($resume_id, 'w_r_position', true);
$posted['w_e_description']= get_post_meta($resume_id, 'w_e_description', true);

$posted['r_company_name1']= get_post_meta($resume_id, 'r_company_name1', true);
$posted['w_s_day1']= get_post_meta($resume_id, 'w_s_day1', true);
$posted['w_s_month1']= get_post_meta($resume_id, 'w_s_month1', true);
$posted['w_s_year1']= get_post_meta($resume_id, 'w_s_year1', true);
$posted['w_e_day1']= get_post_meta($resume_id, 'w_e_day1', true);
$posted['w_e_month1']= get_post_meta($resume_id, 'w_e_month1', true);
$posted['w_e_year1']= get_post_meta($resume_id, 'w_e_year1', true);
$posted['w_r_position1']= get_post_meta($resume_id, 'w_r_position1', true);
$posted['w_e_description1']= get_post_meta($resume_id, 'w_e_description1', true);

$posted['r_company_name2']= get_post_meta($resume_id, 'r_company_name2', true);
$posted['w_s_day2']= get_post_meta($resume_id, 'w_s_day2', true);
$posted['w_s_month2']= get_post_meta($resume_id, 'w_s_month2', true);
$posted['w_s_year2']= get_post_meta($resume_id, 'w_s_year2', true);
$posted['w_e_day2']= get_post_meta($resume_id, 'w_e_day2', true);
$posted['w_e_month2']= get_post_meta($resume_id, 'w_e_month2', true);
$posted['w_e_year2']= get_post_meta($resume_id, 'w_e_year2', true);
$posted['w_r_position2']= get_post_meta($resume_id, 'w_r_position2', true);
$posted['w_e_description2']= get_post_meta($resume_id, 'w_e_description2', true);

$posted['r_company_name3']= get_post_meta($resume_id, 'r_company_name3', true);
$posted['w_s_day3']= get_post_meta($resume_id, 'w_s_day3', true);
$posted['w_s_month3']= get_post_meta($resume_id, 'w_s_month3', true);
$posted['w_s_year3']= get_post_meta($resume_id, 'w_s_year3', true);
$posted['w_e_day3']= get_post_meta($resume_id, 'w_e_day3', true);
$posted['w_e_month3']= get_post_meta($resume_id, 'w_e_month3', true);
$posted['w_e_year3']= get_post_meta($resume_id, 'w_e_year3', true);
$posted['w_r_position3']= get_post_meta($resume_id, 'w_r_position3', true);
$posted['w_e_description3']= get_post_meta($resume_id, 'w_e_description3', true);

$posted['r_company_name4']= get_post_meta($resume_id, 'r_company_name4', true);
$posted['w_s_day4']= get_post_meta($resume_id, 'w_s_day4', true);
$posted['w_s_month4']= get_post_meta($resume_id, 'w_s_month4', true);
$posted['w_s_year4']= get_post_meta($resume_id, 'w_s_year4', true);
$posted['w_e_day4']= get_post_meta($resume_id, 'w_e_day4', true);
$posted['w_e_month4']= get_post_meta($resume_id, 'w_e_month4', true);
$posted['w_e_year4']= get_post_meta($resume_id, 'w_e_year4', true);
$posted['w_r_position4']= get_post_meta($resume_id, 'w_r_position4', true);
$posted['w_e_description4']= get_post_meta($resume_id, 'w_e_description4', true);

$posted['r_training']= get_post_meta($resume_id, 'r_training', true);
$posted['r_hobby']= get_post_meta($resume_id, 'r_hobby', true);
$posted['r_reference']= get_post_meta($resume_id, 'r_reference', true);
				
			$terms = wp_get_post_terms($resume_id, 'resume_category');

			$terms_array = array();
			foreach ( $terms as $t ) {
				$terms_array[] = $t->term_id;
			}

			if ( isset( $terms_array[0] ) ) {
				$posted['resume_cat'] = $terms_array[0];
			}

			$terms = wp_get_post_terms($resume_id, 'resume_specialities');

			$terms_array = array();
			foreach ( $terms as $t ) {
				$terms_array[] = $t->name;
			}
			$posted['specialities'] = implode(', ', $terms_array);

			$terms = wp_get_post_terms($resume_id, 'resume_groups');

			$terms_array = array();
			foreach ( $terms as $t )  {
				$terms_array[] = $t->name;
			}
			$posted['groups'] = implode(', ', $terms_array);

			$terms = wp_get_post_terms($resume_id, 'resume_languages');

			$terms_array = array();
			foreach ( $terms as $t ) {
				$terms_array[] = $t->name;
			}
			$posted['languages'] = implode( ', ', $terms_array );

			$terms = wp_get_post_terms( $resume_id, 'resume_job_type' );
			if ( $terms ) {
				$terms = current( $terms );
				$posted['desired_position'] = $terms->slug;
			} else {
				$posted['desired_position'] = '';
			}

			$posted['jr_geo_latitude'] = get_post_meta($resume_id, '_jr_geo_latitude', true);
			$posted['jr_geo_longitude'] = get_post_meta($resume_id, '_jr_geo_longitude', true);
			$posted['jr_address'] = get_post_meta($resume_id, 'geo_address', true);
			
		endif;

		// Permission?
		$current_user = wp_get_current_user();

		if ( $current_user->ID == $resume_details->post_author) {
			// We have permission to edit this!
		} else {
			appthemes_add_notice( 1, $error_msg );
			redirect_myjobs();
		}

	endif;

	### Process Forms

	$result = jr_process_submit_resume_form( $resume_id );

	$errors = $result['errors'];
	$posted = $result['posted'];

?>

	<div class="section">

		<div class="section_content">

			<h1><?php ( $editing ? _e( 'Edit CV', APP_TD ) : _e( 'Add CV', APP_TD ) ); ?></h1>

			<?php do_action( 'appthemes_notices' ); ?>

			<?php jr_submit_resume_form( $resume_id ); ?>

		</div><!-- end section_content -->

	</div><!-- end section -->

	<div class="clear"></div>

</div><!-- end main content -->

<?php if ( get_option('jr_show_sidebar') !== 'no' ) { get_sidebar('resume'); } ?>
