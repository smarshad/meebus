<?php
include "includes/header.php";
?>
<script src="../js/pagination.js" type="text/javascript"></script>
<script type="text/javascript">
function editcancelfun(){	
	document.getElementById('txtcity').value="";	
	//document.getElementById('txtcity').focus();
	document.getElementById('addopt').style.display="block";
	document.getElementById('editopt').style.display="none";
}
</script>
<?php 
if(isset($_REQUEST['add_frmsubmit'])){
//echo "dfsd"; exit;

  $opt=mysql_real_escape_string($_REQUEST['opt']);
   $val=mysql_real_escape_string($_REQUEST['cityid']);
   $point=$_REQUEST['txtpoint'];
  
  
   if($opt=='add')
   {
   //echo $opt; exit;
   $sel_search=mysql_query("SELECT * FROM board_points WHERE board_name='$point' and board_status='0'");
   if(mysql_num_rows($sel_search)>0){
   $rx='';
      while($row=mysql_fetch_array($sel_search)){
	      $str1=strtolower($point);
		  $str2=strtolower($row['board_name']);
		  if($str1 == $str2){
		     $rx=0;
			 break;   
		  }
		  else{
		     $rx=1;
		  }
	  }
	  //echo $rx; exit;
	  if($rx==1){
          $sql="INSERT INTO board_points (board_city,board_name,board_status,board_date) VALUES ('".$val."','".$point."',0,NOW())";
          mysql_query($sql) or die(mysql_error());
          header("location:stop_point.php?cityid=$val&msg=Added Successfully !!!");
	  }
	  else{
	      header("location:stop_point.php?cityid=$val&msg=Already Exists !!!");
	  }
   }
   else 
   {
    $sql="INSERT INTO board_points (board_city,board_name,board_status,board_date) VALUES ('".$val."','".$point."',0,NOW())";
          mysql_query($sql) or die(mysql_error());
          header("location:stop_point.php?cityid=$val&msg=Added Successfully !!!");
   
   }
   /*$sel_search=mysql_query("SELECT id FROM cities WHERE city_name='".$val."'");
   if(mysql_num_rows($sel_search) == 0){
   $sql="INSERT INTO cities (city_name,status) VALUES ('".$val."',1)";
   mysql_query($sql) or die(mysql_error());
   echo "1";
   }
   else{
    echo "0-".$val;
   }*/
   }
  }
  
  if(isset($_REQUEST['edit_frmsubmit']))
  {
   $opt=mysql_real_escape_string($_REQUEST['opt']);
   $val=mysql_real_escape_string($_REQUEST['cityid']);
   $id=mysql_real_escape_string($_REQUEST['board_id']);
   $point=$_REQUEST['txtpoint'];
  
  if($opt=='edit'){   
   $sel_search=mysql_query("SELECT * FROM board_points WHERE  board_name='$point' and board_status=0");
   if(mysql_num_rows($sel_search)>0){
   $rx='';
      while($row=mysql_fetch_array($sel_search)){
	      $str1=strtolower($point);
		  $str2=strtolower($row['board_name']);
		  if($str1 == $str2){
		     $rx=0;
			 break;   
		  }
		  else{
		     $rx=1;
		  }
	  }
	  
	  if($rx==1){
            $sql="UPDATE board_points SET board_name='".$point."' WHERE board_id=".$id;
            mysql_query($sql) or die(mysql_error()); 
			//echo "<b style='text-align:center;'>Updated Successfully !!!</b>";   
			header("location:stop_point.php?cityid=$val&msg=Updated Successfully !!!");
           
	  }
	  else{
	 // echo "<b style='text-align:center;'>Already Exists !!!</b>";
	  header("location:stop_point.php?cityid=$val&msg=Already Exists !!!");
	      
	  }
   }
   else {  $sql="UPDATE board_points SET board_name='".$point."' WHERE board_id=".$id;
            mysql_query($sql) or die(mysql_error());
			//echo "<b style='text-align:center;'>Updated Successfully !!!</b>";   
			header("location:stop_point.php?cityid=$val&msg=Updated Successfully !!!");
			
            
			 }
   
  }
  } 
  
  
  if(isset($_REQUEST['act']))
  {
  $act=$_REQUEST['act'];
     $sql="UPDATE board_points SET board_status='".$act."' WHERE board_id=".$_REQUEST['board_id'];
   mysql_query($sql) or die(mysql_error());
  header("location:stop_point.php?cityid=$_REQUEST[cityid]&msg=Action Performed Successfully !!!");
  
  
  }


 if(isset($_REQUEST['delete']))
  {
  
     $sql="delete from board_points WHERE board_id=".$_REQUEST['board_id'];
   mysql_query($sql) or die(mysql_error());
  header("location:stop_point.php?cityid=$_REQUEST[cityid]&msg=Deleted Successfully !!!");
  
  
  }



