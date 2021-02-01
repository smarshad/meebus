<?php
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");

if(isset($_REQUEST['opt']) && isset($_REQUEST['cityid'])){
   $opt=mysql_real_escape_string($_REQUEST['opt']);
   $val=mysql_real_escape_string($_REQUEST['cityid']);
   
   if(isset($_REQUEST['editcity']))
      $id=$_REQUEST['editcity'];
	  
   if($opt=='add'){
   $sel_search=mysql_query("SELECT * FROM cities WHERE del_status=1");
   if(mysql_num_rows($sel_search)>0){
   $rx='';
      while($row=mysql_fetch_array($sel_search)){
	      $str1=strtolower($val);
		  $str2=strtolower($row['city_name']);
		  if($str1 == $str2){
		     $rx=0;
			 break;   
		  }
		  else{
		     $rx=1;
		  }
	  }
	  
	  if($rx==1){
          $sql="INSERT INTO cities (city_name,status) VALUES ('".$val."',1)";
          mysql_query($sql) or die(mysql_error());
          echo "1";	     
	  }
	  else{
	      echo "0-".$val; 
	  }
   }
   else{
   $sql="INSERT INTO cities (city_name,status) VALUES ('".$val."',1)";
   mysql_query($sql) or die(mysql_error());
   echo "1";  
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
   elseif($opt=='del'){
   //$sql="UPDATE cities SET del_status=0 WHERE id=".$val;
   $sql="DELETE from cities WHERE id=".$val; 
   mysql_query($sql) or die(mysql_error());
   }
   elseif($opt=='edit'){   
   $sel_search=mysql_query("SELECT * FROM cities WHERE del_status=1");
   if(mysql_num_rows($sel_search)>0){
   $rx='';
      while($row=mysql_fetch_array($sel_search)){
	      $str1=strtolower($val);
		  $str2=strtolower($row['city_name']);
		  if($str1 == $str2){
		     $rx=0;
			 break;   
		  }
		  else{
		     $rx=1;
		  }
	  }
	  
	  if($rx==1){
            $sql="UPDATE cities SET city_name='".$val."' WHERE id=".$id;
            mysql_query($sql) or die(mysql_error());
            echo "1";   
	  }
	  else{
	      echo "0-".$val; 
	  }
   }
   else{
    $sql="UPDATE cities SET city_name='".$val."' WHERE id=".$id;
    mysql_query($sql) or die(mysql_error());
   echo "1"; 
   }   
   /*   
    $sel_search=mysql_query("SELECT id FROM cities WHERE city_name='".$val."'");
   if(mysql_num_rows($sel_search) == 0){  
    $sql="UPDATE cities SET city_name='".$val."' WHERE id=".$id;
    mysql_query($sql) or die(mysql_error());
   echo "1";
   }
   else{
    echo "0-".$val;
   }	
   */}
  } 
?>