<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
define('APP_INIT', true);
require_once "config.php";
require_once __DIR__.'/vendor/autoload.php';

// Получаем разделенный путь =>
$path = [];
if(isset($_SERVER['PATH_INFO'])) {
    $path = explode('/', $_SERVER['PATH_INFO']);
    array_shift($path);
}

new \Core\Api($path);