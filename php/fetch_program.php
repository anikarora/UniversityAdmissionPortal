<?php
	include("connection.php");
	
	$program_id = array();
	$degree = array();
	$info = array();
	$prerequisite = array();
	
	$sql = "SELECT * FROM `program`";
	$programs = mysql_query($sql);
	
	while($row = mysql_fetch_array($programs)){
		array_push($program_id,$row[0]);
		array_push($degree,$row[1]);
		array_push($info,$row[2]);
		array_push($prerequisite,$row[3]);
	}
	
	echo json_encode(array($program_id,$degree,$info,$prerequisite));
	//echo json_encode("hello");
?>