<?php

$ip = get_include_path();
set_include_path(
	$ip .
	PATH_SEPARATOR . __DIR__ . DIRECTORY_SEPARATOR . 'classes2' .
	PATH_SEPARATOR . __DIR__ . DIRECTORY_SEPARATOR . 'classes1'
);

spl_autoload_register(function ($cn) {
	include $cn . '.php';
});
//echo $ip;die();

// classes1/test1.php => test1
// classes2/test2.php => test2
// classes3/test3.php => test3

//include 'test.php';
//include 'test2.php';
(new test())->test1();
