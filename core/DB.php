<?php
namespace Core;

use PDO;

class DB
{
    private $db = null;

    public function __construct($isConnecting = false)
    {
        if($isConnecting) $this->connectDB();
    }

    public function connectDB()
    {
        global $APP_CONFIG;
        try {
            $this->db = new PDO('mysql:host='.$APP_CONFIG['db']['host'].';dbname='.$APP_CONFIG['db']['dbname'] . ';charset=utf8', $APP_CONFIG['db']['username'], $APP_CONFIG['db']['password']);
        } catch(\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function closeDB()
    {
        $this->db = null;
    }

    public function getInstanceDB()
    {
        return $this->db;
    }

    public function sendSqlAndGetData($sql, $inputData = null)
    {
        if(is_null($this->db)) return null;
        $statement = $this->db->prepare($sql);
        $statement->execute($inputData);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sendSql($sql, $inputData = null)
    {
        if(is_null($this->db)) return false;
        $statement = $this->db->prepare($sql);
        return $statement->execute($inputData);
    }
}