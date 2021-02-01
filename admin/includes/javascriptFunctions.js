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
        window.location.href("http://www.w3schools.com");
		window.location.assign("logout.php");
    }
}


function nextWizard(id)
{
	
    if(id>1)
    {
    	var sal1=$("#sal1").val();
    	if(sal1=='')
    	{
    		alert("Please Select Contact Gender Title");
            return false;
        }
        var firstname=$("#firstname").val();
    	if(firstname=='')
    	{
    		alert("Please Enter Contact Person Firstname");
            return false;
        }
        var lastname=$("#lastname").val();
    	if (lastname == "" || !lastname)
		{
    		alert("Please Enter Contact Person Lastname");
            return false;
        }
        mobileno=$('#mobileno').val();
		if (mobileno == "" || !mobileno)
		{
			alert("Please Enter Contact Person Mobile Number");
			return false;
		}
        if(mobileno.length!=10)
        {
        	alert("Please Enter Contact Person Valid Mobile Number");
			return false;
        }
        ph_no=$('#ph_no').val();
		if (ph_no == "" || !ph_no)
		{
			alert("Please Enter Contact Person Phone Number");
			return false;
		}
        email=$('#email').val();
		if (email == "" || !email)
		{
			alert("Please Enter Contact Person Email");
			return false;
		}
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (reg.test(email) == false) 
        {
            alert("Invalid Contact Person Email Address");
            return false;
        }
        username=$('#username').val();
		if (username == "" || !username)
		{
			alert("Please Enter username");
			return false;
		}
		password=$('#password').val();
		if (password == "" || !password)
		{
			alert("Please Enter password");
			return false;
		}
        sal2=$('#sal2').val();
		if (sal2 == "" || !sal2)
		{
			alert("Please Select Reservation Contact Gender Title");
			return false;
		}
         var firstname1=$("#firstname1").val();
    	if(firstname1=='')
    	{
    		alert("Please Enter Reservation Contact  Firstname");
            return false;
        }
        var lastname1=$("#lastname1").val();
    	if (lastname1 == "" || !lastname1)
		{
    		alert("Please Enter Reservation Contact Lastname");
            return false;
        }
        mobileno1=$('#mobileno1').val();
		if (mobileno1 == "" || !mobileno1)
		{
			alert("Please Enter Reservation Contact Mobile Number");
			return false;
		}
        if(mobileno1.length!=10)
        {
        	alert("Please Enter Valid Reservation Contact Mobile Number");
			return false;
        }
        ph_no1=$('#ph_no1').val();
		if (ph_no1 == "" || !ph_no1)
		{
			alert("Please Enter Reservation Contact Phone Number");
			return false;
		}
        email1=$('#email1').val();
		if (email1 == "" || !email1)
		{
			alert("Please Enter Reservation Contact Email");
			return false;
		}
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (reg.test(email1) == false) 
        {
            alert("Invalid Reservation Contact  Email Address");
            return false;
        }
    }
    if(id>2)
    {
    	var sal3=$("#sal3").val();
    	if(sal3=='')
    	{
    		alert("Please Select Tour Type");
            return false;
        }
        hotel_style=$('#hotel_style').val();
		if (hotel_style == "" || !hotel_style)
		{
			alert("Please Select HotelStyle");
			return false;
		}
		country=$('#country').val();
		if (country == "" || !country)
		{
			alert("Please Select Country");
			return false;
		}
		city=$('#city').val();
		if (city == "" || !city)
		{
			alert("Please Enter City");
			return false;
		}
    }
   
    for(i=1; i<=6; i++)
	{
		$('#wizard-'+i).hide();	
		$("#step-"+i).removeClass("active");
		
	}
	
	$('#wizard-'+id).show();
	$("#step-"+id).addClass("active");
	return true;
}

function nextWizard1(id)
{
	if(id>1)
	{
		package_mode=$("input[name=package_mode]:checked").val();
		if ((package_mode == "" || !package_mode))
		{
			alert("Please Select Package Mode");
			return false;
		}	
		
		category=$('#sel_category').val();
		if (category == "" || !category)
		{
			alert("Please enter Category");
			return false;
		}
		
	package_title=$('#package_title').val();
		if (package_title == "" || !package_title)
		{
			alert("Please enter package title");
			return false;
		}
		
	origin=$('#origin').val();
		if (origin == "" || !origin)
		{
			alert("Please enter Destination");
			return false;
		}
		depart_from=$('#depart_from').val();
		if (depart_from == "" || !depart_from)
		{
			alert("Please enter Departure");
			return false;
		}
		
		valid_from=$('#valid_from').val();
		if (valid_from == "" || !valid_from)
		{
			alert("Please enter Valid From");
			return false;
		}
		valid_to=$('#valid_to').val();
		if (valid_to == "" || !valid_to)
		{
			alert("Please enter Valid To");
			return false;
		}
		description=$('#description').val();
		if (description == "" || !description)
		{
			alert("Please enter Description");
			return false;
		}
		highlight=$('#highlight').val();
		if (highlight == "" || !highlight)
		{
			alert("Please enter Highlight");
			return false;
		}
		iternery=$('#iternery').val();
		if (iternery == "" || !iternery)
		{
			alert("Please enter iternery");
			return false;
		}
		rules=$('#rules').val();
		if (rules == "" || !rules)
		{
			alert("Please enter rules");
			return false;
		}
		noofmembers=$('#noofmembers').val();
		if (noofmembers == "" || !noofmembers)
		{
			alert("Please enter no of members");
			return false;
		}		
	}
	if(id>2)
	{
		room_type=$('#room_type').val();
		if (room_type == "" || !room_type)
		{
			alert("Please Select Package Type");
			return false;
		}
		
		total_price=$('#total_price').val();
		if (total_price == "" || !total_price)
		{
			alert("Please Select Total price");
			return false;
		}
	}
	if(id>3)
	{
		agentcommission=$('#agentcommission').val();
		if (agentcommission == "" || !agentcommission)
		{
			alert("Please Enter Agentcommission");
			return false;
		}
		
		service_tax=$('#service_tax').val();
		if (service_tax == "" || !service_tax)
		{
			alert("Please Enter Goverment tax");
			return false;
		}
	
		email1=$('#email1').val();
		if (email1 == "" || !email1)
		{
			alert("Please Enter valid Email-id");
			return false;
		}
		contactnumber=$('#contactnumber').val();
		if (contactnumber == "")
		{
			alert("Please Enter Contactnumber");
			return false;
		}

		address=$('#address').val();
		if (address == "" || !address)
		{
			alert("Please Enter address ");
			return false;
		}
	}
	for(i=1; i<=4; i++)
	{
		$('#wizard-'+i).hide();	
		$("#step-"+i).removeClass("active");
		
	}
	
	$('#wizard-'+id).show();
	$("#step-"+id).addClass("active");
	return true;
}
function nextWizard2(id)
{
	for(i=1; i<=4; i++)
	{
		$('#wizard-'+i).hide();	
		$("#step-"+i).removeClass("active");
		
	}
	
	$('#wizard-'+id).show();
	$("#step-"+id).addClass("active");
	return true;
}