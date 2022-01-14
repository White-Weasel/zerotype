<?php
class API
{
    protected $path, $params, $method;
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
    }

    protected function get_params($input)
    {
        $input = trim($input);
        if(strlen($input) > 3)
        {
            $tmp = explode('?', $input);
            $result = [];
            foreach($tmp as $t)
            {
                $l = explode('=', $t);
                $result[$l[0]] = $l[1];
            }
            return($result);
        }

        return [];
    }

    protected function process()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        switch($this->method)
        {
            case 'GET':{
                $this->params = $this->get_params($_SERVER['QUERY_STRING']);
                $this->result = $this->GET();
                break;
            }
            case 'POST':{
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
                $this->result = "ERROR: Method not allowed";
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
        // default response, the method function should override this
        if(!is_null($this->result))
            print_r($this->result);
    }
}
?>