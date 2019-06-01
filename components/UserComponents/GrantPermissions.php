<?php

require '../connection.php';
if ($_POST['option'] == 1) {
    //revoke report
    $sql = "delete from permissions where user_id = (select user_id from users where username = '$_POST[username]') and report_id = $_POST[report_id]";
} else {
    if ($_POST['option'] == 2) {
        //grant access
        $sql = "insert into permissions (report_id, user_id) values ($_POST[report_id], (select user_id from users where username = '$_POST[username]'));";
    }
}

if ($conn->query($sql) === TRUE) {
    http_response_code(200);
} else {
    http_response_code(500);
}
$conn->close();
