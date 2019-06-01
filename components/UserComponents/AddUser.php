<?php

require '../connection.php';
$sql = "insert into users values(null,'$_POST[name]','$_POST[username]','$_POST[email]','" . md5($_POST['pass']) . "',1)";
if ($conn->query($sql) === TRUE) {
    http_response_code(200);
} else {
    http_response_code(500);
}
$conn->close();
