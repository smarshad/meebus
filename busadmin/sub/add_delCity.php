<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");

if(isset($_REQUEST['opt']) && isset($_REQUEST['cityid'])){
   $opt=mysql_real_escape_string($_REQUEST['opt']);
   $val=mysql_real_escape_string($_REQUEST['cityid']);
   
   if(isset($_REQUEST['editcity']))
      $id=$_REQUEST['editcity'];
   if($opt=='add'){
   $sql="INSERT INTO cities (city_name,status) VALUES ('".$val."',1)";
   mysql_query($sql) or die(mysql_error());
   }
   elseif($opt=='del'){
   $sql="DELETE FROM cities WHERE id=".$val;
   mysql_query($sql) or die(mysql_error());
   }
   elseif($opt=='edit'){
   $sql="UPDATE cities SET city_name='".$val."' WHERE id=".$id;
   mysql_query($sql) or die(mysql_error());
   }
  } 
?>