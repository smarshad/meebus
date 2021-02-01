/* ---------------------------- */
/* XMLHTTPRequest Enable */
/* ---------------------------- */
function createObject() 
{
	var request_type;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer")
	{
		request_type = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		request_type = new XMLHttpRequest();
	}
	return request_type;
}

var http = createObject();

/* -------------------------- */
/* LOGIN */
/* -------------------------- */
/* Required: var nocache is a random number to add to request. This value solve an Internet Explorer cache issue */
var nocache = 0;

// Form Effects

//Login (form effect)
function fn_hide_email(){
	if($("#login_email").val() == "Enter your email address"){
		$("#login_email").val('');
	}
}

//Login (form effect)
function fn_show_email(){
	if($("#login_email").val() == ""){
		$("#login_email").val('Enter your email address');
	}
}

//Login (form effect)
function fn_hide_pwd(){
	if($("#login_pwd").val() == "Enter your password"){
		$("#login_pwd").val('');
	}
}

//Login (form effect)
function fn_show_pwd(){
	if($("#login_pwd").val() == ""){
		$("#login_pwd").val('Enter your password');
	}
}

//Forgot Password (form effect)
function fn_hide_femail(){
	if($("#txtemail").val() == "Enter your email address"){ 
		$("#txtemail").val(''); 
	}
}
				
