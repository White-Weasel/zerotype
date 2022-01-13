<?php
include $_SERVER['DOCUMENT_ROOT']."/control/control.php";
$user = new Users();
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $redirect_location = $_SERVER['HTTP_REFERER'];
    try
    {
        $user->username  = $_POST['username'];
        $user->pass      = $_POST['password'];
        $user->gender    = $_POST['gender'];
        $user->birth     = $_POST['birth'];
    }
    catch(Exception $e)
    {
        echo $e;
    }

    if(isset($_POST['signUp']))
    {
        $result = $user->insert();
        
        //session_unset();     // unset $_SESSION variable for the run-time 
        //session_destroy();   // destroy session data in storage
        if($result)
        {
            session_unset();  
            session_destroy();
            session_start();
            $_SESSION['username'] = $user->username;
            $_SESSION['password'] = $user->pass;
            $redirect_location = "/admin/admin.php";
        }
        else
        {
            print_r($result);
        }
    }
    elseif(isset($_POST['update']))
        $result = $user->Update($_POST['id']);
    elseif(isset($_POST['delete']))
    {
        $result = $user->Delete($_POST['id']);
    }

    if($result)
        echo "Success";
    else
        echo "ERROR!";
    print_r($user);
    header("Location: ". $redirect_location);
    return "Success";
}
elseif($_SERVER['REQUEST_METHOD'] == "GET")
{
    if(isset($_GET['id']))
    {
        //TODO: BUG HERE!!!!
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($contact->select($_GET['id'])->fetch_assoc());
    }
}

?>