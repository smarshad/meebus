<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
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
$busid=mysql_real_escape_string($_REQUEST['busid']);
$structureid=mysql_real_escape_string($_REQUEST['str_id']);
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
<form name="seat_form" action="sub/edit_bus_structure.php" method="post">
<table cellpadding="3" cellspacing="5" border="0" width="100%" style="border:1px solid #A2BAE6;">
						<tr>
							<td valign="top" width="35"><img src="../images/stearing.gif" alt="bus" title="bus" border="0" /></td>
							<td valign="top">						
								<table cellpadding="3" cellspacing="5" border="0" width="100%" bgcolor="#FFFFFF" id="chk_seats">
									<tbody bgcolor="#D4DDEE" style="text-align:center;" class="normal">
									<?php 
									$seat_qry=mysql_query("SELECT bus_id FROM bus_structure WHERE bus_id=".$busid);
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
									$seat_sql=mysql_query("SELECT seat_no FROM bus_structure WHERE bus_id=".$busid." AND position=".$r);
									$seat=mysql_fetch_object($seat_sql);
									?>																
									<input class="txtbox" type="<?php if(!in_array($r,$seats)){ echo 'text'; } else { echo 'hidden'; }?>" name="<?php echo "seat_".$r ?>" id="<?php echo "seat_".$r ?>" size="2" maxlength="2" <?php if(in_array($r,$seats)){ ?> value="xx"  <?php } else{ ?> value="<?php echo $seat->seat_no; ?>" <?php } ?> onkeydown="return AllowcharNum(event)"/>
									<?php }
									else{
									 ?>
									 <input class="txtbox" type="<?php if(!in_array($r,$seats)){ echo 'text'; } else { echo 'hidden'; }?>" name="<?php echo "seat_".$r ?>" id="<?php echo "seat_".$r ?>" size="2" maxlength="2" <?php if(in_array($r,$seats)){ ?> value="xx"  <?php } else {?> value="<?php echo $seat->seat_no; ?>" <?php } ?> onkeydown="return AllowcharNum(event)"/>
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
						<td><input type="hidden" id="busid" name="busid" value="<?php echo $busid; ?>"/>
						<input type="hidden" id="strid" name="strid" value="<?php echo $structureid; ?>"/>
						</td>
						<td><input type="submit" id="Update_seats" name="Update_seats" value="Fix This Structure" /></td>
						</tr>
					</table>
					</form>
<?php
}
?>					