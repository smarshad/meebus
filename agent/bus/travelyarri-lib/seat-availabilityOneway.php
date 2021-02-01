<?php
ini_set('display_errors', 0);
session_start();
//include 'xmlparser.php';
//$xml = xml2ary(file_get_contents('../admin/markup-commission.xml'));
//$xml = $xml['Markup_Commission'];
//$Bus = $xml['Bus'];
//$bus_markup = $Bus['Markup']['_v'];
//$acal = $Bus['Markup']['_a']['Cal'];

$selectUserData = "SELECT * FROM user_login ORDER BY id ASC LIMIT 0,1";
$queryUserData = mysql_query($selectUserData);
$resultUserData = mysql_fetch_object($queryUserData);
$acal = $markup['_a']['Cal'] ='%';
$bus_markup = $markup['_v'] =$resultUserData->bus_user_markup;


$Transaction = $xml['Transaction'];
$pgwcharge_percentage = $Transaction['BusPaymentGateway']['_v'];
$_SESSION['PaymentGatewayPercentage'] = $pgwcharge_percentage;
?>
<script>
    $(function() {
        $('.avail').click(function() {
            $r = $(this).find('img').attr('rel');
            $temp = $(this).find('img').attr('title'); // Getting String Like "Seat number: 2  |  Fare: Rs. 500"
            $temp = $temp.split('|');                 // After Spliting "Fare: Rs. 500"
            $temp = $temp[1].split('. ');           // After Spliting "500"
            $p = $temp[1];
            $n = $(this).find('img').attr('alt');
            $(this).find('img').toggle();
            $cp = $('#sellprice_oneway').val();
            $c = $('#seatName_oneway').val();
            $np = $('#netprice_oneway').val();
            v = $c.split('|A|');
            vn = $np.split('|A|');

            if ($.inArray($r, v) != -1)
            {
                $.each(v, function(i, v) {
                    if (v == $r)
                        $len = i;
                });
                v.splice($len, 1);
                $v = v.join('|A|');
                $('#seatName_oneway').val($v);

                $.each(vn, function(i, vn) {
                    if (vn == $n)
                        $len = i;
                });
                vn.splice($len, 1);
                $vn = vn.join('|A|');
                $('#netprice_oneway').val($vn);


                $tp = parseInt($cp) - parseInt($p);
                $('#sellprice_oneway').val($tp);
            }
            else
            {

                vn[vn.length] = $n;
                $vn = vn.join('|A|');
                $('#netprice_oneway').val($vn);

                v[v.length] = $r;
                $v = v.join('|A|');
                $('#seatName_oneway').val($v);


                if ($cp == '')
                {
                    $tp = $p;
                    $('#sellprice_oneway').val($p);
                }
                else
                {
                    $tp = parseInt($p) + parseInt($cp);
                    $('#sellprice_oneway').val($tp);
                }
            }


            $("#seat").html('');
            $("#price").html('');
            $.each(v, function(i, v) {
                if (v != '')
                {
                    $("#seat").append("<font color='red' size='1'>" + v + "," + "</font>");
                    $("#price").html($tp);
                }
            });
        });
    });

    function boardingLocation()
    {
        $id = document.booking.BoardingPointName.value;
        $bid = $id.split('-');
        $bid = $bid[0];
        if ($bid != "")
        {
            $.post('include/getBoardingLocation.php', {'id': $bid}, function(data) {
                if (data != "") {
                    $('#setBoardingPoint').html('<img src="images/location.png" width="13" height="18" / style="margin:0 5px; vertical-align:middle;">' + data);
                    $('#setBoardingPoint').show();
                }
            });
        }
        else
        {
            $('#setBoardingPoint').hide();
        }

    }

    function validate() {
        $bpval = $('select[name=BoardingPointName]').val();
        $seat = $('#seat').html();
        $c = $('#seatName_oneway').val();
        v = $c.split('|A|');
        v = parseInt(v.length) - 1;
        if ($bpval == '') {
            alert('Please select boarding point');
            return false;
        }
        else if ($seat == '') {
            alert('Please select seat');
            return false;
        }
        else if (v > 6)
        {
            alert("Sorry, you can select upto 6 seat(s) per booking.");
            return false;
        }
        else
        {
            // Add the mask to body

            $('body').append('<div id="mask"></div>');
            $('#mask').fadeIn(300);
            $('.pop_up').fadeIn(300);

            // Round Trip Data here
            setTimeout(function() {
                $('.pop_up').remove();
                $('#mask').remove();
                $("#BUSSEARCH1").show();
                $("#BUSSEARCH").hide();
            }, 1000);

            // Assigning values for roundtrip
            var selling = $('#sellprice_oneway').val();
            $('.sellingPrice_oneway').val(selling);

            var bus_provider = $('#bus_provider_oneway').val();
            $('.bus_provider_oneway').val(bus_provider);

            var bus_type = $('#bus_type_oneway').val();
            $('.bus_type_oneway').val(bus_type);

            var scheduleId = $('#scheduleId_oneway').val();
            $('.scheduleId_oneway').val(scheduleId);

            var travelDate = $('#travelDate_oneway').val();
            $('.travelDate_oneway').val(travelDate);

            var fromStationId = $('#fromStationId_oneway').val();
            $('.fromStationId_oneway').val(fromStationId);

            var toStationId = $('#toStationId_oneway').val();
            $('.toStationId_oneway').val(toStationId);

            var net_price_oneway = $('#netprice_oneway').val();
            $('.net_price_oneway').val(net_price_oneway);

            //seats
            var seatname = $('#seatName_oneway').val();
            $('.seatName_oneway').val(seatname);

            var ret = seatname.split("|A|");

            for (var i = 0, l = ret.length; i < l; ++i) {
                ret[i] = $.trim(ret[i]);
                var tot_seatselect = (ret.length) - 1;
            }
            $('.seat_name2').val(ret); // seat nos
            if (tot_seatselect == 1)
            {
                var totseats = '1 Seat selected';
            } else {
                var totseats = tot_seatselect + ' Seats selected';
            }
            $('.totseatselect').html(totseats); // total seats selected

            var BoardingPointName1 = $('#BoardingPointName_oneway').val();
            $('.BoardingPointName_oneway').val(BoardingPointName1);

            var bname = BoardingPointName1.split("-");
            var sttr1 = bname[0];
            var sttr2 = bname[1];
            var sttr3 = bname[2];
            var res_str = sttr2 + '-' + sttr3;
            $('.BoardingPointName2').val(res_str);

            return false;
        }
        //document.booking.submit();
    }
