<?php


class userCtr extends controller
{
    public function checkAct()
    {
        echo core::app()->user->isGuest() ? 'GUEST' : 'USER' . ' ' . $_SESSION['email'];
    }

    public function changeAct()
    {
        $formData = request::getInstance()->request;
        if (request::getInstance()->isForm) {
            $res = $this->changeHandler();
            if (is_string($res)) {
                $formData['error'] = $res;
            } else {
                header('location: /user/login');
            }
        }

        echo $this->showLayout([
            '__menu' => '',
            '__content' => $this->showTemplate('change', $formData)
        ]);
    }
    
    protected function changeHandler()
    {
        try {
            return core::app()->user->change(request::getInstance()->post);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function resetAct()
    {
        $formData = request::getInstance()->request;
        if (request::getInstance()->isForm) {
            $res = $this->resetHandler();
            if (is_string($res)) {
                $formData['error'] = $res;
            } else {
                header('location: /user/accept');
            }
        }

        echo $this->showLayout([
            '__menu' => '',
            '__content' => $this->showTemplate('reset', $formData)
        ]);
    }
    
    protected function resetHandler()
    {
        try {
            return core::app()->user->reset(request::getInstance()->post);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function logoutAct()
    {
        if (core::app()->user->isGuest()) {
            header('location: /user/check');
        }
        core::app()->user->logout();
        header('location:/user/login');
    }
    
    public function loginAct()
    {
        if (!core::app()->user->isGuest()) {
            header('location: /user/check');
        }
        $formData = request::getInstance()->request;
        if (request::getInstance()->isForm) {
            $res = $this->loginHandler();
            if (is_string($res)) {
                $formData['error'] = $res;
            } else {
                header('location: /user/check');
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
        if (!core::app()->user->isGuest()) {
            header('location: /user/check');
        }
        $formData = request::getInstance()->post;
        if (request::getInstance()->isForm) {
            $res = $this->registrationHandler();
            if (is_string($res)) {
                $formData['error'] = $res;
            } else {
                header('location: /user/accept');
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
