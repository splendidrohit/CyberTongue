<?php
	session_start();
	
	$conn=mysql_connect("localhost","root","");
	if (!$conn) {
				echo "Failed to connect to MySQL: " . mysql_error();
		}
	mysql_select_db("cyber_tongue");
	$userid=$_POST['username'];
	$password=$_POST['password'];
	$sql="select name,profile_pic from user_information where user_name='$userid' and password='$password'";
	$retval = mysql_query( $sql,$conn );
	if(! $retval ) 
	{ 
		die('Could not enter data: ' . mysql_error()); 
	}
	if($row = mysql_fetch_array($retval))
	{
		$msg= "welcome ".$row[0];
		$_SESSION['user']=$userid;
		$_SESSION['dp']=$row[1];
		$_SESSION['name']=$row[0];
		$ar=array('status'=>true,'message'=>$msg);
		echo json_encode($ar);
	}
	else
	{
		$msg= 'Username or Password do not match';
		$ar=array('status'=>false,'message'=>$msg);
		echo json_encode($ar);
		
		
	}
	
?>
