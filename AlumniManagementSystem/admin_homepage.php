<?php
session_start();
if (!isset($_SESSION['id'])){
	header("location:login.html");
}
else
{
	$userid=$_SESSION['id'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Homepage</title>

<link rel="stylesheet" href="css/header_navigationbar.css" />
</head>
<?php
include_once"connect_database.php";
include'setting/adminpage_navigation.php';
?>

<body>
<?php 

?>
</body>
</html>
