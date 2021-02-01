<?php
include("includes/header.php");
include_once("mailer.php");
if(isset($_REQUEST['sp_id'])){
$bread_tail="Edit Service Provider";
$sp_id=mysql_real_escape_string($_REQUEST['sp_id']);

$sp_qry=mysql_query("SELECT * FROM serviceprovider_info where SP_id=".$sp_id);
	if(mysql_num_rows($sp_qry)>0){
	   $providers=mysql_fetch_object($sp_qry);
	}
	else{
		 header("location: ".$_SERVER['PHP_SELF']);
	}
}
else{
$bread_tail="Add Service Provider";
}

if(isset($_REQUEST['submitnewcompany']) || isset($_REQUEST['editcompany']))
{		   

//print_r($_REQUEST['editcompany']); exit;



 $flag=$_REQUEST['flag'];
 $spname=mysql_real_escape_string($_REQUEST['spname']);
 $spemail=mysql_real_escape_string($_REQUEST['spemail']);
 $spvat=mysql_real_escape_string($_REQUEST['spvat']);
 $txtaddress1=mysql_real_escape_string($_REQUEST['txtaddress1']);
 $txtaddress2=mysql_real_escape_string($_REQUEST['txtaddress2']);
 $spcity=mysql_real_escape_string($_REQUEST['spcity']);
 $spstate=mysql_real_escape_string($_REQUEST['spstate']);
 $splandno1=mysql_real_escape_string($_REQUEST['splandno1']);
 $splandno2=mysql_real_escape_string($_REQUEST['splandno2']);
 $spmobileno1=mysql_real_escape_string($_REQUEST['spmobileno1']);
 $spmobileno2=mysql_real_escape_string($_REQUEST['spmobileno2']);
 $spmobileno3=mysql_real_escape_string($_REQUEST['spmobileno3']);
 $spfax=mysql_real_escape_string($_REQUEST['spfax']);
 $sp_person=mysql_real_escape_string($_REQUEST['sp_person']);
 $sp_designation=mysql_real_escape_string($_REQUEST['sp_designation']);
 $sp_perNo=mysql_real_escape_string($_REQUEST['sp_perNo']);
 $spcmnts=mysql_real_escape_string($_REQUEST['spcmnts']);
 //$tax=mysql_real_escape_string($_REQUEST['sptax']);
 $comm_user=mysql_real_escape_string($_REQUEST['comm_user']);
 $comm_sp=mysql_real_escape_string($_REQUEST['comm_sp']);  
  
 $payvar=mysql_real_escape_string($_REQUEST['payyyy']);
 
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
			 
$sql="INSERT INTO  `serviceprovider_info` ( `SP_id` ,  `SP_name` ,  `SP_email` ,  `SP_password` ,  `SP_vat` ,  `SP_address1` , `SP_address2` ,  `SP_city` ,  `SP_state` ,  `SP_landNo1` ,  `SP_landNo2` ,  `SP_mobile1` ,  `SP_mobile2` ,  `SP_mobile3` ,  `SP_fax` , `SP_emgFname` ,  `SP_emgDesignation` ,  `SP_emgCallno` ,  `SP_comments` ,  `SP_status`,user_typeID,`SP_verified`,`comm_user`,`comm_sp`,`paypal`,`paypal_id`) 
VALUES (
NULL ,  '$spname',  '$spemail',  '$sppassword',  '$spvat',  '$txtaddress1',  '$txtaddress2',  '$spcity',  '$spstate',  '$splandno1',  '$splandno2', '$spmobileno1',  '$spmobileno2',  '$spmobileno3',  '$spfax', '$sp_person', '$sp_designation',  '$sp_perNo',  '$spcmnts', '0','2','1','$comm_user','$comm_sp','$payvar','$payvar_id')";			   

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


//  mail($spemail,$subject,$msg,$headers); 
  
 // Mailreg($spemail,$subject,$msg,$headers,$id,$sitename,$mail_url); 

mail($spemail,$subject,$msg,$headers);
			  
  /*echo "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=addNewBus.php?sp_id=".$id."'><span class='suc_msg'><center><br/><br/>Service Provier Added Suucessfully. Relevant Details hasbeen mailed to Service Provider. This page will redirect in 3 minutes.<br/><br/></center></span>";*/
  
  echo "<script> alert('Service Provider Added Successfully'); 
  window.location.href='companymgnt.php?';
   </script>";
  
  exit;

 }
 
 if(isset($_REQUEST['editcompany'])){
      $sql="UPDATE `serviceprovider_info` SET `SP_name`='$spname', `SP_email`='$spemail' ,  `SP_vat`='$spvat' ,  `SP_address1`='$txtaddress1' , `SP_address2`='$txtaddress2' ,  `SP_city`='$spcity' ,  `SP_state`='$spstate' ,  `SP_landNo1`='$splandno1' ,  `SP_landNo2`='$splandno2' ,  `SP_mobile1`='$spmobileno1' ,  `SP_mobile2`='$spmobileno2' ,  `SP_mobile3`='$spmobileno3' ,  `SP_fax`='$spfax' , `SP_emgFname`='$sp_person' ,  `SP_emgDesignation`='$sp_designation' ,  `SP_emgCallno`='$sp_perNo' ,  `SP_comments` ='$spcmnts',`comm_user`='$comm_user',`comm_sp`='$comm_sp',`paypal`='$payvar',`paypal_id`='$payvar_id' WHERE `SP_id` =$sp_id";
  

      $db->query($sql) or die(mysql_error());
	   die("<META HTTP-EQUIV='Refresh' CONTENT='2;URL=companymgnt.php'><span class='suc_msg'><center><br/><br/>Successfully Updated.<br/><br/></center></span>");
  }
}

