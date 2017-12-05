<div class="banner">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar_home')) : else : ?>
	
			
		<!-- no dynamic sidebar so don't do anything -->


		<?php endif; ?>
		
		<?php appthemes_after_sidebar_widgets(); ?>
		</div>
		
