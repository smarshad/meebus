<?php
include "includes/header.php";

if(!isset($_REQUEST['busid'])){
  header("location: busDetails.php");
  }
else{  
$bus_id=$_REQUEST['busid'];
$qry=mysql_query("SELECT * FROM businfo WHERE Bus_id=".$bus_id);
if(mysql_num_rows($qry)>0){
   $bus=mysql_fetch_object($qry);
   
?>
<style type="text/css">
a.ovalbutton{
background: transparent url('oval-blue-left.gif') no-repeat top left;
display: block;
float: left;
font: normal 13px Tahoma; /* Change 13px as desired */
line-height: 16px; /* This value + 4px + 4px (top and bottom padding of SPAN) must equal height of button background (default is 24px) */
height: 24px; /* Height of button background height */
padding-left: 11px; /* Width of left menu image */
text-decoration: none;
}

a:link.ovalbutton, a:visited.ovalbutton, a:active.ovalbutton{
color: #494949; /*button text color*/
}

a.ovalbutton span{
background: transparent url('oval-blue-right.gif') no-repeat top right;
display: block;
padding: 4px 11px 4px 0; /*Set 11px below to match value of 'padding-left' value above*/
}

a.ovalbutton:hover{ /* Hover state CSS */
background-position: bottom left;
}

a.ovalbutton:hover span{ /* Hover state CSS */
background-position: bottom right;
color: black;
}

.buttonwrapper{ /* Container you can use to surround a CSS button to clear float */
overflow: hidden; /*See: http://www.quirksmode.org/css/clearing.html */
width: 100%;
}

</style>
<a href="companymgnt.php">Service Providers </a> &nbsp; >> &nbsp;<a href="busDetails.php?sp_id=<?php echo $bus->SP_id; ?>"><?php echo get_SP_name($bus->SP_id); ?></a>&nbsp; >> &nbsp;<strong>Edit Bus Informations</strong>
<?php
if(isset($_REQUEST['updatbus'])){
$SP_id=$_REQUEST['sp_id'];
$busname=mysql_real_escape_string($_REQUEST['bname']);
$busType=$_REQUEST['busType'];
$source=$_REQUEST['fromCity'];
$destination=$_REQUEST['toCity'];
$fare=$_REQUEST['fare'];
$tax=$_REQUEST['tax'];
$total=$_REQUEST['tfare'];
$seats=$_REQUEST['seats'];
$date=date("Y-m-d");
$boarding_time='';

$boardlist=explode(",",$_REQUEST['boardlist']);
for($u=0;$u<count($boardlist);$u++){
$a=''; $b='';
    $q=explode("-",$boardlist[$u]);

	$a=$q[0];
	$b=$q[1];
	
		if(isset($_REQUEST[$a]) && isset($_REQUEST[$b])){
		   $boarding_time.=mysql_real_escape_string($_REQUEST[$a])."-".mysql_real_escape_string($_REQUEST[$b]).",";
		}
    }
	
	 $boarding_time=substr($boarding_time,0,-1); 
	
	 $SR_id=getRouteID($source,$destination);
	
	echo $sql_businfo="UPDATE `businfo` SET `Bus_fromcity` = '$source' ,  `Bus_tocity` = '$destination' ,  `Bus_type` = '$busType' , `Bus_name` = '$busname' ,  `Bus_boarding_time` = '$boarding_time' , `Bus_fare` = '$total' , `Bus_totalseats` = '$seats' WHERE `Bus_id` = '$bus_id' ";
mysql_query($sql_businfo);
//$bus_id=mysql_insert_id();
header("Location: editBus.php?busid=$bus_id&suc");
}
?>




<script type="text/javascript">

function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
            }
         return true;
      }


 function getObject(obj)
  {
	  var theObj;
	  if (document.all) {
		  if (typeof obj=='string') {
			  return document.all(obj);
		  } else {
			  return obj.style;
		  }
	  }
	  if (document.getElementById) {
		  if (typeof obj=='string') {
			  return document.getElementById(obj);
		  } else {
			  return obj.style;
		  }
	  }
	  return null;
  }



 function chkkeycode(evt,txt)
 {
	var textBox = getObject(txt);
	var charCode = (evt.which) ? evt.which : event.keyCode;

	 if (charCode == 189){ 
	      return false;
		 }
		 else{
		  return true;
		 }
	 
	 /*if (charCode == 8) textBox.value = "backspace"; //  backspace
	 if (charCode == 9) textBox.value = "tab"; //  tab
	 if (charCode == 13) textBox.value = "enter"; //  enter
	 if (charCode == 16) textBox.value = "shift"; //  shift
	 if (charCode == 17) textBox.value = "ctrl"; //  ctrl
	 if (charCode == 18) textBox.value = "alt"; //  alt
	 if (charCode == 19) textBox.value = "pause/break"; //  pause/break
	 if (charCode == 20) textBox.value = "caps lock"; //  caps lock
	 if (charCode == 27) textBox.value = "escape"; //  escape
	 if (charCode == 33) textBox.value = "page up"; // page up, to avoid displaying alternate character and confusing people	         
	 if (charCode == 34) textBox.value = "page down"; // page down
	 if (charCode == 35) textBox.value = "end"; // end
	 if (charCode == 36) textBox.value = "home"; // home
	 if (charCode == 37) textBox.value = "left arrow"; // left arrow
	 if (charCode == 38) textBox.value = "up arrow"; // up arrow
	 if (charCode == 39) textBox.value = "right arrow"; // right arrow
	 if (charCode == 40) textBox.value = "down arrow"; // down arrow
	 if (charCode == 45) textBox.value = "insert"; // insert
	 if (charCode == 46) textBox.value = "delete"; // delete
	 if (charCode == 91) textBox.value = "left window"; // left window
	 if (charCode == 92) textBox.value = "right window"; // right window
	 if (charCode == 93) textBox.value = "select key"; // select key
	 if (charCode == 96) textBox.value = "numpad 0"; // numpad 0
	 if (charCode == 97) textBox.value = "numpad 1"; // numpad 1
	 if (charCode == 98) textBox.value = "numpad 2"; // numpad 2
	 if (charCode == 99) textBox.value = "numpad 3"; // numpad 3
	 if (charCode == 100) textBox.value = "numpad 4"; // numpad 4
	 if (charCode == 101) textBox.value = "numpad 5"; // numpad 5
	 if (charCode == 102) textBox.value = "numpad 6"; // numpad 6
	 if (charCode == 103) textBox.value = "numpad 7"; // numpad 7
	 if (charCode == 104) textBox.value = "numpad 8"; // numpad 8
	 if (charCode == 105) textBox.value = "numpad 9"; // numpad 9
	 if (charCode == 106) textBox.value = "multiply"; // multiply
	 if (charCode == 107) textBox.value = "add"; // add
	 if (charCode == 109) textBox.value = "subtract"; // subtract
	 if (charCode == 110) textBox.value = "decimal point"; // decimal point
	 if (charCode == 111) textBox.value = "divide"; // divide
	 if (charCode == 112) textBox.value = "F1"; // F1
	 if (charCode == 113) textBox.value = "F2"; // F2
	 if (charCode == 114) textBox.value = "F3"; // F3
	 if (charCode == 115) textBox.value = "F4"; // F4
	 if (charCode == 116) textBox.value = "F5"; // F5
	 if (charCode == 117) textBox.value = "F6"; // F6
	 if (charCode == 118) textBox.value = "F7"; // F7
	 if (charCode == 119) textBox.value = "F8"; // F8
	 if (charCode == 120) textBox.value = "F9"; // F9
	 if (charCode == 121) textBox.value = "F10"; // F10
	 if (charCode == 122) textBox.value = "F11"; // F11
	 if (charCode == 123) textBox.value = "F12"; // F12
	 if (charCode == 144) textBox.value = "num lock"; // num lock
	 if (charCode == 145) textBox.value = "scroll lock"; // scroll lock
	 if (charCode == 186) textBox.value = ";"; // semi-colon
	 if (charCode == 187) textBox.value = "="; // equal-sign
	 if (charCode == 188) textBox.value = ","; // comma
	 if (charCode == 189) textBox.value = "-"; // dash
	 if (charCode == 190) textBox.value = "."; // period
	 if (charCode == 191) textBox.value = "/"; // forward slash
	 if (charCode == 192) textBox.value = "`"; // grave accent
	 if (charCode == 219) textBox.value = "["; // open bracket
	 if (charCode == 220) textBox.value = "\\"; // back slash
	 if (charCode == 221) textBox.value = "]"; // close bracket
	 if (charCode == 222) textBox.value = "'"; // single quote*/

	/* var lblCharCode = getObject('spnCode');
	lblCharCode.innerHTML = 'KeyCode:  ' + charCode;

	return false;*/


 }



