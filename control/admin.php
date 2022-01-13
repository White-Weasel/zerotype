<?php
    //TODO: only admin can change other user info
    //TODO: forgot password
    //TODO: modifie user
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if(isset($_POST['logout']))
        {
            session_unset();
            session_destroy();
            header('Location: /login.php');
        }
    }

?>