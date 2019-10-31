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
<title>Update Profile</title>
<link rel="stylesheet" href="css/update_profile.css" />
</head>

<body>
<?php 
include_once"connect_database.php";
include_once"setting/updateprofile_navigation.php";
?>
<div>
<br /><br />
<h2>Update Profile</h2>
<br />
<form method="post" name="profile" enctype="multipart/form-data">
<table class="updatetable1" cellspacing="20px" align="center">
  <tr>
    <th>Full Name:</th>
    <td class="updatetd1"><input type="text" name="fname" size="38" /></td>
  </tr>
  <tr>
    <th>IC Number:</th>
    <td class="updatetd1"><input type="text" name="ic" size="38" /></td>
  </tr>
  <tr>
    <th>Gender:</th>
    <td class="updatetd1"><input type="radio" name="gender" value="Male"/>Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="gender" value="Female"/>Female</td>
  </tr>
  <tr>
    <th>Address:</th>
    <td class="updatetd1"><textarea name="address" cols="40" rows="6"></textarea></td>
  </tr>
  <tr>
    <th>Contact Number:</th>
    <td class="updatetd1"><input type="text" name="contact" size="38" /></td>
  </tr>
  <tr>
    <th>Email:</th>
    <td class="updatetd1"><input type="text" name="email" size="38" /></td>
  </tr>
  <tr>
    <th>Batch:</th>
    <td class="updatetd1"><input type="text" name="batch" size="38" /></td>
  </tr>
  <tr>
    <th>Programme:</th>
    <td class="updatetd1"><input type="text" name="prog" size="38" /></td>
  </tr>
  <tr>
    <th>Graduation Year:</th>
    <td class="updatetd1"><input type="text" name="grad" size="38" /></td>
  </tr>
  <tr>
    <th>Profile Picture:</th>
    <td class="updatetd1"><input type="file" name="pp" size="38" /></td>
  </tr>
  <tr>
    <td class="updatetd1" colspan="2" align="right"><button class="updatebt" type="submit" name="update" >Update</button></td>
  </tr>
</table>
</form>
</div>
<br /><br /><br /><br /><br /><br />
<?php
if(isset($_POST['update']))
{
	$fname=$_REQUEST['fname'];
	$ic=$_REQUEST['ic'];
	$gender=$_POST['gender'];
	$address=$_REQUEST['address'];
	$contact=$_REQUEST['contact'];
	$email=$_REQUEST['email'];
	$batch=$_REQUEST['batch'];
	$prog=$_REQUEST['prog'];
	$grad=$_REQUEST['grad'];
	$pp=addslashes(file_get_contents($_FILES['pp']['tmp_name']));
	$ppname=$_FILES['pp']['name'];
	$result1=$result2=$result3=$result4=$result5=$result6=$result7=$result8=$result9=$result10=$result11=null;
	
	if($fname=="" && $ic=="" && $address=="" && $contact=="" && $email=="" && $batch=="" && $prog=="" && $grad=="" && $gender=="" && $pp==false)
	{
		echo "<script>alert('Empty field. No update made.')</script>";		
	}
	else
	{
		if($fname!="")
		{
			$sql1 = "UPDATE alumniinfo SET pi_full_name='".$fname."' WHERE al_id='$userid'";
			$result1 = $conn->query($sql1); 
		}
		if($ic!="")
		{
			$sql2 = "UPDATE alumniinfo SET pi_ic='".$ic."' WHERE al_id='$userid'";
			$result2 = $conn->query($sql2); 
		}
		if($gender!="")
		{
			$sql3 = "UPDATE alumniinfo SET pi_gender='".$gender."' WHERE al_id='$userid'";
			$result3 = $conn->query($sql3); 
		}
		if($address!="")
		{
			$sql4 = "UPDATE alumniinfo SET pi_address='".$address."' WHERE al_id='$userid'";
			$result4 = $conn->query($sql4); 
		}
		if($contact!="")
		{
			$sql5 = "UPDATE alumniinfo SET pi_contact='".$contact."' WHERE al_id='$userid'";
			$result5 = $conn->query($sql5); 
		}
		if($email!="")
		{
			$sql6 = "UPDATE alumniinfo SET pi_email='".$email."' WHERE al_id='$userid'";
			$result6 = $conn->query($sql6); 
		}
		if($batch!="")
		{
			$sql7 = "UPDATE alumniinfo SET pi_batch='".$batch."' WHERE al_id='$userid'";
			$result7 = $conn->query($sql7); 
		}
		if($prog!="")
		{
			$sql8 = "UPDATE alumniinfo SET pi_programme='".$prog."' WHERE al_id='$userid'";
			$result8 = $conn->query($sql8);
		}
		if($grad!="")
		{
			$sql9 = "UPDATE alumniinfo SET pi_year_graduate='".$grad."' WHERE al_id='$userid'";
			$result9 = $conn->query($sql9); 
		}
		if($pp==true)
		{
			$sql10 = "UPDATE alumniinfo SET pi_profile_picture='".$pp."' WHERE al_id='$userid'";
			$result10 = $conn->query($sql10); 
			$sql11 = "UPDATE alumniinfo SET pi_profilepicture_name='".$ppname."' WHERE al_id='$userid'";
			$result11 = $conn->query($sql11); 
		}	
		if($result1==true || $result2==true || $result3==true || $result4==true || $result5==true || 
		$result6==true || $result7==true || $result8==true || $result9==true || $result10==true)
		{
			echo "<script>alert('Update Success.')</script>";
		}
		else
		{
			echo "Fail";	
		}
	}
}
?>
</body>
</html>