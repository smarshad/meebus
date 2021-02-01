<?php 
include_once "header.php";
$user_id=$_SESSION['user']['log']['id'];
if(isset($_POST['submit']) && $_POST['submit']=='Submit')
{
	$walletamn=$_POST['wallet'];
	$data=array($walletamn);
}
?>
<style type="text/css">
	table {
		padding: 0;
		font-size: 13px;
	}
#formContent a {
  color: #000;
  display:inline-block;
  text-decoration: none;
  font-weight: 400;
}
#formContent h2.headings {
  text-align: center;
  font-size: 20px;
  font-weight: 600;
  text-transform: uppercase;
  display:block;
  
  color: #000;
 
}
/* STRUCTURE */

#formContent {
  margin: 0px auto;
  border-radius: 10px 10px 10px 10px;
  background: #EFEEEE;
  padding: 4px;
  width: 83%;
  max-width: 450px;
  position: relative;
  text-align: center;
}

#formFooter {
  background-color: #EFEEEE;
  border-top: 1px solid #fff;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}



/* TABS */

h2.inactive {
  color: #cccccc;
}

h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5fbae9;
}
/* FORM TYPOGRAPHY*/
input[type=button], input[type=submit], input[type=reset]  {
  background-color: #E72E33;
  border: none;
  color: white;
  padding: 7px 18px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  font-size: 15px;
  border-radius: 5px 5px 5px 5px;
  margin: 5px 20px 40px 20px;
  transition: all 0.3s ease-in-out;
}
input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
  background-color: #fff;
  color:#E72E33;
  border-color:#E72E33;
}

input[type=text], input[type=password] {
  background-color: #fff;
  border: none;
  color: #0d0d0d;
  padding: 9px 14px;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 78%;
  border: 2px solid #f6f6f6;
  border-radius: 5px 5px 5px 5px;
}
input[type=text]:focus {
  background-color: #fff;
  border-bottom: 2px solid #5fbae9;
}
input[type=text]:placeholder {
  color: #cccccc;
}

</style>

<div class="inner-content">

<div id="formContent">
<h2 class="headings"> Add Wallet </h2>
<form name="frm_search" id="frm_search" action="atom/payment-wallet.php" method="POST">
      <input type="text" name="wallet" id="wallet" class="textbox_login fadeIn second" placeholder="Enter Wallet Amount" maxlength="4"> 
      <input type="submit" name="submit" id="submit" value="Submit" style="display: block;margin: 20px auto;" />
   </form>

   
</div>
</div>
<div class="main-body" style="margin-bottom: 25px;">
<div class="table-responsive">          
   <table class="table table-striped" border="0" cellspacing="0" cellpadding="0">
                                        <thead>
                                            <tr>
                                            	<th>S. No</th>
                                                 <th>Mode</th>
                                                  <th>Amount</th>
                                                  <th>Balance</th>
                                                 <th>Description</th>
                                                  <th>Status</th>
                                                  <th>Created Date</th>
                                                 </tr>
                                        </thead>
   									 <tbody>
                              			<?php 
											$i=1; 
											$adminRes=$obj->gettransactionlist(array($user_id));  
											//echo '<pre>';print_r($adminRes);echo '</pre>';
											foreach($adminRes as $res)
											{	
											?>
											<tr>
											  <td><?php echo $i; ?></td>
											  <td><?php echo $res['mode']; ?></td>
											  <td><?php echo $res['amount']; ?> </td>
											  <td><?php echo $res['balance']; ?></td>
											  <td><?php echo $res['description'];?></td>
											  <td><?php echo $res['book_status']; ?></td>
											  <td><?php echo $res['created_datetime']; ?></td>
											 
											<?php $i++; } ?>
    </tbody>
  </table>
  </div>
</div>
<script>
$("#submit").click(function ()
{
	var wallet=$("#wallet").val();
	if(wallet=='')
	{
		 alert("Please Enter Wallet Amount");
		 return false;
	}
	$( "#frm_search" ).submit();
});
</script>
<?php include_once("includes/footer.php"); ?> 