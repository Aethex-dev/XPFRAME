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
                throw new Exception("Invalid or unsupported database type: [ " . $type . " ]");
                break;
        }
    }

    /**
     * Add database to database selection
     * 
     * @param string $name Identifier for database
     * @param Connection $connection Database connection object
     */
    public function add(string $name, Connection $connection)
    {
        // Add database with key to databases array
        array_push($this->databases, [
            $name => [
            "type" => $connection->type,
            "connection" => $connection->connection
        ]]);
    }

    /**
     * Get a stored database connection object
     * 
     * @param string $database Name of the database
     */
    public function get_connection(string $database): mixed
    {
        // Check if database exists in memory
        if (array_key_exists($database, $this->databases[0])) {
            return $this->databases[0][$database]["connection"];
        }
        
        // Throw error for non existing database
        throw new Exception("The database [ " . $database . " ] does not exist in database memory");
    }

    /**
     * Get a stored database type value
     * 
     * @param string $database Name of the database
     */
    public function get_type(string $database): mixed
    {
        // Check if database exists in memory
        if (array_key_exists($database, $this->databases[0])) {
            return $this->databases[0][$database]["type"];
        }
        
        // Throw error for non existing database
        throw new Exception("The database [ " . $database . " ] does not exist in database memory");
    }

    /**
     * Get a stored database object
     * 
     * @param string $database Name of the database
     */
    public function get(string $database): mixed
    {
        // Check if database exists in memory
        if (array_key_exists($database, $this->databases[0])) {
            return new Connection($this->databases[0][$database]["type"], $this->databases[0][$database]["connection"]);
        }
        
        // Throw error for non existing database
        throw new Exception("The database [ " . $database . " ] does not exist in database memory");
    }
}