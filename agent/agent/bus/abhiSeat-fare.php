<?php
include'../../server/server.php'; 
include_once '../includes/functions.php';
include ( "../../bus/abhibus-lib/xmlrpc.php" );
$query_info['partnerid'] = 1;
require_once("../../bus/abhibus-lib/api.php");
unset($_SESSION['busraja']['abhibus']['scheduleId']);
if(isset($_SESSION['user']['user_id']) && $_SESSION['user']['user_id']!='') 
{
	$user_id=$_SESSION['user']['user_id'];
	$user_bal=mysql_query("select balance from user_login where id='$user_id'");
	$value = mysql_fetch_object($user_bal);
	$_SESSION['user']['balance'] = $value->balance;
}

$selectUserData = "SELECT * FROM user_login ORDER BY id ASC LIMIT 0,1";

$queryUserData = mysql_query($selectUserData);

$resultUserData = mysql_fetch_object($queryUserData);
$acal = '%';
$bus_markup = $resultUserData->bus_user_markup;
function markup($amt,$bus_markup,$acal)
{
	if ($acal == '%') $markup = round($amt * $bus_markup / 100);
	else
	if ($acal == 'Rs') $markup = $bus_markup;
	return $selling_price = round($markup + $amt);
}
unset($_SESSION['user']['prodis']);

unset($_SESSION['Newpromocode']);

$useragent=$_SERVER['HTTP_USER_AGENT'];

$useragent1 = explode('(',$useragent);

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

{
$device = $_SESSION['useDevice'] = 'Mobile / '.$useragent;
}
else 
{
$device = $_SESSION['useDevice']= 'Web / '.$useragent;
}

$_SESSION['system']['log']['pinfo'] = 'GATEWAY_INTERFACE : '.$_SERVER['GATEWAY_INTERFACE'].'<br/>'.'HTTP_ACCEPT : '.$_SERVER['HTTP_ACCEPT'].'<br/>'.'HTTP_ACCEPT_ENCODING : '.$_SERVER['HTTP_ACCEPT_ENCODING'].'<br/>'.'HTTP_ACCEPT_LANGUAGE : '.$_SERVER['HTTP_ACCEPT_LANGUAGE'].'<br/>'.'HTTP_CONNECTION : '.$_SERVER['HTTP_CONNECTION'].'<br/>'.'HTTP_HOST : '.$_SERVER['HTTP_HOST'].'<br/>'.'HTTP_USER_AGENT : '.$_SERVER['HTTP_USER_AGENT'].'<br/>'.'QUERY_STRING : '.$_SERVER['QUERY_STRING'].'<br/>'.'REMOTE_ADDR : '.$_SERVER['REMOTE_ADDR'].'<br/>'.'REMOTE_PORT : '.$_SERVER['REMOTE_PORT'].'<br/>'.'REQUEST_METHOD : '.$_SERVER['REQUEST_METHOD'].'<br/>'.'SCRIPT_FILENAME : '.$_SERVER['SCRIPT_FILENAME'].'<br/>'.'SERVER_NAME : '.$_SERVER['SERVER_NAME'].'<br/>'.'SERVER_ADMIN : '.$_SERVER['SERVER_ADMIN'].'<br/>'.'SERVER_PROTOCOL : '.$_SERVER['SERVER_PROTOCOL'].'<br/>'.'SERVER_SIGNATURE : '.$_SERVER['SERVER_SIGNATURE'].'<br/>'.'SERVER_SOFTWARE : '.$_SERVER['SERVER_SOFTWARE'];

$_SESSION['system']['pro-mac-id'];
$_SESSION['system']['current_time'] = time();
$_SESSION['system']['current_date'] = date('d/m/Y h:i:s A',$_SESSION['system']['current_time']);

