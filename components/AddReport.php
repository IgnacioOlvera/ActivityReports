<?php
require './connection.php';
$sql = "insert into reports (name) values('$_POST[name]')";
if ($conn->query($sql) === TRUE) {
    http_response_code(200);
} else {
    http_response_code(500);
}
$conn->close();
