</div>
<div class="clear"></div>





<?php 
//revslider conditional
if (get_option('enable_slider') =='Enable') { ?>

<?php $slideralias =  get_option('slider_alias') ;?>

<div class="sliderss">
<div class="mainso">
	<?php putRevSlider("$slideralias"); ?>
</div>
</div>	


<?php } ?>