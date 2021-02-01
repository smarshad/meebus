<div class="span3" id="sidebar">
<ul id="menu" class="metismenu nav nav-list bs-docs-sidenav nav-collapse collapse">
    <li style="background:#e45f06 !important;">
        <a href="<?php echo $base_url; ?>dashboard.php" aria-expanded="true">
        <i class="fa fa-tachometer"></i> Dashboard</a>
    </li>
	
   <li class="<?php if($_SESSION['common']['pagename']=='report') { ?> active <?php } ?>">
        <a href="javascript:void(0);"><i class="fa fa-file-text" ></i> <i class="fa arrow"> </i>ETS Report</a>
        <ul aria-expanded="false">
			<li><a href="<?php echo $base_url; ?>etsbus_report.php"> <i class="fa fa-circle fs_i"></i>Book Report</a></li>
            <li><a href="<?php echo $base_url; ?>etsbuscancel_report.php"> <i class="fa fa-circle fs_i"></i>Cancel Report</a></li>
            <li><a href="<?php echo $base_url; ?>etsbusfailed_report.php"> <i class="fa fa-circle fs_i"></i>Failed Report</a></li>
		 </ul>
    </li>
	 <li class="<?php if($_SESSION['common']['pagename']=='user') { ?> active <?php } ?>">
        <a href="javascript:void(0);"><i class="fa fa-file-text" ></i> <i class="fa arrow"> </i>User Management</a>
        <ul aria-expanded="false">
			<li><a href="<?php echo $base_url; ?>view_user.php"> <i class="fa fa-circle fs_i"></i>View Users</a></li>
            <li><a href="<?php echo $base_url; ?>deactivated_user.php"> <i class="fa fa-circle fs_i"></i>Deactive Users</a></li>
            <li><a href="<?php echo $base_url; ?>user_transHistory.php"> <i class="fa fa-circle fs_i"></i>User Transaction History</a></li>
		 </ul>
    </li>
</ul>
</div>