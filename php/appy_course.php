<?php
	include("connection.php");
	
	$std_id=$_POST["id"];
	
	$registered_courseid=array();
	$registered_coursename=array();
	$registered_coursecredit=array();

	$courseid=array();
	$coursename=array();
	$coursecredit=array();
	
	$sql1 = "SELECT c.* FROM `courses` c,`registerfor` r WHERE r.STU_NAME='$std_id' AND c.`COURSEID`=r.`COURSEID`";
	$result1 = mysql_query($sql1);
	while($row1 = mysql_fetch_array($result1)){
		array_push($registered_courseid,$row1[0]);
		array_push($registered_coursecredit,$row1[0]);
		array_push($registered_coursename,$row1[1]);	
	}
	
	$sql2 = "SELECT c.* FROM `fills`f JOIN `application` a JOIN `program` p JOIN `teaches` t JOIN `courses` c ON f.`STU_NAME`='$std_id' AND f.`APPLICATIONID`=a.`APPLICATIONID` AND a.`INTREST_PROG`=p.`INFO` AND p.`PROGRAMID`=t.`PROGRAMID` AND t.`COURSEID`=c.`COURSEID` AND c.`COURSEID` NOT IN(SELECT `COURSEID` FROM `registerfor` r WHERE r.`STU_NAME`='$std_id')";
	$result2 = mysql_query($sql2);
	while($row2 = mysql_fetch_array($result2)){
		array_push($courseid,$row2[0]);
		array_push($coursecredit,$row2[1]);
		array_push($coursename,$row2[2]);	
	}
	
	echo json_encode(array($registered_courseid,$registered_coursename,$registered_coursecredit,$courseid,$coursename,$coursecredit));
?>