<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05.10.2019
 * Time: 16:46
 */

namespace Core\Api;


use Core\Api;
use Core\CodeError;

abstract class BaseApi
{
    protected function checkApiKeyService($nameService) {
        global $APP_CONFIG;
        if(count($APP_CONFIG['api'][$nameService]) == 0) {
            Api::showError(CodeError::NOT_FOUND_API_KEY_SERVICE);
            die();
        }
    }

    abstract protected function checkMethod();
}