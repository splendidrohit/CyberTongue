<?php
	session_start();
	$conn=mysql_connect("localhost","root","");
	if (!$conn) {
				echo "Failed to connect to MySQL: " . mysql_error();
		}
	mysql_select_db("cyber_tongue");
	$status=$_POST['status'];
	$status=mysql_real_escape_string($status);
	$user=$_SESSION['user'];
	if($_FILES["pic"]["name"]=='')
	{
			$query = "UPDATE user_information SET status = '$status' WHERE user_name='$user'";
			mysql_query( $query,$conn );
	}
	else{
	$dir="images/";
	$path_parts = pathinfo($_FILES["pic"]["name"]);
	$dir=$dir.$_SESSION['user']."_prof_pic.".$path_parts['extension']; 
	move_uploaded_file($_FILES["pic"]["tmp_name"], $dir);
	$query = "UPDATE user_information SET status = '$status',profile_pic='$dir' WHERE user_name='$user'";
	mysql_query( $query,$conn );
	}
?>
