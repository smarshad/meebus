<div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse" >
						<li <?php if($_SESSION['common']['pagename']=="Bus") { ?>  class="active" <?php } ?>>
                         	<a href="<?php echo $base_url; ?>bus/dashboard.php"><i class="icon-chevron-right"></i>Dashboard</a>
                        </li>
                        <li <?php if($_SESSION['common']['pagename']=="Agent Request") { ?>  class="active" <?php } ?>>
                         	<a href="<?php echo $base_url; ?>bus/agent_request.php"><i class="icon-chevron-right"></i>Agent Request</a>
                        </li>
                        <li <?php if($_SESSION['common']['pagename']=="report") { ?>  class="active" <?php } ?>>
                           	 <a href="<?php echo $base_url; ?>bus/report.php"><i class="icon-chevron-right"></i>Report</a>
                        </li>
                        <li <?php if($_SESSION['common']['pagename']=="Print") { ?>  class="active" <?php } ?>>
                            <a href="print.php"><i class="icon-chevron-right"></i>Print Ticket</a>
                        </li>
                         <li <?php if($_SESSION['common']['pagename']=="Cancel") { ?>  class="active" <?php } ?>>
                            <a href="cancel.php"><i class="icon-chevron-right"></i>Cancel Ticket</a>
                        </li>  
                        <?php /*?><li>
                            <a href="<?php echo $base_url; ?>bus/report.php"><i class="icon-chevron-right"></i>Daily Chart</a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url; ?>bus/report.php"><i class="icon-chevron-right"></i>Monthly Chart</a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url; ?>bus/report.php"><i class="icon-chevron-right"></i>Yearly Chart</a>
                        </li><?php */?>
                        <li <?php if($_SESSION['common']['pagename']=="Profile") { ?>  class="active" <?php } ?>>
                         	<a href="<?php echo $base_url; ?>bus/profile.php"><i class="icon-chevron-right"></i>Profile</a>
                        </li>
                        <?php /*?><li <?php if($_SESSION['common']['pagename']=="Markup") { ?>  class="active" <?php } ?>>
                         	<a href="<?php echo $base_url; ?>bus/markup.php"><i class="icon-chevron-right"></i>Markup</a>
                        </li><?php */?>
                        <li <?php if($_SESSION['common']['pagename']=="Deposit") { ?>  class="active" <?php } ?>>
                            <a href="<?php echo $base_url; ?>bus/deposit.php"><i class="icon-chevron-right"></i></i>Instant Deposit</a>
                                </li>
                                <li <?php if($_SESSION['common']['pagename']=="Cash Deposit") { ?>  class="active" <?php } ?>>
                                    <a href="<?php echo $base_url; ?>bus/cash_deposit.php"><i class="icon-chevron-right"></i></i>Cash Deposit</a>
                                </li>
                        <li <?php if($_SESSION['common']['pagename']=="Global Settings") { ?>  class="active" <?php } ?>>
                         	<a href="<?php echo $base_url; ?>bus/global-settings.php"><i class="icon-chevron-right"></i>Global Settings</a>
                        </li>
                        
                        <li <?php if($_SESSION['common']['pagename']=="Summary Report") { ?>  class="active" <?php } ?>>
                         	<a href="<?php echo $base_url; ?>bus/summary-report.php"><i class="icon-chevron-right"></i>Transaction Report</a>
                        </li>
                        
                        <?php //if($_SESSION['agent']['log']['id']=='849') { ?>                        
                        <li <?php if($_SESSION['common']['pagename']=="Booking Summary Report") { ?>  class="active" <?php } ?>>
                         	<a href="<?php echo $base_url; ?>bus/booking-summary-report.php"><i class="icon-chevron-right"></i>Booking Summary Report</a>
                        </li>
                       <?php /*?> <li <?php if($_SESSION['common']['pagename']=="Booking Report") { ?>  class="active" <?php } ?>>
                         	<a href="<?php echo $base_url; ?>bus/busbooking-report1.php"><i class="icon-chevron-right"></i>Booking Report</a>
                        </li><?php */?>
                        <li  style="display:none;" <?php if($_SESSION['common']['pagename']=="Booking & Cancel Dis Report") { ?>  class="active" <?php } ?>>
                         	<a href="<?php echo $base_url; ?>bus/bookingandcancel-Disreport.php"><i class="icon-chevron-right"></i>Booking & Cancel Dis Report</a>
                        </li>
                        <li <?php if($_SESSION['common']['pagename']=="Booking & Cancel Commn Report") { ?>  class="active" <?php } ?>>
                         	<a href="<?php echo $base_url; ?>bus/bookingandcancel-report.php"><i class="icon-chevron-right"></i>Booking & Cancel Commn Report</a>
                        </li>
                        
                         <li <?php if($_SESSION['common']['pagename']=="Cancel Report") { ?>  class="active" <?php } ?>>
                         	<a href="<?php echo $base_url; ?>bus/cancellation.php"><i class="icon-chevron-right"></i>Cancel Report</a>
                        </li>
                        <?php //} ?>
                         <li <?php if($_SESSION['common']['pagename']=="Ticket Terms") { ?>  class="active" <?php } ?>>
                         	<a href="<?php echo $base_url; ?>bus/ticket_terms.php"><i class="icon-chevron-right"></i>Ticket Terms</a>
                        </li> 
                        <?php /*?><li><a href="javascript:void(0);"><strong>Cargo</strong></a></li>
                        <li <?php if($_SESSION['common']['pagename']=="Send Cargo") { ?>  class="active" <?php } ?>>
                         	<a href="<?php echo $base_url; ?>cargo/sendcargo.php"><i class="icon-chevron-right"></i>Send Package</a>
                        </li>
                        <li <?php if($_SESSION['common']['pagename']=="SendShip") { ?>  class="active" <?php } ?>>
                         	<a href="<?php echo $base_url; ?>cargo/send-shipment.php"><i class="icon-chevron-right"></i>Send Shipment</a>
                        </li>  
                        <li <?php if($_SESSION['common']['pagename']=="Cargo Report") { ?>  class="active" <?php } ?>>
                <a href="<?php echo $base_url; ?>cargo/report.php"><i class="icon-chevron-right"></i>Report</a>
                </li>         <?php */?>           
                    </ul>
<?php if($_SESSION['common']['pagename']=='report') { ?>                    
                    <br />

                   <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse new_ul">
                   <li><strong>Abbreviated</strong></li>
                   <li>&nbsp;</li>
                   <li>PAX -> Passanger</li>
                   <li>Amt -> Amount</li>
                   <li>TXN-Amt -> Transaction-Amount</li>
                   <li>Commn -> Commmission</li>
                   <li>SC Amt  -> Service Charge Amount</li>
                   <li>CAN Amt -> Cancellation Amount</li>
                   <li>Cr -> Credit</li>
                   <li>Dr -> Debit</li>
				</ul>

<?php } ?>
                </div>
                


                