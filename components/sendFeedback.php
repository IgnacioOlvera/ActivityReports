<?php
require './connection.php';
$sql = "insert into feedback (feedback) values('$_GET[comments]')";
if ($conn->query($sql) === TRUE) {
    $to = "ignacio.olvera766@yahoo.com.mx,";
    $to = substr($to, 0, -1);
    $subject = "Repository Feedback Received Notification";
    $message = "<h2>Hello</h2>.<br> <h3>The Repository has received a feedback: <br> $_GET[comments]</h3>";
    $from = "activitiesreports.notification@qmcmex.com";
    $headers = "From: Automated Notification <" . $from . "> \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";

    $emailsent = mail($to, $subject, $message, $headers);
    header("Location: ../view/feedback.php");
} else {
    header("Location: ../view/feedback.php");
}
