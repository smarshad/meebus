<?php
include "includes/header.php";


if(isset($_GET['id']))
{
	$id=$_GET['id'];

	$query=mysql_query("SELECT * FROM busstructuretypes WHERE structureID='$id'");
	$res = mysql_fetch_array($query);
} 
if(isset($_POST['Delete']))
{
	$struct_id=$_POST['struc_id'];
		
	$delete=mysql_query("DELETE FROM busstructuretypes WHERE structureID='$struct_id'");
	
}
?>

<fieldset class="table-bor">

	<legend><strong>Seat Layout Management</strong></legend>
  <form action="addSeatType.php" method="post" id="seatType" name="seatType">

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">

     <?php if(isset($_SESSION['msg']) && $_SESSION['msg']!='') { ?>
  <tr>
    <td colspan="4" align="center" valign="middle" style="color:#03C; font-weight:bold;"><?php echo $_SESSION['msg']; $_SESSION['msg']=''; ?></td>
    </tr>
    <?php } ?>
    
  <tr>
    <td width="16%" height="50">Seat Type</td>
    <td width="34%"> &nbsp;&nbsp;
       <input type="text" name="seat_type" id="seat_type" required="required" value="<?php if(isset($id)) { echo $res['structureType']; }?>" /><input type="hidden" name="id"  value="<?php if(isset($id)) { echo $id; } else { echo 0; }?>" /></td>
    <td width="17%"> Upper</td>
    <td width="33%"> &nbsp;&nbsp;
      <input type="radio" name="upper" value="1" required="required" <?php if(isset($res['upper_seat']) && $res['upper_seat']==1) echo "checked";?> />Yes</input>
      <input type="radio" name="upper" value="0"  required="required" <?php if(isset($res['upper_seat']) && $res['upper_seat']==0) echo "checked";?> />No</input></td>
  </tr>
  <tr id="upper_left">
    <td width="20%" height="50">Upper Left Column</td>
    <td width="34%"> &nbsp;&nbsp;
       <input type="text" name="upper_left_col" id="upper_left_col"  value="<?php if(isset($id)) { echo $res['upper_left_col']; }?>" /></td>
    <td width="17%">Upper Left Row</td>
    <td width="33%">  &nbsp;&nbsp;
      <input type="text" name="upper_left_row" id="upper_left_row" value="<?php if(isset($id)) { echo $res['upper_left_row']; }?>" /></td>
  </tr>
  <tr id="upper_right">
    <td width="20%" height="50">Upper Right Column</td>
    <td width="34%"> &nbsp;&nbsp;
       <input type="text" name="upper_right_col" id="upper_right_col"  value="<?php if(isset($id)) { echo $res['upper_right_col']; }?>"/></td>
    <td width="17%" class="markup">Upper Right Row</td>
    <td width="33%">  &nbsp;&nbsp;
      <input type="text" name="upper_right_row" id="upper_right_row" value="<?php if(isset($id)) { echo $res['upper_right_row']; }?>"/></td>
  </tr>
  <tr id="upper_type">
    <td height="50">Upper Left Seat Type</td>
    <td> &nbsp;&nbsp;<input type="text" name="upperleftseat" id="upperleftseat" value="<?php if(isset($id)) { echo $res['upper_left_type']; }?>" /></td>
    <td height="50">Upper Right Seat Type</td>
    <td> &nbsp;&nbsp;<input type="text" name="upperrightseat" id="upperrightseat" value="<?php if(isset($id)) { echo $res['upper_right_type']; }?>" /></td>
  </tr>
  <tr id="lower_left">
    <td width="20%" height="50">Lower Left Column</td>
    <td width="34%"> &nbsp;&nbsp;
       <input type="text" name="lower_left_col" id="lower_left_col" required="required" value="<?php if(isset($id)) { echo $res['lower_left_col']; }?>" /></td>
    <td width="20%" class="markup">Lower Left Row</td>
    <td width="33%">  &nbsp;&nbsp;
      <input type="text" name="lower_left_row" id="lower_left_row" required="required" value="<?php if(isset($id)) { echo $res['lower_left_row']; }?>" /></td>
  </tr>
  <tr id="lower_right">
    <td width="20%" height="50">Lower Right Column</td>
    <td width="34%"> &nbsp;&nbsp;
       <input type="text" name="lower_right_col" id="lower_right_col" required="required" value="<?php if(isset($id)) { echo $res['lower_right_col']; }?>" /></td>
    <td width="20%" class="markup">Lower Right Row</td>
    <td width="33%">  &nbsp;&nbsp;
      <input type="text" name="lower_right_row" id="lower_right_row" required="required" value="<?php if(isset($id)) { echo $res['lower_right_row']; }?>" /></td>
  </tr>
  <tr id="lower_type">
    <td height="50">Lower Left Seat Type</td>
    <td> &nbsp;&nbsp;<input type="text" name="lowerleftseat" id="lowerleftseat"  required="required" value="<?php if(isset($id)) { echo $res['lower_left_type']; }?>" /></td>
    <td height="50">Lower Right Seat Type</td>
    <td> &nbsp;&nbsp;<input type="text" name="lowerrightseat" id="lowerrightseat"  required="required" value="<?php if(isset($id)) { echo $res['lower_right_type']; }?>" /></td>
  </tr>
  <tr>
  
    <td height="50" colspan="4" align="center" valign="middle"><?php if(isset($id)) { ?><input type="submit" id="submit" size="5" name="submit" value="Submit" /> <?php  } else { ?><input type="submit" id="add" size="5" name="add" value="Add" /> <?php } ?></td>
    </tr>
