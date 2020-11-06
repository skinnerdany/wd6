<?php

class mainCtr extends controller
{
    public function indexAct()
    {
	//die('aaa');
        $this->getModel('test')->start();

        $item = $this->showTemplate('item', ['tplData' => 'AAA']);
        echo $this->showLayout([
            '__menu' => '',
            '__content' => $item,
        ]);
    }

    public function testAct()
    {
        
    }
}
