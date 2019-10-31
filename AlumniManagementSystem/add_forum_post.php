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
<title>Forum - Add Post</title>
<link rel="stylesheet" href="css/add_forum_post.css"/>
<?php 
include_once"connect_database.php";
if (strchr("$userid","AL")==true)
	{
	 	include_once"setting/alumniaddforum_navigation.php";
	}
	else
	{
		include_once"setting/adminaddforum_navigation.php";
	}
?>
</head>

<body>
<?php
if(isset($_POST['addPost']))
{
	$ftitle=$_REQUEST['title'];
	$ftags=$_REQUEST['tags'];
	$fmessage=$_REQUEST['message'];
	date_default_timezone_set("Asia/Singapore");
	$ftime=date("Y/m/d h:i:sa");
	if ($ftitle=='' || $ftags=='' || $fmessage=='')
	{
		echo "<br /><br /><br /><p class=p1>*****Incomplete information. No topic created.*****</p>";
	}
	else
	{
		$getauthor="SELECT pi_full_name FROM alumniinfo WHERE al_id='$userid'";
		$result=$conn->query($getauthor);
		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc())
			{
				$fauthor=$row["pi_full_name"];
				if($fauthor=="")
				{
					echo "<br /><br /><p class=p1>*****No topic created.*****<br /> *****Please complete personal information before joining e-forum.*****</p>";
				}
				else
				{			
					$sql = "INSERT INTO forumdata (eforum_author, eforum_title, eforum_content, eforum_time, eforum_tags) 
					VALUES('$fauthor', '$ftitle', '$fmessage', '$ftime', '$ftags' )";
					if ($conn->query($sql) === TRUE) 
					{
	    				echo "<br /><p class=p1>*****Topic successfully created.*****</p>";
						echo "<br /><p class=p2><a href=forum_list.php>Go to forum</a></p>";
					} 
					else 
					{
   						echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}	
			}
		}
		else
		{
			$getauthor1="SELECT ad_fullname FROM adminmember WHERE ad_id='$userid'";
			$result1=$conn->query($getauthor1);
			while($row = $result1->fetch_assoc())
			{
					$fauthor=$row["ad_fullname"];
						$sql = "INSERT INTO forumdata (eforum_author, eforum_title, eforum_content, eforum_time, eforum_tags) 
						VALUES('$fauthor', '$ftitle', '$fmessage', '$ftime', '$ftags' )";
						if ($conn->query($sql) === TRUE) 
						{
		    				echo "<br /><p class=p1>*****Topic successfully created.*****</p>";
							echo "<br /><p class=p2><a href=forum_list.php>Go to forum</a></p>";
						} 
						else 
						{
		    				echo "Error: " . $sql . "<br>" . $conn->error;
						}
				}
			}
		}	
	}	
?>
<br /><br />
<h2>New Forum Post</h2>
<br />
<form action="add_forum_post.php" method="post">
<table align="center" cellspacing="30">
<tr>
<th align="left">Title: </th>
<td><input size="59" type="text" value="" name="title"/></td>
</tr>
<tr>
<th align="left">Tags: </th>
<td><input type="text" value="" name="tags" size="59" /></td>
<tr>
<th align="left" >Content: </label></th>
<td><textarea name="message" cols="60" rows="6" size="60"></textarea></td>
<tr>
<td colspan=2 align="right"><button class="addforumbt" type="submit" name="addPost" >Add Post</button></td>
</tr>
</table>
</form>
<br /><br /><br /><br />

</body>
</html>