// JavaScript Document

function validate()
{
var form=document.frmreguser;
var name=form.txtname.value;
var gen=form.radgen;
var age=form.txtage.value;
var email=form.txtemail.value;
var pass=form.txtpwd.value;
var address=form.txtaddress1.value;
var mobile=form.txtmobile.value;
var state=form.txtstate.value;
var country=form.txtctry.value;
var code=form.code.value;
var cpass=form.txtcpwd.value;
var checked;

//////////////
if(name==''){
document.getElementById('txtname_err').style.display="block";
document.getElementById('txtname').focus();
return false;
}
else{
document.getElementById('txtname_err').style.display="none";
}
//////////

  for (var j=0; j<form.radgen.length; j++) 
  { 
    if(form.radgen[j].checked) { 
      checked = true;
      break; 
    } 
   }
   if(!checked){
	  document.getElementById('radgen_err').style.display="block";
	  document.getElementById('radgen').focus();
	  return false;
	  }
   else{
   document.getElementById('radgen_err').style.display="none";   
   }
///////////
if(age==''){
document.getElementById('txtage_err').style.display="block";
document.getElementById('txtage').focus();
return false;
}
else{
document.getElementById('txtage_err').style.display="none";
}
/////////
if(email==''){
document.getElementById('txtemail_err').style.display="block";
document.getElementById('txtemail').focus();
return false;
}
if(email!=''){
	var r=validate_email(form.txtemail);
	if(r){
	document.getElementById('txtemail_err').style.display="none";
	}
	else{
	document.getElementById('txtemail_err').style.display="block";
	document.getElementById('txtemail').focus();
	return false;
	}
}
////////
if(pass==''){
document.getElementById('txtpwd_err').style.display="block";
document.getElementById('txtpwd').focus();
return false;
}
else{
document.getElementById('txtpwd_err').style.display="none";
}
///////
if(cpass==''){
document.getElementById('txtcpwd_err').style.display="block";
document.getElementById('txtcpwd').focus();
return false;
}
else{
document.getElementById('txtcpwd_err').style.display="none";
}
///////
if(pass!='' && cpass!='')
{
	if(!pass.match(cpass)){
	document.getElementById('txtpwd_err').innerHTML="Your Passwords Doesnot Matched.";
	document.getElementById('txtcpwd_err').innerHTML="Your Passwords Doesnot Matched.";
	document.getElementById('txtpwd_err').style.display="block";
	document.getElementById('txtcpwd_err').style.display="block";
	document.getElementById('txtcpwd').focus();
	return false;
	}
	else{
	document.getElementById('txtpwd_err').style.display="none";
	document.getElementById('txtcpwd_err').style.display="none";	
	}
}

///////
if(address=='')
{
document.getElementById('txtaddress1_err').style.display="block";
document.getElementById('txtaddress1').focus();
return false;
}
else{
document.getElementById('txtaddress1_err').style.display="none";
}
///////
if(state==''){
document.getElementById('txtstate_err').style.display="block";
document.getElementById('txtstate').focus();
return false;
}
else{
document.getElementById('txtstate_err').style.display="none";
}
/////////
if(mobile==''){
document.getElementById('txtmobile_err').style.display="block";
document.getElementById('txtmobile').focus();
return false;
}
else{
document.getElementById('txtmobile_err').style.display="none";
}
/////////
if(code==''){
document.getElementById('code_err').style.display="block";
document.getElementById('code').focus();
return false;
}
else{
document.getElementById('code_err').style.display="none";
}

if(document.getElementById('chk').value ==1){
document.getElementById('code_err').style.display="none";
return true;
}
else{	
            document.getElementById('code_err').style.display="block";
			document.getElementById("code_err").innerHTML = "Please Enter Valid Captcha Code.";			
			document.getElementById('code').focus();
return false;
}
}

function NumbersOnly(evt,field)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;
    //var field=field."_err";
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	{
	
	    document.getElementById(field).style.display="block";
		return false;
	}
	else{
	     document.getElementById(field).style.display="none";
	     return true;
	}
}

function validate_email(field)
{
with (field)
  {
  apos=value.indexOf("@");
  dotpos=value.lastIndexOf(".");
  if (apos<1||dotpos-apos<2)
    {return false;}
  else {return true;}
  }
}


