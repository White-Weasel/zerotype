<?php
require_once $_SERVER['DOCUMENT_ROOT']."/control/connect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/models/ult.php";


#TODO: quen mat khau
class Users
{
    public $id, $username, $pass, $email, $gender, $birth, $permission, $avatar, $secretKey;
    private $connect;
    const READ_PERMISSION   = 10;
    const WRITE_PERMISSION  = 100;
    const ADMIN_PERMISSION  = 1000;

    public function __construct()
    {
        $this->connect = db_connect();
        
    }

    public function login()
    {
        $sql = "SELECT * from user where username='$this->username' and pass='$this->pass'";
        $run = mysqli_query($this->connect, $sql);
        if($run && $run->num_rows > 0)
        {

            session_unset();
            session_destroy();

            session_start();

            $result = $run->fetch_assoc();
            $this->id = $result['ID'];
            $this->username = $result['Username'];
            $this->pass = $result['Pass'];
            $this->email = $result['Email'];
            $this->gender = $result['Gender'];
            $this->birth = $result['Birth'];
            $this->permission = $result['Permission'];
            $this->avatar = $result['Avatar'];
            $this->secretKey = $result['SecretKey'];

            $_SESSION['user'] = $this;
            return $result;

        }
        else
            return false;
    }

    public function validate_User($user)
    {
        $sql = "SELECT * from user where username='$user->username' and pass='$user->pass'";
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        if(isset($run->num_rows))
            return $run->num_rows;
        else
            return false;
    }

    public function has_permission($permission )
    {
        if($this->permission >= $permission)
            return true;
        return false;
    }

    public function insert($new_user)
    {
        if(isset($this->id))
        {
            if(is_null($this->secretKey))
                $new_user->secretKey = generateRandomString(20);
            $sql = "INSERT into user values('$new_user->id', '$new_user->username', '$new_user->pass', '$new_user->gender', '$new_user->birth', '$new_user->permission', '$new_user->avatar')";
        }
        else
        {
            $sql = "INSERT into user(Username, Pass, Gender, Birth, Permission, Avatar) values('$new_user->username', '$new_user->pass', '$new_user->gender', '$new_user->birth', '$new_user->permission', '$new_user->avatar')";
        }
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        return $run;
    }

    public function select()
    {
        if($this->has_permission($this::ADMIN_PERMISSION))
        {
            $sql = "SELECT * from user";
            $run = mysqli_query($this->connect, $sql);
            //echo $sql;
            return $run;
        }
        
    }

    public function update($new_user)
    {
        if($this->id==$new_user->id || $this->has_permission($this::ADMIN_PERMISSION))
        {    
            $sql = "update user set ";
            if(is_null(($new_user->id)))
            {
                return false;
            }

            if(!is_null(($new_user->username)))
            {
                $sql = $sql."Username='$new_user->username', ";
            }

            if(!is_null(($new_user->pass)))
            {
                $sql = $sql."Pass='$new_user->pass', ";
            }

            if(!is_null(($new_user->gender)))
            {
                $sql = $sql."Gender='$new_user->gender', ";
            }

            if(!is_null(($new_user->birth)))
            {
                $sql = $sql."Birth='$new_user->birth', ";
            }

            if(!is_null(($new_user->permission)))
            {
                $sql = $sql."Permission='$new_user->permission', ";
            }

            if(!is_null(($new_user->avatar)))
            {
                $sql = $sql."Avatar='$new_user->avatar, ";
            }

            if(!is_null(($new_user->secretKey)))
            {
                $sql = $sql."SecretKey='$new_user->secretKey', ";
            }
            $sql = str_replace_last(", ", "", $sql);
            $sql = $sql." WHERE id='$new_user->id'";
            $run = mysqli_query($this->connect, $sql);
            //echo $sql;
            return $run;
        }
        else
        {
            echo "You have no permission!!!";
        }
    }

    public function delete($id=null)
    {
        if(!is_null(($id)) && $this->has_permission($this::ADMIN_PERMISSION))
        {
            $sql = "Delete from user where id='$id'";
        }
        elseif(is_null($this->id))
        {
            $sql = "Delete from user where id='$this->id'";
        }
        
        $run = mysqli_query($this->connect, $sql);
        //echo $sql;
        return $run;
    }
}

?>