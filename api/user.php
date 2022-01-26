<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/api/api.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/models/user.php";
    session_start();
    class UserAPI extends API
    {
        private $user, $connect;
        private $att_map;

        protected function init()
        {
            $this->connect = db_connect();
            $this->user = new Users();
            $this->options = ['id', 'username', 'pass', 'gender', 'birth', 'permission', 'avatar', 'action'];
        }

        private function parse_user()
        {
            // return an user object from datas in $params. It should be safe because api->get-params has filtered it.
            // print_r($this->params);
            foreach ($this->params as $p_key => $p_val)
            {
                if($p_key == "action")
                    continue;
                else
                    // avoid using eval because it is not safe
                    $this->user->$p_key = $p_val;
            }
        }

        protected function GET()
        {
            if(count($this->params) > 0)
            {
                global $conn;
                $sql =  $conn->prepare("SELECT * FROM user WHERE ");
                foreach($this->params as $p_key => $p_value)
                {
                    if(in_array($p_key, $this->options))
                        $sql = $sql."$p_key='$p_value' AND ";
                }
                $sql = str_replace_last(" AND ", "", $sql);
                $run = mysqli_query($conn, $sql);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($run->fetch_assoc());
            }
        }

        protected function POST()
        {
            $this->parse_user();
            if(isset($this->params['action']))
            {
                switch($this->params['action'])
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
                            $_SESSION['user']->delete($this->params['id']);
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