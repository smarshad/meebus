<?php
include_once'../../server/server.php';  
date_default_timezone_set("Asia/Kolkata"); 
$_SESSION['common']['pagename'] = "Cancel"; 
include_once '../includes/functions.php';
$travelTime=$_GET['tm'];
//echo date('d/m/Y h:i:s A',$travelTime);
//$travelTime=time();
$c_charge=100;
//unset($_SESSION['price']);
//echo "<pre>"; print_r($_SESSION['price']); echo "<pre/>";
//unset($_SESSION['cancel']['cancel_charge']);

$obj=new agent_module($con);  

	if(isset($_SESSION['seatNoData']))
		{
			if(!in_array($_GET['sno'],$_SESSION['seatNoData']))
				{
					$_SESSION['seatNoData'][] = $_GET['sno'];
					$_SESSION['price'][$_GET['sno']] = $_GET['pr'];
				}
			else 
				{
					if(($key = array_search($_GET['sno'], $_SESSION['seatNoData'])) !== false) 
					{
						unset($_SESSION['price'][$_GET['sno']]);
						unset($_SESSION['seatNoData'][$key]);
					}		
				}
		}
	else 
		{
			$_SESSION['seatNoData'][] = $_GET['sno'];
			$_SESSION['price'][$_GET['sno']] = $_GET['pr'];
		}
if(!isset($_SESSION['seatNoData'][0]))
{ echo ''; exit; }


				$cnclDatas = '';
                $cnclDatas.='<div style="background: #fff none repeat scroll 0 0; font-family: Verdana,Geneva,sans-serif; height: auto; margin: 0 auto; width: 100%;"><div style="color: #000; float: left; font-size: 15px; font-weight: bold; height: 40px; line-height: 30px; padding-left: 5px; width:99%;border-bottom: 1px solid #CCC;">Cancellation Policy</div><div style="width:100%; flot:left;"><div style="border-right: 1px solid #ccc; color: #000; float: left; font-size: 13px;    font-weight: bold; height: 30px;  line-height: 30px; padding-left: 5px; width:47%; flot:left;">Cancellation time</div><div style="float: left; font-size: 13px; font-weight: bold; height: 30px; line-height: 30px; padding-left: 5px; width:50%;  flot:left;">Cancellation Charges</div><div style="width:100%; float:left; height:auto;">';
                $h = 0;				
				$new11=array();
				//echo "<pre>"; print_r($_SESSION['agent']['cancel']['policy']); echo "</pre>";
				 $cancel_pol=explode(';',$_SESSION['agent']['cancel']['policy']);
				 //echo "<pre>"; print_r($cancel_pol); echo "</pre>";
				// echo "<pre>"; print_r(array_reverse($cancel_pol)); echo "<pre/>";
				//$cancel_pol = array_reverse($cancel_pol);
				//$now=strtotime('14-04-2016 08:16 AM');
				//echo date('d-m-Y h:i A',time());
				//echo $now = strtotime(date('d-m-Y h:i A',time()));
				$now = time();
				
				//$now=strtotime(date('d-m-Y h:i A',time()));	
				//$now=time();
                foreach ($cancel_pol as $fd) {
                    if ($h <= count($cancel_pol)) {
						if($cancel_pol[$h]!='')
						{
                        $new11 = explode(':', $cancel_pol[$h]); 
						if(isset($new11[1]))
							if ($new11[1] == -1) {
								
								$cnclDatas.='<div style="border-right: 1px solid #ccc; border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height: 30px; padding-left: 5px; width:47%;">';
								$val=str_replace("'","",$new11[0]);
								$cancelTime= $travelTime-($val * 60 * 60); 								
								
								$cnclDatas.='Before '.date('d-m-Y h:i A',$cancelTime);
								$cnclDatas.= '</div><div style="border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 30px; line-height:30px; padding-left:5px; width:50%;">';  
								//echo date('d/m/Y h:i:s A',$cancelTime).'<br/>';
								
								
								$cnclDatas.=$new11[2];
								$cnclDatas.=' %</div>';
								if($now<=$cancelTime) { $c_charge=$new11[2]; /*$cnclDatas.= '*GS1';*/ }
								//if($now>$cancelTime) { $c_charge=100; }
							} else {
								
								
								$cnclDatas.='<div style=" border-right: 1px solid #ccc; border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 35px; line-height: 15px; padding-left: 5px; width:47%;" >Between ';
								if(isset($new11[1]))
								{
									$val=$new11[1];
								
								    $cancelTime= $travelTime-($val * 60 * 60); 		
									$cnclDatas.=date('d-m-Y h:i A',$cancelTime);
								}
								$cnclDatas.=' and ';
								if(isset($new11[0]))
								{
									$val=$new11[0];
									//if($now<=$cancelTime) { $c_charge=$val; /* $cnclDatas.= '*GS2';*/ }
									//if($now>$cancelTime) { $c_charge=100; }
								    $cancelTime= $travelTime-($val * 60 * 60); 
									$cnclDatas.=date('d-m-Y h:i A',$cancelTime);
								}
								$cnclDatas.='</div><div style="border-top: 1px solid #ccc; color: #000; float: left; font-size: 12px; font-weight: normal; height: 35px; line-height: 15px; padding-left: 5px; width:50%;   ">';
								if($now<=$cancelTime) { $c_charge=$new11[2]; /*$cnclDatas.= '*GS3';*/ }
								//if($now>$cancelTime) { echo 'gs'.$c_charge=100; }
								
								$cnclDatas.=$new11[2].'% </div>';
							}
						}
                    } $h++;
                } $cnclDatas.='</div></div></div>'; 

				//echo date('d/m/Y h:i:s',$cancelTime)."<br/>";
				//echo date('d/m/Y h:i:s',$now)."<br/>";
				//echo '-A-'.$c_charge;
				
				
