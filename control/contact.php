<?php
include $_SERVER['DOCUMENT_ROOT']."/control/control.php";
$contact = new Contacts();
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    try
    {
        $contact->name = $_POST['name'];
        $contact->email = $_POST['email'];
        $contact->sub = $_POST['sub'];
        $contact->content = $_POST['content'];
    }
    catch(Exception $e)
    {
        echo $e;
    }

    if(isset($_POST['insert']))
        $result = $contact->insert();
    elseif(isset($_POST['update']))
        $result = $contact->Update($_POST['id']);
    elseif(isset($_POST['delete']))
    {
        $result = $contact->Delete($_POST['id']);
    }

    if($result)
        echo "Success";
    else
        echo "ERROR!";
    header("Location: ". $_SERVER['HTTP_REFERER']);
    return "Success";
}
elseif($_SERVER['REQUEST_METHOD'] == "GET")
{
    if(isset($_GET['id']))
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($contact->select($_GET['id'])->fetch_assoc());
    }
}

?>