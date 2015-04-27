
function valid_user(elem)
{
	
	var x=$(elem).val();
	if(x.length<6)
	{
		$(elem).addClass('error');
	}
	
	
}

function form_validation()
{
	var username=$('#username_new').val();
	var name=$('#name').val();
	var password=$('#new_password').val();
	var confirm_password=$('#confirm_password').val();
	var email=$('#email').val();
	var gender=$('#gender').val();
	if(username.length<6 || name.length<6 || password.length<6 || email.length<6)
	{
		alert("Not Valid");
		return;
	}
	else if(password!=confirm_password)
	{
		alert("password not match");
		return;
	}
	else
	{
		$.post('signup.php',{'username':username,'password':password,'name':name,'email':email,'gender':gender},function(data){alert(data);});
		
		$('#sign_up_bg').hide();
	}
}

function sign_in_form()
{
	
	var username=$("#username").val();
	var password=$("#password").val();
	$.post('signin.php',{'username':username,'password':password},function(data){
		 dat=JSON.parse(data);
		
		if(dat.status==true)
		{
			$('#sign_in_bg').hide();
			window.location.replace("page.php");
		}
		alert(dat.message);
	});
}


function question_form()
{
	var anonymous=$('#anonymous').is(':checked');
	var question=$('#ques_body').val();
	var more=$('#more').val();
	var cat=$('#ques_category').val();
	if(question.length<15 || (more.length<15 && more.length>0))
	{
		alert('Length must be greater than 15');
		return ;
	}
	if(more.length==0)
		more=null;
	$.post('submit_ques.php',{'ques_body':question,'more':more,'category':cat,'anonymous':anonymous},function(data){
		 dat=JSON.parse(data);
		 $('#ques_body').val('');
		 $('#more').val('');
		 $('#ques_background').hide();
		alert(dat.msg);
	});
	
}


function readim(input)
{
	if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile_pic')
                    .attr('src', e.target.result)
                    .width(140)
                    .height(140);
            };

            reader.readAsDataURL(input.files[0]);
        }
    
}
