$(document).ready(function(){
$('.menu ul li').hover(function() { 
$(this).children('.menu ul li ul').slideDown("fast");
$(this).addClass('active');
}, function(){
	$(this).children('.menu ul li ul').hide(100);
	$(this).removeClass('active');
});
  
//---------------------
	$(".link").click(function(){
 
	var id = this.id;
	$(".pop_up").hide();
	var popup = $("." + id);
	$(popup).fadeIn('fast');
	//$("." + id).fadeIn('slow');
	$('body').append('<div class="mask"></div>');
	$(".mask").fadeIn('slow');
	
//Set the center alignment padding + border see css style
	   var popMargTop = ($(popup).height() + 24) / 2;
	   var popMargLeft = ($(popup).width() + 24) / 2;
		
		$(popup).css({
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});	
		
		 $.post('send.php', function(data){
        $('.data').html(data);
   });	
	});
	
	$('.btn_close').click(function(){
		$(this).parent("div.pop_up").fadeOut('slow');
		$(".mask").fadeOut('slow');
		});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.btn_close').live('click', function() { 
	  $('#mask, .pop_up').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});  
  
                  
});