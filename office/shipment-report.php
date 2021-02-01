<?php
include_once("includes/header.php");
if(isset($_POST['submit']) && $_POST['submit'] == 'Submit')
{
	$status_type=$_POST['status_type'];
		
	$res="SELECT * FROM tbl_courier WHERE status='$status_type'"; 
	$result = mysql_query($res);			
}
?>
<script type="text/javascript">
function printthis()
{
 var w = window.open('', '', 'width=800,height=600,resizeable,scrollbars');
 w.document.write($("#table1").html());
 w.document.close(); // needed for chrome and safari
 javascript:w.print();
 w.close();
 return false;
}
</script>

<script>
$('#orgin').typeahead({
    name: 'orgin',
	 remote: {
            url : 'includes/source.php?query=%QUERY'
        },
    minLength: 1, // send AJAX request only after user type in at least 3 characters
    limit: 10 // limit to show only 10 results
});
$('#destination').typeahead({
    name: 'destination',
	 remote: {
            url : 'includes/destination.php?query=%QUERY'
        },
    minLength: 1, // send AJAX request only after user type in at least 3 characters
    limit: 10 // limit to show only 10 results
});
</script>
<body onLoad="search_Usr();">

<fieldset class="table-bor">

		<legend><strong>Shipment Report </strong></legend> 
		<form method="post">
		<table width="100%" border="0" cellspacing="2" cellpadding="5">
<tr>		
			
				
			<td width="5%" align="center"> Status</td>
			<td>
			    <select name="status_type" id="status"  class="combobox-small">
                    <option value="">Select Status</option>				
                    <option value="In Transit">In Transit</option>
                    <option value="Delayed">Delayed</option>
                    <option value="Pending">Pending</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Completed">Completed</option>
				</select>
			</td>
            <td>
			    <input type="text" placeholder="Orgin" id="orgin" name="orgin" />
			</td>
             <td>
			    <input type="text" placeholder="Destination" id="destination" name="destination" />
			</td>
             <td>
			    <select name="status" id="status"  class="combobox-small" style="width:150px;">
                    <option value="0">Normal</option>
                    <option value="1">Speed </option>
                    <option value="2">One day</option>
				</select>
			</td>
            <td><input type="submit" name="submit" id="submit" value="Submit"></td>
			
		  </tr>	

		</table>
</form>
		
		<hr/>
		
		<a href="" onClick="printthis(); return false;"><img src="images/print.png" width="20" height="20"></a>

  <br>


  <br>
<?php 
if(isset($_POST['submit'])){
while($data=mysql_fetch_array($result))
{
	//echo "<pre>";print_r($data);echo "</pre>";
?>  
<div class="fk-inf-scroll-item order physical">
   <div class="line order-expanded">
      <div class="unit size1of4"> <a class="orderIdBtn btn btn-medium btn-blue" target="_blank" href="#"><?php echo $data['invice_no']; ?></a> </div>
      <div class="unit size3of5"> </div>
      <div class="lastUnit text_right">
         <div class="button-bar" title="Track this order"> <a class="track" target="_blank" href="#"><i></i>Track</a> </div>
      </div>
   </div>
   <div class="line js-order-details">
      <div class="line order-item ">
         <div class="line order-item-inner">
            <div class="unit size1of8 fk-text-center product-image"> <a href="#" target="__blank"> 
            <img class="item-image" src="images/dummy.png" alt="dummy"> </a> </div>
            <div class="unit size2of7">
               <a target="_blank" href="#">
               <?php echo $data['ship_name']; ?> </a> 
               <p class="smallText tmargin10">
                  Qty: <?php echo $data['qty']; ?> &nbsp;
                  <br>Seller: <?php echo 'S'.$data['qty']; ?> 
               </p>
            </div>
            <div class="unit size1of6">
               <div class="lpadding10">
                  Rs. <?php echo '8299'.$data['qty']; ?>  
                  <p class="tmargin10 fk-font-small"> <span class="offers">OFFERS:</span> <?php echo 'S'.$data['qty']; ?> </p>
               </div>
            </div>
            <div class="unit size2of7">
               <p class="greyText bmargin10">
                  Delivered on <?php echo $data['pick_date']; ?>
               </p>
            </div>
            <div class="lastUnit text_right"> </div>
         </div>
      </div>
      <div class="line order-total">
         <div class="line">
            <div class="unit size2of5"> <span class="smallText fk-inline-block">Date:</span> <?php echo date('d-m-Y',strtotime($data['book_date'])); ?> </div>
            <div class="lastUnit text_right"> <span class="smallText">Order Total:</span> <strong>Rs.<?php echo '8299'.$data['qty']; ?></strong> </div>
         </div>
      </div>
   </div>
</div>
<?php } }?>  
  

  <span class="Partext1"><br>
   </span><span class="Partext1"><br>

  <br>  

  </span>
		
		</fieldset>
</body>
<?php include "includes/footer.php"; ?>