system('ipconfig/all'); $mycom=ob_get_contents(); ob_clean(); $findme = "Physical"; $pmac = strpos($mycom, $findme); $mac=substr($mycom,($pmac+36),17); $_SESSION['system']['pro_mac_id'] = $mac;
$userlogDevice = $device;
$time_format  	=  time();
if(isset($_SESSION['user']['user_id']) && $_SESSION['user']['user_id']!='') { $userlogUserId = $_SESSION['user']['user_id']; } 
else { $userlogUserId = 'Guest'; }
if(isset($_SESSION['user']['first_name']) && $_SESSION['user']['first_name']!='') { $userlogUserName = $_SESSION['user']['first_name']; } 
else { $userlogUserName = 'Guest'; }
if(isset($_SESSION['user']['email_id']) && $_SESSION['user']['email_id']!='') { $userlogUserEmail = $_SESSION['user']['email_id']; } 
else { $userlogUserEmail = 'Guest'; }
if(isset($_SESSION['user']['mobile_number']) && $_SESSION['user']['mobile_number']!='') { $userlogUserMobile = $_SESSION['user']['mobile_number']; } 
else { $userlogUserMobile = 'Guest'; }
if(isset($_SESSION['user']['balance']) && $_SESSION['user']['balance']!='') { $userlogUserBalance = $_SESSION['user']['balance']; } 
else { $userlogUserBalance = 'Guest'; }
$userlogPageName = "abhiSeat-fare.php";
$userlogotherData = 'Select Seat Process';
$SeatLayout=$_SESSION['busRaja']['SeatLayout'];
$seatName=$_GET['seat'];
if(isset($_SESSION['busRaja']['selectedSeat']) && $_SESSION['busRaja']['selectedSeat']!='')
$selectedSeat=$_SESSION['busRaja']['selectedSeat'];
$i=0;
	$f=0;
	if(isset($selectedSeat))
	foreach($selectedSeat as $seat)
	{	
		if($seat==$seatName)

		{	$key=array_search($seatName,$_SESSION['busRaja']['selectedSeat']);

			unset($_SESSION['busRaja']['selectedSeat'][$key]);

			$f=1;

		}

	$i++;

	}

	if($f!=1 && count($_SESSION['busRaja']['selectedSeat'])<6)

	{

		$_SESSION['busRaja']['selectedSeat'][]=$seatName;

	}

$query_info['traveler_id']  = $_SESSION['busraja']['abhibus']['traveler_id'];
$query_info['jdate']  =$_SESSION['busraja']['abhibus']['jdate'];
$query_info['sourceid']  =$_SESSION['busraja']['abhibus']['sourceid'];
$query_info['destinationid'] =$_SESSION['busraja']['abhibus']['destinationid'];
$query_info['serviceid'] =$_SESSION['busraja']['abhibus']['serviceid'];
$query_info['seat_sleeper'] =0;
list($success1, $response1) = XMLRPC_request(
	$site,
	$location,
	'index.busseating',
	array(XMLRPC_prepare($query_info),
	'HarryFsXMLRPCClient')
);
/******/
	
$query_info1['jdate']  = $_SESSION['busraja']['abhibus']['jdate'];
$query_info1['sourceid']  =$_SESSION['busraja']['abhibus']['sourceid'];
$query_info1['destinationid'] =$_SESSION['busraja']['abhibus']['destinationid'];
$query_info1['serviceid'] =$_SESSION['busraja']['abhibus']['serviceid'];
$query_info1['selected_seats'] =implode(',',$_SESSION['busRaja']['selectedSeat']);
//print_r($query_info1);

