<?php

session_start();

class users
{
    protected static $dbInstance = false;
    
    public function __get($name)
    {
        if($name == 'db') {
            if (self::$dbInstance === false) {
                $config = core::app()->db;
                self::$dbInstance = new pgsql(
                    $config['hostname'],
                    $config['user'],
                    $config['password'],
                    $config['name'],
                    $config['port']
                );
            }
        }
        return self::$dbInstance;
    }

    public function __construct()
    {
        if (!isset($_SESSION['id']) && isset($_COOKIE['token'])) {
            $user = $this->db->select('users', ['token' => $_COOKIE['token']]);
            if (!empty($user)) {
                $this->authorization(reset($user));
            }
        }
    }

    public function isGuest() : bool
    {
        return !isset($_SESSION['id']);
    }

    public function checkAccess($privilegeCode) : bool
    {
        return $_SESSION['admin'] || (isset($_SESSION['privileges']) && in_array($privilegeCode, $_SESSION['privileges']));
    }

    public function logout()
    {
        setcookie('token', '', time()-3, '', '', false, true);
        $this->db->update('users', ['token' => ''], ['id' => $_SESSION['id']]);
        $_SESSION = [];
    }
    
    public function login(array $user)
    {
        if (empty(trim($user['email'] ?? ''))) {
            throw new Exception('Email is empty');
        }
        if (empty(trim($user['password'] ?? ''))) {
            throw new Exception('Password is empty');
        }

        $checkedUser = $this->db->select('users', ['email' => $user['email']]);
        if (empty($checkedUser)) {
            throw new Exception('Email not register');
        }
        $checkedUser = reset($checkedUser);

        if ($checkedUser['password'] != $this->getPasswordHash($user['password'], $checkedUser['salt'])) {
            throw new Exception('Invalid password');
        }

        switch ($checkedUser['status']) {
            case 1:
                $checkedUser['status'] = 0;
                break;
            case 2:
                throw new Exception('Password reset');
                break;
        }
        
        $this->authorization($checkedUser);
    }
    
    protected function authorization($user)
    {
        unset($user['password'], $user['salt'], $user['token']);

        do {
            $token = $this->getToken();
        } while (!empty($this->db->select('users', ['token' => $token])));
        
        setcookie('token', $token, 366 * 86400, '/', '', false, true);
        $this->db->update('users', ['token' => $token, 'status' => 0], ['id' => $user['id']]);
        $user['privileges'] = $this->getUserPrivileges($user['role_id']);
        $_SESSION = $user;
    }
    
    protected function getUserPrivileges($roleId)
    {
        $privileges = $this->db->querySelect(
                'SELECT 
                    * 
                FROM 
                    role_privilege rp 
                JOIN 
                    privilege p ON p.id=rp.privilege_id 
                WHERE
                    rp.role_id=' . $this->db->escapeString($roleId));

        return !empty($privileges) ? array_column($privileges, 'tag') : [];
    }

    public function getUnaccepted()
    {
        return $this->db->select('users', [['status', '!=', 0]]);
    }

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