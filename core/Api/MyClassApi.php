<?php

namespace Core\Api;


class MyClassApi extends BaseApi
{
    public function __construct($method)
    {
        parent::checkApiKeyService('my_class');
    }

    protected function checkMethod()
    {
        // TODO: Implement checkMethod() method.
    }
}