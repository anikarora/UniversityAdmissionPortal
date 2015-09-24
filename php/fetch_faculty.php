<?php
	include("connection.php");
	
	$faculty = array();
	$email = array();
	$office = array();
	$degree=array();
	$course=array();
	
	$sql = "SELECT f.*,CONCAT(p.DEGREE,' ',p.INFO),c.COURSENAME FROM `faculty` f JOIN `teaches` t JOIN `courses` c JOIN `program` p ON f.`FACULTYID`=t.`FACULTYID` AND t.`COURSEID`=c.`COURSEID` AND t.`PROGRAMID`=p.`PROGRAMID`";
	$programs = mysql_query($sql);
	
	while($row = mysql_fetch_array($programs)){
		array_push($faculty,$row[1]);
		array_push($email,$row[2]);
		array_push($office,$row[3]);
		array_push($degree,$row[4]);
		array_push($course,$row[5]);
	}
	
	echo json_encode(array($faculty,$email,$office,$degree,$course));
	//echo json_encode("hello");
?>