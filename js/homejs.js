// JavaScript Document

$(window).load(function(){
	/*$("#login_form").on("submit",function(e){
		e.preventDefault();
	});
		
	/*$("#login_submit").click(function(){
		
		if($(this).val()=="Sign In"){
			if($("#user_name").val() && $("#password").val()){
				
				$.ajax({
					url:"php/check_login.php",
					data:{user_type:$("#user_type").val(),name:$("#user_name").val(),password:$("#password").val()},
					type:"POST",
					dataType:"json",
					success:function(result){
						if(result[4]=="Invalid Username or Password"){
							alert(result[4]);
							$("#user_name,#password").val("");
							
						}
						else{
							$.cookie('loged', result[0]+"/"+result[1]+"/"+result[2]+"/"+$("#user_type").val().toLowerCase()+"/"+result[3] , { expires: 1 });
							location.reload();
							window.scrollTo(0,0);				
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
		}
		else{
			$.removeCookie("loged");
			location.reload();	
		}
	});*/
	
	/*$("#signup_form").on("submit",function(e){
		e.preventDefault();
	});
	
	$("#signup").click(function(){
		
		if($("#f_name").val() && $("#l_name").val() && $("#dob").val() && $("#contact").val() && $("#email").val() && $("#signup_name").val() && $("#signup_password").val() && $("#retype").val()){
			
			var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
			
			if(pattern.test($("#email").val())){
				if($("#signup_name").val().length>7){
					if($("#signup_password").val().length>5){
						
						 if($("#retype").val().length>5){
							if($("#signup_password").val()==$("#retype").val()){
								
								$.ajax({
									url:"php/set_login.php",
									data:{fname:$("#f_name").val(),lname:$("#l_name").val(),dob:$("#dob").val(),contact:$("#contact").val(),email:$("#email").val(),address:$("#address").val(),user_name:$("#signup_name").val(),password:$("#signup_password").val()},
									type:"POST",
									dataType:"json",
									success:function(result){
										alert(result);
										location.reload();
										window.scrollTo(0,0);
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
							else{
								alert("Password Mismatch");	
								$("#signup_password,#retype").val("")
							}
						 }
						 else{
							alert("Please Re-type Password");
							$("#retype").val("");
						 }
					}
					else{
						alert("Invalid Password");	
						$("#signup_password,#retype").val("")
					}
				}
				else{
					alert("Enter ValidUser Name");
					$("#signup_name").val("");	
				}
			}
			else{
				alert("Invalid e-Mail Address");
				$("#email").val("");	 
			}
	
		}
	});
	
	$("#cancel").click(function(){
		$("#f_name,#l_name,#dob,#contact,#email,#signup_password,#retype").val("")
	});
	
	$("#contact").on("keypress",function(evt){
		evt = (evt) ? evt : window.event;
    	var charCode = (evt.which) ? evt.which : evt.keyCode;
    	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    	    return false;
    	}
    	return true;
	});*/
	
	
	//$('#dialog').jqm();
});