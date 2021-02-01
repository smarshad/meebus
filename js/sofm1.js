/*
AUTHOR  -  T.Salam
DATE    -  12-03-2009
DESC    -  Validation Script
TITLE   -  SOFM
	0 - No Validation
	1 - Not Empty Validation
	2 - Alphabetic Validation
	3 - Alphanumeric Validation(User Name validation)
	4 - Email Validation
	5 - Mobile Validation
	6 - Phone Validation
	7 - Password Validation
	8 - Image Type Validation(user defined)
	9 - Numeric Validation
   10 - Confirm Password and Confirm Email validation	
   11 - Custom Validation;   
*/

Class={
	explodeArray:function(item, delimiter){
		tempArray = new Array(1);
		var Count = 0;
		var tempString = new String(item);
		while (tempString.indexOf(delimiter)>0){
			tempArray[Count] = tempString.substr(0,tempString.indexOf(delimiter));
			tempString = tempString.substr(tempString.indexOf(delimiter)+1, tempString.length-tempString.indexOf(delimiter)+1);
			Count = Count+1
		}
		tempArray[Count] = tempString;
		return tempArray;
	},
	trim:function(name){
		return name.replace(/^\s+|\s+$/g, '');
	},
	checkType:function(id, label, exp, type, errorType, previousFieldId){
		switch(errorType){
		 case 1:
			 Class.emptyValidation(type, id, label, type);
			 break;
		 case 2:
			 Class.checkExp(id, exp, label);
			 break;
		 case 3:
			 Class.bothValidation(id, exp, label, type);
			 break;
		 case 5:
			 (Class.trim(document.getElementById(id).value)!='') ? Class.checkConfirm(id, previousFieldId, label): Class.emptyValidation(type, id, label, type);
			 break;
		}
	},	
	notEmptyValidation:function(type, id, label, errorType){	
		var exp = null;
		Class.checkType(id, label, exp, type, errorType);		
	},
	alphabeticValidation:function(type, id, label, errorType){	
		var exp = /^[a-zA-Z]+$/;
		Class.checkType(id, label, exp, type, errorType);		
	},
	alphanumericValidation:function(type, id, label, errorType){	
		var exp=new RegExp("^[a-zA-Z0-9]{6,30}$");
		Class.checkType(id, label, exp, type, errorType);		
	},
	emailAlphanumericValidation:function(type, id, label, errorType){	
		var exp=new RegExp("^[a-zA-Z.0-9]{3,30}$");
		Class.checkType(id, label, exp, type, errorType);		
	},
	emailValidation:function(type, id, label, errorType){
		//var exp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w\{2,3}+)*(\.\w{2,3})+$/;
		var exp = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		Class.checkType(id, label, exp, type, errorType);		
	},
	mobileValidation:function(type, id, label, errorType){		
		var exp=new RegExp("^([\+]?([0-9]{0,3}[-| |]))?([\+]?([0-9]{10,14}))?$");
		Class.checkType(id, label, exp, type, errorType);				
	},
	phoneValidation:function(type, id, label, errorType){		
		var exp=new RegExp("^([\(]?[\+]?([0-9]{0,3})?[\)]?[\-\ ])?(([0-9]{0,5})[\-\ ])?([0-9]{6,10})$");
		Class.checkType(id, label, exp, type, errorType);		
	},
	passwordValidation:function(type, id, label, errorType){	
		var exp=new RegExp("\^(?=.*[A-Za-z])(?=.*[0-9])(?=.*[\w_|@|#|!|$|%|^|&|*|(|)|+|.|,|-|:|;|\|`|~|'|+|<|>|]).{6,30}$");
		Class.checkType(id, label, exp, type, errorType);		
	},
	customValidation:function(type, id, label, exp, errorType){
		var exp=new RegExp(exp);
		Class.checkType(id, label, exp, type, errorType);	
	},
	imageTypeValidation:function(type, id, label, errorType){
		var exp = "^.+\.((jpg)|(gif)|(jpeg)|(png)|(JPG)|(GIF)|(PNG)|(JPEG))$";	
		Class.checkType(id, label, exp, type, errorType);		
	},
	imageFileValidation:function(type, id, label, formats, errorType){
		myArray = Class.explodeArray(formats, ',');	
		var length = myArray.length;
		var exp1 = "^.+\.(";			
		exp2=formats;
		exp3=")$";
		exp = exp1.concat(exp2, exp3);
		var exp=new RegExp(exp);
		Class.checkType(id, label, exp, type, errorType);		
	},
	numberValidation:function(type, id, label, errorType){
		var max = document.getElementById(id).maxLength;	
		var min = 1;
		//alert (max);
		var exp=new RegExp("^[0-9]{"+min+","+max+"}$"); 
		//var exp=new RegExp("^[0-9]{3,16}$"); 
		Class.checkType(id, label, exp, type, errorType);	
	},	
	confirmValidation:function(type, currentFieldId, currentLabel, previousFieldId, errorType){			
		var exp = null;	
		Class.checkType(currentFieldId, currentLabel, exp, type, 5, previousFieldId);
		
	},	
	
	radioButtonValidation:function(id, label){
		var checked = false;
		var names1 = document.getElementById(id).name;
		var x=document.getElementsByName(""+names1+"");
		for (var i=0; i<x.length; i++){
		    if (x[i].checked) {  
		    	checked = true; 
		    	break;  
		    }  
		} 
		(!checked) ? Class.messageValidation(label, 'basic'): Class.messageNoneValidation(label, 'basic');
	},
	textBoxValidation:function(id, label){
		(Class.trim(document.getElementById(id).value) == '') ? Class.messageValidation(label, 'basic'): Class.messageNoneValidation(label, 'basic');		
	},
	emptyValidation: function(type, id, label){
		(type == '3') ? Class.radioButtonValidation(id, label): Class.textBoxValidation(id, label);		
	},
	checkExp:function(id, exp, label){
		((document.getElementById(id).value).match(exp)) ? Class.messageNoneValidation(label, 'adv'): Class.messageValidation(label, 'adv');
	},
	bothValidation:function(id, exp, label, type){
		(Class.trim(document.getElementById(id).value) == '') ? Class.emptyValidation(type, id, label): Class.checkExp(id, exp, label);		
	},
	checkConfirm:function(currentFieldId, previousFieldId, currentLabel){	
		(document.getElementById(currentFieldId).value == document.getElementById(previousFieldId).value) ? Class.messageNoneValidation(currentLabel, 'adv'): Class.messageValidation(currentLabel, 'adv');	
		
	},
	findType:function(type){
		if(type == 'text')
			type = '0';
		else if(type == 'password')
			type = '0';
		else if(type == 'select-one')
			type = '1';
		else if(type == 'file')
			type = '2';
		else if(type == 'radio')
			type = '3';
		return type;
	},
	messageValidation:function(label, msg){
		Class.messageDisableValidation(label, msg);
		document.getElementById(""+label+"_"+msg+"").style.display = 'block';
		errMsg = 'failed';
	},
	messageNoneValidation:function(label, msg){
		Class.messageDisableValidation(label, msg);
		document.getElementById(""+label+"_"+msg+"").style.display = 'none';
	},
	messageDisableValidation:function(label, msg){
		var x=document.getElementsByName(""+label+"_basic").length;	
		var y=document.getElementsByName(""+label+"_adv").length;
		if(msg == 'adv'){			
			if(x!=0){
				document.getElementById(""+label+"_basic").style.display = 'none';	
			}
		}	
		else if(msg == 'basic'){			
			if(y!=0){
				document.getElementById(""+label+"_adv").style.display = 'none';
			}
		}	
	},countryDropDown:function(){
		var states = new Array("Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burma", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo, Democratic Republic", "Congo, Republic of the", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Greenland", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, North", "Korea, South", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Mongolia", "Morocco", "Monaco", "Mozambique", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Norway", "Oman", "Pakistan", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Samoa", "San Marino", " Sao Tome", "Saudi Arabia", "Senegal", "Serbia and Montenegro", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe");
		return states;
	}
}
/*
 * NAME      -	function valForm()
 * PARAM     -	name
 * DESC      -	this function is used for submit the form
*/
function callSofm(name){	
	errMsg='success';		
	var length = name.elements.length;
	var type;
	var myArray;
	var myArray2;
	
	for(i=0; i<=length-1; i++){
		var errorType;
		myArray = Class.explodeArray(name.elements[i].id, '_');	
	
		type = name.elements[i].type;
		if((document.getElementById(""+myArray[0]+"_basic")) && (document.getElementById(""+myArray[0]+"_adv") == null)){
			errorType = 1;
		}
		else if((document.getElementById(""+myArray[0]+"_adv")) && (document.getElementById(""+myArray[0]+"_basic") == null)){			
			errorType = 2;
		}
		else if((document.getElementById(""+myArray[0]+"_adv")) && (document.getElementById(""+myArray[0]+"_basic"))){
			errorType = 3;
		}
		else if((document.getElementById(""+myArray[0]+"_adv")==null) && (document.getElementById(""+myArray[0]+"_basic") ==null)){
			errorType = 4;
		}
		type = Class.findType(type);
		switch(myArray[1]){
			case '1':	
				Class.notEmptyValidation(type, name.elements[i].id, myArray[0], errorType);	
			break;
			case '2':
				Class.alphabeticValidation(type, name.elements[i].id, myArray[0], errorType);				
			break;
			case '3':
				Class.alphanumericValidation(type, name.elements[i].id, myArray[0], errorType);
			break;
			case '4':
				Class.emailValidation(type, name.elements[i].id, myArray[0], errorType);
			break;
			case '5':
				Class.mobileValidation(type, name.elements[i].id, myArray[0], errorType);
			break;
			case '6':
				Class.phoneValidation(type, name.elements[i].id, myArray[0], errorType);
			break;
			case '7':
				Class.passwordValidation(type, name.elements[i].id, myArray[0], errorType);
			break;
			case '8':
				Class.imageFileValidation(type, name.elements[i].id, myArray[0], myArray[2], errorType);
			break;			
			case '9':
				//Class.numberValidation(type, name.elements[i].id, myArray[0], myArray[2], errorType);
				Class.numberValidation(type, name.elements[i].id, myArray[0], errorType);	
			break;
			case '10':
				myArray2 = Class.explodeArray(name.elements[i-1].id, '_');
				Class.confirmValidation(type, name.elements[i].id, myArray[0], name.elements[i-1].id, myArray2[0], errorType);
			break;	
			case '11':	
				Class.customValidation(type, name.elements[i].id, myArray[0], myArray[2], errorType);
			break;	
			case '12':
				Class.emailAlphanumericValidation(type, name.elements[i].id, myArray[0], errorType);
			break;
			
		}
	}


	if(errMsg == 'success'){ 	
	//	reguser();
		return true;
	}else{ 
		return false;
	}	
}

function resetSofm(name){
	var length = name.elements.length;
	
	var type;
	var myArray;
	name.reset();
	for(i=0; i<=length-1; i++){
		myArray = Class.explodeArray(name.elements[i].id, '_');	
		if(document.getElementById(""+myArray[0]+"_basic")){
			document.getElementById(""+myArray[0]+"_basic").style.display = 'none';
		}
		if(document.getElementById(""+myArray[0]+"_adv")){
			document.getElementById(""+myArray[0]+"_adv").style.display = 'none';
		}
	}
	return false;
}

/*function selectcity(ctid)
{
	alert (ctid);
	if (ctid == 0)
	{
		document.getElementById("txtcity").style.display = 'block';
		errMsg = 'failed';
		return false;
	{
	else
	{
		document.getElementById("txtcity").style.display = 'none';
		return true;		
	}

}*/