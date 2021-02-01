<?php
include("includes/header.php");
include_once("mailer.php");
if(isset($_REQUEST['agent_id'])){
$bread_tail="Add Agent";
$sp_id=mysql_real_escape_string($_REQUEST['agent_id']);

$sp_qry=mysql_query("SELECT * FROM agents where agent_id=".$agent_id);
	if(mysql_num_rows($sp_qry)>0){
	   $providers=mysql_fetch_object($sp_qry);
	}
	else{
		 header("location: ".$_SERVER['PHP_SELF']);
	}
}
else{
$bread_tail="Add Agent";
}

if(isset($_REQUEST['submitnewcompany']))
{		   

//print_r($_REQUEST['editcompany']); exit;



 $flag=$_REQUEST['agent'];
 $agent_name=mysql_real_escape_string($_REQUEST['agent_name']);
 $email=mysql_real_escape_string($_REQUEST['email']);
 $agency_name=mysql_real_escape_string($_REQUEST['agency_name']);
// $username=mysql_real_escape_string($_REQUEST['username']);
 $paswword=mysql_real_escape_string($_REQUEST['agency_pass']);
 $address=mysql_real_escape_string($_REQUEST['address']);
 $city=mysql_real_escape_string($_REQUEST['city']);
 $state=mysql_real_escape_string($_REQUEST['spstate']);
 $office_landline=mysql_real_escape_string($_REQUEST['office_landline']);
 $fax_no=mysql_real_escape_string($_REQUEST['fax']);
 $mobile_number=mysql_real_escape_string($_REQUEST['mobile_number']);
 $pincode=mysql_real_escape_string($_REQUEST['pincode']);
 $country=mysql_real_escape_string($_REQUEST['country']);

 //$tax=mysql_real_escape_string($_REQUEST['sptax']);
 $comm_user=mysql_real_escape_string($_REQUEST['comm_user']);
 $comm_sp=mysql_real_escape_string($_REQUEST['comm_sp']);  
  
 $payvar=mysql_real_escape_string($_REQUEST['payyyy']);
 
 
 $mobile_phone=mysql_real_escape_string($_REQUEST['mobile_phone']);
 
 if($payvar ==1)
 {
 $payvar_id=mysql_real_escape_string($_REQUEST['payyyy_id']);
}
else
{
$payvar_id="";
}

if(isset($_REQUEST['submitnewcompany'])){
 $sppassword=getRandomCharString(6); // Generate Random Password.
			 
$sql="INSERT INTO  `agents` ( `agent_id` , `agent_name` ,  `agency_name` , `agency_pass` ,  `email` ,  `office_phone` , `state` ,  `country` ,  `address` ,  `mobile_phone` ,  `fax` ,  `city` ,  `pincode` ,  `logo`, `status`) 
VALUES (
NULL ,  '$agent_name',  '$agency_name',  '$paswword',  '$email',  '$office_landline',  '$state',  '$country',  '$address',  '$mobile_phone', '$fax', '$city',  '$pincode', '$logo', 'yes')";			   

 $db->query($sql) or die(mysql_error());
 $id=mysql_insert_id();
 
 ///// mail
 $test="'This is Test link'";
 
// $fullpath = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]);
 
 $exp = explode("/admin", dirname($_SERVER[PHP_SELF]));
	
 
 $image = $exp[0].'/images/'.$imglogo;  

 $image=$website_url."/images/".$imglogo;

 //$image = stripFilenameFromUrl(curPageURL($_SERVER['PHP_SELF'])).'images/'.$imglogo ;
$msg="<table width='500' cellpadding='0' cellspacing='0' border='0' bgcolor='#F49E23' style='border:solid 10px #A5DCFF;'> 



	<tr bgcolor='#FFFFFF' height='25'> 



		<td height='94'>

			

			<img src='$image' border='0'  width='150' height='120' />

			

		</td> 



	</tr> 

	

	<tr bgcolor='#FFFFFF'> <td> </td> </tr> 

	

	<tr bgcolor='#FFFFFF' height='30'> 



		<td height='27' valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'>

		

			<b>Dear ".$spname."</b>
			

		</td> 

		

	</tr> 

	

	<tr bgcolor='#FFFFFF' height='35'> 

	

		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>

		

			Your Login email : ".$spemail."	

		

		</td> 

		

	</tr> 

	

	<tr bgcolor='#FFFFFF' height='35'> 



		<td height='23' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>

		

			password : ".$sppassword."

			

		</td> 

		

	</tr> 

	

	<tr bgcolor='#FFFFFF' height='35'> 
		<td height='32' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>
		<a href='".$website_url."/busadmin/verify.php?verify=".$id."'><strong>Click Here</strong></a> to activate your Account. 
		</td> 
	</tr> 



	<tr bgcolor='#FFFFFF'> 

	

		<td height='77' align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> 

		

			<p>Regards,<br>  $siteteam <br>  <a href='$website_url' target='_blank'> $website_url </a> </p>

  		</td>

		

	</tr> 

	

	<tr bgcolor='#FFFFFF'><td> </td></tr> 

	

	<tr height='40'> 

	

		<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color: #A5DCFF;'>

			<font color='black'> &copy; Copyright 2013 <b><i> $siteteam </i></b>. </font>

		</td> 

	</tr> 

</table>";

$headers = "MIME-Version: 1.0" . "\r\n";

$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

$headers .= 'From:'.$siteteam.'<'.$mail_url.'>'."\r\n";
        
$headers .= ""."\r\n"; 

$subject = "Confirmation Mail from".$siteteam ;

mail($spemail,$subject,$msg,$headers);
			  
  
  echo "<script> alert('Agent Added Successfully'); 
  window.location.href='agent_mage.php';
   </script>";
  
  exit;

 }
 

}

