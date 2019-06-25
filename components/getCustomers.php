<?php

require('connection.php');
$sql = "select distinct customer from reports";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $data = "";
    while ($row = $result->fetch_assoc()) {
        $data .= "$row[customer],";
    }
    echo $data;
} else {
    http_response_code(500);
}
