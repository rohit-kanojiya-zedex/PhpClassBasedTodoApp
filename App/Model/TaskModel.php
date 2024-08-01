<?php

namespace App\Model;
use PDO;

class TaskModel {
    private $pdoLink;
    private $table = 'todolisttable';
    public $task;
    public $userName = "";
    public $password = "";
    public $emailId = "";

    public function __construct($pdoLink) {
        $this->pdoLink = $pdoLink;
    }

    public function getData() {
        $sql = "SELECT * FROM `{$this->table}`";
        $stmt = $this->pdoLink->prepare($sql);
        if (!$stmt->execute()) {
            throw new \Exception("Error executing query: " . implode(", ", $stmt->errorInfo()));
        }

        return $stmt;
    }

    public function create() {
        $sql = "INSERT INTO `{$this->table}` (`task`) VALUES (:task)";
        $stmt = $this->pdoLink->prepare($sql);
        $stmt->bindParam(':task', $this->task, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new \Exception("Error creating taskModel");
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM `{$this->table}` WHERE id = :id";
        $stmt = $this->pdoLink->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new \Exception("Error deleting taskModel");
        }
    }

    public function update($id) {
        $sql = "UPDATE `{$this->table}` SET `task` = :task WHERE id = :id";
        $stmt = $this->pdoLink->prepare($sql);
        $stmt->bindParam(':task', $this->task, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new \Exception("Error updating taskModel");
        }
    }

    public function validateUser($value) {
        $sql = filter_var(trim($value), FILTER_VALIDATE_EMAIL) ?
            "SELECT id FROM users WHERE email = :value" :
            "SELECT id FROM users WHERE username = :value";
        $stmt = $this->pdoLink->prepare($sql);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "This user is already taken.";
        }
    }

    public function updateStatus($id) {
        $select_query = "SELECT status FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdoLink->prepare($select_query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $newStatus = (int)(!(int)$result['status']);
        $update_query = "UPDATE {$this->table} SET status = :status WHERE id = :id";
        $stmt = $this->pdoLink->prepare($update_query);
        $stmt->bindParam(':status', $newStatus, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new \Exception("Error updating status");
        }
    }

    public function registerUser($userName, $email, $password) {
        $paramPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->pdoLink->prepare($sql);
        $stmt->bindParam(':username', $userName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $paramPassword, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit;
        } else {
            throw new \Exception("Error registering user");
        }
    }

    public function authenticate() {
        $sql = "SELECT id, username, email, password FROM users WHERE username = :username OR email = :email";
        $stmt = $this->pdoLink->prepare($sql);
        $stmt->bindParam(':username', $this->userName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->emailId, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $username = $row['username'];
            $emailId = $row['email'];
            $hashedPassword = $row['password'];

            if (password_verify($this->password, $hashedPassword)) {
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;
                header("Location: ../index.php");
                exit;
            } else {
                return "Invalid username or email or password.";
            }
        } else {
            return "Invalid username or email or password.";
        }
    }
}
