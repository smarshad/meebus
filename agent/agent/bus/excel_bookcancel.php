<?php  
include_once'../../server/server.php';   
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php'); }
include '../includes/functions.php';
$obj=new agent_module($con);
$_SESSION['common']['pagename'] = "Summary Report";
$agent_id=$_SESSION['agent']['log']['id'];
$tdate = explode('/', $_GET['from']);
$from = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];
$tdate = explode('/', $_GET['to']);
$to = $tdate[2] . '-' . $tdate[1] . '-' . $tdate[0];
$report=$obj->busBookingReport_basedDate($agent_id,$from,$to);

$file="Summary_Excel_Report_".date('d_m_Y_h_i_s_A',time()).".xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");

?>
<h5> Booking</h5>

<table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered tablescrool" id="bookingReport">
    <thead>
        <tr>
            <th width="9%">DOB</th>
            <th width="8%">Tin</th>
            <th width="19%">Passenger Name</th>
            <th width="9%">DOJ</th>
            <th width="11%">Travels</th>
            <th width="9%">Seats</th>
            <th width="10%">Route</th>
            <th width="11%">Fare</th>
            <th width="14%">Commission</th>
        </tr>
    </thead>                                        
    <tbody>
   <?php
   $total_fare_Sum=0; $agent_Comm=0; $agent_Comm_Sum=0;
   foreach($report as $rep)
   {
   ?>
   <tr class="gradeX odd">
        <td class="  sorting_1"><?php echo date('d/m/Y', strtotime($rep['booked_on']));?></td>
        <td class=" "><?php echo $rep['tiket_no'];?></td>
            <td class=" ">
            <?php echo $rep['lead_pax_name'];?>
            </td>
            <td class="center "><?php echo $rep['travelDate'];?></td>
            <td class="center "><?php $travels=explode('|A|',$rep['bus_provider']);  echo $travels[0];?></td>
            <td class="center "><?php 
            $cancelSeat=explode('^',$rep['cancel_data']); 
            $seat=explode('|A|',$rep['passenger_seat']); 
            if(isset($cancelSeat[0]) && $cancelSeat[0]!='')
            foreach($cancelSeat as $cs)
            {
                $s=array_search($cs,$seat);
                unset($seat[$s]);
                
            }
            
            echo implode(',',$seat); ?></td>
            <td class="center "><?php echo $rep['fromStationName'].' to '.$rep['toStationName'];?></td>
            <td class="center ">
            <?php 
            $total_fare=0;
                $passenger_fare=explode('^',$rep['passenger_fare']); 
                foreach($seat as $s)
                {
                    $fareArray[$s]=$passenger_fare[$i];
                    $i++;
                }
                $i=0;
                foreach($cancelSeat as $c )
                {
                    if(isset($fareArray[$c]))
                    {
                    }
                    else
                    $total_fare+=$passenger_fare[$i];
                }
                $net_Total_fare = $net_Total_fare+$total_fare;
                echo $total_fare;
                $total_fare_Sum = $total_fare_Sum+$total_fare;
            ?>
            </td>
            <td class="center "><?php echo $agent_Comm = $rep['agent_comm']; $agent_Comm_Sum = $agent_Comm_Sum+$agent_Comm; ?></td>
            <!--<td class="center ">594.66</td>-->
        </tr> <?php } ?>
   <tr class="gradeX odd">
     <td colspan="7" class="  sorting_1" style="text-align:right !important;"><strong>Total</strong></td>
     <td class="center "><?php echo round($total_fare_Sum); ?></td>
     <td class="center "><?php echo round($agent_Comm_Sum); ?></td>
     </tr>
       
    </tbody>
</table>

 <h5> Cancellation</h5>

<table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered tablescrool" id="cancelReport">
    <thead>
   
        <tr>
            <th>DOC</th>
            <th>Tin</th>
            <th>Passenger Name</th>
            <th>DOJ</th>
            <th>Travels</th>
            <th>Seats</th>
            <th>Route</th>
            <th>Fare</th>
            <th>Comm</th>
            <th>Cancel Charges</th>
            <th>Refund</th>
            <th>Date Of Cancel</th>
            <!--<th>Partner <span style="color:#FFF;">-</span>ST</th>-->
                                                          
</tr>
    </thead>                                        
    <tbody>
    <?php  $report1=$obj->busCancelingReport($agent_id); 
    $totalsum_fare=0;
    $total_sumcommision=0;
    $cancel_amountt=0;
    $RefundAmountt=0;
   foreach($report1 as $rep)
   {
   ?>
   <tr class="gradeX odd">
        <td class="  sorting_1"><?php echo date('d/m/Y', strtotime($rep['booked_on']));?></td>
        <td class=" "><?php echo $rep['tiket_no'];?></td>
            <td class=" ">
            <?php echo $rep['lead_pax_name'];?>
            </td>
            <td class="center "><?php echo $rep['travelDate'];?></td>
            <td class="center "><?php $travels=explode('|A|',$rep['bus_provider']); echo $travels[0];?></td>
            <td class="center "><?php 
            $cancelSeat=explode('^',$rep['cancel_data']); 
            /*$seat=explode('|A|',$rep['passenger_seat']); 
            foreach($cancelSeat as $cs)
            {
                $s=array_search($cs,$seat);
                unset($seat[$s]);
                
            }
            print_r($seat);*/
            echo implode(',',$cancelSeat); ?></td>
            <td class="center "><?php echo $rep['fromStationName'].' to '.$rep['toStationName'];?></td>
            <td class="center "><?php
            $seat=explode('|A|',$rep['passenger_seat']); 
            $passenger_fare=explode('^',$rep['passenger_fare']); 
            $i=0;
            foreach($seat as $s)
            {
                $fareArray[$s]=$passenger_fare[$i];
                $i++;
            }
            $total_fare=0;
            foreach($cancelSeat as $c )
            {
                $total_fare+=$fareArray[$c];
            }
            //print_r($fareArray);
             echo $total_fare;
             $totalsum_fare=$totalsum_fare+$total_fare;
             ?></td>
            <td class="center "><?php 
            $commBySeat=explode('|A|',$rep['commBySeat']); 
            $i=0;
            foreach($seat as $s)
            {
                $commBySeatArray[$s]=$commBySeat[$i];
                $i++;
            }
            $total_commision=0;
            foreach($cancelSeat as $c )
            {
                $total_commision+=$commBySeatArray[$c];
            }
            echo $total_commision;
            $total_sumcommision=$total_sumcommision+$total_commision;?></td>
            <td class="center "><?php echo $rep['cancel_amount'];?></td>
            <?php $cancel_amountt=$cancel_amountt+$rep['cancel_amount']; ?>
            <td class="center "><?php echo $rep['RefundAmount'];?></td>
            <?php $RefundAmountt=$RefundAmountt+$rep['RefundAmount']; ?>
            <td class="center "><?php echo $rep['cancel_date'];?></td>
            <!--<td class="center ">594.66</td>-->
        </tr>
         <?php } ?>
   <tr class="gradeX odd">
     <td colspan="7" class="  sorting_1" style="text-align:right !important;"><strong>Total</strong></td>
     <td class="center "><?php echo round($totalsum_fare); ?></td>
     <td class="center "><?php echo round($total_sumcommision); ?></td>
     <td class="center "><?php echo round($cancel_amountt); ?></td>
     <td class="center "><?php echo round($RefundAmountt); ?></td>
     <td class="center ">&nbsp;</td>
   </tr>   
    </tbody>
</table>