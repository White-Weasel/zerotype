<?php
include($_SERVER['DOCUMENT_ROOT']."/control/connect.php");

class Users
{
    public $id, $username, $pass, $gender, $birth;

    public function __construct()
    {
        
    }

    public function validate($username, $pass)
    {
        global $conn;
        $sql = "SELECT * from user where username='$username' and pass='$pass'";
        $run = mysqli_query($conn, $sql);
        //echo $sql;
        if(isset($run->num_rows))
            return $run->num_rows;
        else
            return false;
    }

    public function insert()
    {
        global $conn;
        if(isset($this->id))
        {
            $sql = "INSERT into user values('$this->id', '$this->username', '$this->pass', '$this->gender', '$this->birth')";
        }
        else
        {
            $sql = "INSERT into user(Username, Pass, Gender, Birth) values('$this->username', '$this->pass', '$this->gender', '$this->birth')";
        }
        $run = mysqli_query($conn, $sql);
        //echo $sql;
        return $run;
    }

    public function select()
    {
        global $conn;
        $sql = "SELECT * from user";
        $run = mysqli_query($conn, $sql);
        //echo $sql;
        return $run;
    }

    public function Update($id=null)
    {
        global $conn;
        if(!is_null(($id)))
        {
            $this->id_contact = $id;
        }
        elseif(is_null($this->id))
        {
            return false;
        }
        $sql = "update user set Username='$this->username', Pass='$this->pass', Gender='$this->gender', Birth='$this->birth' where ID='$this->id'";
        $run = mysqli_query($conn, $sql);
        //echo $sql;
        return $run;
    }

    public function Delete($id=null)
    {
        global $conn;
        if(!is_null(($id)))
        {
            $this->id = $id;
        }
        elseif(is_null($this->id))
        {
            return false;
        }
        $sql = "Delete from user where id='$this->id'";
        $run = mysqli_query($conn, $sql);
        //echo $sql;
        return $run;
    }
}

class Contacts
{
    public $id_contact, $name, $email, $sub, $content;

    public function __construct()
    {
        
    }

    public function insert()
    {
        global $conn;
        $sql = "INSERT into contact(name, email, sub, content) values('$this->name', '$this->email', '$this->sub', '$this->content')";
        $run = mysqli_query($conn, $sql);
        //echo $sql;
        return $run;
    }

    public function select($id=null)
    {
        global $conn;
        if(is_null($id))
        {
            $sql = "SELECT * from contact";
        }
        else
        {
            $sql = "SELECT * from contact where ID_contact='$id'";
        }
        $run = mysqli_query($conn, $sql);
        //echo $sql;
        return $run;
    }

    public function Update($id=null)
    {
        global $conn;
        if(!is_null(($id)))
        {
            $this->id_contact = $id;
        }
        elseif(is_null($this->id_contact))
        {
            return false;
        }
        $sql = "update contact set name='$this->name', email='$this->email', sub='$this->sub', content='$this->content' where ID_contact='$this->id_contact'";
        $run = mysqli_query($conn, $sql);
        //echo $sql;
        return $run;
    }

    public function Delete($id=null)
    {
        global $conn;
        if(!is_null(($id)))
        {
            $this->id_contact = $id;
        }
        elseif(is_null($this->id_contact))
        {
            return false;
        }
        $sql = "Delete from contact where ID_contact='$this->id_contact'";
        $run = mysqli_query($conn, $sql);
        //echo $sql;
        return $run;
    }
}

class News 
{
    public $title, $author, $date, $content;
    public $id = null;

    public function __construct()
    {
        
    }

    public function insert()
    {
        global $conn;
        if(!isset($this->id) | is_null($this->id))
        {
            $sql = "INSERT into news(title, author, date, content) values('$this->title', '$this->author', '$this->date', '$this->content')";
        }
        else
        {
            $sql = "INSERT into news values('$this->id', '$this->title', '$this->author', '$this->date', '$this->content')";
        }
        $run = mysqli_query($conn, $sql);
        //echo $sql;
        return $run;
    }

    public function Update()
    {
        global $conn;
        $sql = "UPDATE news set title='$this->title', author='$this->author', date='$this->date', content='$this->content' WHERE id='$this->id'";
        $run = mysqli_query($conn, $sql);
        echo $sql;
        return $run;
    }

    public function Delete()
    {
        global $conn;
        $sql = "Delete from news WHERE id='$this->id'";
        $run = mysqli_query($conn, $sql);
        //echo $sql;
        return $run;
    }

    public function select($id)
    {
        global $conn;
        if(!isset($id) | is_null($id))
            $sql = "SELECT * FROM news";
        else
            $sql = "SELECT * FROM news WHERE id='$id'";
        $run = mysqli_query($conn, $sql);
        //echo $sql;
        return $run;
    }

    public function select_short()
    {
        global $conn;
        if(!isset($this->id) | is_null($this->id))
            $sql = "SELECT ID, Title, LEFT(Title,25) AS ShortTitle, Author, Date, Content, LEFT(content,50)AS ShortContent FROM news";
        else
            $sql = "SELECT ID, Title, LEFT(Title,25) AS ShortTitle, Author, Date, Content, LEFT(content,50)AS ShortContent FROM news WHERE id='$this->id'";
        $run = mysqli_query($conn, $sql);
        //echo $sql;
        return $run;
    }
}