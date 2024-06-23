<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['login_form'])) {

        $username = validate_input($_POST["username"]);
        $password = validate_input($_POST["password"]);
        if (authenticate_both("users", "username='$username'", "password='$password'")) {
            $db = new database();
            $user_id = $db->data_read("ID", "users", "username = '$username'");
            $db->data_end();
            $_SESSION["ID"] = $user_id;
            direct_to("/");
            die;
        } else {
            direct_to("/login", "?a=d");
        }

    }

}

if(isset($_GET["a"]) == "d"){
    echo "WRONG FUCKING PASSWORD";
}

?>