echo "  <strong>".$bread_tail."</strong> <br/><br/>";

?>



<script type="text/javascript">
function validate_newprovidersForm(){
  var form=document.companyform;
  var spname=get_val(form.spname.value);
  var spemail=get_val(form.spemail.value);
  //var spvat=form.spvat.value;
  var txtaddress1=get_val(form.txtaddress1.value);
  //var txtaddress2=form.txtaddress2.value;  
  var spcity=get_val(form.spcity.value);
 // var spstate=form.spstate.value;
  var splandno1=get_val(form.splandno1.value);
  var splandno2=get_val(form.splandno2.value);
  var spmobileno1=get_val(form.spmobileno1.value);
  var spmobileno2=get_val(form.spmobileno2.value);
  var spmobileno3=get_val(form.spmobileno3.value);
 // var spfax=form.spfax.value;
  var sp_person=get_val(form.sp_person.value);
  //var sp_designation=form.sp_designation.value;
  var sp_perNo=get_val(form.sp_perNo.value);
  var spcmnts=get_val(form.spcmnts.value);
  var flag=form.flag.value;
  
  if(spname==''){
     alert('Enter Service Provider Name');
	 form.spname.focus();
	 return false;
    }
  else{
    assign_val(form.spname);
  }
  
  if(spemail==''){
     alert('Enter Service Provider Email address');
	 form.spemail.focus();
	 return false;     
  }
  else{
		if (!chkemail_EXP(spemail)){
		    alert('Enter Valid Email address');
			form.spemail.focus();
			return false;
		}
		else{
		 assign_val(form.spemail);
		}
  } 

  if(txtaddress1==''){
     alert('Enter Service Provider Address');
	 form.txtaddress1.focus();
	 return false;
    }
  else{
    assign_val(form.txtaddress1);
  }  

  if(spcity==''){
     alert('Enter Service Provider City');
	 form.spcity.focus();
	 return false;
    }
  else{
    assign_val(form.spcity);
  }
 
  if(splandno1==''){
     alert('Enter Service Provider Landline number1');
	 form.splandno1.focus();
	 return false;
    }
  else{
    assign_val(form.splandno1);
	   if(splandno1.length < 10){
  	     alert('Landline number should be more than 10 digits.');
	     form.splandno1.focus();
	     return false;
	   }
	} 


  if(splandno2!=''){ 
    assign_val(form.splandno2);
	   if(splandno2.length < 10){
  	     alert('Landline number should be more than 10 digits.');
	     form.splandno2.focus();
	     return false;
	   }	
    }
  
  if(spmobileno1==''){
     alert('Enter Service Provider Mobile number1');
	 form.spmobileno1.focus();
	 return false;
    }
  else{
    assign_val(form.spmobileno1);
	   if(spmobileno1.length < 9){
  	     alert('Mobile number should be 10 digits.');
	     form.spmobileno1.focus();
	     return false;
	   }	
  } 
  
  if(spmobileno2==''){
     alert('Enter Service Provider Mobile number2');
	 form.spmobileno2.focus();
	 return false;
    }
  else{
    assign_val(form.spmobileno2);
	   if(spmobileno2.length < 9){
  	     alert('Mobile number should be 10 digits.');
	     form.spmobileno2.focus();
	     return false;
	   }	
  }  

  if(spmobileno3!=''){ 
    assign_val(form.spmobileno3);
	   if(spmobileno3.length < 9){
  	     alert('Mobile number should be more than 10 digits.');
	     form.spmobileno3.focus();
	     return false;
	   }	
    }

     if(document.getElementById('comm_user').value=="")
	 {
	 alert("Please Enter the commission from User");
	 document.getElementById('comm_user').focus();
	 return false;
	 
	 }

      if(document.getElementById('comm_sp').value=="")
	 {
	 alert("Please Enter the commission from Service Provider");
	 document.getElementById('comm_sp').focus();
	 return false;
	 
	 }
    

  if(sp_person==''){
     alert('Enter Service Provider Contact Person Name');
	 form.sp_person.focus();
	 return false;
    }
  else{
    assign_val(form.sp_person);
  }
  
  if(sp_perNo==''){
     alert('Enter Service Provider Contact Person Contact Number');
	 form.sp_perNo.focus();
	 return false;
    }
  else{
    assign_val(form.sp_perNo);
	   if(sp_perNo.length < 9){
  	     alert('Contact number should be more than 9 digits.');
	     form.sp_perNo.focus();
	     return false;
	   }	
  }
  
  if(flag==1){
     //alert('This is Demo Version !!!');
    return true;
	}
  else{
    form.spemail.focus();
    return false;
	}	    
}


