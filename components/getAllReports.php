<?php

require('connection.php');
$sql = "select name,customer from reports";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $data = "<ul id='list' style='list-style: none;'>";
    while ($row = $result->fetch_assoc()) {

        $data .= "<li><a data-target='$row[name]' data-customer='$row[customer]' href='#'>$row[name]</a></li>";
    }
    $data .= "</ul>";
    echo $data;
} else {
    http_response_code(500);
}
