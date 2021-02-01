<?php 
include_once "header.php";
$_SESSION['log']['uniqueId'] = session_id().time();
$date=date("d-m-Y");
$dat = date("d-m-Y",strtotime(date("d-m-Y", strtotime($date)) . " -1 day"));
$ssss_dat=$obj->getDisableDate(array(1,'%$dat%'));
$i=0;
$val="";
foreach($ssss_dat as $ssss_fet)
{
	$expl=explode(",",$ssss_fet['disable_date']);
	while($i < count($expl))
	{
		$vvv= $expl[$i]; 
		if($vvv==$dat)
		{
			$vvv="";
		}
		else
		{
			$val.=$vvv.",";
		}
		$i++;
	}
	$obj->updateDisableDate(array($val,$ssss_fet['Bus_id']));
}

$date = '2011-04-8 08:29:49';
$currentDate = strtotime($date);
$futureDate = $currentDate+(60*5);
$formatDate = date("Y-m-d H:i:s", $futureDate);
$ress=$obj->getBookingInfoByPaystatus(array(3));
$i=1;
foreach($ress as $del) 
{
	$value = strtotime($del['created_date']);
	$cur_time=time(); 
	$time_diff=($cur_time-$value ); 
	$minutes = floor($time_diff % 3600 / 60);
	if($minutes>=2)
	{
		$obj->delbookingInfo(array($del['auto_id']));	
	}
	$i++;
}
if(isset($_SESSION['ticket_id'])){
		 unset($_SESSION['book_var']);         
		 unset($_SESSION['ticket_id']); 
		 unset($_SESSION['action']);
		 unset($_SESSION['back']);
		 unset($_SESSION['ticket_id1']);
		unset($_SESSION['rround']);
		unset($_SESSION['bbusidd']);
		unset($_SESSION['sseatt22']);
		unset($_SESSION['trav_from']);
		unset($_SESSION['trav_too']);
		unset($_SESSION['rround1']);
		unset($_SESSION['bbusidd1']);
		unset($_SESSION['sseattt1']);
		unset($_SESSION['sel_count']);
		session_unset();
}
if(isset($_SESSION['total_seats'])){
 unset($_SESSION['total_seats']);
 $obj->delbookingByPayStatus(array(3));   
}
?>
<script type="text/javascript" src="js/typeahead.min.js"></script>
<script type="text/javascript">
	$(function() {
		$( "#datepicker" ).datepicker({
			minDate: 0,
            dateFormat: 'dd-mm-yy'
		});
		$( "#datepicker1" ).datepicker({
			defaultDate: "+1w",
			 dateFormat: 'dd-mm-yy',
            beforeShow: function() {
            $(this).datepicker('option', 'minDate', $('#datepicker').val());
			if ($('#datepicker').val() === '') $(this).datepicker('option', 'minDate', 0);                             
         }
		});
	});
	</script>
<script type="text/javascript">
function dat_val()
{
	if(document.getElementById('tag').value!="")
	{
		document.getElementById('dat').style.display='block';
		document.getElementById('datepicker').focus();
		return false;
	}
}
function validate()
{
	if(document.getElementById('ter_from').value=="")
{
alert("please enter the source value");
document.getElementById('ter_from').focus();
return false;
}
if(document.getElementById('tag').value=="")
{
alert("please enter the Destination value");
document.getElementById('tag').focus();
return false;
}
if((document.getElementById('ter_from').value!="") && (document.getElementById('tag').value!="") &&(document.getElementById('datepicker').value==""))
{
document.getElementById('datepicker').focus();
return false;
}
var date=document.getElementById('datepicker').value;
var date1=document.getElementById('datepicker1').value;
if(document.getElementById('datepicker1').value!="")
{
if(date>=date1)
{
alert('Please select Return date greater than Journey date');
document.getElementById('datepicker1').value="";
document.getElementById('datepicker1').focus();
return false;
}
}
}
</script>
<script type="text/javascript">
function showreturn(val)
{
if(val==2) {
document.getElementById('returnshow').style.display="block";
}
else
{
document.getElementById('returnshow').style.display="none";
}
}
</script>
<style>
.tt-hint{display:none}
.twitter-typeahead{display:inherit !important}
</style>
<!--banner-->
<div id="welcome_image_div">
    <div class="banner-content">
