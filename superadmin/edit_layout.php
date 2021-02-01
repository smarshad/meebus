<?php
require("../includes/functions.php");
require("../includes/mysqlclass.php");

//print_r($_REQUEST); exit;

if(isset($_POST['Update_seats'])){

$bus=$_REQUEST['busid'];
$str=$_REQUEST['strid'];
mysql_query("DELETE FROM bus_structure WHERE bus_id=".$bus);
	for($i=1;$i<=50;$i++){
		$val='seat_'.$i;		
			$seat=mysql_real_escape_string($_REQUEST[$val]);
			mysql_query("INSERT INTO bus_structure (bus_id,position,seat_no) VALUES ($bus,$i,'$seat')") or die(mysql_error());
	}
	mysql_query("UPDATE businfo SET Bus_structure=".$str." WHERE Bus_id=".$bus) or die(mysql_error());
	$s=mysql_query("SELECT SP_id FROM businfo WHERE Bus_id=".$bus);
	$b=mysql_fetch_array($s);	
	header("location: ../busDetails.php?sp_id=".$b['SP_id']);
}
else{
$bus_id=$_REQUEST['busid'];
$structureid=$_REQUEST['str_id'];
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

<script type="text/javascript" src="js/floating-gallery.js" >
</script>

<div id="chg_struct">

    <form name="seat_form" id="seat_form" action="" method="post" onsubmit="return validate_busseats()">
    <table cellpadding="3" cellspacing="5" border="0" width="100%" style="border:1px solid #A2BAE6;">
    <tr>
      <td valign="top" width="35"><img src="../images/stearing.gif" alt="bus" title="bus" border="0" /></td>
      <td valign="top"><table cellpadding="3" cellspacing="5" border="0" width="100%" bgcolor="#FFFFFF" id="chk_seats">
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
									?>
          <div class="imageBox" id="<?php if(in_array($r,$seats)) { echo "xx";  } else { echo $seatcount;  }?>">
            <div class="imageBox_theImage" >
            
              <?php if(in_array($r,$seats)) { echo "";  } else { echo $seatcount;  $seatcount++; } ?>
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
	<?php //echo $bus_id; ?>
        <input type="button" style="width:100px" value="Save" name="save2" onclick="saveImageOrder(vipseats,vipfare,<?php echo $bus_id; ?>,<?php echo $structureid; ?>)">
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
      <td><strong>Note: </strong><strong>xx</strong> - empty seat.</td>
    </tr>
    </table>
    </form>
  </div>
<?php
}
?>					