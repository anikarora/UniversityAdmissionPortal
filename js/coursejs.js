$(window).load(function(){
	getJobList();
	
	$(document).on("click","#course",function(){
		
		$.ajax({
			url:"php/apply_for_course.php",
			data:{user:$.cookie("loged").split("/")[0],course:$(this).attr("course")},
			type:"POST",
			dataType:"json",
			success:function(result){
				alert(result);
				location.reload();
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
	});
	
	$(document).on("click","#drop_course",function(){
		alert($(this).attr("course"));
		if(confirm("Are you sure to drop this course?")){
			$.ajax({
				url:"php/drop_course.php",
				data:{user:$.cookie("loged").split("/")[0],course:$(this).attr("course")},
				type:"POST",
				dataType:"json",
				success:function(result){
					alert(result);
					location.reload();
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
		}
	});
	
	function getJobList(){
		$.ajax({
			url:"php/appy_course.php",
			data:{id:$.cookie('loged').split("/")[0]},
			type:"POST",
			dataType:"json",
			success:function(result){
				
				for(var i=0;i<result[0].length;i++){
					$("#course_table").append("<tr><td>"+result[0][i]+"</td><td>"+result[1][i]+"</td><td>"+result[2][i]+"</td><td><button class=\"mybutton\" id=\"drop_course\" course=\""+result[0][i]+"\">Drop</button></td></tr>");	
				}
					
				for(var i=0;i<result[3].length;i++){
					$("#course_table").append("<tr><td>"+result[3][i]+"</td><td>"+result[4][i]+"</td><td>"+result[5][i]+"</td><td><button class=\"mybutton\" id=\"course\" course=\""+result[3][i]+"\">Apply</button></td></tr>");	
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
	}
	
	
});