</script>
<style>
    .avail img{cursor:pointer;}
    #seat_set
    {
        font-family: Arial,Helvetica,sans-serif;
        font-size: 11px;
        line-height: 18px;
        padding-left: 5px;
        text-align: center;
    }
</style>
<?php

function objectToArray($object) {
    if (!is_object($object) && !is_array($object)) {
        return $object;
    }
    if (is_object($object)) {
        $object = get_object_vars($object);
    }
    return array_map('objectToArray', $object);
}

function convertdate($travelDate) {
    $tdate = explode('/', $travelDate);
    $tdate = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];
    return $tdate;
}

function calculate_bus_markup($RPSeat) {
    $cost_price = $RPSeat;
    global $acal, $bus_markup, $selling_price;
    if ($acal == '%')
        $markup = ($cost_price * $bus_markup) / 100;
    else if ($acal == 'Rs')
        $markup = $bus_markup;
    $selling_price = $markup + $cost_price;

    //---START=>(DESC:ADDING PAYMENTGATEWAY CHARGE)----------------------------------------------------------------------
    //---------------CALCULATING PAYMENTGATEWAY CHARGE---------------------------
    $pgwcharge = (($selling_price * $_SESSION['PaymentGatewayPercentage']) / 100);

    //---------------TOTAL PRICE INCLUDING PAYMENTGATEWAY CHARGE----------------
    $selling_price = $selling_price + round($pgwcharge);
    unset($_SESSION['PaymentGatewayChangeFromSearchResult']);
    $_SESSION['PaymentGatewayChangeFromSearchResult'] = round($pgwcharge);

    return $selling_price;
}

