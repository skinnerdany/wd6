<?php

class db implements iDataBase
{
    public $dbConnection = false;

    public function __construct($config)
    {
        $this->dbConnection = new pgsql(
            $config['hostname'],
            $config['user'],
            $config['password'],
            $config['name'],
            $config['port']
        );
    }
}
