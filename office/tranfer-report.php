<?php
include_once("includes/header.php");
?>
<script type="text/javascript" language="javascript"> 
  $( function() {
    $( "#from_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
	$( "#to_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>
<body>
<?php 
if(isset($_POST['submit']) && $_POST['submit']='Search')
{
	if(isset($_SESSION['offid']) && $_SESSION['offid']!='' && $_SESSION['offid']!=0)
	{
		$officeId = $_SESSION['offid'];
		$fromDate = $_POST['from_date'];
		$toDate = $_POST['to_date'];
		$barCode = $_POST['barcode'];
		if($barCode!='')
		{
			$barcodeSearch = "AND aws_no='".$barCode."'";	
		}
		else 
		{
			$barcodeSearch = '';	
		}
		if($_POST['from_date']!='' && $_POST['to_date']!='')
		{
			$date="AND (created_datetime BETWEEN '$fromDate' AND '$toDate')";
		}
		else
		{
			$date = '';	
		}
		if($date=='' || $barcodeSearch=='')
		$limit='ORDER BY id DESC LIMIT 10';
		else
		$limit='';
		$selectRecord = "SELECT * FROM cargo WHERE office_id='$officeId' $barcodeSearch $date $limit";	
		$tranfer_report_query = mysql_query($selectRecord);
		
	}
	else 
	{
		header('location:index.php');	
	}
}
?>

<fieldset class="table-bor">
<legend><strong>Shipment Report </strong></legend> 
<form action="" method="post">
  <table border="0" align="center" width="98%">
    <tbody>
    <tr>
       <td class="Partext1" align="right"><strong> AWS Number</strong></td>
       <td class="Partext1"><input type="text" id="barcode"  name="barcode"  style="cursor:pointer;width:50%;" class="textbox"/></td>
    </tr>
    <tr>
      <td class="Partext1" align="right"><strong>Frome Date</strong></td>
      <td class="Partext1"><input type="text" id="from_date"  name="from_date"  style="cursor:pointer;width:50%;;" class="textbox"/></td>
    </tr>
    <tr>
      <td class="Partext1" align="right"><strong>To Date</strong></td>
      <td class="Partext1"><input type="text" id="to_date"  name="to_date" style="cursor:pointer; width:50%;" class="textbox"/></td>
    </tr>
    <tr>
      <td class="Partext1"></td>
      <td><input type="submit" id="submit" name="submit" value="Search"></td>
    </tr>
  </tbody>
 </table>
 </form>	
<?php if(isset($_POST['submit'])) { ?>
<div class="order-details-MP order-details-bottom tmargin20">
   <div class="orderDetails-tracking tmargin10 line">
      <table class="order-details-table bmargin15" width="100%" cellspacing="0" cellpadding="0" align="left">
         <tbody>
            <tr class="caption nondigital order_item_row_0" align="left">
               <th colspan="4" class="vtop product-info" align="left">
                  <div class="table-head clearfix">
                     <div class="heads prod"> <span class="text">PRODUCT DETAILS</span> </div>
                     <div class="heads line gran">
                        <div class="detail appr">APPROVAL</div>
                        <div class="detail proc">PROCESSING</div>
                        <div class="detail ship">SHIPPING</div>
                     </div>
                     <div class="heads del"> <span class="text">DELIVERY</span> </div>
                     <div class="heads sub"> <span class="text">TOTAL</span> </div>
                  </div>
               </th>
            </tr>
            <!-- List of items to display --> 
            
            
            <?php while($getdata = mysql_fetch_object($tranfer_report_query)) { ?>
            
            <tr class="order_item_row_1" align="left">
               <!-- Column 1 --> 
               <td class="vtop item-details" width="37%">
                  <div class="line">
                     <div class="unit item-img-div fk-text-center"> <a href="#" target="__blank"> <img class="js-item-image" src="images/dummy.png" title="" alt=""> </a> </div>
                     <div class="lastUnit">
                        <div class="lmargin10">
                           <p class="order-item-title"> <a href="#" target="__blank">&nbsp; Reference No : <?php echo $getdata->ref_no; ?></a> </p>
                           <p class="order-item-qty smallText tmargin5">&nbsp; AWS No : <?php echo $getdata->aws_no; ?></p>
                           <p class="smallText tmargin5" style="display:none;">
                              10 Days Replacement 
                           </p>
                           <p class="smallText tmargin5" style="display:none;">
                              Seller: <a href="#">SuperComNet</a>&nbsp;
                           </p>
                        </div>
                     </div>
                  </div>
               </td>
               <!-- Column 2 --> 
               <td class="vtop item-shipment" width="38%">
                  <!-- Shipment graph --> 
                  <ul class="line graph">
                     <li class="unit size1of3 fk-text-center state">
                        <ul class="line">
                           <?php if($getdata->status!='') { ?><li class="order-step processed"></li> <?php } ?>
                        </ul>
                     </li>
                     <li class="unit size1of3 fk-text-center state">
                        <ul class="line">
                         <?php if($getdata->status=='In Transit' || $getdata->status=='Arrived'  || $getdata->status=='Pending') { ?><li class="order-step processed-continous"></li> <?php } ?>
                        </ul>
                     </li>
                     <li class="lastUnit size1of3 fk-text-center state">
                        <ul class="line">
                            <?php if($getdata->status=='Deliverd') { ?><li class="order-step processed-continous"></li> <?php } ?>
                        </ul>
                     </li>
                  </ul>
                  <!-- Shipment info popup --> 
                  <div class="rposition">
                     <div class="granular-info-box">
							<?php if($getdata->status=='Pending') { ?><div class="arrow arrow5"></div><?php } ?>
                            <?php if($getdata->status=='In Transit' || $getdata->status=='Arrived'  || $getdata->status=='Pending') { ?><div class="arrow arrow11"></div><?php } ?>
                            <?php if($getdata->status=='Deliverd') { ?><div class="arrow arrow12"></div><?php } ?>
                        <div class="margin5">
                           <div class="processed bmargin5 fk-font-normal">
                              Your item has been <?php echo $getdata->status; ?>.
                           </div>
                           <?php /*?><ul class="line granular-info">
                              <li class="unit col1"> <?php echo $getdata->delivery_date; ?></li>
                             <li class="lastUnit col4 word-break">
                               Your item has been <?php echo $getdata->status; ?>. 
                              </li>
                           </ul><?php */?>
                        </div>
                     </div>
                  </div>
               </td>
               <!-- Column 3 --> 
               <td class="vtop item-shipment" width="12%">
                  <div class="graph lpadding10 tpadding5">
                     <div class="dates">
                        <p class="deliveryDate">
                          <?php if($getdata->delivery_date=='0000-00-00') echo 'Waiting for arrival'; else echo $getdata->delivery_date; ?>
                        </p>
                     </div>
                  </div>
               </td>
               <!-- Column 4 --> 
               <td class="vtop item-details" width="13%" align="right">
                  <span class="fk-label boldtext">Rs.  <?php echo $getdata->totalPrice; ?></span> <?php /*?><a id="">[?]</a> <?php */?>                  
               </td>
            </tr>
            <tr class="buttons_row last">
               <td colspan="4">
                  <div class="button_container"></div>
               </td>
            </tr>
            <tr class="total-row">
              <td colspan="4" class="padding10" align="right" style="height:1px; background:#000;"></td>
            </tr>
            
            <?php } ?>
         </tbody>
      </table>
   </div>
</div>	
<?php } ?>
		</fieldset>
</body>
<?php include "includes/footer.php"; ?>