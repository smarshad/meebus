<?php
include "includes/header.php";

 if(isset($_REQUEST['exists'])) 
	{
		
		$inbus= $_REQUEST['busid'];
		$vips=$_REQUEST['vipseatsel'];
		$vipfares=$_REQUEST['vipfare'];
		 $stridd=$_REQUEST['strid'];
		/*echo "<br/>";
		$values=$_REQUEST['val2'];*/
		
		
		$imp=$_REQUEST['val2'];
				$exp=explode(',',$imp);
				$coun=count($exp);
				
				/*for($i=0;$i<$coun;$i++)
				{
					echo $exp[$i];
					echo "<br />";

				}*/
				
				//echo "DELETE FROM bus_structure WHERE bus_id=".$inbus; exit;
				
mysql_query("DELETE FROM bus_structure WHERE bus_id=".$inbus);

$ss=mysql_query("SELECT SP_id FROM businfo WHERE Bus_id=".$inbus);
	$bb=mysql_fetch_array($ss);
		
		for($ii=0;$ii<$coun;$ii++)
				{
					$cc=$ii+1;
					
	mysql_query("INSERT INTO bus_structure (bus_id,position,seat_no) VALUES ($inbus,$cc,'$exp[$ii]')") or die(mysql_error());

				}
				
			if($vips and $vipfares !="")
				{
				
				$imp2=$_REQUEST['vipseatsel'];
		$exp2=explode(',',$imp2);
			
				$coun2=count($exp2);
				
				for($i=0;$i<$coun2;$i++)
				{
					mysql_query("update bus_structure set vip=1 where bus_id=$inbus and seat_no=$exp2[$i]") or die(mysql_error());
				}
				
				//echo "update  businfo set vip_fare='$vipfares',Bus_structure='$stridd' where Bus_id='$inbus'"; exit;
				mysql_query("update  businfo set vip_fare='$vipfares' where Bus_id='$inbus'");
				}
				mysql_query("update  businfo set Bus_structure='$stridd' where Bus_id='$inbus'");
			
		header("location: busDetails.php?sp_id=".$bb['SP_id']);
			

		
	}

if(!isset($_REQUEST['busid'])){
  header("location: busDetails.php");
  }
