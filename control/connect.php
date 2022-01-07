<?php
if (isset($_ENV['CLEARDB_DATABASE_URL']))
{
    $db_url = parse_url($_ENV['CLEARDB_DATABASE_URL']);
    $db_server = $db_url["host"];
    $db_username = $db_url["user"];
    $db_password = $db_url["pass"];
    $db = substr($db_url["path"], 1);

    $conn = mysqli_connect($db_server, $db_username, $db_password, $db);
}
else
{
    $server = "localhost";
    $user = "root";
    $pass="";
    $database = "ltmt-th";
    $conn = mysqli_connect($server, $user, $pass, $database);
    mysqli_query($conn, 'set names "utf8');
}
?>