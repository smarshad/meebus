<?php
include '../../server/server.php'; 
include_once '../../agent/includes/functions.php';
$obj=new agent_module($con);  
ini_set('display_errors', 0);
if(isset($_SESSION['common']['url']) && $_SESSION['common']['url']!='' && isset($_SESSION['agent']['log']['id']) && $_SESSION['agent']['log']['id']!='') {}else { header('location:../logout.php');}
//echo "<pre>";  print_r($_SESSION);  exit;  echo "<pre/>"; exit;
unset($_SESSION['agent']['bus']['seat']);
$_SESSION['agent']['bus']['netfare']=0;
$_SESSION['agent']['bus']['service_charge']=0;
$_SESSION['agent']['bus']['serviceChargeValues']=0;
$_SESSION['agent']['bus']['agent_markup']=0;
$_SESSION['agent']['bus']['commission']=0;
$userlogSessionId = $sesid = session_id();
?>
<style type="text/css">
.seatWrap {
    background: url("images/bus.png") no-repeat scroll left top transparent;
    height: 180px;
    position: relative;
    width: 371px;
	float:left;
	height:auto;
	margin-top: 0;
}
.seatWrap input[type="checkbox"] {
    display: none;
}
/*#selection {
    width: 600px;
    float: left;
}*/
#selection p {
    width: 300px;
    float: left;
    text-align: right;
    margin: 0px;
    padding: 6px 0px;
}
.journey {
    color: #F00;
}
.view_seats {
    background: none repeat scroll 0% 0% #F65284;
    padding: 7px 10px;
    color: #FFF;
    font-size: 12px;
    border-radius: 2px;
    border: 0px none;
    font-weight: bold;
    cursor: pointer;
	display: inherit;
	margin: 0px auto;
	text-transform: uppercase;
}
.seatWrap input[type="checkbox"] + label { border: 1px solid #d3d3d3; height:25px; width:50px; background:url(images/seat4.png) no-repeat; font-weight: normal; color: #555555;  border:0;  }
.pop-right{width:60%; float: right;}
.details select{width:130px;}
.details input,.details textarea,.details .uneditable-input {
    width: 190px;
	margin-right:10px;
}
.mob-mail input{width:200px; margin-right:10px}
</style>

<div class="pop-up cf">

<?php
$id=$_POST['id'];
$id=explode('_', $id);
$scheduleId=$id[0];
$serviceId=$id[1];
$otherdatas = explode('^',str_replace("*","&",$_REQUEST['otherdata']));
$log=$_POST['id'].'^'.$_REQUEST['otherdata'];

include ( "xmlrpc.php" );
$query_info['partnerid'] = 1;
require_once("api.php");
/*unset($_SESSION['busraja']['agent']['abhibus']['scheduleId']);
unset($_SESSION['busraja']['agent']['abhibus']['jdate']);
unset($_SESSION['busraja']['agent']['abhibus']['destinationid']);
unset($_SESSION['busraja']['agent']['abhibus']['sourceid']);*/
$_SESSION['busraja']['agent']['abhibus']['serviceid']=$serviceId;
$_SESSION['busraja']['agent']['abhibus']['sourceid'];
$_SESSION['busraja']['agent']['abhibus']['destinationid'];
$_SESSION['busraja']['agent']['abhibus']['jdate'];
$_SESSION['busraja']['agent']['abhibus']['scheduleId']=$scheduleId;
$query_info1['traveler_id']  = $_SESSION['busraja']['agent']['abhibus']['scheduleId'];
$query_info1['jdate']  = $jdate=$_SESSION['busraja']['agent']['abhibus']['jdate'];
$query_info1['sourceid']  =$_SESSION['busraja']['agent']['abhibus']['sourceid'];
$query_info1['destinationid'] =$_SESSION['busraja']['agent']['abhibus']['destinationid'];
$query_info1['serviceid'] =$_SESSION['busraja']['agent']['abhibus']['serviceid'];
$query_info1['seat_sleeper'] =0;
list($success1, $response1) = XMLRPC_request(
	$site,
	$location,
	'index.busseating',
	array(XMLRPC_prepare($query_info1),
	'HarryFsXMLRPCClient')
);
//echo "<pre>"; print_r($response1); echo "</pre>"; exit;
echo '<img src="../../images/close-x.png" alt="close" title="" style="z-index:100;right:0px;top:0px;width:25px;height:25px;position:absolute;cursor:pointer;" class="closeIcon" />';
unset($adpointRtime1);
unset($abpointsPlace);
unset($abpointsId);
unset($abusArrivalTime);
unset($abusArrivalLocatoin);
unset($abusArrivalTrv_ph);
unset($abusArrivalTime1);
unset($atmp_bpoints);
unset($acount1);

   if ($success1) {  $count1 = 0;
   $_SESSION['busRaja']['SeatLayout']=$response1;
        while ( list ( $key1, $val1 ) = each ( $response1 ) ) { 
            $k=0;
			?>
            <div style="width:100%; height:auto !important; float:left; font-size:14px; color:#000; font-weight:bold;">
    <?php if(isset($otherdatas[5]))echo $otherdatas[5]; ?> &nbsp; &nbsp; Bus Name : <?php echo substr($otherdatas[0],0,50); ?> &nbsp; &nbsp; 
    Bus Type : <?php if(isset($otherdatas[1]))echo $otherdatas[1]; ?> &nbsp; &nbsp;<br/>Depart : <?php if(isset($otherdatas[2]))echo $otherdatas[2]; ?> &nbsp; &nbsp;  Arrival : <?php if(isset($otherdatas[3]))echo $otherdatas[3]; ?> &nbsp; &nbsp; Available Seat : <?php if(isset($otherdatas[4]))echo $otherdatas[4]; ?></div>

            <?php
	  echo "<div class='pop-left'><div class='seatWrap'>";
	  echo "<div id='format".$count."'>";
          $new_booked = '';
            for($ll=0; $ll < count($response1[$count1]['bookedseats']); $ll++){
                $arr_booked1[$ll] = explode("#*#",$response1[$count1]['bookedseats'][$ll]);
                $tmp_arr[$ll] = explode('-',$arr_booked1[$ll][1]);
                $new_booked[$ll][0] = $arr_booked1[$ll][0];
                $new_booked[$ll][1] = $tmp_arr[$ll][0];
                $new_booked[$ll][2] = $tmp_arr[$ll][1];
            }

	  if($response1[$count1]['serv_layout_type'] == 'S' || count($response1[$count1]['upperdeck_seat_nos'])<=1) {
	  
	   	echo "<form name='continue".$count."' id='continue".$count."' method='POST' action='customer_information.php' onsubmit='return validateForm".$count."()' >";
		
		?>

		<script type="text/javascript">
		
		  function validateForm<?php echo $count;?>()
{
var x=document.forms["continue<?php echo $count;?>"]["bpoint"].value;
var y=$('form input[type=checkbox]:checked').size();
if (y==null || y=="")
  {
  alert("Please select atleast one seat");
  return false;
  }

if (x==null || x=="")
  {
  alert("Please select Boarding Point");
  return false;
  }
  
 
  
} </script>
	<?php 
		
		
            echo "<table width='100%' align='right' border='0' style='padding:30px';>";

                $k=0;
                
              
                for($i=1; $i <= $response1[$count1]['tot_rows']; $i++){
                    echo "<tr >";
					echo "</tr>";
					
                    for($j=1; $j <= $response1[$count1]['tot_cols'];$j++){
                       
                       $arr_gender = explode("#*#",$response1[$count1]['lowerdeck_seat_nos'][$k]);

                        $arr = explode(" ",$response1[$count1]['seat_nos'][$k]);

                        if($arr[0] == ''){ $k++; echo "<td>&nbsp;</td>"; continue;}

                        $row_cal = explode('-',$arr[2]);

                        if($row_cal[1] != $j){ echo "<td>&nbsp;</td>"; continue;}
                        if($row_cal[0] == $i && $row_cal[1] == $j) {
                          
                            if(trim($arr_gender[3]) == 'B'){
                                if(trim($arr_gender[4]) == 'M'){
                                    echo  "<td><img width='22' height='19' src='images/booked_seat_img.gif' id='".$arr[0]."'>";
                                    echo "</td>";
                                }else if(trim($arr_gender[4]) == "F"){
                                    echo  "<td><img width='22' height='19' src='images/ladies_seat_img.gif' id='".$arr[0]."'>";
                                    echo "</td>";
                                }
                            }else{
                                 echo  "<td><input type='checkbox' name='Seat_".$count.$i.$j."' id='check".$count.$i.$j."' class='checkbox".$count."' value='".$arr[0]."' onClick='seat_checkabhi(&apos;".$seatdata[0]."&apos;)'>";
                                echo "<label for=check".$count.$i.$j."></label>";
                                echo "</td>";
                            }
                           
}else{ echo "<td>NA</td>"; }

 $k++;} echo "</tr>";}
                echo "</table>";
				}            
	   	if($response1[$count1]['serv_layout_type'] == 'B' || count($response1[$count1]['upperdeck_seat_nos'])>1) {
		echo "<form name='continue".$count."' id='continue".$count."' method='POST' action='customer_information.php' onsubmit='return validateForm".$count."()'> ";
		?>	<script type="text/javascript">
		
		  function validateForm<?php echo $count;?>()
{
var x=document.forms["continue<?php echo $count;?>"]["bpoint"].value;
var y=$('form input[type=checkbox]:checked').size();
if (y==null || y=="")
  {
  alert("Please select atleast one seat");
  return false;
  }
if (x==null || x=="")
  {
  alert("Please select Boarding Point");
  return false;
  }
  } </script><?php 
		
				echo '<table id="sleeper"  width="70%" align="right" border="0" style="padding:30px";>';
			$k=0;
			for($i = 1 ; $i <= $response1[$count1]['tot_rows'] ; $i++) {
					
						echo "<tr>";
					
					for($j = 1 ; $j <= $response1[$count1]['tot_cols'] ; $j=$j+2) {	
						 if($response1[$count1]['div_row'] == $i) {

                                                                    echo '<td height="30" colspan="'.($response1[$count1]['tot_cols']/2).'" style=" text-align:right">LOWER</td>';

                                                            break;
                                                    } else {
                                                        foreach($response1[$count1]['lowerdeck_seat_nos'] as $seatdata) {
                                                                $seatdata = explode('#*#',$seatdata);
                                                                $spos = $i.'-'.$j;

                                                                if(trim($seatdata[1]) == $spos && trim($seatdata[0]) != '') {
                                                                    if(trim($seatdata[3]) == 'B'){
                                                                        if(trim($seatdata[4]) == 'M'){
                                                                           echo  "<td><img src='images/seat1.png' id='".$seatdata[0]."'>";
                                                                           echo "</td>";
                                                                        }else if(trim($seatdata[4]) == "F"){
                                                                           echo  "<td><img src='images/seat2.png' id='".$seatdata[0]."'>";
                                                                           echo "</td>";
                                                                        }
                                                                    }else{
                                                                        echo "<td height='30'>
                                                                <input type='checkbox' name='Seat_".$count.$i.$j."' id='check".$count.$i.$j."' class='checkbox".$count."' value='".$seatdata[0]."' onClick='seat_checkabhi(&apos;".$seatdata[0]."&apos;)'>";
 echo "<label for=check".$count.$i.$j."></label>";echo "</td>";
                                                                    }
                                                                }

                                                        }

                                                    }


                                        }echo '</tr>';
							
			}
			
			echo '</table>';
			  echo "<div class='seatWrap' style='padding-top: 15px;'>";
			  
			echo '<table id="sleeper" width="70%" align="right" border="0" style="padding:30px";>';
			
			for($m = 1 ; $m <= $response1[$count1]['upper_tot_rows'] ; $m++) {

					
						echo '<tr>';
					
					for($l = 1 ; $l <= $response1[$count1]['upper_tot_cols'] ; $l=$l+2) {	
                                              if($response1[$count1]['upper_div_row'] == $m) {

     echo '<td height="40" colspan="'.($response1[$count1]['upper_tot_cols']/2).'" style=" text-align:right">UPPER</td>';

                                                            break;
                                                     }else {
                                                            foreach($response1[$count1]['upperdeck_seat_nos'] as $seatdata) {
                                                                    $seatdata = explode('#*#',$seatdata);
                                                                    $spos = $m.'-'.($l+$response1[$count1]['upper_tot_cols']);
                                                                    if(trim($seatdata[1]) == $spos && trim($seatdata[0]) != '') {
                                                                        if(trim($seatdata[3]) == 'B'){
                                                                           if(trim($seatdata[4]) == 'M'){
                                                                               echo  "<td><img src='images/seat1.png'>";
                                                                               echo "</td>";
                                                                           }else if(trim($seatdata[4]) == "F"){
                                                                               echo  "<td><img src='images/seat2.png'>";
                                                                               echo "</td>";
                                                                           }
                                                                        }else{

                                                                                   
                                                                           echo "<td height='30'><input type='checkbox' name='Seat_".$count.$m.$l.$m."' id='check".$count.$m.$l.$m."' class='checkbox".$count."' value='".$seatdata[0]."' onClick='seat_checkabhi(&apos;".$seatdata[0]."&apos;)'>";
                                                                           echo "<label for=check".$count.$m.$l.$m."></label>";echo "</td>";
                                                                        }

                                                                   }
                                                            }

                                                     }
                                    }
					
					echo '</tr>';
							
			}
			
			echo '</table>';
					
			echo '</div>';
			}
			echo "</div>";
			echo "<div id='clear'></div>"; 
			?>
            <table  border="0" cellpadding="3" cellspacing="3" width="400" >
  <tbody>
    
   <tr>
            <?php 
           // if($response[$count]["seat_type"] == "0") 
		   {
       ?>
            <td align="center" valign="middle" width="53">Ladies :</td>
            <td align="left" valign="middle" width="22"><img src="images/ladies_seat_img.gif" height="19" width="22"></td>
            <td align="center" valign="middle" width="69">Available : </td>
            <td align="left" valign="middle" width="22"><img src="images/available_seat_img.gif" height="19" width="22"></td>
            <td align="center" valign="middle" width="70">Selected :</td>
            <td align="left" valign="middle" width="22"><img src="images/selected_seat_img.gif" height="19" width="22"></td>
            <td class="user" align="center" valign="middle" width="62">Booked :</td>
            <td align="left" valign="middle"><img src="images/booked_seat_img.gif" height="19" width="22"></td>
       <?php 
            }//else 
			if($response[$count]["seat_type"] == "1") {
       ?>
            <td align="center" valign="middle" width="53">Ladies :</td>
            <td align="left" valign="middle" width="22"><img src="images/seat2.png" height="19" width="22"></td>
            <td align="center" valign="middle" width="69">Available : </td>
            <td align="left" valign="middle" width="22"><img src="images/seat4.png" height="19" width="22"></td>
            <td align="center" valign="middle" width="70">Selected :</td>
            <td align="left" valign="middle" width="22"><img src="images/seat3.png" height="19" width="22"></td>
            <td class="user" align="center" valign="middle" width="62">Booked :</td>
            <td align="left" valign="middle"><img src="images/seat1.png" height="19" width="22"></td>
       <?php 
            }
       ?>
   </tr>
        
  </tbody>
</table>
            <?php 
			echo "</div></div><div class='pop-right'><div id='selection'>";
			echo "<div id='passangerdet'></div>";
			?>
		<table border="0" cellpadding="0" cellspacing="2" class="mob-mail" width="75%">
            <tbody>
                <tr>
                    <td><input type='text' name='mobileno' placeholder='Enter Mobile Number' id='mobileno' /></td>
                    <td><input type='email' name='emailid' placeholder='Enter E-Mail ID' id='emailid' /></td>
                    <td><select style='margin-right:0px; width:162px; padding: 5px; width: 162px; border-radius:5px; border:1px #ccc solid;' name='bpoint'><option value=''>Select Boarding Points</option>
            <?php
                                            unset($aa);
                                            unset($boarding_pts);
                                            unset($bpoints);
                                            unset($tmp_bpoints);
                                            unset($boarding_ids);
                                            unset($boarding_names);
                                            
                                            $aa= $response1[$count1]['boardingpoints'];
                                            for($b=0; $b<count($aa); $b++)
                                            {     
                                                $aa[$b];
                                                 $boarding_pts = explode('~',$response1[$count1]['boardingpoints'][$b]);
                                                $boarding_time = explode('!',$response1[$count1]['boardingpoints'][$b]);
            
                                                $bpoints = explode('^^', $boarding_pts[1]);
            
                                                $tmp_bpoints[$boarding_pts[0]] = $bpoints[0]." - ".$boarding_time[1];
                                                $boarding_ids = array_keys($tmp_bpoints);
                                                $boarding_names = array_values($tmp_bpoints);
            
                            }
                                            for($bp=0; $bp < count($boarding_ids);$bp++)
                                            {
                                                echo "<option value='".$boarding_ids[$bp]."".$boarding_names[$bp]."'>"; echo $boarding_names[$bp]."</option>"; 
                                            }
                                            ?></select></td>
                </tr>
            </tbody>
        </table>
<div class="cf" style="display:none;">
	<input type="radio" value="ebs" checked="checked" /> <span>Payment</span>
</div>
<div class="cf"></div>
				 <input type='button' name='submit' value='Continue' class='view_seats mob-mails' onclick='return validateabhi();'>
                 <?php	
			unset($new_booked);	
            $count1++;
        }
        echo ( "</tr>");
        echo ( "</td>");
        echo ( "</table>\n" );
		echo ("</form>");
?> 
        <div id="clear"> &nbsp;</div>

<table  border="0" cellpadding="3" cellspacing="3" width="500" >
  <tbody>
    
   <tr>
            <?php 
            if($response[$count]['seat_type'] == '0') {
       ?>
            <td align="center" valign="middle" width="53">Ladies :</td>
            <td align="left" valign="middle" width="22"><img src="images/ladies_seat_img.gif" height="19" width="22"></td>
            <td align="center" valign="middle" width="69">Available : </td>
            <td align="left" valign="middle" width="22"><img src="images/available_seat_img.gif" height="19" width="22"></td>
            <td align="center" valign="middle" width="70">Selected :</td>
            <td align="left" valign="middle" width="22"><img src="images/selected_seat_img.gif" height="19" width="22"></td>
            <td class="user" align="center" valign="middle" width="62">Booked :</td>
            <td align="left" valign="middle"><img src="images/booked_seat_img.gif" height="19" width="22"></td>
       <?php 
            }else if($response[$count]['seat_type'] == '1') {
       ?>
            <td align="center" valign="middle" width="53">Ladies :</td>
            <td align="left" valign="middle" width="22"><img src="images/seat2.png" height="19" width="22"></td>
            <td align="center" valign="middle" width="69">Available : </td>
            <td align="left" valign="middle" width="22"><img src="images/seat4.png" height="19" width="22"></td>
            <td align="center" valign="middle" width="70">Selected :</td>
            <td align="left" valign="middle" width="22"><img src="images/seat3.png" height="19" width="22"></td>
            <td class="user" align="center" valign="middle" width="62">Booked :</td>
            <td align="left" valign="middle"><img src="images/seat1.png" height="19" width="22"></td>
       <?php 
            }
       ?>
   </tr>
        
  </tbody>
</table>
</div>
 </li> <div id="clear"> </div><?php

     } else {
         echo ( "<p>Error: " . nl2br ( $response['faultString'] ) );
     }
     
?>
</div>
<div class="pop-right">
   <div id="passangerdet">
      
   </div>
</div>
<script>
 $(document).ready(function(){ 
		   $(".closeIcon").click(function(){
				$('#seat').hide();
				$('#seat_block').hide();
				$("#seat").html("");
			});
	    });
function seat_checkabhi(val)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
	  xmlhttp=new XMLHttpRequest();
	}
	else
	{
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	  {
	  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var arr=xmlhttp.responseText;
			document.getElementById("passangerdet").innerHTML=arr;
		}
	  }
	xmlhttp.open("GET","abhiSeat-fare.php?seat="+val,true);
	xmlhttp.send();
}
</script>