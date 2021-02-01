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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>

<table cellspacing="15" cellpadding="10">
              <tbody>
              <tr>
                <td>Service Provider's Name</td>
                <td><?php echo ucfirst($data['SP_name']); ?></td>
              </tr>
			  <tr>
			  <td>Status</td>
			  <td><?php echo $data['SP_status'] ? '<img src="../images/Active.png" alt="Active" title="Active">':'<img src="../images/inactive.png" alt="Active" title="Active">'; ?></td>
			  </tr>
			   <tr>
                <td>Address1</td>
                <td><?php echo $data['SP_address1']; ?></td>
              </tr>
			   <tr>
                <td>Address2</td>
                <td><?php if(!empty($data['SP_address2'])){ echo $data['SP_address2']; } else { echo "<span class='err_msg'>Not mentioned</span>"; } ?></td>
              </tr>
			  <tr>
                <td>State</td>
                <td><?php echo $data['SP_state']; ?></td>
              </tr>
			  <tr>
                <td>City</td>
                <td><?php echo $data['SP_city']; ?></td>
              </tr>
			  <tr>
                <td>Email Address</td>
                <td><?php echo $data['SP_email']; ?></td>
              </tr>
              <tr>
                <td>LandLine Number(s)</td>
                <td>
				<?php echo $data['SP_landNo1']; ?>,<br />
				<?php  if(!empty($data['SP_landNo2'])){ echo $data['SP_landNo2']; } else { echo "<span class='err_msg'>Not mentioned</span>"; }; ?>
				</td>
              </tr>
			  <tr>
			  <td valign="top">Mobile Number(s)</td>
			  <td><?php echo $data['SP_mobile1']; ?>,<br />
			      <?php echo $data['SP_mobile2']; ?>,<br />
				  <?php  if(!empty($data['SP_mobile3'])){ echo $data['SP_mobile3']; } else { echo "<span class='err_msg'>Not mentioned</span>"; } ?></td>
			  </tr>
			   <tr>
			  <td valign="top">Contact Person Details</td>
			  <td><?php echo $data['SP_emgFname']; ?>,<br />
			      <?php if(!empty($data['SP_emgDesignation'])){ echo $data['SP_emgDesignation']; } else { echo "<span class='err_msg'>Not mentioned</span>"; } ?>,<br />
				  <?php if(!empty($data['SP_emgCallno'])){ echo $data['SP_emgCallno']; } else { echo "<span class='err_msg'>Not mentioned</span>"; } ?></td>
			  </tr>
              <tr>
                <td valign="top">Comments</td>
                <td><?php if(!empty($data['SP_comments'])){ echo $data['SP_comments']; } else { echo "<span class='err_msg'>Not mentioned</span>"; } ?></td>
              </tr>			  
              <tr>
               <td align="center" valign="top" colspan="2">
			   <a href="javascript:void(0)" onclick="history.go(-1);"><strong><< Back</strong></a>
			   <a href="new_providers.php?sp_id=<?php echo $_REQUEST['sp_id']; ?>"><strong>Edit >></strong></a>
				</td>
              </tr> 
			  </tbody></table>
			  
</body>
</html>
<?php include_once("includes/footer.php"); ?>