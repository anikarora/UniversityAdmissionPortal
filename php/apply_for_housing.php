<?php
	include("connection.php");
	
	$std_id=$_POST["user"];
	$house_id=$_POST["id"];
	
	$sql = "INSERT INTO `applyhousing`(`USERNAME`,`H_ID`) VALUES ('$std_id','$house_id')";
	mysql_query($sql);
	
	echo json_encode("House Applied to the Admin. You will be contacted shortly...");
	
?>