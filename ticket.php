<?php
include 'header.php';
GLOBAL $conn;
include_once 'includes/User.php';
$obj = new User($conn);
if(isset($_REQUEST['tin']) && $_REQUEST['tin']!='') 

{

	$data=array($_REQUEST['tin'],'BOOKED');

	$ticket=$obj->getTicket($data);

	

	echo "<pre>";

	print_r($ticket);

	echo "</pre>";

}



?>

<div class="mainsection ticket">

<div id='agentTicketPrint'>

<style type="text/css">

.mainsection {

	padding-top: 20px;

}

table {

    background: transparent;

    padding: 5px 0;

}

</style>

<?php

//echo "<pre>"; print_r($ticket); echo "</pre>";

if($ticket!=0)

{

foreach($ticket as $t)

{

	//echo "<pre>"; print_r($t); echo "</pre>";

	 $blockRequest = '['.$t['blockRequest'].']';

	

	$someArray = json_decode($blockRequest, true);

    $boarding_point = $someArray[0]['boardingPoint']['location'];

    $dropping_point = $someArray[0]['droppingPoint']['location'];

	$service_tax_amount = $someArray[0]['blockSeatPaxDetails'][0]['serviceTaxAmount'];

	$oneway_fare = $t['oneway_fare'];

	$total_fare = $t['total_fare'];

	

	$scheduleId = $t['scheduleId'];

	$inventoryId = $t['inventoryId'];

	$fromStationId = $t['fromStationId'];

	$toStationId = $t['toStationId'];

	$travelDate = $t['travelDate'];

	



	$cancel = $t['cancellationDescList'];

	$tin=$t['tiket_no']; 

	$pnr=$t['PNR']; 

	$fromStation=$t['fromStationId'];  

	$toStation=$t['toStationId'];  

	$DepartureTime=$t['DepartureTime']; 

	$ArrivalTime=$t['ArrivalTime']; 

	$emailId=$t['emailId'];

	$mobileNbr=$t['mobileNbr'];

	$serviceCharges = $t['serviceChargeValues'].'.00';

	$netAmt = $t['paidAmount'];

	$travelDate=$t['travelDate']; 

	$lead_pax_name=$t['lead_pax_name'];

	$busInfo=$t['busInfo']; 

	$bus=explode('^',$busInfo); 

	$travelsName=$bus['0']; 

	if(isset($bus['1']))

	$busType=$bus['1']; 

	$boardingInfo=$t['boardingInfo'];

	$board=explode('^',$boardingInfo); 

	if(isset($board['0']))

	$boardingtime=$board['0'];

	if(isset($board['1']))

	$boardinginfor=$board['1']; 

	if(isset($board['2']))

	$boardingaddress=$board['2'];

	if(isset($board['3']))

	$boardingpoint=$board['3'];

	if(isset($board['4']) && $board['4']!=''){

	$boardingcontact="Contact No : ".$board['4']; } else { $boardingcontact=''; }

	

	if(isset($board['5']))

	{

		$boardinglandmark=$board['5'];

		if($boardingpoint==$boardinglandmark){ $boardinglandmark=''; }

		else { $boardinglandmark='<br/><b>Landmark : </b>'.$boardinglandmark; }

	}

	$bookingDate=$t['dateOfIssue'];

	//$bookingDate = $bookingDate[2].'/'.$bookingDate[1].'/'.$bookingDate[0];

	$oneway_fare=$t['oneway_fare']-$serviceCharges.'.00'; 

	$offerAmt=$t['offerAmount'];

	$passenger=array(); 

	$passenger_name=$t['passenger_name'];

	$passenger_fare=explode('^',$t['passenger_fare']);		

	$passenger['name']=explode('^',$passenger_name);

	$passenger_age=$t['passenger_age'];

	$passenger['age']=explode('^',$passenger_age); 

	$passenger_seat=$t['passenger_seat']; 

	$passenger['seat']=explode('^',$passenger_seat); 

	$passenger_sex=$t['passenger_sex']; 

	$passenger['sex']=explode('^',$passenger_sex); 

	

	

	for($i=0; $i<count($passenger['name']); $i++)

	{

		if($passenger['name'][$i]!='')

		$passenger1['name'][]=$passenger['name'][$i];	

	}

	unset($passenger['name']);

	$passenger['name'] = $passenger1['name'];

	

	

	for($i=0; $i<count($passenger['age']); $i++)

	{

		if($passenger['age'][$i]!='')

		$passenger1['age'][]=$passenger['age'][$i];	

	}

	unset($passenger['age']);

	$passenger['age'] = $passenger1['age'];

	

	for($i=0; $i<count($passenger['seat']); $i++)

	{

		if($passenger['seat'][$i]!='')

		$passenger1['seat'][]=$passenger['seat'][$i];	

	}

	unset($passenger['seat']);

	$passenger['seat'] = $passenger1['seat'];

	$status=$t['status']; 

}



$pnames = "";

for($i=0; $i<count($passenger['name']); $i++)

{

	$firstName = $passenger["name"][0];

	if($passenger["sex"][$i]=='M')

	{

		$mrms = "Mr. ";

	}

	else 

	{

		$mrms = "Ms. ";

	}

	$pseats = $passenger["seat"][$i].'/';

	$pnames = $mrms.ucfirst($passenger["name"][$i]).'/';

}



$mobile_number = $mobileNbr;

$message = 'meebus%20Ticket%0aRoute:'.$fromStation.'%20to%20'.$toStation.'%0aTicket%20No:'.$tin.'%0aPassenger:%20'.$pnames.'%0aPNR%20:'.$pnr.'/'.$busType.'%0aTravels:'.$travelsName.'%0aSeat%20Numbers:'.$pseats.'%0aBoarding%20Point:'.$boardinginfor;

$new_msg = str_replace(" ","%20",$message);

//$url="http://technicalsms.com/vendorsms/pushsms.aspx?user=Troon&password=JVGC1NPV&msisdn=".$mobile_number."&sid=MEEBUS&msg=".$new_msg."&fl=0";

	$ch = curl_init();

	$username="Troon";

	$password='Troon';

	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);

	$output = curl_exec($ch);

	curl_close($ch);

	json_decode($output, true);



