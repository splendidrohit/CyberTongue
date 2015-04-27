<?php
			session_start();
	
			$conn=mysql_connect("localhost","root","");
			if (!$conn) {
						echo "Failed to connect to MySQL: " . mysql_error();
				}
			mysql_select_db("cyber_tongue");
			$userid=$_SESSION['user'];
			$sql="select name as name,profile_pic as pic,status as status from user_information where user_name='$userid'";
			$retval = mysql_query( $sql,$conn );
			if(! $retval ) 
			{ 
				die('Could not enter data: ' . mysql_error()); 
			}
			if($row = mysql_fetch_array($retval,MYSQL_ASSOC))
			{
				$name=$row["name"];
				$pic=$row["pic"];
				$status=$row["status"];
			}
			
			echo"	<div class='edit_profile'>
				<form enctype='multipart/form-data' name='uploader' id='update_prof_form'>
				<div class='profile_pic_back'>
					<img class='profile_pic'  src=$pic>
						<input type='file' name='pic' accept='image/*' onchange='readim(this);' class='edit_pic'>
					</img>
				</div>
				<div class='your_info'>
					<div>
						<h3 class='your_name'>$name</h3>
					</div>
					
					<div class='my_status'>
						<i class='st_im'></i>
						<input name='status' class='update_status' placeholder='update your status' value=\"$status\">
					</div>
				</div>
				<div>
					<input type='submit' class='save_profile' value='save'>
				</div>
				</form>
				
				</div>
				<i class='close_profile'></i>
				";
				
?>
