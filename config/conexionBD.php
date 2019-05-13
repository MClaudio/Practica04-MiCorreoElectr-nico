<?php
$servename = "localhost";
$username = "root";
$password = "";
$dbname = "hipermedial";

$conn = new mysqli($servename, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
?>