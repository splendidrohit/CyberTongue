<?php
	session_start();
	if($_SESSION['user']==NULL)
	{
		$msg="Please Login First";
		$ar=array('msg'=>$msg);
		echo json_encode($ar);
		die();
	}
	
	$conn=mysql_connect("localhost","root","");
	if (!$conn) {
				echo "Failed to connect to MySQL: " . mysql_error();
		}
	mysql_select_db("cyber_tongue");
	$ques_body=$_POST['ques_body'];
	$more=$_POST['more'];
	$category=$_POST['category'];
	$a=$_POST['anonymous'];
	$ques_body=mysql_real_escape_string($ques_body);
	$more=mysql_real_escape_string($more);
	if($a==false)
		$anonymous=0;
	else
		$anonymous=1;
	$user=$_SESSION['user'];
	$sql="INSERT INTO questions (ques_body,ques_detail,ques_user,category,anonymous) values ('$ques_body','$more','$user','$category','$anonymous')";
	$retval = mysql_query( $sql,$conn );
	if(! $retval ) 
	{ 
		die('Could not enter data: ' . mysql_error()); 
	}
	$msg="Question posted successfully";
		$ar=array('msg'=>$msg);
		echo json_encode($ar);
	mysql_close($conn);
?>
