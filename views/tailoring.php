<?php
require('logics/tailoring.php'); 
?>

<html>
    <head>
        <title>tailoring</title>
    </head>
    <body>
        <h2 class="register-text">tailoring</h2>
        <hr>
        <form method="post">
            <div>
                <label>Prompt:</label><br>
                <input type="text" name="prompt" autocomplete="off" required>
            </div>
            <input type="Submit" name="tailoring_form">
        </form>
    </body>
</html>