function get_fare(){
       var v1=document.getElementById('fare').value;
	   var v2=document.getElementById('tax').value;
	   if(v1 != '' && v2 !=''){
	      document.getElementById('tfare').value=parseInt(v1)+parseInt(v2);
	     }
      }

function validate_busform()
{
   
	var form = document.busform;
	
	if(form.bname.value == ""){
	alert("Please Enter Bus Name");
	form.bname.focus();
	return false;
	}
	
	if(form.busType.value == ""){
	alert("Please Choose Bus Type");
	form.busType.focus();
	return false;
	}
	
	if(form.fromCity.value == ""){
	alert("Please Choose From City");
	form.fromCity.focus();
	return false;
	}
	
	if(form.toCity.value == ""){
	alert("Please Choose To City");
	form.toCity.focus();
	return false;
	}
	
	/*if(form.fare.value == ""){
	alert("Please Enter Bus Fare");
	form.fare.focus();
	return false;
	}
	
	if(form.tax.value == ""){
	alert("Please Enter Tax Amount");
	form.tax.focus();
	return false;
	}*/
	
	if(form.tfare.value == ""){
	alert("Please Enter Total Fare");
	form.tfare.focus();
	return false;
	}
	
	if(form.seats.value == ""){
	alert("Please Enter Total Seats");
	form.seats.focus();
	return false;
	}
	//alert('This is Demo Version !!!');
	return true;
}

 
</script>


