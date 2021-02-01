<?php include_once("includes/header.php"); ?>

<script src="../js/pagination.js" type="text/javascript"></script>

<body onLoad="search_Login();">

<fieldset class="table-bor">

		<legend><strong>Office Login Management</strong></legend> 
		
		
		
		
<a href="add_login.php">Add Officer Login</a>
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