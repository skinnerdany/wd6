<?php

class accessCtr extends controller
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

    public function roleFormAct()
    {
        $id = $_GET['id'] ?? 0;
        $errors = '';
        if (request::getInstance()->isForm) {
            $errors = $this->roleSave();
        }
        echo $this->showLayout([
            '__menu' => $this->showTemplate('menu', ['roles' => $this->getModel('role')->getRoles()]),
            '__content' => $this->showTemplate('access_form', $this->accessFormData()),
            '__errors' => $errors
        ]);
    }
    
    protected function accessFormData()
    {
        $role = [];
        return array_merge($role, [
            'privileges' => $this->getModel('role')->privilegeList(),
            'rolePrivileges' => request::getInstance()->post['privilege_id'] ?? [],
            'name' => request::getInstance()->post['name'] ?? ''
        ]);
    }

    private function roleSave()
    {
        try {
            $this->getModel('role')->saveRole(request::getInstance()->post);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return '';
    }
    public function roleUpdateAct()
    {
        // Вывести в форму уведомление о том, что если вы не хотите менять название роли, то в поле newName не нужно ничего вводить.
        // Вывести в форму уведомление о том, что привелегии полностью меняются, т.е. необходимо указывать весь список привелегий заново.
        $role = [];
        $role['name'] = trim($_REQUEST['name'] ?? '');
        $roleList = $this->db->select('role', $role);
        if(!$roleList) {
            echo 'Invalid role name';
            return;
        }
        $role['newName'] = trim($_REQUEST['newName']);
        if($role['name']!==$role['newName'] && $role['newName']!='') {
            $arr = [];
            $arr['name'] = $role['newName'];
            $this->db->update('role', $arr, 'name = '.$role['name']);
        }
        $role['privilege_id'] = (array) ($_REQUEST['privileges'] ?? []);
        //if($role['privilege_id']){
        $this->db->delete('role_privilege', 'role_id = '.$roleList['id']);
        foreach ($role['privilege_id'] as $privilege_id){
            $arr=[];
            $arr['role_id'] = $roleList['id'];
            $arr['privilege_id'] = $privilege_id;
            $this->db->insert('role_privilege', $arr);
        }
        //}  // нужно ли выдавать echo 'Обращаю Ваше внимание на то, что Вы не указали привелегии' в случае else;
    }
    public function roleDeleteAct()
    {
        $role = [];
        $role['name'] = trim($_REQUEST['name']);
        $roleList = $this->db->select('role', $role);
        if(!$roleList) {
            echo 'Invalid role name';
            return;
        }
        $this->db->delete('role', 'name = '.$role['name']);
        $this->db->delete('role_privilege', 'role_id = '.$roleList['id']);
        $this->db->update('users', ['role_id' => 0], 'role_id = '.$roleList['id']);
    }
    public function roleUserSaveAct()
    {
        $roleUser = [];
        $_REQUEST['email'] = trim($_REQUEST['email']);
        $userList = $this->db->select('role', ['email' => $_REQUEST['email']]);
        
        if($userList){
            $userList = reset($userList);
            if(!$userList['admin']){
                $roleList = $this->db->select('role', ['name' => trim($_REQUEST['name'])]);
                if($roleList){
                    $arr = [];
                    $arr['role_id'] = $roleList[0]['id'];
                    $this->db->update('users', ['role_id' => 0], 'id = '.$userList['id']);
                }else{
                    echo 'Invalid role name';
                }
            }
        } else{
            echo 'Invalid user e-mail';
        }
    }
}

/*
class accessCtr extends controller
{
    public function roleSaveAct()
    {
        $role = [];
        $role['name'] = $_REQUEST('name');
        $role['privilege_id'] = $_REQUEST('privileges');
        $role['role_id'] = $this->db->insert('role', $_REQUEST, "id");
        foreach ($role['privilege_id'] as $privilege_id) {
            $arr = [];
            $arr['role_id'] = $role['role_id'];
            $arr['privilege_id'] = $privilege_id;
            $this->db->insert('role_privilege', $arr);
        }
    }

    public function roleFormAct()
    {
        echo $this->showLayout([
            '__menu' => '',
            '__content' => $this->showTemplate('access_form', $this->accessFormData())
        ]);
    }

    protected function accessFormData()
    {
        $role = [];
        return array_merge($role, [
            'privileges' => $this->getModel('role')->privilegeList(),
            'rolePrivileges' => ''
        ]);
    }

    public function roleSaveAct()
    {
        
    }
}
/**/