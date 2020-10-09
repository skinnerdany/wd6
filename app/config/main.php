<?php

define('DEBUG', true);
define('DS', DIRECTORY_SEPARATOR);

define('BASEPATH', realpath(__DIR__ . DS . '..') . DS);


return [
    'db' => include 'pgsql.php',
];
