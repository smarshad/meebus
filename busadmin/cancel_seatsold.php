<?php
include_once("includes/header.php");


if(isset($_REQUEST['sp_id'])) 
{
  $gan=chk_SP_area($_REQUEST['sp_id'],$_SESSION['SP_id']);
  if($gan==0){
     header("location: home.php");
  }
  else{
	$compid=$gan;
	}
	
	//$company_qry="SELECT company.*,country.*,city.* FROM tbl_company as company,countries as country,tbl_city as city WHERE company.comp_id=".$compid." and comp_country=country.cid and comp_city=city.id";
	
	$company_qry="SELECT * FROM serviceprovider_info WHERE SP_id=".$compid;
	//echo $company_qry ; exit ;
	
	$company_rs=mysql_query($company_qry);
	
	$data=mysql_fetch_array($company_rs);
}
$ticket=$_REQUEST['ticket_no'];
$spids=$_REQUEST['SP_id'];
/*echo $spids;*/

$info=mysql_fetch_array(mysql_query("select * from cancelled_tickets where Ticket_id='$ticket' "));
/*echo $info['userid'];*/
$bookerinfo= mysql_fetch_array(mysql_query("select * from  booker_details where Ticket_ID='$ticket' "));
 
?>
<?php
if(isset($_REQUEST['proceed']))
{
	$_REQUEST['ticketid'];
	$_REQUEST['spids'];
	
$proceedsuc=mysql_query("update cancelled_tickets set cancelled_status='1' where Ticket_id='$_REQUEST[ticketid]' and SP_id='$_REQUEST[spids];'");
if($proceedsuc)
{
	header("location:cancelled_tickets.php?successproc");
}
	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>

<table cellspacing="5" cellpadding="0" align="center" width="50%" style="border:1px solid #99CCFF">
              <tbody>
              <tr>
                <td>Ticket Number</td>
                <td><?php echo $ticket; ?></td>
              </tr>
              <tr>
                <td>Booker Name</td>
                <td><?php echo $bookerinfo['Booker_name']; ?></td>
              </tr>
			   <tr>
                <td>Booker Address1</td>
                <td><?php echo $bookerinfo['Booker_address1']; ?></td>
              </tr>
			   <tr>
                <td>Booker Address2</td>
                <td><?php $bookerinfo['Booker_address2']; ?></td>
              </tr>
			  <tr>
                <td>Mobile No</td>
                <td><?php echo $bookerinfo['Booker_mobile']; ?></td>
              </tr>
			  
                <td>Email Address</td>
                <td><?php echo $bookerinfo['Booker_email']; ?></td>
              </tr>
              	
              <tr>
              <td></td>
               <td align="center" valign="top" colspan="2" >
                <?php 
			  if($info['cancelled_status']==0)
			  {
			   ?>
               <a href="?proceed&ticketid=<?php echo $ticket; ?>&spids=<?php echo $spids; ?>" class="ovalbutton"><span><strong>Pending</strong></span>
               <?php }
			   else if($info['cancelled_status']==1)
			   {
			    ?>
	<a href="?proceed&ticketid=<?php echo $ticket; ?>&spids=<?php echo $spids; ?>" class="ovalbutton"><span><strong>Processing</strong></span>
			  <?php }
			  else if($info['cancelled_status']==2)
			   {
			    ?>
	<a href="javascript:void(0);" class="ovalbutton"><span><strong>Paid</strong></span>
			  <?php } ?>
			  
				</td>
              </tr><br />		  
              <tr>
               <td align="center" valign="top" colspan="2">
			   <a href="javascript:void(0)" onclick="history.go(-1);"><strong><< Back</strong></a>
			  
				</td>
              </tr> 
			  </tbody></table>
			  
</body>
</html>
<?php include_once("includes/footer.php"); ?>