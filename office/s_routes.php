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
$route=$source.'-'.$des;
						?>
				<option value="<?php echo $route; ?>"><?php echo $res ; ?> </option>
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
  	<th nowrap="nowrap">Route</th>
    
    <th nowrap="nowrap">Total Income</th>
	
    
  </tr>
<?php
if(isset($_POST['submit'])){
 $route=$_POST['route'];
 $datepicker=$_POST['datepicker'];
 $datepicker1=$_POST['datepicker1'];
$ex=explode("-",$route);
$from=$ex[0];
$to=$ex[1];
$sql = mysql_query("select * from cities where id='$from'") ;
						$src = mysql_fetch_array($sql);
						$sql3 = mysql_query("select * from cities where id='$to'") ;
						$des1 = mysql_fetch_array($sql3);
						$sr= $src['city_name'];
						$de= $des1['city_name'];

$tot='0';
$sl=mysql_query("select * from businfo where Bus_fromcity='$from' AND Bus_tocity='$to'");
while($sl1=mysql_fetch_array($sl)){
$busid=$sl1['Bus_id'];
$sl2=mysql_query("select * from bookinginfo where Bus_id='$busid' AND booked_date>='$datepicker' AND booked_date<='$datepicker1' ");
while($sl3=mysql_fetch_array($sl2)){
$tot=$tot+$sl3[booking_amt];
}

}


?>
<tr>
<td align="left" nowrap="nowrap"><?php echo $sr.'-'.$de; ?></a></td>
<td align="left" nowrap="nowrap"><?php echo $tot; ?></a></td>


</tr>
<?php

}
?></table>
            <div class="pagination"></div>			
        </div>
		<br />
		</fieldset>
</body>

<?php include "includes/footer.php"; ?>