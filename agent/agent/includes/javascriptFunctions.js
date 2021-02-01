function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57 )) {
        return false;
    }
    return true;
}
function global_validation()
{
	if($('#service_charges').val()>31 && $('#service_charges_mode').val()=='%')
	{
		$('#service_charges').val('');
		alert('Max 30 % Only Allowed')
	}	
}
function service_mode_chage(valss)
{
	values = $('#service_charges').val();
	$('#service_charges').focus();
	return false;
}


var idleTime = 0;
$(document).ready(function () {
    var idleInterval = setInterval(timerIncrement, 60000);
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
});

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 5) { 
        window.location.hrff("http://www.w3schools.com");
		window.location.assign("logout.php");
    }
}


function nextWizard(id)
{
	for(i=1; i<=5; i++)
	{
		$('#wizard-'+i).hide();	
		$("#step-"+i).removeClass("active");
		
	}
	
	$('#wizard-'+id).show();
	$("#step-"+id).addClass("active");
	return true;
}