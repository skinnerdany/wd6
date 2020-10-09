<?php

abstract class model
{
    protected $db = false;

    public function __construct()
    {
        if ($this->db === false) {
            $config = core::app()->db;
            $this->db = new pgsql(
                $config['hostname'],
                $config['user'],
                $config['password'],
                $config['name'],
                $config['port']
            );
        }
    }
}
