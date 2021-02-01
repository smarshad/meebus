<?php
include "includes/header.php";
$id=$_GET['id'];
$sqw="select * from businfo where Bus_id='$id'";
$sqq=mysql_query($sqw);
$dat=mysql_fetch_array($sqq);
$track_device=$dat['track_device'];
$sql="select * from track where deviceno='$track_device'";
	
$sq=mysql_query($sql);
$data=mysql_fetch_array($sq);

?>
 

<body onLoad="searchBus();">
<fieldset class="table-bor">
<legend><strong>Bus Track Management</strong></legend>

<table width="100%">
	<tr>		
		<td>			
			

<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $data['lat']; ?>,<?php echo $data['lan']; ?>&amp;key=AIzaSyD_qxPJPCC1MT2rz1kWbZBZ3DW_2etgOM0 "></iframe>

	  </td>
	  	
	</tr>
	
</table>


</fieldset>
<?php
include "includes/footer.php";


?>
</body>