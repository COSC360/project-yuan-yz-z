<?php

error_reporting(E_ALL);

// in_set('display_errors', '1');

// $host = "localhost";
// $dbname = "cosc360";
// $username = "root";
// $password = "";
$host = "localhost";
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

// return $mysqli;


$sql = "SELECT id FROM users";

        
$result = $mysqli->query($sql);

$user = $result->fetch_assoc();
print_r($user);