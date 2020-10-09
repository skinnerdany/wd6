<?php

class request
{
    use tSingleton;

    public $get         = [];
    public $post        = [];
    public $request     = [];
    public $isForm      = false;
    public $controller  = '';
    public $action      = '';

    private function __construct()
    {
        $this->get          = $_GET;
        $this->post         = $_POST;
        $this->request      = $_REQUEST;
        $this->isForm       = isset($this->post['submit']);
        $this->get['ctr']   = strtolower(str_replace(['.', '/'], '', $this->get['ctr']));
        $this->get['act']   = strtolower($this->get['act']);
        $this->controller   = $this->get['ctr'];
        $this->action       = $this->get['act'];
        unset(
            $this->get['ctr'], 
            $this->get['act'], 
            $this->post['submit'],
            $this->request['submit'],
            $this->request['ctr'],
            $this->request['act']
        );
    }
}
