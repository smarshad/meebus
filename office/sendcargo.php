<?php include_once("includes/header.php");

$rand=strtoupper(rand());
if(isset($_REQUEST['sub_upd']))
	{
	
		trim(extract($_POST)) ;
		
		$off=$_SESSION['office'];
		
		 $sql="insert into tbl_courier (cons_no,ship_name,phone,s_add,frmloc,rev_name,r_phone,r_add,toloc,type,weight,qty,book_mode,freight,mode,frmlocint,tolocint,pick_date,pick_time,drivers,status,comments,barcode,add_by,vname,vno) values
		('$ConsignmentNo','$Shippername','$Shipperphone','$Shipperaddress','$frmloc','$Receivername','$Receiverphone','$Receiveraddress','$toloc','$Shiptype','$Weight','$Qnty','$Bookingmode','$Totalfreight','$Mode','$frmlocint','$tolocint','$Packupdate','$Pickuptime','$drivers','$status','$Comments','$barcode','$off','$vname','$vno')";
    	$upd = mysql_query($sql) ;
		$lid=mysql_insert_id();
		
	    $sqls="insert into tbl_courier_track (cons_no,cid,frmlocint,tolocint,status,comments,stat,driver,vname,vno,umode,addby) values
		('$ConsignmentNo','$lid','$frmlocint','$tolocint','$status','$Comments','0','$drivers','$vname','$vno','$umode','$off')";
    	$upds = mysql_query($sqls) ;
	if($upd)
	{
		header("location:add-courier.php?us") ;
	}
	else if($upd)
	{
		header("location:add-courier.php?ue") ;
	}
	
	}
?>
<script type="text/javascript" language="javascript">

		
function fn_hide()
{
	if($("#datepicker1").val() == "Click here")
	{
		$("#datepicker").val('');
	}
}
				
function fn_show_value()
{
	if($("#datepicker").val() == "")
	{
		$("#datepicker").val('Click here');
	}
}

	$(function() {
	var dateFormat;
	try{
    dateFormat= $( ".selector" ).datepicker( "option", "dateFormat" );
	}
	catch(e){ }
	//minDate: +0, 
	//showOn: 'button',
		$('#datepicker').datepicker({ 		
			numberOfMonths: 1, 
			showButtonPanel: false, 			
			maxDate: '+3M +0D', 			 
			buttonImage: '../images/calendar_icon.gif', 
			buttonImageOnly: true, 
		    dateFormat: 'dd/mm/yy'			
		});	
	});
	
	
