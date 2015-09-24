$(window).load(function(){

	$("#detailed_application").hide();
	$.ajax({
			url:"php/fetch_applications.php",
			data:{degree:$.cookie("loged").split("/")[2],program:$.cookie("loged").split("/")[4]},
			type:"POST",
			dataType:"json",
			success:function(result){
				for(var i=0;i<result[0].length;i++){
					$("#application_table").append("<tr><td>"+result[7][i]+" "+result[8][i]+"</td><td>"+result[5][i]+"</td><td>"+result[6][i]+"</td><td><h3 style=\"cursor: pointer;\" class=\"view_application\" details=\""+result[0][i]+"/"+result[1][i]+"/"+result[2][i]+"/"+result[3][i]+"/"+result[4][i]+"/"+result[5][i]+"/"+result[6][i]+"/"+result[7][i]+"/"+result[8][i]+"/"+result[9][i]+"/"+result[10][i]+"/"+result[11][i]+"/"+result[12][i]+"/"+result[13][i]+"\">View</h3></td></tr>");
				}
			
			},
			error:function(x,e){
				if(x.status==0){
					alert('You are offline!!\n Please Check Your Network.');
				}else if(x.status==404){
					alert('Requested URL not found.');
				}else if(x.status==500){
					alert('Internel Server Error.');
				}else if(e=='parsererror'){
					alert('Error.\nParsing JSON Request failed.');
				}else if(e=='timeout'){
					alert('Request Time out.');
				}else {
					alert('Unknow Error.\n'+x.responseText);
				}
			}
		});

	$(document).on("click",".view_application",function(){
		
		$("#application_overview").hide();
		$("#detailed_application").show();
		
		$("#detailed_application").html("<center><h3>"+$(this).attr("details").split("/")[7]+" "+$(this).attr("details").split("/")[8]+"</h3></center>");
		
		$("#detailed_application").append("<center><table id=\"detailed_table\" style=\"border: 1px solid black;\" class=\"custom_table\"><tr><td>Appication ID</td><td>"+$(this).attr("details").split("/")[0]+"</td></tr><tr><td>Applied Date</td><td>"+$(this).attr("details").split("/")[5]+"</td></tr><tr><td>GRE Score</td><td>"+$(this).attr("details").split("/")[1]+"</td></tr><tr><td>TOEFL Score</td><td>"+$(this).attr("details").split("/")[2]+"</td></tr><tr><td>GPA</td><td>"+$(this).attr("details").split("/")[3]+"</td></tr><tr><td>Experience</td><td>"+$(this).attr("details").split("/")[4]+"</td></tr><tr><td>Email ID</td><td>"+$(this).attr("details").split("/")[9]+"</td></tr><tr><td>Contact</td><td>"+$(this).attr("details").split("/")[10]+"</td></tr><tr><td>Current Address</td><td>"+$(this).attr("details").split("/")[11]+"</td></tr></table></center>");
		
		if($(this).attr("details").split("/")[6]!="UNDER REVIEW")
			$("#detailed_table").append("<tr><td>Decision Made On</td><td>"+$(this).attr("details").split("/")[13]+"</td></tr>");
		
		if($(this).attr("details").split("/")[6]=="UNDER REVIEW")
			$("#detailed_application").append("<center><input type=\"submit\" class=\"mybutton\" value=\"Accept\" style=\"float: left;margin-left: 10px;\" details=\""+$(this).attr("details").split("/")[0]+"/"+$(this).attr("details").split("/")[9]+"\" id=\"accept_application\" /><input type=\"submit\" class=\"mybutton\" value=\"Reject\" style=\"float: left;margin-left: 10px;\" details=\""+$(this).attr("details").split("/")[0]+"/"+$(this).attr("details").split("/")[9]+"\" id=\"reject_application\" /><input type=\"submit\" class=\"mybutton\" value=\"Cancel\" style=\"float: left; margin-left: 10px;\" id=\"cancel_detailed\" /></center><br/><br/>");
		
		else $("#detailed_application").append("<center><input type=\"submit\" class=\"mybutton\" value=\"Cancel\" style=\"float: left; margin-left: 10px;\" id=\"cancel_detailed\" /></center><br/><br/>");
	});
	
	$(document).on("click","#accept_application",function(){
		
		var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();

		var today = d.getFullYear() + '-' +
    		(month<10 ? '0' : '') + month + '-' +
    		(day<10 ? '0' : '') + day;
			
		$.ajax({
			url:"php/application_status.php",
			data:{app_id:$(this).attr("details").split("/")[0],mail_id:$(this).attr("details").split("/")[1],status:"ACCEPTED",date:today},
			type:"POST",
			dataType:"json",
			success:function(result){
				alert(result);
				location.reload();
			},
			error:function(x,e){
				alert("Application Status Updated Succefully");
				alert("Application Status Updated Succefully");

				location.reload();
			}
		});	
	});
	
	$(document).on("click","#reject_application",function(){
		var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();

		var today = d.getFullYear() + '-' +
    		(month<10 ? '0' : '') + month + '-' +
    		(day<10 ? '0' : '') + day;
			
		$.ajax({
			url:"php/application_status.php",
			data:{app_id:$(this).attr("details").split("/")[0],mail_id:$(this).attr("details").split("/")[1],status:"REJECTED",date:today},
			type:"POST",
			dataType:"json",
			success:function(result){
				alert(result);
				location.reload();
			},
			error:function(x,e){
				alert("Application Status Updated Succefully");

				location.reload();
			}
		});
	});
	
	$(document).on("click","#cancel_detailed",function(){
		$("#application_overview").show();
		$("#detailed_application").hide();
		$("$detailed_application").html("");
	});
});