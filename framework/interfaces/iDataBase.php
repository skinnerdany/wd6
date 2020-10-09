<?php

interface iDataBase
{
    public function query($sql);
    public function querySelect($sql);
    
    public function insert($table, $data, $return = false);
    public function delete($table, $where = []);
    public function update($table, $data = [], $where = []);
    public function select($table, $where = []);
}