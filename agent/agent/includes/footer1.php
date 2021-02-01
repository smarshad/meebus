<div class="footer">
    <div class="container-fluid">
        <div class="row-fluid">
        	<footer>
				<p>&copy; DOD IT Solutions 2016</p>
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
     
<script type="text/javascript">
var idleTime = 0;
$(document).ready(function () {
    var idleInterval = setInterval(timerIncrement, 60000);

    $(this).mousemove(function (e) {
		
        idleTime = 0;
    });
	
    $(this).keypress(function (e) {
        idleTime = 0;
    });
	
	
});

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 5) { 
       window.location.href = 'http://Meebus.com/agent/agent/logout.php';
    }
}
</script>   
<script>
//$(document).ready(function() { setInterval(function(){ $.post("sessioncheck.php",function(data){ }); }, 180000); });

</script>
<?php 

//$agent_active_details  = array(time(),$_SESSION['agent']['log']['id']);
//$update_agent_active = $obj->agent_active($agent_active_details);

//$error_logs_detail=array($_SESSION['agent']['log']['id'],$_SESSION['agent']['log']['agent_name'],$_SESSION['agent']['log']['agency_name'],time(),date('d-m-Y h:i:s A',time()),$error_logs);
//$update_error_logs=$obj->error_logs($error_logs_detail);

//if(!isset($update_error_logs) && $update_error_logs!=1) { header('location:../logout.php'); }

/*$timeout = 1; 
$logout_redirect_url = "../logout.php"; 
$timeout = $timeout * 60; 
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        header("location: $logout_redirect_url");
    }
}
$_SESSION['start_time'] = time();
*/
?>

