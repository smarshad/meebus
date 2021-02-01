<?php
include_once("includes/header.php");

if(isset($_REQUEST['b_id']))
{
	$b_id=$_REQUEST['b_id'];
  $sp_id=$_REQUEST['sp_id'];
	$sql6=mysql_fetch_array(mysql_query("SELECT * FROM businfo where bus_id='$b_id'"));
$sql7=mysql_fetch_array(mysql_query("SELECT * FROM serviceprovider_info where SP_id='$sp_id'"));
	//$company_qry="SELECT company.*,country.*,city.* FROM tbl_company as company,countries as country,tbl_city as city WHERE company.comp_id=".$compid." and comp_country=country.cid and comp_city=city.id";
	

	
	
}
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>

<table cellspacing="10" cellpadding="0" align="center" width="90%" style="border:1px solid #99CCFF; padding-left:10px;">
<a href='javascript:history.go(-1)'> << Back </a>
<tr><td colspan="4" style="font-size:12px; font-weight:bold">Service Provider Name : <?php echo $sql7['SP_name']; ?></td>
      <td colspan="4" style="font-size:12px; font-weight:bold">Bus Name : <?php echo $sql6['Bus_name']; ?></tr>
			   
			   
               <tr><td  colspan="8" style="border-bottom:2px #0099CC solid; ">&nbsp;</td></tr>
              <tbody>
			  <tr>
               <th nowrap="nowrap"><strong>S.No</strong></th>
               <th nowrap="nowrap"><strong>Transaction Id</strong></th>
                <th nowrap="nowrap"><strong>Date</strong></th>
                <th nowrap="nowrap"><strong>Seat No</strong></th>
                 <th nowrap="nowrap"><strong>Ticket Id</strong></th>
           
                  <th nowrap="nowrap"><strong>Pay Status</strong></th>
              </tr>
               
              <?php
			
			   $i=1;
			  $tot=0;
			  $tot1=0;
			 // echo "SELECT * FROM bookinginfo,payment_transaction,booker_details WHERE bookinginfo.Bus_id='$b_id' and bookinginfo.SP_id='$sp_id' and bookinginfo.pay_trans_id = payment_transaction.pay_trans_id and booker_details.Ticket_ID=bookinginfo.Ticket_ID"; 
			  
			  $sql="SELECT * FROM bookinginfo,payment_transaction,booker_details WHERE bookinginfo.Bus_id='$b_id' and bookinginfo.SP_id='$sp_id' and bookinginfo.pay_trans_id = payment_transaction.pay_trans_id and booker_details.Ticket_ID=bookinginfo.Ticket_ID";
	//echo $company_qry ; exit ;
	
	$res=mysql_query($sql);
			  
			  while ($data=mysql_fetch_array($res)) { ;?>
			  <tr><td colspan="3">&nbsp;</td></tr>
              <tr align="center">
                  <td><?php echo $i; ?></td>
                     <td><?php echo $data['pay_trans_id']; ?></td>
                     <td><?php echo $data['pay_date_time']; ?></td>
                <td><?php echo $data['SeatNo']; ?></td>
                <td><?php echo $data['Ticket_ID']; ?></td>
               
           
                 <td><?php echo $data['pay_bankRespMsg']; ?></td>
              <?php $tot = $tot + $data['perticket_comm_amt']; ?>
              
              </tr>
              
              <?php $i++;} ?>
			 
			   <tr><td colspan="3">&nbsp;</td></tr>
            <?php  if(mysql_num_rows($res)==0){ ?>  <tr>
               <td valign="top" width="20%" nowrap="nowrap" align="right">
               <span style="color:#990000">No Record Found..</span>
			  <!-- <a href="paymentpertrans.php"><strong><< Back</strong></a> --></td>
			  <!-- <td width="10%" align="center">&nbsp;</td>
			   <td><a href="new_providers.php?sp_id=<?php echo $compid; ?>"><strong>Edit >></strong></a></td> -->
			   <!-- <div class="button" style="margin-left:150px;">
				<div class="left-btn"></div>
				<div class="mid-btn"><a href="companymgnt.php">Back</a></div>
				<div class="right-btn"> </div>
				</div>			  
				</td>-->
                <?php } ?>
              </tr> 
			  </tbody></table>
			  
</body>
</html>
<?php include_once("includes/footer.php"); ?>