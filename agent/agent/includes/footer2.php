<div class="footer">
    <div class="container-fluid">
        <div class="row-fluid">
        	<footer>
				<p>&copy; DOD IT Solutions 2018</p>
			</footer>
        </div>
    </div>
</div>
<script src="<?php echo $base_url;?>js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $base_url;?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url;?>vendors/easypiechart/jquery.easy-pie-chart.js"></script>
<script src="<?php echo $base_url;?>assets/scripts.js"></script>		
<script src="<?php echo $base_url; ?>vendors/datatables/js/jquery.dataTables.min.js"></script>
<?php if(isset($_SESSION['common']['pagename1']) && $_SESSION['common']['pagename1'] == "BusSearch") { ?>
<script src="<?php echo $base_url;?>vendors/bootstrap-datepicker.js"></script>

<script type="text/javascript">
$(document).ready(function() { $(".datepicker").datepicker(); });
</script>

<script src="<?php echo $base_url; ?>js/list.js" type="text/javascript"></script>

<script type="text/javascript">
var options = { valueNames: [ 'sm_Travels', 'sm_Bus_Type', 'sm_Depart', 'sm_Arrival', 'sm_Duration', 'sm_Seats', 'sm_Fare' ]};
var userList = new List('users', options);

</script>

<?php } else  { ?>

<link rel="stylesheet" href="<?php echo $base_url; ?>css/jquery-ui.css">
<script src="<?php echo $base_url; ?>js/jquery-1.10.2.js"></script>
<script src="<?php echo $base_url; ?>js/jquery-ui.js"></script>

<script>
$(function() {
  $( "#depart" ).datepicker({dateFormat: 'dd/mm/yy', minDate:'0d' });
  $( "#from" ).datepicker({dateFormat: 'dd/mm/yy',maxDate: 0});
  $( "#to" ).datepicker({dateFormat: 'dd/mm/yy', maxDate: 0});
  $( "#deposit_date" ).datepicker({dateFormat: 'yy-mm-dd', maxDate:'0d' });
});
  </script>
<?php } ?>

<script src="<?php echo $base_url; ?>js/jquery.colorbox.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements
		$(".inline").colorbox({inline:true, width:"70%"});
		//Example of preserving a JavaScript event for inline calls.
	});
</script>
     

<?php 


?>

