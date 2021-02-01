<?php
include "includes/header.php";
?>
<script src="../js/pagination.js" type="text/javascript"></script>

<?php 

if($_REQUEST['inacc_id'])
{
$inacc_id=$_REQUEST['inacc_id'];
mysql_query("update payment_transaction set pay_status='1' where pay_id ='$inacc_id'");
header("location:commision_list.php?deact");
}
if($_REQUEST['acc_id'])
{
$acc_id=$_REQUEST['acc_id'];
mysql_query("update payment_transaction set pay_status='0' where pay_id ='$acc_id'");
header("location:commision_list.php?act");
}
?>
<body>
<fieldset class="table-bor">
<legend><strong>Commision List</strong></legend>	
<table width="50%" border="0" cellspacing="1" cellpadding="1" align="center">
<tr>
<?php if(isset($_REQUEST['deact'])){ ?>
<td colspan="2"><span style="color:#009900">Successfully Deactivated</span></td>
<? } ?>
<?php if(isset($_REQUEST['del'])){ ?>
<td colspan="2"><span style="color:#CC0033">Successfully Deleted</span></td>
<? } ?>
<?php if(isset($_REQUEST['act'])){ ?>
<td colspan="2"><span style="color: #009900">Successfully Activated</span></td>
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
<tr>
<th nowrap="nowrap">S.No</th>
   <th nowrap="nowrap" style="padding-left:30px;">Service Provider Name</th>
    <th nowrap="nowrap" style="padding-left:30px;">Bus Name</th>
     <!--<th nowrap="nowrap" style="padding-left:30px;">Mobile</th> -->
     <th nowrap="nowrap" style="padding-left:30px;">Transaction Id</th>
     <th nowrap="nowrap" style="padding-left:30px;">Amount</th>
     <th nowrap="nowrap" style="padding-left:30px;"> Ip address</th>
      
     <th nowrap="nowrap" style="padding-left:30px;"> Commision Amt</th>
      <th nowrap="nowrap" style="padding-left:30px;">Status</th>
    </tr>
  <?php $sql1=mysql_query("select * from payment_transaction");
  $i=1;
  while($res=mysql_fetch_array($sql1)){
  ?>
	<tr><td><?php echo $i;?></td>
    <td style="padding-left:30px;"><?php $sql2=mysql_query("Select * from serviceprovider_info where SP_id='$res[Service_provider_id]'");
	$res2=mysql_fetch_array($sql2);
	echo $res2['SP_name'];
	//echo $res['pay_serviceprovider_name'];
	?></td>
    <td style="padding-left:30px;"><?php $sql3=mysql_query("Select * from businfo where Bus_id='$res[bus_id]'");
	$res3=mysql_fetch_array($sql3);
	echo $res3['Bus_name'];
	//echo $res['bus_name'];
	?></td>
     <td style="padding-left:30px;"><?php 
	echo $res['pay_trans_id'];
	?></td>
     <td style="padding-left:30px;"><?php 
	echo $res['pay_amount'];
	?></td>
    <td style="padding-left:30px;"><?php 
	echo $res['pay_ip'];
	?></td>
     	
    <td style="padding-left:30px;"><?php 
	$c=$res['ticket_count'];
	$sql4=mysql_query("select * from ticket_commision");
	$res4=mysql_fetch_array($sql4);
	$tot=$c * $res4['commision_amt'];
	echo $tot;
	?></td>
    <td style="padding-left:30px;"><!--<a href="comm_mgmt_edit.php?edit_id=<?php echo $res['ticket_id']; ?>" title="Edit">
		<img src="../images/edit.png" border="0" /></a>-->
      <?php  if($res['pay_status']==0) {?>
        <a href="commision_list.php?inacc_id=<?php echo $res['pay_id']; ?>" title="Edit" onclick="return confirm('You want to Deactivate?')"><img src="../images/Active.png" border="0" /></a>
        <?php } ?>
        <?php  if($res['pay_status']==1) {?>
        <a href="commision_list.php?acc_id=<?php echo $res['pay_id']; ?>" title="Edit" onclick="return confirm('You want to activate?')"><img src="../images/inactive.png" border="0" /></a>
        <?php } ?>
       <!-- <a href="comm_mgmt.php?del_id=<?php echo $res['ticket_id']; ?>" title="Delete" onClick="return confirm('Are you sure! you want to delete')">
        <img src="../images/delete.png" border="0" /></a>-->
        </td>
    </tr>
	<?php $i++;}if(mysql_num_rows($sql1)==0){ ?>
    
    <tr><td> <span style="color:#990000">No Record Found..</span></td>
    </tr>
     <?php } ?>
</table>
<div class="pagination"></div>
</fieldset>
</body>
<?php include "includes/footer.php"; ?>