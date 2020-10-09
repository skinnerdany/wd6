<?php

$config = include __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php';

if (DEBUG) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

include BASEPATH . '..' . DS .'framework' . DS . 'core.php';

core::app()->start($config);

// edit_catalog - Разрешить редактирование каталога товаров
/*
if (check_access('edit_catalog')) {
    echo '<a href="showItemEditor">Редактор товара</a>';
}
<form action="/saveItem">
 * 
</form>
 */