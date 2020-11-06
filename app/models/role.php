<?php

class role extends model
{
    public function getRoles()
    {
        return $this->db->select('role');
    }

    public function privilegeList()
    {
        return $this->db->select('privilege', []);
    }
    //psr-0 - psr-7
    public function saveRole($roleData = [])
    {
        if (!isset($roleData['name']) && !empty(trim($roleData['name']))) {
            throw new Exception('Role name is empty');
        }
        $roleData['name'] = trim($roleData['name']);

        $roleData['privilege_id'] = (array) ($roleData['privilege_id'] ?? []);

        $roleList = $this->db->select('role', ['name' => $roleData['name']]);

        if($roleList) {
            throw new Exception('Role with name ' . $roleData['name'] . ' exists');
        }
        $roleData['id'] = $this->db->insert('role', ['name' => $roleData['name']], 'id');

        foreach ($roleData['privilege_id'] as $privilegeId) {
            $this->db->insert('role_privilege', [
                'role_id' => $roleData['id'],
                'privilege_id' => $privilegeId
            ]);
        }
        return $roleData['id'];
    }
}
