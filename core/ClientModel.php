<?php

namespace Core;


class ClientModel extends DB
{
    public function __construct($isConnecting = false)
    {
        parent::__construct($isConnecting);
    }

    public function updateClient($user_id, $dialog_id, $phone, $typeChat = '') {
        $client = $this->sendSqlAndGetData("SELECT * FROM `clients` WHERE `client_id`=:user_id", ['user_id' => $user_id]);

        if(!empty($client)) {
            $client = $client[0];
            $this->sendSql("UPDATE `clients` SET `dialog_id`=:dialog_id, `phone`=:phone, `messenger`=:messenger WHERE `client_id`=:user_id", ['dialog_id' => $dialog_id, 'phone' => $phone, 'user_id' => $client['client_id'], 'messenger' => $typeChat]);
        } else {
            $this->sendSql("INSERT INTO `clients`(`client_id`, `dialog_id`, `phone`, `messenger`) VALUES (:user_id, :dialog_id, :phone, :messenger)", ['dialog_id' => $dialog_id, 'phone' => $phone, 'user_id' => $user_id, 'messenger' => $typeChat]);
        }
    }

    public function getClients() {
        return $this->sendSqlAndGetData("SELECT `client_id`, `dialog_id`, `phone`, `messenger` FROM `clients`");
    }

    public function getClientFilterPhone($phones) {
        return $this->sendSqlAndGetData("SELECT `client_id`, `dialog_id`, `phone`, `messenger` FROM `clients` WHERE `phone` IN (:phones)", ['phones' => $phones]);
    }

    public function clearAllClients() {
        return $this->sendSql("DELETE FROM `clients`");
    }
}