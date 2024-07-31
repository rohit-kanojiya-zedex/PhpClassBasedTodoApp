<?php
namespace App\Controller;

class login
{
    private $task_model;
    public $username = "";
    public $password = "";
    public $emailid = "";
    public $username_or_email = "";
    public $password_err = "";
    public $username_or_email_err = "";
    public $login_err = "";

    public function __construct($pdo)
    {
        $this->task_model = $pdo;

        if (isset($_POST['submit'])) {
            $this->processLogin();
        }
    }

    private function processLogin()
    {
        if (empty(trim($_POST["username_or_email"]))) {
            $this->username_or_email_err = "Please enter username or email";
        } else {
            $this->username_or_email = trim($_POST["username_or_email"]);
            if (filter_var(trim($_POST["username_or_email"]), FILTER_VALIDATE_EMAIL)) {
                $this->emailid = trim($_POST["username_or_email"]);
                $this->task_model->emailid = $this->emailid ;
            }
            $this->username = trim($_POST["username_or_email"]);
            $this->task_model->username = $this->username;
        }

        if (empty(trim($_POST["password"]))) {
            $this->password_err = "Please enter your password.";
        } else {
            $this->password = trim($_POST["password"]);
            $this->task_model->password = $this->password;
        }

        if (empty($this->username_or_email_err) && empty($this->password_err)) {
            $this->performLogin();
        }
    }

    private function performLogin()
    {
        $this->login_err = $this->task_model->authenticate();
    }

}
