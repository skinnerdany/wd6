<?php
die('aaa');
include __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php';


ini_set('display_errors', 1);
error_reporting(E_ALL);



/*
class A
{
    use other1;
    public function  step1()
    {
        echo 'STEP 1 PARENT<br />';
    }
}
trait other1
{
    public function aaa()
    {
        echo 'T<br />';
        self::step1();
    }
}
class b extends A
{
    use other1;
    public function step1()
    {
        echo 'STEP 1<br />';
        parent::aaa();
    }
}

$a = new b();
$a->aaa();

/*
interface iCache
{
    public function set($key, $value);
    public function get($key);
    public function delete($key);
}
interface iDb
{
    public function test();
}

class _redis implements iCache, iDb
{
    public function test()
    {
        
    }
    public function set($key, $value)
    {
        
    }

    public function get($key)
    {
        
    }
    public function delete($key)
    {
        
    }
}


class _memcache implements iCache
{
    public function set($key, $value)
    {
        
    }
    public function get($key)
    {
        
    }
    public function delete($key)
    {
        
    }
}

/*
class test
{
    public $value = 100;
}

$a = new test();

function change($b)
{
    $b->value = 999;
}

change($a);




/*
$a = new a();
$a->set('zzz');
unset($a);

$b = new a();
echo $b->get();

/*

class fileRequest extends request
{
    public $files = [];

    public function init()
    {
        parent::init();
        if (!empty($_FILES)) {
            $this->files = $_FILES;
        }
    }
    
    public function saveLoadedFiles()
    {
        // ..... move_uploaded_files();
    }
}


$request = new fileRequest;
$request->init();

echo '<pre>';
print_r($request);

/*
class test
{
    protected $value = 'testSdsfsdf';

    public function getValue()
    {
        return $this->value;
    }
}

$test = new test();
echo $test->getValue();


/*
include 'userFunc.php';
restoreSession();


$pagesList = [
    'reg' => [
        'template' => 't_registration',
        'handler' => 'actionReg',
        'success' => '/?page=login'
    ],
    'login' => [
        'template' => 't_login',
        'handler' => 'actionLogin',
        'success' => '/?page=check'
    ],
    'check' => [
        'template' => 't_checkAccess'
    ],
    'logout' => [
        'defaultAction' => 'logout'
    ]
];

$page = false;
if (isset($_GET['page']) && $pagesList[$_GET['page']]) {
    $page = $pagesList[$_GET['page']];
}

if ($page === false) {
    die('404 not found');
}

$result = '';
if (isset($_POST['submit'])) {
    unset($_POST['submit']);
    $result = $page['handler']($_POST);
    if ($result === true) {
        header('HTTP/1.1 301 Moved Permanently'); 
        header('Location: ' . $page['success']);
        return;
    }
}
if (isset($page['defaultAction'])) {
    $page['defaultAction']();
}

include 'templates/layout.php';

/*
addUser('test01@test.com', '12345_1');
addUser('test02@test.com', '12345_2');
addUser('test03@test.com', '12345_3');
addUser('test04@test.com', '12345_4');
addUser('test05@test.com', '12345_5');
addUser('test06@test.com', '12345_6');
addUser('test07@test.com', '12345_7');
addUser('test08@test.com', '12345_8');
addUser('test09@test.com', '12345_9');
/**/
//$user = getUserByEmail('test18@test.com');
//echo '<pre>';
//print_r(false);

