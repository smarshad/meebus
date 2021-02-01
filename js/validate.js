// JavaScript Document
function validate_search()
{

	
	var form=document.frm_search;
	var email=form.txt_email.value;
	var pass=document.getElementById('txt_pwd').value;
	
	if(email=='Enter your email address'){
		alert('Please Enter Your Email address');
		form.txt_email.focus();
		return false;		
	}
	if(!fnEmailCheck(email)){
			alert('Invalid Email Address');
			form.txt_email.focus();
			return false;
		}

	if(pass=='Enter your password'){
		alert('Please Enter Your Password');
		form.txt_pwd.focus();
		return false;
	}
	document.frm_search.action="login_pro.php";
document.frm_search.submit();	
return true;
	
}


function fnEmailCheck(str){
	var msg;
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if (!filter.test(str)){
		/*msg="Invalid Email Address";
		alert(msg);*/
		return false;
	}
	return true;
}

function nullcheck(fname,fldname,disname){
	ctrl_val=eval('document.'+fname+'.'+fldname+'.value');
	ctrl_name=eval('document.'+fname+'.'+fldname+'.name');
	if(Trim(ctrl_val)==''){	
		msg+="\n- "+disname+" field should not be blank";
		return false;
	}
	return true;
}

function select_nullcheck(fname,fldname,disname)
{
	ctrl_val=eval('document.'+fname+'.'+fldname+'.value');
	ctrl_name=eval('document.'+fname+'.'+fldname+'.name');
	disname = disname;
	if(ctrl_val=='')
	{

		msg+="\n- Please select "+disname;
		return false;
	}
		return true;
}

function LTrim(str){
	var whitespace = new String(" \t\n\r");
	var s = new String(str);
	if(whitespace.indexOf(s.charAt(0)) != -1){
	// We have a string with leading blank(s)...
		var j=0, i = s.length;
	// Iterate from the far left of string until we
	// don't have any more whitespace...
	while(j < i && whitespace.indexOf(s.charAt(j)) != -1)
		j++;
	// Get the substring from the first non-whitespace
	// character to the end of the string...
		s = s.substring(j, i);
	}
	return s;
}
	
function RTrim(str){
	// We don't want to trip JUST spaces, but also tabs,
	// line feeds, etc.  Add anything else you want to
	// "trim" here in Whitespace
	var whitespace = new String(" \t\n\r");	
	var s = new String(str);	
	if (whitespace.indexOf(s.charAt(s.length-1)) != -1) {
	// We have a string with trailing blank(s)...	
	var i = s.length - 1;       // Get length of string	
	// Iterate from the far right of string until we
	// don't have any more whitespace...
	while (i >= 0 && whitespace.indexOf(s.charAt(i)) != -1)
		i--;	
	// Get the substring from the front of the string to
	// where the last non-whitespace character is...
		s = s.substring(0, i+1);
	}
	return s;
}
	
function Trim(str){
	return RTrim(LTrim(str));
}



function blockNonNumbers(obj, e, allowDecimal, allowNegative){
	var key;
	var isCtrl = false;
	var keychar;
	var reg;
		
	if(window.event){
		key = e.keyCode;
		isCtrl = window.event.ctrlKey
	}else if(e.which){
		key = e.which;
		isCtrl = e.ctrlKey;
	}
		
	if (isNaN(key)) return true;
	keychar = String.fromCharCode(key);
	// check for backspace or delete, or if Ctrl was pressed
	if (key == 40 || key == 41 || key == 8 || isCtrl ){
		return true;
	}
	reg = /\d/;
	var isFirstN = allowNegative ? keychar == '-' && obj.value.indexOf('-') == -1 : false;
	var isFirstD = allowDecimal ? keychar == '.' && obj.value.indexOf('.') == -1 : false;
	return isFirstN || isFirstD || reg.test(keychar);
}


function num_check(){
	var img_no=document.imageno_form.val_num.value;
	if(img_no==""){
		alert("Please enter the number");
		return false;
	}
	if(img_no=="0"){
		alert("Please enter valid Number");
		return false;
	}
	return true;
}

function PopupPic(sPicURL){
	window.open("popupimg.php?"+sPicURL,"",  
	"resizable=yes,scrollbars=yes,HEIGHT=200,WIDTH=200");
}

function conPassword(argPwd,argConPwd){
	if(argPwd!=argConPwd){
		msg+="\n- Password and Confirm Password must be same";
		return false
	}
	return true
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




function validate_editprofile(usr_edit) 
{ 
	var form = document.usr_edit;
	var uname = form.uname.value;
	var uemail = form.uemail.value;
	var umob = form.umob.value;
	//var uocc = form.uocc.value;
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
	
	if(umob.length<10)
		{
			alert("Enter the 10 number");
			form.umob.focus();
			return false;
		}
		
/*	if(uocc=="")
	{
		alert("Enter the Occupation ");
		form.uocc.focus();
		return false;
		
	}*/
	
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


