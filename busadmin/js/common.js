// JavaScript Document
/************************************************** Ajax Object Creation *********************************************************/
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
/************************************************ Email Syntax ***************************************************************/
function EmailChecksyntax(str){
	var msg;
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if (!filter.test(str)){		
		return false;
	}
	else{
		return true;
	}
}
/************************************************ URL Syntax ***************************************************************/
function isUrl(s) {
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	return regexp.test(s);
}
/********************************************** Trim Values *****************************************************************/
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

function trim5( str ) {
    return str.replace( /^\s+|\s+$/g, '' );
}

function trim( str ) {
    return str.replace( /^\s+|\s+$/g, '' );
}
	
function Trim(id){
    var str=document.getElementById(id).value;
	document.getElementById(id).value=RTrim(LTrim(str));
}
/*************************************************** Show / Hide DIV **********************************************************/
function hideDIV(id,c){
	if(c==1)
	document.getElementById(id).innerHTML='';
	document.getElementById(id).style.display='none';	
}
function hideDIV2(sid,c){
	if(c==1)
	//alert(sid);
	//var id="'"+sid+"'";
	document.getElementById(sid).innerHTML='';
	document.getElementById(sid).style.display='none';	
}

function showDIV(id,errmsg,fs,sid){
	document.getElementById(id).style.display='block';
	if(errmsg!='')
	document.getElementById(id).innerHTML=errmsg;
	if(fs==1)
	//document.getElementById(id).focus();
	document.getElementById(sid).focus();
}

function showDIV2(id,errmsg,fs,sid){
	document.getElementById(id).style.display='block';
	if(errmsg!='')
	document.getElementById(id).innerHTML=errmsg;	
}

function showDIV3(id,errmsg,fs){
	document.getElementById(id).style.display='block';
	if(errmsg!='')
	document.getElementById(id).innerHTML=errmsg;	
}
/*************************************************** Get ID Value **************************************************************/
function getIDval(id){
	return document.getElementById(id).value;
}
/************************************************** Key Restictions ***********************************************************/
function alpha(e) {
var k;
document.all ? k = e.keyCode : k = e.which;
return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k==32);
}

function chkcode(e){
var k;
document.all ? k = e.keyCode : k = e.which;
return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || ( k > 48 && k <57 ));
}

function numbersonly(e){

	var unicode=e.charCode? e.charCode : e.keyCode

	if ((unicode!=8) || (unicode!=32)){ //if the key isn't the backspace key (which we should allow)

		if ((unicode<=47||unicode>=58) && (unicode!=8)) //if not a number

		return false //disable key press

	}

}

function checkIt(evt) 
{
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "This field accepts numbers only."
        return false
    }
    status = ""
    return true
}

function display_alert3()
{
	alert('You are trying to Delete Main Product Image.You can only Edit Main Product Image!!');
	return false;
}
