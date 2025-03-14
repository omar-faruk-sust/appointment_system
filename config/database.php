<?php

$username = "root";
$password = "";
$hostName = "localhost";
$dbName = "appointment_booking_db";

$connection = new mysqli($hostName, $username, $password, $dbName);

if($connection->connect_errno) {
    die("There was a DB connection issue!");
}