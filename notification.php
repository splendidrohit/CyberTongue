<?php
	session_start();
	
			$conn=mysql_connect("localhost","root","");
			if (!$conn) {
						echo "Failed to connect to MySQL: " . mysql_error();
				}
			mysql_select_db("cyber_tongue");
			$userid=$_SESSION['user'];
			
			$sql="select on_tag as tag ,from_user as user,on_tag_no as on_tag_no,from_tag_no as from_tag_no,date_format(date_of_create,'%M %d , %Y') as date from notifications where to_user='$userid'";
			$result=mysql_query($sql,$conn);
			echo "<div class='notif_head'><h1 class='head_txt'>Notifications</h1></div>";
			
			$html='';
			while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
				$from=$row["user"];
				$tag=$row["tag"];
				$on_tag=$row["on_tag_no"];
				$from_tag=$row["from_tag_no"];
				$date=$row["date"];
				
				$sql="select name from user_information where user_name='$from'";
				$r=mysql_fetch_array(mysql_query($sql,$conn));
				$name=$r[0];
				
				$sql="select ques_body from questions where ques_no=$on_tag";
				$r=mysql_fetch_array(mysql_query($sql,$conn));
				$ques=$r[0];
				
				$sql="select ans_body from answers where ans_no=$from_tag";
				$r=mysql_fetch_array(mysql_query($sql,$conn));
				$ans=$r[0];
				if($tag=="follow")
					$text=" answered question you follow";
				else if($tag=="question")
					$text=" answer on your question";
				
				$html.="<div class='notif'>
					<span class='notif_name'>$name <a class='panel'>$text</a></span><span class='date_notif'>$date</span>
					<div><span class='notif_ques'>$ques</span></div>
					
				</div>";
				
			}
	$html.="<i class='close_profile'></i>";
	echo $html;
?>
