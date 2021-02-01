<?php
include_once("includes/header.php");

if(isset($_REQUEST['sp_id']))
{
	$compid=$_REQUEST['sp_id'];
	
	//$company_qry="SELECT company.*,country.*,city.* FROM tbl_company as company,countries as country,tbl_city as city WHERE company.comp_id=".$compid." and comp_country=country.cid and comp_city=city.id";
	
	$company_qry="SELECT * FROM serviceprovider_info WHERE SP_id=".$compid;
	//echo $company_qry ; exit ;
	
	$company_rs=mysql_query($company_qry);
	
	$data=mysql_fetch_array($company_rs);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>

<table cellspacing="10" cellpadding="0" align="center" width="60%" style="border:1px solid #99CCFF; padding-left:40px;">
              <tbody>
			  <tr>
                <td colspan="3" style="padding-left:140px;"><strong><?php echo $data['SP_name']; ?> Details</strong></td>
              </tr>
			  <tr><td colspan="3">&nbsp;</td></tr>
              <tr>
                <td width="20%" nowrap="nowrap">Service Provider's Name</td>
				<td width="10%" align="center">:</td>
                <td><?php echo $data['SP_name']; ?></td>
              </tr>
			  <tr>
			  <td width="20%" nowrap="nowrap">Status</td>
			  <td width="10%" align="center">:</td>
			  <td><?php echo $data['SP_status'] ? '<img src="../images/Active.png" alt="Active" title="Active">':'<img src="../images/inactive.png" alt="Active" title="Active">'; ?></td>
			  </tr>
			   <tr>
                <td width="20%" nowrap="nowrap">Address1</td>
				<td width="10%" align="center">:</td>
                <td><?php echo $data['SP_address1']; ?></td>
              </tr>
			   <tr>
                <td width="20%" nowrap="nowrap">Address2</td>
				<td width="10%" align="center">:</td>
                <td><?php if(!empty($data['SP_address2'])){ echo $data['SP_address2']; } else { echo "<span class='err_msg'>Not mentioned</span>"; } ?></td>
              </tr>
			  <tr>
                <td width="20%" nowrap="nowrap">State</td>
				<td width="10%" align="center">:</td>
                <td><?php echo $data['SP_state']; ?></td>
              </tr>
			  <tr>
                <td width="20%" nowrap="nowrap">City</td>
				<td width="10%" align="center">:</td>
                <td><?php echo $data['SP_city']; ?></td>
              </tr>
			  <tr>
                <td width="20%" nowrap="nowrap">Email Address</td>
				<td width="10%" align="center">:</td>
                <td><?php echo $data['SP_email']; ?></td>
              </tr>
              <tr>
                <td width="20%" nowrap="nowrap">LandLine Number(s)</td>
				<td width="10%" align="center">:</td>
                <td>
				<?php echo $data['SP_landNo1']; ?>,<br />
				<?php  if(!empty($data['SP_landNo2'])){ echo $data['SP_landNo2']; } else { echo "<span class='err_msg'>Not mentioned</span>"; }; ?>
				</td>
              </tr>
			  <tr>
			  <td valign="top" width="20%" nowrap="nowrap">Mobile Number(s)</td>
			  <td width="10%" align="center" valign="top">:</td>
			  <td><?php echo $data['SP_mobile1']; ?>,<br />
			      <?php echo $data['SP_mobile2']; ?>,<br />
				  <?php  if(!empty($data['SP_mobile3'])){ echo $data['SP_mobile3']; } else { echo "<span class='err_msg'>Not mentioned</span>"; } ?></td>
			  </tr>
			   <tr>
			  <td valign="top" width="20%" nowrap="nowrap">VAT Number</td>
			  <td width="10%" align="center" valign="top">:</td>
			  <td><?php echo $data['SP_vat']; ?> </td>
			  </tr>
			   <tr>
			  <td valign="top" width="20%" nowrap="nowrap">Fax Number</td>
			  <td width="10%" align="center" valign="top">:</td>
			  <td><?php echo $data['SP_fax']; ?></td>
			  </tr>
			   <tr>
			  <td valign="top" width="20%" nowrap="nowrap">Contact Person Details</td>
			  <td width="10%" align="center" valign="top">:</td>
			  <td><?php echo $data['SP_emgFname']; ?>,<br />
			      <?php if(!empty($data['SP_emgDesignation'])){ echo $data['SP_emgDesignation']; } else { echo "<span class='err_msg'>Not mentioned</span>"; } ?>,<br />
				  <?php if(!empty($data['SP_emgCallno'])){ echo $data['SP_emgCallno']; } else { echo "<span class='err_msg'>Not mentioned</span>"; } ?></td>
			  </tr>
              <tr>
                <td valign="top" width="20%" nowrap="nowrap">Comments</td>
				<td width="10%" align="center" valign="top">:</td>
                <td><?php if(!empty($data['SP_comments'])){ echo $data['SP_comments']; } else { echo "<span class='err_msg'>Not mentioned</span>"; } ?></td>
              </tr>			  
			   <tr><td colspan="3">&nbsp;</td></tr>
              <tr>
               <td valign="top" width="20%" nowrap="nowrap" align="right">
			   <a href="companymgnt.php"><strong><< Back</strong></a></td>
			   <td width="10%" align="center">&nbsp;</td>
			   <td><a href="new_providers.php?sp_id=<?php echo $compid; ?>"><strong>Edit >></strong></a></td>
			   <!-- <div class="button" style="margin-left:150px;">
				<div class="left-btn"></div>
				<div class="mid-btn"><a href="companymgnt.php">Back</a></div>
				<div class="right-btn"> </div>
				</div>			  
				</td>-->
              </tr> 
			  </tbody></table>
			  
</body>
</html>
<?php include_once("includes/footer.php"); ?>