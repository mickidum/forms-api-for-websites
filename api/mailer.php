<?php
// CONFIGURATE MAIL SENDING
$mail_send_name = 'your-email@example.com'; // mail for receive message
$mail_from_name = 'from-email'; // from who ? title name
$mail_hostname = $_SERVER['HTTP_HOST']; // hostname - example.com


$subject = 'New subscription received from - '.str_replace('_', ' ', $event_name);
$to = $mail_send_name;
$headers = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=UTF-8' . "\r\n";
$headers .= 'From: ' . $mail_from_name . '@' . $mail_hostname;

$message_header = "<table style='padding:5px 15px;'><tr><th colspan='2'><h2><strong>New Subscriber Added</strong></h2></th></tr>";
$message_footer = "</table>";     
$message = "";

foreach ($safe_post as $key => $value) {
  if ($key !== "event_name" and $key !== "form_name_id") {
    $message .= "<tr><th style='border-top:dotted 1px #000;border-left:dotted 1px #000;'><strong>{$key}</strong></th><td style='border-top:dotted 1px #000;'>{$value}</td>";
  }
}

$message = $message_header.$message.$message_footer;

mail($to, $subject, $message, $headers);