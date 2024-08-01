<?php
ob_start();
require_once __DIR__ . '/../App/Controller/AccessController.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <style>
        body{ font: 14px sans-serif;}
        .wrapper{ width: 360px; padding: 30px; }
        h6{
            padding-left: 1rem;
        }
        input{
            cursor: pointer;
            height:30px;
            width:25px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <div class="container-fluid">
            <a class="navbar-brand mt-2 mt-lg-0" href="#">
            <h5 class="pt-1">MDB</h5>
        </a>

        <button data-mdb-button-init class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
            </ul>

                <div class="d-flex">
                    <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy" />
                    </a>
                    <?php
                    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                        echo "<a href='/logout.php' class='dropdown-item bg-danger'>Logout</a>";
                    }
                    ?>
                </div>
        </div>
    </div>
</nav>

<div class="px-5 pt-5">
    <?php if (isset($_SESSION["username"]) && !empty($_SESSION["username"])): ?>
        <h1 class="text-center">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <?php endif; ?>
</div>



</body>
</html>

