


$(init);
function init()
{
	$(".tab-button").removeClass("tab-button-focused");
		$("#sports").addClass("tab-button-focused");
	$(".profile_back").hide();
	$('#ques_background').hide();
	$('#sign_in_bg').hide();
	$('#sign_up_bg').hide();
	$('#answer_section').hide();
	$('#comment_section').hide();
	$('#sign_in').click(function(){
		$('#sign_in_bg').show(200);
	});
	$('#sign_up').click(function(){
		$('#sign_up_bg').show(200);
	});
	$('#sign_up_close').click(function(){
		$('#sign_up_bg').hide();
	});
	$('#sign_in_close').click(function(){
		$('#sign_in_bg').hide();
	});
	$('#ques_close').click(function(){
		$('#ques_background').hide();
	});
	$('#add_question').click(function(){
		$('#ques_background').show(200);
	});
	$('#show_answer').click(function(){
		$('#answer_section').slideToggle();
		
	});
	$('#show_comment').click(function(){
		$('#comment_section').slideToggle();
		
	});
	
	$("#username_new").blur(function(){
		
		valid_user(this);
	});
	$("#name").blur(function(){
		
		valid_user(this);
	});
	$("#new_password").blur(function(){
		
		valid_user(this);
	});
	$("#email").blur(function(){
		
		valid_user(this);
	});
	$('input').focus(function(){
		$(this).removeClass("error");
		$(this).addClass("focus");
	});
	$('input').blur(function(){
		$(this).removeClass("focus");
	});
	$('#sign_up_form').click(function(){
		form_validation();
	});
	$('#sign_in_form').click(function(){
		sign_in_form();
	});
	$('#submit_question').click(function(){
		question_form();
	});
	
	$.post('load_ques.php',{'category':'sports'},function(data){$("#questions_background").html(data);
		});
	$('#sports').click(function(){
		$.post('load_ques.php',{'category':'sports'},function(data){$("#questions_background").html(data);
		});
		$('#head-cat').html('cricket');
	});
	$('#health').click(function(){
		$.post('load_ques.php',{'category':'health'},function(data){$("#questions_background").html(data);
		});
		$('#head-cat').html('health');
	});
	$('#entertainment').click(function(){
		$.post('load_ques.php',{'category':'entertainment'},function(data){$("#questions_background").html(data);
		});
		$('#head-cat').html('entertainment');
	});
	$('#technology').click(function(){
		$.post('load_ques.php',{'category':'technology'},function(data){$("#questions_background").html(data);
		});
		$('#head-cat').html('technology');
	});
	$('#fashion').click(function(){
		$.post('load_ques.php',{'category':'fashion'},function(data){$("#questions_background").html(data);
		});
		$('#head-cat').html('fashion');
	});
	$('#business').click(function(){
		$.post('load_ques.php',{'category':'business'},function(data){$("#questions_background").html(data);
		});
		$('#head-cat').html('business');
	});
	$('#politics').click(function(){
		$.post('load_ques.php',{'category':'politics'},function(data){$("#questions_background").html(data);
		});
		$('#head-cat').html('politics');
	});
	$('#others').click(function(){
		$.post('load_ques.php',{'category':'other'},function(data){$("#questions_background").html(data);
		});
		$('#head-cat').html('others');
	});
	
	$(document).on('click','.total_ans',function(){
			id=$(this).attr('id');
			tid="#"+id+"answer_section";
			$.post('load_answer.php',{'ques_no':id},function(data){$(tid).html(data);
		});
	});
	$(document).on('click','.submit_answer',function(){
			id=$(this).attr('id');
			id= id.substring(0, id.indexOf('_'));
			ansid="#"+id+"_ques_content";	
			ans=$(ansid).val();
			span='#'+id+'span';
			
			if(ans.length<20)
				alert("Answer must be greater than 20 characters");
			else
			$.post('submit_ans.php',{'ques_no':id,'answer':ans},function(data){
			
			dat=JSON.parse(data);
			
			
			alert(dat.msg);
			$(span).html(dat.answers);
			$(ansid).val('');})
			
			
	});
	
	$("#view_by").click(function(){
		$.post('load_ques.php',{'view_by':$(this).val()},function(data){$("#questions_background").html(data);
		});
	});
	
	$('#more_option').hover(function(){
		
		$('#pop_up').toggleClass('show');
	});
	$('#pop_up').hover(function(){
		
		$('#pop_up').toggleClass('show');
	});
	
	
	
	$(document).on("click",".st_im",function(){
		$(".update_status").val('');
	});
	
	$(document).on("click",".close_profile",function(){
		$(".profile_back").hide();
	});
	$("#profile").click(function(){
		$(".profile_back").show();
		$.post('profile.php',function(data){$(".my_profile").html(data);
		});
	});
	
	
	$(document).on('click','.total_com',function(){
			id=$(this).attr('id');
			tid="#"+id+"_comments";
			$.post('load_comment.php',{'ans_no':id},function(data){$(tid).html(data);
		});
	});
	
	$(document).on('click','.submit_comment',function(){
			id=$(this).attr('id');
			id= id.substring(0, id.indexOf('_'));
			ansid="#"+id+"_comm_content";	
			ans=$(ansid).val();
			if(ans.length<5)
				alert("comment must be greater than 5 characters");
			else
			$.post('submit_comment.php',{'ans_no':id,'comment':ans},function(data){alert(data);$(ansid).val('');})
			
			
	});
	
	$('#notif').click(function(){
		$('.profile_back').show();
		$.post('notification.php',function(data){$(".my_profile").html(data);
		});
	});
	
	$(".tab-button").click(function(){
		$(".tab-button").removeClass("tab-button-focused");
		$(this).addClass("tab-button-focused");
	});
	
	
}
