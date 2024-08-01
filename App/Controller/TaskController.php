<?php

namespace App\Controller;

class TaskController
{
    public $filedError = '';
    private $objOfModel;
    public $task;

    public function __construct($currentId = null , $action= null , $objOfModel)
    {
        $this->objOfModel = $objOfModel;

        !empty($currentId) && $action==='delete' ? $this->deleteTask($currentId) : '';

        !empty($currentId) && $action==='status_update' ? $this->updateTaskStatus($currentId) : '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->task = $_POST['task'];
            $this->objOfModel->task =  $this->task ;

            if (empty($this->task)) {
                $this->filedError = 'No data';
            } else {
                if (isset($_POST['submit']) && !empty($currentId) && $action==='update') {
                    $this->updateTask($currentId);
                } else {
                    $this->createTask();
                }
            }
        }
    }

    private function createTask(){
        if ($this->objOfModel->create()) {
            header("Location: /index.php");
            exit;
        } else {
            $this->filedError = 'Error adding taskController';
        }
    }

    private function updateTask($id){
        if ($this->objOfModel->update($id)) {
            header("Location: /index.php");
            exit;
        } else {
            $this->filedError = 'Error updating taskController';
        }
    }

    private function deleteTask($id){
        if ($this->objOfModel->delete($id)) {
            header("Location: /index.php");
            exit;
        }
    }

    private function updateTaskStatus($id){
        if ($this->objOfModel->updateStatus($id)) {
            header("Location: /index.php");
            exit;
        }
    }
}
