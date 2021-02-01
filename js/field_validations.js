// JavaScript Document
function numbersonly(myfield, e, dec) {
  var key;
  var keychar;

  if (window.event)
    key = window.event.keyCode;
  else if (e)
    key = e.which;
  else
    return true;
  keychar = String.fromCharCode(key);

  // control keys
  if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
    return true;

  // numbers
  else if ((("0123456789").indexOf(keychar) > -1))
    return true;

  // decimal point jump
  else if (dec && (keychar == ".")) {
    myfield.form.elements[dec].focus();
    return false;
  } 
  else
    return false;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function get_val(str){
 str=str.replace(/^\s+/,"");
 return str.replace(/\s+$/,"");
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function assign_val(field){
	
var str=field.value.replace(/^\s+/," ");
 field.value=str.replace(/\s+$/," ");
}

function trim(str)
{
    if(!str || typeof str != 'string')
        return null;

    return str.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function chkemail_EXP(val){
	    var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		if (!filter.test(val)){	
			return false;
		}
		else{
			return true;
		}
}



function validate_policy(form)
{
	var service_provider = document.form.service_provider.value;
	var duration = document.form.duration.value;
	var time = document.form.time.value;
	var refund = document.form.refund.value;
	
	if(service_provider=="0")
	{
		alert("Select Service Provider Name");
		document.form.service_provider.focus();
		return false;
	}
	if(duration=="0")
	{
		alert("Select duration for Cancellation");
		document.form.duration.focus();
		return false;
	}
	if(time=="")
	{
		alert("Enter the time duration in hours");
		document.form.time.focus();
		return false;
	}
	if(isNaN(time))
	{
		alert("Enter numbers only");
		document.form.time.focus();
		return false;
	}
	if(refund=="")
	{
		alert("Enter the Refundable Amount in Percentage");
		document.form.refund.focus();
		return false;
	}
	if(isNaN(refund))
	{
		alert("Enter the Refundable Amount in Percentage");
		document.form.refund.focus();
		return false;
	}
	
	addpolicy();
	
}


function validate_policy1(form)
{
	var service_provider = document.form.service_provider.value;
	var duration = document.form.duration.value;
	var time = document.form.time.value;
	var refund = document.form.refund.value;
	
	if(service_provider=="0")
	{
		alert("Select Service Provider Name");
		document.form.service_provider.focus();
		return false;
	}
	if(duration=="0")
	{
		alert("Select duration for Cancellation");
		document.form.duration.focus();
		return false;
	}
	if(time=="")
	{
		alert("Enter the time duration in hours");
		document.form.time.focus();
		return false;
	}
	if(isNaN(time))
	{
		alert("Enter numbers only");
		document.form.time.focus();
		return false;
	}
	if(refund=="")
	{
		alert("Enter the Refundable Amount in Percentage");
		document.form.refund.focus();
		return false;
	}
	if(isNaN(refund))
	{
		alert("Enter the Refundable Amount in Percentage");
		document.form.refund.focus();
		return false;
	}
	
	return editpolicy();
	
}

function validate_seats()
{
	
	
	var total_seats = document.getElementById('total_seats').value;
	var boading_point = document.getElementById('boading_point').value;
	var ccount = document.getElementById('ccount').value;
	var arr=total_seats.split(",");
    var a=arr.length;
    var coun=(a-1);
	
	if(total_seats=="")
	{
		alert("Select seat No");
		document.getElementById('total_seats').focus();
		return false;
	}
	if(boading_point=="all")
	{
		alert("Select Boarding Point");
		document.getElementById('boading_point').focus();
		return false;
	}
	if(ccount!="")
	{
	if(ccount!=coun)
	{
		alert("Please Select "+ccount+" Seats");
		
		return false;
	}
	}
	
	return true;
	
}


function validate_booker(form)
{ 	

	var count = document.getElementById('seat_count').value;
  
	for(var i=1; i<=count; i++)
	{  
		var pas_name = "passname_"+i;  
		var pas_age = "age_"+i;
		var pass_name = document.getElementById(pas_name).value;
		var pass_age = document.getElementById(pas_age).value;
		
		if(pass_name=="")
		{
			alert("Enter the Passenger Name");
			document.getElementById(pas_name).focus();
			return false;
		}
		
		if(pass_age=="")
		{
			alert("Enter the Passenger Age");
			document.getElementById(pas_age).focus();
			return false;
		}
	}

	
	var booker_name = document.getElementById('booker_name').value;
	var email = document.getElementById('email').value;
	var address1 = document.getElementById('address1').value;
	var mobile = document.getElementById('mobile').value;
	var payment = document.getElementById('payment').value;
	
	var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	
	if(booker_name=="")
		{
			alert("Enter the Booker Name");
			document.getElementById('booker_name').focus();
			return false;
		}
	if(email=="")
		{
			alert("Enter the Email ID");
			document.getElementById('email').focus();
			return false;
		}
	if(!email.match(emailRegex))
		{
			alert("Enter the Valid Email ID");
			document.getElementById('email').focus();
			return false;
		}
	if(address1=="")
		{
			alert("Enter the Booker Address");
			document.getElementById('address1').focus();
			return false;
		}
	if(mobile=="")
		{
			alert("Enter the Booker Mobile / Telephone No");
			document.getElementById('mobile').focus();
			return false;
		}
	if(mobile.length<10)
		{
			alert("Enter the 10 number");
			document.getElementById('mobile').focus();
			return false;
		}
	if(payment=="")
		{
			alert("Select the Payment Type");
			document.getElementById('payment').focus();
			return false;
		}
	
	if(document.getElementById('check').checked==false)
		{
			alert("please choose the terms and conditions");
			document.getElementById('check').focus();
			return false;
		}
	
	return true;
}
	
//}



function validate_editprofile(usr_edit) 
{ 
	var form = document.usr_edit;
	var uname = form.uname.value;
	var uemail = form.uemail.value;
	var umob = form.umob.value;
	var uocc = form.uocc.value;
	var uadd1 = form.uadd1.value;
	var ucity1 = form.ucity1.value;
	var ustate1 = form.ustate1.value;
	var upin1 = form.upin1.value;
	
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	var camp = /^([a-zA-Z0-9_]+)$/; 
	
	
	if(uname=="")
	{
		alert("Enter the First Name");
		form.uname.focus();
		return false;
		
	}
	if(uname.length<5)
	{
		alert("Username should be more than 4 letters");
		form.uname.focus();
		return false;
		
	}
	if(!camp.test(uname))
	{
		alert("Invalid username. Use letters, numbers and underscore");
		form.uname.focus();
		return false;
		
	}
	
	if(uemail=="")
	{
		alert("Enter the Email Address ");
		form.uemail.focus();
		return false;
		
	}
	
	if(!uemail.match(emailRegex))
	{
		alert("Enter the Valid Email Address ");
		form.uemail.focus();
		return false;
		
	}

	if(umob=="")
		{
			alert("Enter the Booker Mobile / Telephone No");
			form.umob.focus();
			return false;
		}
	
	if(umob.length<13)
		{
			alert("Enter the 10 number");
			form.umob.focus();
			return false;
		}
		
	if(uocc=="")
	{
		alert("Enter the Occupation ");
		form.uocc.focus();
		return false;
		
	}
	
	if(uadd1=="")
		{
			alert("Enter the  Address");
			form.uadd1.focus();
			return false;
		}
		
	if(ucity1=="")
		{
			alert("Enter the City");
			form.ucity1.focus();
			return false;
		}
	
	if(ustate1=="")
		{
			alert("Enter the State");
			form.ustate1.focus();
			return false;
		}
		
	if(upin1=="")
		{
			alert("Enter the Pincode");
			form.upin1.focus();
			return false;
		}
		
	
	
	return true;
	
		
}
function validate_editlocation(usr_edit) 
{ 
	var form = document.usr_edit;
	var off_name = form.off_name.value;
	var address = form.address.value;
	var city = form.city.value;
	var ph_no = form.ph_no.value;
	var office_time = form.office_time.value;
	var contact_person = form.contact_person.value;
	
	
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	var camp = /^([a-zA-Z0-9_]+)$/; 
	
	
	if(off_name=="")
	{
		alert("Enter the Office Name");
		form.off_name.focus();
		return false;
		
	}
	
	
	
	if(address=="")
	{
		alert("Enter the Address ");
		form.address.focus();
		return false;
		
	}
	
	

	if(city=="")
		{
			alert("Enter the City");
			form.city.focus();
			return false;
		}
	
	if(ph_no=="")
		{
			alert("Enter the Mobile Number");
			form.ph_no.focus();
			return false;
		}
		
	if(office_time=="")
	{
		alert("Enter the office_time ");
		form.office_time.focus();
		return false;
		
	}
	
	if(contact_person=="")
		{
			alert("Enter the Contact_person");
			form.contact_person.focus();
			return false;
		}
		
	
		
	
	
	return true;
	
		
}


function validate_editcourier(usr_edit) 
{ 
	var form = document.usr_edit;
	var Shippername = form.Shippername.value;
	var Shipperphone = form.Shipperphone.value;
	var Receivername = form.Receivername.value;
	var Receiverphone = form.Receiverphone.value;
	var Weight = form.Weight.value;
	var Qnty = form.Qnty.value;
	
	
    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	var camp = /^([a-zA-Z0-9_]+)$/; 
	
	
	if(Shippername=="")
	{
		alert("Enter the Shippername");
		form.Shippername.focus();
		return false;
		
	}
	
	
	
	if(Shipperphone=="")
	{
		alert("Enter the Shipperphone ");
		form.Shipperphone.focus();
		return false;
		
	}
	
	

	if(Receivername=="")
		{
			alert("Enter the Receivername");
			form.Receivername.focus();
			return false;
		}
	
	if(Receiverphone=="")
		{
			alert("Enter the Receiverphone");
			form.Receiverphone.focus();
			return false;
		}
		
	if(Weight=="")
	{
		alert("Enter the Weight ");
		form.Weight.focus();
		return false;
		
	}
	
	if(Qnty=="")
		{
			alert("Enter the Qnty");
			form.Qnty.focus();
			return false;
		}
		
	
		
	
	
	return true;
	
		
}