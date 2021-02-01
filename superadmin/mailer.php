<?php 


function Mailreg($to,$sub,$body,$head,$sid,$webname,$weburl)
{

require("mailer/class.phpmailer.php");

$mail = new PHPMailer();

/*$mail->IsSMTP(); // telling the class to use SMTP

$mail->Host = "mail.i-netsolution.com"; // SMTP server
$mail->SMTPAuth = true;
$mail->Username = "aishwarya@i-netsolution.com";
$mail->Password = "inet1004";*/

$mail->From = $weburl;
$mail->FromName = $webname;

$mail->AddAddress($to);
$mail->Subject = $sub;
$mail->Body = $body;
$mail->WordWrap = 50;

$mail->Send() ;
header("location:addNewBus.php?sp_id=$sid");
/*if($mail->Send())
{
 header("location:addNewBus.php?sp_id=$sid");
}
else
{
 header("location:new_providers.php");	
}*/
	
}


?>