</table>
	
    </form>

	<table width="100%" border="0"  cellspacing="1" class="site_border" align="center" bgcolor="#ffffff" >

                        <tr><td colspan="14" class="sidebartitle" align="center">Seat Layout</td></tr>

                        <tr>

                            <td  align="left"  bgcolor="#EFEBEE"  class="inotice">S.No</td>

                            <td  align="left"  bgcolor="#EFEBEE"class="inotice" >Structure Type</td>

                            <td  align="left"  bgcolor="#EFEBEE" class="inotice">Upper Seat Availability</td>

                            <td  align="left"  bgcolor="#EFEBEE" class="inotice">Upper Left Column</td>

                            <td  align="left"  bgcolor="#EFEBEE" class="inotice">Upper Left Row</td>
                           
                            <td  align="left"  bgcolor="#EFEBEE" class="inotice">Upper Left Type </td>

                            <td  align="left"  bgcolor="#EFEBEE" class="inotice">Upper Right Column</td>

                            <td  align="left"  bgcolor="#EFEBEE" class="inotice">Upper Right Row</td>
                           
                            <td  align="left"  bgcolor="#EFEBEE" class="inotice">Upper Right Type </td>
                            
                            <td  align="left"  bgcolor="#EFEBEE" class="inotice">Lower Left Column</td>

                            <td  align="left"  bgcolor="#EFEBEE" class="inotice">Lower Left Row</td>
                           
                            <td  align="left"  bgcolor="#EFEBEE" class="inotice">Lower Left Type </td>

                            <td  align="left"  bgcolor="#EFEBEE" class="inotice">Lower Right Column</td>

                            <td  align="left"  bgcolor="#EFEBEE" class="inotice">Lower Right Row</td>
                           
                            <td  align="left"  bgcolor="#EFEBEE" class="inotice">Lower Right Type </td>

                             <td  align="left"  bgcolor="#EFEBEE" class="inotice">Edit</td>
                             
                             <td  align="left"  bgcolor="#EFEBEE" class="inotice">Delete</td>


                        </tr>

                      

						  <?php 

      

	   $objQuery = mysql_query("SELECT * FROM busstructuretypes ORDER BY structureID ASC");

       $i=1;

       while($objResult = mysql_fetch_object($objQuery))

       {

		   ?>

                        <tr>

                            <td  class="normal"><?php  echo $i;?></td>
                            <td class="normal"><?php echo $objResult->structureType; ?></td>
                            <td class="normal">
							<?php 	if($objResult->upper_seat==1)
										{
											echo 'Yes';
										}
								    else
										{
											echo 'No';
										}
							 ?>
                            </td>
                            <td class="normal"><?php echo $objResult->upper_left_col; ?></td>                          
                            <td class="normal"><?php echo $objResult->upper_left_row; ?></td> 
                            <td class="normal"><?php echo $objResult->upper_left_type; ?></td>
                            <td class="normal"><?php echo $objResult->upper_right_col; ?></td>
                            <td class="normal"><?php echo $objResult->upper_right_row; ?></td>
                            <td class="normal"><?php echo $objResult->upper_right_type; ?></td>
                            <td class="normal"><?php echo $objResult->lower_left_col; ?></td>
                            <td class="normal"><?php echo $objResult->lower_left_row; ?></td>
                            <td class="normal"><?php echo $objResult->lower_left_type; ?></td>
                            <td class="normal"><?php echo $objResult->lower_right_col; ?></td>
                            <td class="normal"><?php echo $objResult->lower_right_row; ?></td>
                            <td class="normal"><?php echo $objResult->lower_right_type; ?></td>
							<td class="normal"><a href="seatLayoutmgmt.php?id=<?php echo $objResult->structureID;?>"> Edit</a></td>
                            <td align="left" class="normal">
                                       <form method="post" action="" onsubmit="return confirm('Are you Sure to Delete');">
                                            <input type="hidden" value="<?php echo $objResult->structureID; ?>" name="struc_id" />
                                            <input src="images/deletered.png" alt="Delete" name="Delete" width="14" height="14"  border="0"  type="image" value="Delete" id="<?php echo $objResult->structureID; ?>"/>
                                            <input type="hidden" name="Delete" value="Delete" />
								   </form> 
                                    </td>

                        </tr>

                            <?php $i++; } ?>

                    </table>
</fieldset>
	 
</body>

<?php include "includes/footer.php";
?>

<script>
var value = $( 'input[name=upper]:checked' ).val();
if(value==1)
{
	$("#upper_left").show();
	$("#upper_right").show();
	$("#upper_type").show();
}
else
{
	$("#upper_left").hide();
	$("#upper_right").hide();
	$("#upper_type").hide();
}

$('input[name=upper]').change(function(){
var value = $( 'input[name=upper]:checked' ).val();
if(value==1)
{
	$("#upper_left").show();
	$("#upper_right").show();
	$("#upper_type").show();
}
else
{
	$("#upper_left").hide();
	$("#upper_right").hide();
	$("#upper_type").hide();
}
});
</script>
<!--<script type="text/javascript">
function edit_form(id,name)
{ 
	document.getElementById('edt').style.visibility="visible";
	document.getElementById('ad').style.visibility="hidden";
	document.getElementById('edt').style.position = 'static' ;
	document.getElementById('txtbustype').value=name;
	document.getElementById('txtbusid').value=id;
}
function edit_cancel()
{ 
	document.getElementById('edt').style.visibility="hidden";
	document.getElementById('ad').style.visibility="visible";
	//document.getElementById('edt').style.position = 'static' ;
	document.getElementById('txtbustype').value="";
	//document.getElementById('txtbusid').value=id;
}

function addtype()
{
	var seatType=document.getElementById('txtbus').value;
	$.post("addSeatType.php?type="+seatType , function (data) {
		
	});
}
</script>-->