<?php
/*
Template Name: After Login
*/

$user = wp_get_current_user();
    $post_type="";
    if(in_array( 'job_seeker', $user->roles ) ){
       $post_type ="resume";
    }
    else{
       $post_type ="job_listing";
    }

    $args = array(
	      'ignore_sticky_posts'=> 1,
	      'posts_per_page' => -1,
	      'author' => $user->ID,
	      'post_type' => $post_type
	     );
      
      $my_query = new WP_Query($args);


      if($my_query->post_count > 0)
      {
           wp_redirect(home_url('my-dashboard'));
               
      }
      else
      {
           wp_redirect(home_url('my-profile'));
      }
