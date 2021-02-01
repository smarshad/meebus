<?php
include_once "header.php";
unset($_SESSION['user']['request']);
$_SESSION['user']['log']['selectedBus']=$selBus=$_SESSION['user']['selectedBus'];
//echo "<pre>"; print_r($selBus); echo "</pre>"; //exit;
$_SESSION['user']['log']['noofseats']=$noofseats=count($_SESSION['user']['selectedSeat']);
if(isset($_POST['submit']) && $_POST['submit']=='Continue to Payment')
{
	$_SESSION['selectedBus']['boarding']=$_POST['boardingpoint_id'];
	$boarding=explode('^',$_POST['boardingpoint_id']);
	$boarding_id=$boarding[2];
	$location=$boarding[1];
	$boarding_time=$boarding[0];
	$_SESSION['user']['log']['boarding']=$boarding;
	$_SESSION['selectedBus']['dropping']=$_POST['droppingpoint_id'];
	$dropping=explode('^',$_POST['droppingpoint_id']);
	$dropping_id=$dropping[2];
	$droplocation=$dropping[1];
	$dropping_time=$dropping[0];
	$_SESSION['user']['log']['dropping']=$dropping;
}
$tfare=0;
$tstx=0;
foreach($_SESSION['user']['selectedSeat'] as $selseat)
{
	foreach($_SESSION['user']['SeatLayout'] as $seat)
	{
		if($selseat==$seat['id'])
		{
			$tfare+=$seat['totalFareWithTaxes'];
			$tstx+=$seat['serviceTaxAmount'];
		}
	}
}
$_SESSION['user']['log']['totalWithServiceTaxFare']=$_SESSION['user']['totalWithServiceTaxFare']=$tfare;
$_SESSION['user']['log']['totalSTax']=$_SESSION['user']['totalSTax']=$tstx;
unset($_SESSION['user']['bus']['couponFare']);
unset($_SESSION['user']['bus']['offerAmount']);

