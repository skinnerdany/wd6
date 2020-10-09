<?php

class errorsCtr extends controller
{
    protected $layout = 'error';

    public function notfoundAct()
    {
        echo '404 PAGE NOT FOUND!';
    }
}
