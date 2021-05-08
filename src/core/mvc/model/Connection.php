<?php

namespace xenonmc\xpframe\core\mvc\model;

use Exception;
use xenonmc\xpframe\core\mvc\model\Query;

class Connection 
{
    /**
     * @var string Type of connection
     */
    public string $type;

    /**
     * @var mixed Database connection object
     */
    public mixed $connection;
    
    /**
     * Database connection object
     */
    public function __construct(string $type, mixed $connection)
    {
        // Set properties for connection
        $this->type = $type;
        $this->connection = $connection;

        // Define query management class
        $this->query = new Query($this);
    }

    /**
     * Get connection
     */
    public function get_connection(): mixed
    {
        // Return connection object
        return $this->connection;
    }

    /**
     * Get type
     */
    public function get_type(): string
    {
        // Return database connection type
        return $this->type;
    }

    /**
     * Query to database
     * 
     * @param string $query Database query
     */
    public function query(string $query): mixed
    {
        // Check type
        switch ($this->get_type()) {
            case "sql":
                // Execute and return query return
                return $this->get_connection()->query($query);
                break;
            default:
                throw new Exception("Could not query to database due to unsupported connection type: [ " . $this->get_type() . " ]");
                break;
        }
    }
}