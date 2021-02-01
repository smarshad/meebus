<?php  
include_once'../../server/server.php';   
include '../includes/functions.php';
$obj=new agent_module($con);
$_SESSION['common']['pagename'] = "report";
$agent_id=$_SESSION['agent']['log']['id'];
?>
<!DOCTYPE html>
<html>
<head>
<?php  include_once '../includes/head.php'; ?>
</head>
<body>
<?php  include_once '../includes/top_menu.php'; ?>
  <div class="container-fluid">
            <div class="row-fluid">
             <?php include '../includes/leftmenu.php'; ?> 
               <!------------------------------Search---------------------->
<div class="row-fluid result">
                                        <!-- block -->
				<div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Agent Bus Booking Detail Report </div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                                                       
                                    <div role="grid" class="dataTables_wrapper form-inline" id="example2_wrapper"><div class="row"><div class="span6"><div id="example2_length" class="dataTables_length"><label><select name="example2_length" size="1" aria-controls="example2"><option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> records per page</label></div></div><div class="span6"><div class="dataTables_filter" id="example2_filter"><label>Search: <input type="text" aria-controls="example2"></label></div></div></div><table cellspacing="0" cellpadding="0" border="0" id="example2" class="table table-striped table-bordered tablescrool dataTable" aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 17px;" aria-sort="ascending" aria-label="S No: activate to sort column descending">S No</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 62px;" aria-label="Tran.Type: activate to sort column ascending">Tran.Type</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 85px;" aria-label=" PNR / TICKET: activate to sort column ascending"> <span style="color:#00F;">PNR</span> / <span style="color:#930;">TICKET</span></th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 33px;" aria-label="Re Send: activate to sort column ascending">Re Send</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 81px;" aria-label="Booked-Date: activate to sort column ascending">Booked<span style="color:#FFF;">-</span>Date</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 72px;" aria-label="Travel-Date: activate to sort column ascending">Travel<span style="color:#FFF;">-</span>Date</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 43px;" aria-label="PAX: activate to sort column ascending">PAX</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 62px;" aria-label="From / To: activate to sort column ascending">From / To</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 35px;" aria-label="Seats: activate to sort column ascending">Seats</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 55px;" aria-label="TXN-Amt: activate to sort column ascending">TXN<span style="color:#FFF;">-</span>Amt</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 49px;" aria-label="Commn: activate to sort column ascending">Commn</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 25px;" aria-label="SC Amt: activate to sort column ascending">SC Amt</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 34px;" aria-label="Profit: activate to sort column ascending">Profit</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 26px;" aria-label="TDS: activate to sort column ascending">TDS</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 27px;" aria-label="CAN Amt: activate to sort column ascending">CAN Amt</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 17px;" aria-label="Cr.: activate to sort column ascending">Cr.</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 17px;" aria-label="Dr.: activate to sort column ascending">Dr.</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 52px;" aria-label="Balance: activate to sort column ascending">Balance</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 30px;" aria-label="Print: activate to sort column ascending">Print</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" style="width: 44px;" aria-label="Cancel: activate to sort column ascending">Cancel</th></tr>
                                        </thead>                                        
                                        
                                    <tbody role="alert" aria-live="polite" aria-relevant="all"><tr class="gradeX odd">
                                            <td class="  sorting_1">1                                                </td><td class=" ">Ticket Cancelled</td>
                                                <td class=" ">
                                                <span style="color:#00F;">9ME4UJ3</span>
                                                <span style="color:#930;">9ME4UJ3</span>
                                                </td>
                                                <td style="text-align:center !important;" class="center ">
                                                </td>
                                                <td class="center ">
												04-04-2016                                                </td>
                                                <td class="center ">20-04-2016</td>
                                                <td class="center ">Subbaiyan</td>
                                                <td class="center ">
												Bhubaneswar<br>To<br>Baripada</td>
                                                <td class="center ">2</td>
                                                <td class="center ">594.66</td>
                                                <td class="center ">65.34</td>
                                                                                                                                              <td class="center "></td>
                                                <td class="center "></td>
                                                <td class="center ">0</td>
                                                <td class="center ">0</td>
                                                <td class="center ">595</td>
                                                <td class="center ">0</td>
                                                <td class="center ">2286.92</td>
                                                
                                                
                                                <td class="center ">
                     -                                                </td>
                                                <td class="center ">
                                       -
                                                                                                </td>
                                                
                                            </tr><tr class="gradeX even">
                                            <td class="  sorting_1">2                                                </td><td class=" ">Ticket Booked</td>
                                                <td class=" ">
                                                <span style="color:#00F;">9ME4UJ3</span>
                                                <span style="color:#930;">9ME4UJ3</span>
                                                </td>
                                                <td style="text-align:center !important;" class="center ">
                                                </td>
                                                <td class="center ">
												04-04-2016                                                </td>
                                                <td class="center ">20-04-2016</td>
                                                <td class="center ">Subbaiyan</td>
                                                <td class="center ">
												Bhubaneswar<br>To<br>Baripada</td>
                                                <td class="center ">2</td>
                                                <td class="center ">680</td>
                                                <td class="center ">65.34</td>
                                                                                                                                              <td class="center ">20</td>
                                                <td class="center ">85.34</td>
                                                <td class="center ">0</td>
                                                <td class="center ">0</td>
                                                <td class="center ">0</td>
                                                <td class="center ">594</td>
                                                <td class="center ">1692.26</td>
                                                
                                                
                                                <td class="center ">
                     -                                                </td>
                                                <td class="center ">
                                       -
                                                                                                </td>
                                                
                                            </tr><tr class="odd gradeX">
                                            <td class="  sorting_1">3                                                </td><td class=" ">Ticket Booked</td>
                                                <td class=" ">
                                                <span style="color:#00F;">K2CZXJJ</span>
                                                <span style="color:#930;">K2CZXJJ</span>
                                                </td>
                                                <td style="text-align:center !important;" class="center ">
                                                <img width="20" onclick="return resendEmail('K2CZXJJ');" src="images/email.png"><br>
                                                <img width="20" onclick="return sendsms('K2CZXJJ');" src="../images/sms.png"><br>
                                                                                                </td>
                                                <td class="center ">
												04-04-2016                                                </td>
                                                <td class="center ">13-04-2016</td>
                                                <td class="center ">Subbaiyan</td>
                                                <td class="center ">
												Bhubaneswar<br>To<br>Baripada</td>
                                                <td class="center ">1</td>
                                                <td class="center ">350</td>
                                                <td class="center ">32.67</td>
                                                                                                                                              <td class="center ">20</td>
                                                <td class="center ">52.67</td>
                                                <td class="center ">0.33</td>
                                                <td class="center ">0</td>
                                                <td class="center ">0</td>
                                                <td class="center ">297</td>
                                                <td class="center ">2286.07</td>
                                                
                                                
                                                <td class="center ">
                     					 <a target="_blank" href="view_ticket.php?ticket=K2CZXJJ">
                                    <span style="text-align:center !important;"><i class="icon-print"></i></span></a>
                                                                                    </td>
                                                <td class="center ">
                                                                    <span style="text-align:center !important;"><i class="icon-remove"></i></span>
                                                                                                </td>
                                                
                                            </tr><tr class="odd gradeX even">
                                            <td class="  sorting_1">4                                                </td><td class=" ">Ticket Cancelled</td>
                                                <td class=" ">
                                                <span style="color:#00F;">BNNB876</span>
                                                <span style="color:#930;">BNNB876</span>
                                                </td>
                                                <td style="text-align:center !important;" class="center ">
                                                </td>
                                                <td class="center ">
												02-04-2016                                                </td>
                                                <td class="center ">13-04-2016</td>
                                                <td class="center ">Subbaiyan 1</td>
                                                <td class="center ">
												Bhubaneswar<br>To<br>Baripada</td>
                                                <td class="center ">4</td>
                                                <td class="center ">297.33</td>
                                                <td class="center ">32.67</td>
                                                                                                                                              <td class="center "></td>
                                                <td class="center "></td>
                                                <td class="center ">0</td>
                                                <td class="center ">0</td>
                                                <td class="center ">297</td>
                                                <td class="center ">0</td>
                                                <td class="center ">2582.87</td>
                                                
                                                
                                                <td class="center ">
                                                                     </td>
                                                <td class="center ">
                                                                    </td>
                                                
                                            </tr><tr class="odd gradeX">
                                            <td class="  sorting_1">5                                                </td><td class=" ">Ticket Cancelled</td>
                                                <td class=" ">
                                                <span style="color:#00F;">BNNB876</span>
                                                <span style="color:#930;">BNNB876</span>
                                                </td>
                                                <td style="text-align:center !important;" class="center ">
                                                </td>
                                                <td class="center ">
												02-04-2016                                                </td>
                                                <td class="center ">13-04-2016</td>
                                                <td class="center ">Subbaiyan 1</td>
                                                <td class="center ">
												Bhubaneswar<br>To<br>Baripada</td>
                                                <td class="center ">4</td>
                                                <td class="center ">275.55</td>
                                                <td class="center ">54.45</td>
                                                                                                                                              <td class="center "></td>
                                                <td class="center "></td>
                                                <td class="center ">0</td>
                                                <td class="center ">0</td>
                                                <td class="center ">276</td>
                                                <td class="center ">0</td>
                                                <td class="center ">2285.54</td>
                                                
                                                
                                                <td class="center ">
                                                                     </td>
                                                <td class="center ">
                                                                    </td>
                                                
                                            </tr><tr class="odd gradeX even">
                                            <td class="  sorting_1">6                                                </td><td class=" ">Ticket Booked</td>
                                                <td class=" ">
                                                <span style="color:#00F;">BNNB876</span>
                                                <span style="color:#930;">BNNB876</span>
                                                </td>
                                                <td style="text-align:center !important;" class="center ">
                                                <img width="20" onclick="return resendEmail('BNNB876');" src="images/email.png"><br>
                                                <img width="20" onclick="return sendsms('BNNB876');" src="../images/sms.png"><br>
                                                                                                </td>
                                                <td class="center ">
												02-04-2016                                                </td>
                                                <td class="center ">13-04-2016</td>
                                                <td class="center ">Subbaiyan 1</td>
                                                <td class="center ">
												Bhubaneswar<br>To<br>Baripada</td>
                                                <td class="center ">4</td>
                                                <td class="center ">1340</td>
                                                <td class="center ">130.68</td>
                                                                                                                                              <td class="center ">20</td>
                                                <td class="center ">150.68</td>
                                                <td class="center ">1.31</td>
                                                <td class="center ">0</td>
                                                <td class="center ">0</td>
                                                <td class="center ">1188</td>
                                                <td class="center ">2009.99</td>
                                                
                                                
                                                <td class="center ">
                     					 <a target="_blank" href="view_ticket.php?ticket=BNNB876">
                                    <span style="text-align:center !important;"><i class="icon-print"></i></span></a>
                                                                                    </td>
                                                <td class="center ">
                                                                    <span style="text-align:center !important;"><i class="icon-remove"></i></span>
                                                                                                </td>
                                                
                                            </tr><tr class="odd gradeX">
                                            <td class="  sorting_1">7                                                </td><td class=" ">Ticket Booked</td>
                                                <td class=" ">
                                                <span style="color:#00F;">TAP9AUY</span>
                                                <span style="color:#930;">TAP9AUY</span>
                                                </td>
                                                <td style="text-align:center !important;" class="center ">
                                                <img width="20" onclick="return resendEmail('TAP9AUY');" src="images/email.png"><br>
                                                <img width="20" onclick="return sendsms('TAP9AUY');" src="../images/sms.png"><br>
                                                                                                </td>
                                                <td class="center ">
												02-04-2016                                                </td>
                                                <td class="center ">13-04-2016</td>
                                                <td class="center ">Subbaiyan</td>
                                                <td class="center ">
												Bhubaneswar<br>To<br>Baripada</td>
                                                <td class="center ">1</td>
                                                <td class="center ">350</td>
                                                <td class="center ">32.67</td>
                                                                                                                                              <td class="center ">20</td>
                                                <td class="center ">52.67</td>
                                                <td class="center ">0.33</td>
                                                <td class="center ">0</td>
                                                <td class="center ">0</td>
                                                <td class="center ">297</td>
                                                <td class="center ">3194.83</td>
                                                
                                                
                                                <td class="center ">
                     					 <a target="_blank" href="view_ticket.php?ticket=TAP9AUY">
                                    <span style="text-align:center !important;"><i class="icon-print"></i></span></a>
                                                                                    </td>
                                                <td class="center ">
                                                                    <span style="text-align:center !important;"><i class="icon-remove"></i></span>
                                                                                                </td>
                                                
                                            </tr><tr class="odd gradeX even">
                                            <td class="  sorting_1">8                                                </td><td class=" ">Ticket Cancelled</td>
                                                <td class=" ">
                                                <span style="color:#00F;">GCE6TNH</span>
                                                <span style="color:#930;">GCE6TNH</span>
                                                </td>
                                                <td style="text-align:center !important;" class="center ">
                                                </td>
                                                <td class="center ">
												27-03-2016                                                </td>
                                                <td class="center ">31-03-2016</td>
                                                <td class="center ">Subbaiyan</td>
                                                <td class="center ">
												Trichy<br>To<br>Chennai</td>
                                                <td class="center ">1</td>
                                                <td class="center ">279.55</td>
                                                <td class="center ">34.55</td>
                                                                                                                                              <td class="center "></td>
                                                <td class="center "></td>
                                                <td class="center ">0</td>
                                                <td class="center ">34.9</td>
                                                <td class="center ">280</td>
                                                <td class="center ">0</td>
                                                <td class="center ">3491.63</td>
                                                
                                                
                                                <td class="center ">
                     -                                                </td>
                                                <td class="center ">
                                       -
                                                                                                </td>
                                                
                                            </tr><tr class="odd gradeX">
                                            <td class="  sorting_1">9                                                </td><td class=" ">Ticket Booked</td>
                                                <td class=" ">
                                                <span style="color:#00F;">GCE6TNH</span>
                                                <span style="color:#930;">GCE6TNH</span>
                                                </td>
                                                <td style="text-align:center !important;" class="center ">
                                                </td>
                                                <td class="center ">
												27-03-2016                                                </td>
                                                <td class="center ">31-03-2016</td>
                                                <td class="center ">Subbaiyan</td>
                                                <td class="center ">
												Trichy<br>To<br>Chennai</td>
                                                <td class="center ">1</td>


                                                <td class="center ">369</td>
                                                <td class="center ">34.55</td>
                                                                                                                                              <td class="center ">20</td>
                                                <td class="center ">54.551</td>
                                                <td class="center ">0.35</td>
                                                <td class="center ">34.9</td>
                                                <td class="center ">0</td>
                                                <td class="center ">314</td>
                                                <td class="center ">3212.08</td>
                                                
                                                
                                                <td class="center ">
                     -                                                </td>
                                                <td class="center ">
                                       -
                                                                                                </td>
                                                
                                            </tr><tr class="odd gradeX even">
                                            <td class="  sorting_1">10                                                </td><td class=" ">Ticket Cancelled</td>
                                                <td class=" ">
                                                <span style="color:#00F;">NGVTYN2</span>
                                                <span style="color:#930;">NGVTYN2</span>
                                                </td>
                                                <td style="text-align:center !important;" class="center ">
                                                </td>
                                                <td class="center ">
												24-03-2016                                                </td>
                                                <td class="center ">31-03-2016</td>
                                                <td class="center ">Jaison</td>
                                                <td class="center ">
												Bhubaneswar<br>To<br>Baripada</td>
                                                <td class="center ">1</td>
                                                <td class="center ">297.33</td>
                                                <td class="center ">32.67</td>
                                                                                                                                              <td class="center "></td>
                                                <td class="center "></td>
                                                <td class="center ">0</td>
                                                <td class="center ">0</td>
                                                <td class="center ">297</td>
                                                <td class="center ">0</td>
                                                <td class="center ">3525.98</td>
                                                
                                                
                                                <td class="center ">
                     -                                                </td>
                                                <td class="center ">
                                       -
                                                                                                </td>
                                                
                                            </tr></tbody></table><div class="row"><div class="span6"><div class="dataTables_info" id="example2_info">Showing 1 to 10 of 29 entries</div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"><ul><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- /block -->
                    </div>