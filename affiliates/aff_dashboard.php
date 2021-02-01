<?php

@session_start();

ob_start();

error_reporting(0);

if($_SESSION['aff']['affiliate_id']=='')

header('location:index.php');

include '../database/connect.php';
$name=$_SESSION['aff']['first_name'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Busbooking</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <link href="datepicker/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" type="text/css" />

        <link href="datepicker/jquery.ui.theme.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="js/libs/jquery-1.7.1.min.js" language="javascript" ></script>
        <link rel="stylesheet" type="text/css" href="../css/style11.css"/>
</head>

<body>
 <?php include('header.php'); 
 $idd=$_SESSION['aff']['affiliate_id'];
 ?>

<br clear="all" />
<div class="wrap clearfix">
	<div class="col1 maincol" style="width:1024px;">
		<div class="row" style="border-bottom: 1px solid #c0c0c0; border-left: 1px solid #c0c0c0; border-top: 1px solid #c0c0c0; border-right: 1px solid #c0c0c0;">
				<h3 style="font-size:20px; font-weight:bold; margin-left:10px; margin-top:15px;">Welcome <?php echo $_SESSION['aff']['first_name']; ?></h3><br />
				<p class="dash-min" style="margin-left:10px;">You can view and manage your  profile and Affiliation here. </p>


			</div>
            
            <div class="row" style="border-bottom: 1px solid #c0c0c0; border-left: 1px solid #c0c0c0; border-top: 1px solid #c0c0c0; border-right: 1px solid #c0c0c0;">
				<h3 style="font-size:20px; font-weight:bold; margin-left:10px; margin-top:15px;">Widget Code</h3><br />
 <textarea style="width:800px; height:50px; border:thin"><iframe src="http://scriptstore.in/own_redbus//affiliates/affliate_program.php?aff_id=<?php echo $idd; ?>" width="1000" height="500" border="0"></iframe></textarea>
            Above Copy & Paste your website.

			</div>
			<!--- mainblock strat -->
		<div class="mainblock clearfix" style="border-bottom: 1px solid #c0c0c0; border-left: 1px solid #c0c0c0;  border-right: 1px solid #c0c0c0;">
			<!--- mainsubblock start -->

		<div class="col1">
			<div class="blocks clearfix">
			<div class="col1 ico2 abhicash"><i class="fa fa-user fa-3x"></i></span>			</div>
			<div class="col2">
				

<h3 style="font-weight:bold;">Profile</h3>
				<p class="dash-min">View and Edit your personal info like your name, Email</p>
				<a class="btn" href="aff_profile.php">Manage</a>		
			</div>

		</div>
		
		</div>
							<!--- mainsubblock end -->

		<div class="col1">
			<div class="blocks clearfix">
			<div class="col1 ico2 abhicash">	<span style="margin-top:20px;"><i class="fa fa-credit-card fa-3x"></i></span>	
		</div>
			<div class="col2">
				<h3 style="font-weight:bold;">Our Commission</h3>
				<p class="dash-min">You can manage your Affiliate amount here.</p>
								<a class="btn" href="aff_comm.php">Manage</a>		
			</div>

		</div>

		</div>

		</div>	
								<!--- mainblock end -->

			<!--- mainblock strat -->
			
								<!--- mainblock end -->
								
								
		
			<!--- mainblock strat -->
			
	<!--- mainblock end -->
								
		
			
			
					
			
			
	</div>
	 <!--<div class="col2 sidebar" style="z-index: 1000; width: 257px; position: fixed; top: 0px; left: 853.5px;">
			 <div class="row">
			 <h2>Upcoming Trips</h2>
			 </div>
			 			 
			
			 <div class="row ticketnew">
			 <a class="btnab" href="http://www.abhibus.com/">Book New Ticket</a>
			 </div>
			 
			 
			 
			 
	
			 
		 </div><div style="display: block; width: 258px; height: 130px; float: left;"></div>-->
</div>
<br clear="all" />

</body>
<?php include 'footer.php'; ?>
</html>