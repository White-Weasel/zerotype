<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/control/connect.php";

class News 
{
    public $title, $author, $date, $content;
    public $id = null;
    private $connect;

    public function __construct()
    {
        $this->connect = db_connect();
    }

    public function insert()
    {
        if(!isset($this->id) | is_null($this->id))
        {
            $sql = "INSERT into news(title, author, date, content) values('$this->title', '$this->author', '$this->date', '$this->content')";
        }
        else
        {
            $sql = "INSERT into news values('$this->id', '$this->title', '$this->author', '$this->date', '$this->content')";
        }
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        return $run;
    }

    public function Update()
    {
        $sql = "UPDATE news set title='$this->title', author='$this->author', date='$this->date', content='$this->content' WHERE id='$this->id'";
        $run = mysqli_query($this->connect, $sql);
        echo $sql;
        return $run;
    }

    public function Delete()
    {
        $sql = "Delete from news WHERE id='$this->id'";
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        return $run;
    }

    public function select($id)
    {
        if(!isset($id) | is_null($id))
            $sql = "SELECT * FROM news";
        else
            $sql = "SELECT * FROM news WHERE id='$id'";
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        return $run;
    }

    public function select_short()
    {
        if(!isset($this->id) | is_null($this->id))
            $sql = "SELECT ID, Title, LEFT(Title,25) AS ShortTitle, Author, Date, Content, LEFT(content,50)AS ShortContent FROM news";
        else
            $sql = "SELECT ID, Title, LEFT(Title,25) AS ShortTitle, Author, Date, Content, LEFT(content,50)AS ShortContent FROM news WHERE id='$this->id'";
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        return $run;
    }
}
?>