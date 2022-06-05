<?php
namespace PhpBook\CMS;                                   // Namespace declaration

class Database extends \PDO
{
    public function __construct(string $dsn, string $username, string $password, array $options = [])
    {
        $default_options[\PDO::ATTR_DEFAULT_FETCH_MODE] = \PDO::FETCH_ASSOC; 
        $default_options[\PDO::ATTR_EMULATE_PREPARES]   = false;           
        $default_options[\PDO::ATTR_ERRMODE]            = \PDO::ERRMODE_EXCEPTION; 
        $options = array_replace($default_options, $options);     
        parent::__construct($dsn, $username, $password, $options); 
    }

    public function runSql(string $sql, $arguments = null)
    {
        if (!$arguments) {                               // If no arguments
            return $this->query($sql);                   // Run SQL, return PDOStatement object
        }
        $statement = $this->prepare($sql);               // If still running prepare statement
        $statement->execute($arguments);                 // Execute SQL statement with arguments
        return $statement;                               // Return PDOStatement object
    }
}