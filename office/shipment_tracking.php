<?php
include_once("includes/header.php");
?>
<style>
	.fk-text-center{text-align:left}
	.order-details-MP .orderDetails-tracking .item-img-div{width:250px}
	.unit h6{margin:5px 0;font-size:12px}
	.order_item_row_0 .vtop.product-info .prod {width: 25%;}				  
	.order_item_row_0 .vtop.product-info .gran {width: 8%;}
	.order_item_row_0 .vtop.product-info .del {width: 22%;}
	.order_item_row_0 .vtop.product-info .sub {width: 17%;}
	li.send_shipdet{width:25%;float:left;padding:10px 0}
	.tt-dropdown-menu {top: 38px !important;width: 173px;}
</style>  
<script src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/typeahead.min.js"></script>

<fieldset class="table-bor">
<legend><strong>Shipment Tracking</strong></legend> 
<form action="" method="post" autocomplete="off">
  <table border="0" align="center" width="98%">
    <tbody>
    <tr>
      <td class="Partext1" align="right"><strong> AWS Number</strong></td>
       <td><input type="text" name="srch" style="width: 50%"></td>
    </tr>
    <tr>
      <td class="Partext1" align="center"></td>
       <td><input type="submit" name="submit" value="Search"></td>
    </tr>
  </tbody>
 </table>
 </form>		

<?php if(isset($_POST['submit']) && $_POST['submit']=='Search') { 
$aws_no=$_POST['srch'];
$result=mysql_query("SELECT * FROM cargotracking WHERE aws_no='$aws_no'");	
//echo "<pre>";print_r($result);echo "</pre>";exit;

while($data = mysql_fetch_assoc($result))
{ 

$sourceId=$data['lastLocation'];
$sel=mysql_query("SELECT code,location FROM cargo_cities WHERE id='$sourceId'");
$sourceLoc=mysql_fetch_assoc($sel);
$source=implode('-',$sourceLoc);

$destId=$data['NextLocation'];
$sel1=mysql_query("SELECT code,location FROM cargo_cities WHERE id='$destId'");
$destLoc=mysql_fetch_assoc($sel1);
$dest=implode('-',$destLoc);

?>	
<div class="order-details-MP order-details-bottom tmargin20">
   <div class="orderDetails-tracking tmargin10 line">
   <form method="post" action="" autocomplete="off">
      <table class="order-details-table bmargin15" width="100%" cellspacing="0" cellpadding="0" align="left">
         <tbody>
            <tr class="caption nondigital order_item_row_0" align="left">
               <th colspan="5" class="vtop product-info" align="left">
                  <div class="table-head clearfix">
                     <div class="heads prod"> <span class="text">Source</span> </div>
                     <div class="heads prod"><div class="detail appr">Destination</div></div>
                     <div class="heads del"> <span class="text">Status</span> </div>
                  </div>
               </th>
            </tr>
            <!-- List of items to display --> 
            <h4>AWS Number : <?php echo $data['aws_no']; ?></h4>
            <tr class="order_item_row_1" align="left">
               <!-- Column 1 --> 
               <td class="vtop item-details" width="25%">
                  <div class="line">                
                     <div class="unit item-img-div fk-text-center"> 
                    <h6><?php echo $source; ?></h6>
                    <h6><?php echo '( Departure Date ) : ' .$data['departDateTime']; ?></h6>
                      </div>                     
                  </div>
               </td>
               <!-- Column 2 --> 
               <td class="vtop item-details" width="25%">
                  <div class="line">                
                     <div class="unit item-img-div fk-text-center"> 
                    <h6><?php echo $dest; ?></h6>
                    <?php if($data['status'] == 'Received') { ?>
                    <h6><?php echo $data['receivedDateTime']; ?></h6>
                    <?php } else { ?>
                      <h6><?php echo '( Expected Arrival Date ) : ' . $data['expectedArrivalDate']; ?></h6>
                      <?php } ?>
                      </div>                     
                  </div>
               </td>
               <!-- Column 3 -->
               <td class="vtop item-shipment" width="50%">
                  <div class="graph lpadding10 tpadding5">
                     <div class="unit item-img-div fk-text-center">
                     <h3 align="center"><?php echo $data['status']; ?></h3>
                     </div>
                  </div>
               </td>
               <!-- Column 4 --> 
               <td>&nbsp;</td>
            </tr>
         </tbody>
      </table>
      </form>
   </div>
</div>	
<?php } } ?>
		</fieldset>
</body>
<?php include "includes/footer.php"; ?>
<script>
$('#origin').typeahead({
    name: 'cabdest',
	 remote: {
            url : '../includes/source.php?query=%QUERY'
        },
    minLength: 3, // send AJAX request only after user type in at least 3 characters
    limit: 10 // limit to show only 10 results
});
</script>