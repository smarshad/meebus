<?php

@session_start();

ob_start();

error_reporting(0);

if($_SESSION['aff']['affiliate_id']=='')

header('location:index.php');

include '../database/connect.php';
$name=$_SESSION['aff']['first_name'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Busbooking</title>
<style>
.site_border1 tr td {
    border: 1px dotted #999999 !important;
    padding: 10px !important;
}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <link href="datepicker/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" type="text/css" />

        <link href="datepicker/jquery.ui.theme.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="js/libs/jquery-1.7.1.min.js" language="javascript" ></script>
        <link rel="stylesheet" type="text/css" href="css/style11.css"/>
</head>

<body>
 <?php include('header.php'); 
 $idd=$_SESSION['aff']['affiliate_id'];
 ?>
<div align="center" style="width:70%;margin: 0 auto;padding:2% 0"><?php
      session_start();


//echo $new="SELECT * FROM user_login WHERE email_id='$email_id' AND password='$password'"; die;
$res="SELECT * FROM book_bus_tickets WHERE aff_id='$idd' and status='BOOKED'";
$result = mysql_query($res);

$res1="SELECT * FROM aff_markup ";
$result1 = mysql_query($res1);
while($row2 = mysql_fetch_array($result1))
{
	$aff_markup=$row2['aff_markup'];
}
$totcomm=0;
?>
<table width="100%" cellspacing="0" cellpadding="5" border="1" align="right" class="site_border1">
                  <tbody>
                    
					 <tr>
					  <td class="sidebartitle1" colspan="6"><strong>My Commission</strong></td>
				      </tr>
					 <tr>
					  <td width="210" height="20" align="center"><strong>Booking ID</strong></td>
					  <td width="210" align="center"><strong>From</strong></td>
					  <td width="149" align="center"><strong>TO</strong></td>
					  <td width="149" align="center"><strong>Date</strong></td>
					  <td width="223" align="center"><strong>Amount</strong></td>
					  <td width="101" align="center"><strong>Commission</strong></td>
					 </tr>
                     <?php
while($data = mysql_fetch_array($result))
{
	$comm=($data['total_fare']*$aff_markup)/100;
	$totcomm+=$comm;
	?>
					<tr>
					  <td height="20" align="center"><?php echo $data['id']; ?></td>
					  <td align="center"><?php echo $data['fromStationId']; ?></td>
					  <td align="center"><?php echo $data['toStationId']; ?></td>
					  <td align="center"><?php echo $data['travelDate']; ?></td>
					  <td align="center"><?php echo $data['total_fare']; ?></td>
					  <td align="center"><?php echo $comm; ?></td>
					</tr>
                    <?php
}

?>

                            <tr>
<td height="40" colspan="6" align="center" bgcolor="#FFFFFF">Total Commission : <?php echo $totcomm; ?></td>
</tr>
                  </tbody>
              </table>
<br clear="all">
</div>


</body>
<?php include 'footer.php'; ?>
</html>