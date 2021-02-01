<?php  
include_once "header.php"; ?>
<style>
.button
{
	width:auto;
	float:left;
	margin-left:100px;
}
.left-btn
{
	width:10px;
	height:22px;
	float:left;
	background:url(images/a.jpg) no-repeat;
}
.mid-btn 
{
	width:auto;
	height:28px;
	float:left;
	background:#d84f57;
	font-size:12px;
	color:#FFFFFF;	
	font-weight:bold;
}
.mid-btn a
{
	font-size:12px;
	color:#FFFFFF;
	font-weight:bold;
	text-decoration:none;
	display:block;
}
.right-btn
{
	width:10px;
	height:22px;
	float:left;
	background:url(images/c.jpg) no-repeat;
}
.inner-content input[type="text"] {
    width: 300px;
}
</style>
<div  class="inner-content">
<div class="box_head_blue">Cancel Ticket</div>
		  <table border="0" align="center" cellpadding="2" cellspacing="2">
		  <tr>
		  <td>&nbsp;</td><td><div id="errmsg" class="err_msg"></div></td>
		  </tr>
		  <tr>
		  <td>&nbsp;</td><td>&nbsp;</td>
		  </tr>
          <form action="cancel-detail.php" method="post" name="cancel" id="cancel">
            <tr>
              <td><strong>Ticket Number</strong></td>
              <td><input name="txttick" type="text" id="txttick" size="30" /><span class="err_msg" id="err" style="font-size:13px; font-weight:bold;"><div class="cf"></div>
</td>
            </tr>
			<tr><td>&nbsp;</td></tr>			
			<tr>
			<td><strong>Email ID</strong></td>
			<td><input name="txtemail" type="text" id="txtemail" size="30" /><span class="err_msg" id="err1" style="font-size:13px; font-weight:bold;"><div class="cf"></div>
            </td>
			</tr>	
			<tr><td>&nbsp;</td></tr>	
            <tr>
            <td>&nbsp;</td>
              <td>
			    <input name="submit" type="submit" id="submit" value="Search" class="sub-but" />
              </td>
            </tr>
            </form>
          </table>
</div>
 <div id="disp_ticket"></div>
<?php  include_once "includes/footer.php"; ?>
<script language="javascript">
$("#submit").click( function ()
{
	$("#err").html("");
	$("#err1").html("");
	var ticket=$("#txttick").val();
	var email=$("#txtemail").val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if(ticket=='')
	{
		$("#err").html("Please enter a valid ticket number!");
		return false;
	}
	else if(email=='')
	{
		$("#err1").html("Please enter email address!");
		return false;
	}
	else if(!emailReg.test(email)) 
	{
		$("#err1").html("Please enter a valid email address!");
		return false;
	}
	else
	{
		$("#cancel").submit();
		return true;
	}
});
$(function(){ 
    // add multiple select / deselect functionality
    $("#selectall").click(function () { 
          $('.case').attr('checked', this.checked);
    });
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
    });
});
</script>