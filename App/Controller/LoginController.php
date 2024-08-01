<?php

namespace App\Controller;

class LoginController
{
    private $objOfModel;
    public $userName = "";
    public $password = "";
    public $emailId = "";
    public $userNameOrEmail = "";
    public $passwordErr = "";
    public $userNameOrEmailErr = "";
    public $loginErr = "";

    public function __construct($objOfModel)
    {
        $this->objOfModel = $objOfModel;

        if (isset($_POST['submit'])) {
            $this->processLogin();
        }
    }

    private function processLogin()
    {
        if (empty(trim($_POST["username_or_email"]))) {
            $this->userNameOrEmailErr = "Please enter username or email";
        } else {
            $this->userNameOrEmail = trim($_POST["username_or_email"]);
            if (filter_var(trim($_POST["username_or_email"]), FILTER_VALIDATE_EMAIL)) {
                $this->emailId = trim($_POST["username_or_email"]);
                $this->objOfModel->emailId = $this->emailId;
            }
            $this->userName = trim($_POST["username_or_email"]);
            $this->objOfModel->userName = $this->userName;
        }

        if (empty(trim($_POST["username_or_email"]))) {
            $this->passwordErr = "Please enter your password.";
        } else {
            $this->password = trim($_POST["password"]);
            $this->objOfModel->password = $this->password;
        }

        if (empty($this->userNameOrEmailErr) && empty($this->passwordErr)) {
            $this->performLogin();
        }
    }

    private function performLogin()
    {
        $this->loginErr = $this->objOfModel->authenticate();
    }

}