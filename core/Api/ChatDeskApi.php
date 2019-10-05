<?php

namespace Core\Api;

class ChatDeskApi extends BaseApi
{
    public function __construct($method)
    {
        parent::checkApiKeyService('chat2desk');
    }

    protected function checkMethod()
    {
        // TODO: Implement checkMethod() method.
    }
}