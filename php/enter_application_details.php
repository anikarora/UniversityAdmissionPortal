<?php
	include("connection.php");
	
	$user = $_POST["user"];
	$gpa = $_POST["gpa"];
	$degree = $_POST["degree"];
	$program = $_POST["program"];
	$exp = $_POST["experience"];
	$gre = $_POST["gre"];
	$toefl = $_POST["toefl"];
	$date = $_POST["date"];
	$application="";
	$admin="";
	
	$sql1 = "SELECT `APPLICATIONID` FROM `fills` WHERE `STU_NAME`='$user'";
	$result1 = mysql_query($sql1);
	while($row1 = mysql_fetch_array($result1)){
		$application = $row1[0];
	}
	
	mysql_query("UPDATE `application` SET `GRE`='$gre',`TOEFL`='$toefl',`GPA`='$gpa',`INTREST_PROG`='$program',`DEGREETYPE`='$degree',`WORKEXP`='$exp' WHERE `APPLICATIONID`='$application'");
	
	mysql_query("UPDATE `fills` SET `APPLY_DATE`='$date',`APPSTATUS`='UNDER REVIEW' WHERE `APPLICATIONID`='$application'");
	
	$sql2 = "SELECT pa.`USERNAME` FROM `programadmin` pa,program p WHERE pa.`PROGRAMID`=p.`PROGRAMID` AND p.`INFO`='$program' AND p.`DEGREE`='$degree'";
	$result2 = mysql_query($sql2);
	while($row2 = mysql_fetch_array($result2)){
		$admin=$row2[0];	
	}
	
	mysql_query("INSERT INTO `decision`(`APPLICATIONID`,`ADMIN_ID`,`APPSTATUS`) VALUES('$application','$admin','UNDER REVIEW')");
	
	echo json_encode("Application Submitted Successfully");
	
?>