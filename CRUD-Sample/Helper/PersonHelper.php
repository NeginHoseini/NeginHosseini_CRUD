<?php

namespace CRUD\Helper;

class PersonHelper
{
    /**
     * @throws \Exception
     */
    public function insert()
    {

        $connection = new DBConnector();
        $connection->connect();
        $con=$connection->getConnection();

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];

        $query = "insert into person (firstName, lastName, username)
         values ('$firstName','$lastName', '$username')";

        $con->execQuery($query);


    }

    /**
     * @throws \Exception
     */
    public function fetch(int $id)
    {

        $connection = new DBConnector();
        $connection->connect();
        $con=$connection->getConnection();

        $query = "select id, firstName, lastName, username 
        from person
        where id ='$id'";

        $result = $con->execQuery($query);


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"] . "  Firstname: " . $row["firstName"] . "  Lastname: " . $row["lastName"] . "   Username:" . $row["username"] . "<br>";
            }
        } else {
            echo "Not Found!";
        }

    }

    /**
     * @throws \Exception
     */
    public function fetchAll()
    {

        $connection = new DBConnector();
        $connection->connect();
        $con=$connection->getConnection();

        $query = "select * from person";
        $result = $con->execQuery($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"] . "  Firstname: " . $row["firstName"] . "  Lastname: " . $row["lastName"] . "   Username:" . $row["username"] . "<br>";
            }
        } else {
            echo "No Result";
        }
    }

    /**
     * @throws \Exception
     */
    public function update()
    {

        $connection = new DBConnector();
        $connection->connect();
        $con=$connection->getConnection();

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];

        $query = "update person set firstName ='$firstName', lastName ='$lastName' where username ='$username'";
        $con->execQuery($query);

    }

    /**
     * @throws \Exception
     */
    public function delete()
    {
        $connection = new DBConnector();
        $connection->connect();
        $con=$connection->getConnection();

        $id = $_POST['id'];
        $query = "delete from person WHERE id ='$id'";
        $con->execQuery($query);
    }

}