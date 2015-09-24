<?php
	include("connection.php");
	
	$student_type = array();
	$degree = array();
	$program = array();
	$cost = array();
	
	$sql = "SELECT t.STUDENT_TYPE,t.DEGREE,p.INFO,t.COST FROM `tutionfeecharged` t, `program` p 
	WHERE t.PROGRAMID=p.PROGRAMID";
	$result = mysql_query($sql);
	
	while($row = mysql_fetch_array($result)){

		array_push($student_type,$row[0]);
		array_push($degree,$row[1]);
		array_push($program,$row[2]);
		array_push($cost,$row[3]);
	}
	
	echo json_encode(array($student_type,$degree,$program,$cost));
	//echo json_encode("asd");
?>