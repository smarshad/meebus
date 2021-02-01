<?php
include_once '../server/server.php';
include_once 'pdo_functions.php';
$obj=new user_module($con); 
$query = $_GET['query'].'%';
$data=array($query);
//print_r($data);
echo "<select class='form-control' name='ter_from' style='border-radius: 8px;'>";
echo $obj->getBusCities1($data); 
echo "</select>";
?>
