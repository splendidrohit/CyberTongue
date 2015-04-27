<?php session_start();

if(!isset($_SESSION['user']))
	$_SESSION['user']=NULL;

	$_SESSION['category']='sports';

	$_SESSION['view_by']='recent';
if($_SESSION['user']!=NULL)
{
	$conn=mysql_connect("localhost","root","");
	if (!$conn) {
				echo "Failed to connect to MySQL: " . mysql_error();
		}
	mysql_select_db("cyber_tongue");
	$i=$_SESSION['user'];
	$quer="select profile_pic from user_information where user_name='$i'";
	$res=mysql_query($quer,$conn) or die(mysql_error());
	$rowl = mysql_fetch_array($res);
	$xx=$rowl[0];
}
	?>

<html lang="en">
	<head>
		<meta charset="utf-8">
		
		<link rel="stylesheet" href="page.css">
		<link rel="stylesheet" href="left.css">
		<link rel="stylesheet" href="extra.css">
		<link rel="stylesheet" href="notif.css">
		<link rel="stylesheet" href="back.css">
		<link rel="stylesheet" href="font/css/font-awesome.css">
		<link rel="stylesheet" href="page2.css">
		<link rel="stylesheet" href="profile.css">
		<link rel="stylesheet" href="ques_style.css">
		<script type='text/javascript' src='jquery.js'></script>
		<script type='text/javascript' src='page1.js'></script>
		<script type='text/javascript' src='page2.js'></script>
		<script type='text/javascript' src='valid.js'></script>
		<title>Welcome to cybertongue</title>
		
		