$cnclDatas = '';

$cnclDatas.='<div style="background: #fff none repeat scroll 0 0; font-family: Verdana,Geneva,sans-serif; height: auto; margin: 0 auto; width: 100%;"><div style="color: #000; float: left; font-size: 15px; font-weight: bold; height:20px; line-height:10px; padding-left: 5px; width:99%;border-bottom: 1px solid #CCC;">Cancellation Policy</div><div style="width:100%; flot:left;"><div style="border-right: 1px solid #ccc; color: #000; float: left; font-size: 13px;    font-weight: bold; height: 30px;  line-height: 30px; padding-left: 5px; width:68%; flot:left;">Cancellation time</div><div style="float: left; font-size: 13px; font-weight: bold; height: 30px; line-height: 30px; padding-left: 5px; width:30%;  flot:left;">Cancellation Charges</div><div style="width:100%; float:left; height:auto;">';

                $h = 0;				

				$new11=array();

				 $cancel_pol=explode(';',$cancel);

				 

                foreach ($cancel_pol as $fd) {



                    if ($h <= count($cancel_pol)) {

						if($cancel_pol[$h]!='')

						{

                        $new11 = explode(':', $cancel_pol[$h]); 

							if ($new11[1] == -1) {

	

								$cnclDatas.='<div style="border-right: 1px solid #ccc; border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:68%;">';

								$cnclDatas.=$new11[0];

								$cnclDatas.=' hours before journey time</div><div style="border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height:30px; padding-left:5px; width:30%;">';

								$cnclDatas.=$new11[2];

								$cnclDatas.=' %</div>';

							} else {

								$cnclDatas.='<div style=" border-right: 1px solid #ccc; border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:68%;" >Between ';

								if(isset($new11[1]))

								$cnclDatas.=$new11[1];

								$cnclDatas.=' hours and ';

								$cnclDatas.=$new11[0];

								$cnclDatas.=' hours before journey time</div><div style="border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:30%;">';

								if(isset($new11[2]))

								$cnclDatas.=$new11[2];

								$cnclDatas.='% </div>';

							}

						}

                    } $h++;

                } $cnclDatas.='</div></div></div>'; 

