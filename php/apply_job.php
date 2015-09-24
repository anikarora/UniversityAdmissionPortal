<?php
	include("connection.php");
	
	$std_id=$_POST["id"];
	
	$applied_title = array();
	$applied_desc = array();
	$applied_pay = array();
	
	$job_id = array();
	$title = array();
	$desc = array();
	$pay = array();

	$sql1 = "SELECT * FROM `oncampusjobs` WHERE `J_ID` IN(SELECT J_ID FROM `applyjobs` WHERE USERNAME='$std_id')";
	$applied_jobs = mysql_query($sql1);
	
	while($row = mysql_fetch_array($applied_jobs)){
		array_push($applied_title,$row[1]);
		array_push($applied_desc,$row[2]);
		array_push($applied_pay,$row[3]);
	}
	
	$sql2 = "SELECT * FROM `oncampusjobs` WHERE `J_ID` NOT IN(SELECT J_ID FROM `applyjobs` WHERE USERNAME='$std_id')";
	$apply_jobs = mysql_query($sql2);
	
	while($row = mysql_fetch_array($apply_jobs)){
		array_push($job_id,$row[0]);
		array_push($title,$row[1]);
		array_push($desc,$row[2]);
		array_push($pay,$row[3]);
	}
	
	echo json_encode(array($applied_title,$applied_desc,$applied_pay,$title,$desc,$pay,$job_id));
	
?>