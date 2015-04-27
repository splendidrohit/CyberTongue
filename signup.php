<?php
	session_start();
	$conn=mysql_connect("localhost","root","");
	if (!$conn) {
				echo "Failed to connect to MySQL: " . mysql_error();
		}
	mysql_select_db("cyber_tongue");
	$userid=$_POST['username'];
	$password=$_POST['password'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$gender=$_POST['gender'];
	if($gender=='male')
		$dp='images/male.png';
	else
		$dp='images/female.png';
	$sql="INSERT INTO user_information (user_name,password,name,email,gender,profile_pic) values ('$userid','$password','$name','$email','$gender','$dp')";
	$retval = mysql_query( $sql,$conn );
	if(! $retval ) 
	{ 
		die('Could not enter data: ' . mysql_error()); 
	}
	echo "welcome ".$name;
	$_SESSION['user']=$userid;
	$_SESSION['dp']=$dp;
	mysql_close($conn);
	
?>
