<?php

$username = "root";

$conn = new mysqli("localhost", $username, '', "calendar_databse");
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}