<h1 class="se1">Stop Looking, Start Booking</h1>
<h2 class="se2">Your destination partner! Connecting people &amp; places.</h2>
<div id="homeSearchWhole">
	<form name="frm_search" action="search.php" id="booking" method="post" >
  <div style="padding-bottom: 10px; margin-left: 15px;width:100%;margin:0 auto;max-width:1000px">
    <input type="radio" name="triptype" id="oneway" value="1" checked="checked" onclick="showreturn(this.value);" style=" display:none;float: left; margin-right: 10px; " /><span style="  display:none;float: left; margin-right: 10px;color: #fff;">One-Way</span>
    </div>
<ul class="searchAvail cf">
    <li class="leavego">
 <input type="text" autocomplete="off" class="searchPlace" title="Origin" id="originid" name="ter_from">
 <label class="db1 db" style="left:15%" for="src">Leaving From</label>
<span class="err_msg" id="err" style="font-size:13px; font-weight:bold;color:#fff;">
  <span class="togglebtn">
     <img src="images/to-arrow.png" alt="to-arrow.png" style="width:25px; height:25px;">
     </span>
    </li>
    <li class="leavego">
<input type="text" autocomplete="off" title="Destination" class="searchPlace" id="destinationid" name="tag" > 
<label class="db1 db" style="left:15%" for="src">Going To</label>
<span class="err_msg" id="err1" style="font-size:13px; font-weight:bold;color:#fff;">
    </li>
    <li class="departreturn">
    <input id="datepicker" name="datepicker" type="text" class="calendarInput" >
	<label class="db1 db" style="left:15%" for="src">Depature Date</label>
<span class="err_msg" id="err2" style="font-size:13px; font-weight:bold;color:#fff;">
    </li>
    <li id="returnshow" class="departreturn">
	<div class="return-date">
    <input id="datepicker1" name="datepicker1" type="text" class="calendarInput" >
	<label class="db1 db" style="left:15%" for="src">Return Date</label>
	</div>
    <label id="lblOptional">(Optional)</label>
    </li>
    <li class="buttonContainer">
    <!--<input type="image" alt="Search" id="search" name="search" class="searchBtn"  onclick="return validate();"/>-->
    <button type="submit" id="search" name="search" class="searchBtn"  onclick="return validate();">Search</button>
    </li>
    </ul>
</form>
</div>
    </div>
</div>
<!-----------------NEW----------------------->
<!-- container end here -->
</div>
<div class="mob-middle">
	<div class="offer-title">Offers for you</div>
       
         <a class="offer-link"  href="javascript:void(0)">
           <div class="tb">
              <div class="tb-cl">
                 <img alt="Save" src="<?php echo $base_url;?>images/80-80.png" alt="80-80.png">
              </div>
              <div class="tb-cl">
                 <div class="offer-name">Get 20 % off upto Rs. 300 </div>
                 <div class="offer-is">Only offer. Use code HAPPY20</div>
              </div>
           </div>
        </a>
 <a class="offer-link" href="javascript:void(0)">
           <div class="tb">
              <div class="tb-cl">
                 <img alt="Save" src="<?php echo $base_url;?>images/80-80.png" lt="80-80.png">
              </div>
              <div class="tb-cl">
                 <div class="offer-name">Save Flat Rs 200 on bus tickets first 500 users</div>
                 <div class="offer-is">Only offer. Use code LAUNCH</div>
              </div>
           </div>
        </a>
        
  	</div>
