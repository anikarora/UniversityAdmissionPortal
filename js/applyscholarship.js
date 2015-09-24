$(window).load(function(){
	getScholarshipList();
	
	$(document).on("click","#scholarship",function(){
		//alert($.cookie("loged").split("/")[0]);
		$.ajax({
			url:"php/apply_for_scholarship.php",
			data:{user:$.cookie("loged").split("/")[0],id:$(this).attr("scholarship")},
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
	
	function getScholarshipList(){
		$.ajax({
			url:"php/apply_scholarship.php",
			data:{id:$.cookie('loged').split("/")[0]},
			type:"POST",
			dataType:"json",
			success:function(result){
				
				for(var i=0;i<result[0].length;i++){
					$("#scholarship_table").append("<tr><td>"+result[0][i]+"</td><td>"+result[1][i]+"</td><td>Applied</td></tr>");	
				}
					
				for(var i=0;i<result[3].length;i++){
					//if(!result[0].length)
						$("#scholarship_table").append("<tr><td>"+result[2][i]+"</td><td>"+result[3][i]+"</td><td><button class=\"mybutton\" id=\"scholarship\" scholarship=\""+result[4][i]+"\">Apply</button></td></tr>");	
					//else $("#scholarship_table").append("<tr><td>"+result[2][i]+"</td><td>"+result[3][i]+"</td><td></td></tr>");	
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

