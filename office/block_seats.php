<?php
include "includes/header.php";

echo "<h2>Block / Unblock Seats</h2>";
//print_r($_REQUEST);
$bid;
if(isset($_REQUEST['sp_id']) && isset($_REQUEST['bus_id']) && isset($_REQUEST['dat'])){
   $SP_id=mysql_real_escape_string($_REQUEST['sp_id']);
   $Bus_id=mysql_real_escape_string($_REQUEST['bus_id']);
   $dat=mysql_real_escape_string($_REQUEST['dat']);
   $bid=$Bus_id;
   ?>
   
 <?php
 
$qry=mysql_query("SELECT * FROM businfo WHERE Bus_id=".$Bus_id);
if(mysql_num_rows($qry)>0){
   $bus=mysql_fetch_object($qry); 

$structureid=mysql_real_escape_string($bus->Bus_structure); 
 
$str_sql=mysql_query("SELECT * FROM busstructuretypes WHERE structureStatus = 1 ORDER BY structureID ");
while($strtypes=mysql_fetch_array($str_sql)){
      if($bus->Bus_structure == $strtypes['structureID']){
	     $struct_ID=$strtypes['structureID'];
		 $struct_Name=$strtypes['structureType'];
		 
		 $upper_seat=$strtypes['upper_seat'];
		 $upper_left_col=$strtypes['upper_left_col'];
		 $upper_left_row=$strtypes['upper_left_row'];
		 $upper_left_type=$strtypes['upper_left_type'];
		 $upper_right_col=$strtypes['upper_right_col'];
		 $upper_right_row=$strtypes['upper_right_row'];
		 $upper_right_type=$strtypes['upper_right_type'];
		 
		 $lower_left_col=$strtypes['lower_left_col'];
		 $lower_left_row=$strtypes['lower_left_row'];
		 $lower_left_type=$strtypes['lower_left_type'];
		 $lower_right_col=$strtypes['lower_right_col'];
		 $lower_right_row=$strtypes['lower_right_row'];
		 $lower_right_type=$strtypes['lower_right_type'];
	  }
 } 
}
 ?>   
<style type="text/css">
	.iCheckbox_container {
		height:27px;
		width:94px;
		position: relative;
		overflow: hidden;
	}
	.iCheckbox_switch {
		height:27px;
		width:94px;
		background-image:url(iphone_switch.png); /* your actual slider image */
		background-repeat:none;
		background-position:0px;
	}
	.iCheckbox_checkbox { /* this is kinda moot since it gets hidden, but here to let you know it exists */
	}
	.iCheckbox_two_container {
		height:27px;
		width:94px;
		position: relative;
		overflow: hidden;
	}
	.iCheckbox_two_switch {
		height:16px;
		width:36px;
		background-image:url(bpm-lozenge.png); /* your actual slider image */
		background-repeat:none;
		background-position:0px;
	}
	.iCheckbox_two_checkbox { /* this is kinda moot since it gets hidden, but here to let you know it exists */
	}
	/*
	* below are styles to just pretty up the demo page... they have nothing to do with iCheckbox.
	*/
	.body_conts{
		width:800px;
		margin:0px;
		margin-left:auto;
		margin-right:auto;
		
		font-size:12px;
	}
	.magic_pink {
		background-color: #FF00FF;
		padding: 5px;
		margin:0px;
	}
	</style>
<style type="text/css">

/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */

.cssbutton{
background-color: #deedfa;
border: 2px #deedfa outset;
padding: 1px 4px;
color: black;
text-decoration: none;
font: bold 90% "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
}

.cssbutton:visited{
color: black;
}

.cssbutton:hover{
border-style: inset;
background-color: #BDE6F3;
padding: 2px 3px 0 5px; /*shift text 1px to the right and down*/
color:#3366FF;
}

.cssbutton:active{
color: black;
}

</style>	
<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript">
	$(function() {
	var dateFormat;
	try{
    dateFormat= $( ".selector" ).datepicker( "option", "dateFormat" );
	}
	catch(e){ }
	
		$('#dat').datepicker({ 		
			numberOfMonths: 1, 
			showButtonPanel: false, 
			minDate: +0, 
			maxDate: '+3M +0D', 
			//showOn: 'button', 
			buttonImage: '../images/calendar_icon.gif', 
			buttonImageOnly: true, 
		    dateFormat: 'dd-mm-yy'
			
		});	
		
		$('#dat1').datepicker({ 		
			numberOfMonths: 1, 
			showButtonPanel: false, 
			minDate: +0, 
			maxDate: '+3M +0D', 
			//showOn: 'button', 
			buttonImage: '../images/calendar_icon.gif', 
			buttonImageOnly: true, 
		    dateFormat: 'dd-mm-yy'
			
		});	
	});


function hide_value(){
	if($("#dat").val() == "Select Date"){
		$("#dat").val('');
	}
}
				
function show_value(){
	if($("#dat").val() == ""){
		$("#dat").val('Select Date');
	}
}

</script>
<script src="jquery.iCheckbox.js" type="text/javascript"></script>
<script type="text/javascript">
	// mimic console log for IE - must be careful what to log
	if ( typeof(console) == 'undefined' ) {
		var console = {};
	}
	if ( typeof(console.log) !== 'function' ) {
		console['log'] = function ( msg ) {
		}
	}

	// init the checkboxes at dom ready
	
	function fun_chk(chk_id,status){	
		$(document).ready( function () {		
			var checkTwoOpts = {
				switch_container_src: 'bpm-frame.gif',
				class_container: 'iCheckbox_two_container',
				class_switch: 'iCheckbox_two_switch',
				class_checkbox: 'iCheckbox_two_checkbox',
				switch_speed: 50,
				switch_swing: -18,
				checkbox_hide: true
				};
				
			var c=chk_id;
			
			if(status==1){
			$('#'+c).iCheckbox("on", checkTwoOpts);		
			}
			else{
			$('#'+c).iCheckbox("off", checkTwoOpts);
			}				
		});
	}

function chgtab(v)
{
//alert(v);
 if(v == 1){
    document.getElementById('show_detail').style.display="block";
	document.getElementById('to_date').style.display="none";
	document.getElementById('block_operation').style.display="none";
	document.getElementById('submit').style.display="block";
 }
 
 if(v == 2){
    document.getElementById('show_detail').style.display="none";
	document.getElementById('to_date').style.display="block";
	document.getElementById('block_operation').style.display="block"; 
	document.getElementById('submit').style.display="none";
 }
}
	</script>
<table cellpadding="5" cellspacing="5">
<tr><td><strong>Service Provider :</strong> <?php echo get_SP_name($_REQUEST['sp_id']); ?></td></tr>
<tr><td><strong>Bus name :</strong> 
<?php 
$sql=mysql_query("SELECT * FROM businfo WHERE Bus_id=".$_REQUEST['bus_id']);
if(mysql_num_rows($sql)){
$arr=mysql_fetch_array($sql);
echo $arr['Bus_name'];
}
?>
</td>
<td><a href="javascript:void(0);" onclick="chgtab(1);" id="st" class="cssbutton active">Show Today</a></td><td><a href="javascript:void(0);" onclick="chgtab(2);" id="bo" class="cssbutton">Block in this day</a></td>
</tr>
<form name="seat_form" id="seat_form" action="" method="post">

<input type="hidden" name="bus_id" id="bus_id" value="<?php echo $Bus_id ?>" />
<input type="hidden" name="travel_date" id="travel_date" value="<?php echo $dat; ?>" />
<input type="hidden" name="sp_id" id="sp_id" value="<?php echo $SP_id; ?>" />

<tr>
<td><strong>From Date:</strong>&nbsp;
<input  type="text" name="dat" id="dat" class="textbox" 
<?php if(isset($_REQUEST['dat'])){ echo 'value="'.mysql_real_escape_string($_REQUEST['dat']).'"'; } ?> readonly="readonly" onchange="fun();" />

</td>
<td>
<span id="to_date" style="display:none;">
<strong>To Date:</strong>
<input  type="text" name="dat1" id="dat1" class="textbox" 
<?php if(isset($_REQUEST['dat1'])){ echo 'value="'.mysql_real_escape_string($_REQUEST['dat1']).'"'; } ?> readonly="readonly" onchange="fun();" />
<sub>(optional)</sub></span>
</td>
<td>
<input type="submit" name="submit" id="submit" value="Search" /></td>
</td>
</tr> 
</form>
</table>
<?php
$chk_seatcountSQL=mysql_query("SELECT seat_no FROM bus_structure WHERE bus_id=".$Bus_id);
$c=mysql_num_rows($chk_seatcountSQL);
if($c>0){
?>
<span id="block_operation" style="display:block;">
	
					<span id="show_detail">
                    
                    <div id="chg_struct">
   
    <input type="hidden" name="bus_id" value="<?php echo $bus_id; ?>">
    <?php $seatCount1=1;  $seatCount =1; if($upper_seat=='1') { ?>
    <table cellpadding="3" cellspacing="5" border="0" width="770px;" style="border:1px solid #A2BAE6;">
    <tr>
      <td valign="top" width="35">Upper <br/> Seat <br/> Layout</td>
      <td valign="top">
      
      
      
      
      <table cellpadding="3" cellspacing="5" border="0" width="100%" bgcolor="#FFFFFF" id="chk_seats">
        
        
    
	<table id="chk_seats" class="normal">

    <tr>
    <td align="left">
    <table style="box-shadow:none;">
    <?php $r=0; for($up_lr=1; $up_lr<=$upper_left_row; $up_lr++) { ?>
	<tr>
  		<?php  for($up_lc=1; $up_lc<=$upper_left_col; $up_lc++) {
			if($upper_left_type=='sleeper') { $width ='50px'; } else {  $width ='20px'; } 
			$r=$r+1;				
		 	$owsel1 = "SELECT * FROM  bus_structure WHERE bus_id=".$Bus_id." AND position=".$r;
			$sql=mysql_query($owsel1);
			$seat=mysql_fetch_array($sql);
			$seat_no=$seat['seat_no'];
			$s=checkThisSeat($Bus_id,changedateformat($dat),$seat_no);	
			
			?>
    <td id="loc_<?php echo $seat_no; ?>" <?php if($seat_no=='xx'){ ?> bgcolor="#FFFFFF"<?php } ?>  style="width:<?php echo $width; ?>">
    <strong><?php if($seat_no!='xx'){ echo $seat_no; } ?></strong><br />
									<?php if(!in_array($seat_no,$booked_arr) && $seat_no!='xx'){ ?>
									<input type="checkbox" id="seat_<?php echo $seat_no; ?>" style="display:none;" />
									<script type="text/javascript">										
									var s='<?php echo $seat_no; ?>';							
									fun_chk('seat_'+s,<?php echo $s ?>);
									</script>	
    </td>
		<?php  } $seatCount1++; $seatCount++; } ?>
    </tr>
    <?php  } ?>
    </table>
    <table style="box-shadow:none;">
    <?php  for($up_lr=1; $up_lr<=1; $up_lr++) { ?>
	<tr>
  		<?php  for($up_lc=1; $up_lc<=$upper_right_col; $up_lc++) {
			if($upper_right_type=='sleeper') { $width ='50px'; } else {  $width ='20px'; } 
			$r=$r+1;				
		 	$owsel1 = "SELECT * FROM  bus_structure WHERE bus_id=".$Bus_id." AND position=".$r;
			$sql=mysql_query($owsel1);
			$seat=mysql_fetch_array($sql);
			$seat_no=$seat['seat_no'];
			$s=checkThisSeat($Bus_id,changedateformat($dat),$seat_no);	
			?>
    <td id="loc_<?php echo $seat_no; ?>" <?php if($seat_no=='xx'){ ?> bgcolor="#FFFFFF"<?php } ?>  style="width:<?php echo $width; ?>" align="right">
    	<input type="text" value="" <?php if($up_lc==$up_lc) { ?> readonly="readonly" <?php } ?> name="s<?php echo $seatCount; ?>" style="width:<?php echo $width; ?>;<?php if($up_lc==$up_lc) { ?> text-align:center; border:#FFF;  background:#fff; color:#FFF; <?php } ?> " id="s<?php echo $seatCount; ?>" >
        <input type="hidden"  name="rc<?php echo $seatCount; ?>" id="rc<?php echo $seatCount; ?>" value="<?php echo 'UM,'.$up_lr.','.$up_lc; ?>">
        </td>
		<?php $seatCount++; } ?>
    </tr>
    <?php  } ?>
    </table>
	<table style="box-shadow:none;">
	 <?php  for($up_lr=1; $up_lr<=$upper_right_row; $up_lr++) { ?>
	<tr>
  		<?php  for($up_lc=1; $up_lc<=$upper_right_col; $up_lc++) { 
		if($upper_right_type=='sleeper') { $width ='50px'; } else {  $width ='20px'; } 
		$r=$r+1;				
		 	$owsel1 = "SELECT * FROM  bus_structure WHERE bus_id=".$Bus_id." AND position=".$r;
			$sql=mysql_query($owsel1);
			$seat=mysql_fetch_array($sql);
			$seat_no=$seat['seat_no'];
			$s=checkThisSeat($Bus_id,changedateformat($dat),$seat_no);	 ?>
    <td style="width:<?php echo $width; ?>"> <strong><?php if($seat_no!='xx'){ echo $seat_no; } ?></strong><br />
									<?php if(!in_array($seat_no,$booked_arr) && $seat_no!='xx'){ ?>
									<input type="checkbox" id="seat_<?php echo $seat_no; ?>" style="display:none;" />
									<script type="text/javascript">										
									var s='<?php echo $seat_no; ?>';							
									fun_chk('seat_'+s,<?php echo $s ?>);
									</script></td>
		<?php } $seatCount1++; $seatCount++; } ?>
    </tr>
    <?php  } ?>
	</table>

	</td>
    </tr>
	</table>
     
  
   
   		</table>
    
    
    </td>
    </tr>
   
    <tr>
      <td>&nbsp;</td>
      <td><strong>Note: </strong><strong>xx</strong> - empty seat.</td>
    </tr>
    </table>
    <?php } ?>
    <table cellpadding="3" cellspacing="5" border="0" width="770px;" style="border:1px solid #A2BAE6;">
    <tr>
      <td valign="top" width="35"><img border="0" title="bus" alt="bus" src="../images/stearing.gif"><br/>Lower <br/> Seat <br/> Layout</td>
      <td valign="top">
      
      
      
      
      <table cellpadding="3" cellspacing="5" border="0" width="100%" bgcolor="#FFFFFF" id="chk_seats">
        
        
    
	<table>
<tr>
    <td align="left">
    <table style="box-shadow:none;">
    
    <?php for($up_lr=1; $up_lr<=$lower_left_row; $up_lr++) { ?>
	<tr>
  		<?php  for($up_lc=1; $up_lc<=$lower_left_col; $up_lc++) {
			if($lower_left_type=='sleeper') { $width ='50px'; } else {  $width ='20px'; } 
			$r=$r+1;				
		 	$owsel1 = "SELECT * FROM  bus_structure WHERE bus_id=".$Bus_id." AND position=".$r;
			$sql=mysql_query($owsel1);
			$seat=mysql_fetch_array($sql);
			$seat_no=$seat['seat_no'];
			$s=checkThisSeat($Bus_id,changedateformat($dat),$seat_no);	?>
    <td  style="width:<?php echo $width; ?>"> <strong><?php if($seat_no!='xx'){ echo $seat_no; } ?></strong><br />
									<?php if(!in_array($seat_no,$booked_arr) && $seat_no!='xx'){ ?>
									<input type="checkbox" id="seat_<?php echo $seat_no; ?>" style="display:none;" />
									<script type="text/javascript">										
									var s='<?php echo $seat_no; ?>';							
									fun_chk('seat_'+s,<?php echo $s ?>);
									</script></td>
		<?php } $seatCount1++; $seatCount++; } ?>
    </tr>
    <?php  } ?>
    </table>
    <table style="box-shadow:none;">
    <?php  for($up_lr=1; $up_lr<=1; $up_lr++) { ?>
	<tr>
  		<?php  for($up_lc=1; $up_lc<=$lower_right_col; $up_lc++) {
			if($lower_right_type=='sleeper') { $width ='50px'; } else {  $width ='20px'; }  
			$r=$r+1;				
		 	$owsel1 = "SELECT * FROM  bus_structure WHERE bus_id=".$Bus_id." AND position=".$r;
			$sql=mysql_query($owsel1);
			$seat=mysql_fetch_array($sql);
			$seat_no=$seat['seat_no'];
			$s=checkThisSeat($Bus_id,changedateformat($dat),$seat_no);?>
    <td id="loc_<?php echo $seat_no; ?>" <?php if($seat_no=='xx'){ ?> bgcolor="#FFFFFF"<?php } ?> style="width:<?php echo $width; ?>" align="right">
    	 <strong><?php if($seat_no!='xx'){ echo $seat_no; } ?></strong><br />
									<?php if(!in_array($seat_no,$booked_arr) && $seat_no!='xx'){ ?>
									<input type="checkbox" id="seat_<?php echo $seat_no; ?>" style="display:none;" />
									<script type="text/javascript">										
									var s='<?php echo $seat_no; ?>';							
									fun_chk('seat_'+s,<?php echo $s ?>);
									</script>
        </td>
		<?php } $seatCount++; } ?>
    </tr>
    <?php  } ?>
	 </table>
    <table style="box-shadow:none;">
	 <?php  for($up_lr=1; $up_lr<=$lower_right_row; $up_lr++) { ?>
	<tr>
  		<?php  for($up_lc=1; $up_lc<=$lower_right_col; $up_lc++) { 
		if($lower_right_type=='sleeper') { $width ='50px'; } else {  $width ='20px'; }
		$r=$r+1;				
		 	$owsel1 = "SELECT * FROM  bus_structure WHERE bus_id=".$Bus_id." AND position=".$r;
			$sql=mysql_query($owsel1);
			$seat=mysql_fetch_array($sql);
			$seat_no=$seat['seat_no'];
			$s=checkThisSeat($Bus_id,changedateformat($dat),$seat_no); ?>
    <td style="width:<?php echo $width; ?>"> <strong><?php if($seat_no!='xx'){ echo $seat_no; } ?></strong><br />
									<?php if(!in_array($seat_no,$booked_arr) && $seat_no!='xx'){ ?>
									<input type="checkbox" id="seat_<?php echo $seat_no; ?>" style="display:none;" />
									<script type="text/javascript">										
									var s='<?php echo $seat_no; ?>';							
									fun_chk('seat_'+s,<?php echo $s ?>);
									</script></td>
		<?php } $seatCount1++; $seatCount++; } ?>
    </tr>
    <?php  } ?>
	</table>
    </td>
    

	</tr>
	</table>
     
  
   
   		</table>
    
    
    </td>
    </tr>
   
    <tr>
      <td>&nbsp;</td>
      <td><strong>Note: </strong><strong>xx</strong> - empty seat.</td>
    </tr>
    </table>
    
   
  </div>
                    
                    </span>
                    </span>
						
					</span>
					<?php }
					else{
					?>
					<br /><br />
					<center>
					<span class="err_msg">Bus Structure Not Completed.</span>&nbsp;&nbsp; <a href="edit_seatlayout.php?busid=<?php echo $bid; ?>"><u><strong>Click Here</strong></u></a> to fill the structure.
					</center>
					<?php
					}
					 ?>
					</form>
   <?php
  }
include "includes/footer.php"; ?>