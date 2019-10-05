<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
define('APP_INIT', true);
require_once "config.php";
require_once __DIR__.'/vendor/autoload.php';

// Проверяем как запущен скрипт =>
$path = [];
if(!defined('IS_CRON')) {
    // Получаем разделенный путь =>
    if(isset($_SERVER['PATH_INFO'])) {
        $path = explode('/', $_SERVER['PATH_INFO']);
        array_shift($path);
    }
} else {
    $path = ['api', 'chatdesk', 'updatedata'];
}

new \Core\Api($path);