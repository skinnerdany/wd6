<?php

trait tSingleton
{
    private static $instance = false;
    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}
    private function __sleep(){}

    public static function getInstance()
    {
        if (static::$instance === false) {
            static::$instance = new static(...func_get_args());
        }
        return static::$instance;
    }
}
