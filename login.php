<html>
<head>
<title>User Login Form</title>
</head>
<link href="style/login-style.css" rel="stylesheet" type="text/css">
<body>
<form method="post" action="">
<table border="2" cellpadding="15" cellspacing="2" width="400" align="center">
<tr class="tabheader">
<td align="center" colspan="2">Please Enter UserName & Password to Login.</td>
</tr>
<tr class="row">
<td align="center">UserName</td>
<td><input type="text" name="user_name"></td>
</tr>
<tr class="row">
<td align="center">Password</td>
<td><input type="password" name="password"></td>
</tr>
<tr class="tabheader">
<td align="center" colspan="2">
<input type="submit" name="submit" value="Submit"></td>
</tr>
</table>
</form>

<?php
if(isset($_POST["submit"]))
{
	
if(count($_POST)>0) 
{
 //Including dbconfig file.
include 'dbconfig.php';
 
$username = $_POST["user_name"];

$password = $_POST["password"];

$finalResult = mysql_query("SELECT username,password FROM users WHERE UserName='" . $_POST["user_name"] . "' and Password = '". $_POST["password"]."'");  

$confirm  = mysql_fetch_array($finalResult);

if(is_array($confirm)) {
	
	session_start();
	$_SESSION['sid']=session_id();
	header("location:dashboard.php");

} else {
	

echo '<center>' . "Wrong UserName or Password..." . '</center>';

}

}
}
?>

</body></html>
 