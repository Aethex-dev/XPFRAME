<?php

namespace xenonmc\xpframe\core\mvc\model;

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
    }
}