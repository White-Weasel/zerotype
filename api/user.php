<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/api/api.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/models/user.php";
    session_start();
    class UserAPI extends API
    {
        private $user, $connect;
        private $att_map;
        const OPTIONS = ['id', 'username', 'pass', 'gender', 'birth', 'permission', 'avatar'];

        protected function init()
        {
            $this->connect = db_connect();
            $this->user = new Users();
            $this->att_map = array('id' => &$this->user->id, 'username' => &$this->user->username , 'pass' => &$this->user->pass, 'gender' => &$this->user->gender, 'birth' => &$this->user->birth, 'permission' => &$this->user->permission, 'avatar' => &$this->user->avatar);
        }

        protected function GET()
        {
            global $conn;
            $sql = "SELECT * FROM user WHERE ";
            foreach($this->params as $p_key => $p_value)
            {
                if(in_array($p_key, $this::OPTIONS))
                    $sql = $sql."$p_key='$p_value' AND ";
            }
            $sql = str_replace_last(" AND ", "", $sql);
            $run = mysqli_query($conn, $sql);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($run->fetch_assoc());
        }

        protected function POST()
        {
            foreach($_POST as $p_key => $p_value)
            {
                if(in_array($p_key, $this::OPTIONS))
                {
                    eval("\$this->user->".$p_key."=\$p_value;");
                }
            }
            if(isset($_POST['action']))
            {
                switch($_POST['action'])
                {
                    case 'insert':{
                        $this->user->insert($this->user);
                        break;
                    }
                    case 'login':{
                        
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($this->user->login());
                        break;
                    }
                    case 'update':{
                        if (session_status() === PHP_SESSION_NONE) 
                        {
                            echo "PLZ Log in first!";
                            return;
                        }
                        else
                        {
                            echo json_encode($_SESSION['user']->update($this->user));
                            break;
                        }
                    }
                    case 'delete':{
                        if (session_status() === PHP_SESSION_NONE) 
                        {
                            echo "PLZ Log in first!";
                            return;
                        }
                        else
                        {
                            $_SESSION['user']->delete($_POST['id']);
                            break;
                        }
                    }
                }
            }
        }


        protected function response()
        {
            
        }
    }

    $userAPI = new UserAPI();

?>