<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php if (isset($_SESSION['message'])) { ?>
        <h1 style="color: red;"><?php echo $_SESSION['message']; ?></h1>
    <?php } unset($_SESSION['message']); ?>
    <div class="register-container">
        <h1>Register here!</h1>
        <form action="core/handleForms.php" method="POST">
            <p>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" placeholder="First Name">
            </p>
            <p>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" placeholder="Last Name">
            </p>
            <p>
                <label for="address">Address</label>
                <input type="text" name="address" placeholder="Address">
            </p>
            <p>
                <label for="age">Age</label>
                <input type="number" name="age" placeholder="Age">
            </p>
            <p>
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" placeholder="Phone Number">
            </p>
            <p>
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Username">
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password"><br><br>
                <input type="submit" name="registerUserBtn">
            </p>
        </form>
    </div>
</body>
</html>
