<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php echo $base_url; ?>dashboard.php"><?php echo $_SESSION['common']['superadmin']['heading']; ?></a>
                    <?php if(isset($_SESSION['superadmin']['log']['id']) && $_SESSION['superadmin']['log']['id']!='') { ?>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><?php if(isset($_SESSION['superadmin']['log']['permission']['bus_booking'] )) { echo $_SESSION['superadmin']['log']['name']; }?><i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?php echo $base_url; ?>profile.php">Profile</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo $base_url; ?>logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>                       
                    </div>
                    <?php } ?>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        
        
<?php /*?><ul class="nav">
                            <li <?php if($_SESSION['common']['pagename']=='Home') { ?> class="active" <?php } ?>>
                                <a href="<?php echo $base_url; ?>home.php">Dashboard</a>
                            </li>                            
                            <li class="dropdown <?php if($_SESSION['common']['pagename']=='Bus') { ?> active <?php } ?>" >
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Bus<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                			<?php if(isset($_SESSION['superadmin']['log']['permission']['bus_booking']) && $_SESSION['superadmin']['log']['permission']['bus_booking']==1) { ?>
                                                <li>
                                                 <a href="<?php echo $base_url; ?>bus/search.php">Booking</a>
                                                </li>
                                            <?php } ?>
                                            <?php if(isset($_SESSION['superadmin']['log']['permission']['bus_report']) && $_SESSION['superadmin']['log']['permission']['bus_report']==1) { ?>
                                            <li>
                                                <a href="<?php echo $base_url; ?>bus/report.php">Report</a>
                                            </li>
                                            <?php } ?>
                                            <li>
                                     		 <a href="<?php echo $base_url; ?>bus/markup.php">Markup</a>
                                            </li>
                                            <li>
                                     		 <a href="<?php echo $base_url; ?>bus/agent_commission.php">Agent Commission</a>
                                            </li>
                                            <li>
                                     		 <a href="<?php echo $base_url; ?>bus/cancel_markup.php">Cancel Markup</a>
                                            </li>
                                            <li>
                                                <a href="#">Print Ticket</a>
                                            </li>
                                             <li>
                                                <a href="#">Cancel Ticket</a>
                                            </li>
                                    <li>
                                        <a href="#">Tools <i class="icon-arrow-right"></i>

                                        </a>
                                        <ul class="dropdown-menu sub-menu">
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">SEO Settings</a>
                                    </li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown <?php if($_SESSION['common']['pagename']=='Offer Hotel') { echo 'active';  } ?>">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Offer Hotel<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                			<li>
                                     		 <a href="<?php echo $base_url; ?>offer-hotel/add-hotel.php">Add Hotel</a>
                                            </li>
                                            <li>
                                     		 <a href="<?php echo $base_url; ?>offer-hotel/hotel_markup.php">Markup</a>
                                            </li>
                                            <li>
                                     		 <a href="<?php echo $base_url; ?>offer-hotel/hotel_agent_commission.php">Agent Commission</a>
                                            </li>
                                            <li>
                                     		 <a href="<?php echo $base_url; ?>offer-hotel/hotel_cancel_markup.php">Cancel Markup</a>
                                            </li>
                                            
                                            </ul>
                            </li>
                             <li class="dropdown <?php if($_SESSION['common']['pagename']=='settings') { echo 'active';  } ?>">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Settings<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                			<li>
                                     		 <a href="<?php echo $base_url; ?>markup/markup.php">Markup Management</a>
                                            </li>
                                            <li>
                                     		 <a href="<?php echo $base_url; ?>markup/commission.php">Commission Management</a>
                                             </li>
                                </ul>
                            </li>  
                            <li class="dropdown <?php if($_SESSION['common']['pagename']=='Cab') { ?> active <?php } ?>" >
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Banner<b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                			<li>
                                     		 <a href="<?php echo $base_url; ?>managemar.php">Add Marque</a>
                                            </li>
                                            <li>
                                                <a href="#">Report</a>
                                            </li>
                                            <li>
                                                <a href="#">Print Ticket</a>
                                            </li>
                                             <li>
                                                <a href="#">Cancel Ticket</a>
                                            </li>
                                    <li>
                                        <a href="#">Tools <i class="icon-arrow-right"></i>

                                        </a>
                                        <ul class="dropdown-menu sub-menu">
                                        </ul>
                                    </li>
                                   
                                </ul>
                            </li>                        
                            
                            <li class="dropdown <?php if($_SESSION['common']['pagename']=='Hotel') { ?> active <?php } ?>" >
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Hotel<b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                			<li>
                                     		 <a href="<?php echo $base_url; ?>hotel/search.php">Booking</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $base_url; ?>hotel/report.php">Report</a>
                                            </li>
                                            <li>
                                                <a href="#">Print Ticket</a>
                                            </li>
                                             <li>
                                                <a href="#">Cancel Ticket</a>
                                            </li>
                                    <li>
                                        <a href="#">Tools <i class="icon-arrow-right"></i>

                                        </a>
                                        <ul class="dropdown-menu sub-menu">
                                        </ul>
                                    </li>
                                   
                                </ul>
                            </li>							
                            <li class="dropdown <?php if($_SESSION['common']['pagename']=='Temple') { ?> active <?php } ?>" >
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Temple<b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                			<li>
                                     		 <a href="<?php echo $base_url; ?>temple/add_temple.php">Add Package</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $base_url; ?>temple/list.php">List package</a>
                                            </li>
                                            <li>
                                                <a href="#">Print Ticket</a>
                                            </li>
                                             <li>
                                                <a href="#">Cancel Ticket</a>
                                            </li>
                                    <li>
                                        <a href="#">Tools <i class="icon-arrow-right"></i>

                                        </a>
                                        <ul class="dropdown-menu sub-menu">
                                        </ul>
                                    </li>
                                   
                                </ul>
                            </li>
							<li class="dropdown <?php if($_SESSION['common']['pagename']=='Cab') { ?> active <?php } ?>" >
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Cab<b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                			<li>
                                     		 <a href="<?php echo $base_url; ?>cab/search.php">Booking</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $base_url; ?>cab/report.php">Report</a>
                                            </li>
                                            <li>
                                                <a href="#">Print Ticket</a>
                                            </li>
                                             <li>
                                                <a href="#">Cancel Ticket</a>
                                            </li>
                                    <li>
                                        <a href="#">Tools <i class="icon-arrow-right"></i>

                                        </a>
                                        <ul class="dropdown-menu sub-menu">
                                        </ul>
                                    </li>
                                   
                                </ul>
                            </li>
                            
                            
                            <li class="dropdown <?php if($_SESSION['common']['pagename']=='Cab') { ?> active <?php } ?>" >
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Agent<b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                <li>
                                     		 <a href="<?php echo $base_url; ?>agent/add_agent.php">Add Agent </a>
                                            </li>
                                			<li>
                                     		 <a href="<?php echo $base_url; ?>agent/agent_approve.php">Agent Registration Request</a>
                                            </li>
                                            <li>
                                     		 <a href="<?php echo $base_url; ?>agent/active_agents.php">Active Agents</a>
                                            </li>
                                            <li>
                                     		 <a href="<?php echo $base_url; ?>agent/agent_deposite.php">Deposite Request</a>
                                            </li>
                                </ul>
                            </li>
                            
                            <li class="dropdown <?php if($_SESSION['common']['pagename']=='Report') { ?> active <?php } ?>" >
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Report<b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                     <li>
                                     <a href="<?php echo $base_url; ?>report/cab-report.php">Cab Report</a>
                                     </li>
                                     <li>
                                     <a href="<?php echo $base_url; ?>report/hotel-report.php">Hotel Report</a>
                                     </li>
                                </ul>
                            </li>
                            <li class="dropdown <?php if($_SESSION['common']['pagename']=='Agent') { echo 'active';  } ?>">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Currency Details<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                			<li>
                                     		 <a href="<?php echo $base_url; ?>currency/add_currency.php">Add Currency</a>
                                            </li>
                                            <li>
                                     		 <a href="<?php echo $base_url; ?>currency/#">Change Exchange Rate</a>
                                            </li>
                                            <li>
                                     	<a href="<?php echo $base_url; ?>currency/#">Manage Currency Range</a>
                                            </li>                                           
                                </ul>
                            </li>
                            <li class="dropdown <?php if($_SESSION['common']['pagename']=='Banner') { echo 'active';  } ?>">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Banner<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                			<li>
                                     		 <a href="<?php echo $base_url; ?>banner/banner.php">Banner Management</a>
                                            </li>
                                </ul>
                             </li>
                             
                             <li class="dropdown <?php if($_SESSION['common']['pagename']=='Agent') { echo 'active';  } ?>">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Offer code<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                			<li>
                                     		 <a href="<?php echo $base_url; ?>offercode/hoteloffercode.php">Hotel Offer Code</a>
                                            </li>
                                            <li>
                                     		 <a href="<?php echo $base_url; ?>offercode/caboffercode.php">Cab Offer code</a>
                                            </li>
                                </ul>
                             </li>
                        </ul><?php */?>        