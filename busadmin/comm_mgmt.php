<?php
include "includes/header.php";
?>
<script src="../js/pagination.js" type="text/javascript"></script>

<?php 
if($_REQUEST['save'])
{
$comm_amt=$_REQUEST['txtcom'];
$tickettype=$_REQUEST['tickettype'];
$sql=mysql_query("Insert into ticket_commision (tickettype,commision_amt) values ('$tickettype','$comm_amt')");
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
    <form name="commision" action="" method="post">
      <tr>
        <td nowrap="nowrap">
		    <div id="tit_div">Ticeket Type: </div>
		</td>
        <td nowrap="nowrap">
		<input name="tickettype" type="text" id="tickettype" value=""  class="textbox" required="required"/>
		</td>
        </tr>
        <tr>
        <td nowrap="nowrap">
		    <div id="tit_div">Enter Commision Amt: </div>
		</td>
        <td nowrap="nowrap">
		<input name="txtcom" type="text" id="txtcom" value=""  class="textbox" required="required" />
		</td>
        </tr>
        <tr>		
		<td nowrap="nowrap"><input type="submit" name="save" id="save" value="Save"/>
		
		</td>
      </tr>
      </form>
    </table>
	</td>
  </tr>
</table>
<hr/>
<table width="50%" border="0" cellspacing="1" cellpadding="1" align="center">
<tr>
   <th>Ticket Type</th>
    <th>Amount</th>
     <th>Action</th>
    </tr>
  <?php $sql1=mysql_query("select * from ticket_commision");
  while($res=mysql_fetch_array($sql1)){
  ?>
	<tr><td><?php echo $res['tickettype'];?></td>
    <td><?php echo $res['commision_amt'];?></td>
    <td><a href="comm_mgmt_edit.php?edit_id=<?php echo $res['ticket_id']; ?>" title="Edit">
		<img src="../images/edit.png" border="0" /></a>
        <a href="comm_mgmt.php?del_id=<?php echo $res['ticket_id']; ?>" title="Delete" onClick="return confirm('Are you sure! you want to delete')">
        <img src="../images/delete.png" border="0" /></a>
        </td>
    </tr>
	<?php } ?>
</table>
<div class="pagination"></div>
</fieldset>
</body>
<?php include "includes/footer.php"; ?>