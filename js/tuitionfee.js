$(window).load(function(){

	$.ajax({
				url:"php/fetch_tuitionfee.php",
				data:{},
				type:"POST",
				dataType:"json",
				success:function(result){
					
					for(var i=0;i<result[0].length;i++){
						$("#tuitionfee_table").append("<tr><td>"+result[0][i]+"</td><td>"+result[1][i]+"</td><td>"+result[2][i]+"</td><td>"+result[3][i]+"</td></tr>");	
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