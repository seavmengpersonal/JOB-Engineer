<?php if (get_option('adv_footer')=='Inner pages only') : ?>
	<div id="footer-ad"  style="float:<?php echo stripslashes(get_option('ad_footer_float'))  ?> !important; width: <?php echo stripslashes(get_option('ad_footer_size'))  ?>px !important"><?php echo stripslashes(get_option('ad_footer')); ?></div>
<?php endif; ?>

<?php if (get_option('adv_footer')=='Entire site') : ?>
	<div id="footer-ad"  style="float:<?php echo stripslashes(get_option('ad_footer_float'))  ?> !important; width: <?php echo stripslashes(get_option('ad_footer_size'))  ?>px !important"><?php echo stripslashes(get_option('ad_footer')); ?></div>
<?php endif; ?>