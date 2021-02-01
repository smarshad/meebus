<?php include_once("includes/header.php"); ?>

<script src="../js/pagination.js" type="text/javascript"></script>

<body onLoad="edit_courier();">
<div class="order-details-MP order-details-bottom order-actions">
   <div class="table-head padding10">
      ORDER RECEIPT
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

<div class="fk-inf-scroll-item order physical">
   <div class="line order-expanded">
      <div class="unit size1of4"> <a class="orderIdBtn btn btn-medium btn-blue" target="_blank" href="#">OD506946679023784000</a> </div>
      <div class="unit size3of5"> </div>
      <div class="lastUnit text_right">
         <div class="button-bar" title="Track this order"> <a class="track" target="_blank" href="#"><i></i>Track</a> </div>
      </div>
   </div>
   <div class="line js-order-details">
      <div class="line order-item ">
         <div class="line order-item-inner">
            <div class="unit size1of8 fk-text-center product-image"> <a href="#" target="__blank"> <img class="item-image" src="images/dummy.png" alt="Bosch AQT 35-12 Electric Pressure Washer"> </a> </div>
            <div class="unit size2of7">
               <a target="_blank" href="#">
               Bosch AQT 35-12 Electric Pressure Washer </a> 
               <p class="smallText tmargin10">
                  Qty: 1 &nbsp;
                  <br>Seller: RetailNet 
               </p>
            </div>
            <div class="unit size1of6">
               <div class="lpadding10">
                  Rs. 8299 
                  <p class="tmargin10 fk-font-small"> <span class="offers">OFFERS:</span> 1 </p>
               </div>
            </div>
            <div class="unit size2of7">
               <p class="greyText bmargin10">
                  Delivered on Fri, 2nd Sep'16 
               </p>
            </div>
            <div class="lastUnit text_right"> </div>
         </div>
      </div>
      <div class="line order-total">
         <div class="line">
            <div class="unit size2of5"> <span class="smallText fk-inline-block">Date:</span> Wed, 31st Aug'16 </div>
            <div class="lastUnit text_right"> <span class="smallText">Order Total:</span> <strong>Rs.8299</strong> </div>
         </div>
      </div>
   </div>
</div>
        
</body>
<?php include "includes/footer.php"; ?>