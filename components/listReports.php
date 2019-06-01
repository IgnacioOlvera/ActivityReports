<?php
require('connection.php');
$sql = "select report_id id, name from reports";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $data = "";
    while ($row = $result->fetch_assoc()) {
        $data .= "<option value='$row[id]'>$row[name]</option>";
    }

    echo $data;
} else {
    http_response_code(500);
}
