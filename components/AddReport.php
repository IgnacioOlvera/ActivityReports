<?php
require './connection.php';
$sql = "select count(*) c from reports where name like '$_POST[name]'";
$result = $conn->query($sql)->fetch_assoc()['c'];

if ($result == "0") {
    $sql = "insert into reports (name) values('$_POST[name]')";
    if ($conn->query($sql) === TRUE) {
        session_start();
        $status = 200;
        $_SESSION['message'] = 'Report created successfully';
        header("Location: ../view/reports.php?status=$status");
    } else {
        session_start();
        $status = 500;
        $_SESSION['message'] = 'Failure at trying to create the report';
        header("Location: ../view/reports.php?status=$status");
    }
    $conn->close();
} else {
    session_start();
    $status = 500;
    $_SESSION['message'] = 'Failure at trying to create the report';
    header("Location: ../view/reports.php?status=$status");
}
