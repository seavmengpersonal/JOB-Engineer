<?php
/**
 * Main loop for displaying resumes
 *
 * @package JobRoller
 * @author AppThemes
 *
 */

global $app_abbr;
?>

<?php appthemes_before_loop( 'resume' ); ?>

<?php if (have_posts()) : $alt = 1; ?>
<div class='section_content'>
	<div class='col-md-9 col-lg-9'>
	<table style="white-space:nowrap; " class="table table-hover table-bordered">
		<thead>
			<tr>
				<th style="width:10%">No</th>
				<th style="width:23%">Job Title</th>
				<th style="width:23%">Resume Category</th>
				<th style="width:23%">Location</th>
				<th style="width:23%">Date Posted</th> 
			</tr> 
		</thead>
		<tbody>
		<?php $no=0;?>
		<?php while (have_posts()) : the_post(); ?> 
		<?php  if($post->post_status=="publish"){ ?> 
		<?php $no++;?>
		
		<tr>
			<th style="width:10%">
				<?php echo $no;?>
			</th>
			<td style="width:23%">
				<div id="titlo-featured"> 
						<strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong>
				</div>  
			</td>
			<td style="width:23%">
				<dd class="title"> 
					<?php	$terms = wp_get_post_terms($post->ID, 'resume_category');
					if ($terms) :
					echo '<a href="'.get_term_link($terms[0]->slug, 'resume_category').'">' . $terms[0]->name .'</a>';
					endif; ?> 
				</dd>  
				<dd class="title">
					<?php echo __('Resume posted by ',APP_TD) . wptexturize(get_the_author_meta('display_name')); ?>
				</dd>
			</td>
			<td style="width:23%"> 
				<div  id="location"> 
						<?php if(get_post_meta($post->ID, 'r_location', true)){ echo get_post_meta($post->ID, 'r_location', true); } else { echo "N/A"; } ?>
					<!---<?php if ($address = get_post_meta($post->ID, 'geo_short_address', true)) echo wptexturize($address); else _e('Anywhere',APP_TD); ?> 
						<?php echo wptexturize(get_post_meta($post->ID, 'geo_short_address_country', true)); ?>-->
				</div>  
			</td>
			<td style="width:23%"> 
				<div id="date2"><span class="year"> <?php echo date_i18n(__('d/M/Y',APP_TD), strtotime($post->post_date)); ?></span></div>
			</td> 
		</tr>  
		</tbody>
		<?php } ?>		
		<?php appthemes_after_post( 'resume' ); ?> 
		<?php endwhile; ?> 
		<?php appthemes_after_endwhile( 'resume' ); ?> 
	</table>
	
	
<?php 
if (function_exists("wp_bs_pagination"))
    {
         //wp_bs_pagination($the_query->max_num_pages);
         wp_bs_pagination();
}
?> 
	
	
	
		<?php ///jr_paging(); ?> <!-- display pagination -->
 		<?php else: ?> 
			<?php appthemes_loop_else( 'resume' ); ?>     
		<?php endif; ?> 
		<?php appthemes_after_loop( 'resume' ); ?>
	</div>
	<div class='col-md-3 col-lg-3' style='margin-top:-50px;padding:0px; !important'>
		 <?php if (get_option('jr_show_sidebar')!=='no'){ get_sidebar('resume');} ?> 
	</div>
</div>	 
 