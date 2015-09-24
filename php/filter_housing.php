<?php

	include("connection.php");
	
	$std_id=$_POST["user"];
	$filter_location=$_POST["location"];
	$rent_low=$_POST["rent_low"];
	$rent_high=$_POST["rent_high"];
	$filter_bhk=$_POST["bhk"];
	
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
	
	if($rent_low=="All$ PER MONTH" && $filter_bhk=="All" && $filter_location=="All"){
		$sql2 = "SELECT * FROM `housing` WHERE `H_ID` NOT IN(SELECT H_ID FROM `applyhousing` WHERE USERNAME='$std_id')";
	}
	
	else if($rent_low=="All$ PER MONTH" && $filter_bhk=="All"){
			
		$sql2 = "SELECT * FROM `housing` WHERE `HOUSINGNAME`='$filter_location' AND `H_ID` NOT IN(SELECT H_ID FROM `applyhousing` WHERE USERNAME='$std_id')";
		
	}
	
	else if($filter_location=="All" && $filter_bhk=="All"){
		
		$sql2 = "SELECT * FROM `housing` WHERE CAST(`RENT` AS UNSIGNED)>='$rent_low' AND CAST(`RENT` AS UNSIGNED)<='$rent_high' AND `H_ID` NOT IN(SELECT H_ID FROM `applyhousing` WHERE USERNAME='$std_id')";
		
	}
	
	else if($filter_location=="All" && $rent_low=="All$ PER MONTH"){
		
		$sql2 = "SELECT * FROM `housing` WHERE `ROOMS`='$filter_bhk' AND `H_ID` NOT IN(SELECT H_ID FROM `applyhousing` WHERE USERNAME='$std_id')";
		
	}
	
	else if($filter_location=="All"){
		
		$sql2 = "SELECT * FROM `housing` WHERE CAST(`RENT` AS UNSIGNED)>='$rent_low' AND CAST(`RENT` AS UNSIGNED)<='$rent_high' AND `ROOMS`='$filter_bhk' AND `H_ID` NOT IN(SELECT H_ID FROM `applyhousing` WHERE USERNAME='$std_id')";
		
	}
	
	else if($rent_low=="All$ PER MONTH"){
		
		$sql2 = "SELECT * FROM `housing` WHERE `HOUSINGNAME`='$filter_location' AND `ROOMS`='$filter_bhk' AND `H_ID` NOT IN(SELECT H_ID FROM `applyhousing` WHERE USERNAME='$std_id')";
		
	}
	
	else if($filter_bhk=="All"){
		
		$sql2 = "SELECT * FROM `housing` WHERE `HOUSINGNAME`='$filter_location' AND CAST(`RENT` AS UNSIGNED)>='$rent_low' AND CAST(`RENT` AS UNSIGNED)<='$rent_high' AND `H_ID` NOT IN(SELECT H_ID FROM `applyhousing` WHERE USERNAME='$std_id')";
		
	}
	
	else{
		$sql2 = "SELECT * FROM `housing` WHERE `HOUSINGNAME`='$filter_location' AND CAST(`RENT` AS UNSIGNED)>='$rent_low' AND CAST(`RENT` AS UNSIGNED)<='$rent_high' AND `ROOMS`='$filter_bhk' AND `H_ID` NOT IN(SELECT H_ID FROM `applyhousing` WHERE USERNAME='$std_id')";
	}
	
	$applied_housing = mysql_query($sql1);
	
	while($row = mysql_fetch_array($applied_housing)){
		array_push($applied_house,$row[1]);
		array_push($applied_bhk,$row[2]);
		array_push($applied_rent,$row[3]);
	}
	
	$apply_housing = mysql_query($sql2);
	
	while($row = mysql_fetch_array($apply_housing)){
		array_push($house_id,$row[0]);
		array_push($location,$row[1]);
		array_push($house_bhk,$row[2]);
		array_push($house_rent,$row[3]);
	}
	
	echo json_encode(array($applied_house,$applied_bhk,$location,$house_bhk,$house_id,$housings,$bhk,$applied_rent,$house_rent));
?>