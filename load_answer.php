<?php
session_start();
$ques_no=$_POST['ques_no'];
$conn=mysql_connect("localhost","root","");
mysql_select_db("cyber_tongue");
$sql="select answers.ans_no as aid,date_format(answers.date_of_create,'%M %d , %Y') as date ,date_format(answers.date_of_create,'%r') as time,answers.total_likes as likes,answers.total_comments as total_comments,user_information.name as name,user_information.profile_pic as profile_pic,answers.ans_body as ans_body,user_information.status as status from user_information,answers where answers.ans_user=user_information.user_name and answers.ques_no='$ques_no' order by answers.total_likes desc";
$id=$ques_no.'_ques_content';
$bid=$ques_no.'_submit_ans';
if($_SESSION['user']!=NULL){
$html="
<div class='add_answer_back'>
	<textarea class='add_answer' placeholder='Write your answer here..' id=$id></textarea>
	<div class='submit_background_ans'><input class='submit_answer' type='submit' value='write answer' id=$bid></div>
</div>";}
else
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
$ans_body=$row["ans_body"];
$likes=$row["likes"];
$aid=$row['aid'];
$comment=$aid."_comments";
$total_comments=$row["total_comments"];
$iid=$aid.'_ans';
$lid="ans".$aid.$_SESSION['user'];
if(exist($lid,$conn))
	$class="<i class='logo liked'></i>";
else
	$class="<i class='logo'></i>";
$html.="
<div class='ans'>
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
					
						<div class='answer_body'>
							<a class='a_content'>
								$ans_body
							</a>
						</div>
					
						<div class='ques_info'>
							<span class='likes' id=$iid>$class<span>$likes</span></span>
							<div class='show_ans'>
								<a class='total_com' id=$aid><span>$total_comments</span> Comments</a>
							</div>
						</div>
					
						<div class='comment_section' id=$comment>
							
						</div>
</div>
";
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
?>					
