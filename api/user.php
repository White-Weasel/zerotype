<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/api/api.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/models/user.php";
    session_start();
    $pdo = pdo_connect();
    //TODO: make use of the secretkey
    class UserAPI extends API
    {
        private $user, $pdoect;
        private $att_map;

        protected function init()
        {
            $this->connect = db_connect();
            $this->user = new Users();
            $this->options = ['id', 'username', 'pass', 'gender', 'birth', 'permission', 'avatar', 'secretkey', 'action'];
            //typeMap is used with mysqli::bind_params. Since we are using PDO, this attribute is useless
            $this->typeMap = array( 'id'        =>'i',
                                    'username'  =>'s',
                                    'pass'      =>'s',
                                    'gender'    =>'s',
                                    'birth'     =>'s',
                                    'permission'=>'i',
                                    'avatar'    =>'s',
                                    'secretkey' =>'s',
                                );
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
            // TODO: use pdo prepare on Users model too to prevent sql inject
            if(count($this->params) > 0)
            {
                global $pdo;
                // preparing the sql query
                $sql =  "SELECT * FROM user WHERE ";
                foreach($this->params as $p_key => $p_value)
                {
                    // get_params() should have clened the params
                    // insert a condition for each param
                    $sql = $sql."$p_key=:$p_key AND ";
                }
                //remove the trailing AND
                $sql = str_replace_last(" AND ", "", $sql);
                //echo $sql."<br>";
                $query = $pdo->prepare($sql);
                
                // passing the parameters
                foreach($this->params as $p_key => $p_value)
                {
                    $query->bindParam(":$p_key", $p_value);
                }
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($result, JSON_FORCE_OBJECT);
                //print_r($result);
                
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