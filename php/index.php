<!doctype html>
<html>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="js/homejs.js"></script>
<meta charset="utf-8">
<title>Untitled Document</title>
<?PHP

$user_name = "root";
$password = "123456";
$database = "univdb";
$server = "127.0.0.1";

$db_handle = mysql_connect($server, $user_name, $password);

$db_found = mysql_select_db($database, $db_handle);

if ($db_found) {

print "Database Found ";
$SQL = "SELECT * FROM STUDENT";
$result = mysql_query($SQL);

while ( $db_field = mysql_fetch_assoc($result) ) {

print $db_field['FNAME'] . "<BR>";
print $db_field['LNAME'] . "<BR>";
}
//mysql_close($db_handle);

}
else {

print "Database NOT Found ";

}

function login(){
	return "aasd";
}

?>
</head>

<body>
	<div class="container">
  <h2>Vertical (basic) form</h2>
  <form role="form">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="user_name" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password">
    </div>
    <div class="checkbox">
      <label><input type="checkbox"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default" id="login_submit">Submit</button>
  </form>
</div>

</body>
</html>
