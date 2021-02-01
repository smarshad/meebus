<?php include_once("includes/header.php"); 

if(isset($_REQUEST['btnsendmail']))
	{
	
	$providername = substr($_REQUEST['from_mail'],0,8);
	$to_mail = $_REQUEST['to_mail'];
	$msg = $_REQUEST['message'];
	
	$mail_to = substr($to_mail,0,-1);
	//echo $to_mail;
	$t_mail = explode(",",$mail_to);
	
	
	
	for($i=0; $i<count($t_mail); $i++)
	{
	
	$fet_user = mysql_fetch_array(mysql_query("select * from users where user_id= '".$t_mail[$i]."'"));
	 $txtmobile= $fet_user['user_mobileno'];
	 
	//$providername=substr($provider['SP_name'],0,8);
	//echo $txtmobile; echo $msg; echo $providername;  
	$smsticket = sendsms($txtmobile,$msg,$providername);
	
	
	
	//echo $smsticket;

	}
	
	if($smsticket=='') {
		$msgstatus="Page error";
		$smsstatus=2;
	} elseif($smsticket=='nocredit') {
		$msgstatus="No sms balance";
		$smsstatus=2;
	} elseif($smsticket<0) {
		$msgstatus="Number error";
		$smsstatus=2;
	} elseif(strlen($smsticket)>15) {
		$msgstatus="progress";	
		$smsstatus=0;
	} else {
		$msgstatus="failed";
		$smsstatus=2;
	}
	$msgstatus=base64_encode($msgstatus);
	//echo "test";
	header("Location:bulksms.php?msgsts=$msgstatus");
	?>
	
	<script>
	
	window.location="bulksms.php?msgsts=<?=$msgstatus?>";
	
	</script>
	
	<?php exit; }
	
	
?>

<script src="../js/pagination.js" type="text/javascript"></script>
<script>


