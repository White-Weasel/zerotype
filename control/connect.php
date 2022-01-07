<?php
$server = "localhost";
$user = "root";
$pass="";
$database = "ltmt-th";
$conn = mysqli_connect($server, $user, $pass, $database);
mysqli_query($conn, 'set names "utf8');
?>