/*
if (isset($_POST['email'])) {
    
}
$email = 'v.chepelev@hackeru.com';
$password = 'password';





/*
//setcookie($name, $value, $expires, $path, $domain, $secure, $httponly);
//setcookie('myfirstcookievalue', 'md5(login+password)', time() - 10);



echo '<pre>';
print_r($_COOKIE);


/*
for (;;) {
    $data = '';
    $inp = fopen('php://input', 'r+');
    while ($chunk = fread($inp, 100)) {
        $data .= $chunk;
    }
    fclose($inp);   
    if ($data != '') {
        echo 'YOU ENTER ' . $data . "\n";
    }
    sleep(5);
}



/*

echo 'sadas';

/*
$str = 'test *пvalue';
$pos = strpos($str, '*');
if ($pos !== false) {
    echo mb_substr($str, $pos, 2);
}
/*
function strrepl($search, $replace, $subject)
{
    
}

/*
$a = str_rot13('абв');
echo $a . '<br />';
echo str_rot13($a);
/*

// select id, login from users where id=4
// SELECT id, login FROM users WHERE id=4
$fields = 'id, login, password';
$table = 'users';
$id = 4;

$format = "SELECT >fields FROM >table WHERE id=>id";

$sql = str_replace("\n", '<br />', $format);
echo $sql;
/*
$sql = str_replace('>fields', $fields, $format);
$sql = str_replace('>table', $table, $sql);
$sql = str_replace('>id', $id, $sql);
//$sql = sprintf($format, $fields, $table, $id);
echo $sql;
/*
$a = printf("aaa");
echo '>>' . $a;echo '<br />';
$a = sprintf("aaa");
echo '>>' . $a;echo '<br />';


/*
echo strtolower('FGGHGFh');
var_dump( mb_strtolower('ВоВа') == mb_strtolower('вОва') );



/*
$glue = ', ';
$data = [];

for ($i = 0; $i < 10; $i++) {
    $data[] = 'test';
}
$s1 = microtime(true);
for ($i = 0; $i < 5000; $i++) {
    implode($glue, $data) . '<br />';
}
$s2 = microtime(true);
for ($i = 0; $i < 5000; $i++) {
    impl($glue, $data) . '<br />';
}
$s3 = microtime(true);
echo ($s2-$s1) . '<br />' . ($s3 - $s2);
function impl($glue, $arr)
{
    $str = '';
    foreach ($arr as $element) {
        $str .= (strlen($str) == 0 ? '' : $glue) .$element;
    }
    return $str;
}


/*
$a = '<script>alert(\'hacked\');</script>';
echo htmlspecialchars($a);
//echo crc32('pasword');


/*
echo '<pre>';
echo `ls -al`;
echo '<hr />';
$output = [];
$ret = 0;
var_dump(exec('ls -la', $output, $ret));
var_dump($ret);
print_r($output);
//``;

/*
// 16^32 = 
// 16^40 = 

// 'ab'  10010110 10010111 = 5f4dcc3b5aa765d61d8327deb882cf99
// 'ab'  10010110 10010110 = f88d9aaa52161c2e4f8c42c0d86aa05d
// 
// 5f4dcc3b5aa765d61d8327deb882cf99

$test = 'passwor';

echo md5($test). '<br />';
echo sha1($test). '<br />';
echo hash('sha512', $test). '<br />';
echo md5($test). '<br />';
echo md5($test). '<br />';
echo md5($test). '<br />';

//echo '<pre>';
/*
if (!empty($_FILES)) {
    move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . md5($_FILES['image']['tmp_name']) . '.jpg');
}
//print_r($_FILES);







/*
$whiteList = [
    'test', 'value'
];
$a = $_POST['val'] ?? 'test';
function test()
{
    echo 'a';
}
function value()
{
    echo 'b';
}
if (in_array($a, $whiteList)) {
    echo $a();
} else {
    echo 'NO';
}
//echo $$a; // $test


/*
function insertToFile($file, $offset, $string) 
{
    $f = fopen($file, 'r+');

    fseek($f, $offset);
    $buf = '';
    $chunkSize = 10;
    while ($bytes = fread($f, $chunkSize)) {
        $buf .= $bytes;
    }
    fseek($f, $offset);
    fwrite($f, $string.$buf);
    fclose($f);
}
insertToFile('test', 8, '123zzz');






/*
function insertToFile($file, $offset, $string)
{
    //die('aaa');
    $f = fopen($file, 'r+');
    
    fseek($f, $offset);
    $buf = '';
    $chunkSize = 10;
    while ($bytes = fread($f, $chunkSize)) {
        $buf .= $bytes;
    }
    fseek($f, $offset);
    fwrite($f, $string . $buf);
    fclose($f);
}
insertToFile('test', 8, '123');



//echo '<pre>';print_r(glob('./*', GLOB_ONLYDIR));die();
/*
$file = file('test');
echo '<pre>';print_r($file);die();

/*
for (;;) {
    $a = getQueue();
    while (count($a)) {
        echo reset($a) . '<br />';
        unset($a[key($a)]);
    }
}
/*
function test()
{
    return $a = [
        1,2,3,4,5
    ];
}

echo current(test());
reset($a);
end($a);
current($a);
prev($a);
next($a);
key($a);

$start = end($a);
do {
    if (!$start) {
        break;
    }
    echo key($a) . ' => ' . current($a) . '<br />';
} while ($value = prev($a));
/*
$value = reset($a);
$key = key($a);
echo $key . ' => ' . $value;
while ($value = next($a)) {
    echo key($a) . ' => ' .$value . '<br />';
}
/*
// end current next 
while (count($a)) {
    echo reset($a) . '<br />';
    unset($a[key($a)]);
}


/*
$test = file_get_contents('http://ya.ru');
echo $test;
/*
echo '<pre>';
$res = explode("\n", $test);
print_r($res);
echo '</pre>';
echo implode("<br />", $res);



/*
function insertToFile($file, $offset, $string)
{
    $f = fopen($file, 'r+');
    
    fseek($f, $offset);
    $buf = '';
    $chunkSize = 10;
    while ($bytes = fread($f, $chunkSize)) {
        $buf .= $bytes;
    }
    fseek($f, $offset);
    fwrite($f, $string . $buf);
    fclose($f);
}
insertToFile('test', 8, '123');


// file_name | pid  | file_descriptor | mode | position | lock ...
//    test   | 1031 |    4234         | r    |     0    | ....
//    test   | 1031 |    6412         | r    |     4329 | ....

/*
$arr = [
    'name' => 'vasya',
    'age' => 25,
    'sex' => 'm'
];
echo '<pre>';
print_r($arr);
$json = json_encode($arr);
echo $json;
print_r(json_decode($json, true));

//require 'configt.php';
/*
$config = include 'config.php';
require 'test.html';
/*
echo '<pre>';
print_r($config);


if (DEBUG) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
}
//echo 'fsadsa';
///logWrite('', '');

function logWrite($message, $scope)
{
    if (DEBUG) {
        // write log to file
    }
}


/*
$arr = [
    'one' => 1,
    'two' => [3, 4, 5],
    5,
    7,
    9
];

foreach ($arr as $key => $element) {
    if (is_array($element)) {
        foreach ($element as $key => $element) {
            echo $key . '=>' . $element . "\n";
        }
    }
    echo $key . ' => ' . $element . "\n";
}


/*
define('CHUNK_SIZE', 9);

$f = fopen('test', 'r');
$block = fread($f, CHUNK_SIZE);
do {
    echo $block;
    sleep(1);
} while ($block = fread($f, CHUNK_SIZE));
fclose($f);
//$f = fopen('test', 'r');

/*
while ($block = fread($f, CHUNK_SIZE)) {
    echo $block;
    sleep(1);
}
/*
for (;$block = fread($f, CHUNK_SIZE);) {
    echo $block;
    sleep(1);
}
/**/
//fclose($f);

