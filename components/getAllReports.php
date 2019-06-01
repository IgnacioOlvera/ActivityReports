<?php

require('connection.php');
$sql = "select name from reports";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $data = "<ul id='list' style='list-style: none;'>";
    while ($row = $result->fetch_assoc()) {

        $data .= "<li><a data-target='$row[name]' href='#'>$row[name]</a></li>";
    }
    $data .= "</ul>";
    echo $data;
} else {
    http_response_code(500);
}