<div class="rest">
        <div id="offer_div">
            <div class="main-body over-vis">
                <div class="w-100" id="gtm_promo_cont">
                            <div class="cf dib promotions-wrap link-blocks gtm-promotions-trigger">
                                <div class="fl dib promotion-image">
                                    <img src="images/banner3.jpg" alt="cabservice.png" style="width: 500px;">
                                </div>
                            </div>
                </div>
                <div class="w-100" id="gtm_promo_cont">
                </div>
                <div id="offer_w">
                    <div id="offer_heading">
                        <span class="main-header-family heading-1"></span>
                    </div>
                    <div id="carousel-wrapper" class="carousel-wrapper cf" style="width:1155px">
                    <!-- <div class="offers-slide-block" id="offers_slide_block"> -->
                        <ul class="carousel-container c-1 cf class-1" id="offer_container" style="width: 1140px;">
                        <!-- <ul class="offers-slide-list"> -->
                                    <li class="  offer-slide-item offer-blocks gtm-promotions-trigger grow" data-link="info/OfferTerms#DCDEC " data-slot="1" data-creative="offer-banner" style="width: 360px ! important; left: 0px;">
                                        <span class="cf offer-li-wrap">
                                            <!--<span class="offer-det">
                                                Upto Rs 100 Discount
                                            </span>-->
                                            <span class="offer-img">
                                                <img src="images/offer1.png" style="width: 100%;">
                                            </span>
                                            <!--<span class="fl w-60 offer-txt-wraper">
                                                <span class="offer-code gtm-offer-code">
                                                    ON BUS TICKETS
                                                </span>
                                                <span class="offer-det gtm-offer-desc">
                                                    Offer Code: DCDEC
                                                </span>
                                            </span>-->
                                        </span>
                                    </li>
                                    <li class="  offer-slide-item offer-blocks gtm-promotions-trigger grow" data-link="info/OfferTerms#FREECHARGE_OFFER" data-slot="2" data-creative="offer-banner" style="width: 360px ! important; left: 380px;">
                                        <span class="cf offer-li-wrap">
                                            <!--<span class="offer-det">
                                                Flat Rs 75 cashback
                                            </span>-->
                                            <span class="offer-img">
                                                <img src="images/offer2.png" style="width: 100%;">
                                            </span>
                                            <!--<span class="fl w-60 offer-txt-wraper">
                                                <span class="offer-code gtm-offer-code">
                                                    PAY USING FREECHARGE
                                                </span>
                                                <span class="offer-det gtm-offer-desc">
                                                    NO OFFER CODE
                                                </span>
                                            </span>-->
                                        </span>
                                    </li>
                                    <li class="  offer-slide-item offer-blocks gtm-promotions-trigger grow" data-link="info/OfferTerms#TENFEST_TILE" data-slot="3" data-creative="offer-banner" style="width: 360px ! important; left: 760px;">
                                        <span class="cf offer-li-wrap">
                                            <!--<span class="offer-det">
                                                SAVE UPTO RS 175
                                            </span>-->
                                            <span class="offer-img">
                                                <img src="images/offer3.png" style="width: 100%;">
                                            </span>
                                            <!--<span class="fl w-60 offer-txt-wraper">
                                                <span class="offer-code gtm-offer-code">
                                                    ON  BUS BOOKINGS
                                                </span>
                                                <span class="offer-det gtm-offer-desc">
                                                    Use Code:TENFEST. Pay With Freecharge.
                                                </span>
                                            </span>-->
                                        </span>
                                    </li>
                         </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="add_on_div">
            <section>
                <div class="main-body">
                    <div class="tac main-header-family rest1 heading-1 main-head-cont animate">
                        <h1 style="margin: 0 0 20px;font-size: 36px;line-height: 26px;">What Makes Us Unique</h1>
                         <p style="font-size: 15px;line-height: 26px;text-transform: none;font-weight:normal;">"Me Bus  is largest online bus ticketing platform,trusted by over 6 millions Indians. With a sale of over 10,00,00,000 Bus tickets via web,mobile,and our bus agents,it stands at the top of the game in bus ticketing. Meebus operates on over 84000 routes and is associated with 2300 reputed bus operators. Try the best bus experience today."</p>
                    </div>
                    <div>
                        <div class="cf sub-wrapper rest1 animate">
                            <div class="fl  sub-container rest1 appear-first animate cf pR">
                                <div class="rest1 tac imgCont fl w-30 pA rd-img-cont animate">
                                    <img src="images/DealsCreative.png" height="130">
                                </div>
                                <div class="fl w-60 sub-col-2">
                                    <div class="head rest1 animate">
                                        Mee Bus 
                                    </div>
                                    <div class="desc rest1 animate">
                                       Get a little extra! Additional discounts sponsored by your favorite bus operators exclusively on meeBus 
                                    </div>
                                </div>
                            </div>
                            <div class="fr  sub-container rest1 appear-second animate cf pR">
                                <div class="rest1 tac imgCont fl w-30 pA animate">
                                    <img src="images/multimedia_icon.png" height="160">
                                </div>
                                <div class="fl w-60 sub-col-2">
                                    <div class="head rest1 animate">
                                        RATINGS AND PICTURE REVIEWS
                                    </div>
                                    <div class="desc rest1 animate">
                                        Rely on ratings and actual photos from fellow travellers to choose your bus!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="cf sub-wrapper rest1 animate">
                            <div class="fl  sub-container rest1 appear-first animate cf pR">
                                <div class="rest1 tac imgCont fl w-30 pA animate">
                                    <img src="images/rest_stops.png" style="margin-top: 23px;" height="120">
                                </div>
                                <div class="fl w-60 sub-col-2">
                                    <div class="head rest1 animate">
                                        REST STOPS
                                    </div>
                                    <div class="desc rest1 animate">
                                        Get information on rest stops along the way.
                                    </div>
                                </div>
                            </div>
                            <div class="fr  sub-container rest1 appear-second animate cf pR">
                                <div class="rest1 tac imgCont fl w-30 pA animate">
                                    <img src="images/GPS_tracking_icon.png" height="150">
                                </div>
                                <div class="fl w-60 sub-col-2">
                                    <div class="head rest1 animate">
                                        LIVE TRACKING
                                    </div>
                                    <div class="desc rest1 animate">
                                       Track your bus with our ‘Track My Bus’ feature and know the exact location in real-time.Stay informed and keep your family informed! 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="border-separator">
        </div>
		<section class='banner-bus'>
		<div class=''>
		<img src='images/bannerbus.jpg'/>
		</div>
		</section>
