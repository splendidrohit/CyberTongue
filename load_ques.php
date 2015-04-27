<?php
session_start();


if(isset($_POST['category']))
		{$category=$_POST['category'];
		$_SESSION['category']=$category;
		$view_by=$_SESSION['view_by'];
		}
	else if(isset($_POST['view_by']))
		{
		$category=$_SESSION['category'];
		$view_by=$_POST['view_by'];
		$_SESSION['view_by']=$view_by;
		}
$conn=mysql_connect("localhost","root","");
mysql_select_db("cyber_tongue");

if($view_by=='recent')
{
	$sql="select questions.ques_no as qid,date_format(questions.date_of_create,'%M %d , %Y') as date ,date_format(questions.date_of_create,'%r') as time,questions.total_likes as likes,questions.total_answers as total_answers,questions.total_followers as followers,user_information.name as name,user_information.profile_pic as profile_pic,user_information.status as status,questions.ques_body as ques_body,questions.ques_detail as ques_detail from questions,user_information where questions.ques_user=user_information.user_name and questions.category='$category' order by questions.date_of_create desc";
}
else if($view_by=='unanswered')
{
	$sql="select questions.ques_no as qid,date_format(questions.date_of_create,'%M %d , %Y') as date ,date_format(questions.date_of_create,'%r') as time,questions.total_likes as likes,questions.total_answers as total_answers,questions.total_followers as followers,user_information.name as name,user_information.profile_pic as profile_pic,user_information.status as status,questions.ques_body as ques_body,questions.ques_detail as ques_detail from questions,user_information where questions.ques_user=user_information.user_name and questions.category='$category' and questions.total_answers=0 order by questions.date_of_create desc";
}
else if($view_by=='most_upvoted')
{
	$sql="select questions.ques_no as qid,date_format(questions.date_of_create,'%M %d , %Y') as date ,date_format(questions.date_of_create,'%r') as time,questions.total_likes as likes,questions.total_answers as total_answers,questions.total_followers as followers,user_information.name as name,user_information.profile_pic as profile_pic,user_information.status as status,questions.ques_body as ques_body,questions.ques_detail as ques_detail from questions,user_information where questions.ques_user=user_information.user_name and questions.category='$category'  order by questions.total_likes desc";
}
else if($view_by=='most_followed')
{
	$sql="select questions.ques_no as qid,date_format(questions.date_of_create,'%M %d , %Y') as date ,date_format(questions.date_of_create,'%r') as time,questions.total_likes as likes,questions.total_answers as total_answers,questions.total_followers as followers,user_information.name as name,user_information.profile_pic as profile_pic,user_information.status as status,questions.ques_body as ques_body,questions.ques_detail as ques_detail from questions,user_information where questions.ques_user=user_information.user_name and questions.category='$category' order by questions.total_followers desc";
}
$html="";
$result=mysql_query($sql,$conn);
	if(! $result )
	{
		die('Could not get data: ' . mysql_error());
	}
while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
$profile_pic=$row["profile_pic"];
$name=$row["name"];
$status=$row["status"];
$date=$row["date"];
$time=$row["time"];
$ques_body=$row["ques_body"];
$likes=$row["likes"];
$ques_detail=$row['ques_detail'];
$followers=$row["followers"];
$total_answers=$row["total_answers"];
$qid=$row["qid"];
$ans=$qid."answer_section";
$iid=$qid.'_ques';
$iid2=$qid.'_ques1';
$t_ans=$qid.'span';
$lid="ques".$qid.$_SESSION['user'];
$fid=$qid.$_SESSION['user'];
if(exist($lid,$conn))
	$class="<i class='logo liked'></i>";
else
	$class="<i class='logo'></i>";
if(existf($fid,$conn))
	$class2="<i class='foll followed'></i>";
else
	$class2="<i class='foll'></i>";

$html.="
<div class='question_and_answer'>
					<div class='question_section'>
						<div class='user_info'>
							<img class='user-img' src=$profile_pic>
							<div class='about'>
								<a class='name'>$name</a>
								<span class='status'>$status</span>
							</div>
							<div class='time_date'>
								<a class='date'>$date</a>
								<time class='time'>$time</time>
							</div>
						
						</div>
					
						<div class='question_body'>
							<a class='q_content'>
								$ques_body
							</a>
							<a class='q_detail'>
								$ques_detail
							</a>
						</div>
					
						<div class='ques_info'>
							<span class='likes' id=$iid>$class<span>$likes</span></span>
							<div class=' follow' id=$iid2>$class2<span>$followers</span></div>
							<div class='show_ans'>
								<a class='total_ans' id=$qid><span id=$t_ans>$total_answers</span> Answers<i class='down'></i></a>
							</div>
						</div>
					
					
					</div>
				
					<div class='answer_section' id=$ans>
						
						
					</div>
					
							
</div>";

}
echo $html;

function exist($q,$con)
	{
	
		$quer="select * from likes where likeid='$q'";
		$res=mysql_query($quer,$con);
		if($row = mysql_fetch_array($res))
			return true;

		return false;
	}
	
function existf($q,$con)
	{
	
		$quer="select * from followers where follow_id='$q'";
		$res=mysql_query($quer,$con);
		if($row = mysql_fetch_array($res))
			return true;

		return false;
	}
?>					
						
						
					
