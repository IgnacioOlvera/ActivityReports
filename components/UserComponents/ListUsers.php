<?php

require '../connection.php';
require '../User.php';
$sql = "SELECT username FROM users;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    $data = "<ul id='list' style='list-style: none;'>";
    while ($row = $result->fetch_assoc()) {

        $data .= "<li><a data-target='$row[username]' href='#'>$row[username]</a></li>";
    }
    $data .= "</ul>";
    echo $data;
} else {
    http_response_code(500);
}

$conn->close();
