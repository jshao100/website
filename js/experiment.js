$( document ).ready(function() {
	$(".reset").click(function() {
		clean();
		$(".experiment").css("transform-origin", "");
	});

	//main navigation
	$(".click_to_zoom").click(function(){
		//get parent
		clean();
		$(".experiment").addClass("zoom");

		if ($(this).parent().hasClass("pos_projects")) {
			$(".experiment").css("transform-origin","25vw 42vw");
			$(".experiment").addClass("zoom_proj");

			//add class show to all children
			$(".proj_content").children().children(".small").children("a").addClass("show");

		} else if ($(this).parent().hasClass("pos_exp")) {
			$(".experiment").css("transform-origin","84vw 4vw");
			$(".experiment").addClass("zoom_exp");
			
			//add class show to all children
			$(".exp_content").children().children(".small").children("a").addClass("show");
		} else if ($(this).parent().hasClass("pos_about")) {
			$(".experiment").css("transform-origin","90vw 51vw");
			$(".experiment").addClass("zoom_about");
		}
	});

	//2nd layer
	$(".x2").click(function() {
		$(".showX").removeClass("showX");
		if ($(".experiment").hasClass("zoom") || $(".experiment").hasClass("zoom2")) {
		
			//zoom in on specific project
			if ($(".experiment").hasClass("zoom_proj")) {
				$(".experiment").removeClass("zoom2 zoom_exp zoom_about");
				$(".experiment").addClass("zoom2");

				//zoom in on specific clicked element
				if ($(this).parent().parent().hasClass("proj1")) {
					$(".experiment").css("transform-origin","20vw 25vw");
					$(".proj1").find(".x-small").children().addClass("showX");
					$(".proj1").find(".xx-small").children().addClass("showX");
				} else if ($(this).parent().parent().hasClass("proj2")) {
					$(".experiment").css("transform-origin","11vw 35vw");
					$(".proj2").find(".x-small").children().addClass("showX");
					$(".proj2").find(".xx-small").children().addClass("showX");
				} else if ($(this).parent().parent().hasClass("proj3")) {
					$(".experiment").css("transform-origin","17vw 50.5vw");
					$(".proj3").find(".x-small").children().addClass("showX");
					$(".proj3").find(".xx-small").children().addClass("showX");
				} else if ($(this).parent().parent().hasClass("proj4")) {
					$(".experiment").css("transform-origin","47vw 46.5vw");
					$(".proj4").find(".x-small").children().addClass("showX");
					$(".proj4").find(".xx-small").children().addClass("showX");
				}
			}
			
			//zoom in on specific experience
			if ($(".experiment").hasClass("zoom_exp")) {
				$(".experiment").removeClass("zoom2 zoom_proj zoom_about");
				$(".experiment").addClass("zoom2");

				if ($(this).parent().parent().hasClass("exp1")) {
					$(".experiment").css("transform-origin","60vw 0vw");
					$(".exp1").find(".x-small").children().addClass("showX");
				} else if ($(this).parent().parent().hasClass("exp2")) {
					$(".experiment").css("transform-origin","87vw 0vw");
					$(".exp2").find(".x-small").children().addClass("showX");
				} else if ($(this).parent().parent().hasClass("exp3")) {
					$(".experiment").css("transform-origin","87vw 15vw");
					$(".exp3").find(".x-small").children().addClass("showX");
				} else if ($(this).parent().parent().hasClass("exp4")) {
					$(".experiment").css("transform-origin","84vw 28.5vw");
					$(".exp4").find(".x-small").children().addClass("showX");
				}
			}
		}
	});
});

function clean() {
	$(".experiment").removeClass("zoom zoom2 zoom_proj zoom_exp zoom_about");
	$(".show").removeClass("show");
	$(".showX").removeClass("showX");
}
