<?php
	include("connection.php");
	require_once('class.phpmailer.php');
	
	$app_id = $_POST["app_id"];
	$user_mail = $_POST["mail_id"];
	$status= $_POST["status"];
	$decision_date = $_POST["date"];
	
	$sql = "UPDATE `fills` SET `APPSTATUS`='$status' WHERE `APPLICATIONID`='$app_id'";
	mysql_query($sql);
	
	$sql1 = "UPDATE `decision` SET `APPSTATUS`='$status',`DECISION_DATE`='$decision_date' WHERE `APPLICATIONID`='$app_id'";
	mysql_query($sql1);
	
	$sql2 = "select s.FNAME,s.LNAME,a.INTREST_PROG,a.DEGREETYPE,pa.USERNAME from application a,fills f,student s,program p,programadmin pa WHERE a.APPLICATIONID=f.APPLICATIONID AND f.STU_NAME=s.STU_NAME AND a.APPLICATIONID='$app_id' AND a.INTREST_PROG=p.INFO AND a.DEGREETYPE=p.DEGREE AND pa.PROGRAMID=p.PROGRAMID";
	$result = mysql_query($sql2);
	
	$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

    $mail->IsSMTP(); // telling the class to use SMTP
	
	while($row=mysql_fetch_array($result)){
		$mailto = $user_mail;
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
		  $mail->SetFrom('uncdbproject@gmail.com', 'Application Status');
		  //$mail->AddReplyTo('name@yourdomain.com', 'First Last');
		  $mail->Subject = 'Your Application Status';
		  $mail->AltBody = 'Application Status'; // optional - MsgHTML will create an alternate automatically
	
		  if($status=="ACCEPTED"){
		  		$mail->MsgHTML("<table border='1px solid black' style='width: 700px'> <tr><td colspan='2'><img src='..\images\uncc_logo.png' style='width: 500px; height: 80px;'></td></tr><tr><td colspan='2'>Dear ".$row[0]." ".$row[1].",<br/>
				Congratulations!! You have got an admit in ".$row[2]." ".$row[3]." at UNC Charlotte.<br/><br/>
				
				Sincerely,<br/>".
				$row[4]
				."<br/>".$row[2]." ".$row[3]."<br/>
				UNC Charlotte
				</td></tr></table>");
		  }
		  
		  else if($status=="REJECTED"){
		  		$mail->MsgHTML("<table border='1px solid black' style='width: 700px'> <tr><td colspan='2'><img src='..\images\uncc_logo.png' style='width: 500px; height: 80px;'></td></tr><tr><td colspan='2'>Dear ".$row[0]." ".$row[1].",<br/>
				Thank you for applying to the ".$row[2]." program in ".$row[3]." at UNC Charlotte. We received a very large number of applications with excellent credentials in the current academic season. Since we can only accept a limited number of applicants, we regret to inform you that you have not been admitted to the MS program at UNC Charlotte.<br/><br/>
				
				Sincerely,<br/>".
				$row[4]
				."<br/>".$row[2]." ".$row[3]."<br/>
				UNC Charlotte
				</td></tr></table>");
		  }
		  
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
	
	echo json_encode("Status Updated Successfully");
	
?>