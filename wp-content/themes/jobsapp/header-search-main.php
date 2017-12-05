<?php global $app_abbr, $header_search; $header_search = true; ?>
<?php get_header(); ?>

<?php if (get_option('jr_show_searchbar')!=='no' && ( !isset($_GET['submit']) || ( isset($_GET['submit']) && $_GET['submit']!=='true' ) ) && ( !isset($_GET['myjobs']) || ( isset($_GET['myjobs']) && $_GET['myjobs']!=='true' ) ) ) : ?>

	<form action="<?php echo esc_url( home_url() ); ?>/" method="get" id="searchform-s">

		<div class="search-wrap-no">
			
				<div class="bordered"><input type="text" id="search-no" title="" name="s" class="text" placeholder="<?php _e('All Jobs',APP_TD); ?>" value="<?php if (isset($_GET['s'])) echo get_search_query(); ?>" /></div>
				<div class="bordered">
	<select name="location" id="location" style="padding: 6px; width:280px;">
<option value=""> All Locations </option>
	<?php $r_location= get_user_meta( $user_id, 'r_location', true ); 
		$job_types = get_terms( 'job_loc', array( 'hide_empty' => false ) );
		if ($job_types && sizeof($job_types) > 0) {
		foreach ($job_types as $type) { ?>
		<option <?php if ( $r_location==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
	<?php } }  ?>
	</select>
</div>
			

<div  class="radius">
				
			<select name="radius" id="radius">
								<option value="1" <?php if (isset($_GET['radius']) && $_GET['radius'] == 1) echo 'selected="selected"'; ?>>1 <?php echo get_option($app_abbr.'_distance_unit') ?></option>
					<option value="5 km" <?php if (isset($_GET['radius']) && $_GET['radius'] == 5) echo 'selected="selected"'; ?>>5 <?php echo get_option($app_abbr.'_distance_unit') ?></option>
					<option value="10" <?php if (isset($_GET['radius']) && $_GET['radius'] == 10) echo 'selected="selected"'; ?>>10 <?php echo get_option($app_abbr.'_distance_unit') ?></option>
					<option value="50" <?php if ((isset($_GET['radius']) && $_GET['radius'] == 50 || (isset($_GET['radius']) && $_GET['radius'] == ''))) echo 'selected="selected"'; ?>>50 <?php echo get_option($app_abbr.'_distance_unit') ?></option>
					<option value="100" <?php if (isset($_GET['radius']) && $_GET['radius'] == 100) echo 'selected="selected"'; ?>>100 <?php echo get_option($app_abbr.'_distance_unit') ?></option>
					<option value="1000" <?php if (isset($_GET['radius']) && $_GET['radius'] == 1000) echo 'selected="selected"'; ?>>1,000 <?php echo get_option($app_abbr.'_distance_unit') ?></option>
					<option class="sbOptions li.last" value="5000" <?php if (isset($_GET['radius']) && $_GET['radius'] == 5000) echo 'selected="selected"'; ?>>5,000 <?php echo get_option($app_abbr.'_distance_unit') ?></option>

		</select>


		<script type="text/javascript">
		$(function () {
			$("#radius").selectbox();
		});
		</script>
			</div><!-- end radius -->

<label for="search"><button type="submit" title="<?php _e('',APP_TD); ?>" class="submit-no"><?php _e('Search',APP_TD); ?></button></label>
	<input type="hidden" name="latitude" id="field_latitude" value=" " />
	
			<input type="hidden" name="ptype" value="<?php echo esc_attr( APP_POST_TYPE ); ?>" />
			
				<input type="hidden" name="latitude" id="field_latitude" value="" />
				<input type="hidden" name="longitude" id="field_longitude" value="" />
				<input type="hidden" name="full_address" id="field_full_address" value="" />
				<input type="hidden" name="north_east_lng" id="field_north_east_lng" value="" />
				<input type="hidden" name="south_west_lng" id="field_south_west_lng" value="" />
				<input type="hidden" name="north_east_lat" id="field_north_east_lat" value="" />
				<input type="hidden" name="south_west_lat" id="field_south_west_lat" value="" />

	

		</div><!-- end search-wrap -->

	</form>
	
	<div class="counter-s">
	
	
	<?php
    // $numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE (post_type = 'resume')");
    // if (0 < $numposts) $numposts = number_format($numposts);
// ?>
	
	 <?php // echo $numposts ?>
	
	<?php
$exclude = array ($featured_job_cat);   // an array of term IDs
$terms = get_terms('job_cat',array('exclude' => $exclude));
$sum = 0;
foreach ($terms as $term) {
   $sum += $term->count;
}
// echo ''.__( 'Today:',APP_TD ) .'';
// echo "<span> $sum</span>  ";
// echo ''.__( 'Jobs',APP_TD ) .'';

// ?>
</div>
	
<?php endif; ?>





 
<script type="text/javascript">
jQuery(document).ready(function() {
$("#declencheur").click(function () {
$("#monDiv").toggle("slow");
google.maps.event.trigger(map, 'resize');

});
});
</script>
<script type="text/javascript">
function checkResize(){
        google.maps.event.trigger(map, 'resize');
       }
</script>






<a href="#"><div class="mapi" id="declencheur"></div></a>