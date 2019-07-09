<?php
#This module provides the li elements (Reports) of the unordered list in MyReports Section.
#Throws the reports the user is able to see.
require('connection.php');
$sql = "select year(f.date) year, monthname(f.date) month, week(f.date) week,  f.file_name fname, route,f.report_id id from files f where f.report_id = $_POST[reportId] order by f.date";
$result = $conn->query($sql);
$table = "<table id='ReportsTable'>";
if ($result->num_rows > 0) {
    // output data of each row
    $count = 1;
    $y = "";
    $m = "";
    $w = "";
    while ($row = $result->fetch_assoc()) {
        #Puto ciclo que no sale alv.
        if (!isset($year) && !isset($week) && !isset($month)) {
            $year = $count;
            $y = $row['year'];
            $month = $count + 1;
            $m = $row['month'];
            $week = $count + 2;
            $w = $row['week'];
            $table .= "<tr data-tt-id='$count'><td>$y</td></tr>";
            $count++;
            $table .= "<tr data-tt-id='$count' data-tt-parent-id='$year'><td>$m</td></tr>";
            $count++;
            $table .= "<tr data-tt-id='$count' data-tt-parent-id='$month'><td>Week $w</td></tr>";
            $count++;
        }
        if ($row['year'] != $y) {
            $year = $count;
            $y = $row['year'];
            $table .= "<tr data-tt-id='$count'><td>$y</td></tr>";
            $count++;
        }
        if ($row['month'] != $m) {
            $month = $count;
            $m = $row['month'];
            $table .= "<tr data-tt-id='$count' data-tt-parent-id='$year'><td>$m</td></tr>";
            $count++;
        }

        if ($row['week'] != $w) {
            $week = $count;
            $w = $row['week'];
            $table .= "<tr data-tt-id='$count' data-tt-parent-id='$month'><td>Week $w</td></tr>";
            $count++;
        }
        $table .= "<tr data-tt-id='$count' data-tt-parent-id='$week'><td><a href='$row[route]'>$row[fname]</a> <a href='./components/deleteReports.php?fileName=$row[fname]&route=$row[route]' class='delete'><span style='float:right'>x</span></a> <a href='./components/sendEmailNotification.php?reportId=$row[id]&fname=$row[fname]'><span class='float:right'>Notify</span></a></td></tr>";
        $count++;
    }
    echo $table . "</table>";
} else {
    echo "There are not Reports";
}
