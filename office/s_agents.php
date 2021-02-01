<?php include_once("includes/header.php"); ?>
<script type="text/javascript">
function printthis()
{
 var w = window.open('', '', 'width=800,height=600,resizeable,scrollbars');
 w.document.write($("#table1").html());
 w.document.close(); // needed for chrome and safari
 javascript:w.print();
 w.close();
 return false;
}
</script>
<script src="../js/pagination.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">

		

				
function fn_show_value()
{
	if($("#datepicker").val() == "")
	{
		$("#datepicker").val('Click here');
	}
}

function fn_show_value1()
{
	if($("#datepicker1").val() == "")
	{
		$("#datepicker1").val('Click here1');
	}
}
	$(function() {
	var dateFormat;
	try{
    dateFormat= $( ".selector" ).datepicker( "option", "dateFormat" );
	}
	catch(e){ }
	//minDate: +0, 
	//showOn: 'button',
		$('#datepicker').datepicker({ 		
			numberOfMonths: 1, 
			showButtonPanel: false, 			
			maxDate: '+3M +0D', 			 
			buttonImage: '../images/calendar_icon.gif', 
			buttonImageOnly: true, 
		    dateFormat: 'yy-mm-dd'			
		});	
	});
	$(function() {
	var dateFormat;
	try{
    dateFormat= $( ".selector" ).datepicker( "option", "dateFormat" );
	}
	catch(e){ }
	//minDate: +0, 
	//showOn: 'button',
		$('#datepicker1').datepicker({ 		
			numberOfMonths: 1, 
			showButtonPanel: false, 			
			maxDate: '+3M +0D', 			 
			buttonImage: '../images/calendar_icon.gif', 
			buttonImageOnly: true, 
		     dateFormat: 'yy-mm-dd'			
		});	
	});
	
	
function clear_text()
{
	document.getElementById('datepicker').value="";
	search_Psr();
}
	
	
</script>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />

<body onLoad="search_bkr();">
<fieldset class="table-bor">
		<legend><strong>Report Management</strong></legend> 
		<form method="post">
		<table width="100%" border="0" cellspacing="2" cellpadding="5">
<tr>		
			
				
			<td width="18%" align="center"> Agent </td>
			<td>
            <?php  					
					$sql4 = mysql_query("select a.agent_name as aname,a.agent_id as aid from agents as a, bookinginfo as b where a.agent_id=b.agent_id group by a.agent_name");
					
					?>
			    <select name="agent" id="agent"  class="combobox-small" style="width:150px;">
				<option value="0">All</option>
				
				<?php  					
									while($getrow = mysql_fetch_array($sql4))
					{
				?>
				<option value="<?php echo $getrow['aid']; ?>"><?php echo $getrow['aname'] ; ?> </option>
				<?php } ?>				
				</select>
			</td>
            
			
		  </tr>	
<tr>			
			
						
				
			
             <td width="17%"> From Date </td>			
			<td>			
				<input type="text" id="datepicker" name="datepicker"  style="cursor:pointer;" class="textbox" />				
			</td>
<td width="17%"> To Date </td>			
			<td>			
				<input type="text" id="datepicker1" name="datepicker1"  style="cursor:pointer;" class="textbox" />				
			</td>
			
		  </tr>			  
	
			  
               
<tr><td colspan="2"><input type="submit" name="submit" id="submit" value="SUBMIT"></td></tr>
             
		    
			  
		</table>
</form>
		
		<hr/>
		<!--a href="ecxel.php"><img src="images/ex.png" width="20" height="20"></a-->
<a href="" onClick="printthis(); return false;"><img src="images/print.png" width="20" height="20"></a>
		<table>
			<tr>
				<td>
					<label id='errmsg' class="errmsg"></label>
					<label id='response' class="errmsg"></label>
				</td>
			</tr>
		</table>

		<br>			
		
		<div id="loading"></div>
		
        <div id="container">		
            <table width="100%" border="0" cellspacing="2" cellpadding="5" id="table1">
  <tr>
  	<th nowrap="nowrap">Agent Name</th>
    <th nowrap="nowrap">Total Income</th>
	
    
  </tr>
<?php
if(isset($_POST['submit'])){
 $agent=$_POST['agent'];
 $datepicker=$_POST['datepicker'];
 $datepicker1=$_POST['datepicker1'];
$new=mysql_query("select * from agents where agent_id='$agent'");
while($agentn=mysql_fetch_array($new)){
$agent_name=$agentn['agent_name'];
}



$tot='0';
$sll=mysql_query("select * from bookinginfo where agent_id='$agent' and pay_status='1' and booked_date>='$datepicker' and booked_date<='$datepicker1' ");
$ct=mysql_num_rows($sll);
while($rw=mysql_fetch_array($sll)){
$tot=$tot+$rw[booking_amt];
}


?>
<tr>
<td align="left" nowrap="nowrap"><?php echo $agent_name; ?></a></td>
<td align="left" nowrap="nowrap"><?php echo $tot; ?></a></td>


</tr>
<?php

}
?>
</table>
            <div class="pagination"></div>			
        </div>
		<br />
		</fieldset>
</body>

<?php include "includes/footer.php"; ?>