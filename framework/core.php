<?php

$includes = get_include_path();
$includes .= 
        PATH_SEPARATOR . __DIR__ . DS . 'classes' . 
        PATH_SEPARATOR . __DIR__ . DS . 'classes' . DS . 'databases' . 
        PATH_SEPARATOR . __DIR__ . DS . 'traits' . 
        PATH_SEPARATOR . __DIR__ . DS . 'interfaces';
set_include_path($includes);

spl_autoload_register(function ($className) {
    include $className . '.php';
});

session_start();

$a = core::app();
$b = core::app();
class core
{
    private static $app = false;
    private $config = [];

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public function __get($name)
    {
        return $this->config[$name] ?? null;
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
            $this->runAction(request::getInstance()->controller, request::getInstance()->action);
        } catch (httpException $e) {
            $e->sendHttpStatus();
            $this->runAction('errors', 'notfound');
        } catch (Exception $e) {
            echo "EXCEPTION: " . $e->getMessage();
            die();
        }
    }

    protected function runAction($controller, $action)
    {
        $controllerName = $controller . 'Ctr';
        if (!@include BASEPATH . 'controllers' . DS . $controllerName . '.php') {
            throw new httpException('Controller ' . $controller . ' file not exists', 404);
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
