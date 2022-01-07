<?php 
include $_SERVER['DOCUMENT_ROOT']."/control/control.php";
$news = new News();
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    try
    {
        $news->id = $_POST['id'];
        $news->title = $_POST['title'];
        $news->author = $_POST['author'];
        $news->date = $_POST['date'];
        $news->content = $_POST['content'];
    }
    catch(Exception $e)
    {
        echo $e;
    }

    if(isset($_POST['insert']))
        $result = $news->insert();
    elseif(isset($_POST['update']))
        $result = $news->Update();
    elseif(isset($_POST['delete']))
    {
        $news->id = $_POST['id'];
        $result = $news->Delete();
    }

    if($result)
        echo "<script>alert('Success!')</script>";
    else
        echo "<script>alert('ERROR!')</script>";

    echo "redirecting";
    sleep(2);
    header("Location: ". $_SERVER['HTTP_REFERER']);
}

elseif($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if(isset($_GET['id']))
    {
        header('Content-Type: application/json; charset=utf-8');
        $news->id = $_GET['id'];
        echo json_encode($news->select_short()->fetch_assoc());
    }
}
?>