?>



</div>

  

</div>



	<div class="Subheadimagesfooter"></div>



<?php

}

?>

</div>

</div>

</div>



<style>

#invoice{

    padding: 0px;

}



.invoice {

    position: relative;

    background-color: #FFF;

    min-height: 680px;

    padding: 15px

}



.invoice header {

    padding: 10px 0;

    margin-bottom: 20px;

    border-bottom: 1px solid #3989c6

}



.invoice .company-details {

    text-align: right

}



.invoice .company-details .name {

    margin-top: 0;

    margin-bottom: 0

}



.invoice .contacts {

    margin-bottom: 20px

}



.invoice .invoice-to {

    text-align: left

}



.invoice .invoice-to .to {

    margin-top: 0;

    margin-bottom: 0

}



.invoice .invoice-details {

    text-align: right

}



.invoice .invoice-details .invoice-id {

    margin-top: 0;

    color: #3989c6

}



.invoice main {

    padding-bottom: 50px

}



.invoice main .thanks {

    margin-top: -100px;

    font-size: 2em;

    margin-bottom: 50px

}



.invoice main .notices {

    padding-left: 6px;

    border-left: 6px solid #3989c6

}



.invoice main .notices .notice {

    font-size: 1.2em

}



.invoice table {

    width: 70%;

    border-collapse: collapse;

    border-spacing: 0;

    margin-bottom: 20px

}



.invoice table td,.invoice table th {

    padding: 15px;

    background: #eee;

    border-bottom: 1px solid #fff

}



.invoice table th {

    white-space: nowrap;

    font-weight: 400;

    font-size: 16px;

    background: #000;

    color: #fff;

}



.invoice table td h3 {

    margin: 0;

    font-weight: 400;

    color: #3989c6;

    font-size: 1.2em

}



.invoice table .qty,.invoice table .total,.invoice table .unit {

    text-align: right;

    font-size: 1.2em

}



.invoice table .no {

    font-size: 1.6em;

}



.invoice table .unit {

    background: #ddd

}



.invoice table .total {

     text-align: right;

    font-size: 1.2em

}



.invoice table tbody tr:last-child td {

    border: none

}



.invoice table tfoot td {

    background: 0 0;

    border-bottom: none;

    white-space: nowrap;

    text-align: right;

    padding: 10px 20px;

    font-size: 1.2em;

    border-top: 1px solid #aaa

}



.invoice table tfoot tr:first-child td {

    border-top: none

}



.invoice table tfoot tr:last-child td {

    color: #3989c6;

    font-size: 1.4em;

    border-top: 1px solid #3989c6

}



.invoice table tfoot tr td:first-child {

    border: none

}



.invoice footer {

    width: 100%;

    text-align: center;

    color: #777;

    border-top: 1px solid #aaa;

    padding: 8px 0

}



@media print {

    .invoice {

        font-size: 11px!important;

        overflow: hidden!important

    }



    .invoice footer {

        position: absolute;

        bottom: 10px;

        page-break-after: always

    }



    .invoice>div:last-child {

        page-break-before: always

    }

}

.type1{

	    width: 50px !important;

    margin-left: 135px !important;

    margin-top: 58px !important;

}

	.seatWrap{

		height:300px !important;

	}

.rightLegend h3{

	    margin-left: 140px !important;

}

.left p{

	display:none !important;

}

</style>



<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div id="invoice">



<input type="hidden" name="selected_seats" id="selected_seats" value="<?php echo $passenger_seat; ?>">


<input type="hidden" name="scheduleId" id="scheduleId" value="<?php echo $scheduleId; ?>">

<input type="hidden" name="inventoryId" id="inventoryId" value="<?php echo $inventoryId; ?>">

<input type="hidden" name="fromStationId" id="fromStationId" value="<?php echo $fromStationId; ?>">

