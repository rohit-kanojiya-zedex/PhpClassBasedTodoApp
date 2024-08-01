<?php
require_once 'AutoLoader/ClassAutoLoader.php';
use App\Database\ConnectionDatabase;
use App\Controller\RegisterController;
$objOfDatabase = new ConnectionDatabase();
$objOfRegister = new RegisterController($objOfDatabase->getConnection());
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
            <input type="text" name="username" class="form-control <?php echo (!empty($objOfRegister->userNameErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $objOfRegister->userName; ?>">
            <span class="invalid-feedback"><?php echo $objOfRegister->userNameErr; ?></span>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="emailid" class="form-control <?php echo (!empty($objOfRegister->emailIdErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $objOfRegister->emailId; ?>">
            <span class="invalid-feedback"><?php echo $objOfRegister->emailIdErr; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($objOfRegister->passwordErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $objOfRegister->password; ?>">
            <span class="invalid-feedback"><?php echo $objOfRegister->passwordErr; ?></span>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($objOfRegister->confirmPasswordErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $objOfRegister->confirmPassword; ?>">
            <span class="invalid-feedback"><?php echo $objOfRegister->confirmPasswordErr; ?></span>
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