function alpha(e) {
var k;
document.all ? k = e.keyCode : k = e.which;
return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 0 || k == 32);
}

</script>

<script>

function paaaaay()
{

if(document.getElementById('payyyy1').value=='1')
{
document.getElementById('paaaa').style.display="block";

}

}
</script>
<script>
function paasdfay()
{

document.getElementById('paaaa').style.display="none";

}
</script>

<fieldset class="table-bor">

<legend><strong><?php echo $bread_tail; ?></strong></legend>

<form action="" method="post" name="companyform" id="companyform" onsubmit="return validate_newprovidersForm()">
	
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" >

<tr height="3px"><td colspan="3" align="right">
<input type="hidden" id="flag" name="flag"  value="<?php if(isset($_REQUEST['agent_id'])) { ?>1<?php } else { ?>0<?php } ?>" />
<strong><font color="red">*</font> fields are manditory</strong></td></tr> 
			
<tr>
	<td class="admintext"><strong>Agent Name</strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
		<input name="agent_name" type="text" id="agent_name" maxlength="100" class="textbox1" <?php if(isset($_REQUEST['agent_id'])) { echo 'value="'.$providers->agent_id.'" readonly'; echo ' style="background:#CCC;"'; } else{ echo 'onblur="check_SPname(this.value);" value=""';} ?>  onkeypress="return alpha(event)" /><div id="errmsg"></div>
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"><strong>Email Address </strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
	
		<input name="email" type="text" id="email" maxlength="100" class="textbox1" <?php if(isset($_REQUEST['email'])) { echo 'value="'.$providers->email.'" readonly'; echo ' style="background:#CCC;"'; } else{ echo 'value="" onblur="chkSPemail_Dup(this.value,0);"';} ?> />
	    <div id="email_res"></div>
	</td>

