<?php

require '../connection.php';
$sql = "select name, report_id id ,report_id in (select report_id from permissions where user_id = (select user_id from users where username = '$_POST[username]')) allowed from reports";
$result = $conn->query($sql);
$allow = "<ul style='list-style:none'>";
$disallow = "<ul style='list-style:none'>";
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        ($row['allowed'] == 1) ? $allow .= "<li><a href='#' class='allowed' data-target='$row[id]'>$row[name]</a></li>" : $disallow .= "<li><a href='#' class='disallowed' data-target='$row[id]'>$row[name]</a></li>";
    }
    echo "$allow</ul>|$disallow</ul>";
} else {
    http_response_code(500);
}
$conn->close();
