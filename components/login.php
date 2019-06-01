<?php

require('./connection.php');
require 'User.php';
$sql = "SELECT user_id ,username, pass, active FROM users where username = '$_POST[username]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if ($_POST['username'] == $row['username'] && $row['pass'] == md5($_POST['pass']) && $row['active'] == 1) {
            session_start();
            $_SESSION['user'] = new User($row['user_id'], $row['username']);
            $_SESSION['user']->setUserLogin(time());
            http_response_code(200);
        } else {
            http_response_code(404);
        }
    }
} else {
    http_response_code(500);
}
$conn->close();
