<?php 
if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampp/htdocs') 
{ 
	$_SESSION['common']['admin']['url']	  =	'http://localhost/meebus/admin/'; 
	$_SESSION['common']['admin']['title']	  =	"Meebus";
	$_SESSION['common']['admin']['login']	  =	"Admin Login";
	$_SESSION['common']['admin']['heading']  =	"Admin Panel";
} 
else 
{ 
	$_SESSION['common']['admin']['url']	  =	'http://meebus.com/admin/'; 
	$_SESSION['common']['admin']['title']	  =	"Meebus";
	$_SESSION['common']['admin']['login']	  =	"Admin Login";
	$_SESSION['common']['admin']['heading']  =	"Admin Panel";
}
?>

<?php $base_url=$_SESSION['common']['admin']['url']; ?>
<title><?php echo $_SESSION['common']['admin']['title']; ?>::<?php $_SESSION['common']['admin']['heading']; ?></title>
<meta http-equiv="cache-control" content="no-cache" />
<link href="<?php echo $base_url; ?>assets/DT_bootstrap.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php echo $base_url; ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>js/jquery-1.11.3.js"></script>
<link href="<?php echo $base_url; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo $base_url; ?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<link href="<?php echo $base_url; ?>css/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
<link href="<?php echo $base_url; ?>css/styles.css" rel="stylesheet" media="screen">
<link href="<?php echo $base_url; ?>css/common.css" rel="stylesheet" media="screen">
<link href="<?php echo $base_url; ?>css/font-awesome.min.css" rel="stylesheet" media="screen">
<link href="<?php echo $base_url;?>css/datepicker.css" rel="stylesheet" media="screen">

<link rel="stylesheet" href="<?php echo $base_url; ?>css/colorbox.css" />
<link href="<?php echo $base_url; ?>css/metisMenu.min.css" rel="stylesheet" media="screen">
<script src="<?php echo $base_url; ?>js/html5.js"></script>
<script src="<?php echo $base_url; ?>js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<?php /*?><script type="text/javascript" src="<?php echo $base_url; ?>js/jquery.datetimepicker.js"></script> <?php */?>

<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
</style>

