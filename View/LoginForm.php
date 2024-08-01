<?php
require_once __DIR__ . '/../App/Controller/AccessController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
<div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>

    <?php
    if(!empty($objOfLogin->loginErr)){
        echo '<div class="alert alert-danger">' . $objOfLogin->loginErr . '</div>';
    }
    ?>

    <form method="post">
        <div class="form-group">
            <label>Username or Email</label>
            <input type="text" name="username_or_email" class="form-control <?php echo (!empty($objOfLogin->userNameOrEmailErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $objOfLogin->userNameOrEmail; ?>">
            <span class="invalid-feedback"><?php echo $objOfLogin->userNameOrEmailErr; ?></span>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($objOfLogin->passwordErr)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $objOfLogin->passwordErr; ?></span>
        </div>
        <div class="form-group">
            <button type="submit"  name="submit" class="btn btn-primary">Login</button>
        </div>
        <p>Don't have an account? <a href="../registration.php">Sign up now</a>.</p>

    </form>
</div>
</body>
</html>