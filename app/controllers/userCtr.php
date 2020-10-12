<?php


class userCtr extends controller
{
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
            return $this->getModel('users')->createUser(request::getInstance()->post);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}