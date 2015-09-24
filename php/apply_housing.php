<?php
	include("connection.php");
	
	$std_id=$_POST["id"];
	
	$applied_house = array();
	$applied_bhk = array();
	$applied_rent = array();
	
	$house_id = array();
	$location = array();
	$house_bhk = array();
	$house_rent = array();
	
	$housings = array();
	$rate = array();
	$bhk = array();
	
	$sql1 = "SELECT * FROM `housing` WHERE `H_ID` IN(SELECT H_ID FROM `applyhousing` WHERE USERNAME='$std_id')";
	$applied_housing = mysql_query($sql1);
	
	while($row = mysql_fetch_array($applied_housing)){
		array_push($applied_house,$row[1]);
		array_push($applied_bhk,$row[2]);
		array_push($applied_rent,$row[3]);
	}
	
	$sql2 = "SELECT * FROM `housing` WHERE `H_ID` NOT IN(SELECT H_ID FROM `applyhousing` WHERE USERNAME='$std_id')";
	$apply_housing = mysql_query($sql2);
	
	while($row = mysql_fetch_array($apply_housing)){
		array_push($house_id,$row[0]);
		array_push($location,$row[1]);
		array_push($house_bhk,$row[2]);
		array_push($house_rent,$row[3]);
	}
	
	$sql3 = "SELECT DISTINCT(`HOUSINGNAME`) FROM `housing`";
	$get_locations = mysql_query($sql3);
	
	while($row = mysql_fetch_array($get_locations)){
		array_push($housings,$row[0]);	
	}
	
	$sql4 = "SELECT DISTINCT(`ROOMS`) FROM `housing` ORDER BY `ROOMS`";
	$get_rooms = mysql_query($sql4);
	
	while($row = mysql_fetch_array($get_rooms)){
		array_push($bhk,$row[0]);	
	}
	
	/*$sql5 = "SELECT DISTINCT(`RENT`) FROM `housing`";
	$get_rent = mysql_query($sql5);
	
	while($row = mysql_fetch_array($get_rent)){
		array_push($rate,$row[0]);	
	}*/
	
	echo json_encode(array($applied_house,$applied_bhk,$location,$house_bhk,$house_id,$housings,$bhk,$applied_rent,$house_rent));
	//echo json_encode("hello");
?>