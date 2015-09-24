$(window).load(function(){
	if($.cookie("loged").split("/")[3]!="others"){
		
		$.ajax({
			url:"php/fetch_program.php",
			data:{},
			type:"POST",
			dataType:"json",
			success:function(result){
				for(var i=0;i<result[0].length;i++){
					$("#program").append("<option>"+result[2][i]+"</option>");	
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
		
		$("#application_name").html($.cookie("loged").split("/")[1]+" "+$.cookie("loged").split("/")[2]);

		if($.cookie("loged").split("/")[4]=="ACCEPTED" || $.cookie("loged").split("/")[4]=="REJECTED" || $.cookie("loged").split("/")[4]=="UNDER REVIEW"){
			$("#gpa,#exp,#gre,#toefl,#degree,#program").attr("disabled","true");
			$("#application_submit").hide();
			
			$.ajax({
				url:"php/get_application_details.php",
				data:{user:$.cookie("loged").split("/")[0]},
				type:"POST",
				dataType:"json",
				success:function(result){

					$("#gre").val(result[0]);
					$("#toefl").val(result[1]);
					$("#gpa").val(result[2]);
					$("#program").val(result[3]);
					$("#degree").val(result[4]);
					$("#exp").val(result[5]);
				
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
	}

	else{
		$(".container").hide();	
	}
	
	/*$("#application_form").on("submit",function(e){
		e.preventDefault();
	});*/
	
	$("#application_submit").click(function(){
		
		if($("#gpa").val() && $("#exp").val() && $("#gre").val() && $("#toefl").val()){
			
			var d = new Date();

			var month = d.getMonth()+1;
			var day = d.getDate();
			
			var today = d.getFullYear() + '-' +
				(month<10 ? '0' : '') + month + '-' +
				(day<10 ? '0' : '') + day;
			
			$.ajax({
				url:"php/enter_application_details.php",
				data:{user:$.cookie("loged").split("/")[0],gpa:$("#gpa").val(),degree:$("#degree").val(),program:$("#program").val(),experience:$("#exp").val(),gre:$("#gre").val(),toefl:$("#toefl").val(),date:today},
				type:"POST",
				dataType:"json",
				success:function(result){
					alert(result);
					
				},
				error:function(x,e){
					if(x.status==0){
						alert("Appication Submitted Successfully");
						$.cookie("loged",$.cookie("loged").split("/")[0]+"/"+$.cookie("loged").split("/")[1]+"/"+$.cookie("loged").split("/")[2]+"/"+$.cookie("loged").split("/")[3]+"/UNDER REVIEW",{ expires: 1 });	

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
	
	$("#gre,#toefl").on("keypress",function(evt){
		evt = (evt) ? evt : window.event;
    	var charCode = (evt.which) ? evt.which : evt.keyCode;
    	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    	    return false;
    	}
    	return true;
	});
	
	$("#gpa,#exp").on("keypress",function(evt){
		evt = (evt) ? evt : window.event;
    	var charCode = (evt.which) ? evt.which : evt.keyCode;
    	
		if(charCode==46)
			return true
		
		else if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
    	    return false;
    	}
		
    	return true;
	});
	
	
});