if(isset($_SESSION['user']['sessId']))
{
	$passDetails=json_encode($_SESSION['user']['log']);
	$sessionId=$_SESSION['user']['sessId'];
	$obj->updateSelectedBus(array($passDetails,$sessionId));
}
//unset($_SESSION['user']['log']);
$departureTime=$selBus['departureTime'];
$arraivalTime=$selBus['arrivalTime'];
$start=strtotime($departureTime); 
$end=strtotime($arraivalTime);
$timeDiff=$end - $start;
$duration=gmdate('H:i', $timeDiff);
?>
<div class="rows _29X4">
		<form name="pass_info" id="pass_info" action="payment.php" method="post">
            <div class="col-xs-9 exx9">
                <div class="_1jx0">
                    <div class="zoFw"><span class="_35-V">01</span>Review Itinerary</div>
                    <div class="_4iRU">
                        <div class="_11v_">
                            <span class="_2Z5q"><?php echo $_SESSION['user']['fromstation']; ?></span>
                            <div class="_3e1l _1oDk"></div>
                            <span class="_2Z5q tostation"><?php echo $_SESSION['user']['tostation']; ?></span>
                            <span class="_3K7A"><?php echo date('D, d M Y', strtotime($_SESSION['user']['journey_date']));?></span>
                        </div>
                        <div class="_7OQI">
                        <div class="rows _1juR">
                           <div class="col-xs-4">
                              <div class="_1mld"><?php echo $selBus['operatorName'];?></div>
                              <div class="_3OLe"><?php echo $selBus['busType'];?></div>
                           </div>
                           <div class="col-xs-3">
                              <div class="uHe6 _2l-o"><?php echo $_SESSION['user']['fromstation']; ?> <span><?php echo $selBus['departureTime'];?></span></div>
                              <div class="_32VQ"><?php echo date('D, d M Y', strtotime($_SESSION['user']['journey_date']));?></div>
                           </div>
                           <div class="col-xs-2 center-xs">
                              <div class="_1bj1 zhq7"></div>
                              <div class="_8oVn"><?php echo $duration;?></div>
                           </div>
                           <div class="col-xs-3">
                              <div class="uHe6 _2l-o"><?php echo $_SESSION['user']['tostation']; ?> <span><?php echo $selBus['arrivalTime'];?></span></div>
                              <div class="_32VQ"><?php echo date('D, d M Y', strtotime($_SESSION['user']['journey_date']));?></div>
                           </div>
                        </div>
                        <div class="rows">
                           <div class="col-xs-4">
                              <div class="_27e_">Seats: <?php echo $selBus['availableSeats'];?></div>
                              <?php /*?><div class="_2NUV"><a href="#">Change Bus</a></div><?php */?>
                           </div>
                           <div class="col-xs-3">
                              <div class="_38Ts">(<?php echo $boarding_time;?>) <?php echo $location;?></div>
                              <div class="seatmapBoarding">
                                 <?php /*?><div class="rms-wrapper">
                                    <label for="rms-wrapper" class="rms-label">Change Boarding point</label>
                                 </div><?php */?>
                              </div>
                           </div>
                           <div class="col-xs-2 center-xs"></div>
                           <div class="col-xs-3">
                              <div class="_38Ts">(<?php echo $dropping_time;?>) <?php echo $droplocation;?></div>
                              <div class="seatmapBoarding">
                                 <?php /*?><div class="rms-wrapper">
                                    <label for="rms-wrapper" class="rms-label">Change Dropping point</label>
                                 </div><?php */?>
                              </div>
                           </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="_1jx0">
       <div class="zoFw"><span class="_35-V">02</span> Traveller Information</div>
       <div class="_4iRU">
          <div class="travellerFormContainer">
             <div class="travellerFormformHeading">Traveller</div>
             <?php  $i=0;
			 foreach ($_SESSION['user']['selectedSeat'] as $ns) {?>
             <div class="rows travellerFormContent">
                <div class="col-xs-2 travellerformField">
                   <div class="rms-wrapper">
                        <label class="fl-input-label" for="text-box">Title</label>
                      <select class="fl-input fl-select" tabindex="0" name="gender[]">
                      <option value="M">Mr.</option>
                      <option value="F">Mrs.</option>
                      <option value="F">Miss.</option>
                      </select>
                      <i class="rms-caret"></i>
                   </div>
                </div>
                <div class="col-xs-3 travellerformField">
                   <div class="fl-input-container">
                       <input autocomplete="off" name="adultname[]" class="fl-input fl-valid" id="text-box" tabindex="0" type="text">
                       <label class="fl-input-label" for="text-box">First Name</label>
                   </div>
                   <div class="travellerFormerrorMsgSelect travellerFormhidden">Please Fill First Name</div>
                </div>
                <div class="col-xs-3 travellerformField">
                   <div class="fl-input-container">
                        <input autocomplete="off" name="lastname[]" class="fl-input fl-valid" id="text-box" tabindex="0" type="text">
                        <label class="fl-input-label" for="text-box">Last Name</label>
                    </div>
                   <div class="travellerFormerrorMsgSelect travellerFormhidden">Please Fill Last Name</div>
                </div>
                <div class="col-xs-2 travellerformField">
                   <div class="fl-input-container">
                       <input autocomplete="off" class="fl-input fl-valid" id="text-box" name="adultage[]" tabindex="0" type="number">
                       <label class="fl-input-label" for="text-box">Age</label>
                   </div>
                   <div class="travellerFormerrorMsgSelect travellerFormhidden">Please enter valid age</div>
                </div>
             </div>
             <?php $i++; } ?>
          </div>
          <div class="_3d2O">Contact Information</div>
          <div class="_3kQQ">Your ticket and PNR Info will be sent to these.</div>
          <div class="rows xRib">
             <div class="col-xs-4 contactee">
                <div class="fl-input-container">
                    <input autocomplete="off" name="EmailID" id="EmailID" class="fl-input" id="text-box" tabindex="0" type="text">
                    <label class="fl-input-label" for="text-box">Email ID</label>
                    <span class="fl-error-msg">Please enter valid email ID.</span>
                </div>
                <div class="travellerFormerrorMsgSelect travellerFormhidden">Please enter your email ID</div>
             </div>
             <div class="col-xs-4 contactee">
                <div class="fl-input-container">
                    <input autocomplete="off" name="Mobile_No" id="Mobile_No" class="fl-input fl-valid" id="text-box" tabindex="0" type="text">
                    <label class="fl-input-label" for="text-box">Mobile No.</label>
                    <span class="fl-error-msg">Please enter valid mobile number.</span>
                </div>
                <div class="travellerFormerrorMsgSelect travellerFormhidden">Please enter your mobile number.</div>
             </div>
          </div>
          <div class="_3cXe">
             <div class="pure-checkbox">
                <input id="checkboxInsurance" name="checkboxInsurance" value="on" type="checkbox">
                <label for="checkboxInsurance">Cancel your ticket for Free till 6 hours prior to travel. Get Free Cancellation at just Rs 79/passenger <a href="#">Terms and Conditions</a></label>
             </div>
             <div class="pure-checkbox">
                <input id="checkboxTerms" name="checkboxTerms" value="on" type="checkbox">
                <label for="checkboxTerms">I agree to all the</label>
             </div>
             <div class="travellerFormerrorMsgSelect travellerFormhidden">Please Agree to Terms</div>
          </div>
       </div>
    </div>
            </div>
            <div class="col-xs-3 faredeta">
               <div class="o4DN">
                  <div class="_31hv">Fare Details</div>
                  <div class="k1B0">Fare <span class="SDDx"><?php echo $_SESSION['user']['totalFare']; ?></span></div>
                  <div class="k1B0">Insurance <span class="SDDx"><?php echo $_SESSION['user']['totalSTax']; ?></span></div>
                  <div class="_3TV0 k1B0">Total <span class="SDDx">Rs. <?php echo $_SESSION['user']['totalWithServiceTaxFare'] ?></span></div>
                  <div>
                     <div>
                        <div class="_1qRE">Promocode</div>
                        <div>
                           <div class="TGeu">
                              <input class="OgtW" placeholder="Enter Promocode" value="">
                              <button class="_1Wsd button">Apply</button>
                           </div>
                           
                        </div>
                     </div>
                  </div>
                  <?php if(isset($_SESSION['user']['log']['id']) && $_SESSION['user']['log']['id']!='') { ?>
                  <div class="cf">
                  <div>
                        <div class="_1qRE">Payment Type</div>
                        <div>
                           <div class="TGeu">
                              <div class="k1B0"><input type="radio" name="payment" id="payment" value="wallet" checked="checked" /> Wallet
                  			  <input type="radio" name="payment" id="payment1" value="atom" /> Atom</div>
                           </div>
                           
                        </div>
                     </div>
                  </div>
                  <?php } else { ?>
                  <div class="cf">
                  <div>
                        <div class="_1qRE">Payment Type</div>
                        <div>
                           <div class="TGeu">
                  			  <input type="radio" name="payment" id="payment1" value="atom" checked="checked"/> Atom</div>
                           </div>
                           
                        </div>
                     </div>
                  </div>
                  <?php } ?>
                  <div class="cf"><button class="dIeb button button--block button--default" id="pay" type="submit" name="Submit" value="Pay Now">Proceed to pay</button></div>
               </div>
            </div>
        </form>
