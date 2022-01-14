<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/api/api.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/models/contact.php";
    
    class ContactAPI extends API
    {
        private $contact, $connect;

        protected function init()
        {
            $this->contact = new Contacts();
            $this->connect = db_connect();
        }

        protected function GET()
        {
            if(isset($_GET['id']))
            {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($this->contact->select($_GET['id'])->fetch_assoc());
            }
        }

        protected function POST()
        {
            
            try
            {
                $this->contact->name = $_POST['name'];
                $this->contact->email = $_POST['email'];
                $this->contact->sub = $_POST['sub'];
                $this->contact->content = $_POST['content'];
            }
            catch(Exception $e)
            {
                header("HTTP/1.1 400 ERROR");
                echo $e;
            }

            if(isset($_POST['insert']))
                $result = $this->contact->insert();
            elseif(isset($_POST['update']))
                $result = $this->contact->Update($_POST['id']);
            elseif(isset($_POST['delete']))
            {
                $result = $this->contact->Delete($_POST['id']);
            }
            else
            {
                header("HTTP/1.1 400 ERROR");
                return;
            }

            if($result)
                header("HTTP/1.1 200 OK");
            else
                header("HTTP/1.1 401 ERROR");
            print_r($result);
        }
    }

    $contact = new ContactAPI();
    
?>