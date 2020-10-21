<?php

class restCtr extends controller
{
    public function getAct()
    {
        echo $this->showLayout([
            '__menu' => '',
            '__content' => $this->showTemplate('get', [
                'items' => $this->getModel('rest')->get()
            ])
        ]);
    }

    public function viewAct()
    {
        echo $this->showLayout([
            '__menu' => '',
            '__content' => $this->showTemplate('view', $this->getModel('rest')->get((int) request::getInstance()->get['id']))
        ]);
    }

    public function createAct()
    {
        $id = (int) $this->getModel('rest')->save((array) request::getInstance()->post);
        if (is_int($id)) {
            header('location: /rest?id=' . $id);
        }
    }

    public function updateAct()
    {
        $input = fopen('php://input', 'r');
        $inputData = '';
        while ($chunk = fread($input, 100)) {
            $inputData .= $chunk;
        }
        $data = [];
        parse_str($inputData, $data);
        $id = $this->getModel('rest')->save($data);
        header('location: /rest?id=' . $id);
    }

    public function deleteAct()
    {
        $input = fopen('php://input', 'r');
        $inputData = '';
        while ($chunk = fread($input, 100)) {
            $inputData .= $chunk;
        }
        $data = [];
        parse_str($inputData, $data);
        $id = (int) ($data['id'] ?? 0);
        if ($id == 0 || $this->getModel('rest')->delete($id)) {
            echo json_encode(['success' => 1]);
        } else {
            echo json_encode(['success' => 0, 'id' => $data['id']]);
        }
    }
}