$edit=mysql_fetch_array(mysql_query("select * from board_points  where board_id='$_REQUEST[board_id]'"));

?>

<body onLoad="search_point();">
<?php 
if(isset($_REQUEST['msg'])) {
?>
<b style="color:#FF0000;"><?php echo $msg; ?></b>
 <?php } ?>
<fieldset class="table-bor">




<legend><strong>Stopping Management</strong></legend>	
<table width="74%" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
  
  <td>City Name : </td>
   <td style="font-weight:bold; ">
   <?php $cityfet=mysql_fetch_array(mysql_query("select * from cities where id='$_REQUEST[cityid]'")); 
   
   echo $cityfet['city_name'];
   
   ?></td>
  
  
    <td valign="top" width="50%" nowrap="nowrap">
	
	<form action="" method="post">

	<table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td nowrap="nowrap">
		    <div id="tit_div">Enter stopping point: </div>
		</td>
        <td nowrap="nowrap">
		
		<input type="hidden" id="cityid" name="cityid" value="<?php echo $_REQUEST['cityid']; ?>">
		<input name="txtpoint" type="text" id="txtpoint" value="<?php echo $edit['board_name']; ?>" size="30" maxlength="100" class="textbox" />
		</td>
		<td nowrap="nowrap">
		<?php if(isset($_REQUEST['edit'])) { ?>
		<input type="hidden" name="opt" id="opt" value="edit">
		<input type="hidden" id="board_id" name="board_id" value="<?php echo $_REQUEST['board_id']; ?>">
		<input name="edit_frmsubmit" type="submit" id="frmsubmit" value="edit &gt;&gt;" />
		 
		 <?php } else { ?>
		 <input type="hidden" name="opt" id="opt" value="add">
			<input name="add_frmsubmit" type="submit" id="frmsubmit" value="Add &gt;&gt;" />
			<?php } ?>
		</td>
      </tr>
    </table>
	</form>
	
	</td>
  </tr>
</table>
<hr/>
<table width="50%" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
    <br />Search: <select name="search_point" id="search_point" style="width:150px; height:20px;" onChange="return search_point();">
	               <option value="">--select--</option>
				   <?php
				   $sqlqry=mysql_query("select * from board_points where board_city='$_REQUEST[cityid]'");
				   while($rowwqry=mysql_fetch_array($sqlqry))
				   {
				    ?>
	              <option value="<?php echo $rowwqry['board_id']; ?>"><?php echo $rowwqry['board_name']; ?></option>
				  <?php } ?>
	              </select>
				  <input type="hidden" name="status" id="status" value="<?php echo $_REQUEST['cityid']; ?>">
  </tr>
	<tr><td>&nbsp;</td></tr>
	<tr>   
	<div id="loading"></div>
	 <div id="container">
	 &nbsp;
	  <div class="data" id="gan"></div>	
	 </div>	
  </tr>
</table>
<div class="pagination"></div>
</fieldset>
</body>
<?php include "includes/footer.php"; ?>