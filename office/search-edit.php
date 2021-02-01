<?php

include_once("includes/header.php");
if(isset($_REQUEST['submit']))
{
$cid=$_REQUEST['srch'];		
$mqry=mysql_query("SELECT * FROM tbl_courier WHERE invice_no='$cid'");	
}
?>

<body onLoad="search_Usr();">

<fieldset class="table-bor">

		<legend><strong>Edit / Search Shipment </strong></legend> 
		
<table class="ds_box" id="ds_conclass" style="display: none;" cellpadding="0" cellspacing="0"> 

  <tbody><tr> 

    <td id="ds_calclass"> </td> 

  </tr> 

</tbody></table> 

  <br>
<form action="" method="post">
  <table border="0" align="center" width="98%">

    <tbody>
    <tr>
      <td class="Partext1" bgcolor="F9F5F5" align="center"><strong>Invoice Number</strong></td>
       <td><input type="text" name="srch"></td>
    </tr>
    <tr>

      <td class="Partext1" bgcolor="F9F5F5" align="center"></td>
       <td><input type="submit" name="submit" value="Search"></td>
    </tr>

  </tbody></table></form>



  </span>

  

  <tr>

    <td>
</td>

  </tr>

</tbody></table>
<div class="order-details-MP order-details-bottom order-actions">
   <div class="table-head padding10">
      MANAGE ORDER
   </div>
   <ul class="line">
      <li class="unit" style="width:32.333333333333%"> 
      <a id="print-order" alt="Print this page"> <i id="print"></i>PRINT ORDER </a> 
      </li>
      <li class="unit" style="width:32.333333333333%"> 
      <a class="invoice"> <i id="invoice"></i>EMAIL INVOICE </a> 
      </li>
      <li class="unit last" style="width:32.333333333333%"> 
      <a href="#"><i id="contact-us"></i>CONTACT US</a> 
      </li>
   </ul>
</div>
<?php
while($data=mysql_fetch_array($mqry))
{
	$cur_id=$data['cid'];	
	$mqrys=mysql_query("SELECT * FROM tbl_courier as a,tbl_courier_track as b WHERE a.cid='$cur_id' AND b.cid='$cur_id'");
	while($datas=mysql_fetch_array($mqrys))	
{	
	//echo '<pre>';print_r($datas);echo '</pre>';
?>		
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
                     <div class="heads sub"> <span class="text">SUBTOTAL</span> </div>
                  </div>
               </th>
            </tr>
            <!-- List of items to display --> 
            <tr class="order_item_row_1" align="left">
               <!-- Column 1 --> 
               <td class="vtop item-details" width="37%">
                  <div class="line">
                     <div class="unit item-img-div fk-text-center"> <a href="#" target="__blank"> <img class="js-item-image" src="images/dummy.png" title="Lenovo VIBE P1m (Black, 16 GB)" alt="Lenovo VIBE P1m (Black, 16 GB)"> </a> </div>
                     <div class="lastUnit">
                        <div class="lmargin10">
                           <p class="order-item-title"> <a href="#" target="__blank"> Lenovo VIBE P1m (Black, 16 GB)</a> </p>
                           <p class="order-item-qty smallText tmargin5">
                              Color: Black&nbsp; Qty: 1 
                           </p>
                           <p class="smallText tmargin5">
                              10 Days Replacement 
                           </p>
                           <p class="smallText tmargin5">
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
                           <li class="order-step processed"></li>
                        </ul>
                     </li>
                     <li class="unit size1of3 fk-text-center state">
                        <ul class="line">
                           <li class="order-step processed"></li>
                           <li class="order-step processed"></li>
                        </ul>
                     </li>
                     <li class="lastUnit size1of3 fk-text-center state">
                        <ul class="line">
                           <li class="order-step processed"></li>
                           <li class="order-step processed"></li>
                           <li class="order-step processed-continous"></li>
                        </ul>
                     </li>
                  </ul>
                  <!-- Shipment info popup --> 
                  <div class="rposition">
                     <div class="granular-info-box">
                        <div class="arrow arrow5"></div>
                        <div class="margin5">
                           <div class="processed bmargin5 fk-font-normal">
                              Your item has been delivered.
                           </div>
                           <ul class="line granular-info">
                              <li class="unit col1">Fri, 7th Oct</li>
                              <li class="unit col2">06:35 pm</li>
                              <li class="lastUnit col4 word-break">
                                 Your item has been delivered 
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </td>
               <!-- Column 3 --> 
               <td class="vtop item-shipment" width="12%">
                  <div class="graph lpadding10 tpadding5">
                     <div class="dates">
                        <p class="deliveryDate">
                           on Fri, 7th Oct 
                        </p>
                     </div>
                  </div>
               </td>
               <!-- Column 4 --> 
               <td class="vtop item-details" width="13%" align="right">
                  <span class="fk-label boldtext">Rs. 6999</span> <a id="">[?]</a>                   
               </td>
            </tr>
            <tr>
               <td class="all-buttons" colspan="4">
                  <ul class="fk-inline-block tmargin20 buttons-list clearfix">
                     <li class="buttons">
                        <a class="return disabled" data-reason="Return duration validity of the item has expired."><i></i>Return</a>
                     </li>
                     <li class="buttons"><a class="op-write-review" href="#" title="Review this product">Review Product</a></li>
                  </ul>
               </td>
            </tr>
            <!-- Offers applied section --> <!-- Row for bundle items --> 
            <tr class="buttons_row last">
               <td colspan="4">
                  <div class="button_container"></div>
               </td>
            </tr>
            <!-- Row for Giftwrap charge --> <!-- Row for EMI charge --> <!-- Total --> 
            <tr class="total-row">
               <td colspan="4" class="padding10" align="right">
                  Total <span class="order_total">Rs. 6999</span> 
               </td>
            </tr>
         </tbody>
      </table>
   </div>
</div>
<?php } } ?>		
		</fieldset>
</body>
<?php include "includes/footer.php"; ?>