<?php
	include("connection.php");
		
	$std_id=$_POST["user"];
	$job_id=$_POST["id"];

	$sql = "INSERT INTO `applyjobs`(`USERNAME`,`J_ID`) VALUES ('$std_id','$job_id')";
	mysql_query($sql);
	
	echo json_encode("Job Applied Successfully");
	
?>