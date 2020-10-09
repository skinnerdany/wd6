<?php

class test extends model
{
    public function start()
    {
        
    }
}
/*
$types = [
            'id', 'name', 'description', 'status', 'type', 'date'
        ];
        for ($i =0; $i < 20; $i++) {
            $date = time();
            if (random_int(0, 1)) {
                $date += random_int(1000, 86400*2);
            } else {
                $date -= random_int(1000, 86400*2);
            }
            $this->db->insert('test', [
                'name' => $types[random_int(0, count($types) - 1)] . '_name',
                'status' => random_int(0, 5),
                'date' => $date,
                'type' => $types[random_int(0, count($types) - 1)],
            ]);
        }
/**/