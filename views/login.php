<?php 
/* ADD INSTANCE ( OOP ) */
//$data = new database ();

/*AUTHENTICATE LOGIN*/
// $username = "'justin'";
// $password = "'guiriba2'";
// $auth =  authenticate("users", "username=$username", "password=$password");
// if($auth == true){
//     echo("LOGIN SUCCESS!");
// } else {
//     echo("LOGIN FAILED!");
// }

/* DATA CREATE */
//$userdata = [
  //  'username' => 'Zyldjan',
  //  'password' => '2004UE'
//];
//$data->data_create("users", $userdata);

/* DATA READ */
// $test =  $data->data_read("*", "users");
// foreach($test as $player){
//     echo $player['username']."<br>";
// }

/* DATA UPDATE */
//$data->data_update("users", "username = 'YSheen'", "id = 15");

/* DATA UPDATE */
//$data->data_delete("users", "id = 11");

/* DATA END */
//$data->data_end();

require('logics/login.php');
?>

<html>
    <head>
        <title>
            TEST LIBRARY
            
        </title>
        <!-- <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"> -->
        <!-- <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    </head>
    <body>
        

        <section>
            <div class="loginform-container">
                <h2 class="login-text">Login</h2>
                <hr>

                <form class="semi-cont" method="post" action="">
                    <div class="labels">
                        <label>Username:</label><br>
                        <input type="text" name="username" autocomplete="off" required>
                    </div>

                    <div class="labels">
                        <label>Password:</label><br>
                        <input type="password" name="password" autocomplete="new-password" required>
                    </div>
                    <input type="submit" name="login_form" value="Login">
                    <a href="/register">Register Now</a>
                </form>
            </div>
        </section>
        
    </body>
</html>