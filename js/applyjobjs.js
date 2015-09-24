$(window).load(function(){
	getJobList();
	
	$(document).on("click","#job",function(){
		//alert($.cookie("loged").split("/")[0]);
		$.ajax({
			url:"php/apply_for_job.php",
			data:{user:$.cookie("loged").split("/")[0],id:$(this).attr("job")},
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
	
	function getJobList(){
		$.ajax({
			url:"php/apply_job.php",
			data:{id:$.cookie('loged').split("/")[0]},
			type:"POST",
			dataType:"json",
			success:function(result){
				
				for(var i=0;i<result[0].length;i++){
					$("#job_table").append("<tr><td>"+result[0][i]+"</td><td>"+result[1][i]+"</td><td>"+result[2][i].split("/")[0].split("$")[1]+"</td><td>Applied</td></tr>");	
				}
					
				for(var i=0;i<result[3].length;i++){
					$("#job_table").append("<tr><td>"+result[3][i]+"</td><td>"+result[4][i]+"</td><td>"+result[5][i].split("/")[0].split("$")[1]+"</td><td><button class=\"mybutton\" id=\"job\" job=\""+result[6][i]+"\">Apply</button></td></tr>");	
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

