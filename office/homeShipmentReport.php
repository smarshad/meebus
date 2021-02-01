<?php
include_once("includes/header.php");

?>
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

<script src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/typeahead.min.js"></script>
<style>
.tt-dropdown-menu{top:39px !important; width:173px}
span#report{width: 1050px;}
.twitter-typeahead {display:block !important;}
</style>


<fieldset class="table-bor">

		<legend><strong>Home Shipment Report </strong></legend> 
		<form>
		<table width="100%" border="0" cellspacing="2" cellpadding="5">
		 <tr>	
         	<td>
			    <input type="radio" name="tran_type" value="In">Arrive From</input>
                <input type="radio" name="tran_type" value="Out">Send To</input>
			</td>	
            <td>
			    <input type="text" placeholder="City Name" id="origin" name="origin" />
			</td>
             <td>
			    <select name="type" id="type"  class="combobox-small">
                	<option value="">-- Service Type --</option>
                    <?php
					$serviceqry=mysql_query("SELECT * FROM servicetype WHERE status=1");
					$servicDetails=mysql_fetch_array($serviceqry);
	/*				foreach($servicDetails as $ser)
					{
	*/				?>
					<option value="<?php echo $servicDetails['serviceCode']; ?>"><?php echo $servicDetails['serviceType']; ?></option>
					<?php
				//	}
					?>
				</select>
			</td>
            <td><button type="button" name="submit" id="submit" value="Submit">Submit</button></td>
			
		  </tr>	

		</table>
</form>
		
		<hr/>
		
		<a href="" onClick="printthis(); return false;"><img src="images/print.png" width="20" height="20"></a>

  <br><br>

  <span class="Partext1" id="report"><br>  
   </span>
		
		</fieldset>
</body>
<?php include "includes/footer.php"; ?>
<script>
$('#origin').typeahead({
    name: 'origin',
	 remote: {
            url : '../includes/source.php?query=%QUERY'
        },
    minLength: 3, // send AJAX request only after user type in at least 3 characters
    limit: 10 // limit to show only 10 results
});
$('#destination').typeahead({
    name: 'destination',
	 remote: {
            url : '../includes/source.php?query=%QUERY'
        },
    minLength: 3, // send AJAX request only after user type in at least 3 characters
    limit: 10 // limit to show only 10 results
});
</script>
<script>
$("#submit").click( function() {
	
	origin=$("#origin").val();
	aws=$("#aws").val();
	type=$("#type").val();
	$.post("homeShipment.php?&origin="+origin+"&aws="+aws+"&type="+type, function ( data ) {
		$("#report").html( data );
	});
});
</script>