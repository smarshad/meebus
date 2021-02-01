<?php 
session_start(); ob_start(); 
if($_SERVER['DOCUMENT_ROOT']=='D:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='E:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='D:/xampp/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampplite/htdocs' || $_SERVER['DOCUMENT_ROOT']=='C:/xampp/htdocs') {
if(!isset($_SESSION['common']['url']) && $_SESSION['common']['url']=='') { header('location:../agent/index.php'); }
} else { if(!isset($_SESSION['common']['url']) && $_SESSION['common']['url']=='') { header('location:http://urbus.info'); } }
?>