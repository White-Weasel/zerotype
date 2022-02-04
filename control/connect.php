<?php
function db_connect()
{
    if (isset($_ENV['CLEARDB_DATABASE_URL']))
    {
        //CLEARDB_DATABASE_URL has server's databse url
        $db_url = parse_url($_ENV['CLEARDB_DATABASE_URL']);
        $db_server = $db_url["host"];
        $db_username = $db_url["user"];
        $db_password = $db_url["pass"];
        $db = substr($db_url["path"], 1);

        $conn = mysqli_connect($db_server, $db_username, $db_password, $db);

        return $conn;
    }
    else
    {
        //localhost database
        $server = "localhost";
        $user = "root";
        $pass="";
        $database = "ltmt-th";
        $conn = mysqli_connect($server, $user, $pass, $database);
        mysqli_query($conn, 'set names "utf8"');

        return $conn;
    }
}

function pdo_connect()
{
    if (isset($_ENV['CLEARDB_DATABASE_URL']))
    {
        //CLEARDB_DATABASE_URL has server's databse url
        $db_url = parse_url($_ENV['CLEARDB_DATABASE_URL']);
        $server = $db_url["host"];
        $username = $db_url["user"];
        $password = $db_url["pass"];
        $db = substr($db_url["path"], 1);
    }
    else
    {
        //localhost database
        $server = "localhost";
        $username = "root";
        $password="";
        $db = "ltmt-th";
    }

    return new PDO("mysql:host=$server;dbname=$db", $username, $password);
}
$conn = db_connect();
?>