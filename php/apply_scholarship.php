<?php
	include("connection.php");
	
	$std_id=$_POST["id"];
	
	$applied_scholar = array();
	$applied_desc = array();
	
	$scholarship_id = array();
	$location = array();
	$description = array();
	
	$sql1 = "SELECT * FROM `scholarship` WHERE `S_ID` IN(SELECT S_ID FROM `applyscholarship` WHERE USERNAME='$std_id')";
	$applied_scholarship = mysql_query($sql1);
	
	while($row = mysql_fetch_array($applied_scholarship)){
		array_push($applied_scholar,$row[1]);
		array_push($applied_desc,$row[2]);
	}
	
	$sql2 = "SELECT * FROM `scholarship` WHERE `S_ID` NOT IN(SELECT S_ID FROM `applyscholarship` WHERE USERNAME='$std_id')";
	$apply_scholarship = mysql_query($sql2);
	
	while($row = mysql_fetch_array($apply_scholarship)){
		array_push($scholarship_id,$row[0]);
		array_push($location,$row[1]);
		array_push($description,$row[2]);
	}
	
	echo json_encode(array($applied_scholar,$applied_desc,$location,$description,$scholarship_id));
	///echo json_encode("hello");
?>