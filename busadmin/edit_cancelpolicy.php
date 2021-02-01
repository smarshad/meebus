<?php  include_once("includes/header.php"); ?>
<?php if(!isset($_REQUEST['c_id'])) { header("location: cancelpolicymgnt.php"); } ?>
<script src="../js/pagination.js" type="text/javascript"></script>
<body onLoad="search_SP_name();">
<fieldset class="table-bor">
		<legend>Cancel Policies Management</legend> 
		<table width="100%" border="0" cellspacing="2" cellpadding="5" >
		<tr><td colspan="4">
		<div id="ad" style="visibility:visible; ">
		<table width="100%" border="0" cellspacing="2" cellpadding="5" style="border-bottom:#666666 1px solid; padding-bottom:10px;">
		<?php
		 	$policy_id = $_REQUEST['c_id']; 			
			$p_qry = get_cancelpolicy_qry($policy_id);
		 ?>
		<form name="form" action="" method="post">
		    <tr><td colspan="6">&nbsp;</td></tr>
			<tr>
			<td width="1%">&nbsp;</td>
			<td width="17%"> Durtion for Cancellation </td>
			<td width="10%" > Time </td>
			<td width="17%"> Refundable Amount </td>
			
		</tr>
		<tr>
			
			 <td>
			 <input type="hidden" value="<?php echo $_SESSION['SP_id']; ?>" name="service_provider" id="service_provider" />
			<!--<select name="service_provider" id="service_provider" class="combobox-small">
				<option value="0">Select</option>
				<?php  $qry = getServiceprovider();
				
					while($row=mysql_fetch_array($qry)) {
				
				 ?>
				 <option value="<?php echo $row['SP_id']; ?>" <?php if($p_qry['SP_id']==$row['SP_id']) { ?> selected="selected" <?php } ?>><?php echo $row['SP_name']; ?></option>
				 <?php } ?>
				</select>--></td>
				
			
			<td>
			    <select name="duration" id="duration"  class="combobox-small">
				<option value="0">Select</option>
				<option value="Before" <?php if($p_qry['duration']=="Before") { ?> selected="selected" <?php } ?>>Before</option>
				<option value="After" <?php if($p_qry['duration']=="After") { ?> selected="selected" <?php } ?> >After</option>
				<option value="Within" <?php if($p_qry['duration']=="Within") { ?> selected="selected" <?php } ?> >Within</option>
				</select>
			</td>
			
			
			<td width="21%"><input type="text" name="time" id="time" size="2" value="<?php echo $p_qry['time']; ?>"  maxlength="2"> in Hours</td>
			
			<td width="21%"><input type="text" name="refund" id="refund" size="2" value="<?php echo $p_qry['refundable_amt']; ?>" maxlength="2">%</td>
			
		  </tr>
			 
			 <tr>
			 			 <td colspan="4" align="center">
						 <input type="hidden" name="c_id" id="c_id" value="<?php echo $policy_id; ?>" >
						 <input type="submit" name="submit" id="submit"  value=" Edit " onClick="return validate_policy1(this.form);" >
						 <!--<input type="button" name="submit" id="submit"  value=" Edit " onClick="alert('This is Demo version !!!');" >-->
						 <input type="submit" name="back" id="back"  value=" Back " onBlur="Javascript:history.go(-1);">
						 </td>
			 </tr>
			</form>
			</table>
			</div>
			
			
			</td></tr>
		
		<tr><td colspan="4">
		<div id="restype">
		<input type="hidden" onKeyUp="search_SP_name();" id="sp_search" />		
		</div></td></tr></table>
		
		<br>
		
		<div id="loading"></div>
        <div id="container">		
            <div class="data">			
			</div>
            <div class="pagination"></div>			
        </div>
		<br />
		</fieldset>
</body>

<?php include "includes/footer.php"; ?>

