// JavaScript Document
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


var nocache = 0;

//Delete User
function check_SPname(sp_name)
{ 
		nocache = Math.random();
		http.open('get', 'sp_name.php?sp_name='+sp_name+'&nocache='+nocache);
		http.onreadystatechange = check_SPnameReply;
		http.send(null);
}

function check_SPnameReply()
{
	if(http.readyState == 4)
    {
        var response = http.responseText; alert(response);
        if(response == 0)
        {
            document.getElementById('errmsg').innerHTML = '<font color="green">Service Provider Name is Available...</font>';
            document.getElementById('spname').innerHTML = "";
          }
        else if(response == 1)
        {    
            document.getElementById('spname').innerHTML = '';
            document.getElementById('errmsg').innerHTML = '<font color="red">Service Provider Name alreadry exists...</font>';
			document.getElementById('spname').focus();
			//window.location.reload();
        }
    }
}
