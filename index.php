<?php
session_start();
require_once 'autoloader/class_loader.php';

use App\Database\database;
use App\Model\task;
use App\Controller\task_controller;
use App\Controller\login;

$database = new database();
$task_model = new task($database->getConnection());

require_once 'view/header.php';
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $result_set = $task_model->getdata();
    $counter = 1;
    $function_path = '../index.php?id=';
    $action_path = '&action=';

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $action = isset($_GET['action']) ? $_GET['action'] : null;

    $taskController = new task_controller($id, $action, $task_model);
    require_once 'view/taskform.php';
    require_once 'view/tasklist.php';
}else{
   $login = new login($task_model);
   require_once 'view/loginform.php';
}
require_once 'view/footer.php';



