<?php
#This module provides the li elements (Reports) of the unordered list in MyReports Section.
#Throws the reports the user is able to see.
require('connection.php');
$user = $_SESSION['user'];
$sql = "SELECT r.name ReportName,r.report_id ReportID from reports r, permissions p where p.report_id=r.report_id and p.user_id = $user->id";
$result = $conn->query($sql);
$reports = "";
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $reports = $reports . "<li><a class='reports' href='#' data-ReportID='$row[ReportID]'>$row[ReportName]</a></li>";
    }
} else {
    $reports = "No allowed reports";
}
