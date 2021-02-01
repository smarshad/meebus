<?php
include "includes/header.php";
if(isset($_POST['save'])){
	  $cnt=0;
	  $bus_seatlayout = $_REQUEST['bus_seatlayout'];
	  $bid=$_POST['bus_id'];
	  mysql_query("DELETE FROM bus_structure WHERE bus_id='$bid1'");
	  for($i=1;$i<=$_REQUEST['seat_count']; $i++)
	  {
		 
		  $st="s".$i;
		  $vp="v".$i;
		  $rc="rc".$i;
		  $vip=$_POST[$vp];
		  $seat=$_POST[$st];
		  $rcv =$_POST[$rc];
                  if(($seat!='')&&($seat!='xx')){$cnt=$cnt+1;}
		  mysql_query("INSERT INTO bus_structure (bus_id,position,seat_no,rc,vip) VALUES ('$bid','$i','$seat','$rcv','$vip')") or die(mysql_error());
                  
	  } 
	      $owbuup = "UPDATE businfo SET Bus_totalseats='$cnt', Bus_structure='$bus_seatlayout' WHERE Bus_id='$bid'";
          mysql_query($owbuup);
		 header("location:addmultipledesignation.php?busid=".$bid);
		 exit;
	  
  }

if(!isset($_REQUEST['busid'])){
  header("location: busDetails.php");
  exit;
  }

else{  
$bus_id=$_REQUEST['busid'];
$qry=mysql_query("SELECT * FROM businfo WHERE Bus_id=".$bus_id);
if(mysql_num_rows($qry)>0){
   $bus=mysql_fetch_object($qry); 
$structureid=mysql_real_escape_string($bus->Bus_structure);

?>
<script type="text/javascript">
function chg_structure(strctureID){
    var busid=document.getElementById('busid').value;
    document.getElementById('struct_ID').value=strctureID;
	var nocahe = Math.random();
	/* http.open('POST','edit_layout.php?busid='+busid+'&str_id='+strctureID+'&nocache='+nocache,true);	 */
	window.location.assign('seat_layout.php?busid='+busid+'&str_id='+strctureID);
	/*http.open('POST','seat_layout.php?busid='+busid+'&str_id='+strctureID+'&nocache='+nocache,true);	*/
	http.onreadystatechange = chg_structureReply;
	http.send(null);

}
function chg_structureReply()
{
	if (http.readyState == 4)
	{
	 document.getElementById('chg_struct').innerHTML=http.responseText;
	}
}
</script>
<style>
.txtbox {
	background-color:#FFFFFF;
	border:1px solid #CCCCCC;
	font-size: 11px;
	color: black;
	height: 14px;
	padding:2px;
}
.txtbox1 {
	background-color:#FF99CC;
	border:1px solid #CCCCCC;
	font-size: 11px;
	color: black;
	height: 14px;
	padding:2px;
}
</style>
<script type="text/javascript">


function AllowcharNum(e)
    {
    var keyVal =(window.event) ? event.keyCode : e.keyCode;
if (window.event) 
   keyVal = window.event.keyCode;


         if((window.event.shiftKey))
        {
                    if((keyVal > 48 && keyVal < 57))
                    {
                    return false;
                    }
                    else if((keyVal > 96 && keyVal < 105))
                    {
                    return false;
                    }
                    else if((keyVal == 46))
                    {
                    return false;
                    }
                    else if((keyVal == 8))
                    {
                    return false;
                    }
                    else
                    {
                    return false;
                    }
        }
        else
        {
                        if((keyVal > 48 && keyVal < 57))
                        {
                        return true;
                        }
                        else if((keyVal > 96 && keyVal < 105))
                        {
                        return true;
                        }
                        else if((keyVal == 46))
                        {
                        return true;
                        }
                        else if((keyVal == 8))
                        {
                        return true;
                        }
                         else if((keyVal == 57))
                        {
                        return true;
                        }
                        else if((keyVal == 48))
                        {
                        return true;
                        }
                        else if((keyVal > 65 && keyVal < 90))
                        {
                        return true;
                        } 
                        else if(keyVal==65)                       
                        {
                         return true;
                        }
                        else if(keyVal==90)                       
                        {
                         return true;
                        }
                        else if((keyVal == 16))
                        {
                        return false;
                        }
						else if((keyVal == 9))
						{
						 return true;
						}
                        else
                        {
                        return false;
                        }
        }
	}	   
 </script>
<script type="text/javascript">
 function vip_check()
 {
	 var x=confirm("Do you want to Fix this seat as VIP seat")
	 if(x)
	 {
		 return true;
	 }
	 else
	 {
		 return false;
	 }
 }
 </script>
<style type="text/css">
.imageBox, .imageBoxHighlighted {
	width:70px;	/* Total width of each image box */
	height:50px;	/* Total height of each image box */
	float:left;

}
.imageBox_theImage {
	width:40px;	/* Width of image */
	height:30px;	/* Height of image */
	/*
		Don't change these values *
		*/
		background-position: center center;
	background-repeat: no-repeat;
	margin: 0 auto;
	margin-bottom:2px;
}
.imageBox .imageBox_theImage {
	border:1px solid #DDD;	/* Border color for not selected images */
	padding:2px;
}
.imageBoxHighlighted .imageBox_theImage {
	border:3px solid #316AC5;	/* Border color for selected image */
	padding:0px;
}
.imageBoxHighlighted span {	/* Title of selected image */
	background-color: #316AC5;
	color:#FFFFFF;
	padding:2px;
}
.imageBox_label {	/* Title of images - both selected and not selected */
	text-align:center;
	font-family: arial;
	font-size:11px;
	padding-top:2px;
	margin: 0 auto;
}
/*
	DIV that indicates where the dragged image will be placed
	*/
	#insertionMarker {
	height:150px;
	width:6px;
	position:absolute;
	display:none;
}
#insertionMarkerLine {
	width:6px;	/* No need to change this value */
	height:33px;	/* To adjust the height of the div that indicates where the dragged image will be dropped */
}
#insertionMarker img {
	float:left;
}
/*
	DIV that shows the image as you drag it
	*/
	#dragDropContent {
	opacity:0.4;	/* 40 % opacity */
	filter:alpha(opacity=40);	/* 40 % opacity */
	/*
		No need to change these three values
		*/
		position:absolute;
	z-index:10;
	display:none;
}
.hai
{
	width:70px;	/* Total width of each image box */
	height:50px;	/* Total height of each image box */
	
	
	float:left;
}
</style>
<script type="text/javascript" src="js/floating-gallery2.js" ></script>
<a href="companymgnt.php">Service Providers </a> &nbsp; >> &nbsp;<a href="busDetails.php?sp_id=<?php echo $bus->SP_id; ?>"><?php echo get_SP_name($bus->SP_id); ?></a>&nbsp; >> &nbsp;<a href="editBus.php?busid=<?php echo $bus->Bus_id; ?>"><?php echo $bus->Bus_name; ?></a>&nbsp; >> &nbsp;<strong>Edit Bus Structure</strong>
 <form name="seat_form" id="seat_form" action="" method="post" >
