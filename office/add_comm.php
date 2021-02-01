<?php

include_once("includes/header.php");
	


	


?>




<body>

<fieldset class="table-bor">

	<legend><strong>Add Agent Commission</strong></legend> 
	
		<form action="" method="post" name="usr_add">
	
			<table align="center">
		
			<tr>
				<td width="140">Commisssion(percentage)</td>
				<td width="23"></td>
				<td width="321">
				<input type="text" name="comm" id="comm" value="" class="textbox2">
				
				
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			
			
			<tr>
				<td colspan="3" align="center">
				<!--<input type="button" name="sub_upd" id="sub_upd" value="Update" onClick="alert('This is Demo version !!!');">-->
					<input type="submit" name="sub_upd" id="sub_upd" value="Set Commission" >					
				</td>
			</tr>
		
		</table>	
		
		</form>
		<?php
		if(isset($_REQUEST['sub_upd']))
	{
	
		trim(extract($_POST)) ;
		
		
		$sql="update tbl_agent_comm set comm='$comm' where id='1' ";

		
	
	$upd = mysql_query($sql) ;
	
	if($upd)
	{
		header("location:add_comm.php?us") ;
	}
	
	}
	
	?>
	<?php
$mqry="SELECT * FROM tbl_agent_comm WHERE id='1'";
	//echo $company_qry ; exit ;
	
	$mem_rs=mysql_query($mqry);
	
	$data=mysql_fetch_array($mem_rs);
	?>
<table>
<tr><th> S.No</th><th>Commission</th></tr>

<tr><td> 1</td><td><?php echo $data['comm']; ?></td></tr>
</table>
	</fieldset>
	
</body>