<?php

namespace CRUD\Helper;

use Exception;

class PersonHelper
{
    /**
     * @throws Exception
     */
    public function insert(Person $person)
    {

        $connection = new DBConnector();
        $connection->connect();
        $con=$connection->getConnection();

        $firstName = trim( $person->getFirstName());
        $lastName = trim($person->getLastName());
        $username = trim( $person->getUsername());

        $stmt = $con->prepare("
        insert into person (firstName, lastName, username)
                select * 
                from (select '$firstName', '$lastName', '$username') 
                where not exists (
                        select username 
                        from person 
                        where username = '$username'
                    ) limit 1
        ");

        $stmt->execute();
        if($stmt->rowCount()>0){
            echo "Account created successfully"."<br>";
        }else{
            echo "Account not created"."<br>";
        }
    }

    /**
     * @throws Exception
     */
    public function fetch(int $id)
    {
        $connection = new DBConnector();
        $connection->connect();
        $con=$connection->getConnection();

        $stmt=$con->prepare("
                    select * 
                    from person 
                    where id=$id
                    ");
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user!=false){
            echo "ID: ".$user['id']."   Firstname: ".$user['firstName']. "   Lastname: ".$user['lastName']."     Username: ".$user['username']."<br>";
        }else{
            echo "Not Found!";
        }
    }

    /**
     * @throws Exception
     */
    public function fetchAll()
    {
        $connection = new DBConnector();
        $connection->connect();
        $con=$connection->getConnection();
        $stmt=$con->prepare("
                    select * 
                    from person");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $user){
            echo "ID: ".$user['id']."    Firstname: ".$user['firstName']. "    Lastname: ".$user['lastName']."    Username: ".$user['username']."<br>";
        }
    }

    /**
     * @throws Exception
     */
    public function update(Person $person)
    {
        $connection = new DBConnector();
        $connection->connect();
        $con=$connection->getConnection();

        $firstName = $person->getFirstName();
        $lastName = $person->getLastName();
        $username = $person->getUsername();

        $stmt=$con->prepare("
                update person
                set firstName='$firstName',lastName='$lastName'
                where username='$username'");
        $stmt->execute();

        if($stmt->rowCount()>0){
            echo "Account successfully updated"."<br>";
        }else{
            echo "Account could not be updated"."<br>";
        }
    }

    /**
     * @throws Exception
     */
    public function delete($username)
    {
        $connection = new DBConnector();
        $connection->connect();
        $con=$connection->getConnection();

        $stmt=$con->prepare("
                delete from person
                where username='$username'
                ");
        $stmt->execute();

        if($stmt->rowCount()>0){
            echo "Account deleted successfully"."<br>";
        }else{
            echo "Account could not be deleted"."<br>";
        }
    }

}