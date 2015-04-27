<?php
	session_start();
	
	$conn=mysql_connect("localhost","root","");
	if (!$conn) {
				echo "Failed to connect to MySQL: " . mysql_error();
		}
	mysql_select_db("cyber_tongue");
	$comment=$_POST['comment'];
	$com_user=$_SESSION['user'];
	$ans_no=$_POST['ans_no'];
	$comment=mysql_real_escape_string($comment);
	$sql="INSERT INTO comments (user,com_body,ans_no) values ('$com_user','$comment','$ans_no')";
	$retval = mysql_query( $sql,$conn );
	$query = "UPDATE answers SET total_comments = total_comments+1 WHERE ans_no=$ans_no";
	mysql_query( $query,$conn );
	if(! $retval ) 
	{ 
		die('Could not enter data: ' . mysql_error()); 
	}
	echo "Comment Posted successfully";
?>
