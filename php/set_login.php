<?php
include("connection.php");

$first_name=$_POST["fname"];
$last_name=$_POST["lname"];
$dob=$_POST["dob"];
$contact=$_POST["contact"];
$address=$_POST["address"];
$email=$_POST["email"];
$signup_name=$_POST["user_name"];
$signup_password=$_POST["password"];
$app_id="";

$sql="INSERT INTO `student`(`STU_NAME`,`PASSWORD`,`FNAME`,`LNAME`,`EMAIL`,`CONTACT`,`ADDRESS`,`DOB`) VALUES('$signup_name','$signup_password','$first_name','$last_name','$email','$contact','$address','$dob')";

mysql_query($sql);

$sql1="SELECT MAX(APPLICATIONID)+1 FROM `fills`";
$result=mysql_query($sql1);

while($row=mysql_fetch_array($result)){
	$app_id=$row[0];	
}

mysql_query("INSERT INTO `application`(`APPLICATIONID`) VALUES('$app_id')");

$sql2 = "INSERT INTO `fills`(`APPLICATIONID`,`STU_NAME`) VALUES('$app_id','$signup_name')";
mysql_query($sql2);

mysql_query("INSERT INTO `decision`(`APPLICATIONID`) VALUES('$app_id')");

echo json_encode("Account Set Up Completed");

?>