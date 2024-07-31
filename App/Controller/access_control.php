<?php
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $currentFile = basename($_SERVER['PHP_SELF']);
    if ($currentFile !== 'index.php') {
        header("Location: ../index.php");
        exit;
    }
}