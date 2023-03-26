<?php

$host = "localhost";
$dbname = "cosc360";
$username = "root";
$password = "";
// $host = "cosc360.ok.ubc.ca";
// $dbname = "db_90108382";
// $username = "90108382";
// $password = "";
$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;