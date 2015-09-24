$(window).load(function(){
	getHousingList();
	
	$(document).on("click","#house",function(){
		//alert($.cookie("loged").split("/")[0]);
		$.ajax({
			url:"php/apply_for_housing.php",
			data:{user:$.cookie("loged").split("/")[0],id:$(this).attr("house")},
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
	
	$("#location,#rate,#bhk").change(function(){
		$.ajax({
			url:"php/filter_housing.php",
			data:{user:$.cookie("loged").split("/")[0],location:$("#location").val(),rent_low:$("#rate").val().split(" ")[0]+"$ PER MONTH",rent_high:$("#rate").val().split(" ")[3]+"$ PER MONTH",bhk:$("#bhk").val()},
			type:"POST",
			dataType:"json",
			success:function(result){
				
				$("#house_table").find("tr:gt(0)").remove();
				
				for(var i=0;i<result[0].length;i++){
					$("#house_table").append("<tr><td>"+result[0][i]+"</td><td>"+result[1][i]+"</td><td>"+result[7][i].split("$")[0]+"</td><td>Applied</td></tr>");	
				}
					
				for(var i=0;i<result[3].length;i++){
					if(!result[0].length)
						$("#house_table").append("<tr><td>"+result[2][i]+"</td><td>"+result[3][i]+"</td><td>"+result[8][i].split("$")[0]+"</td><td><button class=\"mybutton\" id=\"house\" house=\""+result[4][i]+"\">Apply</button></td></tr>");	
					else $("#house_table").append("<tr><td>"+result[2][i]+"</td><td>"+result[3][i]+"</td><td>"+result[8][i].split("$")[0]+"</td><td></td></tr>");	
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
	});
	
	function getHousingList(){
		$.ajax({
			url:"php/apply_housing.php",
			data:{id:$.cookie('loged').split("/")[0]},
			type:"POST",
			dataType:"json",
			success:function(result){
				
				for(var i=0;i<result[0].length;i++){
					$("#house_table").append("<tr><td>"+result[0][i]+"</td><td>"+result[1][i]+"</td><td>"+result[7][i].split("$")[0]+"</td><td>Applied</td></tr>");	
				}
					
				for(var i=0;i<result[3].length;i++){
					if(!result[0].length)
						$("#house_table").append("<tr><td>"+result[2][i]+"</td><td>"+result[3][i]+"</td><td>"+result[8][i].split("$")[0]+"</td><td><button class=\"mybutton\" id=\"house\" house=\""+result[4][i]+"\">Apply</button></td></tr>");	
					else $("#house_table").append("<tr><td>"+result[2][i]+"</td><td>"+result[3][i]+"</td><td>"+result[8][i].split("$")[0]+"</td><td></td></tr>");	
				}
				
				for(var i=0;i<result[5].length;i++){
					$("#location").append("<option>"+result[5][i]+"</option>");	
				}
				
				for(var i=0;i<result[6].length;i++){
					$("#bhk").append("<option>"+result[6][i]+"</option>");	
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

