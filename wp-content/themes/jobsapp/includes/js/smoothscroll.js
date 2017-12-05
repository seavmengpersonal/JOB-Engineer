$(document).ready(function(){

	$("a.switcher").bind("click", function(e){
		e.preventDefault();
		
		var theid = $(this).attr("id");
		var theproducts = $("ul#job-o");
		var classNames = $(this).attr('class').split(' ');
		
		var gridthumb = "";
		var listthumb = "";
		
		if($(this).hasClass("active")) {
			// if currently clicked button has the active class
			// then we do nothing!
			return false;
		} else {
			// otherwise we are clicking on the inactive button
			// and in the process of switching views!

  			if(theid == "gridview") {
				$(this).addClass("active");
				$("#listview").removeClass("active");
			

			
			
				// remove the list class and change to grid
				theproducts.removeClass("list");
				theproducts.addClass("grid");
			
				// update all thumbnails to larger size
				$("img.thumb").attr("src",gridthumb);
			}
			
			else if(theid == "listview") {
				$(this).addClass("active");
				$("#gridview").removeClass("active");
					

					
			
					
				// remove the grid view and change to list
				theproducts.removeClass("grid")
				theproducts.addClass("list");
				// update all thumbnails to smaller size
				
			} 
		}

	});
});







$(document).ready(function(){

	$("a.switcher").bind("click", function(e){
		e.preventDefault();
		
		var theid = $(this).attr("id");
		var theproducts = $("ul#job-o2");
		var classNames = $(this).attr('class').split(' ');
		
		var gridthumb = "";
		var listthumb = "";
		
		if($(this).hasClass("active")) {
			// if currently clicked button has the active class
			// then we do nothing!
			return false;
		} else {
			// otherwise we are clicking on the inactive button
			// and in the process of switching views!

  			if(theid == "gridview2") {
				$(this).addClass("active");
				$("#listview2").removeClass("active");
			

			
			
				// remove the list class and change to grid
				theproducts.removeClass("list2");
				theproducts.addClass("grid2");
			
				// update all thumbnails to larger size
				$("img.thumb").attr("src",gridthumb);
			}
			
			else if(theid == "listview2") {
				$(this).addClass("active");
				$("#gridview2").removeClass("active");
					

					
			
					
				// remove the grid view and change to list
				theproducts.removeClass("grid2")
				theproducts.addClass("list2");
				// update all thumbnails to smaller size
				
			} 
		}

	});
});
