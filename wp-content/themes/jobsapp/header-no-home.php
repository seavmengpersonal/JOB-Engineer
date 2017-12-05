	</div>
	<div class="clear"></div>
 <div class="inner">
		
		<?php if (get_option('adv_header')=='Inner pages only') : ?>
				<div id="header-ad2"  style="float:<?php echo stripslashes(get_option('ad_header_float'))  ?> !important;width: <?php echo stripslashes(get_option('ad_header_size'))  ?>px !important ; overflow: hidden;"><?php echo stripslashes(get_option('ad_header')); ?></div>
			<?php endif; ?>
		
		
			<?php if (get_option('adv_header')=='Entire site') : ?>
				<div id="header-ad"  style="float:<?php echo stripslashes(get_option('ad_header_float'))  ?> !important;width: <?php echo stripslashes(get_option('ad_header_size'))  ?>px !important ; overflow: hidden;"><?php echo stripslashes(get_option('ad_header')); ?></div>
			<?php endif; ?>
		
		
		</div>
		<div class="clear"></div>
			
		
				<style> .mapi {display: none !important}</style>
               
            