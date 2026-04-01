<?php
$mysqli = new mysqli("localhost", "root", "root", "roqueent");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

echo "Connected successfully to roqueent database!";
$mysqli->close();
?>
