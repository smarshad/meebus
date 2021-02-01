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


function capcha_val()
{				
	code = document.getElementById('code').value ;
	ajax();
	if (xmlhttp!=null)
	{
		xmlhttp.open("GET","code.php?code="+code,true);
		xmlhttp.onreadystatechange=code_return;
		xmlhttp.send(null);								 
		return false;
	}
	else
	{
		alert("Your browser does not support XMLHTTP.");
        return false;
	}				

}


function code_return()
{
	if(xmlhttp.readyState==4)
	{		var response = xmlhttp.responseText ;	
			if(xmlhttp.responseText == 1 )
			{
				document.getElementById('hid_code').value="1";	
			}
			else
			{		
			    document.getElementById('hid_code').value="0";
				alert('Enter Correct Captcha code');
			}
	}
}