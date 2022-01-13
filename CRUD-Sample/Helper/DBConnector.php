<?php

namespace CRUD\Helper;

use Exception;
use PDO;
use PDOException;

class DBConnector
{

    /** @var mixed $db */
    private $db;

    private $con;

    public function __construct()
    {
        $this->db = "crud";
    }


    public function connect() : void
    {
        $server = "localhost";
        $username = "root";
        $password = "47547985";

        try {
            $connection = new PDO("mysql:host=$server;dbname=$this->db", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->con=$connection;
        } catch(PDOException $exception) {

            echo "not connect".$exception->getMessage();
        }
            echo "Connected!";

    }

    /**
     * @param string $query
     * @return bool
     */
    public function execQuery(string $query) : bool
    {
        try {
            $this->con->exec($query);
             }
        catch(PDOException $exp) {
            echo "Error in execQuery";
            return false;
        }
        return true;

    }

    /**
     * @param string $message
     * @throws Exception
     * @return void
     */
    private function exceptionHandler(string $message): void
    {
            echo $message;
    }

    public function getConnection()
    {
        return $this->con;
    }

}