<?php
$to = "work@tier5.us";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: webmaster@example.com" . "\r\n" .
"CC: work@tier5.us";

mail($to,$subject,$txt,$headers);
?> 
