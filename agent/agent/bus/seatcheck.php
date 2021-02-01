<?php 
session_start();
ob_start();
ini_set('display_errors', 0);
require_once("config/config.php");

include_once("includes/functions.php");
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
$userlogPageName = "passangerinfo.php";
$userlogotherData = 'Select Seat Process';
$seatName=$_REQUEST['seat'];
$bussid=$_REQUEST['busid'];
$travel1=$_REQUEST['dat'];
$_SESSION['selectedBusId']=$bussid;
$qry=mysql_query("SELECT base_fare FROM businfo WHERE Bus_id=".$bussid ." LIMIT 1"); 
$businfo=mysql_fetch_array($qry);
$Bus_fare=$businfo['base_fare'];
if(isset($_SESSION['busRaja']['selectedSeat']) && $_SESSION['busRaja']['selectedSeat']!='')
$selectedSeat=$_SESSION['busRaja']['selectedSeat'];
$i=0;$f=0;
if(isset($selectedSeat))
foreach($selectedSeat as $seat)
{
	if($seat==$seatName)
	{	$key=array_search($seatName,$_SESSION['busRaja']['selectedSeat']);
		unset($_SESSION['busRaja']['selectedSeat'][$key]);
		unset($_SESSION['busRaja']['seatFareWithMarkup'][$seat]);
		unset($_SESSION['busRaja']['seat']['ladiesSeat'][$seat]);
		$f=1;
	}
	$i++;
}
if($f!=1 && count($_SESSION['busRaja']['selectedSeat'])<6)
{
	$_SESSION['busRaja']['selectedSeat'][]=$seatName;
}
if(count($_SESSION['busRaja']['selectedSeat'])!=0 || count($_SESSION['busRaja']['selectedSeat'])<7)
{
	$selectedSeat=$_SESSION['busRaja']['selectedSeat'];
	$totalfare=0;
	foreach($selectedSeat as $seat)
	{
		$_SESSION['busRaja']['seatFare'][$seat]=$Bus_fare;
		$_SESSION['busRaja']['seatFareWithMarkup'][$seat]=markup($Bus_fare,$bus_markup,$acal);
		$_SESSION['busRaja']['seat']['ladiesSeat'][$seat]=false;
		$_SESSION['net_price_oneway']=$_SESSION['user']['costPrice']=$totalfare+=markup($Bus_fare,$bus_markup,$acal);
	}
}
$serviceCharge=10;
$_SESSION['seatName_oneway']=implode('|A|',$_SESSION['busRaja']['selectedSeat']);
$_SESSION['busRaja']['totalFare']=$totalfare;
$seatCount=count($_SESSION['busRaja']['selectedSeat']);
$totalfare=$_SESSION['busRaja']['totalFare'];
$_SESSION['user']['costPrice']=$totalfare;
$_SESSION['user']['netAmt']=$totalfare;
$_SESSION['user']['a_pr_tot']=$gettot = $totalfare+$serviceCharge;
?>  
<table class="details" border="0" cellpadding="0" cellspacing="2" width="100%">
         <tbody>
            <tr>
               <td valign="top" width="150">Name</td>
               <td valign="top" width="75">Age</td>
               <td valign="top" width="75">Gender</td>
               <td valign="top" width="75">Seat<input id="new_seat_count" name="new_seat_count" value="1" type="hidden"></td>
               <td valign="top" width="75">Fare</td>
            </tr>
            <?php
			$i=1;
			 foreach($selectedSeat as $seat)
			 {
	 		?>
          		<tr>
               <td align="center" valign="top">
                  <input name="fullname[]" value="Subbaiyan_1" class="w190new" style="float:none;" placeholder="Full Name" id="fullname_0" type="text">
               </td>
               <td align="center" valign="top">
                  <input name="age[]" value="30" class="w40" style="float: none;" placeholder="Age" id="age_0" type="text">
               </td>
               <td align="center" valign="top">
                  <select style="float: none;" id="gender<?php echo $i; ?>" name="gender<?php echo $i; ?>" required="required">
                     <option value="Male" selected="select">Male</option>
                     <option value="Female">Female</option>
                  </select>
               </td>
               <td align="center" valign="top"><?php echo $seat; ?></td>
               <td align="center" valign="top"><?php echo $_SESSION['busRaja']['seatFareWithMarkup'][$seat]; ?></td>
            </tr>
          	<?php
			$i++;
            }
			if(count($selectedSeat)>0)
			{
			?>
            <tr>
               <td colspan="5" height="10" valign="top"></td>
            </tr>
            <tr>
               <td valign="top">&nbsp;</td>
               <td valign="top">&nbsp;</td>
               <td colspan="2" style="text-align:right; padding-right:10px;" valign="top"><b>Onward Fare:</b></td>
               <td style="padding-left: 10px; text-align: left;" valign="top"><b><?php echo $totalfare; ?></b></td>
            </tr>
            <tr>
               <td valign="top">&nbsp;</td>
               <td valign="top">&nbsp;</td>
               <td colspan="2" style="text-align:right; padding-right:10px;" valign="top"><b>Service Charge : </b></td>
               <td style="text-align:left; padding-left:10px;" valign="top"><b>10</b></td>
            </tr>
            <tr id="promoDis" style="display:none;">
               <td valign="top">&nbsp;</td>
               <td valign="top">&nbsp;</td>
               <td colspan="2" style="text-align:right; padding-right:10px;" valign="top">
                  <b>Promo Discount : </b> 
               </td>
               <td style="text-align:left; padding-left:10px;" valign="top">
                  <b>
                     <div id="promodiscountDisp"></div>
                  </b>
               </td>
            </tr>
            <tr>
               <td valign="top">&nbsp;</td>
               <td valign="top">&nbsp;</td>
               <td colspan="2" style="text-align:right; padding-right:10px;" valign="top"><b>Net Amount : </b></td>
               <td style="text-align:left; padding-left:10px;" valign="top">
                  <b>
                     <div id="netTotalDisp"><?php echo $_SESSION['a_pr_tot']=$gettot; ?></div>
                  </b>
               </td>
            </tr>
            <?php
			}
			?>
         </tbody>
      </table>
       <?php

	if( $_SESSION['gs_mode']=='oneway' || ($_SESSION['gs_mode']=='roundtrip' && $_SESSION['gs_counts']==2))

{

	?>

<div class="promo cf">

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

</div>



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

                    <div class="cf" style="text-align: left;">

                        <input type="radio" name="payment"  class="ebs_option"  id="payment"  value="ebs" checked="checked" >&nbsp;&nbsp;<img src="img/paymentgateway.png" style="vertical-align:middle;">&nbsp;&nbsp;

                        <input type="radio" name="payment"  id="payment"   value="paytm" checked="checked"  >&nbsp;&nbsp;<img src="img/paytmwallet.png" style="vertical-align:middle;" class="ebs_option">

                    </div>

                <?php

                }

            }

            ?>