</div>
<script>
$("#pay").click( function ()
{
	var a=1;
	count1=$("[name^=adultname]").length;
	var $title=$( "select option:selected" );
	var $adultFirstName=$('input[name="adultname[]"]');
	var $adultLastName=$('input[name="lastname[]"]');
	var $adultage=$('input[name="adultage[]"]');
	for(var i=0;i<count1;i++)
	{
		var aTitle = $title.eq(i).val();
		if(aTitle=='')
		{
			a=0;
			msg="Please Choose Title";
			break;
		}
		var aFName = $adultFirstName.eq(i).val();
		if(aFName=='')
		{
			a=0;
			msg="Please Enter First Name";
			break;
		}
		
		var aLName = $adultLastName.eq(i).val();
		if(aLName=='')
		{
			a=0;
			msg="Please Enter Last Name";
			break;
		}
		var aDOB = $adultage.eq(i).val();
		if(aDOB=='')
		{
			a=0;
			msg="Please Enter Passenger Age";
			break;
		}
	}
	if(a==0)
	{
		alert(msg);
		return false;
	}
	var emailid=$("#EmailID").val();
	if(emailid=='')
	{
		alert("Please Provide Email Id");
		return false;
	}
	var mobile=$("#Mobile_No").val();
	if(mobile=='')
	{
		alert("Please Provide Mobile Number");
		return false;
	}
	return true;
	
});
</script>
<?php include_once "includes/footer.php"; ?>