$bus_provider = mysql_escape_string($_POST['bus_provider']);
$bus_type = mysql_escape_string($_POST['bus_type']);
$scheduleId = mysql_escape_string($_POST['scheduleId']);
$travelDate = mysql_escape_string($_POST['travelDate']);
$fromStationId = mysql_escape_string($_POST['fromStationId']);
$toStationId = mysql_escape_string($_POST['toStationId']);
$bording_points = mysql_escape_string($_POST['bording_points']);
$tdate = convertdate($travelDate);

/* * *********************************************** */
$bp_array = explode("&&", $bording_points);

$bp_id = $bp_array[0];
$bp_location = $bp_array[1];
$bp_time = $bp_array[2];

include 'layout-SoapClient.php';
//exit;
//if($error=='')
//{
$result = objectToArray($results);
unset($seat_type_counter);
$SeatLayoutSTR = $GetSeatLayoutResult = $result['seats'];

foreach ($SeatLayoutSTR as $val) {
    if ($val['zIndex'] == 0) {
        // Values for lower birth and sleeper and seater both
        $i = $val['row'];
        $j = $val['column'];
        $RowNo[$i] = $val['row'];
        $ColumnNo[$j] = $val['column'];
        $SeatName[$i][$j] = $val['name'];
        $SeatStatus[$i][$j] = $val['available'];
        $SeatFare[$i][$j] = $val['fare'];
        $ladish[$i][$j] = $val['ladiesSeat'];
        $st[$i][$j] = $val['zIndex'];
        $s_length[$i][$j] = $val['length'];
        $s_width[$i][$j] = $val['width'];
    } else {
        // Values for upper lower birth
        $seat_type_counter = "sleeper";
        $i = $val['row'];
        $j = $val['column'];
        $RowNo1[$i] = $val['row'];
        $ColumnNo1[$j] = $val['column'];
        $SeatName1[$i][$j] = $val['name'];
        $SeatStatus1[$i][$j] = $val['available'];
        $SeatFare1[$i][$j] = $val['fare'];
        $ladish1[$i][$j] = $val['ladiesSeat'];
        $st1[$i][$j] = $val['zIndex'];
        $s_length1[$i][$j] = $val['length'];
        $s_width1[$i][$j] = $val['width'];
    }
}

