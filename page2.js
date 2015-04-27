$(page2);
function page2()
{
	//$('#news_section').hide();
	$('#more').hide();
	$('#elaborate').click(function(){
		$('#more').slideToggle(500);
	});
	
	
	$(document).on("click",".logo",function(){
		a=$(this).parents('.likes').attr('id');
		my='#'+a+' span';
		th=$(this);
		id= a.substring(0, a.indexOf('_'));
		st=a.substring(a.indexOf('_')+1,a.length);
			$.post('like.php',{'type':st,'no':id},function(data){
			dat=JSON.parse(data);
			if(dat.status==false)
			{
				alert("Please login first");
			}
			else
			{
				if(dat.like==true)
				{
					th.addClass('liked');
					$(my).html(dat.total);
				}
				else
				{
					th.removeClass('liked');
					$(my).html(dat.total);
				}
				
			}
		
		});
	});
	
	
	
	$(document).on("click",".foll",function(){
	
		a=$(this).parents('.follow').attr('id');
		my='#'+a+' span';
		th=$(this);
		id= a.substring(0, a.indexOf('_'));
		st=a.substring(a.indexOf('_')+1,a.length);
			$.post('follow.php',{'no':id},function(data){
			
			dat=JSON.parse(data);
			if(dat.status==false)
			{
				alert("Please login first");
			}
			else
			{
				if(dat.follow==true)
				{
					th.addClass('followed');
					$(my).html(dat.total);
				}
				else
				{
					th.removeClass('followed');
					$(my).html(dat.total);
				}
				
			}
		
		});
	});
	
	
	
	
	
	$(document).on('submit',"#update_prof_form",function(e) {
				e.preventDefault();
				
				$.ajax({
					url: "update.php", 
					type: "POST",             
					data: new FormData(this), 
					contentType: false,       
					cache: false,             
					processData:false,       
					success: function(data)   
					{
							$('.profile_back').hide();
							window.location.replace("page.php");
					}
				});
		});
}
