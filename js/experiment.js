$( document ).ready(function() {
	$(".reset").click(function() {
		$(".experiment").removeClass("zoom");
		$(".show").removeClass("show");
		$(".experiment").css("transform-origin", "");
	});

	$(".click_to_zoom").click(function(){
		//get parent
		$(".experiment").removeClass("zoom2");
		$(".show").removeClass("show");
		if ($(this).parent().hasClass("pos_projects")) {
			$(".experiment").addClass("zoom");
			$(".experiment").css("transform-origin","25vw 42vw");

			//add class show to all children
			$(".proj_content").children().children().first().children().addClass("show");

		} else if ($(this).parent().hasClass("pos_exp")) {
			$(".experiment").addClass("zoom");
			$(".experiment").css("transform-origin","84vw 8vw");
		} else if ($(this).parent().hasClass("pos_about")) {
			$(".experiment").addClass("zoom");
			$(".experiment").css("transform-origin","90vw 51vw");
		}
	});

	$(".x2").click(function() {
		if ($(".experiment").hasClass("zoom")) {
			//zoom in on specific project
			$(".experiment").removeClass("zoom");
			$(".experiment").addClass("zoom2");
			$(".experiment").css("transform-origin","20vw 25vw");
		}
	});
});
