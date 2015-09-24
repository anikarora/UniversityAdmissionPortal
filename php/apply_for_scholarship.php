<?php
	include("connection.php");
	
	$std_id=$_POST["user"];
	$scholarship_id=$_POST["id"];
	
	$sql = "INSERT INTO `applyscholarship`(`USERNAME`,`S_ID`) VALUES ('$std_id','$scholarship_id')";
	mysql_query($sql);
	
	echo json_encode("Scholarship Applied Successfully. Decision will be made soon...");
	
?>