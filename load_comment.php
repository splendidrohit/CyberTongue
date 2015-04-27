<?php
	session_start();
	$ans_no=$_POST['ans_no'];
	$conn=mysql_connect("localhost","root","");
	mysql_select_db("cyber_tongue");
	$id=$ans_no.'_comm_content';
$bid=$ans_no.'_submit_comm';
	if($_SESSION['user']!=NULL){
$html="
<div class='add_comment_back'>
	<textarea class='add_comment' placeholder='Post comment here..' id=$id></textarea>
	<div class='submit_background_ans'><input class='submit_comment' type='submit' value='comment' id=$bid></div>
</div>";}
else
$html="";

$sql="select comments.com_no as cid,date_format(comments.date_of_create,'%M %d , %Y') as date ,user_information.name as name,comments.com_body as com_body from user_information,comments where comments.user=user_information.user_name and comments.ans_no='$ans_no' order by comments.date_of_create desc";
$result=mysql_query($sql,$conn);
	if(! $result )
	{
		die('Could not get data: ' . mysql_error());
	}
while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
	$name=$row["name"];
	$date=$row["date"];
	$com=$row["com_body"];
	$html.="
			<div class='comment'>
									<div class='user_info_c'>
										<div class='about'>
											<a class='name_c'>$name</a>
										</div>
										<div class='time_date_c'>
											<a class='date_c'>$date</a>
										</div>
									 </div>
									 
									 <div class='comment_body'>
											<a class='c_content'>
												$com
											</a>
									 </div>
			</div>";

}
	echo $html;
?>
