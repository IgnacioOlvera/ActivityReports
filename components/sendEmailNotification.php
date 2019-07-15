<?php
require('connection.php');
$sql = "select u.email email from permissions p inner join users u on u.user_id = p.permission_id and p.report_id = $_GET[reportId] and u.email!=''";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $to = "";
    while ($row = $result->fetch_assoc()) {
        $to .= "$row[email],";
    }
    $to = "ignacio.olvera766@yahoo.com.mx,";
    $to = substr($to, 0, -1);
    $subject = "Report Notification Email";
    $hash = md5($_GET[fname]);
    $message = "<h2>Hello</h2>.<br> <h3>The report: <br> $_GET[fname] has been submitted by our team and it is now available in our repository.</h3>";
    //$message = "Hello, the report: <br> $_GET[fname] has been submitted by our team. <br>  Please follow the link below to download it: <h3> <a href='www.qmcmex.com/activities-reports/components/downloadFile.php?fname=$hash.xlsx'>Download Report</a></h3>";
    $from = "activitiesreports.notification@qmcmex.com";
    $headers = "From: Automated Notification <" . $from . "> \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";

    $emailsent = mail($to, $subject, $message, $headers);
    session_start();
    if ($emailsent == true) {
        $_SESSION['message'] = 'Notification sent Successfully';
        $status = 200;
        header("Location: ../index.php?status=$status");
    } else {
        $_SESSION['message'] = 'Notification could not be sent';
        $status = 500;
        header("Location: ../index.php?status=$status");
    }
} else {
    http_response_code(500);
}
