	jQuery(document).ready(function(){
		var pxShow = 300;//height on which the button will show
		var fadeInTime = 1000;//how slow/fast you want the button to show
		var fadeOutTime = 1000;//how slow/fast you want the button to hide
		var scrollSpeed = 1000;//how slow/fast you want the button to scroll to top. can be a value, 'slow', 'normal' or 'fast'
		jQuery(window).scroll(function(){
			if(jQuery(window).scrollTop() >= pxShow){
				jQuery("#backtotop").fadeIn(fadeInTime);
			}else{
				jQuery("#backtotop").fadeOut(fadeOutTime);
			}
		});
		 
		jQuery('#backtotop a').click(function(){
			jQuery('html, body').animate({scrollTop:0}, scrollSpeed); 
			return false; 
		}); 
	});


$('.search-wrap-no').hover(function() {
    $(this).find('.submit-no').fadeTo(500, 0.5);
}, function() {
    $(this).find('.submit-no').fadeTo(500, 1);
});





/* The first line waits until the page has finished to load and is ready to manipulate */
$(document).ready(function(){
    /* remove the 'title' attribute of all <img /> tags */
    $("img").removeAttr("title");
});





function myFunction()
{
alert("This is just a preview!");
}

//<![CDATA[
$(window).load(function(){
$('#login-form').change(function() {
    if ($('#watch-me').attr('checked')) {
        $('#show-me').show();
    }else{
        $('#show-me').hide();
    }
});



});//]]>



$(window).load(function(){
$('#login-form').change(function() {
    if ($('#watch-me2').attr('checked')) {
        $('#show-me2').show();
    }else{
        $('#show-me2').hide();
    }
});



});//]]>



$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				play: 30000,
				pause: 8500,
				hoverPause: true,
				animationStart: function(current){
					$('.caption2').animate({
						bottom:-35
					},100);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationStart on slide: ', current);
					};
				},
				animationComplete: function(current){
					$('.caption2').animate({
						bottom:0
					},200);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationComplete on slide: ', current);
					};
				},
				slidesLoaded: function() {
					$('.caption2').animate({
						bottom:0
					},200);
				}
			});
		});



	


		
jQuery(function () {
    var tabContainers = jQuery('div.tabcontrol > div');
    tabContainers.hide().filter(':first').show();
    jQuery('div.tabcontrol ul.tabnavig a').click(function () {
        tabContainers.hide();
        tabContainers.filter(this.hash).fadeIn(100);
        jQuery('div.tabcontrol ul.tabnavig a').removeClass('selected');
        jQuery(this).addClass('selected');
        return false;
    }).filter(':first').click();
});

		
		
		



