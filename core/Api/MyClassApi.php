<?php

namespace Core\Api;
use Core\Api;
use Core\CodeError;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class MyClassApi extends BaseApi
{
    public function __construct($method)
    {
        parent::checkApiKeyService('my_class');
        self::checkMethod($method);
    }

    protected function checkMethod($method)
    {
        switch (strtolower($method)) {
            default:
                Api::showError(CodeError::NOT_FOUND_METHOD);
            break;
        }
    }

    private function getToken()
    {
        parent::setHeaders();
        $client = new Client();
        try {
            $res = $client->request('POST', "https://api.moyklass.com/v1/company/auth/getToken", [
                'json' => [
                    'apiKey' => self::getApiKey()
                ],
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);
        } catch (GuzzleException $e) {
            echo json_encode(['error' => ['code' => $e->getCode(), 'description' => $e->getMessage()]], JSON_UNESCAPED_UNICODE);
        }
        $body = $res->getBody();
        return json_decode($body->getContents());
    }

    protected function getApiKey()
    {
        global $APP_CONFIG;
        return $APP_CONFIG['api']['my_class'];
    }
}