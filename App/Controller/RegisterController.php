<?php
namespace App\Controller;

use App\Model\TaskModel;

class RegisterController {
    public $objOfModel;
    public $userName = "";
    public $password = "";
    public $confirmPassword = "";
    public $emailId = "" ;
    public $userNameErr = "";
    public $passwordErr = "";
    public $confirmPasswordErr = "";
    public $emailIdErr = "";

    public function __construct($pdoLink)
    {
        $this->objOfModel = new TaskModel($pdoLink);
        $this->handleFormSubmission();
    }

    public function handleFormSubmission()
    {
        if (isset($_POST['submit'])) {
            $this->userName = trim($_POST["username"]);
            $this->password = trim($_POST["password"]);
            $this->confirmPassword = trim($_POST["confirm_password"]);
            $this->emailId = trim($_POST["emailid"]);

            $this->validateUsername();
            $this->validateEmail();
            $this->validatePassword();
            $this->validateConfirmPassword();

            if (empty($this->userNameErr) && empty($this->passwordErr) && empty($this->confirmPasswordErr) && empty($this->emailIdErr)) {
                $this->registerUser();
            }
        }
    }

    private function validateUsername()
    {
        if (empty($this->userName)) {
            $this->userNameErr = "Please enter a username.";
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $this->userName)) {
            $this->userNameErr = "Username can only contain letters, numbers, and underscores.";
        } else {
            $this->userNameErr = $this->objOfModel->validateUser($this->userName);
        }
    }

    private function validateEmail()
    {
        if (empty($this->emailId)) {
            $this->emailIdErr = "Please enter an email.";
        } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $this->emailId)) {
            $this->emailIdErr = "Email address cannot contain spaces or special characters (except '.', '_', '%', '+', '-') follow standard format";
        } else {
            $this->emailIdErr = $this->objOfModel->validateUser($this->emailId);
        }
    }

    private function validatePassword()
    {
        if (empty($this->password)) {
            $this->passwordErr = "Please enter a password.";
        } elseif (strlen($this->password) < 6) {
            $this->passwordErr = "Password must have at least 6 characters.";
        }
    }

    private function validateConfirmPassword()
    {
        if (empty($this->confirmPassword)) {
            $this->confirmPasswordErr = "Please confirm password.";
        } elseif ($this->password !== $this->confirmPassword) {
            $this->confirmPasswordErr = "Password did not match.";
        }
    }

    private function registerUser()
    {
        $this->objOfModel->registerUser($this->userName, $this->emailId,$this->password);
    }

}



