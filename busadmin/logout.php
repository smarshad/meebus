<?php

if(empty($_SESSION[aid]))
{
	header("location:index.php");
}

session_start();

session_unset();

session_unregister();

session_destroy();

header("location:index.php");

?>

