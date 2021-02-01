<?php
session_start();

unset($_SESSION['aff']);
unset($_SESSION['affiliate_id']);
session_destroy();
header('location:index.php?mesg=Logout Successfully!!');

?>
