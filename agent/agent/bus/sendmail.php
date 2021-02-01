<?php
include_once '../../server/server.php'; 
$messsage=$_SESSION['agent']['bus']['ticket'];
$emailId=$_SESSION['agent']['bus']['user_mail'];
$subject = "Urbus E-Ticket";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers.= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
$headers.= "From:Urbus.com \r\n";

if(mail($emailId, $subject, $messsage, $headers))
{
echo "Mail sent successfully. Thanks for using E-mail Ticket";
}
else 
{
echo "Mail Not Send Please Try Again Later";	
}
?>