<div class="pR other-plt-outer-wrap">
    <div id="platforms_div" class="main-body">
        <section class="pR">
            <div class="cf op-wrapper">
			  <div class="phone rest1 pA phn-cont animate">
                    <img src="images/IOS_Android_device.png" height="552">
                </div>
                <div class="pA w-50 txt-otherplt">
                    <div class="oph heading-1 main-header-family rest1 animate">
                        Convenience On-the-go.
                    </div>
                    <div class="opd rest1 second-level-heading animate">
                    </div>
                            <div class="desc-OP-new rest1 animate"> Exclusive features on mobile include <br>
							<span class="Platform-hl">MEEBUS NOW</span> - when you need a bus in the next couple of hours. Board a bus on its way. 
							<br><span class="Platform-hl">Boarding   Point Navigation</span> -  Never lose your way while travelling to your boarding point! <br><span class="Platform-hl">1-click Booking </span>- Save your favourite payment options securely on bus raja, and more.<br><span class="Platform-hl"> Download the app.</span></div>
                    <div class="opi rest1 app_icons animate">
                        <a href="#" target="_blank" class="apple icon-iPhone_download">
                        </a>
                        <a href="#" target="_blank" class="google icon-Google_download">
                        </a>
                        <a href="#" target="_blank" class="windows icon-Windows_download ">
                        </a>
                    </div>
                </div>
              
            </div>
        </section>
    </div>
</div>
<div class="border-separator">
</div>
<div id="advantage_div">
    <section>
        <div class="aw main-body">
            <div class="ah heading-1 main-header-family rest1 animate">
                <div class="dib"><img src="images/promise.png" height="100"></div>
                <div class="promise-head-main"> We promise to deliver</div>
            </div>
            <div class="ad rest1 animate">
            </div>
            <div class="cf aa our-promise-blocks" id="advantage">
                <div class="fl rest1 appear-first aa-25 animate">
                    <div class="imgCont rest1 animate">
                        <img src="images/maximum_choices.png" height="90">
                    </div>
                    <div class="tilleBlock rest1 animate">
                        MAXIMUM CHOICE
                    </div>
                    <div class="second-level-heading descCont rest1 animate">
                        We give you the widest number of travel options across thousands of routes.
                    </div>
                </div>
                    <div class="fl rest1 appear-second aa-25 animate">
                        <div class="imgCont rest1 animate">
                            <img src="images/customer_care.png" height="100">
                        </div>
                        <div class="tilleBlock rest1 animate">
                            SUPERIOR CUSTOMER SERVICE
                        </div>
                        <div class="second-level-heading descCont rest1 animate">
                            We put our experience and relationships to good use and are available to solve your travel issues.
                        </div>
                    </div>
                <div class="fl rest1 appear-third aa-25 animate">
                    <div class="imgCont rest1 animate">
                        <img src="images/lowest_Fare.png" height="90">
                    </div>
                    <div class="tilleBlock rest1 animate">
                        LOWEST PRICES
                    </div>
                    <div class="second-level-heading descCont rest1 animate">
                        We always give you the lowest price with the best partner offers. 
                    </div>
                </div>
                <div class="fl rest1 appear-fourth aa-25 animate">
                    <div class="imgCont rest1 animate">
                        <img src="images/benefits.png" height="90">
                    </div>
                    <div class="tilleBlock rest1 animate">
                        UNMATCHED BENEFITS
                    </div>
                    <div class="second-level-heading descCont rest1 animate">
                        We take care of your travel beyond ticketing by providing you with innovative and unique benefits.
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="border-separator"></div>
<div id="awards_div" class="main-body">
    <section>
        <div class="abhibus-info">
               <div class="titles">
                  <div class="col1">
                     <h2>100000</h2>
                     <h4>ROUTES</h4>
                  </div>
                  <div class="col2">
                     <h2>2500</h2>
                     <h4>BUS OPERATORS</h4>
                  </div>
                  <div class="col3">
                     <h2>300+</h2>
                     <h4>hosted operators</h4>
                  </div>
               </div>
               
            </div>
    </section>
