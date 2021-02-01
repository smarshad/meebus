<?php

GLOBAL $conn;
include_once "header.php";
// echo "<pre>"; print_r($_SESSION); echo "</pre>"; exit;
include "bus_library/APICaller.php";
// echo "<pre>"; print_r($_GET); echo "</pre>"; exit;
if(isset($_POST))
{
    if(isset($_POST['ter_from']))
    $fromStation=$_POST['ter_from'];
    if(isset($_POST['tag']))
    $toStation=$_POST['tag'];
    if(isset($_POST['doj']))
    $journey_date=date("Y-m-d",strtotime($_POST['doj']));
    $triptype=1;
}
include_once 'includes/User.php';
$obj = new User($conn);
$GLOBALS['obj']=$obj;
// echo 'dsadasdsad=';
/*echo $ress=$obj->getBookingInfoByPaystatus(3);
exit;

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
}*/


$QUERYOne = 'SELECT * FROM bookinginfo WHERE pay_status=1';
$results = $conn->query($QUERYOne);
if ($results->num_rows > 0) {
    $i=1;
  // output data of each row

  while($row = $result->fetch_assoc()) {
    $value = strtotime($row['created_date']);
    $cur_time=time(); 
    $time_diff=($cur_time-$value ); 
    $minutes = floor($time_diff % 3600 / 60);
    
    if($minutes>=2)
    {
        $obj->delbookingInfo(array($row['auto_id']));   
    }
    $i++;
  }
} 


if(isset($_SESSION['ticket_id'])){
    unset($_SESSION['book_var']);         
    unset($_SESSION['ticket_id']);
    unset($_SESSION['total_seats']);    
}
if(isset($_GET['prev']))
{
    $fromStation=$_GET['ter_from'];
    $triptype=1;
    $toStation=$_GET['tag'];
    $date=$_GET['doj'];
    $journey_date=date( 'Y-m-d', strtotime( $date . ' -1 day' ) );
}   
if(isset($_GET['next']))
{
    $fromStation=$_GET['ter_from'];
    $toStation=$_GET['tag'];
    $triptype=1;
    $date=$_GET['doj'];
    $journey_date=date( 'Y-m-d', strtotime( $date . ' +1 day' ) );
}
if(isset($_GET['submit']) && $_GET['submit']=='search')
{
    $fromStation=$_GET['ter_from'];
    $toStation=$_GET['tag'];
    $triptype=1;
    $journey_date=date('Y-m-d',strtotime($_GET['doj']));
}
$_SESSION['user']['request']['source']=$_SESSION['user']['fromstation']=$fromStation;
$_SESSION['user']['request']['destination']=$_SESSION['user']['tostation']=$toStation;
$_SESSION['user']['request']['journey_date']=$_SESSION['user']['journey_date']=$journey_date;
$_SESSION['user']['request']['triptype']=$_SESSION['user']['tripType']=$triptype;
if($triptype==2)
{
    $_SESSION['user']['tripcount']=1;
}
/* ETS RESULT START */
if(isset($_SESSION['user']['sessId']))
{
    $searchDetails=json_encode($_SESSION['user']['request']);
    $sessionId=$_SESSION['user']['sessId'];
    $obj->updatebusSearch(array($searchDetails,$sessionId));
}