function chk(theElement)
{
//alert("dsfsd");
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
</script>

<script>
function submit_chk(){
		var chks = document.getElementsByName('box[]');
		var hasChecked = false;
		for (var i = 0; i < chks.length; i++)
		{
			if (chks[i].checked)
			{
			hasChecked = true;
			break;
			}
		}
		if (hasChecked == false)
		{
			alert("Please select at least one.");
			return false;
		}
		
		
		showdiv('sendmail',chks);
}
</script>
<script>
function showdiv(divid,chks)
{
	document.getElementById(divid).style.display=(document.getElementById(divid).style.display =="none" ? "block" : "none" );
	
		for (var i = 1; i <= chks.length; i++)
		{ 
			if (chks[i].checked)
			{			
			document.getElementById('to_mail').value+=chks[i].value+",";
			}
		}
}

</script>
<script type="text/javascript">
function frmemailvalidation()
{
	frm=document.mail_form
	
	if(frm.message.value=="")
	{
	alert("Please Enter Your Message");
	frm.message.focus();
	return false
	}
	
	
}
</script>
 <script type='text/javascript' src='http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js'></script>
    <script type='text/javascript'>
        $(document).ready(function() {
            $('#ta').keyup(function() {
                var len = this.value.length;
                if (len >= 100) {
                    this.value = this.value.substring(0, 100);
                }
                $('#charLeft').text(100 - len);
            });
        });
    </script>
<body>

<fieldset class="table-bor">

		<legend><strong>Bulksms Management</strong></legend> 
		
		<table width="100%" border="0" cellspacing="2" cellpadding="5">
		  <tr>
			<td width="17%">Type any </td>
			<td width="44%">
			<input type="text" size="50" class="textbox2" onKeyUp="search_Usr();" id="usr_search" name="usr_search" /> <br></td>
			
			<td colspan="4"></td>
			
		  </tr>
		  
		  <tr>
		  	<td></td>
			
			<td colspan="5">
				( Enter User Name, City, State, Pincode, Contact Nos, Email to search for a Details.)
			</td>
			
		  </tr>
			
			<tr><td colspan="6">
			
				<table width="100%">
					<tr>
			<td width="17%"> Gender </td>
			
			<td><select name="usr_gen" id="usr_gen" onChange="search_bulk();" class="combobox-small">
				<option value="0">All</option>
				<option value="f">Female</option>
				<option value="m">Male</option>
				</select></td>
				
			<td width="18%" align="center"> User Type </td>
			<td>
			    <select name="usr_type" id="usr_type" onChange="search_bulk();" class="combobox-small">
				<option value="0">All</option>
				
				<?php  					
					$sql = mysql_query("select * from usertypes where usertype_id not in(1,2)") ;
					
					while($getrow = mysql_fetch_array($sql))
					{
				?>
				<option value="<?php echo $getrow[0]; ?>"><?php echo $getrow[1] ; ?> </option>
				<?php } ?>				
				</select>
			</td>
			
			<td width="18%" align="center"> Status </td>
			<td width="21%"><select name="usr_status" id="usr_status" onChange="search_bulk();" class="combobox-small">
				<option value="2">All</option>
				<option value="1">Active</option>
				<option value="0">Inactive</option>
			  </select></td>
		  </tr>
			  </table>
			
			</td></tr>
		</table>
		
		<hr />

		<br>
		
		<div style="text-align:center;">
			<?php 
				if(isset($_REQUEST['s']))
				{ 
					$suc_st = "<font color='green'><strong>Status Changed</strong></font>"
				?>				
				<label><?php echo $suc_st; ?></label>
				<?php 
				}
				else if(isset($_REQUEST['e']))
				{ 
					$suc_st = "<font color='red'><strong>Status Cant Changed</strong></font>"
				?>				
				<label><?php echo $suc_st; ?></label>
				<?php 
				} 
				else if(isset($_REQUEST['ds']))
				{ 
					$suc_st = "<font color='green'><strong>User Deleted Succefully!!</strong></font>"
				?>				
				<label><?php echo $suc_st; ?></label>
				<?php 
				}
				else if(isset($_REQUEST['de']))
				{ 
					$suc_st = "<font color='red'><strong>Cant Delete the User!!</strong></font>"
				?>				
				<label><?php echo $suc_st; ?></label>
				<?php  }  
				else if(isset($_REQUEST['us']))
				{ 
					$suc_st = "<font color='green'><strong>User Details Updated Succefully!!</strong></font>"
				?>				
				<label><?php echo $suc_st; ?></label>
				<?php 
				}
				else if(isset($_REQUEST['ue']))
				{ 
					$suc_st = "<font color='red'><strong>Cant Updated the User!!</strong></font>"
				?>				
				<label><?php echo $suc_st; ?></label>
				<?php  }  
				
				else if(isset($_REQUEST['msgsts']))
				{ 
					$msgsts =base64_decode($_REQUEST['msgsts']);
				?>				
				<label style="font-weight:bold;">Message has been <?php echo $msgsts; ?></label>
				<?php  }  ?>
		</div>
		
		<table>
		<?php if(!isset($_REQUEST['msgsts'])) { ?>
		 <tr id="hide">
		 <td style="color:#FF0000; font-weight:bold;">
	     First Search and get the results, and then send sms to filtered users !!!	
				</td>
		 </tr>
		 <?php } ?>
		
			<tr>
				<td>
					<label id='errmsg' class="errmsg"></label>
					<label id='response' class="errmsg"></label>
					
					
				</td>
			</tr>
		</table>

		<br>	
		
		<div id="loading"></div>
        <div id="container">		
            <div class="data">			
			</div>
            <div class="pagination"></div>			
        </div>
		<br />
			<div id="sendmail"  style="overflow:visible; width:455px; background:#E6F8FF ;  display:none; position:fixed; height:330px; top:150px; left:250px; border:10px solid #03AAFA;"> 
			<form name="mail_form" action="" method="post" >	
				<table width="100%" border="0" cellpadding="4" cellspacing="2">
					<tr>
						<td colspan="4" align="right">
							<img src="images/delete2.jpg" title="Cancel" border="0" onClick="javascript:showdiv('sendmail')"  />
						</td>
					</tr>
					<tr>
						<td colspan="4" height="20" align="center" valign="top" style="padding-left:10px; font-size:12px;" class="link1">&nbsp;&nbsp; Send Email</td>
					</tr>
					<input type="hidden" value="" name="to_mail" id="to_mail" />
					<input type="hidden" value="<?php echo $title; ?>" name="from_mail"  />
				<!--	<tr>
						<td height="25" align="left" valign="middle">&nbsp;</td>
						<td height="25" align="left" valign="middle"><span class="subHeadingThree">Subject</span></td>
						<td height="25" align="left" valign="middle"><div align="center"><strong>:</strong></div></td>
						<td height="25" align="left" valign="middle" class="adminsmalltext"><input name="subject" value="" type="text" size="32" /></td>
					</tr>-->
					<tr>
						<td height="25" align="left" valign="middle">&nbsp;</td>
						<td height="25" align="left" valign="middle"><span class="subHeadingThree">Message</span></td>
						<td height="25" align="left" valign="middle"><div align="center"><strong>:</strong></div></td>
						<td height="25" align="left" valign="middle" class="adminsmalltext"><textarea name="message" id="ta" rows="9" cols="35"></textarea><br />(Maximum characters: 100)<br/>
<span id="charLeft" style="border:1px #003366 solid; background-color:#FFFFFF; color:#000000; padding:2px;">&nbsp;&nbsp;&nbsp;</span>  Characters left</td>
					</tr>
					<tr>
						<td height="25" colspan="4" align="left" valign="middle"  style="padding-left:120px">
							<input name="btnsendmail" type="submit" value="Send SMS" class="ovalbutton" onClick="javascript:return frmemailvalidation();" />  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="btncancel" class="ovalbutton" type="button" value="Cancel" onClick="javascript:showdiv('sendmail')" />
						</td>
					</tr>
				</table>
			</form>
			</div>
		</fieldset>
</body>
<?php include "includes/footer.php"; ?>