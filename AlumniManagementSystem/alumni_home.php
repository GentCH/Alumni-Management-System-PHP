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
<title>Alumni HomePage</title>
<link rel="stylesheet" href="css/alumni_home.css"
<?php
include_once"connect_database.php";
include_once"setting/alumnihome_navigation.php";
?>
</head>

<body>
<br />
<h2>My Profile</h2>
<br />
<table class="alumnihometable1" align="center" cellspacing="15px">
<?php
$sql="SELECT pi_IC, pi_full_name, pi_gender, pi_address, pi_email, pi_batch, pi_year_graduate, pi_programme, pi_contact, pi_profile_picture, al_id 
FROM alumniinfo WHERE al_id='$userid'";
$result=$conn->query($sql);
while($row = $result->fetch_assoc()) 
	{
		echo "<tr>";
		echo "<td colspan=2 align=center><img class=profile src=data:image/jpeg;base64,".base64_encode($row["pi_profile_picture"])." align=center /></td>";
		echo "</tr>";
        echo "<tr>";
		echo "<th>Name:</th>";
		echo "<td class=alumnihometd1>".$row["pi_full_name"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>IC Number:</th>";
		echo "<td class=alumnihometd1>".$row["pi_IC"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Gender:</th>";
		echo "<td class=alumnihometd1>".$row["pi_gender"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Address:</th>";
		echo "<td class=alumnihometd1>".$row["pi_address"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Contact Number:</th>";
		echo "<td class=alumnihometd1>".$row["pi_contact"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Email:</th>";
		echo "<td class=alumnihometd1>".$row["pi_email"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Batch:</th>";
		echo "<td class=alumnihometd1>".$row["pi_batch"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Programme:</th>";
		echo "<td class=alumnihometd1>".$row["pi_programme"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Graduation Year:</th>";
		echo "<td class=alumnihometd1>".$row["pi_year_graduate"]."</td>";
		echo "</tr>";
    }

?>
</table>
<br /><br /><br /><br />
</body>
</html>