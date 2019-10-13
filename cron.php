<?php
if($argc == 2 && $argv[1] == '11223322112233') {
    define('IS_CRON', 1);
    require_once "index.php";
}