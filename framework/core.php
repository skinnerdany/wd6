<?php

$includes = get_include_path();
$includes .= 
        PATH_SEPARATOR . __DIR__ . DS . 'classes' . 
        PATH_SEPARATOR . __DIR__ . DS . 'classes' . DS . 'databases' . 
        PATH_SEPARATOR . __DIR__ . DS . 'traits' . 
        PATH_SEPARATOR . __DIR__ . DS . 'interfaces' .
        PATH_SEPARATOR . BASEPATH . 'components';
set_include_path($includes);

spl_autoload_register(function ($className) {
    include $className . '.php';
});



class core
{
    
    private static $app = false;
    private $config = [];
    private $componentsList = [];
    private $componentsCache = [];

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public function __get($name)
    {
        if (isset($this->config['components'][$name])) {
            if (!isset($this->componentsCache[$name])) {
                $this->componentsCache[$name] = 
                    new $this->config['components'][$name]['className'](
                        $this->config['components'][$name]['constructParams']
                    );
            }
        }
        return $this->componentsCache[$name] ?? $this->config[$name] ?? null;
    }

    public static function app()
    {
        if (self::$app === false) {
            static::$app = new self();
        }
        return static::$app;
    }
    
    public function start($config)
    {
        $this->config = $config;
        try {
            if (MODE == 'rest') {
                request::getInstance()->controller = !empty(request::getInstance()->controller) ?
                    request::getInstance()->controller :
                    request::getInstance()->action;
                request::getInstance()->action = $this->getRestAction();
            }

            $this->runAction(request::getInstance()->controller, request::getInstance()->action);
        } catch (httpException $e) {
            $e->sendHttpStatus();
            $this->runAction('errors', 'notfound');
        } catch (Exception $e) {
            echo "EXCEPTION: " . $e->getMessage();
            die();
        }
    }
    
    private function getRestAction()
    {
        switch (strtolower($_SERVER['REQUEST_METHOD'])) {
            case 'get':
                return 
                    isset(request::getInstance()->get['id']) && !empty(request::getInstance()->get['id']) ?
                        'view' :
                        'get';
            case 'post':
                return 'create';
            case 'put':
                return 'update';
            case 'delete':
                return 'delete';
        }
    }

    protected function runAction($controller, $action)
    {
        $controllerName = $controller . 'Ctr';
        if (!@include BASEPATH . 'controllers' . DS . $controllerName . '.php') {
            throw new httpException('Controller ' . $controller . ' file not exists', 404);
        }
        if (!class_exists($controllerName)) {
            throw new httpException('Class ' . $controller . ' not exists', 404);
        }
        $controller = new $controllerName;

        $action .= 'Act';
        if (!method_exists($controller, $action)) {
            throw new httpException('Action method not exists', 404);
        }

        $controller->$action();
        return $controller;
    }
}
