<?php
ini_set('display_errors',0);
@session_start();
?>
<script>
$(function(){
	$('.avail').click(function(){
		$r=$splt=$(this).find('img').attr('rel').split('|A|');//alert("Seatname"+$r);
		$r=$r[0];
		$(this).find('img').toggle();
		$c=$('#seatName').val();
		v=$c.split('|A|');
		if($.inArray($r,v)!=-1){
		$.each(v,function(i,v){
			if(v==$r)
			$len=i;
		});
		//alert('inArray');
		$costprice=(parseInt($('#costprice').val())-parseInt($splt[1]));
		$netprice=(parseInt($('#netprice').val())-parseInt($splt[2]));
		$totalprice=(parseInt($('#totalprice').val())-parseInt($splt[3]));
		v.splice($len,1);
		$v=v.join('|A|');
		$('#seatName').val($v);
		$('#costprice').val($costprice);
		$('#netprice').val($netprice);
		$('#totalprice').val($totalprice);
		}
		else {
		v[v.length]=$r;
		$v=v.join('|A|');
		//alert('else');
		$costprice=parseInt($splt[1])+parseInt($('#costprice').val());
		$netprice=parseInt($splt[2])+parseInt($('#netprice').val());
		$totalprice=parseInt($splt[3])+parseInt($('#totalprice').val());
		$('#seatName').val($v);
		$('#costprice').val($costprice);
		$('#netprice').val($netprice);
		$('#totalprice').val($totalprice);
		}
		$("#seat").html('');
		$("#price").html('');
		$.each(v,function(i,v){
		if(v!='')
  		{
			$("#seat").append("<font color='red' size='1'>"+v+","+"</font>");
  			$("#price").html($totalprice);
		}
		});
	});
});
function validate(){
	$bpval=$('select[name=BoardingPointName]').val();
	$seat=$('#seat').html();
	if($bpval==''){
		alert('Please select boarding point');
		return false;
	}
	else if($seat==''){
		alert('Please select seat');
		return false;
	}
	else
		return true;
}
</script>
<style>.avail img{cursor:pointer;}
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
function objectToArray( $object )   {
	if( !is_object( $object ) && !is_array( $object ) )	{
		return $object;
	}
	if( is_object( $object ) )	{
		$object = get_object_vars( $object );
	}
	return array_map('objectToArray',$object);
}
function convertdate($travelDate)
{
	$tdate=explode('/',$travelDate);
	$tdate=$tdate[2].'-'.$tdate[1].'-'.$tdate[0];
	return $tdate;
}
		//calculation for markup: by VINEET START
			include '../include/xmlparser.php';
			$xml=xml2ary(file_get_contents('../admin/markup-commission.xml'));
			$markup=$xml['Markup_Commission']['Bus']['Markup'];
			function calculate_markup($cost_price=0){
				global $markup;
				if($markup['_a']['Cal']=='Rs'){
					$selling_price=round($cost_price+$markup['_v']);
					$markup_for_c=$markup['_v'];
				}
				else{
					$selling_price=round($cost_price*(1+$markup['_v']/100));
					$markup_for_c=$markup['_v'];
				}
				$price_arr=array('costprice'    => $cost_price,
								 'sellingprice' => $selling_price,
								 'markup'  => $markup_for_c,
								 );
				return $price_arr;
			}
		//calculation for markup: by VINEET END

	$bus_provider=mysql_escape_string($_POST['bus_provider']);
	$bus_type=mysql_escape_string($_POST['bus_type']);
	$scheduleId=mysql_escape_string($_POST['scheduleId']);
	$travelDate=mysql_escape_string($_POST['travelDate']);
	$fromStationId=mysql_escape_string($_POST['fromStationId']);
	$toStationId=mysql_escape_string($_POST['toStationId']);
	$tdate=convertdate($travelDate);
	$netprice=$_POST['netprice'];
	$selling_price=$_POST['selling_price'];

