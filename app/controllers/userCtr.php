<?php


class userCtr extends controller
{
    public function checkAct()
    {
        echo core::app()->user->isGuest() ? 'GUEST' : 'USER';
    }

    public function logoutAct()
    {
        core::app()->user->logout();
        header('location:/user/login');
    }
    
    public function loginAct()
    {
        $formData = request::getInstance()->request;
        if (request::getInstance()->isForm) {
            $res = $this->loginHandler();
            if (is_string($res)) {
                $formData['error'] = $res;
            }
        }
        
        echo $this->showLayout([
            '__menu' => '',
            '__content' => $this->showTemplate('login', $formData)
        ]);
    }
    
    protected function loginHandler()
    {
        try {
            return core::app()->user->login(request::getInstance()->post);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function acceptAct()
    {
        echo $this->showLayout([
            '__menu' => '',
            '__content' => $this->showTemplate('accept', ['users' => (new users)->getUnaccepted()])
        ]);
    }

    public function registrationAct()
    {
        $formData = request::getInstance()->post;
        if (request::getInstance()->isForm) {
            $res = $this->registrationHandler();
            if (is_string($res)) {
                $formData['error'] = $res;
            }
        }

        echo $this->showLayout([
            '__menu' => '',
            '__content' => $this->showTemplate('registration', $formData)
        ]);
    }
    
    protected function registrationHandler()
    {
        try {
            return (new users)->createUser(request::getInstance()->post);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}