$li = max($RowNo);
$lj = max($ColumnNo);
$li1 = max($RowNo1);
$lj1 = max($ColumnNo1);
?>
<div style="width:70%; padding:15px; margin:10px 0; box-shadow: 0 0 14px #CCCCCC; height:100%; border:1px #ddd solid; border-radius:6px;margin:auto;">
    <table width="100%" height="199" border="0" cellspacing="2" cellpadding="0">
        <tr>
            <td width="229" align="left" valign="top">&nbsp;</td>
            <td width="71" align="left" valign="top">&nbsp;</td>
            <td width="67" align="left" valign="top">&nbsp;</td>
            <td width="57" align="left" valign="top">&nbsp;</td>
            <td align="right" valign="top"><!--<img src="images/Close.png" width="21" height="21" /> --></td>
        </tr>
        <tr>
            <td colspan="4" align="left" valign="top" id="seat_set">Hint: click on seat to select/deselect</td>
            <td width="131" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" rowspan="5" align="right" valign="top">
                <!--seat availablity table start -->
                <table border="0" width="100%" height="100%" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table border="0" width="100%" height="40%" align="left" class="input">
                                <?php
                                if (isset($seat_type_counter)) {
                                    /*                                     * ************************************* Sleeper Lower Seats ******************************** */
                                    $flag = true;
                                    for ($i = 0; $i <= $li; $i++) {
                                        echo '<tr>';
                                        for ($j = 0; $j <= $lj; $j++) {
                                            /* Seating arrangement Start here */
                                            if ($st[$i][$j] == 0) {
                                                if ($ladish[$i][$j] == 'true') {
                                                    $ladis = "-ladies";
                                                } else {
                                                    $ladis = "";
                                                }
                                                // finding whether seat type is sleeper or seater
                                                if (($s_length[$i][$j] == 1 && $s_width[$i][$j] == 2)) {
                                                    $seat_type = 'Sleeper_v';
                                                    $_val = '2';
                                                    $img = '<img src="images/lower.jpg" width="21" height="65" />';
                                                } else if (($s_length[$i][$j] == 2 && $s_width[$i][$j] == 1)) {
                                                    $seat_type = 'Sleeper';
                                                    $_val = '2';
                                                    $img = '<img src="images/lower.jpg" width="21" height="65" />';
                                                } else {
                                                    $seat_type = 'Seat';
                                                    $_val = '';
                                                    $img = '<img src="images/lower.jpg" width="21" height="65" />';
                                                }

                                                //start displaying from here the steering part
                                                if ($flag) {
                                                    echo '<td width="30" height="65"  rowspan=' . ($li + 1) . ' valign="top"><img src="images/steering.jpg"  /><br>' . $img . '</td>';
                                                    $flag = false;
                                                }

                                                echo '<td width="20" height="15" align="center">';

                                                // If seat is available then display the seat
                                                if ($SeatStatus[$i][$j] == "true") {
                                                    echo '<div class="avail"><img  src="images/' . $seat_type . $ladis . '.jpg"  title="Seat number: ' . $SeatName[$i][$j] . '  |  Fare: Rs. ' . calculate_bus_markup($SeatFare[$i][$j]) . '" rel="' . $SeatName[$i][$j] . '" alt ="' . $SeatFare[$i][$j] . '" ><img  src="images/' . $seat_type . '-availed.jpg" style="display:none" rel=""  alt=""></div>';
                                                } else if ($SeatStatus[$i][$j] == 0 && count($SeatName[$i][$j]) != 0) {
                                                    echo '<img src="images/' . $seat_type . '-booked.jpg">';
                                                }
                                                echo '</td>';
                                            }
                                        }
                                        echo '</tr>';
                                    }
                                    ?>
                                </table>


                                <div style="height:2px; clear:both; width:100%;"></div>

                                <table border="0" width="100%" height="40%" align="center" class="input" style="margin-top:20px;">
                                    <?php
                                    /*                                     * ******************************************** Sleeper Upper Seats *********************************************** */
                                    $flag = true;
                                    for ($i = 0; $i <= $li1; $i++) {
                                        echo '<tr>';
                                        for ($j = 0; $j <= $lj1; $j++) {
                                            //start displaying from here the steering part
                                            if ($flag) {
                                                echo '<td width="30" height="30" rowspan=' . ($li1 + 1) . '><br><img src="images/upper.jpg" width="30" height="65" /></td>';
                                                $flag = false;
                                            }

                                            echo '<td width="20" height="15" align="center">';

                                            /* Seating arrangement Start here */
                                            if ($st1[$i][$j] == 1) {
                                                if ($ladish1[$i][$j] == 'true') {
                                                    $ladis = "-ladies";
                                                } else {
                                                    $ladis = "";
                                                }
                                                // finding whether seat type is sleeper or seater
                                                if (($s_length1[$i][$j] == 1 && $s_width1[$i][$j] == 2)) {
                                                    $seat_type = 'Sleeper_v';
                                                    $_val = '2';
                                                    $img = '<img src="images/upper.jpg" width="21" height="65" />';
                                                } else if (($s_length1[$i][$j] == 2 && $s_width1[$i][$j] == 1)) {
                                                    $seat_type = 'Sleeper';
                                                    $_val = '2';
                                                    $img = '<img src="images/upper.jpg" width="21" height="65" />';
                                                } else {
                                                    $seat_type = 'Seat';
                                                    $_val = '';
                                                    $img = '<img src="images/upper.jpg" width="21" height="65" />';
                                                }


                                                // If seat is available then display the seat
                                                if ($SeatStatus1[$i][$j] == "true") {
                                                    echo '<div class="avail"><img  src="images/' . $seat_type . $ladis . '.jpg"  title="Seat number: ' . $SeatName1[$i][$j] . '  |  Fare: Rs. ' . calculate_bus_markup($SeatFare1[$i][$j]) . '" rel="' . $SeatName1[$i][$j] . '" alt ="' . $SeatFare1[$i][$j] . '" ><img  src="images/' . $seat_type . '-availed.jpg" style="display:none" rel=""  alt=""></div>';
                                                } else if ($SeatStatus1[$i][$j] == 0 && count($SeatName1[$i][$j]) != 0) {
                                                    echo '<img src="images/' . $seat_type . '-booked.jpg">';
                                                }
                                                echo '</td>';
                                            }
                                        }
                                        echo '</tr>';
                                    }
                                    /*                                     * ********************************************End Sleeper Upper Seats *********************************************** */
                                } else {
                                    $flag = true;
                                    for ($i = 0; $i <= $li; $i++) {
                                        echo '<tr>';
                                        for ($j = 0; $j <= $lj; $j++) {
                                            /* Seating arrangement Start here */
                                            if ($ladish[$i][$j] == 'true') {
                                                $ladis = "-ladies";
                                            } else {
                                                $ladis = "";
                                            }
                                            // finding whether seat type is sleeper or seater
                                            if (($s_length[$i][$j] == 1 && $s_width[$i][$j] == 2) || ($s_length[$i][$j] == 2 && $s_width[$i][$j] == 1)) {
                                                $seat_type = 'Sleeper';
                                                $_val = '2';
                                                if ($st[$i][$j] == 0) // if it is 0 then it whould be lb
                                                    $img = '<img src="images/lower.jpg" width="21" height="65" />';
                                                else if ($st[$i][$j] == 1)
                                                    $img = '<img src="images/upper.jpg" width="21" height="65" />';
                                                else
                                                    $img = '';
                                            }
                                            else {
                                                $seat_type = 'Seat';
                                                $_val = '';
                                            }

                                            //start displaying from here the steering part
                                            if ($flag) {
                                                echo '<td width="30" height="30" rowspan=' . ($li + 1) . ' valign="top"><img src="images/steering.jpg"  /><br>' . $img . '</td>';
                                                $flag = false;
                                            }

                                            echo '<td width="30" height="30" align="center">';

                                            // If seat is available then display the seat
                                            if ($SeatStatus[$i][$j] == "true") {
                                                echo '<div class="avail"><img  src="images/' . $seat_type .$ladis. '.jpg"  title="Seat number: ' . $SeatName[$i][$j] . '  |  Fare: Rs. ' . calculate_bus_markup($SeatFare[$i][$j]) . '" rel="' . $SeatName[$i][$j] . '" alt ="' . $SeatFare[$i][$j] . '" ><img  src="images/' . $seat_type . '-availed.jpg" style="display:none" rel=""  alt=""></div>';
                                            } else if ($SeatStatus[$i][$j] == 0 && count($SeatName[$i][$j]) != 0) {
                                                echo '<img src="images/' . $seat_type . '-booked.jpg">';
                                            }
                                            echo '</td>';
                                        }
                                        echo '</tr>';
                                    }
                                }
                                /* Seating arrangement Start here */
                                ?>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--seat availablity table End --></td>
            <?php
            if ($seat_type == "Sleeper_v") {
                $seat_type = "Sleeper";
            }
            ?>
            <td align="right" valign="top"><img src="images/<?php echo $seat_type . $_val; ?>.jpg" /></span></td>
            <td align="left" valign="top" id="seat_set">Available seat</td>
        </tr>
        <tr>
            <td align="right" valign="top"><img  src="images/<?php echo $seat_type . $_val; ?>-ladies.jpg" /></span></td>
            <td align="left" valign="top" id="seat_set">Reserved for ladies</td>
        </tr>
        <tr>
            <td align="right" valign="top"><img src="images/<?php echo $seat_type . $_val; ?>-availed.jpg" /></span></td>
            <td align="left" valign="top" id="seat_set">Selected seat</td>
        </tr>
        <tr>
            <td align="left" valign="top" id="seat_set"><strong>Seats:</strong> <br /> <br /><strong>Amounts:</strong> </td>
            <td align="left" valign="top">
                <table><tr><td id="seat" style="padding:0px;font-size:12px;font-weight:bold;"></td></tr><tr><td id="price"  style="font-size:12px; font-family:Arial, Helvetica, sans-serif; text-align:left; font-weight:bold; padding-left:5px; color:#333; padding-top:18px;"></td></tr></table></td>
        </tr>
    </table>
