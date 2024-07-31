<?php
require_once 'autoloader/class_loader.php';
use App\Database\database;
use App\Controller\register;
$database = new database();
$register_data = new register($database->getConnection());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<div class="wrapper p-5 w-50">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control <?php echo (!empty($register_data->username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $register_data->username; ?>">
            <span class="invalid-feedback"><?php echo $register_data->username_err; ?></span>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="emailid" class="form-control <?php echo (!empty($register_data->emailid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $register_data->emailid; ?>">
            <span class="invalid-feedback"><?php echo $register_data->emailid_err; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($register_data->password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $register_data->password; ?>">
            <span class="invalid-feedback"><?php echo $register_data->password_err; ?></span>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($register_data->confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $register_data->confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $register_data->confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <button type="submit"  name="submit" class="btn btn-primary">Register</button>
            <button type="reset"  name="submit" class="btn btn-primary">Reset</button>
        </div>
        <p>Already have an account? <a href="../index.php">Login here</a>.</p>
    </form>
</div>
</body>
</html>