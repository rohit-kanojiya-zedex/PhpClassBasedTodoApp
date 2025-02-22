<?php


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
    if(!empty($login->login_err)){
        echo '<div class="alert alert-danger">' . $login->login_err . '</div>';
    }
    ?>

    <form method="post">
        <div class="form-group">
            <label>Username or Email</label>
            <input type="text" name="username_or_email" class="form-control <?php echo (!empty($login->username_or_email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $login->username_or_email; ?>">
            <span class="invalid-feedback"><?php echo $login->username_or_email_err; ?></span>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($login->password_err)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $login->password_err; ?></span>
        </div>
        <div class="form-group">
            <button type="submit"  name="submit" class="btn btn-primary">Login</button>
        </div>
        <p>Don't have an account? <a href="../registration.php">Sign up now</a>.</p>

    </form>
</div>
</body>
</html>