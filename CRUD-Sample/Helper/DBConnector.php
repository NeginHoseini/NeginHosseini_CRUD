<?php

namespace CRUD\Helper;

class DBConnector
{

    /** @var mixed $db */
    private $db;
    private $con;

    public function __construct()
    {

    }

    /**
     * @throws \Exception
     * @return void
     */
    public function connect() : void
    {
        $server = "localhost";
        $username = "root";
        $password = "47547985";
        $this->db = "crud";

        $conn = mysqli_connect($server,$username,$password,$this->db);
        $this->con = $conn;

        if(!$conn){
           echo "not connect".mysqli_connect_error();
        }
        else{
            echo "Connected!";
        }
    }

    /**
     * @param string $query
     * @return bool
     */
    public function execQuery(string $query) : bool
    {

        if($this->con->query($query)){
            return true;
        }
        else{
            echo "Error in execQuery";
            return false;
        }
    }

    /**
     * @param string $message
     * @throws \Exception
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