<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php if (isset($_SESSION['message'])) { ?>
        <h1 style="color: red;"><?php echo $_SESSION['message']; ?></h1>
    <?php } unset($_SESSION['message']); ?>
    <div class="login-container">
        <h1>Login</h1>
        <form action="core/handleForms.php" method="POST">
            <p>
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Username">
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password"><br><br>
                <input type="submit" name="loginUserBtn">
            </p>
        </form>
        <p> <a href="register.php">Register here</a></p>
    </div>
</body>
</html>