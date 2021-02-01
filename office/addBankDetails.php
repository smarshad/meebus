<?php include("includes/header.php"); ?>
<?php
     if(isset($_REQUEST['submitacdetails'])){
	    $bankname=mysql_real_escape_string($_POST['bankname']);
		$bankAC=mysql_real_escape_string($_POST['bank_ac']);
		$ACtype=mysql_real_escape_string($_POST['ac_type']);
		$email=mysql_real_escape_string($_POST['email']);
		$ACdesc=mysql_real_escape_string($_POST['ac_desc']);
		$ins_sql=mysql_query("INSERT INTO bank_details (BankName,BankAC_No,AC_type,BankEmail,BankDesc,dateAdded,status) VALUES ('".$bankname."','".$bankAC."','".$ACtype."','".$email."','".$ACdesc."',CURDATE(),1)") or die(mysql_error());
		echo "<span class='suc_msg'>Inserted.</span>";
	 }
?>
<script type="text/javascript">
function LTrim(str,id){
	var whitespace = new String(" \t\n\r");
	var s = new String(str);
	if(whitespace.indexOf(s.charAt(0)) != -1){
		var j=0, i = s.length;
	while(j < i && whitespace.indexOf(s.charAt(j)) != -1)
		j++;
		s = s.substring(j, i);
	}
	document.getElementById(id).value=s;
}

function fnEmailCheck(str){
	var msg;
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if (!filter.test(str)){
		return false;
	}
	return true;
}

function validate_bankdetails(){
 var form=document.bankform;
 var bankname=form.bankname.value;
 var bankAC=form.bank_ac.value;
 var ACtype=form.ac_type.value;
 var ACdesc=form.ac_desc.value;
 var email=form.email.value;
 
 if(bankname==''){
	document.getElementById('bankname_err').innerHTML="<span class='err_msg'>Please enter bank name.</span>";
	form.bankname.focus();
	return false;
 }
 else{
 document.getElementById('bankname_err').innerHTML="";
 }
 if(bankAC==''){
    document.getElementById('bank_ac_err').innerHTML="<span class='err_msg'>Please enter your bank account number.</span>";
	form.bank_ac.focus();
	return false; 
 }
 else{
 document.getElementById('bank_ac_err').innerHTML="";
 }  
 if(ACtype==''){
    document.getElementById('ac_type_err').innerHTML="<span class='err_msg'>Please enter your bank account type.</span>";
	form.ac_type.focus();
	return false; 
 } 
 else{
 document.getElementById('ac_type_err').innerHTML="";
 } 
 if(email==''){
    document.getElementById('email_err').innerHTML="<span class='err_msg'>Please enter Email ID.</span>";
	form.email.focus();
	return false; 
 }
 else if(!fnEmailCheck(email)){
     document.getElementById('email_err').innerHTML="<span class='err_msg'>Please enter valid email address.</span>";
	 form.email.focus();
	return false;
 } 
 else{
 document.getElementById('email_err').innerHTML="";
 } 
 if(ACdesc==''){
    document.getElementById('ac_desc_err').innerHTML="<span class='err_msg'>Please enter account description.</span>";
	form.ac_desc.focus();
	return false; 
 }
 else{
 document.getElementById('ac_desc_err').innerHTML="";
 } 
 return true;
}
</script>
<fieldset class="table-bor">
<legend><strong>New Bank Details</strong></legend>

<form action="" method="post" name="bankform" id="bankform" onsubmit="return validate_bankdetails()">
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">

<tr height="3px">
<td colspan="3" align="left"><a href="javascript:void(0)" onclick="history.go(-1)" style="text-decoration:underline;"><strong>&lt;&lt;&nbsp;Back</strong></a></td>
<td colspan="3" align="right">

<strong><font color="red">*</font> fields are manditory</strong></td></tr> 
			
<tr>
	<td class="admintext"><strong>Bank Name</strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
		<input name="bankname" type="text" id="bankname" maxlength="100" class="textbox1" onblur="LTrim(this.value,this.id)" />
		<div id="bankname_err"></div>
	</td>
</tr>

<tr height="3px"><td colspan="3"></td></tr>
<tr>
	<td class="admintext"><strong>Account Number</strong></td>	
	<td align="center">&nbsp; : &nbsp;</td>	
	<td>
		<input name="bank_ac" type="text" id="bank_ac" maxlength="100" class="textbox1" onblur="LTrim(this.value,this.id)" />
	    <div id="bank_ac_err"></div>	
   </td>
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>
	<td class="admintext"><strong>Accont Type</strong> </td>	
	<td align="center">&nbsp; : &nbsp;</td>	
	<td>	
		<input name="ac_type" type="text" id="ac_type" maxlength="100" class="textbox1" onblur="LTrim(this.value,this.id)" />
		<div id="ac_type_err"></div>	</td>
</tr>
<tr height="3px"><td colspan="3"></td></tr>
<tr>

	<td class="admintext"><strong>Email ID</strong> </td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td><input name="email" type="text" id="email" maxlength="100" class="textbox1" onblur="LTrim(this.value,this.id)" />
	<div id="email_err"></div></td>
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr height="3px"><td colspan="3"></td></tr>
		 
<tr>
<td valign="top"><strong>Account Description</strong><font color="red">*</font></td>
<td align="center">&nbsp; : &nbsp;</td>
<td><textarea name="ac_desc" cols="21" id="ac_desc" onblur="LTrim(this.value,this.id)"></textarea>
<div id="ac_desc_err"></div>
</td>
</tr>	
<tr height="3px"><td colspan="3"></td></tr>	  
<tr>
<td colspan="3" align="center" valign="top">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="submitacdetails" type="submit" id="submitacdetails" value="Add &gt;&gt;" onClick="" /></td>
</tr> 
</table>
</form>
			 
</fieldset>

<?php include "includes/footer.php"; ?>