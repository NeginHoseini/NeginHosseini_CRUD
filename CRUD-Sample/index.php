<?php

use CRUD\Controller\PersonController;

include ("loader.php");

$controller = new PersonController();
$controller->switcher($_SERVER['REQUEST_URI'],$_REQUEST);