<?php

class rest extends model
{
    public function get($id = false)
    {
        $isId = $id !== false && is_int($id);
        $where = $isId ? ['id' => $id] : [];
        $res = $this->db->select('rest', $where);
        return $isId && !empty($res) ? reset($res) : $res;
    }
    
    public function save(array $data)
    {
        $id = (int) ($data['id'] ?? 0);
        unset($data['id']);
        // ... validation
        return $id == 0 ? $this->create($data) : $this->update($id, $data);
    }
    
    private function create(array $data)
    {
        $data['date'] = time();
        return $this->db->insert('rest', $data, 'id');
    }

    private function update(int $id, array $data)
    {
        $this->db->update('rest', $data, ['id' => $id]);
        return $id;
    }
    
    public function delete(int $id)
    {
        if ($id == 0) {
            return false;
        }
        $this->db->delete('rest', ['id' => $id]);
        return true;
    }
}