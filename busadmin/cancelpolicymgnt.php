<?php
	include_once("includes/header.php");
?>
<script src="../js/pagination.js" type="text/javascript"></script>
<body onLoad="search_SP_name();">
<fieldset class="table-bor">
		<legend><strong>Cancel Policies Management</strong></legend> 
		
		
		<table width="100%" border="0" cellspacing="2" cellpadding="5"  >
		
		<tr>
			<td colspan="4"></td>
			</tr>
		 
		
		<tr><td colspan="4">
		<div id="ad" style="visibility:visible; ">
		<table width="100%" border="0" cellspacing="2" cellpadding="5" style="border-bottom:#6AA6E8 1px solid; padding-bottom:10px;">
		
		<form name="form" action="" method="post" onSubmit="return validate_policy(this.form);">
		    <tr><td colspan="6">&nbsp;</td></tr>
			 <?php /*?><td>
			 <input type="hidden" name="service_provider" id="service_provider" value="<?php echo $_SESSION['SP_id']; ?>" />
			</td><?php */?>
            <tr>
            <td>Cancellation Policy (Hours)</td>
            <td><input type="text" name="cancelpolicy[]" id="cancelpolicy"></td>
            <td>Cancellation Charge (%)</td>
            <td><input type="text" name="cancelpolicy[]" id="cancelcharge"></td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td><input type="text" name="cancelpolicy[]" id="cancelpolicy1"></td>
            <td>&nbsp;</td>
            <td><input type="text" name="cancelpolicy[]" id="cancelcharge1"></td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td><input type="text" name="cancelpolicy[]" id="cancelpolicy2"></td>
            <td>&nbsp;</td>
            <td><input type="text" name="cancelpolicy[]" id="cancelcharge2"></td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td><input type="text" name="cancelpolicy[]" id="cancelpolicy3"></td>
            <td>&nbsp;</td>
            <td><input type="text" name="cancelpolicy[]" id="cancelcharge3"></td>
            </tr>
			 <tr>
                 <td colspan="4" align="center">
                 <input type="submit" name="submit" id="submit"  value=" Submit " >
                 <input type="reset" name="reset" id="reset"  value=" Reset ">
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


