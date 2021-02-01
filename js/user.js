// JavaScript Document

var xmlhttp;

xmlhttp=null;

function ajax() 
{
	if (window.XMLHttpRequest) 
    { 
     
    	xmlhttp = new XMLHttpRequest();
            
		if (xmlhttp.overrideMimeType) 
    	{
           
    		xmlhttp.overrideMimeType('text/xml');
             
    	}

    } 
     
	 else if (window.ActiveXObject) 
     { 
     try {
          xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
          } 
		  
          catch (e) 
          {
                try {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    } 
                catch (e) {}
            }
    }    
	  
}

function forgot()
{
	var fmail = document.getElementById('forgot_email').value;
	if(fmail=='' || fmail=='Enter your email address'){
		alert('Enter Email Address');
		document.getElementById('forgot_email').focus();
		return false;
	}
	if(!fnEmailCheck(fmail)){
		alert('Enter Valid Email Address');
		document.getElementById('forgot_email').focus();
		   return false;
	}

    ajax();

	if (xmlhttp != null)
	{
      var nocache=Math.random();
	  document.getElementById('fmail_msg').innerHTML ="<img src='images/ajax-loader.gif'>";
		xmlhttp.onreadystatechange=fmail_return;
		xmlhttp.open("GET","fmail.php?fmail="+fmail+"&nocache="+nocache,true);
		xmlhttp.send(null);								 
		return false;
	}
	else
	{
		alert("Your browser does not support XMLHTTP.");
	}				

}


function fmail_return()
{
	if(xmlhttp.readyState==4)
	{		
		if(xmlhttp.status==200)
		{
			document.getElementById('fmail_msg').innerHTML = "<br>"+xmlhttp.responseText;
			/*if(xmlhttp.responseText == 1)
			{
				document.getElementById('fmail_msg').innerHTML = "<br><strong><font color='green'>Password Mail Sent Succeffully!</font></strong> " ; 							
			}
			else if(xmlhttp.responseText == 2)
			{		
				document.getElementById('fmail_msg').innerHTML = "<br><strong><font color='red'>Mail Not Sent. Please Try Again  !!!</font></strong>" ; 					
			}
			else if(xmlhttp.responseText == 3)
			{		
				document.getElementById('fmail_msg').innerHTML = "<br><strong><font color='red'>Please Active Your Account!!</font></strong> " ; 					
			}
			else
			{	
				document.getElementById('fmail_msg').innerHTML = "<br><strong><font color='red'>Mail does not Exists!!</font></strong> " ; 	
			}*/
		}

		else
		{
         alert("Problem Occured when Retrieving Data");
		}
	}
}


function change_pass()
{
	var oldp  =  document.getElementById('oldpwd').value ; 
	
	var newp  =  document.getElementById('newpwd').value ; 
	
	var newcp =  document.getElementById('cnewpwd').value ; 
	

	if(oldp == '' || oldp == null)
	{
		document.getElementById('oldpwd').focus();
		document.getElementById('txtopwd').innerHTML = "<strong><font color='red'>Please Enter Your Current Password!!!</font></strong>" ;
		return false ;
	}
	else if(newp == '' || newp == null)
	{
		document.getElementById('txtopwd').innerHTML = "" ;
		document.getElementById('newpwd').focus();
		document.getElementById('txtnpwd').innerHTML = "<strong><font color='red'>Please Enter Your New Password!!!</font></strong>" ;
		return false ;
	}
	else if(newcp == '' || newcp == null)
	{
		document.getElementById('txtnpwd').innerHTML = "" ;
		document.getElementById('cnewpwd').focus();
		document.getElementById('txtcpwd').innerHTML = "<strong><font color='red'>Please Enter Your New Confirm Password!!!</font></strong>" ;
		return false ;
	}
	else if(!newp.match(newcp)){ 
		document.getElementById('txtcpwd').innerHTML = "<strong><font color='red'>Your Passwords Doesnot Match.</font></strong>" ;
		document.getElementById('cnewpwd').focus();
		return false;
	}
	else
	{
		document.getElementById('txtcpwd').innerHTML = "";
		ajax() ;
		
		var tot = oldp+'^^'+newp ;
		
		if (xmlhttp != null)
		{
	
			xmlhttp.onreadystatechange=chgpass_return;
	
			xmlhttp.open("GET","forpass.php?tot="+tot,true);
	
			xmlhttp.send(null);
									 
			return false;
	
		}
	
		else
		{
	
			alert("Your browser does not support XMLHTTP.");
	
		}			
	}
}


function chgpass_return()
{

	if(xmlhttp.readyState==4)
	{
		
		//alert(xmlhttp.responseText) ;
				
		if(xmlhttp.status==200)
		{
						
			if(xmlhttp.responseText == 1)
			{
				//window.location.refresh() ;
				document.getElementById('txtopwd').innerHTML = '' ;
				document.getElementById('txtnpwd').innerHTML = '' ;
				document.getElementById('txtcpwd').innerHTML = '' ;
				
				document.getElementById('oldpwd').value = '' ;
	
				document.getElementById('newpwd').value = '' ;
	
				document.getElementById('cnewpwd').value = '' ;
				
				document.getElementById('cpass_msg').innerHTML = "<strong><font color='green'>Password Change Succeffully!</font></strong> " ; 							
			}
			else if(xmlhttp.responseText == 2)
			{		
				document.getElementById('txtopwd').innerHTML = '' ;
				document.getElementById('txtnpwd').innerHTML = '' ;
				document.getElementById('txtcpwd').innerHTML = '' ;
				document.getElementById('txtcpwd').innerHTML = '' ;
				document.getElementById('cpass_msg').innerHTML = "<strong><font color='red'>Password doesnt Changed</font></strong>" ; 					
			}
			else
			{		
			//	window.location.refresh() ;		
				document.getElementById('txtopwd').innerHTML = '' ;
				document.getElementById('txtnpwd').innerHTML = '' ;
				document.getElementById('txtcpwd').innerHTML = '' ;
				document.getElementById('txtcpwd').innerHTML = '' ;
				document.getElementById('cpass_msg').innerHTML = "<strong><font color='red'>Enter Correct Password!!</font></strong> " ; 	
			}
		}

		else
		{

			alert("Problem Occured when Retrieving Data");

		}

	}

}