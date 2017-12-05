<div id="line"></div>

<div id="boto">

<?php	if( !get_option( "jr_facebook_id") ) {

} else {
?>
  <div id="icon1"><a href="http://www.facebook.com/<?php echo get_option('jr_facebook_id'); ?>" target="_blank">Facebook</a></div>
  <?php
 }
?>



 
  <?php	if( !get_option( "jr_twitter_id") ) {

} else {
?>
  	<div id="icon3"><a target ="_blank"  href="http://www.twitter.com/<?php echo get_option('jr_twitter_id'); ?>">Twitter</a></div>
	 <?php
 }
?>
	
	
	
	
	 <?php	if( !get_option( "linkedin_id") ) {

} else {
?>
    <div id="icon2"><a target ="_blank" href="http://www.linkedin.com/<?php echo get_option('linkedin_id'); ?>" target="_blank">Linkedin</a></div>    
	
	 <?php
 }
?>
	
    <div id="icon4"><a target ="_blank" href="<?php if ( get_option('jr_feedburner_url') <> '' ) { echo get_option('jr_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>?post_type=job_listing">RSS</a></div>
	<div id="icon5"><a href="#">Top</a></div>

 
</div>
<div class="spacer"></div>