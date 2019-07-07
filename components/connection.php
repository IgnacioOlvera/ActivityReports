<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qmcmexc_repoclientes";
// $servername = "xlcp19001.xpress.com.mx:3306";
// $username = "qmcmexc_CliRepo";
// $password = "S8=QFqI_^_@P";
// $dbname = "qmcmexc_repoclientes";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
