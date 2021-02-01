<?php
include_once'../../server/server.php'; 
include 'functions.php';
$obj=new agent_module($con);  
$query = $_GET['query'].'%';
$data=array($query,$query);
echo $obj->getCity($data);  
?>
