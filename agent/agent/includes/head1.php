<title><?php echo $_SESSION['common']['title']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
$(".closeIcon").click(function(){
$('#seat').hide();
$('#seat_block').hide();
$("#seat").html("");
});
</script>			