<?php

namespace App\Controller;

class task_controller
{
    public $filederror = '';
    private $task_model;
    public $task;

    public function __construct($current_id = null , $action= null , $task_model)
    {
        $this->task_model = $task_model;

        if(!empty($current_id) && $action==='delete'){
            $this->deletetask($current_id);
        }

        if(!empty($current_id) && $action==='status_update'){
            $this->updatetaskstatus($current_id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->task = $_POST['task'];
            $this->task_model->task =  $this->task ;

            if (empty($this->task)) {
                $this->filederror = 'No data';
            } else {
                if (isset($_POST['submit']) && !empty($current_id) && $action==='update') {
                    $this->updatetask($current_id);
                } else {
                    $this->createtask();
                }
            }
        }
    }

    private function createtask(){
        if ($this->task_model->create()) {
            header("Location: /index.php");
            exit;
        } else {
            $this->filederror = 'Error adding taskController';
        }
    }

    private function updatetask($id){
        if ($this->task_model->update($id)) {
            header("Location: /index.php");
            exit;
        } else {
            $this->filederror = 'Error updating taskController';
        }
    }

    private function deletetask($id){
        if ($this->task_model->delete($id)) {
            header("Location: /index.php");
            exit;
        }
    }

    private function updatetaskstatus($id){
        if ($this->task_model->updatestatus($id)) {
            header("Location: /index.php");
            exit;
        }
    }
}
