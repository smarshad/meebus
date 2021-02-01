<?php
include("includes/header.php");

if(isset($_REQUEST['sp_id'])){

  $gan=chk_SP_area($_REQUEST['sp_id'],$_SESSION['SP_id']);
  if($gan==0){
     header("location: home.php");
  }
  else{
	$sp_id=$gan;
	}

$bread_tail="Edit My Profile";
//$sp_id=$_REQUEST['sp_id'];

$sp_qry=mysql_query("SELECT * FROM serviceprovider_info where SP_id=".$sp_id);
	if(mysql_num_rows($sp_qry)>0){
	   $providers=mysql_fetch_object($sp_qry);
	}
	else{
		 header("location: ".$_SERVER['PHP_SELF']);
	}
}


if(isset($_REQUEST['editcompany']))
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


 if(isset($_REQUEST['editcompany'])){
      $sql="UPDATE `serviceprovider_info` SET `SP_name`='$spname', `SP_email`='$spemail' ,  `SP_vat`='$spvat' ,  `SP_address1`='$txtaddress1' , `SP_address2`='$txtaddress2' ,  `SP_city`='$spcity' ,  `SP_state`='$spstate' ,  `SP_landNo1`='$splandno1' ,  `SP_landNo2`='$splandno2' ,  `SP_mobile1`='$spmobileno1' ,  `SP_mobile2`='$spmobileno2' ,  `SP_mobile3`='$spmobileno3' ,  `SP_fax`='$spfax' , `SP_emgFname`='$sp_person' ,  `SP_emgDesignation`='$sp_designation' ,  `SP_emgCallno`='$sp_perNo' ,  `SP_comments` ='$spcmnts' WHERE `SP_id` =$sp_id";
   }
 
      $db->query($sql) or die(mysql_error());
	  $g=$_REQUEST['sp_id'];
	   die("<META HTTP-EQUIV='Refresh' CONTENT='2;URL=profile.php?sp_id=$g'><span class='suc_msg'><center><br/><br/>Successfully Updated.<br/><br/></center></span><span class='err_msg'><center><br/><br/>This page will Redirect within 3 seconds.<br/><br/></center></span>");
 
}

//echo "<strong>".$bread_tail."</strong> <br/><br/>";

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
    return true;
	}
  else{
    form.spemail.focus();
    return false;
	}	    
}
/*function validate_newprovidersForm(){
  var form=document.companyform;
  var spname=get_val(form.spname.value);
  var spemail=get_val(form.spemail.value);
  //var spvat=form.spvat.value;
  var txtaddress1=get_val(form.txtaddress1.value);
  //var txtaddress2=form.txtaddress2.value;  
  var spcity=get_val(form.spcity.value);
 // var spstate=form.spstate.value;
  var splandno1=get_val(form.splandno1.value);
  //var splandno2=form.splandno2.value;
  var spmobileno1=get_val(form.spmobileno1.value);
  var spmobileno2=get_val(form.spmobileno2.value);
 // var spmobileno3=form.spmobileno3.value;
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
  }
  
  if(spmobileno1==''){
     alert('Enter Service Provider Mobile number1');
	 form.spmobileno1.focus();
	 return false;
    }
  else{
    assign_val(form.spmobileno1);
  } 
  
  if(spmobileno2==''){
     alert('Enter Service Provider Mobile number2');
	 form.spmobileno2.focus();
	 return false;
    }
  else{
    assign_val(form.spmobileno2);
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
  }
  
  if(flag==1){
    return true;
	}
  else{
    form.spemail.focus();
    return false;
	}	    
}*/

</script>

<fieldset class="table-bor">

<legend><strong><?php echo $bread_tail; ?></strong></legend>

<form action="" method="post" name="companyform" id="companyform" onsubmit="return validate_newprovidersForm()">
	
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" >

<tr height="3px"><td colspan="3" align="right">
<input type="hidden" id="flag" name="flag" <?php if(isset($_REQUEST['sp_id'])) { ?> value="1" <?php } else { ?> value="0" <?php } ?>/>
<strong><font color="red">*</font> fields are manditory</strong></td></tr> 
			
<tr>
	<td class="admintext"><strong>Service Provider Name</strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
		<input name="spname" type="text" id="spname" maxlength="100" class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_name.'" readonly'; } else{ echo 'onblur="check_SPname(this.value);" value=""';} ?> /><div id="errmsg"></div>
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"><strong>Email Address </strong> <font color="red">*</font></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>
	
		<input name="spemail" type="text" id="spemail" maxlength="100" class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_email.'" readonly'; } else{ echo 'value="" onblur="chkSPemail_Dup(this.value,0);"';} ?> />
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
		<input name="spcity" type="text" id="spcity" maxlength="100" class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_city.'"'; } else{ echo 'value=""';} ?> />
	</td>
	
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>

	<td class="admintext"><strong>State</strong></td>
	
	<td align="center">&nbsp; : &nbsp;</td>
	
	<td>	
		<input name="spstate" type="text" id="spstate" class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_state.'"'; } else{ echo 'value=""';} ?> />	
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

<tr>

<td><strong>Contact Person Name </strong> <font color="red">*</font></td>
<td align="center">&nbsp; : &nbsp;</td>
<td>
<input name="sp_person" type="text" id="sp_person"  class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_emgFname.'"'; } else{ echo 'value=""';} ?>/>
	</td>
</tr>

<tr height="3px"><td colspan="3"></td></tr>

<tr>
<td> <strong>Designation</strong></td>
<td align="center">&nbsp; : &nbsp;</td>
<td>
<input name="sp_designation" type="text" id="sp_designation"  class="textbox1" <?php if(isset($_REQUEST['sp_id'])) { echo 'value="'.$providers->SP_emgDesignation.'"'; } else{ echo 'value=""';} ?>/>
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
<tr height="3px"><td colspan="3"></td></tr>	  
<tr>
<td colspan="3" align="center" valign="top"> 
<input type="button" value="&lt;&lt; Back" name="back" id="back" onclick="history.go(-1);" />
<input name="editcompany" type="submit" id="editcompany" value="Update &gt;&gt;" onClick="return validate_newprovidersForm()" />
<!--<input name="editcompany" type="button" id="editcompany" value="Update &gt;&gt;" onClick="alert('This is Demo version !!!');" />-->
</td>
</tr> 
</table>
</form>
			 
</fieldset>

<?php include "includes/footer.php"; ?>