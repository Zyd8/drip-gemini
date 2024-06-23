<?php
require('logics/register.php'); 
?>

<html>
    <head>
        <title>Register</title>
    </head>
    <body>
        <h2 class="register-text">Register</h2>
        <hr>
        <form method="post">
            <div>
                <label>Username:</label><br>
                <input type="text" name="username" autocomplete="off" required>
            </div>
            <div>
                <label>Password:</label><br>
                <input type="Password" name="password1" autocomplete="new-password" required>
            </div>
            <div>
                <label>Confirm Password:</label><br>
                <input type="Password" name="password2" autocomplete="new-password" required>
            </div>
            <input type="Submit" name="register_form" value="Register">
            <a href="/login">Login Now</a>
        </form>
    </body>
</html>