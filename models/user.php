<?php
require_once $_SERVER['DOCUMENT_ROOT']."/control/connect.php";

class Users
{
    public $id, $username, $pass, $gender, $birth, $permission, $avatar;
    private $connect;

    public function __construct()
    {
        $this->connect = db_connect();
    }

    public function validate($username, $pass)
    {
        $sql = "SELECT * from user where username='$username' and pass='$pass'";
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        if(isset($run->num_rows))
            return $run->num_rows;
        else
            return false;
    }

    public function insert()
    {
        if(isset($this->id))
        {
            $sql = "INSERT into user values('$this->id', '$this->username', '$this->pass', '$this->gender', '$this->birth')";
        }
        else
        {
            $sql = "INSERT into user(Username, Pass, Gender, Birth) values('$this->username', '$this->pass', '$this->gender', '$this->birth')";
        }
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        return $run;
    }

    public function select()
    {
        $sql = "SELECT * from user";
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
        elseif(is_null($this->id))
        {
            return false;
        }
        $sql = "update user set Username='$this->username', Pass='$this->pass', Gender='$this->gender', Birth='$this->birth' where ID='$this->id'";
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        return $run;
    }

    public function Delete($id=null)
    {
        if(!is_null(($id)))
        {
            $this->id = $id;
        }
        elseif(is_null($this->id))
        {
            return false;
        }
        $sql = "Delete from user where id='$this->id'";
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        return $run;
    }
}

?>