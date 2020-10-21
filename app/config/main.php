<?php

define('DEBUG', true);
define('MODE', 'norest'); //norest | rest
define('DS', DIRECTORY_SEPARATOR);

define('BASEPATH', realpath(__DIR__ . DS . '..') . DS);


return [
    'db' => include 'pgsql.php',
    'user' => [],
    'components' => include 'components.php'
];
