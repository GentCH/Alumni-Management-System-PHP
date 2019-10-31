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
<title>Manage Alumni</title>

<link rel="stylesheet" href="css/header_navigationbar.css" />

<?php
include_once "setting/adminpage_navigation.php";
?>


</head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 70%;
	background-color: #F9E79F;
}

td, th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
}

#button1 {
	padding: 5px 20px;
    background-color: #F9E79F;
    color: black;
    border: 2px solid #FEF9E7;
}
	
</style>

<body>
<br>
<?php
include_once"connect_database.php";
?>

<h1 style="padding-left:100px"> View Alumni Membership </h1>
<br>
<table id="alumni" align="center">
<tr>
	<th>NO </th>
	<th> Alumni ID </th>
	<th onclick="sortTable(0)"> Alumni IC </th>
	<th onclick="sortTable(2)"> Approval Status </th>
</tr>

<?php
$sqlshow1 = "SELECT alumnimember.al_id, alumniinfo.pi_IC, alumnimember.al_status FROM alumnimember, alumniinfo WHERE alumniinfo.al_id=alumnimember.al_id";
$result1 = $conn->query($sqlshow1);
$no = 1;

while ($row=$result1->fetch_assoc())
{
	echo "<tr>";
	echo "<td>" . $no++. "</td>";
	echo "<td>" . $row['al_id']. "</td>";
	echo "<td>" . $row['pi_IC']. "</td>";
	echo "<td>" . $row['al_status']. "</td>";
	echo "</tr>";
}
$conn->close();
?>
<tr>
<td colspan="5" style= 'text-align:right'><a href="approve.php"> Approve Membership </a> </td>
</tr>
</table>
<br><br><br><br>

<script>

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("alumni");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}	


</script>
</body>
</html>