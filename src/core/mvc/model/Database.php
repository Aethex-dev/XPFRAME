<?php

namespace xenonmc\xpframe\core\mvc\model;

use mysqli;
use Exception;
use xenonmc\xpframe\core\mvc\Model;
use xenonmc\xpframe\core\mvc\model\Connection;

class Database
{
    /**
     * @var Model Model class object
     */
    public Model $model;
    
    /**
     * @var array All databases connections
     */
    public array $databases;

    /**
     * Class used for creating database objects for certain database types
     */
    public function __construct(Model $model)
    {
        // Store parent class
        $this->model = $model;

        // Initialize vars
        $this->databases = [];
    }

    /**
     * Create a new connection object
     * 
     * @param string $type Type of database instance to create
     * @param array $credentials Credentials for connecting to the database
     * @param Connection Database connection object
     */
    public function new(string $type, array $credentials): Connection
    {
        // Select database type
        switch ($type) {
            case "sql":
                $connection = new mysqli($credentials["hostname"] ?? "localhost", $credentials["username"] ?? "root", $credentials["password"] ?? "", $credentials["database"] ?? "");
                return new Connection($type, $connection);
                break;
            default: 
                throw new Exception("Invalid database type");
                break;
        }
    }

    /**
     * Add database to database selection
     * 
     * @param string $id Identifier for database
     * @param Connection $connection Database connection object
     */
    public function add(string $id, Connection $connection)
    {
        // Add database with key to databases array
        array_push($this->databases, [
            $id => [
            "type" => $connection->type,
            "connection" => $connection->connection
        ]]);
    }
}