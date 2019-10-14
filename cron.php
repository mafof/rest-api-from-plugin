<?php
file_put_contents('log.txt', 'test\t\n', FILE_APPEND | LOCK_EX);
define('IS_CRON', 1);
require_once "index.php";
/*
if($argc == 2 && $argv[1] == '11223322112233') {
	file_put_contents('log.txt', 'test\t\n', FILE_APPEND | LOCK_EX);
    define('IS_CRON', 1);
    require_once "index.php";
}
*/