//Forgot Password (form effect)
function fn_show_femail(){
	if($("#txtemail").val() == ""){
		$("#txtemail").val('Enter your email address');
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////


//redirect the page
function pgredir()
{
	window.location="index.php";
}


//Forgot password
function forgot()
{
	 
	
	var temail = document.getElementById("forgot_email").value;
	var nocahe = Math.random();
	alert(temail);
if(temail!="Enter your email address" || temail!="")
{
	//http.open('get','forgotpwd.php?temail='+temail+'&trole='+trole+'&nocache='+nocache);
	http.open('get','forgotpwd.php?temail='+temail+'&nocache='+nocache);	
	http.onreadystatechange = forgotReply;
	http.send(null);
}
else
{
	alert("Enter your email address");
	document.getElementById("forgot_email").focus();
	return false;
}

}

function forgotReply()
{
	if (http.readyState == 4)
	{
		var response = http.responseText;      
		if (response == 0)
		{
			document.getElementById("errmsg").innerHTML = "Please enter an email address..";
			document.getElementById("response").innerHTML = "";
		}
		else if (response == 1)
		{
			document.getElementById("errmsg").innerHTML = "";
			document.getElementById("response").innerHTML = "Password reset link has been sent to your mail.<br/> You will be redirected to home page within 5 seconds.";
			setTimeout("pgredir()", 5000);
			//setTimeout("pgredir()", 2000);
		}
		else if (response == 2)
		{
			document.getElementById("errmsg").innerHTML = "Email does not exist!.";
			document.getElementById("response").innerHTML = "";
		}
	}
}


//Reset Password
function resetpass()
{
	document.getElementById("errmsg").innerHTML = "";	
	document.getElementById("response").innerHTML = "Loading...";
	
	var npwd = encodeURI(document.getElementById("txtnpwd_7").value);
	var cpwd = encodeURI(document.getElementById("txtcpwd_7").value);
	var pcode = encodeURI(document.getElementById("txtpcode").value);
	var nocache = Math.random();

	http.open('get','resetpass.php?npwd='+npwd+'&cpwd='+cpwd+'&pcode='+pcode+'&nocache='+nocache);
	http.onreadystatechange = resetpassReply;
	http.send(null);
}

function resetpassReply()
{
	if (http.readyState == 4)
	{
		var response = http.responseText;
		//alert (response);
		if (response == 0)
		{
			document.getElementById("errmsg").innerHTML = "Please enter the passwords";
			document.getElementById("response").innerHTML = "";
		}	
		else if (response == 1)
		{
			document.getElementById("errmsg").innerHTML = "";
			document.getElementById("response").innerHTML = "Password has been reset successfully!. <br/> You will be redirected to home page within 5 seconds.";
			setTimeout("pgredir()", 5000);
		}
		else if (response == 2)
		{
			document.getElementById("errmsg").innerHTML = "New Password and Confirm Password are not match!";
			document.getElementById("response").innerHTML = "";
		}
		else if (response == 3)
		{
			document.getElementById("errmsg").innerHTML = "Please contact Admin.";
			document.getElementById("response").innerHTML = "";
		}
	}
}

//Agent Reset Password
function agresetpass()
{
	document.getElementById("errmsg").innerHTML = "";	
	document.getElementById("response").innerHTML = "Loading...";
	
	var npwd = encodeURI(document.getElementById("txtnpwd_7").value);
	var cpwd = encodeURI(document.getElementById("txtcpwd_7").value);
	var pcode = encodeURI(document.getElementById("txtpcode").value);
	var nocache = Math.random();

	http.open('get','agresetpass.php?npwd='+npwd+'&cpwd='+cpwd+'&pcode='+pcode+'&nocache='+nocache);
	http.onreadystatechange = agresetpassReply;
	http.send(null);
}

function agresetpassReply()
{
	if (http.readyState == 4)
	{
		var response = http.responseText;
		//alert (response);
		if (response == 0)
		{
			document.getElementById("errmsg").innerHTML = "Please enter the passwords";
			document.getElementById("response").innerHTML = "";
		}	
		else if (response == 1)
		{
			document.getElementById("errmsg").innerHTML = "";
			document.getElementById("response").innerHTML = "Password has been reset successfully!. <br/> You will be redirected to home page within 5 seconds.";
			setTimeout("pgredir()", 5000);
		}
		else if (response == 2)
		{
			document.getElementById("errmsg").innerHTML = "New Password and Confirm Password are not match!";
			document.getElementById("response").innerHTML = "";
		}
		else if (response == 3)
		{
			document.getElementById("errmsg").innerHTML = "Please contact Admin.";
			document.getElementById("response").innerHTML = "";
		}
	}
}


//Reset Password
function userchpass()
{
	document.getElementById("errmsg").innerHTML = "";	
	document.getElementById("response").innerHTML = "Loading...";
	
	var npwd = encodeURI(document.getElementById("txtnpwd_7").value);
	var cpwd = encodeURI(document.getElementById("txtcpwd_7").value);
	var uid = encodeURI(document.getElementById("txtuid").value);
	var nocache = Math.random();

	http.open('get','userchpass.php?npwd='+npwd+'&cpwd='+cpwd+'&uid='+uid+'&nocache='+nocache);
	http.onreadystatechange = userchpassReply;
	http.send(null);
}

function userchpassReply()
{
	if (http.readyState == 4)
	{
		var response = http.responseText;
		//alert (response);
		if (response == 0)
		{
			document.getElementById("errmsg").innerHTML = "Please enter the passwords";
			document.getElementById("response").innerHTML = "";
		}	
		else if (response == 1)
		{
			document.getElementById("errmsg").innerHTML = "";
			document.getElementById("response").innerHTML = "Password has been changed successfully!. <br/> You will be redirected to home page within 2 seconds.";
			setTimeout("pgredir()", 2000);
		}
		else if (response == 2)
		{
			document.getElementById("errmsg").innerHTML = "New Password and Confirm Password are not match!";
			document.getElementById("response").innerHTML = "";
		}
	}
}

//Agent Change Password
function agentchpass()
{
	document.getElementById("errmsg").innerHTML = "";	
	document.getElementById("response").innerHTML = "Loading...";
	
	var npwd = encodeURI(document.getElementById("txtnpwd_7").value);
	var cpwd = encodeURI(document.getElementById("txtcpwd_7").value);
	var aid = encodeURI(document.getElementById("txtaid").value);
	var nocache = Math.random();

	http.open('get','agchpass.php?npwd='+npwd+'&cpwd='+cpwd+'&aid='+aid+'&nocache='+nocache);
	http.onreadystatechange = agentchpassReply;
	http.send(null);
}

function agentchpassReply()
{
	if (http.readyState == 4)
	{
		var response = http.responseText;
		//alert (response);
		if (response == 0)
		{
			document.getElementById("errmsg").innerHTML = "Please enter the passwords";
			document.getElementById("response").innerHTML = "";
		}	
		else if (response == 1)
		{
			document.getElementById("errmsg").innerHTML = "";
			document.getElementById("response").innerHTML = "Password has been changed successfully!. <br/> You will be redirected to home page within 2 seconds.";
			setTimeout("pgredir()", 2000);
		}
		else if (response == 2)
		{
			document.getElementById("errmsg").innerHTML = "New Password and Confirm Password are not match!";
			document.getElementById("response").innerHTML = "";
		}
	}
}

//Agent Dropping Point
function dropmgmt(ctid,agid)
{
	var nocache = Math.random();

	http.open('get','drop.php?ctid='+ctid+'&agid='+agid+'&nocache='+nocache);
	http.onreadystatechange = dropmgmtReply;
	http.send(null);
}

function dropmgmtReply()
{
	if (http.readyState == 4)
	{
		var response = http.responseText;
		
		document.getElementById("drop").innerHTML = response;

	}
}

//Agent Delete Dropping Point
function deldrop(did,ctid,agid)
{
	var nocache = Math.random();
	
	http.open('get','deldrop.php?did='+did+'&ctid='+ctid+'&agid='+agid+'&nocache='+nocache);
	http.onreadystatechange = deldropReply;
	http.send(null);

}

function deldropReply()
{
	if (http.readyState == 4)
	{
		var response = http.responseText;
		document.getElementById("drop").innerHTML = response;
	}
}


//Agent Boarding Point
function boardmgmt(ctid,agid)
{
	var nocache = Math.random();

	http.open('get','board.php?ctid='+ctid+'&agid='+agid+'&nocache='+nocache);
	http.onreadystatechange = boardmgmtReply;
	http.send(null);
}

function boardmgmtReply()
{
	if (http.readyState == 4)
	{
		var response = http.responseText;
		//alert (response);
		
		document.getElementById("board").innerHTML = response;

	}
}

//Agent Delete Boarding Point
function delboard(bid,ctid,agid)
{
	var nocache = Math.random();
	
	http.open('get','delboard.php?bid='+bid+'&ctid='+ctid+'&agid='+agid+'&nocache='+nocache);
	http.onreadystatechange = delboardReply;
	http.send(null);

}

function delboardReply()
{
	if (http.readyState == 4)
	{
		var response = http.responseText;
		document.getElementById("board").innerHTML = response;
	}
}

function a1()
{
	var a = 1;
	return a;
}
function selectcity(ctid)
{
	alert (ctid);
	//alert (a1());
	/*if (ctid == 0)
	{
		document.getElementById("dselcity").innerHTML = "Please select the City";	
	}*/
}

//User Ticket Print
function print_ticket()
{
	var ticket = document.getElementById("txttick").value;
	var email  = document.getElementById("txtemail").value;
	if(ticket!='' && email!=''){
		if(fnEmailCheck(email)){
				http.open('get','dispticket.php?ticket='+ticket+'&email='+email+'&nocache='+nocache);
				http.onreadystatechange = print_ticketReply;
				http.send(null);
		}
		else{
		     document.getElementById("errmsg").innerHTML = "Please Enter Valid Email ID.";
		     document.getElementById("txtemail").focus();			
		}
	}
	else if (ticket == '' && email == ''){
		document.getElementById("errmsg").innerHTML = "Please Enter Ticket Number & Email ID.";
		document.getElementById("txttick").focus();		
	}
	else if(ticket == ''){
	    document.getElementById("errmsg").innerHTML = "Please Enter Ticket Number";
		document.getElementById("txttick").focus();	 
	}
	else if(email == ''){
		     document.getElementById("errmsg").innerHTML = "Please Enter Email ID.";
		     document.getElementById("txtemail").focus();		
	}
	else{
		document.getElementById("errmsg").innerHTML = "Please Enter Ticket Number & Email ID.";
		document.getElementById("txttick").focus();
	}

}
var cnt;
function print_ticketReply()
{
	if (http.readyState == 4)
	{
		var response = http.responseText;
		//alert(response);
		if (response == "we")
		{
			document.getElementById("disp_ticket").innerHTML ="";
			document.getElementById("errmsg").innerHTML = "Please enter the email id which was given at the time of booking.";
		}
		else if (response == "wt")
		{
			document.getElementById("disp_ticket").innerHTML ="";
			document.getElementById("errmsg").innerHTML = "Please enter the valid Ticket Number.";			
		}		
		else
		{
			document.getElementById("errmsg").innerHTML = "";
			var content=response.split("||");
			document.getElementById("disp_ticket").innerHTML = content[0];
			document.getElementById("hid_msg").innerHTML = content[1];
		}
	}
}

function print_pop(){
mywindow = window.open("msg.php", "mywindow", "menubar=0,resizable=1,width=500,height=500");
//mywindow.moveTo(0, 0);
}


function refund()
{
	var ticket = document.getElementById("txttick").value;
	var email  = document.getElementById("txtemail").value;
	if(ticket!='' && email!=''){
		if(fnEmailCheck(email)){
				http.open('get','refundstatus.php?ticket='+ticket+'&email='+email+'&nocache='+nocache);
				http.onreadystatechange = cancel_ticketReply;
				http.send(null);
		}
		else{
		     document.getElementById("errmsg").innerHTML = "Please Enter Valid Email ID.";
		     document.getElementById("txtemail").focus();			
		}
	}
	else if (ticket == '' && email == ''){
		document.getElementById("errmsg").innerHTML = "Please Enter Ticket Number & Email ID.";
		document.getElementById("txttick").focus();		
	}
	else if(ticket == ''){
	    document.getElementById("errmsg").innerHTML = "Please Enter Ticket Number";
		document.getElementById("txttick").focus();	 
	}
	else if(email == ''){
		     document.getElementById("errmsg").innerHTML = "Please Enter Email ID.";
		     document.getElementById("txtemail").focus();		
	}	
	else{
		document.getElementById("errmsg").innerHTML = "Please Enter Ticket Number & Email ID.";
		document.getElementById("txttick").focus();
	}

}
//User Ticket Cancellation
function cancel_ticket()
{
	var ticket = document.getElementById("txttick").value;
	var email  = document.getElementById("txtemail").value;
	if(ticket!='' && email!=''){
		if(fnEmailCheck(email)){
				http.open('get','ticket_cancel.php?ticket='+ticket+'&email='+email+'&nocache='+nocache);
				http.onreadystatechange = cancel_ticketReply;
				http.send(null);
		}
		else{
		     document.getElementById("errmsg").innerHTML = "Please Enter Valid Email ID.";
		     document.getElementById("txtemail").focus();			
		}
	}
	else if (ticket == '' && email == ''){
		document.getElementById("errmsg").innerHTML = "Please Enter Ticket Number & Email ID.";
		document.getElementById("txttick").focus();		
	}
	else if(ticket == ''){
	    document.getElementById("errmsg").innerHTML = "Please Enter Ticket Number";
		document.getElementById("txttick").focus();	 
	}
	else if(email == ''){
		     document.getElementById("errmsg").innerHTML = "Please Enter Email ID.";
		     document.getElementById("txtemail").focus();		
	}	
	else{
		document.getElementById("errmsg").innerHTML = "Please Enter Ticket Number & Email ID.";
		document.getElementById("txttick").focus();
	}

}

function cancel_ticketReply()
{
	if (http.readyState == 4)
	{
		var response = http.responseText;
		
		//alert(response) ;
		
		if (response == 0)
		{
			document.getElementById("disp_ticket").innerHTML ="";
			document.getElementById("errmsg").innerHTML = "Ticket Number does not exists!.";
		}
		else
		{
			//document.getElementById("fprintticket").style.display='none';
			document.getElementById("errmsg").innerHTML = "";
			document.getElementById("disp_ticket").innerHTML = response;
		}
	}
}


function printer_viewTicket(){
			var prtContent = document.getElementById("hid_msg");
            var WinPrint = document.getElementById("ifmPrintContents").contentWindow;
            WinPrint.document.open();
            WinPrint.document.write(prtContent.innerHTML);
			WinPrint.document.close();
			WinPrint.focus();
			WinPrint.print();			
			}

function gettocity(v){

	document.getElementById("tocity").innerHTML ="<img src='images/ajax-loader.gif' border='0'/>";
	http.open('get','includes/ajax/gettocity.php?fromcity='+v+'&nocache='+nocache);
	http.onreadystatechange = gettocityReply;
	http.send(null);	
}
function gettocityReply(){
	if (http.readyState == 4)
	{
	 var response = http.responseText; 
   	 document.getElementById("tocity").innerHTML =response;	 
	}	
}

function chkemail(email){
	if(email!=''){		
		if(EmailCheck(email)){	
		nocache=Math.random();
			http.open('get','includes/ajax/chkemail.php?email='+email+'&nocache='+nocache);
			http.onreadystatechange = chkemailReply;
			http.send(null);
		}
		else{
			 document.getElementById('txtemail_err').style.display="block";
	         document.getElementById('txtemail').focus();
		}
	}
}
function chkemailReply(){
	if (http.readyState == 4){
		var response = http.responseText;
		if (response == 0){
			document.getElementById('txtemail_err').style.display="block";
			document.getElementById("txtemail_err").innerHTML = "This Email Address already exist !.";
			document.getElementById('txtemail').focus();
			document.getElementById("email_suc").innerHTML = "";
		}
		else{
			document.getElementById('txtemail_err').style.display="none";	
			document.getElementById("email_suc").innerHTML = "This Email ID Availabel !!!.";
		}
	}	
}

function EmailCheck(str)
{
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if (!filter.test(str)){
		return false;
	}
	return true;
}

var d;

function chkcode(val){
	if(val!=''){				
			http.open('get','includes/ajax/chkcode.php?code='+val+'&nocache='+nocache);
			http.onreadystatechange = chkcodeReply;
			http.send(null);
	}	
}

function chkcodeReply(){
	if (http.readyState == 4){
		var response = http.responseText;
		if (response == 0){
			document.getElementById('chk').value='0';
		}
		else{				
			document.getElementById('chk').value='1';
		}
	}	
}

function seatlist(compid,busid,fromcity,tocity,traveldate){
	var url='includes/ajax/seat_list.php?compid='+compid+'&busid='+busid+'&fromcity='+fromcity+'&tocity='+tocity+'&traveldate='+traveldate+'&nocache='+nocache;	
	
	document.getElementById('test').innerHTML='<img src="images/ajax-loading-bar-blue.gif" border="0">';
			http.open('post',url);
			http.onreadystatechange = seatlistReply;
			http.send(null);
}
function seatlistReply(){
	if (http.readyState == 4){
		var response = http.responseText;
		//var content=response.split("||");
		document.getElementById('test').innerHTML=response;
		//document.getElementById('left').innerHTML=content[1];
	}	
}


function backresults(fromcity,tocity,traveldate){
	var url='includes/ajax/ajx_results.php?txt_from_city='+fromcity+'&txt_to_city='+tocity+'&journey_date='+traveldate+'&nocache='+nocache;
	document.getElementById('test').innerHTML='<img src="images/ajax-loading-bar-blue.gif" border="0">';
			http.open('post',url);
			http.onreadystatechange = backresultsReply;
			http.send(null);	
}

function backresultsReply(){
	if (http.readyState == 4){
		var response = http.responseText;
		document.getElementById('test').innerHTML=response;
	}
}

	function validate_seat()
	{
		var board_point = document.getElementById('bb').value;

		if(document.getElementById('ur_seats').value=='')
		{
		alert("Pleae select at least one seat");
		return false;			
		}
		else{	
			if(board_point == "")
			{
				alert("Pleae select a Boarding Point");
				document.getElementById('bb').focus();
				return false;
			}
		}
		getpassengerdetails_form(document.frm_seats);
		
		//return false;
		/*alert('Next Step is in Progress. It will shortly Finished.');
		return false;*/
/*		document.getElementById('frm_seats').submit();
		return true;*/return;
	}
	
var tot=0;
function getseats(val){	
var chkval=document.getElementById(val).value;	
var amt=parseInt(document.getElementById('fare').value);
if(document.getElementById(val).checked){
   document.getElementById('ur_seats').value+=chkval+",";
   tot=tot+amt;
}
else{
tot=tot-amt;

var arr=document.getElementById('ur_seats').value.split(",");

    for(var i=0; i<arr.length;i++ )
     { 
        if(arr[i]==chkval)
            arr.splice(i,1);
      } 
	  
	  document.getElementById('ur_seats').value=arr;      
	    
	if(tot<0){
	   tot=0;
	}
}
document.getElementById('tot_amt').value='Rs.'+tot;
}

function getpassengerdetails_form(form){

	var seats=document.getElementById('ur_seats').value.slice(0,-1);
	var boarding=document.getElementById('bb').value;
	var amt=document.getElementById('tot_amt').value;
	var from=document.getElementById('from_city').value;
	var to=document.getElementById('to_city').value;
	var traveldate=document.getElementById('travel_date').value;
	var busid=document.getElementById('bus_id').value;
    var compid=document.getElementById('comp_id').value;
	document.getElementById('test').innerHTML='<img src="images/ajax-loading-bar-blue.gif" border="0">';
	var url='includes/ajax/passenger_detail.php?from_city='+from+'&to_city='+to+'&journey_date='+traveldate+'&seats='+seats+'&boarding='+boarding+'&busid='+busid+'&compid='+compid+'&nocache='+nocache;

			http.open('post',url);
			http.onreadystatechange = getpassengerdetails_formReply;
			http.send(null);	
	
}

function getpassengerdetails_formReply(){
		if (http.readyState == 4){
			var response = http.responseText;		
			document.getElementById('test').innerHTML=response;
	    }
}


function validate_passdetail()
{
	var emsg = "error";
	var fnameRegxp 	= /^([a-zA-Z ]+[a-zA-Z ])$/;
	var fageRegxp 	= /^([1-9]{1,3})$/;
//	var fphRegxp 	= /^(\+\d)*\s*(\(\d{3}\)\s*)*\d{3}(-{0,1}|\s{0,1})\d{2}(-{0,1}|\s{0,1})\d{2}$/;
	var fphRegxp 	= /^([0-9]{1,10})$/;
//	var fmbRegxp 	= /^([\(]?[\+]?([0-9]{0,3})?[\)]?[\-\ ])?(([0-9]{0,5})[\-\ ])?([0-9]{6,10})$/;
	var femailRegxp	= /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
	var fpinRegxp 	= /^([0-9])$/;

	var tseats 	= document.getElementById("seat_count").value;
	var bkrname = document.getElementById("txt_booker_name").value;
	var phno 	= document.getElementById("txt_phone").value;
	var femail 	= document.getElementById("txt_email_id").value;
	var fpin 	= document.getElementById("txt_pin_code").value;
	var fpay 	= document.getElementById("selpayment").value;

	for (var i = 1; i <= tseats; i++)
	{
		var tcname = i+"txt_passenger[]";
		var tcage  = i+"txt_age[]";
		
		var tname = document.getElementById(tcname).value;
		var tage  = document.getElementById(tcage).value;
        
		if (fnameRegxp.test(tname) != true)
		{   
		    document.getElementById(tcname).focus();
			document.getElementById(tcname+"_err").innerHTML = "Please enter the valid Name";
			return false;
		}
		else if(fnameRegxp.test(tname) == true){			
			document.getElementById(tcname+"_err").innerHTML = "";
		}		
		else if (fageRegxp.test(tage) != true)
		{	 
		    document.getElementById(tcage).focus();
			document.getElementById(tcage+"_err").innerHTML = "Please enter the valid Age";	
			return false;
		}	
		else if(fnameRegxp.test(tage) == true){
			document.getElementById(tcage+"_err").innerHTML = "";
		}
	}

	if (fnameRegxp.test(bkrname) != true)
	{
		document.getElementById('txt_booker_name').focus();
		document.getElementById('txt_booker_name_err').innerHTML = "Please enter the Booker Name";		
		return false;
	}
	else {
		document.getElementById('txt_booker_name_err').innerHTML = "";
	}
	
	if ((fphRegxp.test(phno) != true) || (phno.length != 10))
	{
		document.getElementById('txt_phone').focus();
		document.getElementById("txt_phone_err").innerHTML = "Please enter the valid Phone / Mobile Number.";
		return false;
	}
	else{
		document.getElementById("txt_phone_err").innerHTML = "";
	}
	
	if (femailRegxp.test(femail) != true)
	{
		document.getElementById('txt_email_id').focus();
		document.getElementById("txt_email_id_err").innerHTML = "Please enter the valid Email Address";
		return false;
	}
	else{
		 document.getElementById("txt_email_id_err").innerHTML = "";
	}
	
	if (fpay == 0)
	{ 
	    document.getElementById('selpayment').focus();
		document.getElementById("selpayment_err").innerHTML = "Please select the Mode of Payment";		
		return false;
	}
	else
	{
		document.getElementById("selpayment_err").innerHTML = "";
		emsg = "success";
	}

	if (emsg == "success")
	{
		//document.getElementById("errmsg").innerHTML = "&nbsp;";
		return true;
	}
	return;
}


///////////////////////////////////////////////////  Booking Management //////////////////////////////////////////

function get_destination_points(t_id)
{ 
	    document.getElementById('loading').innerHTML = '<img src="images/ajax-loader.gif">';	
	    nocache = Math.random();
		http.open('get', 'js/ajax/gettocity.php?to_id='+t_id+'&nocache='+nocache);
		http.onreadystatechange = getbuslist_detination;
		http.send(null);
}


function getbuslist_detination(){
	if(http.readyState == 4)
      { //alert(http.responseText);
		var response = http.responseText;
		document.getElementById('gd').innerHTML = response;
		document.getElementById('loading').innerHTML ='';
	  }	
}


function available_buses(){  
	var arg1=document.getElementById('ter_from').value;
	var arg2=document.getElementById('ter_to').value;
	var dat=document.getElementById('datepicker').value;
	var service=document.getElementById('servicee').value;
	 if(arg1=="none")
		 {
			document.getElementById("errmsg").innerHTML = "Please select From City";
			document.getElementById('ter_from').focus();
			return false;
		 }
	else if(arg2=="none")
		 {
			document.getElementById("errmsg").innerHTML = "Please select To City";
			document.getElementById('ter_to').focus();
			return false;
		 }
	else if(dat=="Select Date" || dat == "" )
		 {
			document.getElementById("errmsg").innerHTML = "Please select the Journey Date";
			document.getElementById('datepicker').focus();
			return false;
		 }
	
}


function validate_booker(form)
{
	
	//alert("dadsa");	
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

			
		if(document.getElementById('check').checked==false)
		{
			alert("please choose the terms and conditions");
			document.getElementById('check').focus();
			return false;
		}
	
	return true;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function chk(theElement){
	var form=document.form;
     var theForm = theElement.form, z = 0;
	 for(z=0; z<theForm.length;z++){
      if(theForm[z].type == 'checkbox' && theForm[z].name != 'selectall'){
	  theForm[z].checked = theElement.checked;
	  
	  }
     }
if(document.getElementById('selectall').checked == true){
	document.getElementById('hc').value='1';
}
else
document.getElementById('hc').value='0';
}

function fun(id){
if(document.getElementById(id).checked == true){
	document.getElementById('hc').value='1';
}
else
document.getElementById('hc').value='0';
}

function cancel_validate(){
	var chks = document.getElementsByName('seatval[]');
    var hasChecked = false;
    for (var i = 0; i < chks.length; i++) {
        if (chks[i].checked) {
            hasChecked = true;
            break;
        }
    }
    if (hasChecked == false) {
        alert("Please select at least one.");
        return false;
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////