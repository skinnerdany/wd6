<?php

class users extends model
{
    public function createUser(array $user = [])
    {
        if (empty(trim($user['email'] ?? ''))) {
            throw new Exception('Email is empty');
        }
        if (empty(trim($user['password'] ?? ''))) {
            throw new Exception('Password is empty');
        }
        if (empty(trim($user['cpassword'] ?? ''))) {
            throw new Exception('Password confirmation is empty');
        }

        if ($user['password'] != $user['cpassword']) {
            throw new Exception('Password confirmation failed');
        }

        if (!empty($this->db->select('users', ['email' => $user['email']]))) {
            throw new Exception('Email exists');
        }

        unset($user['cpassword']);
        $user['salt'] = $this->getToken();
        $user['password'] = $this->getPasswordHash($user['password'], $user['salt']);
        $user['token'] = $this->getToken();
        $user['status'] = 1;
        return (int) $this->db->insert('users', $user, 'id');
    }
    
    private function getToken()
    {
        return md5(random_bytes(256));
    }
    
    private function getPasswordHash($password, $salt)
    {
        return md5(md5($password) . md5($salt) . md5($password . $salt));
    }
}
