<?php 
include '../server/server.php';
include '../includes/pdo_functions.php';
$obj=new user_module($con);
include_once("../header.php"); 

?>
<style>
.pagecontainer2 {
    background: #fff;
    border: 1px solid #cccccc;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.13);
    position: relative;
	margin: 25px 0;
}
.hpadding50c {
    padding: 20px 50px;
}
.line3 {
    background: #e8e8e8;
    height: 1px;
    margin: 0px 0 0px 0;
    padding: 0;
    display: block;
}
.size30 {
    font-size: 30px;
}
.aboutarrow {
    display: block;
    float: left;
    position: relative;
    left: 50%;
    bottom: -20px;
    width: 25px;
    height: 13px;
    background: url('../images/about-arrow.png') no-repeat;
}
</style>
<div class="logohead cf">
	<div class="pagecontainer2">
				<div class="hpadding50c">
					<p class="size30">FAQ</p>
					<p class="aboutarrow"></p>
				</div>
				<div class="line3"></div>
				<div class="hpadding50c">
				<h3>Why do I have to enter an Id number when I buy the ticket?</h3>
<p>Your  id number is required in case the bus driver or a bus inspector  requires proof of your identity as the holder of the ticket. NOTE: The  bus driver or bus inspector is entitled to deny you your right of travel  if you can not provide Identification as specified on the ticket.</p>
<h3>Why do I have to enter my E-mail Address?</h3>
<p>In  the event that a bus departure is cancelled, we need your e-mail  address to be able to inform you about the cancellation and alternative  travel options. Any concerns? Please read our&nbsp;<a href="https://getbybus.com/en/privacy-policy">Privacy policy</a>.</p>
<h3>Why do I have to print my ticket?</h3>
<p>Currently,&nbsp;bus companies only accept printed tickets; you need to carry the ticket with you during the bus ride.</p>
<h3>Why can I not buy a ticket for some routes?</h3>
<p>Although  we are constantly expanding our offer and improving the ease of usage  for both travellers and bus companies, not all bus companies are  currently interested in selling their tickets online.</p>
<h3>Is it safe to buy a ticket on meebus.com?</h3>
<p>Safety  of the buying process is something we take very seriously; the  merchants we work with for the processing of payments are experienced  and known for their high security standards.</p>
<h3>Can I re-book my ticket?</h3>
<p>Yes  you may rebook your ticket up to&nbsp;24 hours before the departure time  stated on your original ticket; to rebook your ticket please read our  rebooking policy and Instructions&nbsp;<a href="https://getbybus.com/en/general-terms">here</a>.</p>
<h3>Can I cancel my bus ticket before travel?</h3>
<p>Yes,  you can cancel your ticket up to 48 hours before the departure time  stated on the purchased ticket, for refund we charge a service fee of  20% (MAX. 100 Kn) per ticket.</p>
<h3>Are there any online booking fees?</h3>
<p>We charge a booking fee of min. 5 HRK or 5% per ticket.</p>
		`					
				</div>
			</div>		
</div>
<?php include_once("../includes/footer.php"); ?> 