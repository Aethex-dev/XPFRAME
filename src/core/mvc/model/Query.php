<?php

namespace xenonmc\xpframe\core\mvc\model;

class Query
{
    /**
     * @var Connection Database object
     */
    public Connection $connection;

    /**
     * @var string SQL query
     */
    public string $query_sql;

    /**
     * Query management class
     */
    public function __construct(Connection $connection)
    {
        // Define connection object
        $this->connection = $connection;

        // Initialize query strings
        $this->query_sql = "";
    }

    /**
     * Select keyword
     * 
     * @param array $columns All columns to select
     * @return Query Query object
     */
    public function select(array $columns): Query
    {
        // Check database type
        switch ($this->connection->get_type()) {
            case "sql":
                $this->query_sql = $this->query_sql . " SELECT " . implode(", ", $columns);
                break;
        }
        return $this;
    }

    /**
     * From keyword
     * 
     * @param string $table Name of the table to select from
     * @return Query Query object
     */
    public function from(string $table): Query
    {
        // Check database type
        switch ($this->connection->get_type()) {
            case "sql": 
                $this->query_sql = $this->query_sql . " FROM " . $table;
                break;
        }
        return $this;
    }

    /**
     * Where statement
     * 
     * @param string $where Where query
     * @return Query Query object
     */
    public function where(string $where): Query
    {
        // Check database type
        switch ($this->connection->get_type()) {
            case "sql":
                $this->query_sql = $this->query_sql . " WHERE " . $where;
                break;
        }
        return $this;
    }

    /**
     * Values keyword
     * 
     * @param array $value Values for columns
     * @return Query Query object
     */
    public function values(array $values): Query
    {
        // Check database type
        switch ($this->connection->get_type()) {
            case "sql": 
                $this->query_sql = $this->query_sql . " VALUES (" . implode(", ", $values) . ")";
                break;
        }
        return $this;
    }

    /**
     * Limit keyword
     * 
     * @param string $limit Limit values
     * @return Query Query object
     */
    public function limit(string $limit): Query
    {
        // Check database type
        switch ($this->connection->get_type()) {
            case "sql":
                $this->query_sql = $this->query_sql . " LIMIT " . $limit;
        }
        return $this;
    }

    /**
     * Run query
     * 
     * @return mixed Query result object
     */
    public function run(): mixed
    {
        // Check query type
        switch ($this->connection->get_type()) {
            case "sql":
                // Define query data
                $query = $this->query_sql;
                $connection = $this->connection->get_connection();
                
                // Prepare statement
                $sql = $connection->prepare($query);
                $sql->execute();
                return $sql->get_result();
                break;
        }
    }
}