<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-timepicker-addon.min.js"></script>	

<script type="text/javascript">
function time_show(idval)
{

	var var_id = '#'+idval ; 
						
	$(var_id).timepicker({ampm: true, hourMin: 0, hourMax: 24 });

}


</script>
<style type="text/css">
.dis{
display:none;
}
</style>
<fieldset class="table-bor">
		<legend><strong>Edit Bus Informations</strong></legend> 	
<form action="" name="busform" id="busform" method="post" onsubmit="return validate_busform()">
<table>
	<tr>	
		<td></td>
		
		<td></td>
		
		<td></td>
		
		<td><!--<a href="javascript:void(0);" onclick="alert('<?php echo $bus_id; ?>')">Edit Bus Structure</a>--></td>	
	</tr>
	
	<tr><td colspan="4"><br /></td></tr>
	<?php if(isset($_REQUEST['suc'])) { ?>
	<tr><td colspan="4" style="color:#006633;" align="center"><strong>Updated Successfully</strong></td></tr>
	<tr><td colspan="4"><br /></td></tr>
		<?php } ?>
		<!--<tr>
		<td></td><td></td><td></td>
		<td>
		<strong><a href="edit_seatlayout.php?busid=<?php echo $bus_id; ?>">Edit Bus Structure</a></strong>
		</td>
		</tr>
		<tr>
		<td></td>
		</tr>-->
		<tr>
		<td></td>
		</tr>
	<tr>
	
		<td width="143"> Bus Name </td>
		
		<td width="174">
			<input type="text" name="bname" id="bname" class="textbox" value="<?php echo $bus->Bus_name; ?>"/>	
		    <div id="bname_err" style="display:none; color:#FF3300">Please Enter Bus Name.</div>
		</td>
		
		<td width="188"> Bus type </td>
		
		<td width="183">
			<select id="busType" name="busType" class="combobox">
			<option value="">Select Bus Type</option>
			<?php			
				$qry = mysql_query("select * from bustypes where typeStatus=1 AND del_status = 1") ;				
				while ($btype = mysql_fetch_array($qry))
				{
			?>			
			<option value="<?php echo $btype['typeID']; ?>" <?php if($bus->Bus_type==$btype['typeID']) { echo "selected"; } ?>><?php echo $btype['typeName']; ?></option>								
			<?php }  ?>			
			</select>	
			 <div id="busType_err" style="display:none; color:#FF3300">Please Enter Bus Name.</div>
	  </td>
	
	</tr>
	
	<tr><td colspan="4"><br /></td></tr>
	
	<tr>
	
		<td width="143"> From City </td>
		
		<td width="199"> 
			<select id="fromCity" name="fromCity" onChange="getDestination(this.value);" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($bus->Bus_fromcity == $row['SR_source']){ echo "selected"; } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>			
			</select>	
			
			<div id="fromCity_err" style="display:none; color:#FF3300">Please Choose From City</div>	
	    </td>		
		<td width="188"> To City </td>
		
		<td>
		<div id="tocity">
		<?php
		$source=$bus->Bus_fromcity;
		$qry=mysql_query("SELECT SR_Destination FROM service_routes where SR_source=".$source);
		?>
		<select id="toCity" name="toCity" class="combobox">
		<option value="">Select Destination Place</option>
		<?php
		while($row=mysql_fetch_array($qry)){
		?>
		<option value="<?php echo $row['SR_Destination'] ?>" <?php if($row['SR_Destination'] == $bus->Bus_tocity) { echo "selected";} ?>><?php echo get_city_name($row['SR_Destination']);  ?></option>
		<?php
		}
		?>
		</select>
		</div>
		<div id="txt_to_city_err" style="display:none; color:#FF3300">Please Choose To City</div>
	  </td>
	
	</tr>
	
	<tr><td colspan="4"><br /></td></tr>
	
	<tr>
	
		<td height="32">
			Boarding Point & Time	</td>
	
		<td colspan="3" align="left">
				
			<table width="450" id="dataTable">
			<?php
			     $boardings=explode(",",$bus->Bus_boarding_time);
				$i=0; $r=0; $board_str='';
				foreach($boardings as $val){
				$val_arr=explode("-",$val);
			?>
		<tr>
			<td width="23">
			
			<input type="checkbox" name="chk_<?php echo $r; ?>" id="chk_<?php echo $r; ?>" <?php if($i==0) { ?> disabled="disabled" <?php } ?> value="chk_<?php echo $r; ?>" onclick="removeRow(this)" style="display:none;" />
			<?php if($r!=0) { ?>
			<img src="../images/minus_icon.png" border="0" onclick="removeRow(this)" id="img_<?php echo $r ?>" />
			<?php } ?>
			</td>
			<td width="14"> <?php echo $i+=1; ?> </td>
			<td width="170">
			<input type="text" name="b_<?php echo $r ?>" id="b_<?php echo $r ?>" class="textbox" value="<?php echo $val_arr[0]; ?>" onkeydown="return chkkeycode(event,this.id)" /> 
			<div id="b_0_err" style="display:none; color:#FF3300;">Please Enter Boarding Point</div>
			</td>
			<td width="172"> 
			<input type="text"  class="textbox" name="bt_<?php echo $r ?>" id="bt_<?php echo $r ?>" value="<?php echo $val_arr[1]; ?>" onfocus="time_show(this.id);"  /> 
			<div id="bt_0_err" style="display:none; color:#FF3300;">Please Choose Boarding Time</div>
			</td>
			<td width="20"><?php if($r==0) { ?><img src="../images/plus_icon.png" border="0" onclick="addRow_new('dataTable')" /><?php } ?></td>
			<td width="23">
			<?php if($r==0) { ?><!--<img src="../images/minus_icon.png" border="0" onclick="deleteRow('dataTable')" />--><?php } ?>
			</td>
		</tr>
           <?php 
		   
		   $board_str.="b_".$r."-bt_".$r.",";
		   $r+=1; 
		   
		   } 
		   $board_str=substr($board_str,0,-1);
		   ?>
		  </table>
				
		</td>
	</tr>

	<tr><td colspan="4"><br />
	<input type="hidden" name="boardlist" id="boardlist" value="<?php echo $board_str; ?>" />
	<input type="hidden" id="boardcount" name="boardcount" value='<?php echo $r; ?>' />
	</td></tr>
	
	<tr><td colspan="4"><br /></td></tr>
	
	<tr><td colspan="4"><br /></td></tr>
	
	<tr>
	
		<td width="143"> Total Fare </td>
		
		<td width="174"> 
		
			<input type="text" name="tfare" id="tfare" class="textbox" value="<?php echo $bus->Bus_fare; ?>" onkeypress="return isNumberKey(event);"/>
			
	    </td>
		
		<td width="188"> Bus Structure </td>
		
		<td width="183"><a href="edit_seatlayout.php?busid=<?php echo $bus_id; ?>" class="ovalbutton"><span><strong>
		<?php
		$str=$bus->Bus_structure;
		$strsql=mysql_query("SELECT structureType FROM `busstructuretypes` WHERE structureID=".$str);
		if(mysql_num_rows($strsql)){
		$y=mysql_fetch_array($strsql);
		?>
		<?php echo $y['structureType']; ?>
		<?php		
		}
		else{
		echo "--";
		}
		?></strong></span></a>
			<input type="hidden" name="seats" id="seats" class="textbox" value="<?php echo $bus->Bus_totalseats; ?>" maxlength="8" onkeypress="return isNumberKey(event);" readonly />			
	    </td>
	
	</tr>
	
	<tr><td colspan="4"><br /></td></tr>
	
	<tr>	
		<td colspan="4" align="center"> 		
			<!--<input type="submit" name="subbus" value="Add >>" onClick="add_validbus()" />-->
				<!--<input type="submit" name="updatbus" value="Update >>" onClick="return validate_busform()" />-->
				<input type="submit" name="updatbus" value="Update >>" onClick="return validate_busform();" />
	    </td>
	
	</tr>
	
	<tr><td colspan="4"><br /></td></tr>
	
	<tr>
		
		<td colspan="4" align="left">
		
			<div>
		    </div>
		
		</td>
	
	</tr>
	
</table>
</form>
</fieldset>
<?php 
    include "includes/footer.php";
	}
    else {
	       header("location: busDetails.php");
	}
 } ?>