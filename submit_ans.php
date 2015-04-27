<?php
	session_start();
	
	$conn=mysql_connect("localhost","root","");
	if (!$conn) {
				echo "Failed to connect to MySQL: " . mysql_error();
		}
	mysql_select_db("cyber_tongue");
	$answer=$_POST['answer'];
	$ans_user=$_SESSION['user'];
	$ques_no=$_POST['ques_no'];
	$sql="select ques_user from questions where ques_no=$ques_no";
	$res = mysql_query($sql);
	$row= mysql_fetch_array($res);
	if($row[0]==$ans_user)
	{
		$msg= "You can't answer your own question";
		$sql = "select total_answers from questions WHERE ques_no=$ques_no";
	$res=mysql_query( $sql,$conn );
	$row= mysql_fetch_array($res);
	$ar=array('answers'=>$row[0],'msg'=>$msg);
	echo json_encode($ar);
		die();
	}
	$answer=mysql_real_escape_string($answer);
	$sql="INSERT INTO answers (ans_user,ans_body,ques_no) values ('$ans_user','$answer','$ques_no')";
	$retval = mysql_query( $sql,$conn );
	$query = "SHOW TABLE STATUS LIKE 'answers'";
	$result = mysql_query($query);
	$ans_tag = mysql_result($result, 0, 'Auto_increment');
	
	
	$query = "UPDATE questions SET total_answers = total_answers+1 WHERE ques_no=$ques_no";
	mysql_query( $query,$conn );
	
	$sql="select ques_user as to_user  from questions where ques_no=$ques_no";
	$res=mysql_query( $sql,$conn );
	$row= mysql_fetch_array($res,MYSQL_ASSOC);
	$to_user=$row["to_user"];
	$notif=$to_user."_".$ans_user."_ques_ans";
	$sql="INSERT INTO notifications (notif_id,on_tag,from_tag,to_user,from_user,on_tag_no,from_tag_no) values ('$notif','question','answer','$to_user','$ans_user','$ques_no','$ans_tag')";
	$res=mysql_query( $sql,$conn );
	
	
	$sql="select user from followers where ques_no=$ques_no";
	$res=mysql_query( $sql,$conn );
	while($row= mysql_fetch_array($res))
	{
		$user=$row[0];
		$notif=$user."_".$ans_user."_follow_ans";
		$sql="INSERT INTO notifications (notif_id,on_tag,from_tag,to_user,from_user,on_tag_no,from_tag_no) values ('$notif','follow','answer','$user','$ans_user','$ques_no','$ans_tag')";
		mysql_query( $sql,$conn );
	}
	$sql = "select total_answers from questions WHERE ques_no=$ques_no";
	$res=mysql_query( $sql,$conn );
	$row= mysql_fetch_array($res);
	$msg= "Answer Posted successfully";
	$ar=array('answers'=>$row[0],'msg'=>$msg);
	echo json_encode($ar);
?>
