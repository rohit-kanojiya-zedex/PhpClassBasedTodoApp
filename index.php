<?php
session_start();
require_once 'AutoLoader/ClassAutoLoader.php';

use App\Database\ConnectionDatabase;
use App\Model\TaskModel;
use App\Controller\TaskController;
use App\Controller\LoginController;

$objOfDatabase = new ConnectionDatabase();
$objOfModel = new taskModel($objOfDatabase->getConnection());

require_once 'View/Header.php';
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $resultSet = $objOfModel->getdata();
    $counter = 1;
    $functionPath = '../index.php?id=';
    $actionPath = '&action=';

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $action = isset($_GET['action']) ? $_GET['action'] : null;

    $objOfTaskController = new TaskController($id, $action, $objOfModel);
    require_once 'View/TaskForm.php';
    require_once 'View/TaskList.php';
}else{
    $objOfLogin = new LoginController($objOfModel);
   require_once 'View/LoginForm.php';
}
require_once 'View/Footer.php';