<script src="https://www.google.com/jsapi" type="text/javascript"></script>
    <script language="Javascript" type="text/javascript">
    
		    google.load('search', '1');
			
		    function OnLoad() {
		      
		      var searchControl = new google.search.SearchControl();

		      
		      var localSearch = new google.search.LocalSearch();
		      searchControl.addSearcher(localSearch);
		      
		      searchControl.addSearcher(new google.search.NewsSearch());
		      searchControl.draw(document.getElementById("news_section"));

		      
		     	searchControl.execute("sports");
		      
		      
		      $(".gsc-search-box").hide();
		      $(".gsc-resultsHeader").hide();
		      
		      $(document).on('click','.tab-button',function(){
		     	
		      	searchControl.execute($(this).attr('value'));
		      	
		      	
		      });
		      
		      $("#search-box").keydown(function(e){
					if(e.keyCode==13)
					{
						
						str=$("#search-box").val();
						val="search result for "+str;
						$('#head-cat').html(val);
						
						searchControl.execute(str);
						
							

					}
			});
		    }
		    google.setOnLoadCallback(OnLoad);
		    

    
    </script>
		
	</head>
	
	<body>
		<div class='top'>
			<a class='site_name' href='page.php'></a>
			<div class='search_background'>
				<input class='search' id='search-box' placeholder='Search for more news'>
					<i class='l im'></i>
				</input>
			</div>
			
			<div class='user_log'>
				<ui>
				<?php
					if($_SESSION['user']==NULL){
						echo"<li class='log_info  ' id='sign_in'><i class='l l1'></i>Sign In</li>
						<li class='log_info ' id='sign_up'><i class='l l2'></i>Sign Up</li>";
					}
					else
					{
						
						$name=$_SESSION['name'];
						echo"<li class='logged_user' id='myprofile'><img class='my_dp' src='$xx'>$name</img><i class='more_option' id='more_option'></i>
						<ul class='pop_up' id='pop_up'>
							<i class='popup'></i>
								<li><a class='pop_but' id='profile'><i class='p_im'></i>Profile</a></li>
								<li><a class='pop_but' id='notif'><i class='n_im'></i>Notifications</a></li>
								<li><a class='pop_but' href='logout.php' id='logout'><i class='l_im'></i>Logout</a></li>
							
						</ul>
						</li>";
					}
				?>	
				</ui>
			</div>
			
			<div class='add_question' id='add_question'>
				<i class='add_question_img' ></i><a>Add Question</a>
			</div>
			
		</div>
		
		<div class='middle'>
			
			<div class='left'>
			
				<div class='headlines_back'>
					<div class='head-cat-back'><span id='head-cat' class='head-cat'><? echo $_SESSION['category']; ?></span></div>
					<a class='headlines'> Spotlights</a>
				</div>	
				<marquee behavior="scroll" id='news_section' class='news_section' direction="up" onmouseover="this.stop();" onmouseout="this.start();">
					
				</marquee>
			
			</div>
			
			<div class='right'>
				<div class='ques'>
					<div class='tabs'>
						<div class='tab-button-background'>
							<div class='sort_info'>
								<span class='sort_heading'>View By : </span>
								<select id='view_by' class='sort_by'>
									<option value='recent'>Recent</option>
									<option value='most_upvoted'>Most Upvoted</option>
									<option value='unanswered'>Unanswered</option>
									<option value='most_followed'>Most Followed</option>
								</select>
							</div>
							<ui>
								<li class='tab-button' value='cricket' id='sports'>Sports</li>
								<li class='tab-button' value='bollywood' id='entertainment'>Entertainment</li>
								<li class='tab-button' value='health' id='health'>Health</li>
								<li class='tab-button' value='technology' id='technology'>Technology</li>
								<li class='tab-button' value='fashion' id='fashion'>Fashion</li>
								<li class='tab-button' value='stock market' id='business'>Business</li>
								<li class='tab-button' value='politics' id='politics'>Politics</li>
								<li class='tab-button' value='top news' id='others'>Other</li>
							</ui>
						</div>
						
						
						
						
						
						<div class='tab-ques-background' id='questions_background'>
						
						
						<h3>No Question Yet</h3>
						
						
						</div>
					</div>
				</div>
				
		</div>
		
		
		
		<div class='bg' id='sign_up_bg'>
	<div class='sign_up_background'>
		<div class='row'>
			<a class='close' id='sign_up_close'></a>
			<div class='heading_background'>
				<h1 class='heading'>Sign Up</h1>
			</div>
			
			
		</div>
		<div class='row'>
				<div class='inputs'>
					
						<i class='username_img_up username_img_u'></i>
						<input type='text' class='username_up' placeholder='Choose Username'  id='username_new'>
					
				</div>
				<div class='inputs'>
					
						<i class='username_img_up username_img_u' ></i>
						<input type='text' class='username_up' placeholder='Your Name' id='name'>
					
				</div>
				
				<div class='inputs'>
					
						<i class='username_img_up username_img_p'></i>
						<input type='password' class='username_up' placeholder='choose password'  id='new_password'>
					
				</div>
				<div class='inputs'>
					
						<i class='username_img_up username_img_p' ></i>
						<input type='password' class='username_up' placeholder='Confirm password' id='confirm_password'>
					
				</div>
				<div class='inputs'>
					
						<i class='username_img_up username_img_e'></i>
						<input type='email' class='username_up' placeholder='Email'  id='email'>
					
				</div>
				
				<div class='inputs'>
					
						<i class='username_img_up username_img_g'></i>
						<select class='username_up' style='width:25%;'  id='gender'>
							<option value='male'>Male</option>
							<option value='female'>Female</option>
						</select>
					
				</div>
				
				<div class='inputs'>
						<input type='submit' class='submit-btn up' id='sign_up_form' value='Sign Up'>
						
					
				</div>
		</div>
	</div>
	</div>
	
	
	<div class='bg' id='sign_in_bg'>
	<div class='sign_in_background'>
		<div class='row'>
			<a class='close' id='sign_in_close'></a>
			<div class='heading_background'>
				<h1 class='heading'>Login Here</h1>
			</div>
			
			
		</div>
		
		<div class='row'>
			<div class='sign_in-direct'>
				
				<div class='inputs'>
					
						<i class='username_img username_img_u'></i>
						<input type='text' class='username' placeholder='Username' id='username'>
					
				</div>
				
				<div class='inputs'>
					
						<i class='username_img username_img_p'></i>
						<input type='password' class='username' placeholder='password' id='password'>
					
				</div>
				<div class='inputs'>
					
						<label class='remember'>
						<input type='checkbox'>Remember me
						</label>
					
				</div>
				<div class='inputs'>
						<input type='submit' class='submit-btn' value='LOG IN' id='sign_in_form'>
						
					
				</div>
				<div class='inputs'>
						<a class='forgot_password'>Forgot Password?</a>
						
					
				</div>
			</div>
			
			<div class='sign_in_indirect'>
				<div class='services'>
					
						<label>Sign In with other services</label>
					
				</div>
				<a class='btn facebook'>
					<i class='img fb'></i>
					Sign in with Facebook
				</a>
				
				<a class='btn twitter'>
					<i class='img tw'></i>
					Sign in with Twitter
				</a>
				
				<a class='btn google'>
					<i class='img gw'></i>
					Sign in with Google
				</a>
			</div>
		</div>
	</div>
	</div>
		
		
		
		
	<div class='bg' id='ques_background'>
		<div class='ques_background'>
			<div class='close' id='ques_close'></div>
			<div class='info-background2'>
			<label class ='anonymous'><input  type='checkbox' style='cursor:pointer;' class='check' id='anonymous'>Be Anonymous</label>
			<div class='sort_info2'>
						<div class='sort_heading2'>Change Category </div>
						<select class='sort_by2' id='ques_category'>
							<option value='sports'>Sports</option>
							<option value='entertainment'>Entertainment</option>
							<option value='technology'>Technology</option>
							<option value='fashion'>Fashion</option>
							<option value='health'>Health</option>
							<option value='Business'>Business</option>
							<option value='politics'>Politics</option>
							<option value='other'>Other</option>
						</select>
			</div>
			</div>
			<div>
				<textarea class='ques_content' placeholder="Add your question here" id='ques_body'></textarea>
			</div>
			<div class='elaborate_back'>
				<a class='elaborate' >Elaborate More<i id='elaborate' class='el'></i></a>
				<div class='more' >
					<textarea class='ques_content' id='more' placeholder="Add Question Detail"></textarea>
				</div>
			</div>
			<div class='submit_background'>
				<input type='submit' value='Submit' class='submit' id='submit_question'></input>
			</div>
			
		</div>
		</div>	
		
		<?php 
				if($_SESSION['user']!=NULL)
				{
					echo"<div class='profile_back'>
						<div class='my_profile'>
							<img style='margin-top:30%;margin-left:30%;' src='images/wait.gif'>
						</div>
					</div>";
				}
			?>
		
	</body>
</html>
