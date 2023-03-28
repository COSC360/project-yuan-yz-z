<?php


//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);
// $host = "localhost";
// $dbname = "cosc360";
$link = mysqli_connect("localhost", "60578473", "60578473", "db_60578473");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Attempt select query execution
$sql = "SELECT * FROM users";
$result = mysqli_query($link, $sql);
print_r($result);