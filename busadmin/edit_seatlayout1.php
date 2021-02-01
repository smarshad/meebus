<?php
include "includes/header.php";

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
	http.open('POST','sub/edit_bus_structure.php?busid='+busid+'&str_id='+strctureID+'&nocache='+nocache,true);	
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
function validate_busseats(){
var form=document.seat_form;

for(var i=0; i<form.elements.length; i++)
{
 if(form.elements[i].value==''){
    alert('Please Enter Seat Number');    
	document.getElementById(form.elements[i].name).focus();
	return false;
   }
  else{
  //document.getElementById(form.elements[i].name+'_err').style.display='none';
  } 
}
   return true;  
   }

/*function AllowcharNum(e)
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
	}*/	   
 </script>
<a href="busDetails.php?sp_id=<?php echo $bus->SP_id; ?>"><?php echo get_SP_name($bus->SP_id); ?></a>&nbsp; >> &nbsp;<a href="editBus.php?busid=<?php echo $bus->Bus_id; ?>"><?php echo $bus->Bus_name; ?></a>&nbsp; >> &nbsp;<strong>Edit Bus Structure</strong>
<fieldset class="table-bor">
<legend><strong>Edit Bus Structure</strong></legend>
<table>
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
<table cellpadding="3" cellspacing="5" border="0" width="100%" style="border:1px solid #A2BAE6;">
						<tr>
							<td valign="top" width="35"><img src="../images/stearing.gif" alt="bus" title="bus" border="0" /></td>
							<td valign="top">						
								<table cellpadding="3" cellspacing="5" border="0" width="100%" bgcolor="#FFFFFF" id="chk_seats">
									<tbody bgcolor="#D4DDEE" style="text-align:center;" class="normal">
									<?php 
									$seat_qry=mysql_query("SELECT bus_id FROM bus_structure WHERE bus_id=".$bus_id);
									$c=mysql_num_rows($seat_qry);									
										 $r=0;
										 for($i=1;$i<=5;$i++){
										 echo "<tr>";
										 for($j=1;$j<=10;$j++){
											$r=$r+1;
									?>
									<td width="8%">Pos: <?php echo $r; ?>	
									<?php	
									if($c>0){
									$seat_sql=mysql_query("SELECT seat_no FROM bus_structure WHERE bus_id=".$bus_id." AND position=".$r);
									$seat=mysql_fetch_object($seat_sql);									
									?>																
									<input class="txtbox" type="<?php if(!in_array($r,$seats)){ echo 'text'; } else { echo 'hidden'; }?>"  name="<?php echo "seat_".$r ?>" id="<?php echo "seat_".$r ?>" size="2" maxlength="2" value="<?php echo $seat->seat_no; ?>" <?php if(in_array($r,$seats)){ ?> value="xx"  <?php } ?> onkeydown="return AllowcharNum(event)" />
									<?php }
									else{
									 ?>
									 <input class="txtbox" type="<?php if(!in_array($r,$seats)){ echo 'text'; } else { echo 'hidden'; }?>"  name="<?php echo "seat_".$r ?>" id="<?php echo "seat_".$r ?>" size="2" maxlength="2" <?php  if(in_array($r,$seats)){ ?> value="xx" <?php } else {?> value="" <?php } ?> onkeydown="return AllowcharNum(event)" />
									 <?php
									 }
									 ?>
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
						<td><input type="hidden" id="busid" name="busid" value="<?php echo $bus_id; ?>"/></td>
						<td><input type="submit" id="bus_seats" name="bus_seats" value="Fix This Structure" onclick="return validate_busseats()" /></td>
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
 } ?>