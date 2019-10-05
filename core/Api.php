<?php
namespace Core;

use Core\Api\ChatDeskApi;
use Core\Api\MyClassApi;

class Api
{
    public function __construct($path)
    {
        if (count($path) === 0) {
            echo "<p>REST API сервис, предназначенный для разработанного плагина на движке chromium.</p>";
        } else {
            $this->checkPathMain($path);
        }
    }

    private function checkPathMain($path) {
        switch ($path[0]) {
            case "api":
                if(self::isSetService($path)) {
                    self::checkPathApi($path);
                } else {
                    echo json_encode(['description' => 'Сервис оболочка других REST API сервисов, дающая доступ только к нужным методам'], JSON_UNESCAPED_UNICODE);
                }
            break;
            default:
                self::showError(CodeError::NOT_ROUTE);
            break;
        }
    }

    private function checkPathApi($path) {
        switch(strtolower($path[1])) {
            case "myclass":
                if(self::isSetMethod($path)) {
                    new MyClassApi($path[2]);
                } else {
                    self::showError(CodeError::EMPTY_METHOD);
                }
            break;
            case "chatdesk":
                if(self::isSetMethod($path)) {
                    new ChatDeskApi($path[2]);
                } else {
                    self::showError(CodeError::EMPTY_METHOD);
                }
            break;
            default:
                self::showError(CodeError::NOT_FOUND_SERVICE);
            break;
        }
    }

    private function isSetService($path) {
        return isset($path[1]);
    }

    private function isSetMethod($path) {
        return isset($path[2]);
    }

    public static function showError($code)
    {
        header('Content-Type: application/json');
        switch ($code) {
            case CodeError::NOT_INIT_APP:
                echo json_encode(['error' => ['code' => CodeError::NOT_INIT_APP, 'description' => 'Не иницилизированно ядро']], JSON_UNESCAPED_UNICODE);
            break;
            case CodeError::NOT_ROUTE:
                echo json_encode(['error' => ['code' => CodeError::NOT_ROUTE, 'description' => 'Не найден путь']], JSON_UNESCAPED_UNICODE);
            break;
            case CodeError::NOT_FOUND_SERVICE:
                echo json_encode(['error' => ['code' => CodeError::NOT_FOUND_SERVICE, 'description' => 'Не найден сервис']], JSON_UNESCAPED_UNICODE);
            break;
            case CodeError::NOT_FOUND_API_KEY_SERVICE:
                echo json_encode(['error' => ['code' => CodeError::NOT_FOUND_API_KEY_SERVICE, 'description' => 'Не найден api ключ сервиса, проверте настройки приложения']], JSON_UNESCAPED_UNICODE);
            break;
            case CodeError::EMPTY_METHOD:
                echo json_encode(['error' => ['code' => CodeError::EMPTY_METHOD, 'description' => 'Не указан метод в запросе']], JSON_UNESCAPED_UNICODE);
            break;
            case CodeError::NOT_FOUND_METHOD:
                echo json_encode(['error' => ['code' => CodeError::NOT_FOUND_METHOD, 'description' => 'Не верно указан метод']], JSON_UNESCAPED_UNICODE);
            break;
        }
    }
}