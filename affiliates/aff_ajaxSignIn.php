<?php
session_start();
require_once('database/connect.php');
@extract($_GET);

$res=mysql_query("SELECT * FROM aff_login WHERE email='$uname' AND password='$upass' AND status='1'");
if(mysql_num_rows($res)==0) {
       echo 'FAIL';
} else {
       $row=mysql_fetch_array($res);       
       $_SESSION['EMAIL'] = $row['email_id'];
       $_SESSION['affiliate_id'] = $row['id'];       
       $_SESSION['first_name'] = $row['first_name'];
       
       echo 'SUCCESS';
}
?>
