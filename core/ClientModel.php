<?php

namespace Core;


class ClientModel extends DB
{
    public function __construct($isConnecting = false)
    {
        parent::__construct($isConnecting);
    }

    public function updateClient($user_id, $dialog_id, $phone) {
        $client = $this->sendSqlAndGetData("SELECT * FROM `clients` WHERE `client_id`=:user_id", ['user_id' => $user_id]);

        if(!empty($client)) {
            $client = $client[0];
            $this->sendSql("UPDATE `clients` SET `dialog_id`=:dialog_id, `phone`=:phone WHERE `client_id`=:user_id", ['dialog_id' => $dialog_id, 'phone' => $phone, 'user_id' => $client['client_id']]);
        } else {
            $this->sendSql("INSERT INTO `clients`(`client_id`, `dialog_id`, `phone`) VALUES (:user_id, :dialog_id, :phone)", ['dialog_id' => $dialog_id, 'phone' => $phone, 'user_id' => $user_id]);
        }
    }

    public function getClients() {
        return $this->sendSqlAndGetData("SELECT `client_id`, `dialog_id`, `phone` FROM `clients`");
    }
}