//echo "<pre>"; print_r(array($fromStation,$toStation,$journey_date)); echo "</pre>"; exit;
$results=getAvailableBuses($fromStation,$toStation,$journey_date);
/* ETS RESULT END */
$_SESSION['user']['apiAvailableBuses']=$results['apiAvailableBuses'];
$_SESSION['user']['trips']=$trips=$results['apiAvailableBuses'];
$jsontrips = substr(json_encode($trips), 0, 10000);
if(isset($sessionId))
$obj->updatebussearchList(array($jsontrips,$sessionId));
?>
<style>
.w-10 
{
    cursor:pointer;
}
.w-15
{
    cursor:pointer;
}
</style>
<div id="fixer" class="fixer">
        <div class="modify-sec-onward modify-sec clearfix">
            <div class="w-50 fl jour-info clearfix">
                <div class="onward d-block fl">
                    <span class="src" title="Chennai"><?php echo $fromStation;?></span>
                    <i class="icon icon-right-arrow"></i>
                    <span class="dst" title="Trichy"><?php echo $toStation;?></span>
                    <span class="prev"><a href="search.php?fromCity=<?php echo $fromStation;?>&toCity=<?php echo $toStation; ?>&doj=<?php echo $journey_date; ?>&prev"><i class="icon icon-left"></i></span></a>
                    <span id="searchDat" class="searchDate"><?php echo date('d M', strtotime($journey_date));?></span>
                    <span class="next"><a href="search.php?fromCity=<?php echo $fromStation;?>&toCity=<?php echo $toStation; ?>&doj=<?php echo $journey_date; ?>&next"><i class="icon icon-right"></i></span></a>
                </div>
                <div class="onward-modify-btn g-button clearfix fl">Modify</div>
            </div>
            <!--<div class="add-return-blk fr">
                <div class="addreturn-btn fr"><span class="g-button">Add a return ticket</span></div>
            </div>-->
        </div>
        <section class="clearfix search-wrapper" style="display: none">
        <form action="" method="GET">
           <div class="search-section">
              <div class="parent-textbox  fl">
                 <div class="top-lbl">FROM</div>
                 <div class="textbox fl"><input name="fromCity" id="originid" class="" data-id="123" autocomplete="off" value="<?php echo $fromStation?>" type="text"></div>
              </div>
              <span class="icon-doublearrow icon fl" id="switchButton"></span>
              <div class="parent-textbox  fl">
                 <div class="top-lbl">To</div>
                 <div class="textbox fl"><input name="toCity" id="destinationid" class="" data-id="71929" autocomplete="off" value="<?php echo $toStation; ?>" type="text"></div>
              </div>
              <div class="textbox fl">
                 <div class="top-lbl">DATE</div>
                 <input id="onward_cal" name="doj" value="<?php echo date('d-m-Y',strtotime($journey_date));?>" class="datepickers" type="text">
                 <div id="onward_modify" class="calendar-blk-search calendar-blk-ond hide"></div>
              </div>
              <div class="parent-textbox  fl"><button name="submit" type="submit" value="search" class=" button ms-btn">SEARCH</button></div>
              <div class="fr" id="mod_cancel"><i class="icon icon-cross"></i></div>
           </div>
           </form>
        </section>
    </div>
    <div class="filtersilde">
    <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md btnss" onclick="open_sidebar();" style="padding: 3px 5px;;position: relative;left: 16px;top: 6px;border: 2px Solid;"><i class="fa fa-bars"></i></span>
    </div>
    <div class="srp-data clearfix">
        <div id="filter-block" class="filter-sec fl w-20 sidebar">
        <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md btnss" onclick="close_sidebar();" style="border-radius:50%; position: absolute; top:16px;"><i class="fa fa-times"></i></span>
            <div class="filter-details f-12 d-color filtercolor">
                <div class="title f-bold">FILTERS<!--<span class="clearFilters fr f-12">RESET</span>--></div>
                <div class="details">
                    <div class="filter-titles f-12 f-bold">DEPARTURE TIME</div>
                    <ul class="dept-time dt-time-filter">
                       <li class="checkbox">
                       <input id="dtBefore 6 am" name="depart[]" value="1" type="checkbox" onclick="return filter();">
                       <label for="dtBefore 6 am" class="custom-checkbox"></label><span><i class="icon fl icon-morning"></i></span><label for="dtBefore 6 am" class="cbox-label" title="Before 6 am">Before 6 am (<span id="time_1"></span>)</label></li>
                       <li class="checkbox"><input name="depart[]" value="2" id="dt6 am to 12 pm" type="checkbox" onclick="return filter();"><label for="dt6 am to 12 pm" class="custom-checkbox"></label><span><i class="icon fl icon-afternoon"></i></span><label for="dt6 am to 12 pm" class="cbox-label" title="6 am to 12 pm">6 am to 12 pm (<span id="time_2"></span>)</label></li>
                       <li class="checkbox"><input name="depart[]" value="3" id="dt12 pm to 6 pm" type="checkbox" onclick="return filter();"><label for="dt12 pm to 6 pm" class="custom-checkbox"></label><span><i class="icon fl icon-evening"></i></span><label for="dt12 pm to 6 pm" class="cbox-label" title="12 pm to 6 pm">12 pm to 6 pm (<span id="time_3"></span>)</label></li>
                       <li class="checkbox"><input name="depart[]" value="4" id="dtAfter 6 pm" type="checkbox" onclick="return filter();"><label for="dtAfter 6 pm" class="custom-checkbox"></label><span><i class="icon fl icon-night"></i></span><label for="dtAfter 6 pm" class="cbox-label" title="After 6 pm">After 6 pm (<span id="time_4"></span>)</label></li>
                    </ul>
                    <div class="filter-titles f-12 f-bold">BUS TYPES</div>
                    <ul class="list-chkbox">
                       <li class="checkbox"><input name="bustype[]" id="bt_SEATER" value="seater" type="checkbox" onclick="return filter();"><label for="bt_SEATER" class="custom-checkbox"></label><label for="bt_SEATER" class="cbox-label" title="SEATER">SEATER (<span id="seater"></span>)</label></li>
                       <li class="checkbox"><input name="bustype[]" id="bt_SLEEPER" value="sleeper" type="checkbox" onclick="return filter();"><label for="bt_SLEEPER" class="custom-checkbox"></label><label for="bt_SLEEPER" class="cbox-label" title="SLEEPER">SLEEPER (<span id="sleeper"></span>)</label></li>
                       <li class="checkbox"><input name="bustype[]" id="bt_AC" value="ac" type="checkbox" onclick="return filter();"><label for="bt_AC" class="custom-checkbox"></label><label for="bt_AC" class="cbox-label" title="AC">AC (<span id="ac"></span>)</label></li>
                       <li class="checkbox"><input name="bustype[]" id="bt_NONAC" value="nonac" type="checkbox" onclick="return filter();"><label for="bt_NONAC" class="custom-checkbox"></label><label for="bt_NONAC" class="cbox-label" title="NONAC">NONAC (<span id="non_ac"></span>)</label></li>
                    </ul>
                    <div class="filter-titles f-12 f-bold">ARRIVAL TIME</div>
                    <ul class="dept-time at-time-filter">
                       <li data-value="" class="checkbox"><input id="atBefore 6 am" name="arrival[]" value="5" type="checkbox"onclick="return filter();"><label for="atBefore 6 am" class="custom-checkbox"></label><span><i class="icon fl icon-morning"></i></span><label for="atBefore 6 am" class="cbox-label" title="Before 6 am">Before 6 am (<span id="time_5"></span>)</label></li>
                       <li data-value="" class="checkbox" onclick="return filter();"><input name="arrival[]" id="at6 am to 12 pm" value="6" type="checkbox"><label for="at6 am to 12 pm" class="custom-checkbox"></label><span><i class="icon fl icon-afternoon"></i></span><label for="at6 am to 12 pm" class="cbox-label" title="6 am to 12 pm">6 am to 12 pm (<span id="time_6"></span>)</label></li>
                       <li data-value="" class="checkbox" onclick="return filter();"><input name="arrival[]" id="at12 pm to 6 pm" value="7" type="checkbox"><label for="at12 pm to 6 pm" class="custom-checkbox"></label><span><i class="icon fl icon-evening"></i></span><label for="at12 pm to 6 pm" class="cbox-label" title="12 pm to 6 pm">12 pm to 6 pm (<span id="time_7"></span>)</label></li>
                       <li data-value="" class="checkbox" onclick="return filter();"><input name="arrival[]" id="atAfter 6 pm" value="8" type="checkbox"><label for="atAfter 6 pm" class="custom-checkbox"></label><span><i class="icon fl icon-night"></i></span><label for="atAfter 6 pm" class="cbox-label" title="After 6 pm">After 6 pm (<span id="time_8"></span>)</label></li>
                    </ul>


                </div>
            </div>
        </div>
        <div class="sort-results w-80 fl">  
            <div class="sort-sec clearfix onward ">
               <div class="w-40 fl"><span class="w-60 d-block"><span class="f-bold"><?php echo count($results['apiAvailableBuses']);?> Buses </span>found</span><span class="w-30 d-block f-12 d-color f-bold t-right">SORT BY:</span></div>
               <div class="w-10 fl f-12 d-color"><a id="depart">Departure<i class=""></i></a></div>
               <div class="w-10 fl f-12 d-color"><a class="sort" data-sort="sm_Duration">Duration<i class=""></i></a></div>
               <div class="w-10 fl f-12 d-color"><a class="sort" data-sort="sm_Arrival">Arrival<i class=""></i></a></div>
               <!--<div class="w-10 fl f-12 d-color"><a>Ratings<i class=""></i></a></div>-->
               <div class="w-15 fl f-12 d-color"><a class="sort" data-sort="sm_Fare">Fare<i class=""></i></a></div>
               <div class="w-15 fl f-12 d-color"><a class="sort" data-sort="sm_Seats">Seats Available<i class=""></i></a></div>
            </div>
            <div class="result-sec">
                <ul class="bus-items">
                <?php 
                     $time_1 = 0;
                      $time_2 = 0;
                      $time_3 = 0;
                      $time_4 = 0;
                      $time_5 = 0;
                      $time_5 = 0;
                      $time_6 = 0;
                      $time_7 = 0;
                      $time_8 = 0;
                     $sleeper = 0;
                     $seater = 0;
                     $ac = 0;
                     $non_ac=0;
                      foreach($results['apiAvailableBuses'] as $busresult) 
                      {
                          
                          
                          $fare=explode(',',$busresult['fare']);
                          $departureTime=$busresult['departureTime'];
                          //echo strtotime($busresult['departureTime']);
                          $arraivalTime=$busresult['arrivalTime'];
                          $start=strtotime($departureTime); 
                          $end=strtotime($arraivalTime);
                          $timeDiff=$end - $start;
                          $duration=gmdate('H:i', $timeDiff);
                          $boardingPoints=$busresult['boardingPoints'];
                          $droppingPoints=$busresult['droppingPoints'];
                          $cancellation=json_decode($busresult['cancellationPolicy'],1);
                          
                    ?>
                    <li id="<?= $busresult['routeScheduleId'];?>"class="row-sec  bus_filt clearfix <?php 
                    if((((int) date('H', strtotime($busresult['departureTime']))) >= 0) && ((int) date('H', strtotime($busresult['departureTime']))) < 6)               {
                        echo 'time_1';
                        $time_1++;
                        }
                    else if((((int) date('H', strtotime($busresult['departureTime']))) >= 6) && ((int) date('H', strtotime($busresult['departureTime']))) < 12) 
                    {
                        echo 'time_2';
                        $time_2++; 
                    }
                    else if((((int) date('H', strtotime($busresult['departureTime']))) >= 12) && ((int) date('H', strtotime($busresult['departureTime']))) < 18)
                    {
                        echo 'time_3'; 
                        $time_3++; 
                    }
                    else if((((int) date('H', strtotime($busresult['departureTime']))) >= 18) && ((int) date('H', strtotime($busresult['departureTime']))) < 24) 
                    {
                        echo 'time_4';  
                        $time_4++; 
                    }?> <?php 
                    if((((int) date('H', strtotime($busresult['arrivalTime']))) >= 0) && ((int) date('H', strtotime($busresult['arrivalTime']))) < 6)               {
                        echo 'time_5';
                        $time_5++; 
                    }
                    else if((((int) date('H', strtotime($busresult['arrivalTime']))) >= 6) && ((int) date('H', strtotime($busresult['arrivalTime']))) < 12) 
                    {
                        echo 'time_6';
                        $time_6++;  
                    }
                    else if((((int) date('H', strtotime($busresult['arrivalTime']))) >= 12) && ((int) date('H', strtotime($busresult['arrivalTime']))) < 18) 
                    {
                        echo 'time_7';
                        $time_7++;  
                    }
                    else if((((int) date('H', strtotime($busresult['arrivalTime']))) >= 18) && ((int) date('H', strtotime($busresult['arrivalTime']))) < 24) {
                        echo 'time_8'; 
                        $time_8++; 
                    }?> <?php if (strpos($busresult['busType'], 'Sleeper') !== false) { echo 'time_sleeper'; $sleeper++; } if (strpos($busresult['busType'], 'Seater') !== false) { echo 'time_seater'; $seater++; } ?> <?php if (strpos($busresult['busType'], 'A/C') !== false) { echo 'time_ac'; $ac++; } if (strpos($busresult['busType'], 'Non A/C') !== false) { echo 'time_nonac'; $non_ac++; }?>">
                        <div class="clearfix bus-item">
                           <div class="clearfix bus-item-details">
                              <div class="clearfix row-one">
                                 <div class="column-two p-right-10 w-40 fl">
                                    <div class="travels lh-24 f-bold d-color"><?php echo $busresult['operatorName'];?></div>
                                    <div class="bus-type m-top-16 l-color"><?php echo $busresult['busType'];?></div>
                                 </div>
                                 <div class="column-three p-right-10 w-10 fl timedur">
                                    <div class="dp-time f-14 d-color f-bold"><?php echo $departureTime;?></div>
                                    <!--<div class="dp-loc m-top-16 l-color w-wrap f-12" title="Koyambedu">Koyambedu</div>-->
                                 </div>
                                 <div class="column-four p-right-10 w-10 fl timedur">
                                    <div class="dur l-color lh-24"><?php echo $duration .' hrs';?></div>
                                    <!--<div class="rsStop m-top-16 l-color w-wrap f-12"><span class="icon-reststop"></span><span> 1</span> <span> Rest Stop</span> </div>-->
                                 </div>
                                 <div class="column-five p-right-10 w-10 fl timedur">
                                    <div class="bp-time f-14 d-color f-bold"><?php echo $arraivalTime;?></div>
                                    <!--<div class="bp-loc m-top-16 l-color w-wrap f-12" title="Trichy">Trichy</div>-->
                                 </div>
                                 <!--<div class="column-six p-right-10 w-10 fl">
                                    <div class="rating-sec lh-24">
                                       <div class="lh-18 rating rat-green">4.7</div>
                                    </div>
                                    <div class="no-ppl m-top-10 l-color"><i class="icon d-block icon-rating_ppl"></i>721</div>
                                 </div>-->
                                 <div class="column-seven p-right-10 w-15 fl">
                                    <div class="seat-fare">
                                    <?php if(isset($fare[1])) { ?><div class="starts">Starts from </div>
                                       <div class="fare d-block">INR <span class="f-14 f-bold"><?php echo $fare[1];?></span></div>
                                       <?php } else { ?>
                                       <div class="fare d-block">INR <span class="f-14 f-bold"><?php echo $fare[0];?></span></div>
                                       <?php } ?> 
                                    </div>
                                 </div>
                                 <div class="column-eight w-15 fl">

                                    <div class="seat-left"><?php echo $busresult['availableSeats'];?><span class="l-color"> Seats available</span></div>
                                    <!--<div class="window-left m-top-16">13 <span class="l-color"> Window</span></div>-->
                                 </div>
                              </div>
                              <!--<div class="clearfix row-two m-top-10 ">
                                 <div class="amenities-icon fl">
                                       <ul>
                                          <li class="d-block" title="WIFI"><i class="icon icon-am_1 d-block"></i></li>
                                          <li class="d-block" title="Water Bottle"><i class="icon icon-am_4 d-block"></i></li>
                                          <li class="d-block" title="Blankets"><i class="icon icon-am_5 d-block"></i></li>
                                          <li class="d-block" title="Charging Point"><i class="icon icon-am_7 d-block"></i></li>
                                       </ul>
                                  </div>
                                 <div class="hero-feature fl clearfix"><span class="txt-block"><i class="icon icon-addfil_0 fl icon-addfil_2"></i><span class="d-color">Live Tracking</span></span></div>
                              </div>-->
                           </div>
                           <div class="clearfix m-top-16 viewseateer">
                              <a href="javascript:void(0);" class="btnab book1" <?php if($busresult['availableSeats']!=0) { ?>onclick="showSeatLayout('<?php echo $busresult['routeScheduleId']; ?>','<?php echo $fromStation; ?>','<?php echo $toStation; ?>','<?php echo date('Y-m-d',strtotime($journey_date)); ?>',' ','<?php echo $busresult['inventoryType'];?>');" <?php } ?>><?php if($busresult['availableSeats']==0) { ?><div class="button view-seats fr">Sold Out</div><?php } else { ?><div class="button view-seats fr">View Seats</div><?php } ?></a>
                              <div>
                                 <ul class="fr bottom-panel d-color   ">
                                    <!--<li class="amenties b-p-list"><span class="txt-val ">Amenities</span></li>-->
                                    <li class="amenties b-p-list"><span class="txt-val boardings">Boarding &amp; Dropping Points</span></li>
                                    <!--<li class="amenties b-p-list"><span class="txt-val ">Reviews</span></li>-->
                                    <li class="amenties b-p-list"><span class="txt-val policies">Cancellation Policy</span></li>
                                 </ul>
                                 <div class="clearfix"></div>
                                 <div class="panels-container boards">
                                    <div class="clearfix">
                                        <div class="fl w-50">
                                            <h4>Boarding Point</h4>
                                            <ul class="bpdplist clearfix">
                                            <?php foreach($boardingPoints as $boarding) 
                                                  { 
                                            ?>
                                               <li><span class="time"><?php echo $boarding['time'];?></span><span class="loc"><?php echo $boarding['location'];?></span></li>
                                            <?php }?>
                                            </ul>
                                        </div>
                                        <div class="fl w-50">
                                            <h4>Dropping Point</h4>
                                            <ul class="bpdplist clearfix">
                                            <?php foreach($droppingPoints as $dropping) 
                                                  { 
                                            ?>
                                               <li><span class="time"><?php echo $dropping['time'];?></span><span class="loc"><?php echo $dropping['location'];?></span></li>
                                            <?php }?>
                                            </ul>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="panels-container can-pol">
                                    <div class="clearfix">
                                        <div class="cancel-wrapper">
                                            <div class="clearfix row main-row">
                                               <div class="fl row-list first-col"><span>Cut off time</span></div>
                                               <div class="fl row-list secd-col"><span>Refund Percentage</span></div>
                                            </div>
                                            <div class="cancel-panel-container cancel-wrapper">
                                            <?php foreach($cancellation as $cancel) { ?>
                                                <div class="clearfix row">
                                                    <div>
                                                        <div class="fl row-list first-col"><span>Before <?php echo $cancel['cutoffTime'];?> hours</span></div>
                                                        <div class="fl row-list secd-col"><span><?php echo $cancel['refundInPercentage'];?> %</span></div>
                                                    </div>
                                                </div>
                                            <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <div class="seat-container-wrapper seatSelect_<?php echo $busresult['routeScheduleId']; ?>" id="seatSelect_<?php echo $busresult['routeScheduleId']; ?>">
                        </div>
                        
                    </li>
                <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="hide" id="page_overlay"></div>
    <div class="custinfo slidein main_result" data-view="custinfoView" style="display:none;">

    </div>
    
<?php   include_once "includes/footer.php";?>

<script type="text/javascript" src="js/typeahead.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
    $.ajax({
        data:{action: 'clear_passengerListSession'},
        url:"ajaxfunction.php",
        type:"POST",
        success:function(e){
          console.log(e);
        },
        error:function(e){
          alert(e);
        }
      });
    $('#time_1').html('<?php echo $time_1; ?>');
    $('#time_2').html('<?php echo $time_2; ?>');
    $('#time_3').html('<?php echo $time_3; ?>');
    $('#time_4').html('<?php echo $time_4; ?>');
    $('#time_5').html('<?php echo $time_5; ?>');
    $('#time_6').html('<?php echo $time_6; ?>');
    $('#time_7').html('<?php echo $time_7; ?>');
    $('#time_8').html('<?php echo $time_8; ?>');
    $('#seater').html('<?php echo $seater; ?>');
    $('#sleeper').html('<?php echo $sleeper; ?>');
    $('#ac').html('<?php echo $ac; ?>');
    $('#non_ac').html('<?php echo $non_ac; ?>');
});
function filter()
{
    $('.bus_filt').hide();
    var checked = [];
    $("input[name='depart[]']:checked").each(function () { checked.push($(this).val()); });
    $("input[name='arrival[]']:checked").each(function () { checked.push($(this).val()); });
    $("input[name='bustype[]']:checked").each(function () { checked.push($(this).val()); });
    if(checked.length>0)
    {
        for(i=0; i<checked.length; i++)
        {
            $('.time_'+checked[i]).show();  
        }
    }
    else
    {
        $('.bus_filt').show();
    }
}
var oldSelect=0;      
var tempId = '';
var loadFItems = 0;
function showSeatLayout(id,id2,id3,jdate, concession,inventoryType)
{
        $('.bus-items>li').removeClass('fix active');
    $('#'+id).addClass('fix active');
    
    if(oldSelect!=0)
    {
        $(".topseatSelect_"+oldSelect+"").hide('slow');
        $(".seatSelect_"+oldSelect+"").html('');
    }
    oldSelect=id;
    var brdnm = "result_"+id;
    if($("#"+brdnm+" #txtBrd"))
    $("#"+brdnm+" #txtBrd").hide();
    if($("#"+brdnm+" #txtDrp"))
    $("#"+brdnm+" #txtDrp").hide();
    if(id != null){
    $("#POPBoxFood").html('');
    loadFItems = 0;
    // if($('.seatSelect')){
    // $('.seatSelect').each(function(){$(this).remove();});
    //}
    if($(".topseatSelect_"+id+""))
    {
        $(".topseatSelect_"+id+"").show('slow');
    }
    $("#seatSelect_"+id).html("<div class='panel-load-con'><div class='panel-loader'></div></div>").show();
    // fare=fare.replace(/,/g,'');  
    $.ajax({
    type: "POST",
    url: "seatlayout.php",
    data: "rid="+id+"&sourceid="+id2+"&destination="+id3+"&jdate="+jdate+"&inventoryType="+inventoryType,
    success:function(result)
    {

        if($(".seatSelect_"+id+""))
        {
            $(".seatSelect_"+id+"").html(result).show();
            
        }
    },error:function(err){
        console.log('err '+JSON.stringify(err,nul,4))
    }
    });
    }
    return false;
}
function boarding(val)
{
    var board=document.getElementById("boardingpoint_id").value;
    if(board=='')
    {
        $("#board_err").html("Please select boarding point");
        return false;
    }
    var drop=document.getElementById("droppingpoint_id").value;
    if(drop=='')
    {
        $("#drop_err").html("Please select dropping point");
        return false;
    }
}
function closethisDiv(thisdiv)
{
    $(thisdiv).closest('.seat-container-wrapper').hide();
    return false;
}
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
</script>
<script type="text/javascript">
$(document).ready(function (){
    $("#switchButton").on('click',function(){
        var pickup = $('#originid').val();
        $('#originid').val($('#destinationid').val());
        $('#destinationid').val(pickup);
    });

});


    $(document).ready(function(e) {
        $(".panels-container").hide();
        $(".seat-close").click(function(e) {
             $(this).parent('.panels-container').hide();
        });
         $(".boardings").click(function(e) {
            $(".panels-container.can-pol").hide();
             $(this).parent("li").parent("ul").siblings(".panels-container.boards").slideToggle();
        });
        $(".policies").click(function(e) {
            $(".panels-container.boards").hide();
             $(this).parent("li").parent("ul").siblings(".panels-container.can-pol").slideToggle();
        });
        $(".onward-modify-btn").click(function(e) {
              $(".modify-sec").hide();
              $(".search-wrapper").show();
        });
        $("#mod_cancel").click(function(e) {
              $(".search-wrapper").hide();
              $(".modify-sec").show();
        });
    });
    $(function() {
        $( ".datepickers" ).datepicker({
            minDate: 0,
            dateFormat: 'dd-mm-yy'
        });
        
    });
    
</script>
<script>
 $(document).ready(function(e) {
        close_sidebar();
    });
 function open_sidebar(){
  $('.sidebar').removeClass('close_now');
  $('.sidebar').addClass('open');
 }
 function close_sidebar(){
  $('.sidebar').removeClass('open');
  $('.sidebar').addClass('close_now');
 }
</script>