echo "<a href='companymgnt.php'>Service Provider Management</a>  >> <strong>".$bread_tail."</strong> <br/><br/>";

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
<input type="hidden" id="flag" name="flag"  value="<?php if(isset($_REQUEST['sp_id'])) { ?>1<?php } else { ?>0<?php } ?>" />
<strong><font color="red">*</font> fields are manditory</strong></td></tr> 
			
<tr>
	<td class="admintext"><strong>Service Provider Name</strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
		<input name="spname" type="text" id="spname" maxlength="100" class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_name.'" readonly'; echo ' style="background:#CCC;"'; } else{ echo 'onblur="check_SPname(this.value);" value=""';} ?>  onkeypress="return alpha(event)" /><div id="errmsg"></div>
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"><strong>Email Address </strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
	
		<input name="spemail" type="text" id="spemail" maxlength="100" class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_email.'" readonly'; echo ' style="background:#CCC;"'; } else{ echo 'value="" onblur="chkSPemail_Dup(this.value,0);"';} ?> />
	    <div id="email_res"></div>
	</td>

</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"><strong>VAT No</strong> </td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
	
		<input name="spvat" type="text" id="spvat" maxlength="100" class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_vat.'"'; } else{ echo 'value=""';} ?> />
	
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"> <strong>Address1</strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
	
		<input name="txtaddress1" type="text" id="txtaddress1"  maxlength="100" class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_address1.'"'; } else{ echo 'value=""';} ?> />
	
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"> <strong>Address2</strong></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
	
		<input name="txtaddress2" type="text" id="txtaddress2"  maxlength="100" class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_address2.'"'; } else{ echo 'value=""';} ?> />
	
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>
	
	<td class="admintext"><strong>City</strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
		<input name="spcity" type="text" id="spcity" maxlength="100" class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_city.'"'; } else{ echo 'value=""';} ?>  onkeypress="return alpha(event)" />
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"><strong>State</strong></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>	
		<input name="spstate" type="text" id="spstate" class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_state.'"'; } else{ echo 'value=""';} ?>  onkeypress="return alpha(event)" />	
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"><strong>Land Line1 </strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
		
		<input name="splandno1" type="text" id="splandno1" maxlength="12" onKeyPress="return numbersonly(this, event)"  class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_landNo1.'"'; } else{ echo 'value=""';} ?>/>
		
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"><strong>Land Line 2 </strong></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
		
		<input name="splandno2" type="text" id="splandno2" maxlength="12" onKeyPress="return numbersonly(this, event)"  class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_landNo2.'"'; } else{ echo 'value=""';} ?>/>
		
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td><strong>Mobile 1 </strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
	
		<input name="spmobileno1" type="text" id="spmobileno1" maxlength="10" onKeyPress="return numbersonly(this, event)"  class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_mobile1.'"'; } else{ echo 'value=""';} ?>/>
	
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td><strong>Mobile 2 </strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>

	<td>
	
		<input name="spmobileno2" type="text" id="spmobileno2" maxlength="10" onKeyPress="return numbersonly(this, event)"  class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_mobile2.'"'; } else{ echo 'value=""';} ?>/>

	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td><strong>Mobile 3 </strong></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
	
		<input name="spmobileno3" type="text" id="spmobileno3" maxlength="10" onKeyPress="return numbersonly(this, event)"  class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_mobile3.'"'; } else{ echo 'value=""';} ?>/>
	
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td><strong>Fax</strong></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
		
		<input name="spfax" type="text" id="spfax" maxlength="10" onKeyPress="return numbersonly(this, event)"  class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_fax.'"'; } else{ echo 'value=""';} ?>/>
		
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

