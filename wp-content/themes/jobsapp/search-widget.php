<?php global $app_abbr, $header_search; $header_search = true; ?>
<?php get_header(); ?>

<?php if (get_option('jr_show_searchbar')!=='no' && ( !isset($_GET['submit']) || ( isset($_GET['submit']) && $_GET['submit']!=='true' ) ) && ( !isset($_GET['myjobs']) || ( isset($_GET['myjobs']) && $_GET['myjobs']!=='true' ) ) ) : ?>

<script type="text/javascript">
		$(function () {
			$("#radius-2").selectbox();
		});
		</script>
	<form action="<?php bloginfo('url'); ?>/" method="get" id="searchform-s">

		<div class="search-wrap-widget">
				<input type="text" id="search" title="" name="s" class="text" placeholder="<?php _e('All Jobs',APP_TD); ?>" value="<?php if (isset($_GET['s'])) echo get_search_query(); ?>" />
				<input type="text" id="near" title="<?php _e('Location',APP_TD); ?>" name="location" class="text" placeholder="<?php _e('Location',APP_TD); ?>" value="<?php if (isset($_GET['location'])) echo $_GET['location']; ?>" />
			

<div class="spacer"></div>	

<div  class="radius-2">
				
			<select name="radius" id="radius-2">
								<option value="1" <?php if (isset($_GET['radius']) && $_GET['radius'] == 1) echo 'selected="selected"'; ?>>1 <?php echo get_option($app_abbr.'_distance_unit') ?></option>
					<option value="5 km" <?php if (isset($_GET['radius']) && $_GET['radius'] == 5) echo 'selected="selected"'; ?>>5 <?php echo get_option($app_abbr.'_distance_unit') ?></option>
					<option value="10" <?php if (isset($_GET['radius']) && $_GET['radius'] == 10) echo 'selected="selected"'; ?>>10 <?php echo get_option($app_abbr.'_distance_unit') ?></option>
					<option value="50" <?php if ((isset($_GET['radius']) && $_GET['radius'] == 50 || (isset($_GET['radius']) && $_GET['radius'] == ''))) echo 'selected="selected"'; ?>>50 <?php echo get_option($app_abbr.'_distance_unit') ?></option>
					<option value="100" <?php if (isset($_GET['radius']) && $_GET['radius'] == 100) echo 'selected="selected"'; ?>>100 <?php echo get_option($app_abbr.'_distance_unit') ?></option>
					<option value="1000" <?php if (isset($_GET['radius']) && $_GET['radius'] == 1000) echo 'selected="selected"'; ?>>1,000 <?php echo get_option($app_abbr.'_distance_unit') ?></option>
					<option class="sbOptions li.last" value="5000" <?php if (isset($_GET['radius']) && $_GET['radius'] == 5000) echo 'selected="selected"'; ?>>5,000 <?php echo get_option($app_abbr.'_distance_unit') ?></option>

		</select>


		
			</div><!-- end radius -->

<label for="search"><button type="submit" title="<?php _e('',APP_TD); ?>" class="submit-2"><?php _e('Search',APP_TD); ?></button></label>

				<input type="hidden" name="latitude" id="field_latitude" value="" />
				<input type="hidden" name="longitude" id="field_longitude" value="" />
				<input type="hidden" name="full_address" id="field_full_address" value="" />
				<input type="hidden" name="north_east_lng" id="field_north_east_lng" value="" />
				<input type="hidden" name="south_west_lng" id="field_south_west_lng" value="" />
				<input type="hidden" name="north_east_lat" id="field_north_east_lat" value="" />
				<input type="hidden" name="south_west_lat" id="field_south_west_lat" value="" />

	

		</div><!-- end search-wrap -->

	</form>
		<script type="text/javascript">
		$(function () {
			$("#radius-2").selectbox();
		});
		</script>

<?php endif; ?>