<?php
include("connection.php");

$user_type=$_POST["user_type"];
$user_name=$_POST["name"];
$user_password=$_POST["password"];

$id="";
$fname="";
$lname="";
$status="";

$admin_program = "";
$admin_degree = "";
$admin_info = "";

if($user_type=="STUDENT"){
	$sql="SELECT s.STU_NAME,s.FNAME,s.LNAME,f.APPSTATUS FROM student s,fills f WHERE s.`STU_NAME`='$user_name' AND s.`PASSWORD`='$user_password' AND s.STU_NAME=f.STU_NAME";
	
	$check=mysql_query($sql);
	
	if(mysql_num_rows($check)==0)
		$msg="Invalid Username or Password";
	else{
		while($row = mysql_fetch_array($check)){
			$id = $row[0];
			$fname = $row[1];
			$lname = $row[2];
			$status = $row[3];
		}
		$msg="Login Successfull";	
	}
	
	echo json_encode(array($id,$fname,$lname,$status,$msg));
}

else{
	$sql1 = "SELECT p.* FROM `programadmin` pa,`program` p WHERE pa.`USERNAME`='$user_name' AND pa.`PASSWORD`='$user_password' AND pa.`PROGRAMID`=p.`PROGRAMID`";
	
	$check=mysql_query($sql1);
	
	if(mysql_num_rows($check)==0)
		$msg="Invalid Username or Password";
	else{
		while($row1 = mysql_fetch_array($check)){
			$admin_program = $row1[0];
			$admin_degree = $row1[1];
			$admin_info = $row1[2];
		}
		$msg = "Login Successfull";
	}
	
	echo json_encode(array($user_name,$admin_program,$admin_degree,$admin_info,$msg));
	//echo json_encode($user_type);
}

?>