<?php

namespace Core;

use PDO;

// Connect to MySQL database
class Database{

    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = '@Alex1234'){

        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = []){

        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    public function get(){
        return $this->statement->fetchAll();
    }

    public function find(){
        return $this->statement->fetch();
    }

    public function findOrFail(){
        $result = $this->find();

        if (! $result){
            abort(403);
        }

        return $result;
    }
}