list($success, $response) = XMLRPC_request(
$site,
$location,
'index.seatselection',
array(XMLRPC_prepare($query_info1),
'HarryFsXMLRPCClient')
);
if(count($_SESSION['busRaja']['selectedSeat'])!=0 && count($_SESSION['busRaja']['selectedSeat'])<7)
{
	$serviceCharge=20;
$response=$response[0];
if( $response['sel_seats']=='Error ')
{
	echo "Sorry Please Try Again";
	exit;
}
$totalfare=$response['total_fare_with_taxes'];
$selectedSeat1=implode(',',$response['sel_seats']);
$_SESSION['seatName_oneway']=implode('|A|',$response['sel_seats']);

$selectedSeat1.'^'.$_SESSION['busRaja']['totalFare']=$totalfare;

$seatCount=count($_SESSION['busRaja']['selectedSeat']);

$totalfare=$_SESSION['busRaja']['totalFare'];

$_SESSION['user']['costPrice']=$totalfare;

$_SESSION['user']['netAmt']=$totalfare;

$_SESSION['user']['a_pr_tot']=$gettot = $totalfare+$serviceCharge;
$response['total_fare'];
?>



<form action="" method="post" onsubmit="return validateForm()" >
<table class="details" width="100%" border="0" cellspacing="2" cellpadding="0">

    	<tr>

        	<td valign="top" align="center" width="150">Name</td>

            <td valign="top" align="center" width="75">Age</td>

            <td valign="top" align="center" width="75">Gender</td>

            <td valign="top" align="center" width="75">Seat<input type="hidden" id="new_seat_count" name="new_seat_count" value="<?php if(isset($_SESSION['busRaja']['selectedSeat'])) { echo count($_SESSION['busRaja']['selectedSeat']); } else { echo '0'; }  ?>" /></td>

		</tr> 
		
       <?php $i1=1; foreach($_SESSION['busRaja']['selectedSeat'] as $seat) { 

	   ?> 

        <tr>

        	<td valign="top" align="center">

            	<input type="text" name="fullname[]" value="<?php if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='E:/xampp/htdocs' ) { echo "Subbaiyan_".$i1; }?>" class="w190new" style="float:none;" placeholder="Full Name" id="fullname_<?php echo $i;?>">

            </td>

            <td valign="top" align="center">

            	<input  type="text" name="age[]" value="<?php if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='E:/xampp/htdocs' ) { echo "30"; }?>" class="w40" style="float: none;" placeholder="Age" id="age_<?php echo $i;?>" >

            </td>

            <td valign="top" align="center">

                <select style="float: none;" id="gender<?php echo $i1; ?>" name="gender<?php echo $i1; ?>" required="required">

                    <option value="Male" selected="select">Male</option>

                    <option value="Female">Female</option>

                </select>

            </td>

            <td valign="top" align="center"><?php echo $seat; ?></td>
            <?php /*?><td valign="top" align="center"><?php echo $_SESSION['busRaja']['seatFareWithMarkup'][$i1-1]; ?></td><?php */?>

		</tr><?php $i1++; } ?> 

        <tr>

          <td valign="top" colspan="5" height="10"></td>
        </tr>

        <tr>


          <td colspan="2" valign="top" style="text-align:right; padding-right:10px;"><b>Onward Fare:</b></td>

          <td valign="top" style="text-align:left; padding-left:10px;"><b><?php if($_SESSION['gs_mode']=='roundtrip' && $_SESSION['gs_counts']==2)

		{

			echo $onewayFare;

		}

		else

		{

			echo $_SESSION['user']['netAmt']; 

		}

		?></b></td>

        </tr>

        <?php if($_SESSION['gs_mode']=='roundtrip' && $_SESSION['gs_counts']==2)

		{

		?>

        <tr>
        


          <td colspan="2" valign="top" style="text-align:right; padding-right:10px;"><b>Return Fare:</b></td>

          <td valign="top" style="text-align:left; padding-left:10px;"><b>

			<?php echo $_SESSION['user']['returnFare']; ?></b></td>

        </tr>

        <?php

		}

		?>

        

        <tr>
        

          <td colspan="2" valign="top" style="text-align:right; padding-right:10px;"><b>Service Charge : </b></td>

          <td valign="top" style="text-align:left; padding-left:10px;"><b><?php echo $serviceCharge; ?></b></td>

        </tr>

        <?php 
		unset($_SESSION['user']['walletPay']);
			
			if(isset($_SESSION['user']['user_id']) && isset($_SESSION['user']['balance']))

				{

					if($_SESSION['user']['balance']>$_SESSION['user']['a_pr_tot'])

						{

							$_SESSION['user']['walletPay']=$_SESSION['user']['a_pr_tot'];

						}

					else 

						{

							$_SESSION['user']['walletPay']=$_SESSION['user']['balance'];

							$_SESSION['user']['balancePay']=$_SESSION['user']['a_pr_tot']-$_SESSION['user']['balance'];

						}

				}

		     else 

			 	{
					$_SESSION['user']['balancePay'] = $_SESSION['user']['a_pr_tot']-10;
					$_SESSION['user']['walletPay']=0;
					 $gettot;	

				}

			$_SESSION['net_price_oneway']=$gettot;
?>

         <tr id="promoDis" style="display:none;">
         

          <td colspan="2" valign="top" style="text-align:right; padding-right:10px;">

          <?php if(isset($_SESSION['log']['user_id']) && $_SESSION['log']['user_id']!='') { ?>

          	<b>Promo Dis Add in your Wallet : </b> <?php } else { ?> <b>Promo Discount : </b> <?php } ?>

          </td>

          <td valign="top" style="text-align:left; padding-left:10px;"><b><div id="promodiscountDisp"></div></b></td>

        </tr>

<?php /*?>        <tr id="toPaY" style="display:none;">

          <td valign="top">&nbsp;</td>

          <td colspan="2" valign="top" style="text-align:right; padding-right:10px;"><strong>To Pay Now :</strong></td>

          <td valign="top" style="text-align:left; padding-left:10px;"><b id="toPaynow"></b></td>

        </tr><?php */?>

        <tr>


          <td colspan="2" valign="top" style="text-align:right; padding-right:10px;"><b>Net Amount : </b></td>

          <td valign="top" style="text-align:left; padding-left:10px;"><b><div id="netTotalDisp"><?php echo $_SESSION['user']['a_pr_tot']; ?></div></b></td>

        </tr>

           

       

    </table>

    </form>

    <?php
$_SESSION['gs_mode']='oneway';
$_SESSION['gs_counts']=2;
	if( ($_SESSION['gs_mode']=='oneway' || ($_SESSION['gs_mode']=='roundtrip') && $_SESSION['gs_counts']==2))

{

	?>

<?php /*?><div class="promo cf">

  <span><input type="checkbox" onclick="return promofunction();" value="1" id="promocheck" name="promocheck"> I have an offer code (optional)</span>

  

     <ul id="promocodedisp"  class="user_contact_detailsnewSN" style="display:none;">

        <li>

          <input type="text" name="promocode"  id="promocode" class="w190new" placeholder="Promo Code" style="margin: 0 5px !important;" value="<?php if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs') {  echo "DSMART5"; }?>" > 

            

        </li>

        <li id="applybutton">

            <input type="button" id="apply" value="Apply" name="apply" class="btn_blue" style="margin-top: 0;"  onClick="return promoprocessbar();" >

        </li>

        <li id="processbar" style="display:none;">

            <img src="images/progress-bar.gif" width="160" height="20">

        </li>

	</ul>

  <div id="promoerror" style="color:#F00;"></div>

</div><?php */?>



                <h5 class="cf" style="text-align:left;">

                <?php

                if (isset($_SESSION['user']['user_id']) && $_SESSION['user']['user_id'] !='' && $_SESSION['user']['user_id'] != 0)

                {

				?>

                    <p class="wallet_option">Wallet Amount : <?php echo round($_SESSION['user']['balance']); ?></p> 

                    <p class="fon">

                    <?php

					if($_SESSION['user']['balance']>=$_SESSION['user']['a_pr_tot'])

						{

					?>

                     <input type="radio" class="payumoney_option" name="payment"  id="payment" value="ebs">&nbsp;&nbsp;<img src="img/payumoney.png" style="vertical-align:middle;" class="payumoney_option">

                    <?php } else

					{

						$_SESSION['user']['walletPay']=round($_SESSION['user']['balance']);

					?>

                    <input type="radio" class="payumoney_option" name="payment"  id="payment" value="ebs">&nbsp;&nbsp;<img src="img/payumoney.png" style="vertical-align:middle;" class="payumoney_option">&nbsp;&nbsp;
</p>

                    <?php } ?>

                    </h5>			

                <?php

                }

                else

                { ?>

                    <div class="cf" style="text-align: left; display:none;">
                        <input type="radio" name="payment"  class="ebs_option"  id="payment"  value="ebs" checked="checked" >&nbsp;&nbsp;<img src="img/paymentgateway.png" style="vertical-align:middle;">&nbsp;&nbsp;

                        <?php /*?><input type="radio" name="payment"  id="payment"   value="paytm" checked="checked"  >&nbsp;&nbsp;<img src="img/paytmwallet.png" style="vertical-align:middle;" class="ebs_option"><?php */?>

                    </div>

                <?php

                }

            }

            ?>

<?php

}
exit;

?>