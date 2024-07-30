<?php

namespace App\Controller;

class logout{
    function __construct(){
        session_start();
        $_SESSION = array();
        session_destroy();
        header("location:/index.php");
        exit;
    }
}

new logout();


