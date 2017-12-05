	<div id="container">
<section id="featured-slider">
	<div id="slides">
		<div class="slides_container">
			
			<?php 
				$loop = new WP_Query(array('post_type' => 'feature', 'posts_per_page' => -1, 'orderby'=> 'ASC')); 
			?>
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

				<div class="slide">
					<?php $url = get_post_meta($post->ID, "url", true);
					if($url!='') { 
						echo '<a href="'.$url.'">';
						echo the_post_thumbnail('full');
						echo '</a>';
					} else {
						echo the_post_thumbnail('full');
					} ?>
					
					<?php the_content();?>
					<div class="caption2">
					<?php the_excerpt();?>
						<?php the_title(); ?>
						
					</div>
				</div>

			<?php endwhile; ?>
			
			<?php wp_reset_query(); ?>

		</div>
		<a href="#" class="prev">prev</a>
		<a href="#" class="next">next</a>
	</div>
</section>

</div>





	
<?php $currentCat = get_query_var('cat'); ?>
<?php
$args=array(
    'orderby' => 'date',
    'order' => 'ASC',
    'posts_per_page' => 1,
    'caller_get_posts'=>1,

);
$oldestpost =  get_posts($args);

$args=array(
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 1,
    'caller_get_posts'=>1,

);
$newestpost =  get_posts($args);

if ( !empty($oldestpost) && !empty($newestpost) ) {
  $oldest = mysql2date("Y", $oldestpost[0]->post_date);
  $newest = mysql2date("Y", $newestpost[0]->post_date);

  for ( $counter = intval($newest); $counter >= intval($oldest); $counter = $counter - 1)  {

    $args=array(
      'year'     => $counter,
      'posts_per_page' => -1,
      'orderby' => 'title',
      'order' => 'ASC',
      'caller_get_posts'=>1,
	  'category__in' => array($currentCat)

);

    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
      echo '<h2 class="jahr">' . $counter . '</h2>';
      while ($my_query->have_posts()) : $my_query->the_post(); ?>
	    <h2 class="author"><?php the_title(); ?></h2>
 				<div class="entry">
					<?php the_content() ?>
				</div>
      <?php
        //the_content('Read the rest of this entry &raquo;');
      endwhile;
    } //if ($my_query)
  wp_reset_query();  // Restore global post data stomped by the_post().
  }
}
?>