<?php
include "includes/header.php";
?>
<script src="../js/pagination.js" type="text/javascript"></script>

<?php 
$edit_id=$_REQUEST['edit_id'];
if($_REQUEST['update'])
{
$comm_amt=$_REQUEST['txtcom'];
$tickettype=$_REQUEST['tickettype'];
$sql=mysql_query("Update ticket_commision Set tickettype='$tickettype',commision_amt='$comm_amt' where ticket_id='$edit_id'");
header("location:comm_mgmt.php?updat");
}

?>
<body>
<fieldset class="table-bor">
<legend><strong>Commision Management</strong></legend>	
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
    <?php $sql2=mysql_query("select * from ticket_commision where ticket_id='$edit_id'");
	$res2=mysql_fetch_array($sql2);
	?>
    <form name="commision" action="" method="post">
      <tr>
        <td nowrap="nowrap">
		    <div id="tit_div">Ticeket Type: </div>
		</td>
        <td nowrap="nowrap">
		<input name="tickettype" type="text" id="tickettype" value="<?php $res2['tickettype']; ?>"  class="textbox" required="required"/>
		</td>
        </tr>
        <tr>
        <td nowrap="nowrap">
		    <div id="tit_div">Enter Commision Amt: </div>
		</td>
        <td nowrap="nowrap">
		<input name="txtcom" type="text" id="txtcom" value="<?php $res2['commision_amt']; ?>"  class="textbox" required="required" />
		</td>
        </tr>
        <tr>		
		<td nowrap="nowrap"><input type="submit" name="update" id="update" value="Update"/>
		
		</td>
      </tr>
      </form>
    </table>
	</td>
  </tr>
</table>


<div class="pagination"></div>
</fieldset>
</body>
<?php include "includes/footer.php"; ?>