include 'layout-SoapClient.php';
if($error=='')
{
$result=objectToArray($results);
/*echo "<pre>";
print_r($result);
echo "</pre>";*/
$BParray=objectToArray($boardingpoint);
/*echo "<pre>";
print_r($BParray);
echo "</pre>";
exit;*/
$GetSeatLayoutResult=$result['GetSeatLayoutResult'];
$SeatLayoutSTR=$result['GetSeatLayoutResult']['SeatLayoutSTR']['SeatDetail']['SeatDetails'];
/*echo $SeatsAvailable=$result['GetSeatLayoutResult']['HtmlLayout'];
$SeatsAvailable=explode(',',$SeatsAvailable);*/

/*foreach($SeatLayoutSTR as $val){
	echo "<pre>";
	print_r($val);
	}*/
	foreach($SeatLayoutSTR as $k=>$val){
	$i=$val['RowNo'];
	$j=$val['ColumnNo'];
	$RowNo[$i]=$val['RowNo'];
	$ColumnNo[$j]=$val['ColumnNo'];
	$SeatName[$i][$j]=$val['SeatName'];
	$Width[$i][$j]=$val['Width'];
	$Height[$i][$j]=$val['Height'];
	$SeatStatus[$i][$j]=$val['SeatStatus'];
	$SeatFare[$i][$j]=calculate_markup($val['SeatFare']);
	$SeatType[$i][$j]=$val['SeatType'];
}
$li=max($RowNo);$lj=max($ColumnNo);


/*echo "<pre>";
print_r($GetSeatLayoutResult);
echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
print_r($SeatLayoutSTR);*/
?>
<div style="width:600px; height:100%; border:3px #e4e4e4 solid; border-radius:6px;margin:auto; background-color:#fbfbfb;">
<table width="595" height="auto" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td width="229" align="left" valign="top">&nbsp;</td>
    <td width="71" align="left" valign="top">&nbsp;</td>
    <td width="67" align="left" valign="top">&nbsp;</td>
    <td width="57" align="left" valign="top">&nbsp;</td>
    <td align="right" valign="top"><!--<img src="images/Close.png" width="21" height="21" /> --></td>
  </tr>
  <tr>
    <td width="26" align="left" valign="top">&nbsp;</td>
    <td colspan="4" align="left" valign="top" id="seat_set">Hint: click on seat to select/deselect</td>
    <td width="131" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td rowspan="5" align="left" valign="top">&nbsp;</td>
    <td colspan="3" rowspan="5" align="right" valign="top" style="background-color:#fff; height:auto; margin:10px; padding:0px;">
      <!--seat availablity table start -->
                <table border="0" width="100%" height="100%" class="input" align="center" cellpadding="0" cellspacing="5">
                <?php
				$flag=true;
                for($i=0;$i<=$li;$i++){
                    echo '<tr>';
                    for($j=0;$j<=$lj;$j++){
						$st=$SeatType[$i][$j];
						$SName=str_split($SeatName[$i][$j]);
						foreach($SName as $val){
							if($val=='L' || $st=='lb'){
								$img='<img src="images/lower.jpg" width="21" height="65" />';
								break;
							}
							else if($val=='U' || $st=='ub'){
								$img='<img src="images/upper.jpg" width="21" height="65" />';
								break;
							}
						}
						$wt=$Width[$i][$j];
						$ht=$Height[$i][$j];
						if($wt=='2' && $ht=='1')
						{
							$seat_type='Sleeper';
						}
						else if($wt=='1' && $ht=='2')
						{
							$seat_type='Sleeper2';
						}
						else
						{
							$seat_type='Seat';
						}
						if($flag)
						{
							echo '<td width="30" height="30" rowspan='.($li+1).' valign="top"><img src="images/steering.jpg" width="21" height="21" /><br>'.$img.'</td>';
							$flag=false;
						}
                        echo '<td width="30" height="30" align="center">';
                        if($SeatStatus[$i][$j]==1) echo '<div class="avail"><img src="images/'.$seat_type.'.jpg" rel="'.$SeatName[$i][$j].'|A|'.$SeatFare[$i][$j]['costprice'].'|A|0|A|'.$SeatFare[$i][$j]['sellingprice'].'"><img src="images/'.$seat_type.'-availed.jpg" style="display:none" rel=""></div>';
                        else if($SeatStatus[$i][$j]==0 && count($SeatName[$i][$j])!=0) echo '<img src="images/'.$seat_type.'-booked.jpg">';
                        echo '</td>';
                    }
                    echo '</tr>';
                }

                ?>
                </table>
                      <!--seat availablity table End -->
</td>
    <td align="right" valign="top"><img src="images/<?php echo $seat_type; ?>.jpg" /></span></td>
    <td align="left" valign="top" id="seat_set">Available seat</td>
  </tr>
  <tr>
    <td align="right" valign="top"><img  src="images/<?php echo $seat_type; ?>-ladies.jpg" /></span></td>
    <td align="left" valign="top" id="seat_set">Reserved for ladies</td>
  </tr>
  <tr>
    <td align="right" valign="top"><img src="images/<?php echo $seat_type; ?>-availed.jpg" /></span></td>
    <td align="left" valign="top" id="seat_set">Selected seat</td>
  </tr>
  <tr>
    <td align="right" valign="top"><img src="images/<?php echo $seat_type; ?>-booked.jpg" /></span></td>
    <td align="left" valign="top" id="seat_set">Booked seat</td>
  </tr>
  <tr>
    <td align="left" valign="top" id="seat_set">Seats: <br />Amounts: </td>
    <td align="left" valign="top"><table><tr><td id="seat"></td></tr><tr><td id="price"  style="font-size:11px; font-family:Arial, Helvetica, sans-serif; text-align:left; font-weight:bold; padding-left:5px; line-height:18px; color:#333;"></td></tr></table></td>
  </tr>
   <tr>
    <td width="26" align="left" valign="top">&nbsp;</td>
    <td colspan="4" align="left" valign="top" id="seat_set"></td>
    <td width="131" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</div>

<?php
$NoOfBPs=$BParray['GetBoardingPointsResult']['NoOfBPs'];
$BPDetails=$BParray['GetBoardingPointsResult']['BPDetails']['BPDetails'];
if($NoOfBPs==1)
{
	for($i =0; $i<$NoOfBPs;$i++)
	{
		$BPName[$i] = $BPDetails['BPName'];
		$BPTime[$i] = $BPDetails['BPTime'];
	}
}
else
{
	for($i =0; $i<$NoOfBPs;$i++)
	{
		$BPName[$i] = $BPDetails[$i]['BPName'];
		$arr = explode("T",$BPDetails[$i]['BPTime']);
		$BPTime[$i]=$arr[1];
		unset($arr);
	}
}
?>
<form name="booking" action="bus-booking.php" method="post" onsubmit="return validate()">
<?php //echo "<pre/>";print_r($_POST);exit;?>
<input type="hidden" value="<?php echo $_POST['bus_provider']; ?>" name="bus_provider"/>
<input type="hidden" value="<?php echo $_POST['bus_type']; ?>" name="bus_type"/>
<input type="hidden" value="<?php echo $_POST['scheduleId']; ?>" name="scheduleId"/>
<input type="hidden" value="<?php echo $_POST['travelDate']; ?>" name="travelDate"/>
<input type="hidden" value="<?php echo $_POST['fromStationId']; ?>" name="fromStationId"/>
<input type="hidden" value="<?php echo $_POST['toStationId']; ?>" name="toStationId"/>
<input type="hidden" value="" id="seatName" name="seatname"/>
<input type="hidden" value="0" id="netprice" name="netprice"/>
<input type="hidden" value="0" id="totalprice" name="totalprice"/>
<input type="hidden" value="0" id="costprice" name="costprice"/>
<!--<input type="hidden" id="seatprice" name="seatprice" value="<?php print($_SESSION['selling_price']); ?>"/> -->

<div style="clear:both; width:100%; height:5px;"></div>
<table width="462" border="0" align="center" cellpadding="0" cellspacing="0" style="margin:0 auto; font-size: 11px;  font-weight: bold;line-height: 30px;    text-align: left;">
	 <tr><td>BoardingPoint Name</td><td colspan="2" >
       	<select name="BoardingPointName"  style="width:200px;">
            <option value="">-----select-----</option>
            <?php foreach($BPName as $k=>$val2) {
			$val=explode('-',$val2);
			?>
            <option value="<?php echo $val2; ?>"><?php echo $val[1].' --- '.$BPTime[$k]; ?></option>
            <?php }
			unset($NoOfBPs);unset($BPDetails);unset($BPName);
			 ?>
            </select></td></tr>
<tr><td>&nbsp;</td><td colspan="2"><input type="image" src="images/bus_booking_submit_btn.png" name="submit" /></td></tr>


</table>
<div style="clear:both; width:100%; height:5px;"></div>


</form>
<?php
}
else
{
	echo '<table width="100%" style="border:1px solid #70bcf5; margin:0 auto;">
  <tr>
    <td width="82" height="70" style="font-size:15px; font-family:Arial, Helvetica, sans-serif; text-align:center; font-weight:bold;line-height:18px; color:#FF0000;">Unexpected Error occurred! Please search again</td>
  </tr>
  </table>';
}
?>

