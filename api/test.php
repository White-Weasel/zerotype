<?php 
    include($_SERVER['DOCUMENT_ROOT']."/control/connect.php");
    require_once $_SERVER['DOCUMENT_ROOT']."/models/user.php";
    session_start();
    $u = new Users();
    $u->id = 22;
    $u->pass = "123";
    //$_SESSION['user']->update($u);
?>


<form method="POST" action="/api/user.php">
    <input type="text" name="id">
    <input type="text" name="pass">

    <input type="submit" name="action" value="update">
</form>