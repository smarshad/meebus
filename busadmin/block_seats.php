<?php
include "includes/header.php";
echo "<h2>Block / Unblock Seats</h2>";
//echo $bid; exit;

if(isset($_REQUEST['sp_id']) && isset($_REQUEST['bus_id']) && isset($_REQUEST['dat']))
{
   $SP_id=mysql_real_escape_string($_REQUEST['sp_id']);
   $Bus_id=mysql_real_escape_string($_REQUEST['bus_id']);
   $dat=mysql_real_escape_string($_REQUEST['dat']);
   $bid=$Bus_id;
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
	<!--<script src="jquery.js" type="text/javascript"></script>-->
	<script src="jquery.iCheckbox.js" type="text/javascript"></script>
	<script type="text/javascript">
	if ( typeof(console) == 'undefined' ) {
		var console = {};
	}
	if ( typeof(console.log) !== 'function' ) {
		console['log'] = function ( msg ) {
		}
	}

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
<input type="hidden" name="sp_id" id="sp_id" value="<?php echo $_REQUEST['sp_id']; ?>"  />
<input type="hidden" name="bus_id" id="bus_id" value="<?php echo $_REQUEST['bus_id']; ?>"  />

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
<span id="block_operation" style="display:none;">
	<table cellpadding="1" cellspacing="1" border="0" width="100%" style="border:1px solid #A2BAE6;">
						<tr>
							<td valign="top" width="35"><img src="../images/stearing.gif" alt="bus" title="bus" border="0" /></td>
							<td valign="top">
							<input type="hidden" name="bus_id" id="bus_id" value="<?php echo $Bus_id ?>" />
							<input type="hidden" name="travel_date" id="travel_date" value="<?php echo $dat; ?>" />
							<input type="hidden" name="sp_id" id="sp_id" value="<?php echo $SP_id; ?>" />
								<table cellpadding="3" cellspacing="5" border="0" width="100%" bgcolor="#FFFFFF" id="chk_seats">
									<tbody bgcolor="#D4DDEE" style="text-align:center;" class="normal">
									<?php 
										$r=0; 
										$blocked_seats = chkallThis($Bus_id,changedateformat($dat));
										$booked_seat = get_booked_seat($Bus_id,changedateformat($dat));	
										
										if(count($booked_seat)!=0 && count($blocked_seats)!=0){
										$blocked_arr=array_intersect($booked_seat,$blocked_seats);
										$booked_arr=array_diff($booked_seat,$blocked_seats);																			
										}
										else{
										$blocked_arr=array();
										$booked_arr=array();
										}										
										
										for($i=1;$i<=5;$i++){
										echo "<tr>";
										for($j=1;$j<=10;$j++){
										$r=$r+1;										
									    $sql=mysql_query("SELECT * FROM  bus_structure WHERE bus_id=".$Bus_id." AND position=".$r);
										$seat=mysql_fetch_array($sql);
										$seat_no=$seat['seat_no'];
										$s=checkThisSeat($Bus_id,changedateformat($dat),$seat_no);	
									?>
								<td width="10%" id="loc_<?php echo $seat_no; ?>" <?php if($seat_no=='xx'){ ?> bgcolor="#FFFFFF"<?php } ?>/>
								<strong><?php if($seat_no!='xx'){ echo $seat_no; } ?></strong><br />
								<?php if(!in_array($seat_no,$booked_arr) && $seat_no!='xx'){ ?>
								<input type="checkbox" id="seat_<?php echo $seat_no; ?>" style="display:none;" />
								<script type="text/javascript">										
								var s='<?php echo $seat_no; ?>';							
								fun_chk('seat_'+s,<?php echo $s ?>);
								</script>									
								</td>
								<?php 
									}
									  }
										echo "</tr>";										
									 }							
									?>																								
									</tbody>
								</table>							
							</td>
						</tr>
						<tr>
						<td><input type="hidden" id="busid" name="busid" value="<?php echo $busid; ?>"/></td>
						<td>
						</td>
						</tr>
					</table></span>
					<span id="show_detail">
						<table cellpadding="1" cellspacing="1" border="0" width="100%" style="border:1px solid #A2BAE6;">
						<tr>
							<td valign="top" width="35"><img src="../images/stearing.gif" alt="bus" title="bus" border="0" /></td>
							<td valign="top">
							<input type="hidden" name="bus_id" id="bus_id" value="<?php echo $Bus_id ?>" />
							<input type="hidden" name="travel_date" id="travel_date" value="<?php echo $dat; ?>" />
							<input type="hidden" name="sp_id" id="sp_id" value="<?php echo $SP_id; ?>" />
								<table cellpadding="3" cellspacing="5" border="0" width="100%" bgcolor="#FFFFFF">
									<tbody bgcolor="#D4DDEE" style="text-align:center;" class="normal">
									<?php 
										$r=0; 
										$blocked_seats = chkallThis($Bus_id,changedateformat($dat));
										$booked_seat = get_booked_seat($Bus_id,changedateformat($dat));											
										if(count($booked_seat)!=0 && count($blocked_seats)!=0){
										$blocked_arr=array_intersect($booked_seat,$blocked_seats);
										$booked_arr=array_diff($booked_seat,$blocked_seats);																			
										}
										else{
										$blocked_arr=array();
										$booked_arr=array();
										}										
										for($i=1;$i<=5;$i++){
										echo "<tr>";
										for($j=1;$j<=10;$j++){
										$r=$r+1;										
									    $sql=mysql_query("SELECT * FROM  bus_structure WHERE bus_id=".$Bus_id." AND position=".$r);
										$seat=mysql_fetch_array($sql);
										$seat_no=$seat['seat_no'];
										$s=checkThisSeat($Bus_id,changedateformat($dat),$seat_no);	
									?>
									<td width="10%" <?php if($seat_no=='xx'){ ?> bgcolor="#FFFFFF"<?php } ?>/>									
									<?php if(!in_array($seat_no,$booked_arr) && $seat_no!='xx'){ ?>
									<strong <?php if($s==1) { ?>style="color:#FF3300;" <?php } ?>>
									<?php if($seat_no!='xx'){ echo $seat_no; } ?>
									</strong><br />
									<?php } ?>
								    </td>
									<?php 									
									  }
									   echo "</tr>";										
									  }							
									?>																								
									</tbody>
								</table>							
							</td>
						</tr>
						<tr>
						<td><!--<input type="hidden" id="busid" name="busid" value="<?php echo $busid; ?>"/>--></td>
						<td><!--<input type="submit" id="bus_seats" name="bus_seats" value="Fix This Structure" />-->
						</td>
						</tr>
					</table>
					</span>
					<?php }
					else{
					?>
					<br /><br />
					<center>
					<span class="err_msg">Bus Structure Not Completed.</span>&nbsp;&nbsp;
                    <a href="edit_seatlayout.php?busid=<?php echo $bid; ?>"><u><strong>Click Here</strong></u></a>to fill the structure.
					</center>
					<?php
					}
					 ?>
					</form>
   <?php
  }
include "includes/footer.php"; 
?>