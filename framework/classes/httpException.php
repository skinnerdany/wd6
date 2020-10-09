<?php

class httpException extends Exception
{
    private $statuses = [
        404 => ' Not Found',
        400 => ' Bad Request'
    ];

    public function sendHttpStatus()
    {
        header('HTTP/1.0 ' . $this->code . $this->statuses[$this->code]);
    }
}