elseif(isset($_REQUEST['bus_seats']))  {
$bus=$_REQUEST['busid'];
mysql_query("DELETE FROM bus_structure WHERE bus_id=".$bus);

for($i=1;$i<=50;$i++){
		$val='seat_'.$i;
		
			$seat=mysql_real_escape_string($_REQUEST[$val]);
			mysql_query("INSERT INTO bus_structure (bus_id,position,seat_no) VALUES ($bus,$i,'$seat')") or die(mysql_error());
	}
	
	$s=mysql_query("SELECT SP_id FROM businfo WHERE Bus_id=".$bus);
	$b=mysql_fetch_array($s);
	
	header("location: busDetails.php?sp_id=".$b['SP_id']);
}
else{  
$bus_id=$_REQUEST['busid'];
$qry=mysql_query("SELECT * FROM businfo WHERE Bus_id=".$bus_id);
if(mysql_num_rows($qry)>0){
   $bus=mysql_fetch_object($qry); 

$structureid=mysql_real_escape_string($bus->Bus_structure);
$seats=array();
if($structureid==1){
   for($i=21;$i<=30;$i++){
        $seats[]=$i;
       }
}
elseif($structureid==2){
   for($i=21;$i<=31;$i++){
        if($i!=30)
        $seats[]=$i;
       }
}
elseif($structureid==3){
   for($i=21;$i<=40;$i++){
        $seats[]=$i;
       }
}
elseif($structureid==4){
    for($i=11;$i<=40;$i++){
        $seats[]=$i;
       }
}
elseif($structureid==5){
   $seats;
}
else{
header("location: home.php");
}   
?>
<script type="text/javascript">
function chg_structure(strctureID){
    var busid=document.getElementById('busid').value;
    document.getElementById('struct_ID').value=strctureID;
	var nocahe = Math.random();
	http.open('POST','edit_layout.php?busid='+busid+'&str_id='+strctureID+'&nocache='+nocache,true);	
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
.txtbox{
background-color:#FFFFFF; 
border:1px solid #CCCCCC; 
font-size: 11px; 
color: black; 	
height: 14px; 
padding:2px;
}
.txtbox1{
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
  	<style type="text/css">
	.imageBox,.imageBoxHighlighted{
		width:70px;	/* Total width of each image box */
		height:50px;	/* Total height of each image box */
		float:left;
	}
	.imageBox_theImage{
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

	.imageBox .imageBox_theImage{
		border:1px solid #DDD;	/* Border color for not selected images */
		padding:2px;
	}
	.imageBoxHighlighted .imageBox_theImage{
		border:3px solid #316AC5;	/* Border color for selected image */
		padding:0px;

	}
	.imageBoxHighlighted span{	/* Title of selected image */
		background-color: #316AC5;
		color:#FFFFFF;
		padding:2px;
	}

	.imageBox_label{	/* Title of images - both selected and not selected */
		text-align:center;
		font-family: arial;
		font-size:11px;
		padding-top:2px;
		margin: 0 auto;
	}

	/*
	DIV that indicates where the dragged image will be placed
	*/
	#insertionMarker{
		height:150px;
		width:6px;
		position:absolute;
		display:none;

	}

	#insertionMarkerLine{
		width:6px;	/* No need to change this value */
		height:33px;	/* To adjust the height of the div that indicates where the dragged image will be dropped */

	}

	#insertionMarker img{
		float:left;
	}

	/*
	DIV that shows the image as you drag it
	*/
	#dragDropContent{

		opacity:0.4;	/* 40 % opacity */
		filter:alpha(opacity=40);	/* 40 % opacity */

		/*
		No need to change these three values
		*/
		position:absolute;
		z-index:10;
		display:none;

	}
</style>
<script type="text/javascript" src="js/floating-gallery.js" ></script>
<a href="companymgnt.php">Service Providers </a> &nbsp; >> &nbsp;<a href="busDetails.php?sp_id=<?php echo $bus->SP_id; ?>"><?php echo get_SP_name($bus->SP_id); ?></a>&nbsp; >> &nbsp;<a href="editBus.php?busid=<?php echo $bus->Bus_id; ?>"><?php echo $bus->Bus_name; ?></a>&nbsp; >> &nbsp;<strong>Edit Bus Structure</strong>
<fieldset class="table-bor">
<legend><strong>Edit Bus Structure</strong></legend>
<table width="382">
<tr>
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
<td colspan="3">Bus Structure Types</td>
<td>
<select name="bus_seatlayout" onchange="chg_structure(this.value)">
<?php
$str_sql=mysql_query("SELECT * FROM busstructuretypes WHERE structureStatus = 1 ORDER BY structureID ");
while($strtypes=mysql_fetch_array($str_sql)){
      if($bus->Bus_structure == $strtypes['structureID']){
	     $struct_ID=$strtypes['structureID'];
		 $struct_Name=$strtypes['structureType'];
	  }
?>
<option value="<?php echo $strtypes['structureID']; ?>" <?php if($bus->Bus_structure == $strtypes['structureID']) { ?> selected="selected"<?php } ?>><?php echo $strtypes['structureType']; ?></option>
<?php } ?>
</select>
</td>
<td>
<input type="hidden" name="struct_Name" id="struct_Name" value="<?php echo $struct_Name; ?>" />
<input type="hidden" name="struct_ID" id="struct_ID" value="<?php echo $struct_ID; ?>" />
<input type="hidden" id="busid" name="busid" value="<?php echo $bus_id; ?>"/>
</td>
</tr>
</table>
<div id="chg_struct">
<form name="seat_form" id="seat_form" action="" method="post" onsubmit="return validate_busseats()">
<table cellpadding="3" cellspacing="5" border="0" width="770px;" style="border:1px solid #A2BAE6;">
						<tr>
							<td valign="top" width="35"><img src="../images/stearing.gif" alt="bus" title="bus" border="0" /></td>
							<td valign="top">						
								<table cellpadding="3" cellspacing="5" border="0" width="100%" bgcolor="#FFFFFF" id="chk_seats">
									<tbody bgcolor="#D4DDEE" style="text-align:center;" class="normal">
						<div id="GalleryContainer">
                            <?php 
									$seat_qry=mysql_query("SELECT bus_id FROM bus_structure WHERE bus_id=".$bus_id);
									$c=mysql_num_rows($seat_qry);									
										 $r=0;
										 $seatcount=1;
										
										 for($i=1;$i<=5;$i++){
										 echo "<tr>";
										 for($j=1;$j<=10;$j++){
											
											$r=$r+1;
											
											//echo "SELECT seat_no FROM bus_structure WHERE bus_id=".$bus_id." AND position=".$r; 
			$seat_sql=mysql_query("SELECT seat_no FROM bus_structure WHERE bus_id=".$bus_id." AND position=".$r);
									$seat=mysql_fetch_object($seat_sql);	
									
									//echo $seat->seat_no;
									?>
          <div class="imageBox" id="<?php echo $seat->seat_no; ?>">
            <div class="imageBox_theImage" >
              <?php if($seat->seat_no=='xx'){ echo "";} else {echo $seat->seat_no; }?> 
            </div>
          </div>
          <?php									 
									}
										echo "</tr>";
										}							
									?>
        </div>
<form action="#" method="post">
 <div style="clear:both;">VIP SEATS <input type="text" name="vipseats" />&nbsp;<span style="font-size:10px;">(Type Seat No. multiple seats use comma(,) as seperation)</span></div><br />
     <div style="clear:both;">VIP FARE &nbsp; <input type="text" name="vipfare" />&nbsp;<span style="font-size:11px;">rs</span></div><br />
<div style="clear:both;padding-bottom:10px">
	<input type="button" style="width:100px" value="Save" name="save2" onclick="saveImageOrder(vipseats,vipfare,<?php echo $bus_id; ?>,<?php echo $structureid; ?>)">
</div>
</form>

<div id="insertionMarker">
	<img src="images/marker_top.gif">
	<img src="images/marker_middle.gif" id="insertionMarkerLine">
	<img src="images/marker_bottom.gif">
</div>
<div id="dragDropContent">
</div>
<div id="debug" style="clear:both;">

</div>																	
									</tbody>
								</table>							
							</td>
						</tr>
						<tr>
						<td><input type="hidden" id="busid" name="busid" value="<?php echo $bus_id; ?>"/></td>
						<td>
						<!--<input type="button" id="bus_seats" name="bus_seats" value="Fix This Structure" onclick="return validate_busseats()" />-->
						</td>
						</tr>
						<tr>
						<td>&nbsp;</td>
						<td><strong>Note: </strong><strong>xx</strong> - empty seat.</td>
						</tr>
	</table>
    
  </form>
   
</div>
</fieldset>
<?php 
    include "includes/footer.php";
	}
    else {
	       header("location: busDetails.php");
	}
 }

  ?>