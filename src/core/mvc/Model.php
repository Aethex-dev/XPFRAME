<?php

namespace xenonmc\xpframe\core\mvc;

use Ratchet\Wamp\Exception;
use xenonmc\xpframe\core\mvc\MVC;
use xenonmc\xpframe\core\mvc\model\Database;

class Model
{
    /**
     * @var MVC Mvc object
     */
    public MVC $mvc;

    /**
     * @var Database Database object
     */
    public Database $database;

    /**
     * Model class used for sending, receiving, modifying and more of data from an database
     * 
     * @param string $type Type of database to use
     * @param array $credentials Database connection credentials
     */
    public function __construct(MVC $mvc)
    {
        // Define parent class
        $this->mvc = $mvc;

        // Define database connection builder
        $this->database = new Database($this);
    }

    /**
     * Run a query to database server
     */
    public function query(string $query, string $database): bool|null
    {
        // Check database type
        switch ($database->get_type()) {
            default: 
                throw new Exception("cannot query to this database because of unsupported type: [ " . $database->get_type() . " ]");
        }
    }
}