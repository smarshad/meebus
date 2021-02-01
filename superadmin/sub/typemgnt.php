<?php 
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");

if(isset($_REQUEST['opt']) && isset($_REQUEST['val'])){
   $opt=mysql_real_escape_string($_REQUEST['opt']);
   $val=mysql_real_escape_string($_REQUEST['val']);
   $id=mysql_real_escape_string($_REQUEST['id']);
   
   if($opt=='add'){
   $sel_search=mysql_query("SELECT * FROM bustypes WHERE del_status=1");
   if(mysql_num_rows($sel_search) > 0){
      while($row=mysql_fetch_array($sel_search)){
	  $str1=strtolower($row['typeName']);
	  $str2=strtolower($val);
	        if($str1 == $str2){			   
			   $r=0;
			   break;
			}
			else{
			 $r=1;
			}
	  }
	if($r==1){  
	  $sql="INSERT INTO bustypes (typeName,typeStatus) VALUES ('".$val."',1)";
      mysql_query($sql) or die(mysql_error());  
	}
   }
   else{
    $sql="INSERT INTO bustypes (typeName,typeStatus) VALUES ('".$val."',1)";
    mysql_query($sql) or die(mysql_error());   
    $r=1;
   }
/*   $sel_search=mysql_query("SELECT * FROM bustypes WHERE typeName = '".$val."'");
   if(mysql_num_rows($sel_search) == 0){
    $sql="INSERT INTO bustypes (typeName,typeStatus) VALUES ('".$val."',1)";
    mysql_query($sql) or die(mysql_error());
	$r=1;
   }
   else{
        $r=0;
   }*/
   }
   elseif($opt=='del'){
   $sql="UPDATE `bustypes` SET `del_status` = '0' WHERE typeID =".$val;
   mysql_query($sql) or die(mysql_error());
   }
   elseif($opt=='edit'){
   $sel_search=mysql_query("SELECT * FROM bustypes WHERE del_status=1");
   if(mysql_num_rows($sel_search) > 0){
      while($row=mysql_fetch_array($sel_search)){
	  $str1=strtolower($row['typeName']);
	  $str2=strtolower($val);
	        if($str1 == $str2){			   
			   $r=0;
			   break;
			}
			else{
			 $r=1;
			}
	  }
	if($r==1){  
	  $sql="UPDATE bustypes SET typeName = '".$val."' WHERE typeID=".$id;
      mysql_query($sql) or die(mysql_error());  
	}
   }
   /*
   $sel_search=mysql_query("SELECT * FROM bustypes WHERE typeName = '".$val."'");
   if(mysql_num_rows($sel_search) == 0){   
   $sql="UPDATE bustypes SET typeName = '".$val."' WHERE typeID=".$id;
   mysql_query($sql) or die(mysql_error());
   $r=1;
   }
   else{
     $r=0;
   }
   */}
   elseif($opt=='unblock'){
   $sql="UPDATE bustypes SET typeStatus = 0 WHERE typeID=".$val;
   mysql_query($sql) or die(mysql_error());
    }
   elseif($opt=='block'){
   $sql="UPDATE bustypes SET typeStatus = 1 WHERE typeID=".$val;
   mysql_query($sql) or die(mysql_error());   
   }  
   ?>
   <?php if(isset($r)) { echo $r."||";  } ?><table width="194" border="0" cellspacing="5" cellpadding="5">
      <tr>
        <th width="50">Type</th>
		<th width="61" align="center">Action</th>
      </tr>
	  <?php
	$brs = $db->query("select * from bustypes WHERE del_status=1 order by typeName");
	while ($brow = $db->fetch_array($brs))
	{
	 if($brow['typeName'] !=''){
	?>
      <tr align="center">
        <td><?php echo $brow['typeName']; ?></td>
		<td align="center">
		<?php if($brow['typeStatus'] == 1) { ?>
		<a href="javascript:void(0)" onclick='javascript:inactivetype(<?php echo $brow['typeID']; ?>)' title="Click to Block">
		<img src="../images/Active.png" border="0" /></a>
		<?php } else { ?>
		<a href="javascript:void(0)" onclick='javascript:activetype(<?php echo $brow['typeID']; ?>)' title="Click to Unblock">
		<img src="../images/inactive.png" border="0" /></a>
		<?php } ?>
		<a href="javascript:void(0)" onclick="edit_form('<?php echo $brow['typeID']; ?>','<?php echo $brow['typeName']; ?>');" title="Edit">
		<img src="../images/edit.png" border="0" /></a>
		<a href="javascript:void(0)" onclick='javascript:deltype(<?php echo $brow['typeID']; ?>)' title="Delete">
		<!--<a href="javascript:void(0)" onclick='javascript:alert("This is Demo version !!! ");' title="Delete">-->
		<img src="../images/delete.png" border="0" /></a>&nbsp;&nbsp;		
		</td>
      </tr>
	  <?php } } ?>
    </table>
   <?php
}
?>