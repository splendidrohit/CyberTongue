<?php
session_start();
if($_SESSION['user']==NULL)
{	$ar=array("status"=>false);
echo json_encode($ar);
	
}
else
{
	$conn=mysql_connect("localhost","root","");
	if (!$conn) {
				echo "Failed to connect to MySQL: " . mysql_error();
		}
	mysql_select_db("cyber_tongue");
	$user=$_SESSION['user'];
	$no=$_POST['no'];
	$sql="select ques_user from questions where ques_no=$no";
	$res = mysql_query($sql);
	
	$row= mysql_fetch_array($res);
	if($row[0]==$user)
	{
		echo "You can't follow your own question";
		die();
	}
	$lid=$no.$user;
	$no=(int)$no;
	
		$quer="select * from followers where follow_id='$lid'";
		$res=mysql_query($quer,$conn) or die(mysql_error());;
		if($rowl = mysql_fetch_array($res))
		{
			$query = "UPDATE questions SET total_followers = total_followers-1 WHERE ques_no=$no";
			mysql_query( $query,$conn );
			$s="delete from followers where follow_id='$lid'";
			mysql_query( $s,$conn );
			$sql="select total_followers from questions where ques_no=$no";
			$r=mysql_query( $sql,$conn );
			$row=mysql_fetch_array($r);
			$ar=array("status"=>true,"follow"=>false,"total"=>$row[0]);
		}
		else
		{
			$query = "UPDATE questions SET total_followers = total_followers+1 WHERE ques_no=$no";
				mysql_query( $query,$conn );
				$s="INSERT INTO followers (follow_id,user,ques_no) values ('$lid','$user','$no')";
				mysql_query( $s,$conn );
				$sql="select total_followers from questions where ques_no=$no";
				$r=mysql_query( $sql,$conn );
				$row=mysql_fetch_array($r);
				$ar=array("status"=>true,"follow"=>true,"total"=>$row[0]);
		}
	
	
	echo json_encode($ar);
}
?>
