<?php

$link = mysqli_connect("localhost", "60578473", "60578473", "db_60578473");

//$link = mysqli_connect("localhost", "root", "", "cosc360");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
return $link;
