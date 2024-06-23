<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['register_form'])) {

        $username = validate_input($_POST["username"]);
        $password1 = validate_input($_POST["password1"]);
        $password2 = validate_input($_POST["password2"]);

        if($password1 == $password2) {

            if (authenticate("users", "username='$username'")) {

                echo "Username is Already taken";
                die();

            } else {

                $db = new database();

                $user = [
                    'username' => $username,
                    'password' => $password1
                ];

                $db->data_create("users", $user);
                $db->data_end();
                direct_to("/login");
                die();
            }
        } else {

        echo "Password Doesn't match";

        }

    }

}

if(isset($_GET["a"]) == "d"){
    echo "Username is Already taken";
}
/*
==DO NOT REMOVE==
$plain_password = "userpassword123";
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

$entered_password = "userpassword123"; // The password the user entered
$hashed_password_from_db = $hashed_password; // The hashed password retrieved from the database

if (password_verify($entered_password, $hashed_password_from_db)) {
    echo "Password is correct!";
} else {
    echo "Invalid password.";
}
*/


?>
