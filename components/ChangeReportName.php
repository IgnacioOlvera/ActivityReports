<?php
require './connection.php';
$sql = "update reports set name ='$_POST[newName]' where name = '$_POST[name]'";
if ($conn->query($sql) === TRUE) {
    http_response_code(200);
} else {
    http_response_code(500);
}
$conn->close();
