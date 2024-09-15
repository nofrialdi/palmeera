<?php

$host = "localhost";
$user = "root";
$pass = "";
$database = "palmeera";

$conn = mysqli_connect($host, $user, $pass, $database);
if (!$conn) {
  die("Connection Failed:" . mysqli_connect_error());
}
