<?php include_once("includes/header.php"); ?>
<script src="../js/pagination.js" type="text/javascript"></script>
<style type="text/css">

/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */


a.ovalbutton:hover{ /* Hover state CSS */
background-position: bottom left;
}

a.ovalbutton:hover span{ /* Hover state CSS */
background-position: bottom right;
color: black;
}

.buttonwrapper{ /* Container you can use to surround a CSS button to clear float */
overflow: hidden; /*See: http://www.quirksmode.org/css/clearing.html */
width: 100%;
}

</style>
<body onLoad="search_SP();">
<fieldset class="table-bor">
		<legend><strong>Service Providers Management</strong></legend> 		
		<table width="100%" border="0" cellspacing="2" cellpadding="5">
		  <tr>
			<td>Type any : </td>
			<td><input type="text" size="50" class="textbox-big" onKeyUp="search_SP();" id="sp_search" /></td>
			<td> Status :
			    <select name="sp_status" id="sp_status" onChange="search_SP();">
				<option value="-1">All</option>
				<option value="1">Active</option>
				<option value="0">Inactive</option>
				</select>
			</td>
			<td><strong><a href="new_providers.php" class="ovalbutton"><span>Add New Service Provider</span></a></strong></td>
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