<?php
namespace App\Controller;

use App\Model\task;

class register {
    public $task_model;
    public $username = "";
    public $password = "";
    public $confirm_password = "";
    public $emailid = "" ;
    public $username_err = "";
    public $password_err = "";
    public $confirm_password_err = "";
    public $emailid_err = "";

    public function __construct($db_link)
    {
        $this->task_model = new task($db_link);
        $this->handleFormSubmission();
    }

    public function handleFormSubmission()
    {
        if (isset($_POST['submit'])) {
            $this->username = trim($_POST["username"]);
            $this->password = trim($_POST["password"]);
            $this->confirm_password = trim($_POST["confirm_password"]);
            $this->emailid = trim($_POST["emailid"]);

            $this->validateUsername();
            $this->validateEmail();
            $this->validatePassword();
            $this->validateConfirmPassword();

            if (empty($this->username_err) && empty($this->password_err) && empty($this->confirm_password_err) && empty($this->emailid_err)) {
                $this->registerUser();
            }
        }
    }

    private function validateUsername()
    {
        if (empty($this->username)) {
            $this->username_err = "Please enter a username.";
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $this->username)) {
            $this->username_err = "Username can only contain letters, numbers, and underscores.";
        } else {
            $this->username_err = $this->task_model->validateuser($this->username);
        }
    }

    private function validateEmail()
    {
        if (empty($this->emailid)) {
            $this->emailid_err = "Please enter an email.";
        } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $this->emailid)) {
            $this->emailid_err = "Email address cannot contain spaces or special characters (except '.', '_', '%', '+', '-') follow standard format";
        } else {
            $this->emailid_err = $this->task_model->validateuser($this->emailid);
        }
    }

    private function validatePassword()
    {
        if (empty($this->password)) {
            $this->password_err = "Please enter a password.";
        } elseif (strlen($this->password) < 6) {
            $this->password_err = "Password must have at least 6 characters.";
        }
    }

    private function validateConfirmPassword()
    {
        if (empty($this->confirm_password)) {
            $this->confirm_password_err = "Please confirm password.";
        } elseif ($this->password !== $this->confirm_password) {
            $this->confirm_password_err = "Password did not match.";
        }
    }

    private function registerUser()
    {
        $this->task_model->registeruser($this->username, $this->emailid,$this->password);
    }

}



