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
<!DOCTYPE html>
<html>
<head>
<title>Manage Alumni - Approve </title>

<link rel="stylesheet" href="css/header_navigationbar.css" />
<link rel="stylesheet" href="css/add_forum_post.css"/>
<?php
include_once "setting/adminpage_navigation.php";
include_once "connect_database.php";
?>

</head>
<style>
table, th, td {
    border: 2px solid saddlebrown;
    border-collapse: collapse;
	font-size: 20px;
	width : 900px;
	text-align: center;
}
</style>
<body>
<?php
if(isset($_POST['approve']))
{
	$alid=$_REQUEST['aluid'];
	
	if ($alid=='')
	{
		echo "<br /><p class=p1>*****Please insert Alumni ID for membership approval.*****</p>";
	}
	else
	{
				$sql = "UPDATE alumnimember SET al_status= 'Approve' WHERE al_id = '$alid'";
				if ($conn->query($sql) === TRUE) 
				{
	    			echo "<br><p class=p1>*****Approval successfull.*****</p>";
					echo "<p class=p2><a href=manage_alumni.php>View Alumni Membership</a></p><br>";
				} 
				else 
				{
    				echo "Error: " . $sql . "<br>" . $conn->error;
				}
	}	
}
?>
<br><br><br>
<form action="approve.php" method="post">
<table align="center" style="border:2px hidden;" cellspacing="20">
<caption style= "font-size:30px"> Insert Alumni ID for approval: </caption>
<tr>
<th align="left" width="250" style="border:hidden;font-size:20px">Alumni ID: </th>
<td width="150" style="border:hidden"><input size="45" type="text" value="" name="aluid"/></td>
</tr>
</tr>
<td colspan=3 align="right" style="border:hidden"><button type="submit" name="approve" >Approve</button></td>
</tr>
</table>
</form>
<br></br><br></br>
<table align="center">
<caption> Alumni without Approval </caption>
<tr>
	<th> NO </th>
	<th> Alumni ID </th>
	<th> Alumni IC</th>
	<th> Approval Status </th>
</tr>
<?php
$sqlshowAWA= "SELECT alumnimember.al_id, alumniinfo.pi_IC, alumnimember.al_status FROM alumnimember, alumniinfo WHERE alumnimember.al_id = alumniinfo.al_id AND alumnimember.al_status = 'Not Approve'";
$resultAWA = $conn->query($sqlshowAWA);
$no = 1;

while ($row = mysqli_fetch_assoc($resultAWA))
{
	echo "<tr>";
	echo "<td>" . $no. "</td>";
	echo "<td>" . $row['al_id']. "</td>";
	echo "<td>" . $row['pi_IC']. "</td>";
	echo "<td>" . $row['al_status']. "</td>";
	$no++;
}
?>
</table>
<br><br><br><br><br><br>

</body>
</html>