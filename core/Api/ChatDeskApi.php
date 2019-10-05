<?php

namespace Core\Api;

use Core\Api;
use Core\ClientModel;
use Core\CodeError;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ChatDeskApi extends BaseApi
{
    public function __construct($method)
    {
        parent::checkApiKeyService('chat2desk');
        $this->checkMethod($method);
    }

    protected function checkMethod($method)
    {
        switch (strtolower($method)) {
            case "updatedata":
                $listClients = self::getClients();
                $listClients = json_decode(json_encode($listClients), true);
                $listDialogs = self::getDialogs();
                $listDialogs = json_decode(json_encode($listDialogs), true);

                $clientModel = new ClientModel(true);
                $_array = array_column($listClients['data'], 'id');
                foreach($listDialogs['data'] as $value) {
                    $index = array_search($value['last_message']['client_id'], $_array);
                    if($index && $listClients['data'][$index]['client_phone']) {
                        $userId = $value['last_message']['client_id'];
                        $dialogId = $value['last_message']['dialog_id'];
                        $phone = $listClients['data'][$index]['client_phone'];
                        $clientModel->updateClient($userId, $dialogId, $phone);
                    }
                }
                echo json_encode(['status' => 'OK'], JSON_UNESCAPED_UNICODE);
            break;
            default:
                Api::showError(CodeError::NOT_FOUND_METHOD);
            break;
        }
    }

    private function getClients() {
        try {
            parent::setHeaders();
            $client = new Client();
            $response = $client->request('GET', 'https://api.chat2desk.com/v1/clients', [
                'headers' => [
                    'authorization' => self::getApiKey()
                ]
            ]);

            $body = $response->getBody();
            return json_decode($body->getContents());
        } catch (GuzzleException $e) {
            echo json_encode(['error' => ['code' => $e->getCode(), 'description' => $e->getMessage()]], JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    private function getDialogs() {
        try {
            parent::setHeaders();
            $client = new Client();
            $response = $client->request('GET', 'https://api.chat2desk.com/v1/dialogs', [
                'headers' => [
                    'authorization' => self::getApiKey()
                ]
            ]);

            $body = $response->getBody();
            return json_decode($body->getContents());
        } catch (GuzzleException $e) {
            echo json_encode(['error' => ['code' => $e->getCode(), 'description' => $e->getMessage()]], JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    protected function getApiKey()
    {
        global $APP_CONFIG;
        return $APP_CONFIG['api']['chat2desk'];
    }
}