<?php

namespace Core\Api;


use Core\Api;
use Core\CodeError;

abstract class BaseApi
{
    protected function checkApiKeyService($nameService)
    {
        global $APP_CONFIG;
        if(strlen($APP_CONFIG['api'][$nameService]) == 0) {
            Api::showError(CodeError::NOT_FOUND_API_KEY_SERVICE);
            die();
        }
    }

    protected function setHeaders()
    {
        header('Content-Type: application/json');
    }

    abstract protected function checkMethod($method);

    abstract protected function getApiKey();
}