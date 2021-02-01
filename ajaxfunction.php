<?php session_start();
if($_POST):
$myReq = $_POST['action'];

	if($myReq=='Set_passengerListSession'){
		$selectedSeats= $_POST['selectedSeats'];
		$selectedSeatsPrice = $_POST['selectedSeatsPrice'];
		$serviceTaxAmount = $_POST['serviceTaxAmount'];
		$operatorServiceChargeAbsolute = $_POST['operatorServiceChargeAbsolute'];
		$ac = $_POST['ac'];
		$sleeper = $_POST['sleeper'];
		
		$seatprice_det=[];
		foreach($selectedSeatsPrice as $price){
			 $seatprice = explode(':',$price);
			 array_push($seatprice_det,$seatprice[1]);
		}
		$serviceTaxAmount_det = [];
		foreach($serviceTaxAmount as $serviceTax){
			 $serviceTaxAmount_ar = explode(':',$serviceTax);
			 array_push($serviceTaxAmount_det,$serviceTaxAmount_ar[1]);
		}
		$operatorServiceChargeAbsolute_det = [];
		foreach($operatorServiceChargeAbsolute as $operatorServiceChargeAbsoluteTax){
			 $operatorServiceChargeAbsolute_ar = explode(':',$operatorServiceChargeAbsoluteTax);
			 array_push($operatorServiceChargeAbsolute_det,$operatorServiceChargeAbsolute_ar[1]);
		}
		$ac_det = [];
		foreach($ac as $ac_val){
			 $ac_ar = explode(':',$ac_val);
			 array_push($ac_det,$ac_ar[1]);
		}
		$sleeper_det = [];
		foreach($sleeper as $sleeper_val){
			 $sleeper_ar = explode(':',$sleeper_val);
			 array_push($sleeper_det,$sleeper_ar[1]);
		}
		$bp_point= $_POST['bp_point'];
		$dp_point= $_POST['dp_point'];
		?>
	<div class="cinfo-header">
	<i class="fl icon icon-right back-arrow" title="Back"></i>
	<h4 class="passenger-maintitle">Passenger Details</h4>
	<div class="custinfo_container">
	<form method="post" name="passenger_detail" action="payment.php">
	<input type="hidden" name="bp_point" value="<?php echo $bp_point; ?>">
	<input type="hidden" name="dp_point" value="<?php echo $dp_point; ?>">
	<div class="cusinfo-sub-components">
	<div class="cusinfo_subcomponents clearfix">
	<div class="passenger_contact_container">
	<div class="passenger_info_title clearfix">
      <i class="fa fa-user fl profileicon" aria-hidden="true"></i>
	<span class="fl p-title">Passenger Information</span>
	</div>

	<div class="passenger_info_content_block clearfix html_result">
	<?php 
	$j=0;
	$i=1;
	foreach($selectedSeats as $seat)
    { 
	?>

<div class="passenger_info_content_block">
	   <div class="passenger_sub_title" id="st-seat0">
	   <span class="passenger_priority">Passenger <?= $i; ?></span>
	<span class="passenger_seat"><span class="passenger_seatno f-bold"><?= $seat; ?></span>
	<span class="ladies_seat fr"></span>
	</div>
	<div class="passenger_contact_container clearfix">
	<div class="passenger_outer_container w-100 ">
	<div class="input_block">
	<label class="custinfo_label" for="04">Name
	<input class="input_box" type="text" placeholder="Name" name="adultname[]"  id="seatno-04" value="">
	<input class="input_box" type="hidden" placeholder="Name" name="seatprice[]"  id="seatprice-04" value="<?= $seatprice_det[$j]; ?>">
    <input class="input_box" type="hidden" placeholder="Name" name="seatnumber[]"  id="seatnumber-04" value="<?= $seat; ?>">
    <input class="input_box" type="hidden" placeholder="Name" name="serviceTaxAmount_det[]"  id="seatprice-04" value="<?= $serviceTaxAmount_det[$j]; ?>">
    <input class="input_box" type="hidden" placeholder="Name" name="operatorServiceChargeAbsolute_det[]"  id="seatprice-04" value="<?= $operatorServiceChargeAbsolute_det[$j]; ?>">
    <input class="input_box" type="hidden" placeholder="Name" name="ac_det[]"  id="seatprice-04" value="<?= $ac_det[$j]; ?>">
    <input class="input_box" type="hidden" placeholder="Name" name="sleeper_det[]"  id="seatprice-04" value="<?= $sleeper_det[$j]; ?>">
	
	
	</label>
	<span id="seatno04" class="hide" data-seaterrmsg="seatno04">Enter your Name</span>
	</div></div>
	<div class="combined_block clearfix">
	<div class="combined_mpax gender_block">
	<div class="passenger_outer_container">
	<div class="radio_block">
	<span class="radio_block_title">Gender</span>
	<div class="radio_container clearfix">
	<span for="22" class="radio_block">
	<input type="radio" id="22_<?=$j?>" name="gender<?=$j?>[]" class="radio_btn" value="M" checked>
	<label for="22_0" class="radio_css " value="Male">Male</label>
	</span>
	<span for="23" class="radio_block">
	<input type="radio" id="23_<?=$j?>" name="gender<?=$j?>[]" class="radio_btn" value="F">
	<label for="23_0" class="radio_css " value="Female">Female</label>
	</span>
	</div>
	<span id="seatno02" class="hide" data-seaterrmsg="seatno02">Gender</span>
	</div>
	</div>
	</div>
	<div class="combined_mpax age_block">
	<div class="passenger_outer_container cust-list w-45 ">
	<div class="input_block">
	<label class="custinfo_label" for="01">Age
	<input class="input_box" type="number" placeholder="Age" name="adultage[]" maxlength="2" id="seatno-01" value="">
	</label>
	<span id="seatno01" class="hide" data-seaterrmsg="seatno01">Enter Age</span>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	<?php $i++; $j++; } ?>
	</div>
	</div>
	</div>
	<div class="usinfo_subcomponents clearfix">
	<div class="passenger_contact_container">
	<div class="passenger_contact_title clearfix">
	<i class="fa fa-envelope-o fl emailicon"></i>
	<span class="fl p-title">Contact Details</span>
	</div>
	<div class="passenger_contact_contents">
	<div class="passenger_contact_msg">Your ticket will be sent to these details</div>
	<div class="passenger_outer_container">
	<div class="input_block">
	<label class="custinfo_label" for="05">Email ID
	<input class="input_box" type="text" name="EmailID" placeholder="Email ID" id="seatno-05" value="">
	</label>
	<span id="seatno05" class="hide" data-seaterrmsg="seatno05">Email ID</span>
	</div>
	</div>
	<div class="passenger_outer_container">
	<label>Phone</label>
		<div class="phone_container">
	<div class="phone_select_box clearfix">
	<ul id="6" data-value="91" class="select_input_code"> + 91</ul>
	<span class="icon icon-down"></span>
	</div>
	<div class="phone_field">
	<div class="input_block">
	<label class="custinfo_label" for="06">
	<input class="input_box" type="number" name="Mobile_No"  placeholder="Phone"  id="seatno-06" value="">
	</label>
	<span id="seatno06" class="hide" data-seaterrmsg="seatno06">Phone</span>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	<div>
	<div class="insurance-block">
	<div class="insuranceTitle clearfix">
	<span class="fl p-title">Insure your travel by adding Rs <span class="show_service_tax"></span></span>
	</div>
	<div class="insurance_container">
	<div class="input_block">
	<label class="custinfo_label promocode_label" for="05">Promocode
	<input class="input-box promocode_input" type="text" name="Promocode_EmailID" placeholder="Enter Promocode" id="seatno-05" value="">
	</label>
	
	<span id="seatno05" class="hide" data-seaterrmsg="seatno05">Email ID</span>
	</div>
	</div>
	</div>
	</div>
	<div>
	<div class="passenger_info_content_block clearfix">
	<div class="rucDetails_block">
	<div>
	<label class="rucLabel checkbox_css">
	<input type="checkbox" id="RUCFeature" class="input-checkbox hide">
	<label for="RUCFeature" id="RUCFeatureCheckBox" class="checkmark">
	</label><span class="ruc-txt">I agree to all the</span>
	</label>
	</div>
	</div>
	</div>
	</div>
	<!--div class="whatsApp_block">
	<label class="checkbox_css">
	<input type="checkbox" id="whatsAppFeature" class="input-checkbox hide" checked="">
	<label for="whatsAppFeature" id="whatsAppFeatureCheckBox" class="checkmark">
	</label>
	<i class="fa fa-whatsapp whatsappicon"></i>
	<span class="subscribe-txt">Send booking details and updates on above WhatsApp number 
	</span>
	</label>
	</div-->
	</div>
	<div class="clearfix continue-booking ">
	<div>
	<div class="booking-amt-details fl clearfix f-bold">
	<div class="booking-amt-title fl">Total Amount : </div>
	<div class="booking-amt fl ">INR
	<span class="f-bold pricewithInsurance"></span>
	<input type="hidden" class="bus_fare" id="bus_fare" name="bus_fare" value="">

	</div>
	</div>
	<div class="button-container fr">
	<button type="submit" class="button main-btn gtm-continueBooking" name="Submit" value="Pay Now">Proceed to pay</button>
	</div>
	</div>
	</div>
	</form>
	</div>
	
	</div>
	<script>
	$(document).ready(function() {
	$('.back-arrow').click(function(){
		$('#page_overlay').addClass('hide');
		$('body').removeClass('passenger_active');
		$('.custinfo').hide();
	});
	});
	$(function() {
  $("form[name='passenger_detail']").validate({
    rules: {
		"adultname[]": "required",
		"adultage[]": "required",
		"Mobile_No": "required",
      "EmailID": {
		 required:true, 
		 email:true, 
	  },
    },

    messages: {
      EmailID: "Please enter Email Id"
    },
  });
});
 var totalPricewithTax= totalseat_price+totalseat_pricetax
		 $('.show_service_tax').text(totalseat_pricetax);
		 $('.pricewithInsurance').text(totalPricewithTax);
		 $('#bus_fare').val(totalPricewithTax);
	</script>
	<?php
	}
	endif;
	?>