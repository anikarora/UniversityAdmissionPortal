<?php
	include("connection.php");
	
	$std_id = $_POST["user"];
	
	$sql = "SELECT a.* FROM `application` a, `fills` f WHERE a.`APPLICATIONID`=f.`APPLICATIONID` AND f.`STU_NAME`='$std_id'";
	$result = mysql_query($sql);
	
	while($row = mysql_fetch_array($result)){
		$gre = $row[1];
		$toefl = $row[2];
		$gpa = $row[3];
		$prog = $row[4];
		$deg = $row[5];
		$exp = $row[6];	
	}
	
	echo json_encode(array($gre,$toefl,$gpa,$prog,$deg,$exp));
?>