</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"><strong>Agency Name</strong> </td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
	
		<input name="agency_name" type="text" id="agency_name" maxlength="100" class="textbox1" <?php if(isset($_REQUEST['agency_name'])) { echo 'value="'.$providers->agency_name.'"'; } else{ echo 'value=""';} ?> />
	
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"> <strong>Username</strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
	
		<input name="username" type="text" id="username"  maxlength="100" class="textbox1" <?php if(isset($_REQUEST['agent_name'])) { echo 'value="'.$providers->agent_name.'"'; } else{ echo 'value=""';} ?> />
	
	</td>
	
</tr>

<tr>

	<td class="admintext"> <strong>password</strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
	
		<input name="password" type="password" id="password"  maxlength="100" class="textbox1" <?php if(isset($_REQUEST['agency_pass'])) { echo 'value="'.$providers->agency_pass.'"'; } else{ echo 'value=""';} ?> />
	
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"> <strong>Address</strong></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
	
		<input name="address" type="text" id="address"  maxlength="100" class="textbox1" <?php if(isset($_REQUEST['address'])) { echo 'value="'.$providers->address.'"'; } else{ echo 'value=""';} ?> />
	
	</td>
	
</tr>

<tr>

	<td class="admintext"> <strong>Pincode</strong></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
	
		<input name="pincode" type="text" id="pincode"  maxlength="100" class="textbox1" <?php if(isset($_REQUEST['pincode'])) { echo 'value="'.$providers->pincode.'"'; } else{ echo 'value=""';} ?> />
	
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>
	
	<td class="admintext"><strong>City</strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
		<input name="city" type="text" id="city" maxlength="100" class="textbox1" <?php if(isset($_REQUEST['city'])) { echo 'value="'.$providers->city.'"'; } else{ echo 'value=""';} ?>  onkeypress="return alpha(event)" />
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"><strong>State</strong></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>	
		<input name="spstate" type="text" id="spstate" class="textbox1" <?php if(isset($_REQUEST['state'])) { echo 'value="'.$providers->state.'"'; } else{ echo 'value=""';} ?>  onkeypress="return alpha(event)" />	
	</td>
	
</tr>

<tr>

	<td class="admintext"><strong>Country</strong></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>	
		<input name="country" type="text" id="country" class="textbox1" <?php if(isset($_REQUEST['state'])) { echo 'value="'.$providers->country.'"'; } else{ echo 'value=""';} ?>  onkeypress="return alpha(event)" />	
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"><strong>OFfice Landline </strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
		
		<input name="office_landline" type="text" id="office_landline" maxlength="12" onKeyPress="return numbersonly(this, event)"  class="textbox1" <?php if(isset($_REQUEST['office_phone'])) { echo 'value="'.$providers->office_phone.'"'; } else{ echo 'value=""';} ?>/>
		
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"><strong>Fax No </strong></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
		
		<input name="fax" type="text" id="fax" maxlength="12" onKeyPress="return numbersonly(this, event)"  class="textbox1" <?php if(isset($_REQUEST['fax'])) { echo 'value="'.$providers->fax.'"'; } else{ echo 'value=""';} ?>/>
		
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td><strong>Mobile Number </strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
	
		<input name="mobile_phone" type="text" id="mobile_phone" maxlength="10" onKeyPress="return numbersonly(this, event)"  class="textbox1" <?php if(isset($_REQUEST['mobile_phone'])) { echo 'value="'.$providers->mobile_phone.'"'; } else{ echo 'value=""';} ?>/>
	
	</td>
	
</tr>





<tr height="3px"><td colspan="3"></td></tr>

<!--<tr>

	<td><strong>Tax Amount</strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
		
		<input name="sptax" type="text" id="sptax" maxlength="10"  class="textbox1" <?php //if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->tax.'"'; } else{ echo 'value=""';} ?>/>
		
	</td>
	
</tr>-->



<tr height="3px"><td colspan="3"></td></tr>


<tr height="3px"><td colspan="3"></td></tr>
		 


<tr>

</tr>	


<tr height="3px"><td colspan="3"></td></tr>	  
<tr>
<td colspan="3" align="center" valign="top">

<input name="submitnewcompany" type="submit" id="submitnewcompany" value="Submit &gt;&gt;" onClick="return validate_newprovidersForm()" /> 
</td>
</tr> 
</table>
</form>
			 
</fieldset>

<?php include "includes/footer.php"; ?>