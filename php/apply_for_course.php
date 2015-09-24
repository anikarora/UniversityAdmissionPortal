<?php

	include("connection.php");
	
	$user=$_POST["user"];
	$course=$_POST["course"];
	
	mysql_query("INSERT INTO `registerfor` VALUES('$course','$user')");
	
	echo json_encode("Course Registered Successfully");
	
?>