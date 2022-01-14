<?php 
    $db_url = parse_url("mysql://b22a858a13470e:7ca9c114@us-cdbr-east-05.cleardb.net/heroku_cbeb8eb39ec9173?reconnect=true");
    $db_server = $db_url["host"];
    $db_username = $db_url["user"];
    $db_password = $db_url["pass"];
    $db = substr($db_url["path"], 1);

    echo $db_server."<br>";
    echo $db_username."<br>";
    echo $db_password."<br>";
    echo $db."<br>";

?>


<form method="POST" action="/api/user.php">
    <input type="text" name="id">
    <input type="text" name="pass">

    <input type="submit" name="action" value="update">
</form>