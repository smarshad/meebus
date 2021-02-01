<ul>
    <li><a class="active" href="home.php">Home</a></li>
    <li><a href="citymgmt.php">City Management</a></li>
    <li><a href="service_routes.php">Route Management</a></li>
    <li><a href="companymgnt.php">Service Providers</a></li>
    <li><a href="usermgmt.php">User Management</a></li>
    <li><a href="passmgmt.php">Passangers Management</a></li>
    <li><a href="bustypemgmt.php">Bus Type Management</a></li>
    <li><a href="blockmgnt.php">Blocking Management</a></li>
    <li><a href="promo_code.php">Promotional Code</a></li>
    <li><a href="busCoupon.php">Coupon Code</a></li>
    <li><a href="bookingmgnt.php">Ticket Booking</a></li>
    <li><a href="book_details.php">Booking Details</a></li>
    <li><a href="alltickets.php">Tickets Management</a></li>
    <li><a href="cancelled_tickets.php">Cancelled Tickets</a></li>
    <li><a href="paymentmgnt.php">Payment Management</a> </li>
    <li><a href="banner_ads.php">Banner Ads</a></li>
    <li><a href="general_settings.php">General Settings</a></li>
    <li><a href="viewbus.php">Bus and Service Details</a></li>
    <li><a href="luxitem.php">Luxury Item</a></li>
    <li><a href="viewadvantage.php">Ticket Booking Advantages</a></li>
    <li><a href="bulksms.php"> Bulksms Management</a></li>
    <li><a href="sms_log.php">SMS Management</a></li>
    <li><a href="email_log.php">Email Management</a></li>
</ul>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="3%" align="center" valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%"><a href="home.php">Home</a></td>
  </tr>    
  <tr>
    <td width="3%" align="center" valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%"><a href="profile.php?sp_id=<?php echo $_SESSION['SP_id']; ?>">My Profile</a></td>
  </tr> 
  <tr>
    <td width="3%" align="center" valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%"><a href="busDetails.php?sp_id=<?php echo $_SESSION['SP_id']; ?>">Bus Management</a></td>
  </tr>  
  <tr>
    <td valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%"><a href="passmgmt.php">Passangers Management</a> </td>
  </tr>
  
    <tr>
    <td valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%" nowrap="nowrap"><a href="book_details.php">Booking Details</a></td>
  </tr>
  
   <tr>
    <td valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%" nowrap="nowrap"><a href="promo_code.php">Promotional Code</a></td>
  </tr>
  
   <tr>
    <td valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%" nowrap="nowrap"><a href="busCoupon.php?sp_id=<?php echo $_SESSION['SP_id']; ?>">Discount Coupons</a></td>
  </tr>
  
  <tr>
    <td valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%"><a href="blockmgnt.php">Blocking Management</a> </td>
  </tr>  
  <tr>
    <td valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%"><a href="bookingmgnt.php">Ticket Booking</a> </td>
  </tr>
  <tr>
    <td valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%"><a href="alltickets.php">Tickets Management</a> </td>
  </tr>
  <tr>
    <td valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%"><a href="cancelled_tickets.php">Cancelled Tickets</a> </td>
  </tr>
   <!--<tr>
    <td><img src="../images/bullet-pov.png" /></td>
    <td nowrap="nowrap">	
	<a href="comm_mgmt.php">Commision Management</a> 
	</td>
  </tr>-->
  <tr>
    <td valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%">	
	<a href="paymentperSP.php">Payment Management</a> 
	</td>
  </tr>  
  <tr>
    <td valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%"><a href="cancelpolicymgnt.php">Cancellation Policies</a> </td>
  </tr>
   <tr>
    <td valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%" nowrap="nowrap"><a href="sms_log.php">SMS Management</a></td>
  </tr>
  <tr>
    <td valign="middle"><img src="../images/bullet-pov.png" /></td>
    <td width="97%" nowrap="nowrap"><a href="email_log.php">Email Management</a></td>
  </tr>
  
</table>
</body>
</html>