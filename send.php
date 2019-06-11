<?php
$sender = 'support@connectjob.com.mx';
$recipient = 'charger_gt2012@hotmail.com';
//$recipient = 'bskilesm_c55c@umail2.com';
$subject = "php mail test";
$message = "php test message";
$header = "From: ".$sender;
if (mail($recipient, $subject, $message, $header)) {
    echo "Message accepted";
} else {
    echo "Error: Message no accepted";
}
?>