?>
<div id="cancelcalculationpart" class="span4">
            <div style="">
                <div class="GODGOMDKMH">Selected for Cancellation</div> 
                <hr> <div class="GODGOMDPLH GODGOMDOLH">
                <?php 
					//$now=0;
					$fare=0;
					$cancel_charge=0;
					$cancel_charge1=0;
					//echo "<pre>"; print_r($_SESSION['price']); echo "</pre>";
				foreach ($_SESSION['seatNoData'] as $key => $val) { ?>
               
                    <span class=""><?php
						echo $val; 
					 $cancel_charge1=($_SESSION['price'][$val]*$c_charge)/100;
					 $cancel_charge=$cancel_charge+($_SESSION['price'][$val]*$c_charge)/100;
					 
					 ?></span>
                <?php 
				//echo "<pre>"; print_r($_SESSION['price']); echo "<pre/>";
				//echo $fare; echo '<br/>'; 
				//echo $_SESSION['price'][$val]; echo '<br/>'; 
				//echo  $cancel_charge; echo '<br/>'; 
				$fare=$fare+$_SESSION['price'][$val]-$cancel_charge1; 
				} 
				//echo $fare;
				?> </div> 
                <div class="GODGOMDKMH">Cancellation Charge (in Rs.)</div> 
                <hr> 
                <div class="GODGOMDCMH">
                    <div class="GODGOMDKMH GODGOMDFMH"><?php echo $_SESSION['cancel']['cancel_charge']=$cancel_charge; ?></div> 
                </div> 
                <div style="clear:both"></div> 
                <div class="GODGOMDKMH clear">Refund Amount (in Rs.)</div> 
                <hr> 
                <div style="clear:both"></div> 
                <div class="GODGOMDOLH"><?php $_SESSION['cancel']['refund']=$fare; if($_SESSION['cancel']['refund']<0) { echo '0'; } else { echo $_SESSION['cancel']['refund']; } ?></div> 
                <div class="clear"></div> 
                <button class="GODGOMDJV" id="cancel_final" type="button"><div class="gwt-Label">Cancel Seats</div></button>
            </div> 
</div>
        <div class="span8">
                <?php echo $cnclDatas; ?>
       </div>
<script>
$( "#cancel_final" ).click(function() {
	
	var txt;
    var r = confirm("Are You Sure Cancel This Ticekt !");
    if (r == true) {
		
	$('.block-content').html('<img src="images/please_wait.gif" width="400" height="200" style="display:block; margin:0 auto;" />');	
        	$.post("final_cancel.php", function(data) { 
			
			var getData = data.split('^');
			if(getData[0]!='' && getData[1]!='' && getData[2]!='')
			{
				//$('.block-content').html(data);
				window.location.replace("cancelResult.php");		
			}
			else 
			{
				alert('Please Try Again Later');
				return false;
			}
			
			//alert(data);
			//location.reload(); 
			
			});
    } 
	else 
	{
		return false;		
    }
return true;
});
</script>