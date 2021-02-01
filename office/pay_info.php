<?php
include "includes/header.php";
?>
<script src="../js/pagination.js" type="text/javascript"></script>

<?php 
if($_REQUEST['save'])
{
$comm_amt=$_REQUEST['txtcom'];
$sql=mysql_query("Insert into ticket_commision (commision_amt) values ('$comm_amt')");
header("location:comm_mgmt.php?succ");
}
if($_REQUEST['del_id'])
{
$delid=$_REQUEST['del_id'];
mysql_query("delete from ticket_commision where ticket_id='$delid'");
header("location:comm_mgmt.php?del");
}
?>
<body>
<fieldset class="table-bor">
<legend><strong>Payment Management</strong></legend>	
<table width="50%" border="0" cellspacing="1" cellpadding="1" align="center">
<tr>
<?php if(isset($_REQUEST['succ'])){ ?>
<td colspan="2"><span style="color:#009900">Successfully Added</span></td>
<? } ?>
<?php if(isset($_REQUEST['del'])){ ?>
<td colspan="2"><span style="color:#CC0033">Successfully Deleted</span></td>
<? } ?>
<?php if(isset($_REQUEST['updat'])){ ?>
<td colspan="2"><span style="color: #009900">Successfully Updated</span></td>
<? } ?>
</tr>
  <tr>
    <td valign="top" width="50%" nowrap="nowrap">
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
    <form name="commision" action="" method="post">
     
        <tr>
     <!--   <td nowrap="nowrap">
		    <div id="tit_div">Enter Commision Amt: </div>
		</td>
        <td nowrap="nowrap">
		<input name="txtcom" type="text" id="txtcom" value=""  class="textbox" required="required"/>
		</td>
        <td nowrap="nowrap"><input type="submit" name="save" id="save" value="Save"/>
        </tr> -->
        <tr>		
		
		
		</td>
      </tr>
      </form>
    </table>
	</td>
  </tr>
</table>
<!--<hr/>-->
<table width="50%" border="0" cellspacing="1" cellpadding="1" align="center">
<tr><td><a href="paymentmgnt.php" class="ovalbutton"><span><strong>Service Provider</strong></span></td><td><a href="commision_list.php" class="ovalbutton"><span><strong>Commision List</strong></span></td></tr>

</table>
<div class="pagination"></div>
</fieldset>
</body>
<?php include "includes/footer.php"; ?>