function clear_text()
{
	document.getElementById('datepicker').value="";
	search_Psr();
}
	
	
</script>
<style>
ul.tabs {margin: 0;padding: 0;float: left;list-style: none;height: 32px;border-bottom: 1px solid #c0c0c0;border-left: 1px solid #c0c0c0;width: 97%;}
ul.tabs li {float: left;margin: 0;padding: 0;height: 31px;line-height: 31px;border: 1px solid #c0c0c0;border-left: none;margin-bottom: -1px;background: #6ead12 url(../images/bg_big-menu.png) repeat-x;
	-webkit-background-size: 100% 100%;
	-moz-background-size: 100% 100%;
	-o-background-size: 100% 100%;
	background-size: 100% 100%;
	background: -webkit-gradient(linear, left top, left bottom, from(#b1d322), to(#6ead12));
	background: -webkit-linear-gradient(top, #b1d322, #6ead12);
	background: -moz-linear-gradient(top, #b1d322, #6ead12);
	background: -ms-linear-gradient(top, #b1d322, #6ead12);
	background: -o-linear-gradient(top, #b1d322, #6ead12);
	background: linear-gradient(top, #b1d322, #6ead12);overflow: hidden;position: relative;}
ul.tabs li a {text-decoration: none;color: #000;display: block;padding: 0 20px;border: 1px solid #fff;outline: none;}
ul.tabs li a:hover {background: #ccc;}
ul.tabs li {
    text-decoration: none;
    color: #fff;
    display: block;
    padding: 0 20px;
    outline: none;
}
html ul.tabs li.active, html ul.tabs li.active a:hover  {background: #fff;color: #000;}

.tab_container {	border: 1px solid #c0c0c0;border-top: none;clear: both;float: left; width: 97%;background: #fff;
-webkit-border-radius: 0px 0px 5px 5px;-moz-border-radius: 0px 0px 5px 5px;border-radius: 0px 0px 5px 5px;}

.tab_content {padding: 20px;}
.tab_content h2 {padding-bottom: 5px;border-bottom: 1px dotted #ddd; margin-bottom: 10px; }
.tab_content h3 a{color: #254588;}
.tab_content p { padding-bottom: 12px; }
.tt-hint{display:none}
.right-content.inner, .right-content1.inner {
	background: none;
	box-shadow: none;
	border: 0;
}
.twitter-typeahead input {
	vertical-align: inherit !important;
}
</style>
<script src="../js/pagination.js" type="text/javascript"></script>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
 <script src="../js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../js/typeahead.min.js"></script>
<body>
<fieldset class="table-bor">

		<legend><strong>Send Package</strong></legend> 
		<form action="addcargo.php" method="post" name="usr_add">
        <div class="right-content inner" style="width: 100%;">
        <div style="margin-bottom: 25px;">
            <input type="radio" name="transferType" value="1" checked>Customer To Customer<input type="radio" value="2" name="transferType">Agent To Agent

            <input type="text" name="destination" id="destination" placeholder="Destination" style="width:90%;border:1px solid #ABADB3">
            <select id="serviceType" name="serviceType" style="width:15%">
            	<option value="">-- Type of Service --</option>
                <?php
				$serviceqry=mysql_query("SELECT * FROM servicetype WHERE status=1");
				$servicDetails=mysql_fetch_array($serviceqry);
/*				foreach($servicDetails as $ser)
				{
*/				?>
				<option value="<?php echo $servicDetails['serviceCode']; ?>"><?php echo $servicDetails['serviceType']; ?></option>
                <?php
			//	}
				?>
        	</select>
        </div>
        

         <div style="width:24%;float:left; padding-right:1%;">
          <div class="gentxt" align="right">
                <div class="headtext13" align="left"><strong>Consignor's Info : </strong></div>
            </div>
            <input name="consignor_name" id="consignor_name"  maxlength="100" placeholder="Consignor's Name" size="40" type="text"><br/>
            <textarea name="consignor_address" cols="27" rows="7" placeholder="Address" id="Shipperaddress"></textarea><br/>
            <input name="consignor_pincode" id="consignor_pincode"  maxlength="100" placeholder="Pincode" size="40" type="text"><br/>
            <input name="consignor_mobile" id="consignor_mobile" placeholder="Mobile Number" maxlength="10" size="40" type="text"><br/>
            <input name="consignor_email" id="consignor_email" placeholder="E-Mail Id" size="100" type="text"><br/>
            <input name="consignor_phone" id="consignor_phone" placeholder="Phone Number" maxlength="13" size="40" type="text"><br/>
          </div>
           <div style="width:24%;float:left;padding-right:1%;">
          <div class="headtext13" align="left"><strong>Consignee  info : </strong></div>
            <input name="consignee_name" id="consignee_name" placeholder="Receiver Name" type="text"><br/>
           	<textarea name="consignee_address" cols="27" rows="7" placeholder="Address" id="consignee_address"></textarea><br/>
            <input name="consignee_pincode" id="consignee_pincode"  maxlength="100" placeholder="Pincode" size="40" type="text"><br/>
            <input name="consignee_mobile" id="consignee_mobile" placeholder="Mobile Number" maxlength="10" size="40" type="text"><br/>
            <input name="consignee_email" id="consignee_email" placeholder="E-Mail Id"  size="100" type="text"><br/>
            <input name="consignee_phone" id="consignee_phone" placeholder="Phone" maxlength="13" size="40" type="text"><br/>
          </div>
           <div style="width:24%;float:left;padding-right:1%;">
          <div class="headtext13" align="left"><strong>Insurance : </strong></div>
          <input type="radio" name="insurd" id="not_ins" checked value="0"/>Not Insured<br/>
          <input type="radio" name="insurd" id="ins" value="1"/>Insured
        <input name="company" id="company" placeholder="Company" maxlength="100" size="40" type="text"><br/>
         <input name="policy_no" id="policy_no" placeholder="Policy No" maxlength="13" size="40" type="text"><br/>
        <input name="DT" id="DT" placeholder="Dt" maxlength="13" size="40" type="text"><br/>
            <input name="amount" id="amount" placeholder="Amount" maxlength="13" size="40" type="text"><br/>
          <textarea name="risk" cols="27" rows="2" placeholder="Risk" id="risk"></textarea><br/>
          </div>
           <div style="width:24%;float:left;right:1%;margin-top:60px; margin-left:10px;">
          <div align="left"><strong>REFERENCE NUMBER </strong></div>
            <label><h2 style="margin-top: 10px; margin-bottom: 15px; color: #6EAD12;"><?php 
			if(isset($_SESSION['cargo']['office']['ReferenceNo']))
			unset($_SESSION['cargo']['office']['ReferenceNo']);
			echo $_SESSION['cargo']['office']['ReferenceNo']=$officeLocationCode.time().'AX'.$offid; ?></h2></label><br/>
            <div class="headtext13" align="left"><strong>Delivery Type : </strong></div>
            <input type="radio" name="type_dli"  value="DD">Door Delivery<br/>
            <input type="radio" name="type_dli" value="RC" checked>Recived By Consignee <br/>
          </div>
        </div>
<ul class="tabs">
	    <li id="packTab">Package Info</li>
	    <li id="paymentTab">Payment Info</li>
	    <li id="deliveryTab">Delivery Info</li>
    </ul>
    <div class="tab_container">
	    <div id="tab1" class="tab_content">
	            <div class="right-content1 inner" style="width:100%;">
                <a href="#" style="display:none"><img src="images/add.png" width="30"></a>
	    <select id="Shiptype" name="Shiptype">
    	    <option value="" selected="selected">Type of Package</option>
            <?php
				$packageqry=mysql_query("SELECT * FROM packagetype WHERE status=1");
				$packageDetails=mysql_fetch_array($packageqry);
/*				foreach($packageDetails as $pac)
				{
*/				?>
				<option value="<?php echo $packageDetails['package_code']; ?>"><?php echo $packageDetails['package_type']; ?></option>
                <?php
			//	}
				?>
        </select>
        <textarea name="pack_desc" cols="27" rows="7" placeholder="Package Description" id="pack_desc"></textarea>
        <input type="file" id="Totalfreight" name="Totalfreight" style="padding: 5px;">
        <br clear="all"/>
        <div style="margin:7px">
        <strong>Measurment In</strong>
        <input type="radio" name="measurement" value="cm" checked>Centimeter
        <input type="radio" name="measurement" value="mtr" checked>Meter
        </div>
        <input type="text" id="length" placeholder="Length" size="10" maxlength="10" name="length">    
        <input type="text" id="width" placeholder="Width" size="10" maxlength="10" name="width">    
        <input type="text" id="height" placeholder="Height" size="10" maxlength="10" name="height">  
        <br clear="all"/>  
        <strong>Package Weight & Quantity</strong>
         <br clear="all"/> 
        <input type="text" id="weight" placeholder="Gross weight (in KG)" size="10" maxlength="10" name="weight">
        <input type="text" name="Qnty" id="Qnty" placeholder="Qnty" maxlength="10" size="20">        
        <br clear="all"/>
        <div style="text-align:center"><input type="button" id="getPayment" value="Payment Info >" /></div>
        </div>
	    </div>
	
	    <div id="tab2" class="tab_content">
			<div class="right-content1 inner" style="width:100%;">
			<div id="PriceSection" class="pay-info">
            </div>
        
           <div style="text-align:center">
           <input type="button" name="showPackage" id="showPackage" value="< Package Info">
           <input type="button" name="showDelivery" id="showDelivery" value="Delivery Info >">
           </div>           
	    </div>
		</div>
	    <div id="tab3" class="tab_content">
			<div class="right-content1 inner" style="width:100%;">
            <div class="headtext13" align="left">
            </div>
                 <div id="DeliverySection">
                 </div>
                   <input type="button" name="showPackage1" id="showPackage1" value="< Package Info">
                   <input type="submit" name="confirm" id="confirm" value="Confirm">
                 
            </div>
	    </div>
	
	</div>
               
		</form>
		
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
$('#destination').typeahead({
    name: 'destination',
	 remote: {
            url : '../includes/source.php?query=%QUERY'
        },
    minLength: 3, // send AJAX request only after user type in at least 3 characters
    limit: 10 // limit to show only 10 results
});
</script>
<script>
	$(document).ready(function() {
		//Default Action
		$(".tab_content").hide();
		$("ul.tabs li:first").addClass("active").show();
		$(".tab_content:first").show(); 
	
		//On Click Event
			$("#getPayment").click(function() {
				var mes=$("input[name=measurement]:checked").val();
				var length=$("#length").val();
				var width=$("#width").val();
				var height=$("#height").val();
				var weight=$("#weight").val();
				var Qnty=$("#Qnty").val();
				var serviceType=$("#serviceType").val();
				var type_dli=$("input[name=type_dli]:checked").val();
				var origin=$("#origin").val();
				var destination=$("#destination").val();
				if(length!='' && width!='' && height!='' && weight!='' && Qnty!='' && serviceType!='' && type_dli!='' && origin!='' && destination!='')
				{
					$("#PriceSection").html( "<p style='text-align:center; font-weight:bold; color: green;'>Please Wait...</p>" );
				$.post( "../includes/calc_price.php?mes="+mes+"&length="+length+"&width="+width+"&height="+height+"&weight="+weight+"&Qnty="+Qnty+"&serviceType="+serviceType+"&type_dli="+type_dli+"&origin="+origin+"&destination="+destination, function( data ) {
					var arr=data.split('^^');
				  $( "#PriceSection" ).html( arr[0] );
				  $( "#DeliverySection" ).html( arr[1] );
				});
				$("ul.tabs li").removeClass("active");
				$("#paymentTab").addClass("active").show();
				$(".tab_content").hide();
				$("#tab2").fadeIn();
				return false;
			}
			else
			{
				alert("Please Enter All Fields");
				return false;
			}
		});
		$("#showPackage").click(function() {
		$("ul.tabs li").removeClass("active");
			$("#packTab").addClass("active").show();
			$(".tab_content").hide();
			$("#tab1").fadeIn();
			return false;
		});
		$("#showPackage1").click(function() {
		$("ul.tabs li").removeClass("active");
			$("#packTab").addClass("active").show();
			$(".tab_content").hide();
			$("#tab1").fadeIn();
			return false;
		});
		$("#showDelivery").click(function() {
			$("ul.tabs li").removeClass("active");
			$("#deliveryTab").addClass("active").show();
			$(".tab_content").hide();
			$("#tab3").fadeIn();
			return false;
		});
	});
	
$(document).ready(function(){
	$('#company').prop("disabled", true);
	$('#risk').attr("disabled", true);
	$('#amount').attr("disabled", true);
	$('#DT').attr("disabled", true);
	$('#policy_no').attr("disabled", true);
    $("#not_ins").click(function(){
		$('#company').attr("disabled", true);
		$('#risk').attr("disabled", true);
		$('#amount').attr("disabled", true);
		$('#DT').attr("disabled", true);
		$('#policy_no').attr("disabled", true);
    });
    $("#ins").click(function(){
		$('#company').attr("disabled", false);
		$('#risk').attr("disabled", false);
		$('#amount').attr("disabled", false);
		$('#DT').attr("disabled",false);
		$('#policy_no').attr("disabled", false);
    });
});	
</script>