</div>
<div class="border-separator"></div>        

        
            <div class="main-body" style="display:none;">
                <section id="stats_div">
                    <div>
                        <div class="stats-header heading-1 main-header-family rest1 animate">
                            The numbers are growing!
                        </div>
                        <div class="cf stats-v-holder">
                            <div class="fl">
                                <div>
                                    <div class="sp rest1 animate">CUSTOMERS</div>
                                    <div class="sv rest1 animate">08 M</div>
                                    <div class="common-desc second-level-heading rest1 animate">Meebus is trusted by over 8 million happy customers globally</div>
                                </div>
                            </div>
                            <div class="fl">
                                <div>
                                    <div class="sp rest1 animate">OPERATORS</div>
                                    <div class="sv rest1 animate">2300</div>
                                    <div class="common-desc second-level-heading rest1 animate">network of over 2300 bus operators worldwide</div>
                                </div>
                            </div>
                            <div class="fl">
                                <div>
                                    <div class="sp rest1 animate">BUS TICKETS</div>
                                    <div class="sv rest1 animate">75+ M</div>
                                    <div class="common-desc second-level-heading rest1 animate">Over 75 million trips booked using Meebus</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
</div>
<?php
$_SESSION['user']['sessId']=$sessionId=session_id().time();
if(isset($_SESSION['user']['log']['id']))
{
	$user_id=$_SESSION['user']['log']['id'];
	$userType='RegUser';
}
else
{
	$user_id=0;
	$userType='Guest';
}
$geo=json_encode('NA');
$obj->insbuslog(array($userType,$user_id,$sessionId,$ip));
?>
<?php include_once "includes/footer.php"; ?>
<script>
$(document).ready(function (){
    $(".togglebtn").on('click',function(){
        var pickup = $('#originid').val();
        $('#originid').val($('#destinationid').val());
        $('#destinationid').val(pickup);
    });

});
$('#originid').typeahead({
    name: 'ter_from',
	 remote: {
            url : 'includes/busSource.php?query=%QUERY'
        },
    minLength: 3, // send AJAX request only after user type in at least 3 characters
    limit: 10 // limit to show only 10 results
});
$('#destinationid').typeahead({
    name: 'tag',
	 remote: {
            url : 'includes/busSource.php?query=%QUERY'
        },
    minLength: 3, // send AJAX request only after user type in at least 3 characters
    limit: 10 // limit to show only 10 results
});
$("#search").click(function () {
        $("#err").html("");
	$("#err1").html("");
        $("#err2").html("");
        var originid=$("#originid").val();
	var destinationid=$("#destinationid").val();
        var datepicker=$("#datepicker").val();
	if(originid=='')
	{
		$("#err").html("Please Enter Orgin");
		return false;
	}
        else if(destinationid=='')
	{
		$("#err1").html("Please Enter Destination");
		return false;
	}
       else if(datepicker=='')
	{
		$("#err2").html("Please Enter Depart Date");
		return false;
	}
        else
	{
		$("#booking").submit();
		return true;
	}
	
});
$("#originid").keyup(function () {
	 if ($(this).val()) {
		$("#err").hide();
	 }
	 else {
		$("#err").show();
	 }
  });
$("#destinationid").keyup(function () {
	 if ($(this).val()) {
		$("#err1").hide();
	 }
	 else {
		$("#err1").show();
	 }
  });

$("#datepicker").click(function () {
		$("#err2").hide();
  });
   $(function(){
$('.searchAvail input[type="text"]').on('focus blur',function(){
if($(this).parents('li').find('label.db').hasClass('move-up')){
	 if($(this).val()=="" && !$(this).hasClass('calendarInput')){
$(this).parents('li').find('label.db').removeClass('move-up');
	 }
	 else{
		 $(this).parents('li').find('label.db').addClass('move-up');
	 }
} else {
$(this).parents('li').find('label.db').addClass('move-up');
}
});
});
  window.onload = function() {
  $('body').addClass('homepage');
};
</script>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery-ui.js"></script>