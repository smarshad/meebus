<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'meebus';
$con = new PDO('mysql:host=localhost;dbname=meebus', $user, $pass);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/* Login a user */

// echo $data;
$stmt = $con->prepare("SELECT balance FROM user_login WHERE id=71");
$stmt->execute();
$st  = $stmt->fetchColumn();
print_r($st);
$stmt->debugDumpParams();
        
   




?>