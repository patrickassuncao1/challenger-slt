<?php

namespace App\database;

use PDO;

class Database
{
    private $table;
    private  $connection;

    public function __construct($table = null)
    {

        $this->table = $table;
        $this->setConnection();
    }

    private function setConnection()
    {
        $HOST = getenv("DB_HOST");
        $NAME = getenv("DB_DATABASE");
        $USER = getenv("DB_USERNAME");
        $PASSWORD = getenv("DB_PASSWORD");

        try {
            $this->connection = new PDO("mysql:host=" . $HOST . ";dbname=" . $NAME, $USER, $PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Error " . $e->getMessage());
        }
    }

    public function execute($query, $params = [])
    {

        try {

            $statement = $this->connection->prepare($query);
            $statement->execute($params);

            return $statement;
        } catch (\PDOException $th) {
            //throw $th;
        }
    }

    public function insert(array $values): int
    {
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        $arrayToStringFields =  implode(',', $fields);
        $arrayToStringBinds =  implode(',', $binds);

        $query = "INSERT INTO {$this->table} ($arrayToStringFields) VALUES ($arrayToStringBinds)";

        $this->execute($query, array_values($values));

        return $this->connection->lastInsertId();
    }

    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {

        $where = strlen($where) ? "WHERE {$where}" : "";
        $order = strlen($order) ? "ORDER BY  {$order} DESC" : '';
        $limit = strlen($limit) ? "LIMIT  {$limit}" : '';

        $query = "SELECT {$fields} FROM  {$this->table} {$where} {$order} {$limit}";
        
        return $this->execute($query);
    }
}
