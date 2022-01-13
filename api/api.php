<?php
class API
{
    protected $path, $params, $method;
    public $result;
    public function __construct()
    { 
        $this->init();
        $this->process();
        $this->respond();
    }

    protected function init()
    {
        // override this
    }

    protected function process()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        switch($this->method)
        {
            case 'GET':{
                $this->params = explode('?', $_SERVER['QUERY_STRING']);
                $this->result = $this->GET();
                break;
            }
            case 'POST':{
                $this->result = $this->POST();
                break;
            }
            case 'DELETE':{
                $this->params = explode('?', $_SERVER['QUERY_STRING']);
                $this->result = $this->DELETE();
                break;
            }
            default:
            {
                $this->result = "ERROR: Method not allowed";
                break;;
            }
        }

        $this->respond();
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

    public function respond()
    {
        // default respond, the method function should override this
        if(!is_null($this->result))
            print_r($this->result);
    }
}
?>