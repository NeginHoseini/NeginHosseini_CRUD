<?php

namespace CRUD\Controller;

use CRUD\Helper\PersonHelper;
use CRUD\Model\Actions;
use CRUD\Model\Person;
use Exception;

class PersonController
{
    /**
     * @throws Exception
     */
    public function switcher($uri, $request)
    {
        switch ($uri)
        {
            case Actions::CREATE:
                $this->createAction($request);
                break;
            case Actions::UPDATE:
                $this->updateAction($request);
                break;
            case Actions::READ:
                $this->readAction($request);
                break;
            case Actions::READ_ALL:
                $this->readAllAction($request);
                break;
            case Actions::DELETE:
                $this->deleteAction($request);
                break;
            default:
                break;
        }
    }

    /**
     * @throws Exception
     */
    public function createAction($request)
    {
        $personHelper = new PersonHelper();
        $firstname=$_POST["firstName"];
        $lastName=$_POST["lastName"];
        $username=$_POST["username"];
        $person = new Person();
        $person->setFirstName($firstname);
        $person->setLastName($lastName);
        $person->setUsername($username);

        $personHelper->insert($person);
    }

    /**
     * @throws Exception
     */
    public function updateAction($request)
    {
        $firstname=$_POST["firstName"];
        $lastName=$_POST["lastName"];
        $username=$_POST["username"];
        $person = new Person();
        $person->setFirstName($firstname);
        $person->setLastName($lastName);
        $person->setUsername($username);

        $personHelper = new PersonHelper();
        $personHelper->update($person);
    }

    /**
     * @throws Exception
     */
    public function readAction($request)
    {
        $id=$_GET["id"];
        $personHelper = new PersonHelper();
        $personHelper->fetch($id);
    }

    /**
     * @throws Exception
     */
    public function readAllAction($request)
    {
        $personHelper = new PersonHelper();
        $personHelper->fetchAll();
    }

    /**
     * @throws Exception
     */
    public function deleteAction($request)
    {
        $username=$_POST["username"];
        $personHelper = new PersonHelper();
        $personHelper->delete($username);
    }

}