<fieldset class="table-bor">
  <legend><strong>Edit Bus Structure</strong></legend>
  <table width="382">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">Bus Structure Types</td>
      <td><select name="bus_seatlayout" id="bus_seatlayout" onchange="chg_structure(this.value)">
          <?php
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
	  if($_GET['str_id']==$strtypes['structureID'])
	  {
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
?>
          <option value="<?php echo $strtypes['structureID']; ?>" <?php if($bus->Bus_structure == $strtypes['structureID'] || $_GET['str_id']==$strtypes['structureID']) { ?> selected="selected"<?php } ?>><?php echo $strtypes['structureType']; ?></option>
          <?php } ?>
        </select></td>
      <td><input type="hidden" name="struct_Name" id="struct_Name" value="<?php echo $struct_Name; ?>" />
        <input type="hidden" name="struct_ID" id="struct_ID" value="<?php echo $struct_ID; ?>" />
        <input type="hidden" id="busid" name="busid" value="<?php echo $bus_id; ?>"/></td>
    </tr>
  </table>
  <div id="chg_struct">
   
    <input type="hidden" name="bus_id" value="<?php echo $bus_id; ?>">
    <?php $seatCount1=1;  $seatCount =1; if($upper_seat=='1') { ?>
    <table cellpadding="3" cellspacing="5" border="0" width="770px;" style="border:1px solid #A2BAE6;">
    <tr>
      <td valign="top" width="35">Upper <br/> Seat <br/> Layout</td>
      <td valign="top">
      
      
      
      
      <table cellpadding="3" cellspacing="5" border="0" width="100%" bgcolor="#FFFFFF" id="chk_seats">
        
        
    
	<table>

    <tr>
    <td align="left">
    <table>
    <?php for($up_lr=1; $up_lr<=$upper_left_row; $up_lr++) { ?>
	<tr>
  		<?php  for($up_lc=1; $up_lc<=$upper_left_col; $up_lc++) {
			if($upper_left_type=='sleeper') { $width ='50px'; } else {  $width ='20px'; } ?>
    <td><input type="text"  name="s<?php echo $seatCount; ?>" style="width:<?php echo $width; ?>;" id="s<?php echo $seatCount; ?>" value="<?php echo "UL".$seatCount1; ?>">
    <input type="hidden"  name="rc<?php echo $seatCount; ?>" id="rc<?php echo $seatCount; ?>" value="<?php echo 'UL,'.$up_lr.','.$up_lc; ?>">
    
    </td>
		<?php $seatCount1++; $seatCount++; } ?>
    </tr>
    <?php  } ?>
    </table>
    <table>
    <?php  for($up_lr=1; $up_lr<=1; $up_lr++) { ?>
	<tr>
  		<?php  for($up_lc=1; $up_lc<=$upper_right_col; $up_lc++) {
			if($upper_right_type=='sleeper') { $width ='50px'; } else {  $width ='20px'; } ?>
    <td align="right">
    	<input type="text" value="<?php if($up_lc==$up_lc) { echo 'xx'; } ?>" <?php if($up_lc==$up_lc) { ?> readonly="readonly" <?php } ?> name="s<?php echo $seatCount; ?>" style="width:<?php echo $width; ?>;<?php if($up_lc==$up_lc) { ?> text-align:center;  background:#666; color:#FFF; <?php } ?> " id="s<?php echo $seatCount; ?>" >
        <input type="hidden"  name="rc<?php echo $seatCount; ?>" id="rc<?php echo $seatCount; ?>" value="<?php echo 'UM,'.$up_lr.','.$up_lc; ?>">
        </td>
		<?php $seatCount++; } ?>
    </tr>
    <?php  } ?>
    </table>
	<table>
	 <?php  for($up_lr=1; $up_lr<=$upper_right_row; $up_lr++) { ?>
	<tr>
  		<?php  for($up_lc=1; $up_lc<=$upper_right_col; $up_lc++) { 
		if($upper_right_type=='sleeper') { $width ='50px'; } else {  $width ='20px'; } ?>
    <td><input type="text" name="s<?php echo $seatCount; ?>" style="width:<?php echo $width; ?>;" id="s<?php echo $seatCount; ?>" value="<?php echo "UR".$seatCount1; ?>">
    <input type="hidden"  name="rc<?php echo $seatCount; ?>" id="rc<?php echo $seatCount; ?>" value="<?php echo 'UR,'.$up_lr.','.$up_lc; ?>"></td>
		<?php $seatCount1++; $seatCount++; } ?>
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
    <table>
    
    <?php for($up_lr=1; $up_lr<=$lower_left_row; $up_lr++) { ?>
	<tr>
  		<?php  for($up_lc=1; $up_lc<=$lower_left_col; $up_lc++) {
			if($lower_left_type=='sleeper') { $width ='50px'; } else {  $width ='20px'; } ?>
    <td><input type="text" name="s<?php echo $seatCount; ?>" style="width:<?php echo $width; ?>;" id="s<?php echo $seatCount; ?>" value="<?php echo "LL".$seatCount1; ?>">
    <input type="hidden"  name="rc<?php echo $seatCount; ?>" id="rc<?php echo $seatCount; ?>" value="<?php echo 'LL,'.$up_lr.','.$up_lc; ?>"></td>
		<?php $seatCount1++; $seatCount++; } ?>
    </tr>
    <?php  } ?>
    </table>
    <table>
    <?php  for($up_lr=1; $up_lr<=1; $up_lr++) { ?>
	<tr>
  		<?php  for($up_lc=1; $up_lc<=$lower_right_col; $up_lc++) {
			if($lower_right_type=='sleeper') { $width ='50px'; } else {  $width ='20px'; } ?>
    <td align="right">
    	<input type="text" value="<?php if($up_lc==$up_lc) { echo 'xx'; } ?>" <?php if($up_lc==$up_lc) { ?> readonly="readonly" <?php } ?> name="s<?php echo $seatCount; ?>" style="width:<?php echo $width; ?>;<?php if($up_lc==$up_lc) { ?> text-align:center;  background:#666; color:#FFF; <?php } ?> " id="s<?php echo $seatCount; ?>">
        <input type="hidden"  name="rc<?php echo $seatCount; ?>" id="rc<?php echo $seatCount; ?>" value="<?php echo 'LM,'.$up_lr.','.$up_lc; ?>">
        </td>
		<?php $seatCount++; } ?>
    </tr>
    <?php  } ?>
	 </table>
    <table>
	 <?php  for($up_lr=1; $up_lr<=$lower_right_row; $up_lr++) { ?>
	<tr>
  		<?php  for($up_lc=1; $up_lc<=$lower_right_col; $up_lc++) { 
		if($lower_right_type=='sleeper') { $width ='50px'; } else {  $width ='20px'; } ?>
    <td><input type="text" name="s<?php echo $seatCount; ?>" style="width:<?php echo $width; ?>;" id="s<?php echo $seatCount; ?>" value="<?php echo "LR".$seatCount1; ?>">
    <input type="hidden"  name="rc<?php echo $seatCount; ?>" id="rc<?php echo $seatCount; ?>" value="<?php echo 'LR,'.$up_lr.','.$up_lc; ?>"></td>
		<?php $seatCount1++; $seatCount++; } ?>
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
    <div style="clear:both;padding-bottom:10px">
        <input type="submit" style="width:100px" value="Save" name="save" id="save" >  &nbsp;  <input type="reset" style="width:100px" value="Reset" name="Reset"  id="Reset">
        
        <input type="hidden" name="seat_count" id="seat_count" value="<?php echo $seatCount-1; ?>">
      </div>
   
  </div>
</fieldset> </form>
<?php 
    include "includes/footer.php";
	}
    else {
	       header("location: busDetails.php");
	}
 }

  ?>
 