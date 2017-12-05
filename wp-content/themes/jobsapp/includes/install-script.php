<?php
/**
* Install script to insert default data.
* Only run if theme is being activated
* for the first time.
*
*/
global $app_theme, $app_version, $jr_log, $wp_rewrite;
global $pagenow;



	
    
    
    // first check and make sure this page doesn't already exist
    $sql = "SELECT ID FROM " . $wpdb->posts . " WHERE post_name = 'jobs' LIMIT 1";

    $pagefound = $wpdb->get_var($sql);

    if($wpdb->num_rows == 0) {

        // then create the edit item page
        $my_page = array(
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_author' => 1,
        'post_name' => 'jobs',
        'post_title' => 'All jobs'
        );

          // Insert the page into the database
        $page_id = wp_insert_post($my_page);

        // Assign the page template to the new page
        update_post_meta($page_id, '_wp_page_template', 'tpl-jobs.php');
        
        update_option('jr_jobs_page_id', $page_id);

    } else {
    	update_option('jr_jobs_page_id', $pagefound);
    	update_post_meta($pagefound, '_wp_page_template', 'tpl-jobs.php');
    }
    
?>
