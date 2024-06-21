<?php 
require("libraries\GLIB_Debug.php");
require("libraries\GLIB_Database.php");
require("libraries\GLIB_DBFunctions.php");


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

?>

<html>
    <head>
        <title>
            TEST LIBRARY
            
        </title>
        <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
        <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        
        <section>
            <div class="loginform-container">
                <h3 class="login-text">Login</h3>
                <hr>
                <form class="semi-cont" method="post">
                    <div class="labels">
                        <label>Username:</label><br>
                        <input type="text">
                    </div>

                    <div class="labels">
                        <label>Password:</label><br>
                        <input type="password">
                    </div>
                    <input type="submit">
                    <a href="/home">home</a>
                    <h1>ERROR CODE</h1>
                </form>
            </div>
        </section>
        
    </body>
</html>