<input type="hidden" name="toStationId" id="toStationId" value="<?php echo $toStationId; ?>">

<input type="hidden" name="travelDate" id="travelDate" value="<?php echo $travelDate; ?>">





    <div class="" style="max-width: 984px;margin-left: 248px;">
		
          <img alt="meebus" src="http://meebus.com/images/buslogo.png" style="width:150px;margin-left: -7px;" class="CToWUd" vspace="0" hspace="0" border="0">
  
          <button id="print" class="btn btn-info" style="margin-left: 695px;"><i class="fa fa-print"></i> Print</button>
       
    </div>	

    <div class="invoice overflow-auto">

        <div style="min-width: 800px">

            <main style="margin-left:218px;width:70%;background-color:#a7292f" class="alert alert-info">

                <div class="row contacts" style="width:101%;padding-top:40px;">

				<div class="row contacts alert alert-success" style="width:95%;margin-left: 35px;">

                    <div class="col invoice-to">

					

					<div class="text-gray-light"><h4 class="to"><i class="fa fa-check-circle" aria-hidden="true"></i> TICKET CONFIRMED</h4></div>

                        <div class="text-gray-light">CONFRIMATION TO : <?=ucfirst($lead_pax_name);?></div>

						<div class="text-gray-light">Email Id : <?=$emailId;?></div>

						<div class="text-gray-light">Mobile No : <?=$mobileNbr;?></div>

                    </div>

                    <div class="col invoice-details">

                        <div class="date">PNR : <?=$pnr;?></div>

                        <div class="date">TICKET NO : <?=$tin;?></div>

                        <div class="date">Booked On : 30/10/2018</div>

                    </div>

					</div>

                </div>

				

<!--<div class="row contacts alert alert-success" style="width:73%;">

                    <div class="col invoice-to">

                        <div class="text-gray-light"><h4 class="to">TICKET COMFIRMED</h4></div>

                      <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>

                    </div>

                </div>-->

				

				<div class="row contacts" style="width:101%;">

				

				

				<div class="col invoice-to">

				

                        <div class="text-gray-light"><h4 class="to" style="color:#fff">BUS DETAILS</h4></div>

										<br/>



						<table style="width:100%;">

						<tr>

                           <td colspan="2"></td>

                            <td colspan="2"><b>TRAVELS</b></td>

                            <td><b><?php echo $travelsName; ?></b></td>

                        </tr>

						<tr>

                            <td colspan="2"></td>

                            <td colspan="2"><b>BUS TYPE</b></td>

                            <td><b><?php echo $busType; ?></b></td>

                        </tr>

                        <tr>

                            <td colspan="2"></td>

                            <td colspan="2"><b>BOARDING POINT</b></td>

                            <td><b><?php echo $boarding_point; ?></b></td>

                        </tr>

                        <tr>

                            <td colspan="2"></td>

                            <td colspan="2"><b>DROPPING POINT</b></td>

                            <td><b><?php echo $dropping_point; ?></b></td>

                        </tr>

                        <tr>

                            <td colspan="2"></td>

                            <td colspan="2"><b>DEPARTURE TIME</b></td>

                            <td><b><?=$DepartureTime?></b></td>

                        </tr>

                    </table>



                </div>

				

				

				

				

                   

                </div>

				<div class="row contacts" style="width:101%;">

<div class="col invoice-to">

                        <div class="text-gray-light"><h4 class="to" style="color:#fff">PASSENGERS DETAILS</h4></div>

<br/>						

                <table border="0" cellspacing="0" cellpadding="0" style="width:100%;">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th class="text-left">TRAVELLERS</th>

                            <th class="text-right">SEAT</th>

                            <th class="text-right">AGE</th>

                            <th class="text-right">GENDER</th>

                        </tr>

                    </thead>

                    <tbody>

		<?php

		$j=1;

		for($i=0; $i<count($passenger['name']); $i++)

