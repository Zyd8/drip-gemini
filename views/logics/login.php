<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['login_form'])) {

        $username = validate_input($_POST["username"]);
        $password = validate_input($_POST["password"]);
        if (authenticate("users", "user_name='$username'", "password='$password'")) {
            direct_to("/home");
            die;
        } else {
            direct_to("/", "?a=d");
        }

    }

}

if(isset($_GET["a"]) == "d"){
    echo "WRONG FUCKING PASSWORD";
}

?>
