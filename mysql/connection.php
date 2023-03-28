<?php

<<<<<<< Updated upstream
error_reporting(E_ALL);

in_set('display_errors', '1');

=======
>>>>>>> Stashed changes
// $host = "localhost";
// $dbname = "cosc360";
// $username = "root";
// $password = "";
<<<<<<< Updated upstream
$host = "localhost";
=======
$host = "cosc360.ok.ubc.ca";
>>>>>>> Stashed changes
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