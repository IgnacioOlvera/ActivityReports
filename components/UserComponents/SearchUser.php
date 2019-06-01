<?php

require '../connection.php';
require '../User.php';
$sql = "SELECT user_id, username, name, email,active FROM users where username = '$_POST[username]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $user = new User($row['user_id'], $row['username']);
        $user->setName($row['name']);
        $user->setEmail($row['email']);
        $user->setActive($row['active']);
        http_response_code(200);
        echo json_encode($user);
    }
} else {
    http_response_code(500);
}
$conn->close();
