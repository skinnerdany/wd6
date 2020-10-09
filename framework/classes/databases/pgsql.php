<?php

class pgsql implements iDataBase
{
    private $connection;
    
    public function __construct($hostname, $login, $password, $dbname, $port = 5432)
    {
        $this->connection = pg_connect("host=$hostname port=$port user=$login password=$password dbname=$dbname");
    }

    public function query($sql)
    {
        return pg_query($this->connection, $sql);
    }
    
    public function querySelect($sql)
    {
        $res = pg_query($this->connection, $sql);
        return pg_fetch_all($res);
    }
    
    public function insert($table, $data, $return = false)
    {
        $INSERT = 'INSERT INTO ' . $table . ' (';
        $fields = '';
        $values = '';
        foreach ($data as $field => $value) {
            $fields .= ($fields == '' ? '' : ',') . $field;
            $values .= ($values == '' ? '' : ',') . "'" . $this->escapeString($value) . "'";
        }
        $INSERT .= $fields . ') VALUES (' . $values . ')';
        
        if ($return !== false) {
            $INSERT .= ' RETURNING ' . $return;
        }
        $res = $this->querySelect($INSERT);
        return !empty($res) ? $res[0][$return] : [];
    }

    public function delete($table, $where = [])
    {
        return $this->query('DELETE FROM ' . $table . $this->getWhere($where));
    }

    public function update($table, $data = [], $where = [])
    {
        $SET = [];
        foreach ($data as $field => $value) {
            $SET[] = $field . "='" . $this->escapeString($value) . "'";
        }
        return $this->query('UPDATE ' . $table . ' SET ' . implode(',', $SET) . $this->getWhere($where));
    }

    public function select($table, $where = [])
    {
        $sql = 'SELECT * FROM ' . $table . $this->getWhere($where);
        return $this->querySelect($sql);
    }

    /*
     * [
     *  'field_name_1' => 'val 1',
     *  'field_name_2' => 'val 2',
     *  'field_name_3' => 'val 3',
     *  [
     *      0 => 'field_name',
     *      1 => 'operand', // > < = !=
     *      2 => 'value'
     *  ],
     *  'field_name' => [
     *      0 => 1,
     *      1 => 2,
     *      3,4, 10
     *  ] // field_name in ('field_name', 'b') 
     * ]
     */
    public function getWhere($where = [])
    {
        if (is_string($where)) {
            $where = trim($where);

            if(strtolower(substr($where, 0, 5)) == 'where'){
                return $where;
            } 
            return $where == '' ? '' : (' WHERE ' . $where);
        }
        $whereTemp = [];
        foreach ($where as $field => $value) { 
            if (is_scalar($value)) {
                $whereTemp[] = $field . " = '" . $this->escapeString($value) . "'";
            } elseif (is_array($value) && !empty($value)) {
                if (is_int($field)) {
                    $whereTemp[] = $value[0] . $value[1] . "'" . $this->escapeString($value[2]) . "'";
                } else {
                    foreach ($value as &$val) {
                        $val = $this->escapeString($val);
                    }
                    $whereTemp[] = $field . " IN ('" . implode("','", $value) . "')";
                }
            }
        }
        return empty($whereTemp) ? '' : (' WHERE ' . implode(' AND ', $whereTemp)); 
    }

    public function escapeString($str)
    {
        return pg_escape_string($str);
    }
}
