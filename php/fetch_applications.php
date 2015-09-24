<?php
	include("connection.php");
	
	$ids=array();
	$gres=array();
	$toefls=array();
	$gpas=array();
	$exps=array();
	$dates=array();
	$status=array();
	$fnames=array();
	$lnames=array();
	$emails=array();
	$contacts=array();
	$address=array();
	$dobs=array();
	$decisions=array();
	
	$degree=$_POST["degree"];
	$program=$_POST["program"];
	
	$sql = "SELECT a.*,f.`APPLY_DATE`,f.`APPSTATUS`,s.*,d.`DECISION_DATE` FROM `application` a,`fills` f,`student` s,`decision` d WHERE a.`DEGREETYPE`='$degree' AND a.`INTREST_PROG`='$program' AND a.`APPLICATIONID`=f.`APPLICATIONID` AND s.`STU_NAME`=f.`STU_NAME` AND d.`APPLICATIONID`=a.`APPLICATIONID` AND d.`APPLICATIONID`=f.`APPLICATIONID`";
	$result = mysql_query($sql);
	
	while($row = mysql_fetch_array($result)){
		array_push($ids,$row[0]);
		array_push($gres,$row[1]);
		array_push($toefls,$row[2]);
		array_push($gpas,$row[3]);
		array_push($exps,$row[6]);
		array_push($dates,$row[7]);
		array_push($status,$row[8]);
		array_push($fnames,$row[11]);
		array_push($lnames,$row[12]);
		array_push($emails,$row[13]);
		array_push($contacts,$row[14]);
		array_push($address,$row[15]);
		array_push($dobs,$row[16]);
		array_push($decisions,$row[17]);
	}
	
	echo json_encode(array($ids,$gres,$toefls,$gpas,$exps,$dates,$status,$fnames,$lnames,$emails,$contacts,$address,$dobs,$decisions));
?>