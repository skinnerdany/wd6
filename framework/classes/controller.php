<?php

abstract class controller
{
    protected $layout = 'main';
    protected $templatesDir = '';
    private $models = [];

    public function showLayout(array $data = [])
    {
        return $this->show(BASEPATH . 'views' . DS . 'layouts' . DS . $this->layout . '.php', $data);
    }

    public function showTemplate(string $templateName, array $data = [])
    {
        if ($this->templatesDir == '') {
            $this->templatesDir = request::getInstance()->controller;
        }
        return $this->show(BASEPATH . 'views' . DS . $this->templatesDir . DS . $templateName . '.php', $data);
    }

    protected function show($templatePath, $data)
    {
        extract($data);
        ob_start();
        if (!file_exists($templatePath)) {
            return '';
        }
        include $templatePath;
        return ob_get_clean();
    }
    
    protected function getModel(string $model, $createNew = false)
    {
        if ($createNew) {
            include_once BASEPATH . 'models' . DS . $model . '.php';
            return new $model;
        }
        if (!isset($this->models[$model])) {
            if (!@include BASEPATH . 'models' . DS . $model . '.php') {
                throw new Exception("Model $model not found");
            }
            $this->models[$model] = new $model;
        }
        return $this->models[$model];
    }
}
