<?php
include_once '../../server/server.php';
include_once 'functions.php';
$obj=new admin_module($con);  
$query = $_GET['query'].'%';
$data=array(1,$query);
echo $obj->getagencynames($data);  
?>
