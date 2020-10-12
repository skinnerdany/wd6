<?php

class accessCtr extends controller
{
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