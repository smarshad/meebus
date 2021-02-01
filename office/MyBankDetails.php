<?php include("includes/header.php"); ?>
<script src="../js/pagination.js" type="text/javascript"></script>
<body onLoad="search_bank();">
<fieldset class="table-bor">
		<legend><strong>Bank Details</strong></legend> 		
		<table width="100%" border="0" cellspacing="2" cellpadding="5">
		  <tr>
			<td>Type any : </td>
			<td><input type="text" size="50" class="textbox-big" onKeyUp="search_bank();" id="banksearch_txt" /></td>
			<td> Status :
			    <select name="bank_status" id="bank_status" onChange="search_bank();">
				<option value="-1">All</option>
				<option value="1">Active</option>
				<option value="0">Inactive</option>
				</select>
			</td>
			<td><strong><a href="addBankDetails.php">Add New Bank Details</a></strong></td>
		  </tr>		  
		</table>
		
		<hr/>
		
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