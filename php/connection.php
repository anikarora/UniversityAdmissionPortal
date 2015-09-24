<?php

	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="univdb"; //DB Name
	
	$connect_id=mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysql_select_db("$db_name",$connect_id) or die("NoDatabase");

?>