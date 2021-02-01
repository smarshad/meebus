<?php
	include_once("includes/header.php");
	//require("../includes/functions.php");
	if (isset($_POST['agent_id']) && isset($_POST['activate']))
{
    $agent_id = $_POST['agent_id'];
//	echo "UPDATE agent_reqbusowner SET status='2' WHERE id='$agent_id' "; exit;
    $sql = mysql_query("UPDATE agent_reqbusowner SET status='0' WHERE id='$agent_id' ");
	 echo "<script>alert('Dectivated!'); </script>";
}

?>

<script src="../js/pagination.js" type="text/javascript"></script>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript" language="javascript">
function fn_hide()
{
	if($("#datepicker").val() == "Click here")
	{
		$("#datepicker").val('');
	}
}
				
function fn_show_value()
{
	if($("#datepicker").val() == "")
	{
		$("#datepicker").val('Click here');
	}
}

	$(function() {
	var dateFormat;
	try{
    dateFormat= $( ".selector" ).datepicker( "option", "dateFormat" );
	}
	catch(e){ }
	
		$('#datepicker').datepicker({ 		
			numberOfMonths: 1, 
			showButtonPanel: false, 
			//minDate: +0, 
			maxDate: '+3M +0D', 
			//showOn: 'button', 
			buttonImage: '../images/calendar_icon.gif', 
			buttonImageOnly: true, 
		    dateFormat: 'yy-mm-dd'
			
		});	
	});
	
	
function clear_text()
{
	document.getElementById('datepicker').value="";
	search_Psr();
	//window.refresh("passmgnt.php");
	//return true;
}
	
</script>

<body >
<fieldset class="table-bor">
		<legend><strong>Accepted Agent List</strong></legend> 
		
		
		
		
		
	<?php /*?>	<table>
			<tr>
				<td>
					<label id='errmsg' class="errmsg"></label>
					<label id='response' class="errmsg"></label>
				</td>
			</tr>
		</table>

		<br>			<?php */?>
		
		<div class="data">
<table width="100%" border="0" cellspacing="2" cellpadding="5">
  <thead>
  	<th nowrap="nowrap">Sno</th>   
    <th nowrap="nowrap">Agent Name</th>
    <th nowrap="nowrap">Route</th>
    <th nowrap="nowrap">Bus Name</th>
    
   
	<th nowrap="nowrap">Action</th>	
  </thead>
  <tr>
				<td>
					<label id='errmsg' class="errmsg"></label>
					<label id='response' class="errmsg"></label>
				</td>
			</tr>
  <?php
  $i=1;
 // echo "SELECT * FROM agent_reqbusowner where status='1' AND agent_id='".$_SESSION['SP_id']."'";
  $query = mysql_query("SELECT * FROM agent_reqbusowner where status='2' AND sp_id='".$_SESSION['SP_id']."'");
  if($query) {
  while($row = mysql_fetch_array($query)) 
  
		{		?>
		<tr>			
			<td align="left" nowrap="nowrap">
            <?php echo $i; ?>
            
			</td>
            
            <td><?php 
			
			$query1 = mysql_query("SELECT * FROM agents where agent_id='".$row['agent_id']."'");
  while($row1 = mysql_fetch_array($query1)) 
		{	
			echo $row1['agent_name'];
		} ?></td>
       
        
        <td><?php 
		//	echo "SELECT * FROM businfo where SP_id='".$_SESSION['SP_id']."'"; exit;
			$query1 = mysql_query("SELECT * FROM businfo where SP_id='".$_SESSION['SP_id']."' AND Bus_id='".$row['bus_id']."'");
  while($row2 = mysql_fetch_array($query1)) 
		{	$bus_name=$row2['Bus_name'];
			 $from_to=get_city_name($row2['Bus_fromcity'])."-".get_city_name($row2['Bus_tocity']);'</br>';
			echo $from_to;
		} ?></td>
         <td><?php echo $bus_name; ?></td>
        <td>
         <form method="post" action="">
                                            <input type="hidden" value="<?php echo $row['id']; ?>" name="agent_id" />


                                            <input type="image" name="activate" alt="Click To Remove From List" value="Click To Remove From List" src="images/deactivate1.jpg" width="11" height="11"  border="0"/>
                                            <input type="hidden" name="activate" value="activate" />
                                        </form>
       </td>
       
      
       
       
            
		  </tr>
          <?php $i++; } }else { ?>
<tr><td colspan="3">No Record Found</td></tr>		<?php } ?>
</table></div>
        <div id="container">		
            <div class="data">			
			</div>
            <div class="pagination"></div>			
        </div>
		<br />
		</fieldset>
</body>

<?php include "includes/footer.php"; ?>