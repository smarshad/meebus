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
<table width="60%" border="0" cellspacing="1" cellpadding="1" align="center">
<!--<tr><a href="commision_list.php">Commision List</a></tr>-->
<tr align="center">
   <th>Commission From User</th>
    <th>Commission From Service Provider</th>
     <th>Action</th>
    </tr>
  <?php $sql1=mysql_query("select * from ticket_commision");
  while($res=mysql_fetch_array($sql1)){
  ?>
	<tr align="center">
    <td><?php echo $res['user_comm'];?></td>
	 <td><?php echo $res['sp_comm'];?></td>
    <td><a href="comm_mgmt_edit.php?edit_id=<?php echo $res['ticket_id']; ?>" title="Edit">
		<img src="../images/edit.png" border="0" /></a>
       <!-- <a href="comm_mgmt.php?del_id=<?php echo $res['ticket_id']; ?>" title="Delete" onClick="return confirm('Are you sure! you want to delete')">
        <img src="../images/delete.png" border="0" /></a>-->
        </td>
    </tr>
	<?php }if(mysql_num_rows($sql1)==0){ ?>
    
    <tr><td> <span style="color:#990000">No Record Found..</span></td>
    </tr>
     <?php } ?>
</table>
<div class="pagination"></div>
</fieldset>
</body>
<?php include "includes/footer.php"; ?>