{

	//echo $firstName = $passenger["name"][0];

	if($passenger["sex"][$i]=='M')

	{

		$mrms = "Mr. ";

		$gender_d = "Male";

	}

	else 

	{

		$mrms = "Ms. ";

		$gender_d = "Female";

	}

	echo '<tr><td class="no">'.$j.'</td><td><b><h4>'.$mrms.ucfirst($passenger["name"][$i]).'</h4></b></td><td class="unit"><b>'.$passenger["seat"][$i].'</b></td><td class="total"><b>'.$passenger["age"][$i].'</b></td><td class="unit"><b>'.$gender_d.'</b></td></tr>';

$j++;

}		

?>	

                       

                   

                </table>

				</div>

				</div>

				

				<div class="row contacts" style="width:100%;">

		

		<div class="col invoice-to">

                        <div class="text-gray-light"><h4 class="to" style="color:#fff">SEAT PREVIEW</h4></div>

						<div class="seat-container-wrapper">

                           <div id="seatpreview">

						</div>

						</div>

						

						

						</div>

						</div>

				

				

				

				

				

						<div class="row contacts" style="width:100%;">

		

		<div class="col invoice-to">

                        <div class="text-gray-light"><h4 class="to" style="color:#fff">PAYMENT DETAILS</h4></div>

<br/>		

				<table style="width:101%;text-align:left;">

                        <tr>

                            <td colspan="1"></td>

                            <td colspan="2"><b>BASE FARE</b></td>

                            <td><b><?=$oneway_fare?></b></td>

                        </tr>

                        <tr>

                            <td colspan="1"></td>

                            <td colspan="2"><b>SERVICE TAX AMOUNT</b></td>

                            <td><b><?=$service_tax_amount?></b></td>

                        </tr>

                        <tr>

                            <td colspan="1"></td>

                            <td colspan="2"><b>TOTAL FARE</b></td>

                            <td><b><?=$total_fare.'.00'?></b></td>

                        </tr>

                    </table>

				</div>

				</div>

				

				

				<!-- <div class="row" style="width:70%;">

				<div class="col-md-6">

						

				</div>

				

				<div class="col-md-6">

				<div class="row contacts alert alert-info" >

                    <div class="col invoice-to">

                        <div class="text-gray-light"><h4 class="to">FARE BREAK UP</h4></div>

										<br/>



						<table style="width:100%;">

                        <tr>

                            <td colspan="2"></td>

                            <td colspan="2">BASE FARE</td>

                            <td>$5,200.00</td>

                        </tr>

                        <tr>

                            <td colspan="2"></td>

                            <td colspan="2">OTHER CHARGES</td>

                            <td>$1,300.00</td>

                        </tr>

                        <tr>

                            <td colspan="2"></td>

                            <td colspan="2">TOTAL FARE</td>

                            <td>$6,500.00</td>

                        </tr>

                    </table>



                </div>

				</div>

				</div>

				-->

			

				

			

				

            </main>

        </div>

        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->

        <div></div>

    </div>

</div>

		

		

		

		

	<script>

	

	 $('#printInvoice').click(function(){

            Popup($('.invoice')[0].outerHTML);

            function Popup(data) 

            {

                window.print();

                return true;

            }

        });

	$( document ).ready(function() {	

	

	var scheduleId = $('#scheduleId').val();

	var inventoryId = $('#inventoryId').val();

	var fromStationId = $('#fromStationId').val();

	var toStationId = $('#toStationId').val();

	var travelDate = $('#travelDate').val();

	var selected_seats = $('#selected_seats').val();


	$("#seatpreview").html("<div class='panel-load-con'><div class='panel-loader'></div></div>").show();



	$.ajax({

	type: "POST",

	url: "seatlayout.php",

	data: "rid="+scheduleId+"&sourceid="+fromStationId+"&destination="+toStationId+"&jdate="+travelDate+"&inventoryType="+inventoryId+""+"&selected_seats="+selected_seats,


	success:function(result)

	{

			$("#seatpreview").html(result).show();



	}

	});

	});

document.querySelector("#print").addEventListener("click", function() {
	window.print();
});

</script>	

		

		

		

		

		











<?php 

include 'includes/footer.php';

?>

