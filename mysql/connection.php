<?php

// $host = "localhost";
// $dbname = "cosc360";
// $username = "root";
// $password = "";
$host = "cosc360.ok.ubc.ca";
$dbname = "db_60578473";
$username = "60578473";
$password = "60578473";
$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;