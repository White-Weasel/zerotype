<?php
class API
{
    protected $path, $params, $method;
    protected $options;     // accepted params key
    public $result;
    public function __construct()
    { 
        $this->init();
        $this->process();
        $this->response();
    }

    protected function init()
    {
        // override this
        // Run first in __construct()
    }

    protected function get_params($input)
    {
        // Turn request's params into an associative array, works with both GET and POST request
        // only option listed in the options array will get in
        $result = [];
        if($this->method == "GET")
        {
            $input = trim($input);
            if(strlen($input) > 3)
            {
                $tmp = explode('?', $input);
                foreach($tmp as $t)
                {
                    $l = explode('=', $t);
                    if(in_array($l[0], $this->options))
                        $result[$l[0]] = $l[1];
                }
            }
        }

        elseif($this->method == "POST")
        {
            foreach($input as $i_key => $i_val)
                if(in_array($i_key, $this->options))
                    $result[$i_key] = $i_val;
        }
        return $result;
    }

    protected function process()
    {
        // Call to appropriate function depends on method 
        $this->method = $_SERVER['REQUEST_METHOD'];
        switch($this->method)
        {
            case 'GET':{
                $this->params = $this->get_params($_SERVER['QUERY_STRING']);
                $this->result = $this->GET();
                break;
            }
            case 'POST':{
                $this->params = $this->get_params($_POST);
                $this->result = $this->POST();
                break;
            }
            case 'DELETE':{
                $this->params = $this->get_params($_SERVER['QUERY_STRING']);
                $this->result = $this->DELETE();
                break;
            }
            default:
            {
                http_response_code(405);
                die("405 ERROR: Method not allowed");
                break;;
            }
        }

        $this->response();
    }

    protected function GET()
    {
        //overide this
    }

    protected function POST()
    {
        //overide this
    }

    protected function PUT()
    {
        //overide this
    }

    protected function PATCH()
    {
        //overide this
    }

    protected function DELETE()
    {
        //overide this
    }

    protected function response()
    {
        // default response, should be overrided
        if(!is_null($this->result))
            print_r($this->result);
    }
}
?>