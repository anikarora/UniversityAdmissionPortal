<?php

	include("connection.php");
	
	$user=$_POST["user"];
	$course=$_POST["course"];
	
	mysql_query("DELETE FROM `registerfor` WHERE `COURSEID`='$course' AND `STU_NAME`='$user'");
	
	echo json_encode("Course Dropped Successfully");
	
?>