<?php

require '../connection.php';

$sql = "update users set username= '$_POST[username]', name='$_POST[name]', email='$_POST[email]', active = $_POST[state] where username = '$_POST[user]'";
if ($conn->query($sql) === TRUE) {
    http_response_code(200);
} else {
    http_response_code(500);
}
$conn->close();
