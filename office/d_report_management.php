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
		    dateFormat: 'dd-mm-yy'			
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
		    dateFormat: 'dd-mm-yy'			
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
		
		<table width="100%" border="0" cellspacing="2" cellpadding="5">
<tr>		
			
				
			<td width="18%" align="center"> Service Provider </td>
			<td>
			    <select name="s_provider" id="s_provider"  class="combobox-small" style="width:150px;">
				<option value="0">--Select--</option>				
				<?php  					
					$sql = mysql_query("select * from serviceprovider_info where SP_status = '1'") ;					
					while($getrow = mysql_fetch_array($sql))
					{
				?>
				<option value="<?php echo $getrow['SP_name']; ?>"><?php echo $getrow['SP_name'] ; ?> </option>
				<?php } ?>				
				</select>
			</td>
            <td width="17%"> Route </td>			
			<td>
          <?php   $sql2=	mysql_query("select * from service_routes where SR_status='1'") ;	
?>					
				<select name="route" id="route"  class="combobox-small" style="width:150px;">
				<option value="0">--Select--</option>				
				<?php
                   
					while($qyery=mysql_fetch_array($sql2))
					{
						$source = $qyery['SR_source'];
						$des = $qyery['SR_destination'];
						$sql = mysql_query("select * from cities where id='$source'") ;
						$src = mysql_fetch_array($sql);
						$sql3 = mysql_query("select * from cities where id='$des'") ;
						$des1 = mysql_fetch_array($sql3);
						$sr= $src['city_name'];
						$de= $des1['city_name'];
						$res=$sr.'-'.$de;
						?>
				<option value="<?php echo $res; ?>"><?php echo $res ; ?> </option>
				<?php } ?>				
				</select>	
						
									
			</td>
			
		  </tr>	
<tr>			
			
						
				
			<td width="18%" align="center"> Agent </td>
			<td>
            <?php  					
					$sql4 = mysql_query("select a.agent_name as aname from agents as a, bookinginfo as b where a.agent_id=b.agent_id group by a.agent_name");
					
					?>
			    <select name="agent" id="agent"  class="combobox-small" style="width:150px;">
				<option value="0">All</option>
				
				<?php  					
									while($getrow = mysql_fetch_array($sql4))
					{
				?>
				<option value="<?php echo $getrow['aname']; ?>"><?php echo $getrow['aname'] ; ?> </option>
				<?php } ?>				
				</select>
			</td>
             <td width="17%"> From Date </td>			
			<td>			
				<input type="text" id="datepicker" name="datepicker"  style="cursor:pointer;" class="textbox" />				
			</td>
			
		  </tr>			  
	
			  <tr>
               <td width="17%"> To Date </td>			
			<td>			
				<input type="text" id="datepicker1" name="datepicker1"  style="cursor:pointer;" class="textbox" />				
			</td>
             </tr>
		    
			  
		</table>
		
		<hr/>
		<a href="ecxel.php"><img src="images/ex.png" width="20" height="20"></a>
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
            <div class="data">			
			</div>
            <div class="pagination"></div>			
        </div>
		<br />
		</fieldset>
</body>

<?php include "includes/footer.php"; ?>