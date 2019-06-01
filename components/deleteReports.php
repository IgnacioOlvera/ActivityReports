<?php

require 'connection.php';
$fileName = $_GET['fileName'];
$route = $_GET['route'];
$sql = "delete from files where file_name = '$fileName'";
if (!$conn->query($sql) === TRUE) {
    session_start();
    $_SESSION['message'] = " Error at trying to delete the file.";
    $status = 500;
    header("Location:../index.php?status=$status");
} else {
    if (unlink("." . $route)) {
        session_start();
        $_SESSION['message'] = 'File was deleted successfully.';
        $status = 200;
    }
}
header("Location:../index.php?status=$status");
$conn->close();
