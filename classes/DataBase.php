<?php

class DataBase {
    private static $_instance;
    private $_connection;

    public static function getInstance() {
        if(!self::$_instance) {
            self::$_instance = new self(
                config('db_host'),
                config('db_user'),
                config('db_pass'),
                config('db_name')
            );
        }
        return self::$_instance;
    }

    private function __construct($host, $username, $pass, $database) {
        $this->_connection = new mysqli($host, $username, $pass, $database);

        if(mysqli_connect_error()) {
            $errorText = "Failed to connect to MySQL: " . mysqli_connect_error();
            trigger_error( $errorText, E_USER_ERROR);
        }
    }

    public function __destruct() {
        if(!$closeResults = $this->_connection->close()) {
            echo "Could not close MySQL connection.";
        }
    }

    private function __clone() { }

    public function getConnection() {
        return $this->_connection;
    }

    public static function getAll($tableName, $limit = 1000) {
        return self::getRecords('SELECT * FROM ' . $tableName . ' LIMIT ' . $limit);
    }

    public static function quary($query) {
        $db = DataBase::getInstance()->getConnection();
        $query = preg_replace(['/\v/','/\s\s+/'], ' ' , $query);
        $result = $db->query($query);
        return $result;
    }

    public static function getRecords($query) {
        $db = DataBase::getInstance()->getConnection();
        $query = preg_replace(['/\v/','/\s\s+/'], ' ' , $query);
        $result = $db->query($query);
        $rows = [];

        try {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        } catch (exception $e) {
            return false;
        }
        return $rows;
    }

    public static function getRecord($query) :array {
        return self::getRecords($query)[0] ?? [];
    }

    public static function getById($tableName, $id, $limit = 1000) {
        $query = "SELECT * FROM {$tableName} WHERE id = {$id} LIMIT {$limit}";
        return self::getRecord($query);
    }

    public static function addRecords(string $tableName, array $dataArray) {
        $db = DataBase::getInstance();

        foreach ($dataArray as $assocData) {
            $db->addRecord($tableName, $assocData);
        }
    }

    public static function addRecord(string $tableName, array $insData) : int {
        $db = DataBase::getInstance()->getConnection();

        $escaped_values = array_map([$db, 'real_escape_string'], array_values($insData));
        $keys = '`' . implode('`, `', array_keys($insData)) . '`';
        $values = '\'' . implode('\', \'', $escaped_values). '\'';

        $sql = "INSERT INTO $tableName ($keys) VALUES ($values);";

        if ($db->query($sql) === false) {
            trigger_error( "Error: " . $sql . "<br>" . $db->error, E_USER_ERROR);
            return false;
        }
        return $db->insert_id;
    }
}