/*
$i = 0;
while ($i < 10) {
    echo $i . '<br />';
    $i++;
}



/*

for (;;) {
    if (file_exists('test')) {
        echo "FILE FOUND:\n";
        break;
    }
    sleep(3);
    echo "TRY AGAIN\n";
}



for ($str = 'abcde'; $str != ''; $str = substr($str, 1)) {
    echo $str . '<br />';
}


/*
file.txt 
test.mp3
/**/

//!defined('DEBUG') ? define('DEBUG', false) : false;
/*
if (!defined('DEBUG')) {
    define('DEBUG', false);
}
define('DEBUG', 1000);
//DEBUG = 10;
if (DEBUG) {
    echo 'DEBUG ON<br />';
}
echo 'PAGE';

function fib($maxValue = 10)
{
    //var_dump(DEBUG);
}

fib(100);

/*
$i = 10;

function numToWords($num)
{
    switch ($num) {
        case 0:
            return;
        case 1:
            echo 'ONE';
            return;
        case 2:
            echo 'TWO';
            return;
        case 3:
            echo 'THREE';
            return;
        case 4:
            echo 'FOUR';
            return;
        default:
            echo 'I DONT KNOW';
            break;
    }
}



numToWords(14);


/*
$a = ['sss'];
if ($a == []) {
    echo 'empty array';
}

$a = 'test';
$b = 'zzzz';
$a .= 'sdasdasdasdasd ';
echo $a . ' ' . $b;
// 'test zzzz'

die();
$a = 10;
echo $a++;
if ($c == 15 and $a == 10 && $b == 100) {
    
}

//$a = @$rrr;

$a = 13;
$b = 10;
echo $a <=> $b;

//$a = 10;
//function test($a = 'default', $b, $c = true, $d)
function test($a)
{
    $b = 'aaa';
    return $b;
}

//test();


/*
$a = 'a10.7a';
$b = 0;
echo $a == $b ? 'YES' : 'NO';

/*
$a = [1];
echo $a == false ? 'YES' : 'NO';
// false, '', 0, [], null, new stdClass() => false
// true, 'dasdas', -10, [1] => true

/*
$a = 0;
$b = $a ? $a : 'NO';
$b = $a ?: 'NO';


$d = null;
$e = null;
echo isset($c) ? 'YES' : 'NO';
echo isset($c) ? $c : 'default';
echo $c ?? $d ?? $e ?? 'NIGHT';

for ($i = 0; $i < 100; $i++) {
    if (random_int(0,1) == 0) {
        if (isset($c)) {
            echo $c . '<br />';
        } else {
            continue;
        }
    } else {
        $c = 10;
    }
}
/*
echo $TEST;
echo 'tetst';


//echo $a == 0 ? 'zero' : ($a < 0 ? 'neg' : 'pos');


/*
$a = 10;

if ($a < 0) {
    echo 'negative';
} elseif ($a == 0) {
    echo 'zero';
} else {
    echo 'positive';
}

/*
$bool = true;
$bool = false;
$int = 10; // integer
$float = 10.5;
$str = 'flvj;dfal90932-3sd[,a';
$null = null;

$arr = [
    'value' => 'test'
];

$arr['new'] = [];
$arr['new']['test'] = 'aaa';

$arr[] = 10;
$arr[10] = 10;
$arr['separate'] = 100;
$arr[] = 34;

echo '<pre>';
print_r($arr);




/*
PHP_INT_MAX;
PHP_INT_MIN;
/**/