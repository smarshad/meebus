<title>Meebus</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Meebus is an agent bus ticket booking system.Travel  Agent access all bus operators and buses here and book them online. It is a fast bus ticket booking platform for agents.">
<meta name="keywords" content="seat seller agent login,seatseller customer care number,seatseller travel agent,Seatseller contact,Agent commission,Agent bus booking portal">
<script src="<?php echo $base_url; ?>js/jquery.js"></script>
<link href="<?php echo $base_url; ?>assets/DT_bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo $base_url; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo $base_url; ?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<link href="<?php echo $base_url; ?>vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
<link href="<?php echo $base_url; ?>css/styles.css" rel="stylesheet" media="screen">
<link href="<?php echo $base_url; ?>css/common.css" rel="stylesheet" media="screen">
<link href="<?php echo $base_url; ?>css/font-awesome.min.css" rel="stylesheet" media="screen">
<?php if(isset($_SESSION['common']['pagename1']) && $_SESSION['common']['pagename1'] == "BusSearch") { ?>
<link href="<?php echo $base_url;?>vendors/datepicker.css" rel="stylesheet" media="screen">
<?php } ?>
<script src="<?php echo $base_url; ?>js/html5.js"></script>
<script src="<?php echo $base_url; ?>vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<script src="<?php echo $base_url; ?>vendors/morris/morris.min.js"></script>
<link rel="stylesheet" href="<?php echo $base_url; ?>css/colorbox.css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"> 
<script type="text/javascript">

<?php if($_SESSION['common']['pagename']!='deposit') { ?>
$(document).ready(function() 
{
    $('#depositmenudd').hide();	
});
<?php } ?>


function submenushow(val)
{
	if(val=='deposit')
	{
			$('#depositmenudd').toggle();	
	}
	else 
	{
		$('#depositmenudd').toggle();
	}
}
</script>
<script>
$(function() {
  $( "#depart" ).datepicker({dateFormat: 'dd/mm/yy', minDate:'0d' });
  $( "#from" ).datepicker({dateFormat: 'dd/mm/yy',maxDate: 0});
  $( "#to" ).datepicker({dateFormat: 'dd/mm/yy', maxDate: 0});
   $( "#deposit_date" ).datepicker({dateFormat: 'yy-mm-dd', maxDate:'0d' });
});
  </script>
<?php //echo $_SESSION['agent']['log']['api_select']; ?>
<style>
.tt-dropdown-menu {
    background: #f5f5f5 none repeat scroll 0 0 !important;
    left: 2px !important;
    text-transform: uppercase;
    top: 29px !important;
    width: 217px;
}
.tt-suggestion{padding: 5px;border-bottom:1px solid #e6e6e6;}
.tt-suggestion:hover{background: #006699 !important; color:#fff !important;}
.tt-suggestion p{margin-top: 3px; margin-bottom: 3px;}
</style>