<tr>

	<td><strong>Commission From User (%)</strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
		
		<input name="comm_user" type="text" id="comm_user" maxlength="10"  class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->comm_user.'"'; } else{ echo 'value=""';} ?>/>
		
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td><strong>Commission From Service Provider (%)</strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
		
		<input name="comm_sp" type="text" id="comm_sp" maxlength="10"  class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->comm_sp.'"'; } else{ echo 'value=""';} ?>/>
		
	</td>
	
</tr>


<tr height="3px"><td colspan="3"></td></tr>

<tr>

<td><strong>Contact Person Name </strong> <font color="red">*</font></td>
<td align="center">&nbsp; : &nbsp;</td>
<td>
<input name="sp_person" type="text" id="sp_person"  class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_emgFname.'"'; } else{ echo 'value=""';} ?>  onkeypress="return alpha(event)"/>
	</td>
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>
<td> <strong>Designation</strong></td>
<td align="center">&nbsp; : &nbsp;</td>
<td>
<input name="sp_designation" type="text" id="sp_designation"  class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_emgDesignation.'"'; } else{ echo 'value=""';} ?>  onkeypress="return alpha(event)"/>
</td>
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>
<td><strong>Contact Number</strong> <font color="red">*</font></td>
<td align="center">&nbsp; : &nbsp;</td>
<td>
<input name="sp_perNo" type="text" id="sp_perNo" maxlength="12" onKeyPress="return numbersonly(this, event)"  class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_emgCallno.'"'; } else{ echo 'value=""';} ?>/>
</td>
</tr>

<tr height="3px"><td colspan="3"></td></tr>
		 
<tr>
<td valign="top"><strong>Comments</strong></td>
<td align="center">&nbsp; : &nbsp;</td>
<td><textarea name="spcmnts" cols="21" id="spcmnts"><?php if(isset($_REQUEST['sp_id'])) { echo $providers->SP_comments; }  ?></textarea></td>
</tr>	

<tr>
<td valign="top"><strong>If you have Paypal id</strong></td>
<td align="center">&nbsp; : &nbsp;</td>
<td><input type="radio" name="payyyy" id="payyyy1" value="1" <?php if($providers->paypal=='1') { ?> checked="checked" <?php }  ?> onclick="return paaaaay();" /> Yes <input type="radio" name="payyyy" id="payyyy2" value="0" <?php if($providers->paypal=='0') { ?> checked="checked" <?php }  ?> onclick="return paasdfay();" /> No </td>
</tr>	



<?php if((isset($_REQUEST['sp_id'])) && ($providers->paypal=='1')) { ?> 
<tr>
<td colspan="3">
<table id="paaaa">
<tr>
<td class="admintext" style="width:53%;">
<strong>Paypal Id</strong></td>
<td align="center" style="width:3%;">&nbsp; : &nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="payyyy_id" id="payyyy_id" value="<?php echo $providers->paypal_id; ?>" /> </td>
</tr></table></td>
</tr>	
<?php } else { ?>
<tr>
<td colspan="3">
<table id="paaaa" style="display:none;">
<tr>
<td class="admintext" style="width:53%;">
<strong>Paypal Id</strong></td>
<td align="center" style="width:3%;">&nbsp; : &nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="payyyy_id" id="payyyy_id" value="<?php echo $providers->paypal_id; ?>" /> </td>
</tr></table></td>
</tr>	

<?php }?>


<tr height="3px"><td colspan="3"></td></tr>	  
<tr>
<td colspan="3" align="center" valign="top">
<?php if(isset($_REQUEST['sp_id'])) { ?> 
<input name="editcompany" type="submit" id="editcompany" value="Update &gt;&gt;" onClick="return validate_newprovidersForm()" />
<?php } else { ?>
<input name="submitnewcompany" type="submit" id="submitnewcompany" value="Register &gt;&gt;" onClick="return validate_newprovidersForm()" /> <?php } ?>
</td>
</tr> 
</table>
</form>
			 
</fieldset>

<?php include "includes/footer.php"; ?>