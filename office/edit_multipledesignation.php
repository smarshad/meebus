<?php
include "includes/header.php";
if(isset($_POST['save1'])){
	   $bid1=$_POST['bus_id'];
	  mysql_query("DELETE FROM multi_desi WHERE bus_id='$bid1'");
	  for($i=1;$i<=30;$i++)
	  {
		  $bid=$_POST['bus_id'];
		  $st="s".$i;
		  $ds="d".$i;
		  $fr="f".$i;
		  $fare=$_POST[$fr];
		  $desi=$_POST[$ds];
		  $sour=$_POST[$st];
		  if($sour!=''){
		  mysql_query("INSERT INTO multi_desi (bus_id,source,desi,fare) VALUES ('$bid','$sour','$desi','$fare')") or die(mysql_error());
		  }
		  
	  }
	  $s=mysql_query("SELECT SP_id FROM businfo WHERE Bus_id=".$bid);
	$b=mysql_fetch_array($s);
	
	header("location: busDetails.php?sp_id=".$b['SP_id']);
	  
  }
 if(isset($_REQUEST['exists'])) 
	{
		
		$inbus= $_REQUEST['busid'];
		$vips=$_REQUEST['vipseatsel'];
		$vipfares=$_REQUEST['vipfare'];
		/*echo $vips;
		exit;*/
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
/*mysql_query("DELETE FROM bus_structure WHERE bus_id=".$inbus);*/
	for($ii=0;$ii<$coun;$ii++)
				{
					$cc=$ii+1;
					
					//echo "INSERT INTO bus_structure (bus_id,position,seat_no) VALUES ($inbus,$cc,'$exp[$ii]')"; exit;
					
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
				mysql_query("update  businfo set vip_fare='$vipfares' where Bus_id='$inbus'");
				}
				mysql_query("update  businfo set Bus_structure='$stridd' where Bus_id='$inbus'");	
				
			header("location:companymgnt.php");
			
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
	
	
	//header("location: addmultipledesignation.php?bus_id=".$bus);
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
header("location: companymgnt.php");
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
<fieldset class="table-bor">
  <legend><strong>Add Multiple Designation</strong></legend>
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
      <td colspan="3">Add Multiple Designation</td>
      <td></td>
      <td>
        <input type="hidden" id="busid" name="busid" value="<?php echo $bus_id; ?>"/></td>
    </tr>
  </table>
  <div id="chg_struct">
    <form name="seat_form" id="seat_form" action="" method="post" >
    <table cellpadding="3" cellspacing="5" border="0" width="770px;" style="border:1px solid #A2BAE6;">
    <tr>
      <td valign="top" width="35"></td>
      <td valign="top"><table cellpadding="3" cellspacing="5" border="0" width="100%" bgcolor="#FFFFFF" id="chk_seats">
        <tbody bgcolor="#D4DDEE" style="text-align:center;" class="normal">
        <?php 
$source=array(); 
$desi=array(); 
$fare=array();     
       $ss=mysql_query("SELECT * FROM multi_desi WHERE bus_id='$bus_id'");
	while($bs=mysql_fetch_array($ss)){
         $source[]=$bs['source'];
         $desi[]=$bs['desi'];
         $fare[]=$bs['fare'];   
        }
        for($i=0;$i<30;$i++){$source[$i];$desi[$i];$fare[$i];}
      ?> 
       
       
    <form action="#" method="post">
	<table>
	
	<tr><td>Sno</td><td>Source</td><td>Designation</td><td>Fare</td></tr>
	<tr><td>1</td><td><select id="s1" name="s1" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$source[0]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d1" name="d1" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$desi[0]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f1" id="f1" value="<?php echo $fare[0]; ?>"></td></tr>
	<tr><td>2</td><td><select id="s2" name="s2" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$source[1]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d2" name="d2" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$desi[1]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f2" id="f2"  value="<?php echo $fare[1]; ?>"></td></tr>
	<tr><td>3</td><td><select id="s3" name="s3" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"  <?php if($row['SR_source']==$source[2]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d3" name="d3" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$desi[2]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f3" id="f3"  value="<?php echo $fare[2]; ?>"></td></tr>
	<tr><td>4</td><td><select id="s4" name="s4" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$source[3]){ ?> selected=selected <?php } ?>> <?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d4" name="d4" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$desi[3]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f4" id="f4"  value="<?php echo $fare[3]; ?>"></td></tr>
	<tr><td>5</td><td><select id="s5" name="s5" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$source[4]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d5" name="d5" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$desi[4]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f5" id="f5"  value="<?php echo $fare[4]; ?>"></td></tr>
	<tr><td>6</td><td><select id="s6" name="s6" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$source[5]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d6" name="d6" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$desi[5]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f6" id="f6"  value="<?php echo $fare[5]; ?>"></td></tr>
	<tr><td>7</td><td><select id="s7" name="s7" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$source[6]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d7" name="d7" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$desi[6]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f7" id="f7"  value="<?php echo $fare[6]; ?>"></td></tr>
	<tr><td>8</td><td><select id="s8" name="s8" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$source[7]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d8" name="d8" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$desi[7]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f8" id="f8"  value="<?php echo $fare[7]; ?>"></td></tr>
	<tr><td>9</td><td><select id="s9" name="s9" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$source[8]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d9" name="d9" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$desi[8]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f9" id="f9"  value="<?php echo $fare[8]; ?>"></td></tr>
	<tr><td>10</td><td><select id="s10" name="s10" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$source[9]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d10" name="d10" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>" <?php if($row['SR_source']==$desi[9]){ ?> selected=selected <?php } ?>><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f10" id="f10"  value="<?php echo $fare[9]; ?>"></td></tr>
	<tr><td>11</td><td><select id="s11" name="s11" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d11" name="d11" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f11" id="f11"></td></tr>
	<tr><td>12</td><td><select id="s12" name="s12" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d12" name="d12" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f12" id="f12"></td></tr>
	<tr><td>13</td><td><select id="s13" name="s13" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d13" name="d13" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f13" id="f13"></td></tr>
	<tr><td>14</td><td><select id="s14" name="s14" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d14" name="d14" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f14" id="f14"></td></tr>
	<tr><td>15</td><td><select id="s15" name="s15" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d15" name="d15" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f15" id="f15"></td></tr>
	<tr><td>16</td><td><select id="s16" name="s16" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d16" name="d16" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f16" id="f16"></td></tr>
	<tr><td>17</td><td><select id="s17" name="s17" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d17" name="d17" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f17" id="f17"></td></tr>
	<tr><td>18</td><td><select id="s18" name="s18" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d18" name="d18" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f18" id="f18"></td></tr>
	<tr><td>19</td><td><select id="s19" name="s19" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d19" name="d19" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f19" id="f19"></td></tr>
	<tr><td>20</td><td><select id="s20" name="s20" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d20" name="d20" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f20" id="f20"></td></tr>
	<tr><td>21</td><td><select id="s21" name="s21" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d21" name="d21" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f21" id="f21"></td></tr>
	<tr><td>22</td><td><select id="s22" name="s22" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d22" name="d22" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f22" id="f22"></td></tr>
	<tr><td>23</td><td><select id="s23" name="s23" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d23" name="d23" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f23" id="f23"></td></tr>
	<tr><td>24</td><td><select id="s24" name="s24" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d24" name="d24" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f24" id="f24"></td></tr>
	<tr><td>25</td><td><select id="s25" name="s25" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d25" name="d25" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f25" id="f25"></td></tr>
	<tr><td>26</td><td><select id="s26" name="s26" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d26" name="d26" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f26" id="f26"></td></tr>
	<tr><td>27</td><td><select id="s27" name="s27" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d27" name="d27" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f27" id="f27"></td></tr>
	<tr><td>28</td><td><select id="s28" name="s28" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d28" name="d28" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f28" id="f28"></td></tr>
	<tr><td>29</td><td><select id="s29" name="s29" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d29" name="d29" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f29" id="f29"></td></tr>
	<tr><td>30</td><td><select id="s30" name="s30" class="combobox">			
			<option value="">Select Source Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><select id="d30" name="d30" class="combobox">			
			<option value="">Select Dedsignation Place</option>
			<?php			
			     $src_qry=mysql_query("SELECT SR_source FROM service_routes group by SR_source order by SR_source");
				 while($row=mysql_fetch_array($src_qry)){
			?>			
			<option value="<?php echo $row['SR_source']; ?>"><?php echo get_city_name($row['SR_source']); ?></option>									
			<?php } ?>
			</select></td><td><input type="text" name="f30" id="f30">
	
	<input type="hidden" name="bus_id" value="<?php echo $bus_id; ?>"></td></tr>

	
	</table>
     
    <div style="clear:both;padding-bottom:10px">
        <input type="submit" style="width:100px" value="Save" name="save1" >
      </div>
    </form>
    <div id="insertionMarker"> <img src="images/marker_top.gif"> <img src="images/marker_middle.gif" id="insertionMarkerLine"> <img src="images/marker_bottom.gif"> </div>
    <div id="dragDropContent"> </div>
    <div id="debug" style="clear:both;"> </div>
    </tbody>
    </table>
    </td>
    </tr>
    <tr>
      <td><input type="hidden" id="busid" name="busid" value="<?php echo $bus_id; ?>"/></td>
      <td><!--<input type="submit" id="bus_seats" name="bus_seats" value="Fix This Structure" onclick="return validate_busseats()" />--> 
        <!--<input type="button" id="bus_seats" name="bus_seats" value="Fix This Structure" onclick="return validate_busseats()" />--></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td></td>
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
 