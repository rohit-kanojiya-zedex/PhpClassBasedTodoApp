<?php

namespace App\Model;
use PDO;

class task {
    private $pdo;
    private $table = 'todolisttable';
    public $task;
    public $username = "";
    public $password = "";
    public $emailid = "";

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function getData() {
        $sql = "SELECT * FROM `{$this->table}`";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute()) {
            throw new \Exception("Error executing query: " . implode(", ", $stmt->errorInfo()));
        }

        return $stmt;
    }

    public function create() {
        $sql = "INSERT INTO `{$this->table}` (`task`) VALUES (:task)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':task', $this->task, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new \Exception("Error creating task");
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM `{$this->table}` WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new \Exception("Error deleting task");
        }
    }

    public function update($id) {
        $sql = "UPDATE `{$this->table}` SET `task` = :task WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':task', $this->task, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new \Exception("Error updating task");
        }
    }

    public function validateuser($value) {
        $sql = filter_var(trim($value), FILTER_VALIDATE_EMAIL) ?
            "SELECT id FROM users WHERE email = :value" :
            "SELECT id FROM users WHERE username = :value";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "This user is already taken.";
        } else {
            return 'Oops! Something went wrong. Please try again later.';
        }
    }

    public function updatestatus($id) {
        $select_query = "SELECT status FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($select_query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $new_status = (int)(!(int)$result['status']);
        $update_query = "UPDATE {$this->table} SET status = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($update_query);
        $stmt->bindParam(':status', $new_status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            throw new \Exception("Error updating status");
        }
    }

    public function registeruser($username, $email, $password) {
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $param_password, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit;
        } else {
            throw new \Exception("Error registering user");
        }
    }

    public function authenticate() {
        $sql = "SELECT id, username, email, password FROM users WHERE username = :username OR email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->emailid, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $username = $row['username'];
            $emailid = $row['email'];
            $hashed_password = $row['password'];

            if (password_verify($this->password, $hashed_password)) {
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
