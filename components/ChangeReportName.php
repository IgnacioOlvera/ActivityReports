<?php
require './connection.php';
if ($_POST['newName'] != "" && $_POST['customer'] != "") {
    $sql = "update reports set name ='$_POST[newName]', customer = '$_POST[customer]' where name = '$_POST[name]'";
} else if ($_POST['newName'] != "" && $_POST['customer'] == "") {
    $sql = "update reports set name ='$_POST[newName]' where name = '$_POST[name]'";
} else if ($_POST['newName'] == "" && $_POST['customer'] != "") {
    $sql = "update reports set customer = '$_POST[customer]' where name = '$_POST[name]'";
} else {
    $sql = "";
}

if ($conn->query($sql) === TRUE) {
    session_start();
    $status = 200;
    $_SESSION['message'] = 'Report updated successfully';
    header("Location: ../view/reports.php?status=$status");
} else {
    session_start();
    $status = 500;
    $_SESSION['message'] = 'Failure at trying to updated the report';
    header("Location: ../view/reports.php?status=$status");
}
$conn->close();
