<?php

class role extends model
{
    public function privilegeList()
    {
        return $this->db->select('privilege', []);
    }
}
