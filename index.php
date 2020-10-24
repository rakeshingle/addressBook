<?php
include_once 'Model/addressBookModel.php';
include_once 'Controller/defaultController.php';
include_once 'Controller/addressBookController.php';


$action = isset($_GET['a']) ? $_GET['a'] : 'index';
$module = isset($_GET['m']) ? $_GET['m'] : '';
$id     = isset($_GET['id']) ? $_GET['id'] : '';

switch($module) {
    case 'list':
        $controller = new addressBookController();
        break;
    default:
        $controller = new defaultController();
}

$controller->run($action, $id);