</div>
<?php
$bp_id = explode(",", $bp_id);
$bp_location = explode(",", $bp_location);
$bp_time = explode(",", $bp_time);
$total_bp = count($bp_id);
?>

<form name="booking" action="bus-booking.php" method="POST">
    <input type="hidden" value="<?php echo $_POST['bus_provider']; ?>" id="bus_provider_oneway" name="bus_provider_oneway" />
    <input type="hidden" value="<?php echo $_POST['bus_type']; ?>" name="bus_type_oneway" id="bus_type_oneway" />
    <input type="hidden" value="<?php echo $_POST['scheduleId']; ?>" name="scheduleId_oneway" id="scheduleId_oneway" />
    <input type="hidden" value="<?php echo $_POST['travelDate']; ?>" name="travelDate_oneway" id="travelDate_oneway" />
    <input type="hidden" value="<?php echo $_POST['fromStationId']; ?>" name="fromStationId_oneway" id="fromStationId_oneway" />
    <input type="hidden" value="<?php echo $_POST['toStationId']; ?>" name="toStationId_oneway" id="toStationId_oneway"  />
    <input type="hidden" value="" name="seatname_oneway" id="seatName_oneway" />
    <input type="hidden" value="" name="seat" id="seat" />
    <input type="hidden" value="" name="sell_price_oneway" id="sellprice_oneway" />
    <input type="hidden" value="<?php echo $_POST['net_fair']; ?>" name="net_price_oneway" id="netprice_oneway" />

    <div style="clear:both; width:100%; height:5px;"></div>
    <table width="462" border="0" align="center" cellpadding="0" cellspacing="0" style="margin:0 auto; font-size: 11px;  font-weight: bold;line-height: 30px;    text-align: left;">
        <tr><td>BoardingPoint Name</td><td colspan="2" >
                <select onchange="boardingLocation()" name="BoardingPointName" id="BoardingPointName_oneway" style="width:200px;">
                    <option value="">--- Boarding Points ---</option>
                    <?php
                    for ($k = ($total_bp - 1); $k >= 0; $k--) {
                        if (floor($bp_time[$k] / 60) > 24) {
                            $time = date("g:i A", strtotime((floor(($bp_time[$k] / 60) - 24) . ":" . $bp_time[$k] % 60)));
                        } else {
                            $time = date("g:i A", strtotime(floor($bp_time[$k] / 60) . ":" . $bp_time[$k] % 60));
                        }
                        ?>
                        <option value="<?php echo $bp_id[$k] . '-' . $bp_location[$k] . '-' . $time; ?>"><?php echo $bp_location[$k] . "-" . $time; ?></option>
                    <?php } ?>
                </select>
                <br />
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="2">
                <input type="submit" class="btn2 btn_blue" name="submit" value="Book Request" onclick="return validate();" />
                <input type="hidden" name="submit" value="bookrequest" />
            </td>
        </tr>
        <tr><td colspan="3"><div id="setBoardingPoint" style=" display:none; border:1px solid #ddd; text-align:center; margin:10px 0; background:#e3e3e3; padding:3px; font-size:10px; color:#000; border-radius:7px;"></div></td></tr>
    </table>
    <div style="clear:both; width:100%; height:5px;"></div>
</form>