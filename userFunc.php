<?php
session_start();
const DB_FILE = __DIR__ . DIRECTORY_SEPARATOR . 'DB';

function logout()
{
    if (isGuest()) {
        header('HTTP/1.1 301 Moved Permanently'); 
        header('Location: /?page=login');
    } else {
        updateUserToken($_COOKIE['token'], str_pad('*', 40, '*'));
        $_SESSION = [];
        setcookie('token', '', time() - 10);
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: /?page=login');
    }
    exit;
}

function restoreSession()
{
    if (!isset($_SESSION['email']) && isset($_COOKIE['token'])) {
        if ($user = getUserByField($_COOKIE['token'])) {
            authorization($user);
        }
    }
}

function isGuest()
{
    $checkUser = getUserByField($_COOKIE['token']);
    if (!isset($checkUser)) {
        return true;
    }
    /**/
    if (!isset($_SESSION['email']) || !isset($_COOKIE['token'])) {
        return true;
    }

    return false;
}

function actionReg($data)
{
    if (empty($data['email'])) {
        return 'Empty email';
    }
    if (empty($data['password'])) {
        return 'Empty password';
    }
    if ($data['password'] != $data['_password']) {
        return 'Password incorrect';
    }
    $checkUser = getUserByField($data['email']);
    if (!is_null($checkUser)) {
        return 'User exists';
    }
    addUser($data['email'], $data['password']);
    return true;
}

function actionLogin($data)
{
    $res = authenticate($data);
    if (is_string($res)) {
        return $res;
    }
    authorization($res);
    return true;
}

function authenticate($user)
{
    if (empty($user['email'])) {
        return 'Empty email';
    }
    if (empty($user['password'])) {
        return 'Empty password';
    }
    $checkUser = getUserByField($user['email']);
    if (!isset($checkUser)) {
        return 'Invalid email';
    }
    if (sha1($user['password']) != $checkUser['password']) {
        return 'Password is incorrect';
    }
    return $checkUser;
}

function authorization($user)
{
    $token = sha1($user['email'] . $user['password'] . random_int(0, PHP_INT_MAX));
    unset($user['password']);
    $user['token'] = $token;
    updateUserToken($user['email'], $token);
    setcookie('token', $token, time() + 366 * 86400);
    $_SESSION = $user;
}

function addUser($email, $password)
{
    $record = $email . ' ' . sha1($password) . ' ' . time() . ' ' . str_pad('*', 40, '*') . "\n";
    $f = fopen(DB_FILE, 'a');
    fwrite($f, $record);
    fclose($f);
}

function getUserByField($fieldValue)
{
    $f = fopen(DB_FILE, 'r');
    $user = null;
    while ($str = fgets($f)) {
        if (strpos($str, $fieldValue) !== false) {
            $user = array_combine(
                ['email', 'password', 'regDate', 'token'],
                explode(' ', trim($str))
            );
            break;
        }
    }
    fclose($f);
    return $user;
}

function updateUserToken($condition, $token)
{
    $basePos = 0;
    $isFound = false;
    $f = fopen(DB_FILE, 'r+');
    while ($str = fgets($f)) {
        if (strpos($str, $condition) !== false) {
            $basePos += strrpos($str, ' ') + 1;
            $isFound = true;
            break;
            /**
             * @todo ANOTHER POINTER CALCULATE // by strrpos
             */
            $strParts = explode(' ', $str);
            unset($strParts[3]);
            $basePos += strlen(implode(' ', $strParts)) + 1;
            $isFound = true;
            break;
        } else {
            $basePos += strlen($str);
        }
    }
    if ($isFound) {
        fseek($f, $basePos);
        fwrite($f, $token);
    }
    fclose($f);
}
