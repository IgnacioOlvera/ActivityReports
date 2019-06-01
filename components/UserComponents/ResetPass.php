<?php

require '../connection.php';
$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz!"#$%&/()=';
$data = substr(str_shuffle($data), 0, 8);
$sql = "update users set pass = '" . md5($data) . "' where username = '$_POST[username]'";
if ($conn->query($sql) === TRUE) {
    echo $data;
} else {
    http_response_code(500);
}
$conn->close();
