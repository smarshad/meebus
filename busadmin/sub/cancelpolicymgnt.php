<?php 
session_start();
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");
if(isset($_REQUEST['opt']) && isset($_REQUEST['val'])){
   $opt=mysql_real_escape_string($_REQUEST['opt']);
   $val=mysql_real_escape_string($_SESSION['SP_id']);
   $duration=mysql_real_escape_string($_REQUEST['duration']);
   $time=mysql_real_escape_string($_REQUEST['time']);
   $refund=mysql_real_escape_string($_REQUEST['refund']);
   $c_id=mysql_real_escape_string($_REQUEST['c_id']);
   
   if($opt=='add'){
   $sql="INSERT INTO cancellation_policies (cancelpolicy_id,SP_id,duration,time,refundable_amt,status) VALUES ('','".$val."','".$duration."','".$time."','".$refund."',1)";
   mysql_query($sql) or die(mysql_error());
   }
   elseif($opt=='del'){
   $val=$_REQUEST['val'];
   $sql="DELETE FROM cancellation_policies WHERE cancelpolicy_id=".$val;
   mysql_query($sql) or die(mysql_error());
   }
    elseif($opt=='edit'){	
   $sql="UPDATE cancellation_policies SET SP_id = '".$val."', duration = '".$duration."', time = '".$time."', refundable_amt = '".$refund."' WHERE cancelpolicy_id=".$c_id; 
   mysql_query($sql) or die(mysql_error());
   }
    elseif($opt=='unblock'){
   $sql="UPDATE cancellation_policies SET status = 0 WHERE cancelpolicy_id=".$val;
   mysql_query($sql) or die(mysql_error());
   }
    elseif($opt=='block'){
   $sql="UPDATE cancellation_policies SET status = 1 WHERE cancelpolicy_id=".$val;
   mysql_query($sql) or die(mysql_error());
   }
   ?>
   <input type="hidden" onKeyUp="search_SP_name();" id="sp_search" />
   <?php } ?>