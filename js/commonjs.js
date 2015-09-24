$(window).load(function(){
	 
	$("#right_profile").hide();
	
	if($.cookie("loged")){
			
		$(".sidebar_right_bottom").hide();
		$("#right_profile").show();
		
		$("#right_name").html($.cookie("loged").split("/")[0]);
		$("#right_fname").html($.cookie("loged").split("/")[1]);
		$("#right_lname").html($.cookie("loged").split("/")[2]);
		if($.cookie("loged").split("/")[3]=="student"){
			$("#right_status").html($.cookie("loged").split("/")[4]);
		}
		/*if($.cookie("loged").split("/")[4]=="ACCEPTED"){
			
			$(".menu ul").append("<li><a href=\"#\">Scholarship</a></li><li><a href=\"housing.html\">Housing</a></li><li id=\"Job\"><a href=\"applyjob.html\">On Campus Jobs</a></li>");	
		}*/
	}
	else{

		$("#right_profile").hide();
		$("#link_profile").hide();	
	}
	
	$("#logout").click(function(){
		$.removeCookie("loged");
		location.reload();	
	});
});
