<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");

if(!isset($_REQUEST['bus_seats'])){
		 if(isset($_REQUEST['str_id'])){
			$busid=mysql_real_escape_string($_REQUEST['busid']);
			$str=mysql_real_escape_string($_REQUEST['str_id']);
			$strID=getStructureName($_REQUEST['str_id']);
			$structureid=$_REQUEST['str_id'];
	//print_r($_REQUEST);		 exit;
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
    mysql_query("UPDATE businfo SET Bus_structure=".$str." WHERE Bus_id=".$busid) or die(mysql_error());
?>
<script type="text/javascript">

function validate_busseats(){
var form=document.seat_form;

for(i=0; i<form.elements.length; i++)
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
   return false;  
   } 
</script>
	<form name="seat_form" action="sub/seat_layout.php" method="post" onSubmit="return validate_busseats()">
	<input type="hidden" id="busid" name="busid" value="<?php echo $busid; ?>"/>
	<div id="chg_struct">
	<table cellpadding="3" cellspacing="5" border="0" width="100%" style="border:1px solid #A2BAE6;">
						<tr>
							<td valign="top" width="35"><img src="../images/stearing.gif" alt="bus" title="bus" border="0" /></td>
							<td valign="top">						
								<table cellpadding="3" cellspacing="5" border="0" width="100%" bgcolor="#FFFFFF" id="chk_seats">
									<tbody bgcolor="#D4DDEE" style="text-align:center;" class="normal">
									<?php 									
										 $r=0;
										 for($i=1;$i<=5;$i++){
										 echo "<tr>";
										 for($j=1;$j<=10;$j++){
											$r=$r+1;
									?>
									<td width="8%">Pos: <?php echo $r; ?>	
									<input type="<?php if(!in_array($r,$seats)){ echo 'text'; } else { echo 'hidden'; }?>"
 name="<?php echo "seat_".$r ?>" id="<?php echo "seat_".$r ?>" size="2" maxlength="2" <?php if(in_array($r,$seats)) { ?> value="xx" style="background:#666666;" <?php } else {?> value="<?php echo $seat->seat_no; ?>" <?php } ?> onkeydown="return AllowcharNum(event);" />
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
						<td></td>
						<td><input type="submit" id="bus_seats" name="bus_seats" value="Fix This Structure" onClick="return validate_busseats()" /></td>
						</tr>
					</table>
					</div>
					</form>
	<?php
 }
}
else{
	$bus=$_REQUEST['busid'];
	for($i=1;$i<=50;$i++){
		$val='seat_'.$i;		
			$seat=mysql_real_escape_string($_REQUEST[$val]);
			mysql_query("INSERT INTO bus_structure (bus_id,position,seat_no) VALUES ($bus,$i,'$seat')") or die(mysql_error());
	}
	$s=mysql_query("SELECT SP_id FROM businfo WHERE Bus_id=".$bus);
	$b=mysql_fetch_array($s);
	
	header("location: ../busDetails.php?sp_id=".$b['SP_id']);
}
?>				