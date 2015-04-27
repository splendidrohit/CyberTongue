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
	$type=$_POST['type'];
	$no=$_POST['no'];
	$lid=$type.$no.$user;
	$no=(int)$no;
	if($type=='ques')
	{
		$quer="select * from likes where likeid='$lid'";
		$res=mysql_query($quer,$conn) or die(mysql_error());
		if($rowl = mysql_fetch_array($res))
		{
			$query = "UPDATE questions SET total_likes = total_likes-1 WHERE ques_no=$no";
			mysql_query( $query,$conn );
			$s="delete from likes where likeid='$lid'";
			mysql_query( $s,$conn );
			$sql="select total_likes from questions where ques_no=$no";
			$r=mysql_query( $sql,$conn );
			$row=mysql_fetch_array($r);
			$ar=array("status"=>true,"like"=>false,"total"=>$row[0]);
		}
		else
		{
			$query = "UPDATE questions SET total_likes = total_likes+1 WHERE ques_no=$no";
				mysql_query( $query,$conn );
				$s="INSERT INTO likes (likeid,type,like_user,number) values ('$lid','$type','$user','$no')";
				mysql_query( $s,$conn );
				$sql="select total_likes from questions where ques_no=$no";
				$r=mysql_query( $sql,$conn );
				$row=mysql_fetch_array($r);
				$ar=array("status"=>true,"like"=>true,"total"=>$row[0]);
		}
	}
	else
	{
		$quer="select * from likes where likeid='$lid'";
		$res=mysql_query($quer,$conn) or die(mysql_error());;
		if($rowl = mysql_fetch_array($res))
		{
			$query = "UPDATE answers SET total_likes = total_likes-1 WHERE ans_no=$no";
			mysql_query( $query,$conn );
			$s="delete from likes where likeid='$lid'";
			mysql_query( $s,$conn );
			$sql="select total_likes from answers where ans_no=$no";
			$r=mysql_query( $sql,$conn );
			$row=mysql_fetch_array($r);
			$ar=array("status"=>true,"like"=>false,"total"=>$row[0]);
		}
		else
		{
			$query = "UPDATE answers SET total_likes = total_likes+1 WHERE ans_no=$no";
				mysql_query( $query,$conn );
				$s="INSERT INTO likes (likeid,type,like_user,number) values ('$lid','$type','$user','$no')";
				mysql_query( $s,$conn );
				$sql="select total_likes from answers where ans_no=$no";
				$r=mysql_query( $sql,$conn );
				$row=mysql_fetch_array($r);
				$ar=array("status"=>true,"like"=>true,"total"=>$row[0]);
		}
	}
	echo json_encode($ar);
}
?>
