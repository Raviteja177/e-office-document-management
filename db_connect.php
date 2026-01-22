<?php
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "myproject_db";   // change this to myproject_db

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
