
<?php
require_once $_SERVER['DOCUMENT_ROOT']."/control/connect.php";

class Contacts
{
    public $id_contact, $name, $email, $sub, $content;
    private $connect;

    public function __construct()
    {
        $this->connect = db_connect();
    }

    public function insert()
    {
        
        $sql = "INSERT into contact(name, email, sub, content) values('$this->name', '$this->email', '$this->sub', '$this->content')";
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        return $run;
    }

    public function select($id=null)
    {
        
        if(is_null($id))
        {
            $sql = "SELECT * from contact";
        }
        else
        {
            $sql = "SELECT * from contact where ID_contact='$id'";
        }
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        return $run;
    }

    public function Update($id=null)
    {
        
        if(!is_null(($id)))
        {
            $this->id_contact = $id;
        }
        elseif(is_null($this->id_contact))
        {
            return false;
        }
        $sql = "update contact set name='$this->name', email='$this->email', sub='$this->sub', content='$this->content' where ID_contact='$this->id_contact'";
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        return $run;
    }

    public function Delete($id=null)
    {
        
        if(!is_null(($id)))
        {
            $this->id_contact = $id;
        }
        elseif(is_null($this->id_contact))
        {
            return false;
        }
        $sql = "Delete from contact where ID_contact='$this->id_contact'";
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        return $run;
    }
}

?>