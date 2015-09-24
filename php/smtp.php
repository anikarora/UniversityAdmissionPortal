<?php

	include("connection.php");		
   	require_once('class.phpmailer.php');

    $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

    $mail->IsSMTP(); // telling the class to use SMTP
			//$mailto="gopal.adhith@gmail.com";//$_SESSION['mail1'];
	$user_mail=$_POST["mailid"];
	$user=$_POST["name"];
	$type=$_POST["user_type"];
	$new_password = $_POST["new_password"];
	$msg="";
	
	if($type=="student"){
	$sql = "SELECT * FROM `student` WHERE `STU_NAME`='$user' AND `EMAIL`='$user_mail'";
	$result=mysql_query($sql);
	
	while($row=mysql_fetch_array($result)){
		$mailto = $user_mail;
		mysql_query("UPDATE `student` SET `PASSWORD`='$new_password' WHERE `STU_NAME`='$user' AND `EMAIL`='$user_mail'");
		try {
		  //$mail->Host       = "mail.yourdomain.com"; // SMTP server
		  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
		  $mail->SMTPAuth   = true;                  // enable SMTP authentication
		  $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
		  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		  $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
		  $mail->Username   = "uncdbproject@gmail.com";  // GMAIL username
		  $mail->Password   = "my_password";            // GMAIL password
		  
		  
		  $mail->AddAddress($mailto, '');
		  $mail->SetFrom('uncdbproject@gmail.com', 'UNCC Forgot Password');
		  //$mail->AddReplyTo('name@yourdomain.com', 'First Last');
		  $mail->Subject = 'Your New Password';
		  $mail->AltBody = 'New Password'; // optional - MsgHTML will create an alternate automatically
	
	
		  $mail->MsgHTML("<table border='2px solid black' style='text-align:center;background-color:#005429;'> <tr><td><img src='..\images\uncc_logo.png' style='width: 200px; height: 80px;'></td><td><h1>UNC Charlotte</h1></td></tr><tr><td colspan='2'><h2>User Name <span style='text-decoration:underline'>".$user."</span></h2></td></tr><tr><td colspan='2'><h2>New Password <span style='text-decoration:underline'>".$new_password."</span></h2></td></tr>");
		  $mail->Send();
		  
		  $msg="Password Sent to your Mail ID";
		  //mail loop
			/*$con=mysql_connect("localhost","root","");
		  mysql_select_db("test1",$con);
		  $res=mysql_query("select mailid from tech_detail");
		  while($m=mysql_fetch_array($res)){
		  $mail->AddAddress($m['mailid'], '');
		  $mail->SetFrom('hallbooking.skcet@gmail.com', 'SKCET HALL BOOKING');
		  //$mail->AddReplyTo('name@yourdomain.com', 'First Last');
			$mail->Subject = 'HALL BOOKING for';
		  $mail->AltBody = 'HALL BOOKING'; // optional - MsgHTML will create an alternate automatically
		  
			$a=$_SESSION['h_name'];
			$b=$_SESSION['date'];
		  $mail->MsgHTML("THE ".$a." ON ".$b." IS SUCCESSFULLY BOOKED!!!");
		  $mail->Send();
		  }*/
		//  echo "Message Sent OK</p>\n";
		} catch (phpmailerException $e) {
		  $msg="Problem in Connection";
		} catch (Exception $e) {
		$msg="Problem in Connection";
		}
	}
	
	if(mysql_num_rows($result)==0)
		$msg="Invalid Details";
}//if end
echo json_encode($msg);
?>
